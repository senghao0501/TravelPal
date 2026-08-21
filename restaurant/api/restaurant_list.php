<?php

declare(strict_types=1);

require_once __DIR__ . '/_client.php';
require_once __DIR__ . '/_parsers.php';

try {
    $cities = require __DIR__ . '/city_data.php';
    $slug = strtolower(trim((string)($_GET['city'] ?? 'johor-bahru')));
    if (!isset($cities[$slug])) {
        restaurant_json_response(['ok' => false, 'message' => 'Please select one of the eight supported Malaysian cities.'], 422);
    }
    $partySize = max(1, min(8, (int)($_GET['party'] ?? 2)));

    $cacheKey = 'list_' . $slug . '_' . $partySize;
    $cached = restaurant_cache_read($cacheKey);
    if ($cached) {
        $cached['cached'] = true;
        restaurant_json_response(['ok' => true, 'data' => $cached]);
    }

    $city = $cities[$slug];
    $raw = restaurant_api_post('/restaurants/v2/list', [
        'geoId' => $city['geoId'],
        'partySize' => $partySize,
        'reservationTime' => restaurant_future_time(),
        'sort' => 'POPULARITY',
        'sortOrder' => 'desc',
        'filters' => [
            ['id' => 'establishment', 'value' => ['10591']],
        ],
        'boundingBox' => $city['boundingBox'],
        'updateToken' => '',
    ]);

    $data = restaurant_parse_list($raw, $city);
    restaurant_cache_write($cacheKey, $data);
    restaurant_json_response(['ok' => true, 'data' => $data]);
} catch (Throwable $error) {
    restaurant_json_response(['ok' => false, 'message' => $error->getMessage()], 502);
}
