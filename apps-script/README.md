# Apps Script Leads

Archivo principal:
- `tbcs-leads.gs`

## Que hace

- Recibe leads desde `api/contact.php`
- Guarda cada lead en Google Sheets
- Envia notificacion por correo cuando llega un lead nuevo

## Configuracion rapida

1. Crea un proyecto de Google Apps Script.
2. Copia el contenido de `tbcs-leads.gs`.
3. Ajusta en `CONFIG`:
   - `sheetId`
   - `sheetName`
   - `token`
   - `notificationEmails`
4. Despliega como `Web app`.
5. Copia la URL del despliegue y pegala en `.env` como `TBCS_APPS_SCRIPT_URL`.
6. Usa el mismo token en `.env` como `TBCS_APPS_SCRIPT_TOKEN`.

## Permisos sugeridos

- Execute as: `Me`
- Who has access: `Anyone`

## Hoja esperada

Se recomienda una hoja `Leads` con columnas A:P para coincidir con el payload actual.
