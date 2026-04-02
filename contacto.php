<?php
$formType = trim((string)($_GET['form_type'] ?? 'contact_lead')) ?: 'contact_lead';
$sourcePage = trim((string)($_GET['source_page'] ?? 'contacto.php')) ?: 'contacto.php';
$sourceCampaign = trim((string)($_GET['source_campaign'] ?? ''));
$prefillAyuda = trim((string)($_GET['ayuda'] ?? ''));
$prefillOtro = trim((string)($_GET['otroAyuda'] ?? ''));
$isNexoraFlow = $sourcePage === 'nexora-health' || str_contains(strtolower($sourceCampaign), 'nexora');
$serviceOptions = ['Consultoría Tecnológica','Infraestructura y Redes','Transformación Digital','Power Platform','Capacitación','Diseño de Software','Invitaciones Digitales','HeadHunting','Servicios Contables'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contacto - TechBridge Consulting Systems</title>
  <meta name="description" content="Contáctanos para una consultoría gratuita. TechBridge Consulting Systems, Ciudad de México.">
  <link rel="icon" type="image/png" href="img/favicon_tbcs_black.png?v=4">
  <link rel="shortcut icon" href="img/favicon_tbcs_black.png?v=4" type="image/png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/tbcs.css">
</head>
<body>
<div id="tbcs-nav"></div>
<main>
  <section class="hero hero--sub">
    <div class="hero-grid-bg"></div>
    <div class="hero-glow"></div>
    <div class="container hero-content">
      <div style="max-width:600px;">
        <div class="label fade-up" style="margin-bottom:1.5rem;">
          <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 8.67a19.79 19.79 0 01-3.07-8.72A2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>
          Contacto
        </div>
        <h1 class="t-display fade-up delay-1"><?php echo $isNexoraFlow ? 'Solicita tu demo de Nexora Health' : 'Conectemos y transformemos juntos'; ?></h1>
        <p class="t-body fade-up delay-2" style="margin:1.25rem 0;"><?php echo $isNexoraFlow ? 'Tu solicitud llegará al flujo comercial centralizado de TBCS, con contexto de Nexora Health para dar seguimiento más rápido y ordenado.' : 'Estamos listos para ser tu socio tecnológico estratégico. Agenda una consultoría gratuita de 45 minutos y diseñamos una solución a la medida de tu empresa.'; ?></p>
      </div>
    </div>
  </section>
  <section class="section section--surface">
    <div class="container">
      <div class="contact-grid">
        <div class="fade-up">
          <div class="rule" style="margin:0 0 1.25rem;"></div>
          <h2 class="t-h2" style="margin-bottom:1.5rem;">Información de Contacto</h2>
          <div class="contact-info-item"><svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg><div><p class="t-small" style="color:var(--color-text-sub);">Ciudad de México, México</p></div></div>
          <div class="contact-info-item"><svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 8.67a19.79 19.79 0 01-3.07-8.72A2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg><div><a href="tel:+525591111918" class="t-small" style="display:block;color:var(--color-text-sub);">+52 55 9111 1918</a><a href="tel:+525662602492" class="t-small" style="display:block;color:var(--color-text-sub);">+52 56 6260 2492</a></div></div>
          <div class="contact-info-item"><svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg><div><a href="mailto:comercial@tbcs.com.mx" class="t-small" style="color:var(--color-text-sub);">comercial@tbcs.com.mx</a></div></div>
          <div class="contact-info-item"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg><div><p class="t-small" style="color:var(--color-text-sub);">Lunes a Viernes: 9:00 AM - 6:00 PM</p><p class="t-small" style="color:var(--color-text-sub);">Sábados: 9:00 AM - 2:00 PM</p><p class="t-small" style="color:var(--color-text-sub);">Soporte 24/7 para clientes con contrato</p></div></div>
          <div style="margin-top:2rem;padding:1.5rem;background:var(--color-surface-2);border:1px solid var(--color-border);border-radius:var(--radius-md);">
            <h3 class="t-h3" style="margin-bottom:1rem;"><?php echo $isNexoraFlow ? 'Demo guiada de Nexora Health' : 'Consultoría Gratuita - 45 min'; ?></h3>
            <ul class="check-list">
              <?php if ($isNexoraFlow): ?>
                <li>Recibimos tu interés como demo de Nexora Health</li><li>Te contactamos para entender tipo de consultorio y operación</li><li>Agendamos una demostración guiada del flujo principal</li><li>Registramos el lead en el mismo módulo comercial de TBCS</li>
              <?php else: ?>
                <li>Evaluamos tu situación tecnológica actual</li><li>Identificamos 3 oportunidades de mejora inmediatas</li><li>Diseñamos un roadmap personalizado</li><li>Calculamos el ROI esperado de cada iniciativa</li><li>Definimos próximos pasos concretos</li>
              <?php endif; ?>
            </ul>
            <p class="t-xs" style="color:var(--color-blue-lt);font-weight:700;margin-top:1rem;"><?php echo $isNexoraFlow ? 'SOLICITUD CENTRALIZADA. SEGUIMIENTO COMERCIAL MÁS ORDENADO.' : 'COMPLETAMENTE GRATIS. SIN COMPROMISOS.'; ?></p>
          </div>
        </div>
        <div class="fade-up delay-1">
          <div class="rule" style="margin:0 0 1.25rem;"></div>
          <h2 class="t-h2" style="margin-bottom:1.5rem;">Envíanos un Mensaje</h2>
          <form id="contactForm" action="api/contact.php" method="POST" novalidate>
            <input type="hidden" name="form_type" value="<?php echo htmlspecialchars($formType, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="source_page" value="<?php echo htmlspecialchars($sourcePage, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="source_campaign" value="<?php echo htmlspecialchars($sourceCampaign, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="text" name="website" tabindex="-1" autocomplete="off" style="position:absolute;left:-9999px;opacity:0;" aria-hidden="true">
            <div class="form-group"><label for="nombre" class="form-label">Nombre Completo</label><input type="text" id="nombre" name="nombre" class="form-input" placeholder="Tu nombre completo" required><p id="error-nombre" class="form-error">El nombre completo es obligatorio.</p></div>
            <div class="form-group"><label for="email" class="form-label">Email Empresarial</label><input type="email" id="email" name="email" class="form-input" placeholder="correo@tuempresa.com" required><p id="error-email" class="form-error">Por favor, introduce un email válido.</p></div>
            <div class="form-group"><label for="telefono" class="form-label">Teléfono</label><input type="tel" id="telefono" name="telefono" class="form-input" placeholder="10 d?gitos" required pattern="[0-9]{10,15}"><p id="error-telefono" class="form-error">El teléfono es obligatorio (10-15 dígitos).</p></div>
            <div class="form-group"><label for="empresa" class="form-label">Empresa</label><input type="text" id="empresa" name="empresa" class="form-input" placeholder="Nombre de tu empresa o consultorio" required><p id="error-empresa" class="form-error">El nombre de la empresa es obligatorio.</p></div>
            <div class="form-group"><label class="form-label">Número de Empleados</label><div class="form-radio-group"><label class="form-radio-label"><input type="radio" name="empleados" value="1-25"> 1-25</label><label class="form-radio-label"><input type="radio" name="empleados" value="26-50"> 26-50</label><label class="form-radio-label"><input type="radio" name="empleados" value="51-100"> 51-100</label><label class="form-radio-label"><input type="radio" name="empleados" value="101-500"> 101-500</label><label class="form-radio-label"><input type="radio" name="empleados" value="500+"> 500+</label></div><p id="error-empleados" class="form-error">Por favor, selecciona el número de empleados.</p></div>
            <div class="form-group"><label class="form-label">¿En qué podemos ayudarte?</label><div class="form-check-grid"><?php foreach ($serviceOptions as $service): ?><label class="form-check-label"><input type="checkbox" name="ayuda" value="<?php echo htmlspecialchars($service, ENT_QUOTES, 'UTF-8'); ?>" <?php echo $prefillAyuda === $service ? 'checked' : ''; ?>> <?php echo htmlspecialchars($service, ENT_QUOTES, 'UTF-8'); ?></label><?php endforeach; ?><label class="form-check-label"><input type="checkbox" name="ayuda" value="Otro" id="otroCheckbox" <?php echo $prefillOtro !== '' ? 'checked' : ''; ?>> Otro: <input type="text" name="otroAyuda" id="otroInput" class="form-input" value="<?php echo htmlspecialchars($prefillOtro, ENT_QUOTES, 'UTF-8'); ?>" style="display:inline;width:auto;padding:.25rem .5rem;margin-left:.25rem;" <?php echo $prefillOtro !== '' ? '' : 'disabled'; ?>></label></div><p id="error-ayuda" class="form-error">Selecciona al menos una opción.</p></div>
            <div class="form-group"><label for="desafio" class="form-label">Describe brevemente tu desafío</label><textarea id="desafio" name="desafio" class="form-textarea" placeholder="¿Qué problema quieres resolver? ¿Qué objetivo tienes?" maxlength="500"><?php echo $isNexoraFlow ? 'Me interesa una demo de Nexora Health para conocer el flujo de consulta, expediente y operación del consultorio.' : ''; ?></textarea><p id="error-desafio" class="form-error">La descripción es obligatoria.</p></div>
            <button type="submit" class="btn btn--primary" style="width:100%;justify-content:center;">Enviar mensaje<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg></button>
            <div id="form-status-message" class="form-message"></div>
          </form>
        </div>
      </div>
    </div>
  </section>
</main>
<div id="tbcs-footer"></div>
<div id="tbcs-whatsapp"></div>
<script src="js/tbcs.js"></script>
<script src="js/forms.js"></script>
</body>
</html>
