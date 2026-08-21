<?php

if (!defined('RAPIDAPI_KEY')) {
    /*
     * 方法一：直接把 YOUR_RAPIDAPI_KEY 替换成你的 Key。
     * 方法二：在系统环境变量中设置 RAPIDAPI_KEY。
     */
    define(
        'RAPIDAPI_KEY',
        getenv('RAPIDAPI_KEY') ?: 'YOUR_RAPIDAPI_KEY'
    );
}

if (!defined('RAPIDAPI_HOST')) {
    define('RAPIDAPI_HOST', 'booking-com15.p.rapidapi.com');
}

function isAttractionApiConfigured(): bool
{
    $key = trim((string) RAPIDAPI_KEY);

    return $key !== ''
        && $key !== 'YOUR_RAPIDAPI_KEY'
        && stripos($key, '请在这里') === false;
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

function getAttractionCurlOptions(string $endpoint): array
{
    return [
        CURLOPT_URL => 'https://' . RAPIDAPI_HOST . $endpoint,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => '',
        CURLOPT_CONNECTTIMEOUT => 5,
        CURLOPT_TIMEOUT => 15,
        CURLOPT_MAXREDIRS => 5,
        CURLOPT_HTTPHEADER => [
            'x-rapidapi-host: ' . RAPIDAPI_HOST,
            'x-rapidapi-key: ' . RAPIDAPI_KEY,
            'Accept: application/json'
        ]
    ];
}

function fetchAttractionAPI(string $endpoint): array
{
    if (!isAttractionApiConfigured()) {
        return [
            'error' => true,
            'code' => 'api_not_configured',
            'message' => 'RapidAPI Key has not been configured.'
        ];
    }

    $curl = curl_init();
    curl_setopt_array($curl, getAttractionCurlOptions($endpoint));

    $response = curl_exec($curl);
    $curlError = curl_error($curl);
    $httpCode = (int) curl_getinfo($curl, CURLINFO_HTTP_CODE);

    curl_close($curl);

    if ($response === false || $curlError !== '') {
        return [
            'error' => true,
            'code' => 'curl_error',
            'message' => $curlError ?: 'Unable to contact the attraction API.'
        ];
    }

    $decoded = json_decode($response, true);

    if (!is_array($decoded)) {
        return [
            'error' => true,
            'code' => 'invalid_json',
            'message' => 'The attraction API returned invalid JSON.'
        ];
    }

    if ($httpCode < 200 || $httpCode >= 300) {
        return [
            'error' => true,
            'code' => 'http_error',
            'http_status' => $httpCode,
            'message' => $decoded['message'] ?? 'The attraction API request failed.'
        ];
    }

    return $decoded;
}

function fetchAttractionApiBatch(array $endpoints): array
{
    if (!isAttractionApiConfigured() || empty($endpoints)) {
        return [];
    }

    $multiHandle = curl_multi_init();
    $handles = [];

    foreach ($endpoints as $key => $endpoint) {
        $handle = curl_init();
        curl_setopt_array($handle, getAttractionCurlOptions($endpoint));

        curl_multi_add_handle($multiHandle, $handle);
        $handles[$key] = $handle;
    }

    do {
        $status = curl_multi_exec($multiHandle, $running);

        if ($running > 0) {
            $selected = curl_multi_select($multiHandle, 1.0);

            if ($selected === -1) {
                usleep(10000);
            }
        }
    } while ($running > 0 && $status === CURLM_OK);

    $results = [];

    foreach ($handles as $key => $handle) {
        $body = curl_multi_getcontent($handle);
        $error = curl_error($handle);
        $httpCode = (int) curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if ($error !== '') {
            $results[$key] = [
                'error' => true,
                'message' => $error
            ];
        } else {
            $decoded = json_decode($body, true);

            if (!is_array($decoded) || $httpCode < 200 || $httpCode >= 300) {
                $results[$key] = [
                    'error' => true,
                    'message' => 'API request failed.',
                    'http_status' => $httpCode
                ];
            } else {
                $results[$key] = $decoded;
            }
        }

        curl_multi_remove_handle($multiHandle, $handle);
        curl_close($handle);
    }

    curl_multi_close($multiHandle);

    return $results;
}

function extractAttractionLocationId(array $response): ?string
{
    $groups = [
        $response['data']['destinations'] ?? [],
        $response['data']['products'] ?? [],
        $response['destinations'] ?? [],
        $response['products'] ?? []
    ];

    if (isset($response['data']['id'])) {
        return (string) $response['data']['id'];
    }

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
                ['id', 'locationId', 'dest_id']
            );

            if ($id !== null) {
                return (string) $id;
            }
        }
    }

    return null;
}

function searchAttractionsByLocation(
    string $location,
    ?string $startDate = null,
    ?string $endDate = null
): array {
    $locationEndpoint = '/api/v1/attraction/searchLocation?'
        . http_build_query([
            'query' => $location,
            'languagecode' => 'en-us'
        ]);

    $locationResponse = fetchAttractionAPI($locationEndpoint);

    if (isset($locationResponse['error'])) {
        return $locationResponse;
    }

    $locationId = extractAttractionLocationId($locationResponse);

    if ($locationId === null) {
        return [
            'error' => true,
            'code' => 'location_not_found',
            'message' => 'No attraction destination was found for ' . $location . '.'
        ];
    }

    $parameters = [
        'id' => $locationId,
        'sortBy' => 'trending',
        'page' => 1,
        'currency_code' => 'MYR',
        'languagecode' => 'en-us'
    ];

    if ($startDate !== null && $startDate !== '') {
        $parameters['startDate'] = $startDate;
    }

    if ($endDate !== null && $endDate !== '') {
        $parameters['endDate'] = $endDate;
    }

    $searchEndpoint = '/api/v1/attraction/searchAttractions?'
        . http_build_query($parameters);

    return fetchAttractionAPI($searchEndpoint);
}

function getAttractionDetails(string $slug): array
{
    if ($slug === '') {
        return [
            'error' => true,
            'message' => 'Missing attraction slug.'
        ];
    }

    $endpoint = '/api/v1/attraction/getAttractionDetails?'
        . http_build_query([
            'slug' => $slug,
            'currency_code' => 'MYR',
            'languagecode' => 'en-us'
        ]);

    return fetchAttractionAPI($endpoint);
}

function normalizeApiAttraction(array $product, array $region): ?array
{
    $name = attractionArrayValue(
        $product,
        ['title', 'name', 'productName'],
        ''
    );

    $slug = attractionArrayValue(
        $product,
        ['slug', 'productSlug'],
        ''
    );

    if (!is_string($name) || trim($name) === '') {
        return null;
    }

    $image = attractionArrayValue(
        $product,
        [
            'primaryPhoto.small',
            'primaryPhoto.medium',
            'primaryPhoto.large',
            'representativePhoto.photoUri',
            'image'
        ],
        'https://via.placeholder.com/800x520?text=TravelPal+Attraction'
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

    $reviewCount = attractionArrayValue(
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
        [
            'representativePrice.chargeAmount',
            'price.amount'
        ]
    );

    $currency = attractionArrayValue(
        $product,
        [
            'representativePrice.currency',
            'price.currency'
        ],
        'MYR'
    );

    $price = $amount !== null
        ? $currency . ' ' . $amount
        : 'Check price';

    return [
        'id' => 'api-' . sha1((string) ($slug ?: $name)),
        'name' => (string) $name,
        'slug' => (string) $slug,
        'type' => 'Experience',
        'price' => $price,
        'rating' => $rating,
        'review_count' => (int) $reviewCount,
        'image' => (string) $image,
        'description' => 'Discover this popular experience in ' . $region['label'] . '.',
        'activities' => [
            'Explore the attraction at your own pace',
            'Check live ticket options and availability',
            'Enjoy a memorable Malaysian experience'
        ],
        'hours' => 'Check availability for your selected date',
        'duration' => 'Varies by ticket option',
        'best_for' => 'Couples, families and independent travellers',
        'state' => $region['name'],
        'city' => $region['city'],
        'location' => $region['label'],
        'query' => $region['query'],
        'source' => 'api'
    ];
}

function getMustVisitCacheFile(): string
{
    return sys_get_temp_dir()
        . DIRECTORY_SEPARATOR
        . 'travelpal_must_visit_attractions_v3.json';
}

function getCachedMustVisitAttractions(): array
{
    $cacheFile = getMustVisitCacheFile();

    if (!is_file($cacheFile)) {
        return [];
    }

    if ((time() - filemtime($cacheFile)) > 21600) {
        return [];
    }

    $decoded = json_decode((string) file_get_contents($cacheFile), true);

    return is_array($decoded) ? $decoded : [];
}

function getMustVisitAttractions(
    array $regions,
    int $perRegion = 2
): array {
    $localItems = getLocalFeaturedAttractions();

    if (!isAttractionApiConfigured()) {
        return $localItems;
    }

    $cached = getCachedMustVisitAttractions();

    if (count($cached) === count($regions) * $perRegion) {
        return $cached;
    }

    /*
     * 第一阶段：同时取得 8 个州属的 location ID。
     */
    $locationEndpoints = [];

    foreach ($regions as $regionKey => $region) {
        $locationEndpoints[$regionKey] =
            '/api/v1/attraction/searchLocation?'
            . http_build_query([
                'query' => $region['query'],
                'languagecode' => 'en-us'
            ]);
    }

    $locationResponses = fetchAttractionApiBatch($locationEndpoints);

    /*
     * 第二阶段：使用 location ID 同时搜索各州景点。
     */
    $searchEndpoints = [];

    foreach ($regions as $regionKey => $region) {
        $response = $locationResponses[$regionKey] ?? [];
        $locationId = is_array($response)
            ? extractAttractionLocationId($response)
            : null;

        if ($locationId === null) {
            continue;
        }

        $searchEndpoints[$regionKey] =
            '/api/v1/attraction/searchAttractions?'
            . http_build_query([
                'id' => $locationId,
                'sortBy' => 'trending',
                'page' => 1,
                'currency_code' => 'MYR',
                'languagecode' => 'en-us'
            ]);
    }

    $searchResponses = fetchAttractionApiBatch($searchEndpoints);
    $finalItems = [];

    foreach ($regions as $regionKey => $region) {
        $regionItems = [];
        $products = $searchResponses[$regionKey]['data']['products'] ?? [];

        if (is_array($products)) {
            foreach ($products as $product) {
                if (!is_array($product)) {
                    continue;
                }

                $normalized = normalizeApiAttraction($product, $region);

                if ($normalized === null || $normalized['slug'] === '') {
                    continue;
                }

                $regionItems[] = $normalized;

                if (count($regionItems) >= $perRegion) {
                    break;
                }
            }
        }

        /*
         * API 不足 2 个时，用本地景点补齐。
         */
        if (count($regionItems) < $perRegion) {
            foreach (getLocalAttractionsForRegion($regionKey) as $fallback) {
                $regionItems[] = $fallback;

                if (count($regionItems) >= $perRegion) {
                    break;
                }
            }
        }

        $finalItems = array_merge($finalItems, $regionItems);
    }

    if (count($finalItems) === count($regions) * $perRegion) {
        @file_put_contents(
            getMustVisitCacheFile(),
            json_encode(
                $finalItems,
                JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
            )
        );

        return $finalItems;
    }

    return $localItems;
}

function findCachedApiAttractionBySlug(string $slug): ?array
{
    foreach (getCachedMustVisitAttractions() as $item) {
        if (($item['slug'] ?? '') === $slug) {
            return $item;
        }
    }

    return null;
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
        'type' => 'Experience',
        'price' => 'Check price',
        'rating' => 'N/A',
        'review_count' => 0,
        'image' => 'https://via.placeholder.com/1200x700?text=TravelPal+Attraction',
        'description' => 'Explore this Malaysian attraction and check the available ticket options.',
        'activities' => [
            'Explore the attraction',
            'Check available ticket options',
            'Plan your visit in advance'
        ],
        'hours' => 'Check availability for your selected date',
        'duration' => 'Varies',
        'best_for' => 'All travellers',
        'location' => 'Malaysia',
        'query' => 'Malaysia'
    ];

    $name = attractionArrayValue(
        $data,
        ['title', 'name', 'productName'],
        $base['name']
    );

    $description = attractionArrayValue(
        $data,
        ['description', 'shortDescription', 'about'],
        $base['description']
    );

    if (!is_string($description)) {
        $description = $base['description'];
    }

    $image = attractionArrayValue(
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

    $rating = attractionArrayValue(
        $data,
        [
            'reviewsStats.combinedNumericStats.average',
            'reviewsStats.average',
            'rating'
        ],
        $base['rating']
    );

    $reviewCount = attractionArrayValue(
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
        [
            'representativePrice.chargeAmount',
            'price.amount'
        ]
    );

    $currency = attractionArrayValue(
        $data,
        [
            'representativePrice.currency',
            'price.currency'
        ],
        'MYR'
    );

    $base['id'] = 'api-' . sha1($slug);
    $base['slug'] = $slug;
    $base['name'] = (string) $name;
    $base['description'] = $description;
    $base['image'] = (string) $image;
    $base['rating'] = $rating;
    $base['review_count'] = (int) $reviewCount;
    $base['source'] = 'api';

    if ($amount !== null) {
        $base['price'] = $currency . ' ' . $amount;
    }

    return $base;
}