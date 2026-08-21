<?php

declare(strict_types=1);

require_once __DIR__ . '/_client.php';
require_once __DIR__ . '/_parsers.php';

try {
    $id = trim((string)($_GET['id'] ?? ''));
    if ($id === '' || !preg_match('/^[0-9]+$/', $id)) {
        restaurant_json_response(['ok' => false, 'message' => 'A valid restaurant ID is required.'], 422);
    }
    $partySize = max(1, min(8, (int)($_GET['party'] ?? 2)));

    $cacheKey = 'detail_' . $id . '_' . $partySize;
    $cached = restaurant_cache_read($cacheKey);
    if ($cached) {
        $cached['cached'] = true;
        restaurant_json_response(['ok' => true, 'data' => $cached]);
    }

    $raw = restaurant_api_post('/restaurants/v2/get-details', [
        'contentId' => $id,
        'reservationTime' => restaurant_future_time(),
        'partySize' => $partySize,
    ]);

    $data = restaurant_parse_detail($raw);
    restaurant_cache_write($cacheKey, $data);
    restaurant_json_response(['ok' => true, 'data' => $data]);
} catch (Throwable $error) {
    restaurant_json_response(['ok' => false, 'message' => $error->getMessage()], 502);
}
