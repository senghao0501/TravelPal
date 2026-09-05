<?php

declare(strict_types=1);

function restaurant_photo_url(?string $template, int $width = 900, int $height = 600): ?string
{
    if (!$template) {
        return null;
    }
    return str_replace(['{width}', '{height}'], [(string)$width, (string)$height], $template);
}

function restaurant_plain_text(?string $value): string
{
    if (!$value) {
        return '';
    }
    $value = str_ireplace(['<br>', '<br/>', '<br />'], "\n", $value);
    return trim(html_entity_decode(strip_tags($value), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
}

function restaurant_price_estimate(string $summary): array
{
    preg_match_all('/\${1,4}/', $summary, $matches);
    $levels = array_map('strlen', $matches[0] ?? []);
    $firstLevel = max(1, min(4, $levels[0] ?? 2));
    $lastLevel = max(1, min(4, $levels[count($levels) - 1] ?? $firstLevel));
    $ranges = [
        1 => [15, 30],
        2 => [30, 65],
        3 => [65, 130],
        4 => [130, 220],
    ];
    $minimum = $ranges[$firstLevel][0];
    $maximum = $ranges[$lastLevel][1];

    return [
        'priceRange' => 'RM ' . $minimum . '–' . $maximum,
        'estimatedPrice' => (int)round(($minimum + $maximum) / 2),
    ];
}

function restaurant_walk(array $node, callable $visitor): void
{
    $visitor($node);
    foreach ($node as $value) {
        if (is_array($value)) {
            restaurant_walk($value, $visitor);
        }
    }
}

function restaurant_parse_list(array $raw, array $city): array
{
    $root = $raw['data']['AppPresentation_queryAppListV2'][0] ?? [];
    $results = [];

    if (is_array($root)) {
        restaurant_walk($root, function (array $node) use (&$results, $city): void {
            if (($node['__typename'] ?? '') !== 'AppPresentation_HorizontalMerchandisingCard') {
                return;
            }

            $id = (string)($node['cardLink']['route']['typedParams']['contentId'] ?? $node['saveId']['id'] ?? '');
            $name = trim((string)($node['cardTitle']['string'] ?? ''));
            if ($id === '' || $name === '' || isset($results[$id])) {
                return;
            }

            $summary = trim((string)($node['primaryInfo']['text'] ?? 'Restaurant'));
            $priceEstimate = restaurant_price_estimate($summary);
            $results[$id] = [
                'id' => $id,
                'name' => $name,
                'summary' => $summary,
                'status' => trim((string)($node['secondaryInfo']['text'] ?? '')),
                'rating' => isset($node['bubbleRating']['rating']) ? (float)$node['bubbleRating']['rating'] : null,
                'reviewCount' => preg_replace('/[^0-9,.]/', '', (string)($node['bubbleRating']['numberReviews']['string'] ?? '')),
                'image' => restaurant_photo_url($node['cardPhoto']['sizes']['urlTemplate'] ?? null),
                'badge' => isset($node['badge']['type']) ? ucwords(strtolower(str_replace('_', ' ', (string)$node['badge']['type']))) : '',
                'state' => $city['state'],
                'city' => $city['city'],
                'priceRange' => $priceEstimate['priceRange'],
                'estimatedPrice' => $priceEstimate['estimatedPrice'],
            ];
        });
    }

    return [
        'title' => (string)($root['container']['searchTitle']['string'] ?? ('Restaurants in ' . $city['city'])),
        'city' => $city['city'],
        'state' => $city['state'],
        'restaurants' => array_slice(array_values($results), 0, 30),
    ];
}

function restaurant_parse_detail(array $raw): array
{
    $root = $raw['data']['AppPresentation_queryAppDetailV2'][0] ?? [];
    $container = $root['container'] ?? [];
    $detail = [
        'id' => (string)($container['saveId']['id'] ?? ''),
        'name' => (string)($container['navTitle'] ?? 'Restaurant'),
        'tripadvisorUrl' => (string)($container['shareInfo']['webUrl'] ?? ''),
        'rating' => null,
        'reviewCount' => '',
        'photos' => [],
        'photoCount' => null,
        'summary' => '',
        'status' => '',
        'description' => '',
        'cuisines' => [],
        'serves' => [],
        'hours' => [],
        'website' => '',
        'phone' => '',
        'menuUrl' => '',
        'address' => '',
        'latitude' => null,
        'longitude' => null,
        'menu' => [],
        'reviews' => [],
    ];

    foreach (($root['sections'] ?? []) as $section) {
        $type = $section['__typename'] ?? '';

        if ($type === 'AppPresentation_PoiHeroStandard') {
            $detail['photoCount'] = $section['photoCount'] ?? null;
            foreach (($section['heroContent'] ?? []) as $photo) {
                $url = restaurant_photo_url($photo['data']['photoSizeDynamic']['urlTemplate'] ?? null, 1200, 800);
                if ($url && !in_array($url, $detail['photos'], true)) {
                    $detail['photos'][] = $url;
                }
            }
        }

        if ($type === 'AppPresentation_PoiOverview') {
            $detail['rating'] = isset($section['bubbleRating']['rating']) ? (float)$section['bubbleRating']['rating'] : null;
            $detail['reviewCount'] = preg_replace('/[^0-9,.]/', '', (string)($section['bubbleRating']['numberReviews']['string'] ?? ''));
            $detail['summary'] = (string)($section['tagsV2']['text'] ?? $section['tags']['text'] ?? '');
            foreach (($section['contactLinks'] ?? []) as $link) {
                $target = $link['link'] ?? $link;
                $url = (string)($target['externalUrl'] ?? $target['url'] ?? $target['route']['url'] ?? '');
                $targetText = $target['text'] ?? '';
                $text = strtolower(is_array($targetText) ? (string)($targetText['string'] ?? '') : (string)$targetText);
                if (str_starts_with($url, 'tel:')) {
                    $detail['phone'] = rawurldecode(substr($url, 4));
                } elseif (str_contains($text, 'menu')) {
                    $detail['menuUrl'] = $url;
                } elseif ($url !== '' && $detail['website'] === '') {
                    $detail['website'] = $url;
                }
            }
        }

        if ($type === 'AppPresentation_PoiHours') {
            $detail['status'] = (string)($section['text']['string'] ?? '');
            foreach (($section['todaySchedule'] ?? []) as $schedule) {
                $value = trim((string)($schedule['string'] ?? ''));
                if ($value !== '') {
                    $detail['hours'][] = $value;
                }
            }
        }

        if ($type === 'AppPresentation_PoiAbout') {
            foreach (($section['nullableContent'] ?? []) as $item) {
                if (($item['__typename'] ?? '') === 'AppPresentation_CollapsibleTextSubsection') {
                    $detail['description'] = restaurant_plain_text($item['text']['string'] ?? '');
                    continue;
                }
                $title = strtolower((string)($item['title']['string'] ?? $item['title'] ?? ''));
                $values = $item['list'] ?? $item['tags'] ?? $item['tagTexts'] ?? [];
                $clean = [];
                foreach ($values as $value) {
                    $text = trim(is_array($value) ? (string)($value['string'] ?? $value['text'] ?? '') : (string)$value);
                    if ($text !== '') {
                        $clean[] = $text;
                    }
                }
                if (str_contains($title, 'cuisine')) {
                    $detail['cuisines'] = $clean;
                } elseif (str_contains($title, 'meal') || str_contains($title, 'serve')) {
                    $detail['serves'] = $clean;
                }
            }
        }

        if ($type === 'AppPresentation_PoiMenu') {
            foreach (($section['entries'] ?? []) as $entry) {
                $detail['menu'][] = [
                    'name' => is_array($entry['title'] ?? null) ? (string)($entry['title']['string'] ?? '') : (string)($entry['title'] ?? ''),
                    'description' => is_array($entry['description'] ?? null) ? (string)($entry['description']['string'] ?? '') : (string)($entry['description'] ?? ''),
                    'price' => is_array($entry['price'] ?? null) ? (string)($entry['price']['string'] ?? '') : (string)($entry['price'] ?? ''),
                ];
            }
        }

        if ($type === 'AppPresentation_PoiLocation') {
            $detail['address'] = (string)($section['address']['address'] ?? $section['address']['string'] ?? '');
            $detail['latitude'] = $section['address']['geoPoint']['latitude'] ?? $section['geoPoint']['latitude'] ?? null;
            $detail['longitude'] = $section['address']['geoPoint']['longitude'] ?? $section['geoPoint']['longitude'] ?? null;
        }

        if ($type === 'AppPresentation_UserReviewSection' && count($detail['reviews']) < 7) {
            $review = [
                'title' => restaurant_plain_text($section['htmlTitle']['htmlString'] ?? ''),
                'text' => restaurant_plain_text($section['htmlText']['htmlString'] ?? ''),
                'rating' => isset($section['bubbleRating']['rating']) ? (float)$section['bubbleRating']['rating'] : null,
                'date' => (string)($section['publishedDate']['string'] ?? ''),
                'visitDate' => (string)($section['dateVisitedValue']['string'] ?? ''),
                'author' => (string)($section['userProfile']['displayName'] ?? 'Traveler'),
                'hometown' => is_array($section['userProfile']['hometown'] ?? null) ? (string)($section['userProfile']['hometown']['string'] ?? '') : (string)($section['userProfile']['hometown'] ?? ''),
                'avatar' => restaurant_photo_url($section['userProfile']['avatar']['data']['photoSizeDynamic']['urlTemplate'] ?? $section['userProfile']['avatar']['photoSizeDynamic']['urlTemplate'] ?? null, 120, 120),
            ];
            if ($review['text'] !== '') {
                $detail['reviews'][] = $review;
            }
        }
    }

    $priceEstimate = restaurant_price_estimate($detail['summary'] . ' ' . $detail['description']);
    $detail['priceRange'] = $priceEstimate['priceRange'];
    $detail['estimatedPrice'] = $priceEstimate['estimatedPrice'];

    return $detail;
}
