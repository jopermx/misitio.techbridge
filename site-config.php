<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=UTF-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

function loadDotEnv(string $path): void
{
    if (!is_file($path)) {
        return;
    }
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines === false) {
        return;
    }
    foreach ($lines as $line) {
        $line = ltrim(trim($line), "\xEF\xBB\xBF");
        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }
        $parts = explode('=', $line, 2);
        if (count($parts) !== 2) {
            continue;
        }
        $key = trim($parts[0]);
        $value = trim($parts[1]);
        if ($key === '') {
            continue;
        }
        if (
            (str_starts_with($value, '"') && str_ends_with($value, '"')) ||
            (str_starts_with($value, "'") && str_ends_with($value, "'"))
        ) {
            $value = substr($value, 1, -1);
        }
        if (getenv($key) === false) {
            putenv($key . '=' . $value);
            $_ENV[$key] = $value;
        }
    }
}

function envValue(string $key): string
{
    $value = getenv($key);
    return $value === false ? '' : (string)$value;
}

loadDotEnv(__DIR__ . '/.env');

$payload = [
    'branding' => [
        'logoMain' => envValue('TBCS_BRAND_LOGO_MAIN'),
        'logoIcon' => envValue('TBCS_BRAND_LOGO_ICON'),
    ],
    'contact' => [
        'phone1' => envValue('TBCS_CONTACT_PHONE1'),
        'phone1Href' => envValue('TBCS_CONTACT_PHONE1_HREF'),
        'phone2' => envValue('TBCS_CONTACT_PHONE2'),
        'phone2Href' => envValue('TBCS_CONTACT_PHONE2_HREF'),
        'email' => envValue('TBCS_CONTACT_EMAIL'),
        'emailHref' => envValue('TBCS_CONTACT_EMAIL_HREF'),
        'location' => envValue('TBCS_CONTACT_LOCATION'),
    ],
    'whatsapp' => [
        'number' => envValue('TBCS_WHATSAPP_NUMBER'),
        'message' => envValue('TBCS_WHATSAPP_MESSAGE'),
    ],
];

echo json_encode($payload, JSON_UNESCAPED_UNICODE);

