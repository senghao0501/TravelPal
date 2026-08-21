<?php

/*
 * TravelPal Attractions - Booking.com RapidAPI
 *
 * Put your key in attractions/config.local.php.
 * Do not commit config.local.php to GitHub.
 */

$configFile = __DIR__ . '/config.local.php';

if (is_file($configFile)) {
    require_once $configFile;
}

if (!defined('RAPIDAPI_KEY')) {
    define('RAPIDAPI_KEY', getenv('RAPIDAPI_KEY') ?: 'YOUR_RAPIDAPI_KEY');
}

if (!defined('RAPIDAPI_HOST')) {
    define('RAPIDAPI_HOST', 'booking-com15.p.rapidapi.com');
}

if (!defined('ATTRACTION_API_BASE_URL')) {
    define(
        'ATTRACTION_API_BASE_URL',
        'https://' . RAPIDAPI_HOST . '/api/v1/attraction/'
    );
}

function isAttractionApiConfigured(): bool
{
    $key = trim((string) RAPIDAPI_KEY);

    return $key !== ''
        && $key !== 'YOUR_RAPIDAPI_KEY'
        && stripos($key, 'PASTE_') === false
        && stripos($key, '在这里') === false;
}

function attractionArrayValue(array $array, array $paths, $default = null)
{
    foreach ($paths as $path) {
        $value = $array;
        $found = true;

        foreach (explode('.', $path) as $segment) {
            if (!is_array($value) || !array_key_exists($segment, $value)) {
                $found = false;
                break;
            }

            $value = $value[$segment];
        }

        if ($found && $value !== null && $value !== '') {
            return $value;
        }
    }

    return $default;
}

/* ==================== Simple file cache ==================== */

function attractionCacheDirectory(): string
{
    static $directory = null;

    if ($directory !== null) {
        return $directory;
    }

    $directory = __DIR__ . '/cache';

    if (!is_dir($directory)) {
        @mkdir($directory, 0775, true);
    }

    if (!is_dir($directory) || !is_writable($directory)) {
        $directory = sys_get_temp_dir()
            . DIRECTORY_SEPARATOR
            . 'travelpal-attractions-cache';

        if (!is_dir($directory)) {
            @mkdir($directory, 0775, true);
        }
    }

    return $directory;
}

function attractionCacheFile(string $key): string
{
    return attractionCacheDirectory()
        . DIRECTORY_SEPARATOR
        . sha1($key)
        . '.json';
}

function attractionReadCache(string $key, bool $allowExpired = false): ?array
{
    $file = attractionCacheFile($key);

    if (!is_file($file)) {
        return null;
    }

    $payload = json_decode((string) @file_get_contents($file), true);

    if (!is_array($payload) || !isset($payload['data'])) {
        return null;
    }

    if (!$allowExpired && (int) ($payload['expires_at'] ?? 0) < time()) {
        return null;
    }

    return is_array($payload['data']) ? $payload['data'] : null;
}

function attractionWriteCache(string $key, array $data, int $seconds): void
{
    $payload = json_encode(
        [
            'expires_at' => time() + max(60, $seconds),
            'data' => $data
        ],
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
    );

    if ($payload !== false) {
        @file_put_contents(attractionCacheFile($key), $payload, LOCK_EX);
    }
}

/* ==================== RapidAPI request ==================== */

function callAttractionAPI(
    string $endpoint,
    array $params = [],
    int $cacheSeconds = 900
): array {
    if (!isAttractionApiConfigured()) {
        return ['error' => true, 'code' => 'api_not_configured'];
    }

    $endpoint = ltrim($endpoint, '/');
    $query = http_build_query($params, '', '&', PHP_QUERY_RFC3986);
    $cacheKey = 'rapidapi:' . $endpoint . ':' . $query;
    $cached = attractionReadCache($cacheKey);

    if ($cached !== null) {
        return $cached;
    }

    $stale = attractionReadCache($cacheKey, true);
    $url = ATTRACTION_API_BASE_URL . $endpoint;

    if ($query !== '') {
        $url .= '?' . $query;
    }

    $curl = curl_init();
    $options = [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => '',
        CURLOPT_CONNECTTIMEOUT => 8,
        CURLOPT_TIMEOUT => 25,
        CURLOPT_MAXREDIRS => 3,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Accept: application/json',
            'x-rapidapi-host: ' . RAPIDAPI_HOST,
            'x-rapidapi-key: ' . RAPIDAPI_KEY
        ]
    ];

    /* Download https://curl.se/ca/cacert.pem into this folder if WAMP needs it. */
    $caFile = __DIR__ . '/cacert.pem';

    if (is_file($caFile)) {
        $options[CURLOPT_CAINFO] = $caFile;
    }

    curl_setopt_array($curl, $options);
    $response = curl_exec($curl);
    $curlError = curl_error($curl);
    $httpCode = (int) curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ($response === false || $curlError !== '') {
        return $stale ?? [
            'error' => true,
            'code' => 'curl_error',
            'message' => $curlError
        ];
    }

    $decoded = json_decode($response, true);

    if (!is_array($decoded)) {
        return $stale ?? ['error' => true, 'code' => 'invalid_json'];
    }

    if ($httpCode === 429) {
        return $stale ?? ['error' => true, 'code' => 'rate_limited'];
    }

    if ($httpCode < 200 || $httpCode >= 300) {
        return $stale ?? [
            'error' => true,
            'code' => 'http_error',
            'http_status' => $httpCode
        ];
    }

    if (($decoded['status'] ?? true) === false) {
        return $stale ?? ['error' => true, 'code' => 'api_error'];
    }

    attractionWriteCache($cacheKey, $decoded, $cacheSeconds);
    return $decoded;
}

/* ==================== Booking.com endpoints ==================== */

function searchAttractionLocation(
    string $query,
    string $languageCode = 'en-us'
): array {
    return callAttractionAPI(
        'searchLocation',
        [
            'query' => trim($query),
            'languagecode' => $languageCode
        ],
        2592000
    );
}

function searchAttractions(
    string $locationId,
    string $sortBy = 'trending',
    int $page = 1,
    string $currencyCode = 'MYR',
    string $languageCode = 'en-us'
): array {
    return callAttractionAPI(
        'searchAttractions',
        [
            'id' => $locationId,
            'sortBy' => $sortBy,
            'page' => max(1, $page),
            'currency_code' => $currencyCode,
            'languagecode' => $languageCode
        ],
        1800
    );
}

function getAttractionAvailabilityCalendar(
    string $id,
    string $languageCode = 'en-us'
): array {
    return callAttractionAPI(
        'getAvailabilityCalendar',
        ['id' => $id, 'languagecode' => $languageCode],
        900
    );
}

function getAttractionAvailability(
    string $slug,
    string $currencyCode = 'MYR',
    string $languageCode = 'en-us'
): array {
    return callAttractionAPI(
        'getAvailability',
        [
            'slug' => $slug,
            'currency_code' => $currencyCode,
            'languagecode' => $languageCode
        ],
        300
    );
}

function getAttractionDetails(
    string $slug,
    string $currencyCode = 'MYR'
): array {
    if (trim($slug) === '') {
        return ['error' => true, 'code' => 'missing_slug'];
    }

    return callAttractionAPI(
        'getAttractionDetails',
        ['slug' => $slug, 'currency_code' => $currencyCode],
        86400
    );
}

function getAttractionReviews(string $id, int $page = 1): array
{
    return callAttractionAPI(
        'getAttractionReviews',
        ['id' => $id, 'page' => max(1, $page)],
        3600
    );
}

function extractAttractionLocationId(array $response): ?string
{
    $direct = attractionArrayValue(
        $response,
        ['data.id', 'id', 'data.locationId', 'locationId']
    );

    if ($direct !== null) {
        return (string) $direct;
    }

    $groups = [
        $response['data']['destinations'] ?? [],
        $response['data']['products'] ?? [],
        $response['destinations'] ?? [],
        $response['products'] ?? []
    ];

    foreach ($groups as $group) {
        if (!is_array($group)) {
            continue;
        }

        foreach ($group as $item) {
            if (!is_array($item)) {
                continue;
            }

            $id = attractionArrayValue(
                $item,
                ['id', 'locationId', 'dest_id', 'ufi']
            );

            if ($id !== null) {
                return (string) $id;
            }
        }
    }

    return null;
}

/* ==================== Normalize and classify ==================== */

function normalizeApiAttraction(array $product, array $region): ?array
{
    $name = trim((string) attractionArrayValue(
        $product,
        ['title', 'name', 'productName'],
        ''
    ));

    if ($name === '') {
        return null;
    }

    $slug = (string) attractionArrayValue(
        $product,
        ['slug', 'productSlug'],
        ''
    );

    $productId = (string) attractionArrayValue(
        $product,
        ['id', 'productId'],
        ''
    );

    $image = (string) attractionArrayValue(
        $product,
        [
            'primaryPhoto.large',
            'primaryPhoto.medium',
            'primaryPhoto.small',
            'representativePhoto.photoUri',
            'image'
        ],
        '/TravelPal/images/attractions_image/attraction-placeholder.jpg'
    );

    $rating = attractionArrayValue(
        $product,
        [
            'reviewsStats.combinedNumericStats.average',
            'reviewsStats.average',
            'rating'
        ],
        'N/A'
    );

    $reviewCount = (int) attractionArrayValue(
        $product,
        [
            'reviewsStats.allReviewsCount',
            'reviewsStats.totalCount',
            'reviewCount'
        ],
        0
    );

    $amount = attractionArrayValue(
        $product,
        ['representativePrice.chargeAmount', 'price.amount']
    );

    $currency = (string) attractionArrayValue(
        $product,
        ['representativePrice.currency', 'price.currency'],
        'MYR'
    );

    $location = (string) ($region['label'] ?? $region['name'] ?? 'Malaysia');

    return [
        'id' => 'api-' . sha1($slug ?: ($productId ?: $name)),
        'api_id' => $productId,
        'name' => $name,
        'slug' => $slug,
        'type' => 'Heritage & Culture',
        'price' => $amount !== null ? $currency . ' ' . $amount : 'Check price',
        'rating' => $rating,
        'review_count' => $reviewCount,
        'image' => $image,
        'description' => 'Discover this popular experience in ' . $location . '.',
        'activities' => [
            'Explore the attraction at your own pace',
            'Discover the highlights of the destination',
            'Enjoy a memorable Malaysian experience'
        ],
        'hours' => 'Check the latest opening information before visiting',
        'duration' => 'Varies by experience',
        'best_for' => 'Couples, families and independent travellers',
        'region_key' => (string) ($region['key'] ?? ''),
        'state' => (string) ($region['name'] ?? $location),
        'city' => (string) ($region['city'] ?? ''),
        'location' => $location,
        'query' => (string) ($region['query'] ?? $location),
        'source' => 'api'
    ];
}

function classifyApiAttraction(array $product, array $item): string
{
    $text = strtolower(
        ($item['name'] ?? '') . ' '
        . ($item['description'] ?? '') . ' '
        . (json_encode($product, JSON_UNESCAPED_UNICODE) ?: '')
    );

    $themeWords = [
        'theme park', 'waterpark', 'water park', 'amusement',
        'adventure park', 'indoor park', 'escape park',
        'legoland', 'sunway lagoon', 'skyworlds', 'skytropolis'
    ];

    foreach ($themeWords as $word) {
        if (str_contains($text, $word)) {
            return 'Theme Parks';
        }
    }

    $natureWords = [
        'nature', 'wildlife', 'rainforest', 'forest', 'island',
        'beach', 'mountain', 'hill', 'national park', 'garden',
        'cave', 'waterfall', 'zoo', 'orangutan', 'river',
        'marine', 'mangrove', 'wetland', 'botanical'
    ];

    foreach ($natureWords as $word) {
        if (str_contains($text, $word)) {
            return 'Nature & Wildlife';
        }
    }

    return 'Heritage & Culture';
}

/*
 * Loads up to $limit API attractions for one selected state.
 * It does not force 50 results. If the API returns 18, 18 are shown.
 * Only when no API result is usable will it return that state's local items.
 */
function loadAttractionsForRegion(
    string $regionKey,
    array $region,
    int $limit = 50
): array {
    $limit = max(1, min(50, $limit));
    $region['key'] = $regionKey;
    $resultCacheKey = 'region-results-v3:' . $regionKey . ':' . $limit;
    $cached = attractionReadCache($resultCacheKey);

    if ($cached !== null) {
        return $cached;
    }

    if (!isAttractionApiConfigured()) {
        return getLocalAttractionsForRegion($regionKey);
    }

    $locationResponse = searchAttractionLocation((string) $region['query']);

    if (isset($locationResponse['error'])) {
        return attractionReadCache($resultCacheKey, true)
            ?? getLocalAttractionsForRegion($regionKey);
    }

    $locationId = extractAttractionLocationId($locationResponse);

    if ($locationId === null) {
        return attractionReadCache($resultCacheKey, true)
            ?? getLocalAttractionsForRegion($regionKey);
    }

    $results = [];
    $used = [];
    $maximumPages = 10;

    for ($page = 1; $page <= $maximumPages; $page++) {
        $response = searchAttractions(
            $locationId,
            'trending',
            $page,
            'MYR',
            'en-us'
        );

        if (isset($response['error'])) {
            break;
        }

        $products = attractionArrayValue(
            $response,
            ['data.products', 'products', 'data.data.products'],
            []
        );

        if (!is_array($products) || $products === []) {
            break;
        }

        foreach ($products as $product) {
            if (!is_array($product)) {
                continue;
            }

            $item = normalizeApiAttraction($product, $region);

            /* A slug is required so that detail.php can request full details. */
            if ($item === null || $item['slug'] === '') {
                continue;
            }

            $uniqueKey = $item['slug'];

            if (isset($used[$uniqueKey])) {
                continue;
            }

            $used[$uniqueKey] = true;
            $item['type'] = classifyApiAttraction($product, $item);
            $results[] = $item;

            attractionWriteCache(
                'search-attraction:' . sha1($item['slug']),
                $item,
                86400
            );

            if (count($results) >= $limit) {
                break 2;
            }
        }

        usleep(250000);
    }

    if ($results === []) {
        return attractionReadCache($resultCacheKey, true)
            ?? getLocalAttractionsForRegion($regionKey);
    }

    attractionWriteCache($resultCacheKey, $results, 1800);
    return $results;
}

/* Must-Visit remains the original two local items per state. */
function getMustVisitAttractions(array $regions, int $perRegion = 2): array
{
    $results = [];

    foreach ($regions as $regionKey => $region) {
        $items = array_slice(
            getLocalAttractionsForRegion((string) $regionKey),
            0,
            max(1, $perRegion)
        );

        $results = array_merge($results, $items);
    }

    return $results;
}

function findCachedApiAttractionBySlug(string $slug): ?array
{
    return attractionReadCache(
        'search-attraction:' . sha1($slug),
        true
    );
}

function normalizeApiAttractionDetails(
    array $response,
    string $slug,
    ?array $fallback = null
): ?array {
    if (isset($response['error'])) {
        return $fallback;
    }

    $data = $response['data'] ?? $response;

    if (isset($data['product']) && is_array($data['product'])) {
        $data = $data['product'];
    }

    if (!is_array($data)) {
        return $fallback;
    }

    $base = $fallback ?? [
        'id' => 'api-' . sha1($slug),
        'name' => 'Malaysian Attraction',
        'type' => 'Heritage & Culture',
        'price' => 'Check price',
        'rating' => 'N/A',
        'review_count' => 0,
        'image' => '/TravelPal/images/attractions_image/attraction-placeholder.jpg',
        'description' => 'Explore this Malaysian attraction.',
        'activities' => [
            'Explore the attraction',
            'Discover the destination highlights',
            'Plan your visit in advance'
        ],
        'hours' => 'Check the latest opening information before visiting',
        'duration' => 'Varies',
        'best_for' => 'All travellers',
        'location' => 'Malaysia',
        'query' => 'Malaysia'
    ];

    $base['id'] = 'api-' . sha1($slug);
    $base['slug'] = $slug;
    $base['name'] = (string) attractionArrayValue(
        $data,
        ['title', 'name', 'productName'],
        $base['name']
    );

    $description = attractionArrayValue(
        $data,
        ['description', 'shortDescription', 'about'],
        $base['description']
    );

    if (is_string($description)) {
        $base['description'] = $description;
    }

    $base['image'] = (string) attractionArrayValue(
        $data,
        [
            'primaryPhoto.large',
            'primaryPhoto.medium',
            'primaryPhoto.small',
            'representativePhoto.photoUri',
            'image'
        ],
        $base['image']
    );

    $base['rating'] = attractionArrayValue(
        $data,
        [
            'reviewsStats.combinedNumericStats.average',
            'reviewsStats.average',
            'rating'
        ],
        $base['rating']
    );

    $base['review_count'] = (int) attractionArrayValue(
        $data,
        [
            'reviewsStats.allReviewsCount',
            'reviewsStats.totalCount',
            'reviewCount'
        ],
        $base['review_count']
    );

    $amount = attractionArrayValue(
        $data,
        ['representativePrice.chargeAmount', 'price.amount']
    );

    if ($amount !== null) {
        $currency = (string) attractionArrayValue(
            $data,
            ['representativePrice.currency', 'price.currency'],
            'MYR'
        );

        $base['price'] = $currency . ' ' . $amount;
    }

    $base['source'] = 'api';
    return $base;
}
