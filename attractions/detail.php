<?php

require_once 'attractions_data.php';
require_once 'api_functions.php';

function detailEscape($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

$localId = trim((string) ($_GET['id'] ?? ''));
$slug = trim((string) ($_GET['slug'] ?? ''));
$attraction = null;

if ($localId !== '') {
    $attraction = findLocalAttractionById($localId);
}

if ($slug !== '') {
    $cachedAttraction = findCachedApiAttractionBySlug($slug);
    $apiResponse = getAttractionDetails($slug);

    if (isset($apiResponse['error'])) {
        $attraction = $cachedAttraction;
    } else {
        $attraction = normalizeApiAttractionDetails(
            $apiResponse,
            $slug,
            $cachedAttraction
        );
    }
}

$pageNotFound = $attraction === null;

$placeholderSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="760">'
    . '<defs><linearGradient id="g" x1="0" y1="0" x2="1" y2="1">'
    . '<stop stop-color="#4c1d95"/><stop offset="1" stop-color="#0f9f75"/>'
    . '</linearGradient></defs><rect width="100%" height="100%" fill="url(#g)"/>'
    . '<text x="50%" y="50%" text-anchor="middle" fill="white" '
    . 'font-family="Arial" font-size="48" font-weight="700">TravelPal</text></svg>';

$placeholderImage = 'data:image/svg+xml;charset=UTF-8,' . rawurlencode($placeholderSvg);

include '../header.php';
?>

<link rel="stylesheet" href="../css/details/attractions_detail.css">
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
>

<?php if ($pageNotFound): ?>
    <div class="attraction-error-page">
        <div class="attraction-error-card">
            <i class="fa-solid fa-map-location-dot"></i>
            <h1>Attraction not found</h1>

            <p>
                The requested attraction does not exist or is no longer
                available.
            </p>

            <a href="index.php" class="detail-primary-button">
                Return to attractions
            </a>
        </div>
    </div>
<?php else: ?>
    <?php
    $favoriteId = (string) $attraction['id'];
    $location = (string) ($attraction['location'] ?? 'Malaysia');
    $activities = $attraction['activities'] ?? [];
    $reviewCount = (int) ($attraction['review_count'] ?? 0);
    $rating = $attraction['rating'] ?? 'N/A';
    $price = (string) ($attraction['price'] ?? 'Check price');
    $isFree = stripos($price, 'free') !== false;
    ?>

    <div class="attraction-detail-page">
        <nav class="detail-breadcrumb" aria-label="Breadcrumb">
            <a href="index.php">Attractions</a>
            <i class="fa-solid fa-chevron-right"></i>
            <span><?= detailEscape($location) ?></span>
        </nav>

        <section class="detail-heading">
            <div>
                <div class="detail-label-row">
                    <span class="detail-type-label">
                        <?= detailEscape($attraction['type'] ?? 'Attraction') ?>
                    </span>
                </div>

                <h1><?= detailEscape($attraction['name']) ?></h1>

                <p class="detail-location">
                    <i class="fa-solid fa-location-dot"></i>
                    <?= detailEscape($location) ?>, Malaysia
                </p>
            </div>

            <div class="detail-heading-actions">
                <div class="detail-price-block">
                    <span>Tickets</span>

                    <strong class="<?= $isFree ? 'free' : '' ?>">
                        <?= detailEscape($price) ?>
                    </strong>
                </div>

                <button
                    type="button"
                    class="detail-save-button"
                    id="detailSaveButton"
                    data-id="<?= detailEscape($favoriteId) ?>"
                >
                    <i class="fa-regular fa-heart"></i>
                    <span>Save to Trip</span>
                </button>
            </div>
        </section>

        <section class="detail-hero">
            <img
                src="<?= detailEscape($attraction['image'] ?? '') ?>"
                alt="<?= detailEscape($attraction['name']) ?>"
                onerror="this.onerror=null;this.src='<?= detailEscape($placeholderImage) ?>';"
            >

            <div class="detail-hero-overlay">
                <div class="detail-rating">
                    <i class="fa-solid fa-star"></i>
                    <strong><?= detailEscape($rating) ?></strong>

                    <?php if ($reviewCount > 0): ?>
                        <span><?= number_format($reviewCount) ?> reviews</span>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <div class="detail-layout">
            <div class="detail-main-column">
                <section class="detail-section">
                    <span class="detail-section-kicker">
                        ABOUT THIS EXPERIENCE
                    </span>

                    <h2>Introduction</h2>

                    <p class="detail-description">
                        <?= detailEscape($attraction['description'] ?? '') ?>
                    </p>
                </section>

                <section class="detail-section">
                    <span class="detail-section-kicker">
                        EXPERIENCE HIGHLIGHTS
                    </span>

                    <h2>Things to do</h2>

                    <ul class="detail-activity-list">
                        <?php foreach ($activities as $activity): ?>
                            <li>
                                <span class="activity-icon">
                                    <i class="fa-solid fa-check"></i>
                                </span>

                                <span><?= detailEscape($activity) ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </section>

                <section class="detail-section">
                    <span class="detail-section-kicker">
                        BEFORE YOU VISIT
                    </span>

                    <h2>Visitor information</h2>

                    <div class="detail-information-grid">
                        <div class="information-card">
                            <i class="fa-regular fa-clock"></i>

                            <div>
                                <span>Opening information</span>
                                <strong>
                                    <?= detailEscape($attraction['hours'] ?? 'Check before visiting') ?>
                                </strong>
                            </div>
                        </div>

                        <div class="information-card">
                            <i class="fa-solid fa-hourglass-half"></i>

                            <div>
                                <span>Recommended duration</span>
                                <strong>
                                    <?= detailEscape($attraction['duration'] ?? 'Varies') ?>
                                </strong>
                            </div>
                        </div>

                        <div class="information-card">
                            <i class="fa-solid fa-user-group"></i>

                            <div>
                                <span>Best for</span>
                                <strong>
                                    <?= detailEscape($attraction['best_for'] ?? 'All travellers') ?>
                                </strong>
                            </div>
                        </div>

                        <div class="information-card">
                            <i class="fa-solid fa-language"></i>

                            <div>
                                <span>Destination</span>
                                <strong><?= detailEscape($location) ?></strong>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="detail-section review-summary-section">
                    <div class="review-summary-score">
                        <span class="large-score">
                            <?= detailEscape($rating) ?>
                        </span>

                        <div>
                            <div class="review-stars">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>

                            <strong>Traveller rating</strong>

                            <p>
                                <?php if ($reviewCount > 0): ?>
                                    Based on <?= number_format($reviewCount) ?>
                                    traveller reviews
                                <?php else: ?>
                                    Review information is provided when available
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </section>
            </div>

            <aside class="detail-booking-card">
                <div class="booking-card-header">
                    <span>Plan your visit</span>

                    <strong class="<?= $isFree ? 'free' : '' ?>">
                        <?= detailEscape($price) ?>
                    </strong>
                </div>

                <form class="booking-form" onsubmit="return false;">
                    <label for="detailVisitDate">Visit date</label>

                    <div class="booking-input">
                        <i class="fa-regular fa-calendar"></i>

                        <input
                            type="date"
                            id="detailVisitDate"
                            name="visit_date"
                            required
                        >
                    </div>

                    <label for="detailAdults">Adults</label>

                    <div class="booking-input">
                        <i class="fa-solid fa-user"></i>

                        <select id="detailAdults" name="adults">
                            <?php for ($adult = 1; $adult <= 10; $adult++): ?>
                                <option
                                    value="<?= $adult ?>"
                                    <?= $adult === 2 ? 'selected' : '' ?>
                                >
                                    <?= $adult ?>
                                    <?= $adult === 1 ? 'Adult' : 'Adults' ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <label for="detailChildren">Children</label>

                    <div class="booking-input">
                        <i class="fa-solid fa-child"></i>

                        <select id="detailChildren" name="children">
                            <?php for ($child = 0; $child <= 10; $child++): ?>
                                <option value="<?= $child ?>">
                                    <?= $child ?>
                                    <?= $child === 1 ? 'Child' : 'Children' ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <button
                        type="button"
                        class="detail-primary-button booking-submit"
                    >
                        <i class="fa-solid fa-ticket"></i>
                        Buy tickets
                    </button>
                </form>
            </aside>
        </div>
    </div>
<?php endif; ?>

</main>

<?php include '../footer.php'; ?>

<script>
function readDetailSavedItems() {
    try {
        const value = JSON.parse(
            localStorage.getItem('travelPal_attractions')
        );

        return Array.isArray(value) ? value : [];
    } catch (error) {
        return [];
    }
}

const saveButton = document.getElementById('detailSaveButton');

function updateDetailSaveButton(isSaved) {
    if (!saveButton) {
        return;
    }

    const icon = saveButton.querySelector('i');
    const label = saveButton.querySelector('span');

    if (isSaved) {
        icon.className = 'fa-solid fa-heart';
        label.textContent = 'Saved to Trip';
        saveButton.classList.add('saved');
        saveButton.setAttribute('aria-pressed', 'true');
    } else {
        icon.className = 'fa-regular fa-heart';
        label.textContent = 'Save to Trip';
        saveButton.classList.remove('saved');
        saveButton.setAttribute('aria-pressed', 'false');
    }
}

if (saveButton) {
    const attractionId = saveButton.dataset.id;
    let savedItems = readDetailSavedItems();

    updateDetailSaveButton(savedItems.includes(attractionId));

    saveButton.addEventListener('click', function () {
        savedItems = readDetailSavedItems();

        if (savedItems.includes(attractionId)) {
            savedItems = savedItems.filter(item => item !== attractionId);
            updateDetailSaveButton(false);
        } else {
            savedItems.push(attractionId);
            updateDetailSaveButton(true);
        }

        localStorage.setItem(
            'travelPal_attractions',
            JSON.stringify(savedItems)
        );
    });
}

const detailDateInput = document.getElementById('detailVisitDate');

if (detailDateInput) {
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');
    const localDate = year + '-' + month + '-' + day;

    detailDateInput.min = localDate;
    detailDateInput.value = localDate;
}
</script>

</body>
</html>
