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
    define(
        'RAPIDAPI_KEY',
        getenv('TRAVELPAL_ATTRACTION_RAPIDAPI_KEY') ?: 'YOUR_RAPIDAPI_KEY'
    );
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
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_TIMEOUT => 45,
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
        return $stale ?? [
            'error' => true,
            'code' => 'rate_limited',
            'message' => (string) ($decoded['message'] ?? 'RapidAPI rate limit reached')
        ];
    }

    if ($httpCode < 200 || $httpCode >= 300) {
        return $stale ?? [
            'error' => true,
            'code' => 'http_error',
            'http_status' => $httpCode,
            'message' => (string) ($decoded['message'] ?? 'RapidAPI request failed')
        ];
    }

    if (($decoded['status'] ?? true) === false) {
        return $stale ?? [
            'error' => true,
            'code' => 'api_error',
            'message' => (string) ($decoded['message'] ?? 'RapidAPI returned an error')
        ];
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

function attractionLocationIdFromSuggestion(array $item): ?string
{
    $id = trim((string) attractionArrayValue(
        $item,
        ['id', 'locationId', 'dest_id'],
        ''
    ));

    $ufi = attractionArrayValue($item, ['ufi', 'ufiDetails.ufi']);

    if ($id !== '') {
        $paddedId = strtr($id, '-_', '+/');
        $paddedId .= str_repeat('=', (4 - strlen($paddedId) % 4) % 4);
        $decodedId = base64_decode($paddedId, true);
        $decodedJson = $decodedId === false
            ? null
            : json_decode($decodedId, true);

        if (is_array($decodedJson) && isset($decodedJson['ufi'])) {
            $ufi = $decodedJson['ufi'];
        }
    }

    if ($ufi !== null && is_numeric($ufi)) {
        return base64_encode((string) json_encode(
            ['ufi' => (int) $ufi],
            JSON_UNESCAPED_SLASHES
        ));
    }

    return $id !== '' ? $id : null;
}

function extractAttractionLocationId(
    array $response,
    array $region = []
): ?string
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

    $bestId = null;
    $bestScore = PHP_INT_MIN;
    $regionCity = strtolower(trim((string) ($region['city'] ?? '')));
    $regionName = strtolower(trim((string) ($region['name'] ?? '')));

    foreach ($groups as $group) {
        if (!is_array($group)) {
            continue;
        }

        foreach ($group as $item) {
            if (!is_array($item)) {
                continue;
            }

            $id = attractionLocationIdFromSuggestion($item);

            if ($id === null) {
                continue;
            }

            $countryCode = strtolower((string) attractionArrayValue(
                $item,
                ['countryCode', 'country_code', 'ufiDetails.countryCode'],
                ''
            ));
            $cityName = strtolower((string) attractionArrayValue(
                $item,
                ['cityName', 'city', 'name', 'ufiDetails.cityName'],
                ''
            ));
            $title = strtolower((string) attractionArrayValue(
                $item,
                ['title', 'name'],
                ''
            ));
            $type = strtolower((string) ($item['__typename'] ?? ''));
            $score = 0;

            if ($countryCode === 'my') {
                $score += 100;
            }

            if ($regionCity !== '' && str_contains($cityName, $regionCity)) {
                $score += 80;
            }

            if ($regionCity !== '' && str_contains($title, $regionCity)) {
                $score += 30;
            }

            if ($regionName !== '' && str_contains($title, $regionName)) {
                $score += 20;
            }

            if (str_contains($type, 'destination')) {
                $score += 15;
            }

            if ($score > $bestScore) {
                $bestScore = $score;
                $bestId = $id;
            }
        }
    }

    return $bestId;
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
            'reviewsStats.combinedNumericStats.total',
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
    $description = trim((string) attractionArrayValue(
        $product,
        ['shortDescription', 'description'],
        'Discover this popular experience in ' . $location . '.'
    ));
    $apiCity = (string) attractionArrayValue(
        $product,
        ['ufiDetails.bCityName', 'ufiDetails.cityName', 'ufiDetails.name'],
        ''
    );

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
        'description' => $description,
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
        'api_location' => $apiCity,
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
    int $limit = 100
): array {
    $limit = max(1, min(100, $limit));
    $region['key'] = $regionKey;
    $resultCacheKey = 'region-results-v6:' . $regionKey . ':' . $limit;
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

    $locationId = extractAttractionLocationId($locationResponse, $region);

    if ($locationId === null) {
        return attractionReadCache($resultCacheKey, true)
            ?? getLocalAttractionsForRegion($regionKey);
    }

    $results = [];
    $used = [];
    /* Booking COM15 normally returns about 20 products per page. */
    $maximumPages = min(5, max(1, (int) ceil($limit / 20)));

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

            $countryCode = strtolower((string) attractionArrayValue(
                $product,
                [
                    'ufiDetails.url.country',
                    'ufiDetails.countryCode',
                    'countryCode',
                    'country_code'
                ],
                ''
            ));

            if ($countryCode !== '' && $countryCode !== 'my') {
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

/* Must-Visit uses cached API products first, then fills gaps locally. */
function getMustVisitAttractions(array $regions, int $perRegion = 2): array
{
    $results = [];
    $perRegion = max(1, $perRegion);

    foreach ($regions as $regionKey => $region) {
        $cachedApiItems = attractionReadCache(
            'region-results-v6:' . $regionKey . ':100',
            true
        );
        $items = is_array($cachedApiItems)
            ? array_slice($cachedApiItems, 0, $perRegion)
            : [];

        if (count($items) < $perRegion) {
            $localItems = getLocalAttractionsForRegion((string) $regionKey);

            foreach ($localItems as $localItem) {
                $items[] = $localItem;

                if (count($items) >= $perRegion) {
                    break;
                }
            }
        }

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

function attractionTextList($value): array
{
    if (is_string($value)) {
        $text = trim(strip_tags($value));
        return $text !== '' ? [$text] : [];
    }

    if (!is_array($value)) {
        return [];
    }

    $texts = [];
    $preferredKeys = ['title', 'text', 'description', 'label', 'name', 'value'];
    $usedPreferredKey = false;

    foreach ($preferredKeys as $key) {
        if (array_key_exists($key, $value)) {
            $usedPreferredKey = true;
            $texts = array_merge($texts, attractionTextList($value[$key]));
        }
    }

    if (!$usedPreferredKey || array_is_list($value)) {
        foreach ($value as $item) {
            $texts = array_merge($texts, attractionTextList($item));
        }
    }

    return array_values(array_unique(array_filter($texts)));
}

function attractionFirstText($value, string $default = ''): string
{
    $texts = attractionTextList($value);
    return $texts[0] ?? $default;
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
    $base['api_id'] = (string) attractionArrayValue(
        $data,
        ['id', 'productId'],
        $base['api_id'] ?? ''
    );
    $base['name'] = (string) attractionArrayValue(
        $data,
        ['title', 'name', 'productName'],
        $base['name']
    );

    $description = attractionFirstText(attractionArrayValue(
        $data,
        ['description', 'shortDescription', 'about'],
        $base['description']
    ), $base['description']);

    if ($description !== '') {
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
            'reviewsStats.combinedNumericStats.total',
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

    $highlights = attractionTextList(attractionArrayValue(
        $data,
        ['uniqueSellingPoints', 'highlights', 'whatsIncluded', 'inclusions'],
        []
    ));

    if ($highlights === []) {
        $additionalInfo = (string) attractionArrayValue(
            $data,
            ['additionalInfo'],
            ''
        );
        $highlights = array_values(array_filter(array_map(
            'trim',
            preg_split('/(?:\r?\n){2,}/', $additionalInfo) ?: []
        )));
    }

    if ($highlights !== []) {
        $base['activities'] = array_slice($highlights, 0, 8);
    }

    $hours = attractionFirstText(attractionArrayValue(
        $data,
        [
            'openingHours',
            'operatingHours',
            'operationalDetails.openingHours',
            'availabilityInfo'
        ],
        ''
    ));

    if ($hours !== '') {
        $base['hours'] = $hours;
    }

    $duration = attractionFirstText(attractionArrayValue(
        $data,
        ['duration', 'durationDescription', 'operationalDetails.duration'],
        ''
    ));

    if ($duration !== '') {
        $base['duration'] = $duration;
    }

    $apiLocation = attractionFirstText(attractionArrayValue(
        $data,
        [
            'ufiDetails.bCityName',
            'ufiDetails.cityName',
            'location.name',
            'cityName'
        ],
        ''
    ));

    if ($apiLocation !== '') {
        $base['api_location'] = $apiLocation;
    }

    $base['booking_url'] = (string) attractionArrayValue(
        $data,
        [
            'bookingUrl',
            'deepLink',
            'url',
            'offers.0.bookingUrl',
            'options.0.bookingUrl'
        ],
        $base['booking_url'] ?? ''
    );

    $base['source'] = 'api';
    return $base;
}

function normalizeApiAttractionReviews(
    array $response,
    int $limit = 6
): array {
    if (isset($response['error'])) {
        return [];
    }

    $data = $response['data'] ?? [];

    if (is_array($data) && array_is_list($data)) {
        $reviewItems = $data;
    } else {
        $reviewItems = attractionArrayValue(
            $response,
            [
                'data.reviews.reviews',
                'data.reviews',
                'data.items',
                'reviews.reviews',
                'reviews',
                'items'
            ],
            []
        );
    }

    if (!is_array($reviewItems)) {
        return [];
    }

    $reviews = [];

    foreach ($reviewItems as $review) {
        if (!is_array($review)) {
            continue;
        }

        $title = attractionFirstText(attractionArrayValue(
            $review,
            ['title', 'headline', 'reviewTitle'],
            ''
        ));
        $content = attractionFirstText(attractionArrayValue(
            $review,
            ['content', 'text', 'reviewText', 'comment', 'positive'],
            ''
        ));

        if ($title === '' && $content === '') {
            continue;
        }

        $dateValue = attractionArrayValue(
            $review,
            ['date', 'createdAt', 'reviewDate', 'submissionDate', 'epochMs'],
            ''
        );

        if (is_numeric($dateValue)) {
            $timestamp = (int) $dateValue;

            if ($timestamp > 9999999999) {
                $timestamp = (int) floor($timestamp / 1000);
            }

            $dateValue = $timestamp > 0 ? date('M j, Y', $timestamp) : '';
        }

        $reviews[] = [
            'title' => $title !== '' ? $title : 'Traveller review',
            'content' => $content,
            'rating' => attractionArrayValue(
                $review,
                ['rating', 'score', 'reviewRating', 'numericRating'],
                null
            ),
            'author' => attractionFirstText(attractionArrayValue(
                $review,
                [
                    'reviewer.name',
                    'user.name',
                    'author.name',
                    'reviewerName',
                    'author'
                ],
                ''
            ), 'Booking.com traveller'),
            'date' => attractionFirstText($dateValue)
        ];

        if (count($reviews) >= max(1, $limit)) {
            break;
        }
    }

    return $reviews;
}

function normalizeApiAttractionAvailability(array $response): array
{
    if (isset($response['error'])) {
        return [];
    }

    $data = $response['data'] ?? $response;

    if (!is_array($data)) {
        return [];
    }

    if (array_is_list($data)) {
        $timeSlot = $data[0] ?? [];

        if (!is_array($timeSlot)) {
            return [];
        }

        $offers = $timeSlot['timeSlotOffers'] ?? [];
        $lowestAmount = null;
        $lowestCurrency = 'MYR';
        $hours = '';

        if (is_array($offers)) {
            foreach ($offers as $offer) {
                if (!is_array($offer)) {
                    continue;
                }

                if ($hours === '') {
                    $instructions = (string) ($offer['locationInstructions'] ?? '');

                    if (preg_match(
                        '/The opening hours.*?(?=Opening hours may change|How to get there|$)/si',
                        $instructions,
                        $matches
                    )) {
                        $hours = trim((string) preg_replace(
                            '/\s+/',
                            ' ',
                            $matches[0]
                        ));
                    }
                }

                foreach (($offer['items'] ?? []) as $item) {
                    if (!is_array($item) || ($item['type'] ?? '') !== 'adult') {
                        continue;
                    }

                    $convertedPrice = $item['convertedPrice'] ?? $item['price'] ?? [];
                    $itemAmount = $convertedPrice['chargeAmount'] ?? null;

                    if (
                        $itemAmount !== null
                        && ($lowestAmount === null || (float) $itemAmount < $lowestAmount)
                    ) {
                        $lowestAmount = (float) $itemAmount;
                        $lowestCurrency = (string) ($convertedPrice['currency'] ?? 'MYR');
                    }
                }
            }
        }

        $start = (string) ($timeSlot['start'] ?? '');
        $dateLabel = 'the selected date';

        if ($start !== '') {
            try {
                $dateLabel = (new DateTimeImmutable($start))->format('M j, Y');
            } catch (Throwable $exception) {
                $dateLabel = substr($start, 0, 10);
            }
        }
        $offerCount = is_array($offers) ? count($offers) : 0;
        $price = $lowestAmount !== null
            ? $lowestCurrency . ' ' . number_format($lowestAmount, 2, '.', '')
            : null;
        $summary = $offerCount > 0
            ? $offerCount . ' ticket option' . ($offerCount === 1 ? '' : 's')
                . ' available for ' . $dateLabel
                . ($price !== null ? ', from ' . $price . '.' : '.')
            : 'No ticket options were returned for ' . $dateLabel . '.';

        return [
            'price' => $price,
            'booking_url' => '',
            'summary' => $summary,
            'hours' => $hours
        ];
    }

    $amount = attractionArrayValue(
        $data,
        [
            'representativePrice.chargeAmount',
            'price.amount',
            'offers.0.price.amount'
        ]
    );
    $currency = (string) attractionArrayValue(
        $data,
        [
            'representativePrice.currency',
            'price.currency',
            'offers.0.price.currency'
        ],
        'MYR'
    );

    return [
        'price' => $amount !== null ? $currency . ' ' . $amount : null,
        'booking_url' => (string) attractionArrayValue(
            $data,
            [
                'bookingUrl',
                'deepLink',
                'url',
                'offers.0.bookingUrl',
                'options.0.bookingUrl'
            ],
            ''
        ),
        'summary' => attractionFirstText(attractionArrayValue(
            $data,
            ['availabilityInfo', 'message', 'summary'],
            ''
        )),
        'hours' => attractionFirstText(attractionArrayValue(
            $data,
            ['openingHours', 'operatingHours', 'locationInstructions'],
            ''
        ))
    ];
}
