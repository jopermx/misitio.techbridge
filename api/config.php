<?php
declare(strict_types=1);

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
        $line = trim($line);
        $line = ltrim($line, "\xEF\xBB\xBF");
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
        if ((str_starts_with($value, '"') && str_ends_with($value, '"')) || (str_starts_with($value, "'") && str_ends_with($value, "'"))) {
            $value = substr($value, 1, -1);
        }
        if (getenv($key) === false) {
            putenv($key . '=' . $value);
            $_ENV[$key] = $value;
        }
    }
}

function envRequired(string $key, bool $allowEmpty = false): string
{
    $value = getenv($key);
    if ($value === false) {
        throw new RuntimeException("Missing required env var: {$key}");
    }
    if (!$allowEmpty && trim($value) === '') {
        throw new RuntimeException("Empty required env var: {$key}");
    }
    return (string)$value;
}

function envOptional(string $key, string $default = ''): string
{
    $value = getenv($key);
    if ($value === false) {
        return $default;
    }
    return trim((string)$value);
}

function envRequiredInt(string $key): int
{
    $value = envRequired($key);
    if (!ctype_digit($value) || (int)$value <= 0) {
        throw new RuntimeException("Invalid positive integer env var: {$key}");
    }
    return (int)$value;
}

loadDotEnv(dirname(__DIR__) . '/.env');

return [
    'rate_limit_window' => envRequiredInt('TBCS_RATE_LIMIT_WINDOW'),
    'rate_limit_max' => envRequiredInt('TBCS_RATE_LIMIT_MAX'),
    'ip_hash_salt' => envRequired('TBCS_IP_SALT'),
    'apps_script_url' => envOptional('TBCS_APPS_SCRIPT_URL'),
    'apps_script_token' => envOptional('TBCS_APPS_SCRIPT_TOKEN'),
    'google_sheet_id' => envOptional('TBCS_GOOGLE_SHEET_ID'),
    'google_sheet_name' => envOptional('TBCS_GOOGLE_SHEET_NAME'),
    'google_service_account_email' => envOptional('TBCS_GOOGLE_SERVICE_ACCOUNT_EMAIL'),
    'google_service_account_private_key' => envOptional('TBCS_GOOGLE_SERVICE_ACCOUNT_PRIVATE_KEY'),
];
