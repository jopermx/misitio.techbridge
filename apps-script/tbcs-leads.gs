const CONFIG = {
  sheetId: '16nYl9f7KBbISpdL8CdU5VyFQXR1NuzMcb_QI0pN8BjU',
  sheetName: 'Leads',
  token: '10d6b5321f6c49cf8f61fb499d190da7ed07761b005f4be78b1826719f0468f2',
  notificationEmails: [
    'comercial@tbcs.com.mx',
    'jonathan.perez@tbcs.com.mx'
  ],
  timezone: 'America/Mexico_City'
};

const HEADERS = [
  'created_at_gmt',
  'status',
  'form_type',
  'source_page',
  'source_campaign',
  'nombre',
  'email',
  'telefono',
  'empresa',
  'empleados',
  'ayuda',
  'desafio',
  'otro_ayuda',
  'payload_json',
  'ip_hash',
  'user_agent'
];

function doGet() {
  return jsonResponse({
    ok: true,
    message: 'TBCS leads endpoint activo. Usa POST para enviar leads.',
    sheetName: CONFIG.sheetName
  }, 200);
}

function doPost(e) {
  try {
    const raw = e && e.postData && e.postData.contents ? e.postData.contents : '{}';
    const body = JSON.parse(raw);

    if (!body || body.token !== CONFIG.token) {
      return jsonResponse({ ok: false, message: 'Unauthorized' }, 401);
    }

    const lead = body.lead || {};
    const row = Array.isArray(body.row) ? body.row : buildRowFromLead_(lead);
    const meta = body.meta || {};

    validateLead_(lead);
    appendLead_(row);
    sendNotification_(lead, row, meta);
    sendAcknowledgement_(lead);

    return jsonResponse({ ok: true, message: 'Lead processed' }, 200);
  } catch (error) {
    console.error(error);
    return jsonResponse({ ok: false, message: error.message || 'Unexpected error' }, 500);
  }
}

function validateLead_(lead) {
  const required = ['form_type', 'source_page', 'nombre', 'email', 'telefono', 'empresa', 'desafio'];
  required.forEach(function (field) {
    if (!String(lead[field] || '').trim()) {
      throw new Error('Missing required field: ' + field);
    }
  });
}

function buildRowFromLead_(lead) {
  return [
    timestamp_(),
    'new',
    lead.form_type || '',
    lead.source_page || '',
    lead.source_campaign || '',
    lead.nombre || '',
    lead.email || '',
    lead.telefono || '',
    lead.empresa || '',
    lead.empleados || '',
    lead.ayuda || '',
    lead.desafio || '',
    lead.otroAyuda || '',
    JSON.stringify(lead),
    '',
    ''
  ];
}

function appendLead_(row) {
  const spreadsheet = SpreadsheetApp.openById(CONFIG.sheetId);
  const sheet = spreadsheet.getSheetByName(CONFIG.sheetName);
  if (!sheet) {
    throw new Error('Sheet not found: ' + CONFIG.sheetName);
  }

  ensureHeaders_(sheet);
  sheet.appendRow(row);
}

function ensureHeaders_(sheet) {
  const width = HEADERS.length;
  const lastRow = sheet.getLastRow();

  if (lastRow === 0) {
    sheet.getRange(1, 1, 1, width).setValues([HEADERS]);
    styleHeaderRow_(sheet, width);
    return;
  }

  const firstRow = sheet.getRange(1, 1, 1, width).getValues()[0];
  const matches = HEADERS.every(function (header, index) {
    return String(firstRow[index] || '').trim() === header;
  });

  if (!matches) {
    sheet.insertRowBefore(1);
    sheet.getRange(1, 1, 1, width).setValues([HEADERS]);
    styleHeaderRow_(sheet, width);
  }
}

function styleHeaderRow_(sheet, width) {
  sheet.getRange(1, 1, 1, width)
    .setFontWeight('bold')
    .setBackground('#0f172a')
    .setFontColor('#ffffff');
}

function sendNotification_(lead, row, meta) {
  const subjectPrefix = lead.form_type === 'demo_request' ? '[Demo]' : '[Lead]';
  const subject = subjectPrefix + ' Nuevo lead desde ' + (lead.source_page || 'tbcs.com.mx');

  const lines = [
    'Se recibi\u00f3 un nuevo lead en tbcs.com.mx',
    '',
    'Tipo de formulario: ' + safe_(lead.form_type),
    'P\u00e1gina origen: ' + safe_(lead.source_page),
    'Campa\u00f1a: ' + safe_(lead.source_campaign),
    'Nombre: ' + safe_(lead.nombre),
    'Email: ' + safe_(lead.email),
    'Tel\u00e9fono: ' + safe_(lead.telefono),
    'Empresa / consultorio: ' + safe_(lead.empresa),
    'Rango de empleados: ' + safe_(lead.empleados),
    'Inter\u00e9s: ' + safe_(lead.ayuda),
    'Descripci\u00f3n: ' + safe_(lead.desafio),
    'Notas: ' + safe_(lead.otroAyuda),
    '',
    'Fecha GMT: ' + (row[0] || ''),
    'Sitio: ' + safe_(meta.site),
    'Procesado por Apps Script: ' + timestamp_()
  ];

  MailApp.sendEmail({
    to: CONFIG.notificationEmails.join(','),
    subject: subject,
    body: lines.join('\n')
  });
}

function sendAcknowledgement_(lead) {
  const email = String(lead.email || '').trim();
  if (!email) {
    return;
  }

  const isDemo = safe_(lead.form_type) === 'demo_request';
  const subject = isDemo
    ? 'Recibimos tu solicitud de demo | TechBridge Consulting Systems'
    : 'Recibimos tu mensaje | TechBridge Consulting Systems';

  const contactUrl = 'https://www.tbcs.com.mx/contacto.php';
  const logoUrl = 'https://www.tbcs.com.mx/img/tbcs_light.png';
  const title = isDemo ? 'Recibimos tu solicitud de demo' : 'Recibimos tu mensaje';
  const intro = isDemo
    ? 'Gracias por compartir tu informaci\u00f3n. Nuestro equipo ya recibi\u00f3 tu solicitud y se pondr\u00e1 en contacto contigo para coordinar los siguientes pasos.'
    : 'Gracias por escribirnos. Nuestro equipo ya recibi\u00f3 tu informaci\u00f3n y se pondr\u00e1 en contacto contigo a la brevedad.';
  const detailLabel = isDemo ? 'Inter\u00e9s principal' : 'Servicio de inter\u00e9s';

  const htmlBody = [
    '<div style="margin:0;padding:24px;background:#eef3f8;font-family:Arial,Helvetica,sans-serif;color:#0f172a;">',
    '<table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:640px;margin:0 auto;background:#0f172a;border-radius:20px;overflow:hidden;">',
    '<tr><td style="padding:28px 32px;background:linear-gradient(135deg,#0f172a 0%,#1e3a5f 100%);text-align:left;">',
    '<img src="' + logoUrl + '" alt="TechBridge Consulting Systems" style="height:42px;display:block;margin-bottom:20px;">',
    '<div style="font-size:12px;letter-spacing:1.4px;text-transform:uppercase;color:#93c5fd;font-weight:700;">TechBridge Consulting Systems</div>',
    '<h1 style="margin:12px 0 0;font-size:28px;line-height:1.2;color:#ffffff;">' + escapeHtml_(title) + '</h1>',
    '</td></tr>',
    '<tr><td style="padding:32px;background:#ffffff;">',
    '<p style="margin:0 0 18px;font-size:16px;line-height:1.7;color:#1f2937;">Hola ' + escapeHtml_(safe_(lead.nombre)) + ',</p>',
    '<p style="margin:0 0 24px;font-size:15px;line-height:1.8;color:#334155;">' + escapeHtml_(intro) + '</p>',
    '<div style="border:1px solid #dbe7f3;border-radius:16px;padding:20px 22px;background:#f8fbff;">',
    '<div style="font-size:13px;font-weight:700;color:#1d4ed8;text-transform:uppercase;letter-spacing:.08em;margin-bottom:14px;">Resumen de tu solicitud</div>',
    '<p style="margin:0 0 8px;font-size:14px;color:#0f172a;"><strong>Nombre:</strong> ' + escapeHtml_(safe_(lead.nombre)) + '</p>',
    '<p style="margin:0 0 8px;font-size:14px;color:#0f172a;"><strong>Email:</strong> ' + escapeHtml_(safe_(lead.email)) + '</p>',
    '<p style="margin:0 0 8px;font-size:14px;color:#0f172a;"><strong>Tel\u00e9fono:</strong> ' + escapeHtml_(safe_(lead.telefono)) + '</p>',
    '<p style="margin:0 0 8px;font-size:14px;color:#0f172a;"><strong>Empresa / consultorio:</strong> ' + escapeHtml_(safe_(lead.empresa)) + '</p>',
    '<p style="margin:0 0 8px;font-size:14px;color:#0f172a;"><strong>' + escapeHtml_(detailLabel) + ':</strong> ' + escapeHtml_(safe_(lead.ayuda)) + '</p>',
    '<p style="margin:0;font-size:14px;color:#0f172a;"><strong>Descripci\u00f3n:</strong> ' + escapeHtml_(safe_(lead.desafio)) + '</p>',
    '</div>',
    '<p style="margin:24px 0 0;font-size:15px;line-height:1.8;color:#334155;">Si necesitas agregar informaci\u00f3n adicional, puedes responder a este correo o escribirnos desde nuestro m\u00f3dulo de contacto.</p>',
    '<div style="margin-top:28px;">',
    '<a href="' + contactUrl + '" style="display:inline-block;padding:14px 22px;background:#0f172a;color:#ffffff;text-decoration:none;border-radius:999px;font-size:14px;font-weight:700;">Ir a contacto TBCS</a>',
    '</div>',
    '</td></tr>',
    '<tr><td style="padding:18px 32px;background:#f8fbff;border-top:1px solid #dbe7f3;color:#475569;font-size:12px;line-height:1.7;">',
    'TechBridge Consulting Systems<br>comercial@tbcs.com.mx | +52 55 9111 1918',
    '</td></tr>',
    '</table>',
    '</div>'
  ].join('');

  const textBody = [
    'Hola ' + safe_(lead.nombre) + ',',
    '',
    title + '.',
    intro,
    '',
    'Resumen de tu solicitud:',
    'Nombre: ' + safe_(lead.nombre),
    'Email: ' + safe_(lead.email),
    'Tel\u00e9fono: ' + safe_(lead.telefono),
    'Empresa / consultorio: ' + safe_(lead.empresa),
    detailLabel + ': ' + safe_(lead.ayuda),
    'Descripci\u00f3n: ' + safe_(lead.desafio),
    '',
    'Contacto: ' + contactUrl
  ].join('\n');

  MailApp.sendEmail({
    to: email,
    subject: subject,
    body: textBody,
    htmlBody: htmlBody,
    name: 'TechBridge Consulting Systems',
    replyTo: 'comercial@tbcs.com.mx'
  });
}

function jsonResponse(payload, status) {
  const output = ContentService
    .createTextOutput(JSON.stringify(payload))
    .setMimeType(ContentService.MimeType.JSON);

  if (typeof output.setHeader === 'function') {
    output.setHeader('X-Status-Code', String(status || 200));
  }

  return output;
}

function safe_(value) {
  return String(value || '').trim() || '-';
}

function escapeHtml_(value) {
  return String(value || '')
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#39;');
}

function timestamp_() {
  return Utilities.formatDate(new Date(), 'GMT', 'yyyy-MM-dd HH:mm:ss');
}

function testDoPost() {
  const mock = {
    postData: {
      contents: JSON.stringify({
        token: CONFIG.token,
        lead: {
          form_type: 'demo_request',
          source_page: 'nexora-health',
          source_campaign: 'demo-erp-medico',
          nombre: 'Jonathan Perez',
          email: 'comercial@tbcs.com.mx',
          telefono: '5512345678',
          empresa: 'Consultorio Demo',
          empleados: '1-25',
          ayuda: 'Dise\u00f1o de Software',
          desafio: 'Solicito una demo para revisar el flujo cl\u00ednico.',
          otroAyuda: 'Lead de prueba'
        },
        meta: {
          site: 'tbcs.com.mx'
        }
      })
    }
  };

  const response = doPost(mock);
  Logger.log(response.getContent());
}
