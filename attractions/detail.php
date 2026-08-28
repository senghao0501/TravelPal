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
$reviews = [];
$availability = [];
$apiNotice = '';
$availabilityRequested = ($_GET['check_availability'] ?? '') === '1';
$selectedVisitDate = (string) ($_GET['visit_date'] ?? date('Y-m-d'));
$selectedAdults = max(1, min(10, (int) ($_GET['adults'] ?? 2)));
$selectedChildren = max(0, min(10, (int) ($_GET['children'] ?? 0)));

if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $selectedVisitDate)) {
    $selectedVisitDate = date('Y-m-d');
}

if ($localId !== '') {
    $attraction = findLocalAttractionById($localId);
}

if ($slug !== '') {
    $cachedAttraction = findCachedApiAttractionBySlug($slug);
    $apiResponse = getAttractionDetails($slug);

    if (isset($apiResponse['error'])) {
        $attraction = $cachedAttraction;
        $apiNotice = 'Live details are temporarily unavailable; cached information is shown.';
    } else {
        $attraction = normalizeApiAttractionDetails(
            $apiResponse,
            $slug,
            $cachedAttraction
        );
        $reviews = normalizeApiAttractionReviews($apiResponse, 6);
    }

    if ($attraction !== null) {
        $apiId = trim((string) ($attraction['api_id'] ?? ''));

        if ($reviews === [] && $apiId !== '') {
            $reviews = normalizeApiAttractionReviews(
                getAttractionReviews($apiId, 1),
                6
            );
        }

        if ($availabilityRequested) {
            $availability = normalizeApiAttractionAvailability(
                getAttractionAvailability($slug, 'MYR', 'en-us')
            );

            if (!empty($availability['price'])) {
                $attraction['price'] = $availability['price'];
            }

            if (!empty($availability['booking_url'])) {
                $attraction['booking_url'] = $availability['booking_url'];
            }

            if (!empty($availability['hours'])) {
                $attraction['hours'] = $availability['hours'];
            }
        }
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
$savedAttractionKeys = attractionFavoriteKeysForCurrentUser();

include '../header.php';
?>

<link rel="stylesheet" href="../css/details/attractions_detail.css?v=20260824-3">
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
>

<style>
.api-detail-notice {
    margin: 0 0 18px;
    padding: 12px 16px;
    border: 1px solid #fde68a;
    border-radius: 12px;
    background: #fffbeb;
    color: #92400e;
}

.traveller-review-list {
    display: grid;
    gap: 14px;
    margin-top: 20px;
}

.traveller-review-card {
    padding: 18px;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    background: #fff;
}

.traveller-review-heading {
    display: flex;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 8px;
}

.traveller-review-heading span {
    color: #7c3aed;
    font-weight: 800;
}

.traveller-review-card p {
    margin: 0 0 10px;
    color: #475569;
    line-height: 1.7;
}

.traveller-review-meta,
.availability-result {
    color: #64748b;
    font-size: 14px;
}

</style>

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
    $bookingUrl = trim((string) ($attraction['booking_url'] ?? ''));
    $tripUnitPrice = attractionPriceAmount($price);
    $favoriteKey = attractionFavoriteKey($attraction);
    $isFavorite = isset($savedAttractionKeys[$favoriteKey]);
    $tripSubtitle = $location . ' · ' . date('d M Y', strtotime($selectedVisitDate));
    $favoriteData = json_encode([
        'item_key' => $favoriteKey,
        'title' => (string) ($attraction['name'] ?? 'Attraction'),
        'subtitle' => $location,
        'image_url' => (string) ($attraction['image'] ?? ''),
        'unit_price' => $tripUnitPrice,
        'metadata' => [
            'detail_url' => $_SERVER['REQUEST_URI'] ?? '/TravelPal/attractions/index.php',
            'visit_date' => $selectedVisitDate,
            'adults' => $selectedAdults,
            'children' => $selectedChildren,
            'tickets' => $selectedAdults + $selectedChildren,
            'duration_hours' => 2,
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?: '{}';
    $tripBookingData = json_encode([
        'visit_date' => $selectedVisitDate,
        'adults' => $selectedAdults,
        'children' => $selectedChildren,
        'guests' => $selectedAdults + $selectedChildren,
        'image_url' => (string) ($attraction['image'] ?? ''),
        'booking_url' => $bookingUrl,
        'price_label' => $price,
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?: '{}';

    if (!preg_match('#^https://#i', $bookingUrl)) {
        $bookingUrl = 'https://www.booking.com/attractions/searchresults.html?'
            . http_build_query(['query' => (string) $attraction['name']]);
    }
    ?>

    <div class="attraction-detail-page">
        <nav class="detail-breadcrumb" aria-label="Breadcrumb">
            <a href="index.php">Attractions</a>
            <i class="fa-solid fa-chevron-right"></i>
            <span><?= detailEscape($location) ?></span>
        </nav>

        <?php if ($apiNotice !== ''): ?>
            <p class="api-detail-notice">
                <?= detailEscape($apiNotice) ?>
            </p>
        <?php endif; ?>

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
                    class="detail-save-button<?= $isFavorite ? ' saved' : '' ?>"
                    id="detailSaveButton"
                    data-favorite="<?= detailEscape($favoriteData) ?>"
                    data-save-label="Save to Favorites"
                    data-saved-label="Saved to Favorites"
                    aria-pressed="<?= $isFavorite ? 'true' : 'false' ?>"
                >
                    <i class="<?= $isFavorite ? 'fa-solid' : 'fa-regular' ?> fa-heart"></i>
                    <span><?= $isFavorite ? 'Saved to Favorites' : 'Save to Favorites' ?></span>
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

                    <?php if ($reviews !== []): ?>
                        <div class="traveller-review-list">
                            <?php foreach ($reviews as $review): ?>
                                <article class="traveller-review-card">
                                    <div class="traveller-review-heading">
                                        <strong>
                                            <?= detailEscape($review['title']) ?>
                                        </strong>

                                        <?php if (is_numeric($review['rating'])): ?>
                                            <span>
                                                <i class="fa-solid fa-star"></i>
                                                <?= detailEscape($review['rating']) ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    <?php if ($review['content'] !== ''): ?>
                                        <p><?= detailEscape($review['content']) ?></p>
                                    <?php endif; ?>

                                    <div class="traveller-review-meta">
                                        <?= detailEscape($review['author']) ?>

                                        <?php if ($review['date'] !== ''): ?>
                                            · <?= detailEscape($review['date']) ?>
                                        <?php endif; ?>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="traveller-review-meta">
                            No written traveller comments are currently available.
                        </p>
                    <?php endif; ?>
                </section>
            </div>

            <aside class="detail-booking-card">
                <div class="booking-card-header">
                    <span>Plan your visit</span>

                    <strong class="<?= $isFree ? 'free' : '' ?>">
                        <?= detailEscape($price) ?>
                    </strong>
                </div>

                <form class="booking-form" method="GET" action="detail.php">
                    <?php if ($slug !== ''): ?>
                        <input type="hidden" name="slug" value="<?= detailEscape($slug) ?>">
                        <input type="hidden" name="check_availability" value="1">
                    <?php else: ?>
                        <input type="hidden" name="id" value="<?= detailEscape($localId) ?>">
                    <?php endif; ?>

                    <label for="detailVisitDate">Visit date</label>

                    <div class="booking-input">
                        <i class="fa-regular fa-calendar"></i>

                        <input
                            type="date"
                            id="detailVisitDate"
                            name="visit_date"
                            value="<?= detailEscape($selectedVisitDate) ?>"
                            min="<?= detailEscape(date('Y-m-d')) ?>"
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
                                    <?= $adult === $selectedAdults ? 'selected' : '' ?>
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
                                <option
                                    value="<?= $child ?>"
                                    <?= $child === $selectedChildren ? 'selected' : '' ?>
                                >
                                    <?= $child ?>
                                    <?= $child === 1 ? 'Child' : 'Children' ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <button
                        type="submit"
                        class="detail-primary-button booking-submit"
                    >
                        <i class="fa-regular fa-calendar-check"></i>
                        Check live availability
                    </button>
                </form>

                <?php if ($availabilityRequested): ?>
                    <p class="availability-result">
                        <?= detailEscape(
                            !empty($availability['summary'])
                                ? $availability['summary']
                                : 'Availability request completed. Continue to Booking.com for current times and ticket options.'
                        ) ?>
                    </p>
                <?php endif; ?>

                <form
                    class="attraction-trip-form"
                    id="attractionTripForm"
                    method="POST"
                    action="/TravelPal/trips/add_to_cart.php"
                >
                    <input type="hidden" name="item_type" value="attraction">
                    <input
                        type="hidden"
                        name="item_key"
                        id="attractionTripKey"
                        value="<?= detailEscape($favoriteKey) ?>-<?= detailEscape($selectedVisitDate) ?>"
                    >
                    <input
                        type="hidden"
                        name="title"
                        value="<?= detailEscape($attraction['name']) ?>"
                    >
                    <input
                        type="hidden"
                        name="subtitle"
                        id="attractionTripSubtitle"
                        value="<?= detailEscape($tripSubtitle) ?>"
                    >
                    <input
                        type="hidden"
                        name="unit_price"
                        value="<?= detailEscape(number_format($tripUnitPrice, 2, '.', '')) ?>"
                    >
                    <input
                        type="hidden"
                        name="quantity"
                        id="attractionTripQuantity"
                        value="<?= $selectedAdults + $selectedChildren ?>"
                    >
                    <input
                        type="hidden"
                        name="booking_data"
                        id="attractionTripBookingData"
                        value="<?= detailEscape($tripBookingData) ?>"
                    >

                    <button
                        type="submit"
                        class="detail-primary-button booking-action-link"
                        id="attractionAddToTripButton"
                    >
                        <i class="fa-solid fa-suitcase-rolling"></i>
                        <span>Add to My Trips</span>
                    </button>

                    <p class="trip-action-note">
                        <i class="fa-solid fa-lock"></i>
                        Sign in is required. Your selected date and tickets will be saved.
                    </p>
                </form>
            </aside>
        </div>
    </div>
<?php endif; ?>

</main>

<?php include '../footer.php'; ?>

<script src="favorites.js?v=20260824-1"></script>
<script>
const saveButton = document.getElementById('detailSaveButton');

const detailDateInput = document.getElementById('detailVisitDate');
const detailAdultsInput = document.getElementById('detailAdults');
const detailChildrenInput = document.getElementById('detailChildren');
const attractionTripForm = document.getElementById('attractionTripForm');
const attractionTripKey = document.getElementById('attractionTripKey');
const attractionTripSubtitle = document.getElementById('attractionTripSubtitle');
const attractionTripQuantity = document.getElementById('attractionTripQuantity');
const attractionTripBookingData = document.getElementById('attractionTripBookingData');
const attractionFavoriteKey = <?= json_encode($favoriteKey ?? '') ?>;
const attractionTripLocation = <?= json_encode($location ?? 'Malaysia') ?>;
const attractionTripImage = <?= json_encode((string) ($attraction['image'] ?? '')) ?>;
const attractionBookingUrl = <?= json_encode($bookingUrl ?? '') ?>;
const attractionPriceLabel = <?= json_encode($price ?? 'Check price') ?>;

function formatTripDate(dateValue) {
    const parts = dateValue.split('-');

    if (parts.length !== 3) {
        return dateValue;
    }

    const date = new Date(Number(parts[0]), Number(parts[1]) - 1, Number(parts[2]));

    return new Intl.DateTimeFormat('en-MY', {
        day: '2-digit',
        month: 'short',
        year: 'numeric'
    }).format(date);
}

window.TravelPalAttractionFavorites.bind('#detailSaveButton', function () {
    const adults = Math.max(1, Number(detailAdultsInput?.value) || 1);
    const children = Math.max(0, Number(detailChildrenInput?.value) || 0);

    return {
        visit_date: detailDateInput?.value || '',
        adults: adults,
        children: children,
        tickets: adults + children,
        duration_hours: 2
    };
});

if (attractionTripForm) {
    attractionTripForm.addEventListener('submit', function (event) {
        if (!window.TravelPalLoginPopup || !window.TravelPalLoginPopup.isLoggedIn) {
            event.preventDefault();

            const popupCopy = document.querySelector('.travelpal-login-content p');

            if (popupCopy) {
                popupCopy.textContent = 'Sign in or create a TravelPal account to add this attraction to My Trips.';
            }

            window.TravelPalLoginPopup?.open();
            return;
        }

        if (!detailDateInput || !detailDateInput.reportValidity()) {
            event.preventDefault();
            return;
        }

        const visitDate = detailDateInput.value;
        const adults = Math.max(1, Number(detailAdultsInput?.value) || 1);
        const children = Math.max(0, Number(detailChildrenInput?.value) || 0);
        const ticketCount = adults + children;

        attractionTripKey.value = attractionFavoriteKey + '-' + visitDate;
        attractionTripSubtitle.value = attractionTripLocation + ' · ' + formatTripDate(visitDate);
        attractionTripQuantity.value = String(ticketCount);
        attractionTripBookingData.value = JSON.stringify({
            visit_date: visitDate,
            adults: adults,
            children: children,
            guests: ticketCount,
            image_url: attractionTripImage,
            booking_url: attractionBookingUrl,
            price_label: attractionPriceLabel
        });
    });
}

if (detailDateInput) {
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');
    const localDate = year + '-' + month + '-' + day;

    detailDateInput.min = localDate;

    if (!detailDateInput.value || detailDateInput.value < localDate) {
        detailDateInput.value = localDate;
    }
}
</script>

</body>
</html>
