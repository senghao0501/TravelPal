<?php

require_once 'attractions_data.php';
require_once 'api_functions.php';

function searchEscape($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function resolveAttractionRegion(string $requestedKey, string $query, array $regions): array
{
    $requestedKey = strtolower(trim($requestedKey));

    if ($requestedKey !== '' && isset($regions[$requestedKey])) {
        return [$requestedKey, $regions[$requestedKey]];
    }

    $needle = strtolower(trim($query));

    foreach ($regions as $key => $region) {
        $names = [
            $key,
            $region['name'] ?? '',
            $region['city'] ?? '',
            $region['label'] ?? '',
            $region['query'] ?? ''
        ];

        foreach ($names as $name) {
            $name = strtolower(trim((string) $name));

            if (
                $name !== ''
                && (
                    $needle === $name
                    || str_contains($name, $needle)
                    || str_contains($needle, $name)
                )
            ) {
                return [$key, $region];
            }
        }
    }

    return ['selangor', $regions['selangor']];
}

function attractionResultDetailUrl(array $attraction): string
{
    if (
        ($attraction['source'] ?? '') === 'api'
        && !empty($attraction['slug'])
    ) {
        return 'detail.php?slug=' . rawurlencode((string) $attraction['slug']);
    }

    return 'detail.php?id=' . rawurlencode((string) $attraction['id']);
}

function attractionCategoryUrl(
    string $regionKey,
    string $query,
    string $category,
    string $visitDate,
    int $adults,
    int $children
): string {
    return 'after_search.php?' . http_build_query([
        'region' => $regionKey,
        'query' => $query,
        'category' => $category,
        'visit_date' => $visitDate,
        'adults' => $adults,
        'children' => $children
    ]);
}

$requestedRegionKey = (string) ($_GET['region'] ?? '');
$destination = trim((string) ($_GET['query'] ?? 'Selangor'));

[$regionKey, $region] = resolveAttractionRegion(
    $requestedRegionKey,
    $destination,
    $attraction_regions
);

$visitDate = (string) ($_GET['visit_date'] ?? date('Y-m-d'));

if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $visitDate)) {
    $visitDate = date('Y-m-d');
}

$adults = max(1, min(9, (int) ($_GET['adults'] ?? 2)));
$children = max(0, min(9, (int) ($_GET['children'] ?? 0)));

$categories = [
    'all' => 'All Attractions',
    'heritage' => 'Heritage & Culture',
    'nature' => 'Nature & Wildlife',
    'theme' => 'Theme Parks'
];

$categoryIcons = [
    'all' => 'fa-compass',
    'heritage' => 'fa-landmark-dome',
    'nature' => 'fa-tree',
    'theme' => 'fa-ticket-simple'
];

$selectedCategory = (string) ($_GET['category'] ?? 'all');

if (!isset($categories[$selectedCategory])) {
    $selectedCategory = 'all';
}

/*
 * Booking.com API is called only for the selected state.
 * It returns up to 50 results, but the page never forces the count to 50.
 * If no API data is usable, this returns only this state's local fallback items.
 */
$allAttractions = loadAttractionsForRegion($regionKey, $region, 50);

if ($selectedCategory === 'all') {
    $attractions = $allAttractions;
} else {
    $selectedCategoryName = $categories[$selectedCategory];
    $attractions = array_values(array_filter(
        $allAttractions,
        static fn(array $item): bool =>
            ($item['type'] ?? '') === $selectedCategoryName
    ));
}

$placeholderSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="760">'
    . '<defs><linearGradient id="g" x1="0" y1="0" x2="1" y2="1">'
    . '<stop stop-color="#4c1d95"/><stop offset="1" stop-color="#0f9f75"/>'
    . '</linearGradient></defs><rect width="100%" height="100%" fill="url(#g)"/>'
    . '<text x="50%" y="50%" text-anchor="middle" fill="white" '
    . 'font-family="Arial" font-size="48" font-weight="700">TravelPal</text></svg>';

$placeholderImage = 'data:image/svg+xml;charset=UTF-8,' . rawurlencode($placeholderSvg);

include '../header.php';
?>

<link rel="stylesheet" href="../css/modules/attractions.css">
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
>

<style>
.result-filters {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 26px;
}

.result-filters a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    padding: 10px 17px;
    border: 1px solid #ddd6fe;
    border-radius: 999px;
    background: #fff;
    color: #4c1d95;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
    transition: .2s ease;
}

.result-filters a:hover,
.result-filters a.active {
    border-color: #7c3aed;
    background: #7c3aed;
    color: #fff;
}

.results-count {
    margin: 0 0 20px;
    color: #64748b;
}

.result-type {
    margin: 0 0 8px;
    color: #7c3aed;
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
}

.result-title {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}

.result-no-rating {
    color: #64748b;
    font-size: 13px;
    font-weight: 700;
}

.search-empty {
    padding: 50px 20px;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    background: #fff;
    text-align: center;
}

@media (max-width: 600px) {
    .result-filters a {
        flex: 1 1 calc(50% - 10px);
        padding: 10px;
        font-size: 12px;
    }
}
</style>

<section class="hero-section" style="padding:40px 0;">
    <div class="hero-content">
        <h1>Attractions in <?= searchEscape($region['label']) ?></h1>

        <p>
            <?= searchEscape($visitDate) ?>
            · <?= $adults ?> Adult<?= $adults === 1 ? '' : 's' ?>
            · <?= $children ?> Child<?= $children === 1 ? '' : 'ren' ?>
        </p>
    </div>
</section>

<main class="main-content">
    <div class="section-header">
        <h2>Top Experiences</h2>
    </div>

    <nav class="result-filters" aria-label="Attraction categories">
        <?php foreach ($categories as $key => $label): ?>
            <a
                href="<?= searchEscape(attractionCategoryUrl(
                    $regionKey,
                    (string) $region['query'],
                    $key,
                    $visitDate,
                    $adults,
                    $children
                )) ?>"
                class="<?= $selectedCategory === $key ? 'active' : '' ?>"
            >
                <i class="fa-solid <?= $categoryIcons[$key] ?>"></i>
                <?= searchEscape($label) ?>
            </a>
        <?php endforeach; ?>
    </nav>

    <p class="results-count">
        <?= count($attractions) ?>
        attraction<?= count($attractions) === 1 ? '' : 's' ?> found
    </p>

    <?php if ($attractions !== []): ?>
        <div class="attraction-grid">
            <?php foreach ($attractions as $attraction): ?>
                <?php
                $detailUrl = attractionResultDetailUrl($attraction);
                $favoriteId = (string) ($attraction['id'] ?? '');
                $rating = $attraction['rating'] ?? 'N/A';
                $reviewCount = (int) ($attraction['review_count'] ?? 0);
                $hasRating = is_numeric($rating);
                ?>

                <article
                    class="property-card"
                    tabindex="0"
                    role="link"
                    data-url="<?= searchEscape($detailUrl) ?>"
                >
                    <div class="card-img-wrapper">
                        <img
                            src="<?= searchEscape($attraction['image'] ?? '') ?>"
                            alt="<?= searchEscape($attraction['name'] ?? 'Attraction') ?>"
                            loading="lazy"
                            onerror="this.onerror=null;this.src='<?= searchEscape($placeholderImage) ?>';"
                        >

                        <button
                            type="button"
                            class="heart-btn"
                            data-id="<?= searchEscape($favoriteId) ?>"
                            aria-label="Save attraction"
                        >
                            <i class="fa-regular fa-heart"></i>
                        </button>
                    </div>

                    <div class="card-content">
                        <p class="result-type">
                            <?= searchEscape($attraction['type'] ?? 'Attraction') ?>
                        </p>

                        <h3
                            class="result-title"
                            title="<?= searchEscape($attraction['name'] ?? '') ?>"
                        >
                            <?= searchEscape($attraction['name'] ?? '') ?>
                        </h3>

                        <p class="location">
                            <i class="fa-solid fa-location-dot"></i>
                            <?= searchEscape($attraction['location'] ?? $region['label']) ?>
                        </p>

                        <div class="card-footer">
                            <?php if ($hasRating): ?>
                                <span class="rating">
                                    <i class="fa-solid fa-star"></i>
                                    <?= searchEscape($rating) ?>

                                    <?php if ($reviewCount > 0): ?>
                                        (<?= number_format($reviewCount) ?>)
                                    <?php endif; ?>
                                </span>
                            <?php else: ?>
                                <span class="result-no-rating">View details</span>
                            <?php endif; ?>

                            <span class="price" style="font-size:14px;">
                                <?= searchEscape($attraction['price'] ?? 'Check price') ?>
                            </span>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="search-empty">
            <h3>No matching attractions found</h3>
            <p>Please choose another category.</p>
        </div>
    <?php endif; ?>
</main>

<?php include '../footer.php'; ?>

<script>
function readSavedAttractions() {
    try {
        const value = JSON.parse(localStorage.getItem('travelPal_attractions'));
        return Array.isArray(value) ? value : [];
    } catch (error) {
        return [];
    }
}

function updateHeart(button, isSaved) {
    const icon = button.querySelector('i');
    icon.className = isSaved ? 'fa-solid fa-heart' : 'fa-regular fa-heart';
    icon.style.color = isSaved ? '#7c3aed' : '#68788c';
    button.setAttribute('aria-pressed', isSaved ? 'true' : 'false');
}

document.addEventListener('DOMContentLoaded', function () {
    let savedItems = readSavedAttractions();

    document.querySelectorAll('.property-card').forEach(function (card) {
        card.addEventListener('click', function () {
            window.location.href = card.dataset.url;
        });

        card.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                window.location.href = card.dataset.url;
            }
        });
    });

    document.querySelectorAll('.heart-btn').forEach(function (button) {
        updateHeart(button, savedItems.includes(button.dataset.id));

        button.addEventListener('click', function (event) {
            event.stopPropagation();
            savedItems = readSavedAttractions();
            const id = button.dataset.id;

            if (savedItems.includes(id)) {
                savedItems = savedItems.filter(item => item !== id);
                updateHeart(button, false);
            } else {
                savedItems.push(id);
                updateHeart(button, true);
            }

            localStorage.setItem(
                'travelPal_attractions',
                JSON.stringify(savedItems)
            );
        });
    });
});
</script>

</body>
</html>
