<?php

require_once 'attractions_data.php';
require_once 'api_functions.php';

$mustVisitAttractions = getMustVisitAttractions($attraction_regions, 2);
$savedAttractionKeys = attractionFavoriteKeysForCurrentUser();

$destinationDescriptions = [
    'johor' => 'Theme parks, islands and royal heritage',
    'melaka' => 'Historic streets and riverside culture',
    'selangor' => 'Caves, city attractions and family fun',
    'perak' => 'Limestone caves and Ipoh heritage',
    'penang' => 'UNESCO heritage, hills and beaches',
    'pahang' => 'Highlands, rainforest and theme parks',
    'sabah' => 'Mountains, islands and wildlife',
    'sarawak' => 'Rainforests, caves and living culture'
];

function attractionEscape($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function attractionDetailUrl(array $attraction): string
{
    if (
        ($attraction['source'] ?? '') === 'api'
        && !empty($attraction['slug'])
    ) {
        return 'detail.php?slug=' . rawurlencode((string) $attraction['slug']);
    }

    return 'detail.php?id=' . rawurlencode((string) $attraction['id']);
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

<link rel="stylesheet" href="../css/modules/attractions.css?v=20260824-2">
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
>

<style>
.must-visit-heading-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 20px;
    margin-bottom: 18px;
}

.carousel-meta {
    color: #6b7280;
    font-size: 13px;
    white-space: nowrap;
}

.carousel-wrapper {
    position: relative;
}

.attraction-carousel {
    display: flex;
    gap: 18px;
    overflow-x: auto;
    padding: 8px 4px 18px;
    scroll-behavior: smooth;
    scroll-snap-type: x mandatory;
    scrollbar-width: none;
}

.attraction-carousel::-webkit-scrollbar {
    display: none;
}

.attraction-carousel .property-card {
    flex: 0 0 288px;
    min-width: 288px;
    scroll-snap-align: start;
}

.card-region-badge {
    position: absolute;
    left: 12px;
    top: 12px;
    z-index: 2;
    padding: 5px 9px;
    border-radius: 999px;
    background: rgba(46, 16, 101, .9);
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    backdrop-filter: blur(6px);
}

.card-source {
    margin: 0 0 8px;
    color: #7c3aed;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .04em;
}

.carousel-btn {
    position: absolute;
    top: 43%;
    z-index: 10;
    width: 46px;
    height: 46px;
    border: 1px solid #ddd6fe;
    border-radius: 50%;
    background: #fff;
    color: #4c1d95;
    box-shadow: 0 8px 24px rgba(46, 16, 101, .2);
    cursor: pointer;
    transition: .2s ease;
}

.carousel-btn:hover {
    transform: translateY(-2px);
    background: #4c1d95;
    color: #fff;
}

.carousel-btn.left {
    left: -23px;
}

.carousel-btn.right {
    right: -23px;
}

.carousel-progress {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    color: #6b7280;
    font-size: 12px;
}

.carousel-progress-line {
    width: 120px;
    height: 4px;
    overflow: hidden;
    border-radius: 999px;
    background: #e5e7eb;
}

.carousel-progress-fill {
    display: block;
    width: 0;
    height: 100%;
    border-radius: inherit;
    background: linear-gradient(90deg, #7c3aed, #10b981);
    transition: width .2s ease;
}

@media (max-width: 768px) {
    .carousel-btn {
        display: none;
    }

    .attraction-carousel .property-card {
        flex-basis: 82vw;
        min-width: 82vw;
    }

    .must-visit-heading-row {
        display: block;
    }

    .carousel-meta {
        display: block;
        margin-top: 8px;
    }
}
</style>

<section class="hero-section">
    <div class="search-container">
        <div class="hero-content">
            <span
                style="display:block;margin-bottom:10px;font-size:12px;letter-spacing:.12em;font-weight:700;color:rgba(255,255,255,.72);"
            >
                TRAVELPAL ATTRACTIONS
            </span>

            <h1>Discover Top Attractions in Malaysia</h1>

            <p>
                Explore Johor, Melaka, Selangor, Perak, Penang,
                Pahang, Sabah and Sarawak.
            </p>
        </div>

        <div class="vibe-tags">
            <button
                type="button"
                class="vibe-pill active"
                data-category="all"
            >
                <i class="fa-solid fa-compass"></i>
                All Attractions
            </button>

            <button
                type="button"
                class="vibe-pill"
                data-category="heritage"
            >
                <i class="fa-solid fa-landmark-dome"></i>
                Heritage & Culture
            </button>

            <button
                type="button"
                class="vibe-pill"
                data-category="nature"
            >
                <i class="fa-solid fa-tree"></i>
                Nature & Wildlife
            </button>

            <button
                type="button"
                class="vibe-pill"
                data-category="theme"
            >
                <i class="fa-solid fa-ticket-simple"></i>
                Theme Parks
            </button>
        </div>

        <form
            action="after_search.php"
            method="GET"
            class="filter-bar"
        >
            <input
                type="hidden"
                name="category"
                id="categoryFilter"
                value="all"
            >

            <div class="input-group">
                <i class="fa-solid fa-location-dot icon"></i>

                <div class="input-wrapper">
                    <label for="destination">Destination / State</label>

                    <select name="region" id="destination" required>
                        <option value="johor">Johor · Johor Bahru</option>
                        <option value="melaka">Melaka</option>
                        <option value="selangor" selected>Selangor</option>
                        <option value="perak">Perak · Ipoh</option>
                        <option value="penang">Penang</option>
                        <option value="pahang">Pahang</option>
                        <option value="sabah">Sabah</option>
                        <option value="sarawak">Sarawak</option>
                    </select>
                </div>
            </div>

            <div class="input-group">
                <i class="fa-regular fa-calendar-check icon"></i>

                <div class="input-wrapper">
                    <label for="visit_date">Visit Date</label>

                    <input
                        type="date"
                        name="visit_date"
                        id="visit_date"
                        required
                    >
                </div>
            </div>

            <div class="input-group guest-selector-group">
                <i class="fa-solid fa-ticket icon"></i>

                <div
                    class="input-wrapper"
                    id="ticketInputTrigger"
                    role="button"
                    tabindex="0"
                >
                    <label>Tickets</label>
                    <div class="guest-display-text" id="ticketSummary">
                        2 Adults
                    </div>
                </div>

                <input
                    type="hidden"
                    name="adults"
                    id="input_adults"
                    value="2"
                >

                <input
                    type="hidden"
                    name="children"
                    id="input_children"
                    value="0"
                >

                <div
                    class="guest-picker-dropdown"
                    id="ticketDropdown"
                    style="display:none;"
                >
                    <div class="picker-row">
                        <div class="picker-info">
                            <span class="picker-title">Adults</span>
                            <span class="picker-subtitle">Ages 13+</span>
                        </div>

                        <div class="counter-controls">
                            <button
                                type="button"
                                class="btn-counter"
                                onclick="updateTicket('adults', -1)"
                            >−</button>

                            <span class="counter-value" id="cnt_adults">2</span>

                            <button
                                type="button"
                                class="btn-counter"
                                onclick="updateTicket('adults', 1)"
                            >+</button>
                        </div>
                    </div>

                    <div class="picker-row">
                        <div class="picker-info">
                            <span class="picker-title">Children</span>
                            <span class="picker-subtitle">Ages 3–12</span>
                        </div>

                        <div class="counter-controls">
                            <button
                                type="button"
                                class="btn-counter"
                                onclick="updateTicket('children', -1)"
                            >−</button>

                            <span class="counter-value" id="cnt_children">0</span>

                            <button
                                type="button"
                                class="btn-counter"
                                onclick="updateTicket('children', 1)"
                            >+</button>
                        </div>
                    </div>

                    <button
                        type="button"
                        class="btn-picker-done"
                        onclick="closeTicketDropdown()"
                    >
                        Done
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-search">
                <i class="fa-solid fa-magnifying-glass"></i>
                Search Tickets
            </button>
        </form>
    </div>
</section>

<div class="main-content">
    <section class="gallery-section" style="margin-bottom:55px;">
        <div class="must-visit-heading-row">
            <div class="section-header" style="margin-bottom:0;">
                <h2>Must-Visit Attractions</h2>

                <p>
                    Two selected experiences from every supported
                    Malaysian state or destination
                </p>
            </div>

            <div class="carousel-meta">
                8 destinations · <?= count($mustVisitAttractions) ?> attractions
            </div>
        </div>

        <div class="carousel-wrapper">
            <button
                type="button"
                class="carousel-btn left"
                id="carouselPrevious"
                aria-label="Previous attractions"
            >
                <i class="fa-solid fa-chevron-left"></i>
            </button>

            <div
                class="attraction-carousel"
                id="mustVisitCarousel"
                tabindex="0"
                aria-label="Must-visit attractions carousel"
            >
                <?php foreach ($mustVisitAttractions as $attraction): ?>
                    <?php
                    $detailUrl = attractionDetailUrl($attraction);
                    $favoriteKey = attractionFavoriteKey($attraction);
                    $isFavorite = isset($savedAttractionKeys[$favoriteKey]);
                    $favoriteData = json_encode([
                        'item_key' => $favoriteKey,
                        'title' => (string) ($attraction['name'] ?? 'Attraction'),
                        'subtitle' => (string) ($attraction['location'] ?? 'Malaysia'),
                        'image_url' => (string) ($attraction['image'] ?? ''),
                        'unit_price' => attractionPriceAmount(
                            (string) ($attraction['price'] ?? 'Check price')
                        ),
                        'metadata' => [
                            'duration_hours' => 2,
                            'tickets' => 2,
                        ],
                    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?: '{}';
                    ?>

                    <article
                        class="property-card"
                        data-type="<?= attractionEscape($attraction['type']) ?>"
                        data-url="<?= attractionEscape($detailUrl) ?>"
                        tabindex="0"
                        role="link"
                    >
                        <div class="card-img-wrapper">
                            <span class="card-region-badge">
                                <?= attractionEscape($attraction['location']) ?>
                            </span>

                            <img
                                src="<?= attractionEscape($attraction['image']) ?>"
                                alt="<?= attractionEscape($attraction['name']) ?>"
                                loading="lazy"
                                onerror="this.onerror=null;this.src='<?= attractionEscape($placeholderImage) ?>';"
                            >

                            <button
                                type="button"
                                class="heart-btn<?= $isFavorite ? ' saved' : '' ?>"
                                data-favorite="<?= attractionEscape($favoriteData) ?>"
                                aria-label="Save <?= attractionEscape($attraction['name']) ?>"
                                aria-pressed="<?= $isFavorite ? 'true' : 'false' ?>"
                            >
                                <i class="<?= $isFavorite ? 'fa-solid' : 'fa-regular' ?> fa-heart"></i>
                            </button>
                        </div>

                        <div class="card-content">
                            <p class="card-source">
                                <?= attractionEscape($attraction['type']) ?>
                            </p>

                            <h3
                                title="<?= attractionEscape($attraction['name']) ?>"
                                style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"
                            >
                                <?= attractionEscape($attraction['name']) ?>
                            </h3>

                            <p class="location">
                                <i class="fa-solid fa-location-dot"></i>
                                <?= attractionEscape($attraction['location']) ?>
                            </p>

                            <div class="card-footer">
                                <span class="rating">
                                    <i class="fa-solid fa-star"></i>
                                    <?= attractionEscape($attraction['rating']) ?>

                                    <?php if (!empty($attraction['review_count'])): ?>
                                        (<?= number_format((int) $attraction['review_count']) ?>)
                                    <?php endif; ?>
                                </span>

                                <span class="price" style="font-size:16px;">
                                    <?= attractionEscape($attraction['price']) ?>
                                </span>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <button
                type="button"
                class="carousel-btn right"
                id="carouselNext"
                aria-label="Next attractions"
            >
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>

        <div class="carousel-progress">
            <span id="carouselPosition">
                <?= $mustVisitAttractions === [] ? 0 : 1 ?>
                / <?= count($mustVisitAttractions) ?>
            </span>

            <span class="carousel-progress-line">
                <span
                    class="carousel-progress-fill"
                    id="carouselProgressFill"
                ></span>
            </span>
        </div>
    </section>

    <section class="property-types-section">
        <div class="section-header">
            <h2>Browse by Destination</h2>
            <p>Choose one of TravelPal’s eight Malaysian destinations</p>
        </div>

        <div class="property-grid">
            <?php foreach ($attraction_regions as $regionKey => $region): ?>
                <a
                    href="after_search.php?region=<?= rawurlencode($regionKey) ?>&amp;category=all"
                    class="category-card"
                    aria-label="Explore attractions in <?= attractionEscape($region['label']) ?>"
                >
                    <div class="destination-card-top">
                        <div class="property-icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>

                        <span class="destination-arrow" aria-hidden="true">
                            <i class="fa-solid fa-arrow-right"></i>
                        </span>
                    </div>

                    <h3><?= attractionEscape($region['label']) ?></h3>

                    <p class="destination-description">
                        <?= attractionEscape(
                            $destinationDescriptions[$regionKey]
                            ?? 'Discover popular Malaysian attractions'
                        ) ?>
                    </p>

                    <span class="destination-action">
                        Explore attractions
                        <i class="fa-solid fa-arrow-right"></i>
                    </span>
                </a>
            <?php endforeach; ?>
        </div>
    </section>
</div>

</main>

<?php include '../footer.php'; ?>

<script src="favorites.js?v=20260824-1"></script>
<script>
const carousel = document.getElementById('mustVisitCarousel');
const previousButton = document.getElementById('carouselPrevious');
const nextButton = document.getElementById('carouselNext');
const positionText = document.getElementById('carouselPosition');
const progressFill = document.getElementById('carouselProgressFill');

function getCarouselStep() {
    const card = carousel.querySelector('.property-card');

    if (!card) {
        return 300;
    }

    const style = window.getComputedStyle(carousel);
    const gap = parseFloat(style.columnGap || style.gap || 0);
    return card.getBoundingClientRect().width + gap;
}

function moveCarousel(direction) {
    const maximumScroll = carousel.scrollWidth - carousel.clientWidth;
    const nearStart = carousel.scrollLeft <= 8;
    const nearEnd = carousel.scrollLeft >= maximumScroll - 8;

    if (direction > 0 && nearEnd) {
        carousel.scrollTo({left: 0, behavior: 'smooth'});
        return;
    }

    if (direction < 0 && nearStart) {
        carousel.scrollTo({left: maximumScroll, behavior: 'smooth'});
        return;
    }

    carousel.scrollBy({
        left: direction * getCarouselStep() * 2,
        behavior: 'smooth'
    });
}

function updateCarouselProgress() {
    const cards = carousel.querySelectorAll('.property-card');
    const step = getCarouselStep();
    const visibleIndex = Math.round(carousel.scrollLeft / step);
    const current = cards.length === 0
        ? 0
        : Math.min(cards.length, visibleIndex + 1);
    const maximumScroll = carousel.scrollWidth - carousel.clientWidth;

    positionText.textContent = current + ' / ' + cards.length;

    const percentage = maximumScroll > 0
        ? (carousel.scrollLeft / maximumScroll) * 100
        : 100;

    progressFill.style.width = Math.max(5, percentage) + '%';
}

previousButton.addEventListener('click', function () {
    moveCarousel(-1);
});

nextButton.addEventListener('click', function () {
    moveCarousel(1);
});

carousel.addEventListener('scroll', updateCarouselProgress);
window.addEventListener('resize', updateCarouselProgress);

carousel.addEventListener('keydown', function (event) {
    if (event.key === 'ArrowRight') {
        event.preventDefault();
        moveCarousel(1);
    }

    if (event.key === 'ArrowLeft') {
        event.preventDefault();
        moveCarousel(-1);
    }
});

const ticketCounts = {
    adults: 2,
    children: 0
};

function updateTicket(type, change) {
    const minimum = type === 'adults' ? 1 : 0;
    const maximum = 15;
    const nextValue = ticketCounts[type] + change;

    if (nextValue < minimum || nextValue > maximum) {
        return;
    }

    ticketCounts[type] = nextValue;
    document.getElementById('cnt_' + type).textContent = ticketCounts[type];
    document.getElementById('input_' + type).value = ticketCounts[type];

    const adultText = ticketCounts.adults
        + (ticketCounts.adults === 1 ? ' Adult' : ' Adults');
    const childText = ticketCounts.children
        + (ticketCounts.children === 1 ? ' Child' : ' Children');

    document.getElementById('ticketSummary').textContent =
        ticketCounts.children > 0
            ? adultText + ', ' + childText
            : adultText;
}

const ticketTrigger = document.getElementById('ticketInputTrigger');
const ticketDropdown = document.getElementById('ticketDropdown');

function toggleTicketDropdown() {
    ticketDropdown.style.display =
        ticketDropdown.style.display === 'block' ? 'none' : 'block';
}

function closeTicketDropdown() {
    ticketDropdown.style.display = 'none';
}

ticketTrigger.addEventListener('click', function (event) {
    event.stopPropagation();
    toggleTicketDropdown();
});

ticketTrigger.addEventListener('keydown', function (event) {
    if (event.key === 'Enter' || event.key === ' ') {
        event.preventDefault();
        toggleTicketDropdown();
    }
});

ticketDropdown.addEventListener('click', function (event) {
    event.stopPropagation();
});

document.addEventListener('click', closeTicketDropdown);

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('#mustVisitCarousel .property-card').forEach(
        function (card) {
            card.addEventListener('click', function () {
                window.location.href = card.dataset.url;
            });

            card.addEventListener('keydown', function (event) {
                if (event.key === 'Enter') {
                    window.location.href = card.dataset.url;
                }
            });
        }
    );

    window.TravelPalAttractionFavorites.bind('.heart-btn', function () {
        return {
            adults: ticketCounts.adults,
            children: ticketCounts.children,
            tickets: ticketCounts.adults + ticketCounts.children,
            duration_hours: 2
        };
    });

    const dateInput = document.getElementById('visit_date');
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');
    const localDate = year + '-' + month + '-' + day;

    dateInput.min = localDate;
    dateInput.value = localDate;
    updateCarouselProgress();
});

const categoryInput = document.getElementById('categoryFilter');

document.querySelectorAll('.vibe-pill').forEach(function (button) {
    button.addEventListener('click', function () {
        document.querySelectorAll('.vibe-pill').forEach(
            item => item.classList.remove('active')
        );

        button.classList.add('active');
        categoryInput.value = button.dataset.category;
    });
});
</script>

</body>
</html>
