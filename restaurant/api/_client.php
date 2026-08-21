<?php

declare(strict_types=1);

const TRAVELPAL_RAPIDAPI_HOST = 'travel-advisor.p.rapidapi.com';
const TRAVELPAL_API_BASE = 'https://travel-advisor.p.rapidapi.com';

function restaurant_json_response(array $payload, int $status = 200): void
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-Control: no-store');
    echo json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    exit;
}

function restaurant_api_key(): string
{
    $key = trim((string)(getenv('TRAVELPAL_RAPIDAPI_KEY') ?: ''));
    $configPath = dirname(__DIR__, 2) . '/config.local.php';

    if ($key === '' && is_file($configPath)) {
        $config = require $configPath;
        if (is_array($config)) {
            $key = trim((string)($config['rapidapi_key'] ?? ''));
        }
    }

    if ($key === '' || str_contains($key, 'PASTE_')) {
        throw new RuntimeException('The restaurant API is not configured yet. Add your RapidAPI key to config.local.php.');
    }

    return $key;
}

function restaurant_api_post(string $path, array $body): array
{
    if (!function_exists('curl_init')) {
        throw new RuntimeException('PHP cURL is not enabled on this server. Enable the curl extension in WAMP.');
    }

    $query = http_build_query([
        'currency' => 'MYR',
        'units' => 'km',
        'lang' => 'en_US',
    ]);
    $url = TRAVELPAL_API_BASE . $path . '?' . $query;
    $curl = curl_init($url);
    $encodedBody = json_encode($body, JSON_UNESCAPED_SLASHES);

    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $encodedBody,
        CURLOPT_CONNECTTIMEOUT => 8,
        CURLOPT_TIMEOUT => 25,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'X-RapidAPI-Host: ' . TRAVELPAL_RAPIDAPI_HOST,
            'X-RapidAPI-Key: ' . restaurant_api_key(),
        ],
    ]);

    $raw = curl_exec($curl);
    $status = (int)curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $curlError = curl_error($curl);
    curl_close($curl);

	 if ($raw === false || $curlError !== '') {
		throw new RuntimeException(
			'The restaurant service could not be reached. Please try again shortly.'
		);
	}

    $decoded = json_decode($raw, true);
    if ($status < 200 || $status >= 300 || !is_array($decoded)) {
        throw new RuntimeException('The restaurant service returned an invalid response. Please try again shortly.');
    }

    if (isset($decoded['status']) && $decoded['status'] === false) {
        throw new RuntimeException('The restaurant provider could not complete this search. Try another city.');
    }

    return $decoded;
}

function restaurant_cache_read(string $key, int $ttl = 900): ?array
{
    $path = restaurant_cache_path($key);
    if (!is_file($path) || filemtime($path) < time() - $ttl) {
        return null;
    }

    $data = json_decode((string)file_get_contents($path), true);
    return is_array($data) ? $data : null;
}

function restaurant_cache_write(string $key, array $data): void
{
    $path = restaurant_cache_path($key);
    $directory = dirname($path);
    if (!is_dir($directory)) {
        @mkdir($directory, 0775, true);
    }
    @file_put_contents($path, json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE), LOCK_EX);
}

function restaurant_cache_path(string $key): string
{
    return dirname(__DIR__) . '/cache/' . preg_replace('/[^a-zA-Z0-9_-]/', '_', $key) . '.json';
}

function restaurant_future_time(): string
{
    return date('Y-m-d\\T19:00', strtotime('+1 day'));
}
