<?php

declare(strict_types=1);

ini_set('display_errors', '0');
header('Content-Type: application/json; charset=UTF-8');

function respond(int $status, bool $ok, string $message, array $extra = []): void
{
    http_response_code($status);
    echo json_encode(array_merge(['ok' => $ok, 'message' => $message], $extra), JSON_UNESCAPED_UNICODE);
    exit;
}

function cleanText(?string $value, int $maxLength = 255): string
{
    $value = trim((string)$value);
    $value = strip_tags($value);
    $value = preg_replace('/\s+/u', ' ', $value) ?? '';
    if (mb_strlen($value) > $maxLength) {
        $value = mb_substr($value, 0, $maxLength);
    }
    return $value;
}

function getClientIp(): string
{
    $keys = ['HTTP_CF_CONNECTING_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'];
    foreach ($keys as $key) {
        if (!empty($_SERVER[$key])) {
            $raw = explode(',', (string)$_SERVER[$key])[0];
            return trim($raw);
        }
    }
    return '0.0.0.0';
}

function rateLimit(string $key, int $window, int $max): bool
{
    $file = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'tbcs_rate_limit.json';
    $now = time();

    $fp = fopen($file, 'c+');
    if ($fp === false) {
        return true;
    }

    flock($fp, LOCK_EX);
    $raw = stream_get_contents($fp);
    $data = json_decode($raw ?: '{}', true);
    if (!is_array($data)) {
        $data = [];
    }

    foreach ($data as $k => $timestamps) {
        if (!is_array($timestamps)) {
            unset($data[$k]);
            continue;
        }
        $data[$k] = array_values(array_filter($timestamps, static function ($ts) use ($now, $window) {
            return is_int($ts) && $ts >= ($now - $window);
        }));
        if (!$data[$k]) {
            unset($data[$k]);
        }
    }

    $bucket = $data[$key] ?? [];
    if (count($bucket) >= $max) {
        ftruncate($fp, 0);
        rewind($fp);
        fwrite($fp, json_encode($data));
        fflush($fp);
        flock($fp, LOCK_UN);
        fclose($fp);
        return false;
    }

    $bucket[] = $now;
    $data[$key] = $bucket;

    ftruncate($fp, 0);
    rewind($fp);
    fwrite($fp, json_encode($data));
    fflush($fp);
    flock($fp, LOCK_UN);
    fclose($fp);

    return true;
}

function base64UrlEncode(string $value): string
{
    return rtrim(strtr(base64_encode($value), '+/', '-_'), '=');
}

function parseHttpStatusCode(array $headers): int
{
    if (!$headers) {
        return 0;
    }

    $line = (string)$headers[0];
    if (preg_match('/\s(\d{3})\s/', $line, $matches) === 1) {
        return (int)$matches[1];
    }

    return 0;
}

function httpPostForm(string $url, string $body): array
{
    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => $body,
            'ignore_errors' => true,
            'timeout' => 20,
        ],
    ]);

    $response = file_get_contents($url, false, $context);
    $headers = $http_response_header ?? [];

    return [
        'status' => parseHttpStatusCode($headers),
        'body' => $response === false ? '' : $response,
    ];
}

function httpPostJson(string $url, array $payload, array $headers = []): array
{
    $headerLines = array_merge(['Content-Type: application/json; charset=UTF-8'], $headers);
    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => implode("\r\n", $headerLines) . "\r\n",
            'content' => json_encode($payload, JSON_UNESCAPED_UNICODE),
            'ignore_errors' => true,
            'timeout' => 20,
        ],
    ]);

    $response = file_get_contents($url, false, $context);
    $responseHeaders = $http_response_header ?? [];

    return [
        'status' => parseHttpStatusCode($responseHeaders),
        'body' => $response === false ? '' : $response,
    ];
}

function getGoogleAccessToken(array $config): string
{
    $privateKey = str_replace('\\n', "\n", $config['google_service_account_private_key']);
    $now = time();

    $header = base64UrlEncode(json_encode(['alg' => 'RS256', 'typ' => 'JWT']));
    $claimSet = base64UrlEncode(json_encode([
        'iss' => $config['google_service_account_email'],
        'sub' => $config['google_service_account_email'],
        'scope' => 'https://www.googleapis.com/auth/spreadsheets',
        'aud' => 'https://oauth2.googleapis.com/token',
        'iat' => $now,
        'exp' => $now + 3600,
    ]));

    $unsigned = $header . '.' . $claimSet;
    $signature = '';
    $signed = openssl_sign($unsigned, $signature, $privateKey, OPENSSL_ALGO_SHA256);
    if (!$signed) {
        throw new RuntimeException('No se pudo firmar el token OAuth de Google.');
    }

    $jwt = $unsigned . '.' . base64UrlEncode($signature);
    $tokenResponse = httpPostForm(
        'https://oauth2.googleapis.com/token',
        http_build_query([
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion' => $jwt,
        ])
    );

    if ($tokenResponse['status'] < 200 || $tokenResponse['status'] >= 300) {
        throw new RuntimeException('Google OAuth rechazo el token.');
    }

    $tokenData = json_decode($tokenResponse['body'], true);
    if (!is_array($tokenData) || empty($tokenData['access_token'])) {
        throw new RuntimeException('Respuesta invalida de Google OAuth.');
    }

    return (string)$tokenData['access_token'];
}

function appendLeadToGoogleSheet(array $config, array $row): void
{
    $accessToken = getGoogleAccessToken($config);

    $range = rawurlencode($config['google_sheet_name'] . '!A:P');
    $url = sprintf(
        'https://sheets.googleapis.com/v4/spreadsheets/%s/values/%s:append?valueInputOption=RAW&insertDataOption=INSERT_ROWS',
        rawurlencode($config['google_sheet_id']),
        $range
    );

    $response = httpPostJson(
        $url,
        ['values' => [$row]],
        ['Authorization: Bearer ' . $accessToken]
    );

    if ($response['status'] < 200 || $response['status'] >= 300) {
        throw new RuntimeException('No se pudo guardar en Google Sheets.');
    }
}

try {
    $config = require __DIR__ . '/config.php';
} catch (Throwable $e) {
    error_log('[tbcs/config] ' . $e->getMessage());
    respond(500, false, 'Configuracion incompleta del servidor.');
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    respond(405, false, 'Metodo no permitido.');
}

if (!empty($_POST['website'])) {
    respond(200, true, 'Solicitud recibida.');
}

$ip = getClientIp();
$formType = cleanText($_POST['form_type'] ?? 'contact_lead', 40);
$rateKey = hash('sha256', $ip . '|' . $formType);
if (!rateLimit($rateKey, (int)$config['rate_limit_window'], (int)$config['rate_limit_max'])) {
    respond(429, false, 'Demasiadas solicitudes. Intenta nuevamente en unos minutos.');
}

$fullName = cleanText($_POST['nombre'] ?? '', 120);
$email = filter_var(trim((string)($_POST['email'] ?? '')), FILTER_VALIDATE_EMAIL) ?: '';
$phoneDigits = preg_replace('/\D+/', '', (string)($_POST['telefono'] ?? ''));
$phone = cleanText($phoneDigits, 20);
$company = cleanText($_POST['empresa'] ?? '', 140);
$employeeRange = cleanText($_POST['empleados'] ?? '', 40);
$serviceInterest = cleanText($_POST['ayuda'] ?? '', 500);
$challenge = cleanText($_POST['desafio'] ?? '', 1200);
$sourcePage = cleanText($_POST['source_page'] ?? '', 120);
$sourceCampaign = cleanText($_POST['source_campaign'] ?? '', 80);
$notes = cleanText($_POST['otroAyuda'] ?? '', 500);

$errors = [];
if ($fullName === '') {
    $errors[] = 'nombre';
}
if ($email === '') {
    $errors[] = 'email';
}
if ($phone === '' || strlen($phone) < 10 || strlen($phone) > 15) {
    $errors[] = 'telefono';
}
if ($company === '') {
    $errors[] = 'empresa';
}
if ($challenge === '') {
    $errors[] = 'desafio';
}
if ($formType === 'contact_lead') {
    if ($employeeRange === '') {
        $errors[] = 'empleados';
    }
    if ($serviceInterest === '') {
        $errors[] = 'ayuda';
    }
}

if ($errors) {
    respond(422, false, 'Validacion incompleta. Revisa los campos requeridos.', ['fields' => $errors]);
}

$payload = [
    'form_type' => $formType,
    'source_page' => $sourcePage,
    'source_campaign' => $sourceCampaign,
    'nombre' => $fullName,
    'email' => $email,
    'telefono' => $phone,
    'empresa' => $company,
    'empleados' => $employeeRange,
    'ayuda' => $serviceInterest,
    'desafio' => $challenge,
    'otroAyuda' => $notes
];

try {
    $row = [
        gmdate('Y-m-d H:i:s'),
        'new',
        $formType,
        $sourcePage,
        $sourceCampaign,
        $fullName,
        $email,
        $phone,
        $company,
        $employeeRange,
        $serviceInterest,
        $challenge,
        $notes,
        json_encode($payload, JSON_UNESCAPED_UNICODE),
        hash('sha256', $ip . '|' . $config['ip_hash_salt']),
        substr((string)($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 500),
    ];

    appendLeadToGoogleSheet($config, $row);

    respond(200, true, 'Mensaje enviado correctamente. Te contactaremos pronto.');
} catch (Throwable $e) {
    error_log('[tbcs/contact] ' . $e->getMessage());
    respond(500, false, 'No fue posible procesar tu solicitud por el momento.');
}
