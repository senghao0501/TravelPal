<?php
$cities = require __DIR__ . '/api/city_data.php';
include '../header.php';
?>
<link rel="stylesheet" href="restaurants.css?v=4">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<div class="rp-page">
    <section class="rp-hero">
        <div class="rp-shell">
            <div class="rp-hero__copy">
                <span class="rp-kicker">Restaurants across Malaysia</span>
                <h1>Find a great place to eat</h1>
                <p>Explore live restaurant listings in eight Malaysian destinations, compare traveler ratings, and save your choices before heading out.</p>
            </div>

            <form class="rp-search" action="all.php" method="get" id="restaurantSearchForm">
                <div class="rp-field">
                    <label for="landingState">State</label>
                    <select id="landingState" required>
                        <?php foreach ($cities as $slug => $city): ?>
                            <option value="<?php echo htmlspecialchars($city['state']); ?>" data-city="<?php echo htmlspecialchars($slug); ?>"><?php echo htmlspecialchars($city['state']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="rp-field">
                    <label for="landingCity">City</label>
                    <select id="landingCity" name="city" required>
                        <?php foreach ($cities as $slug => $city): ?>
                            <option value="<?php echo htmlspecialchars($slug); ?>" data-state="<?php echo htmlspecialchars($city['state']); ?>"><?php echo htmlspecialchars($city['city']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="rp-field">
                    <label for="landingParty">Diners</label>
                    <select id="landingParty" name="party">
                        <?php for ($count = 1; $count <= 8; $count++): ?>
                            <option value="<?php echo $count; ?>" <?php echo $count === 2 ? 'selected' : ''; ?>><?php echo $count; ?> <?php echo $count === 1 ? 'person' : 'people'; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <button class="rp-btn" type="submit">Search Restaurants</button>
            </form>
        </div>
    </section>

    <section class="rp-section">
        <div class="rp-shell">
            <div class="rp-heading">
                <div>
                    <span class="rp-kicker">Eight destinations</span>
                    <h2>Choose where you want to eat</h2>
                </div>
                <a class="rp-link" href="all.php">View all restaurants <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <div class="rp-city-grid">
                <?php foreach ($cities as $slug => $city): ?>
                    <a class="rp-city-card" href="all.php?city=<?php echo urlencode($slug); ?>">
                        <img src="<?php echo htmlspecialchars($city['image']); ?>" alt="<?php echo htmlspecialchars($city['city']); ?>" loading="lazy">
                        <span class="rp-city-card__copy"><small><?php echo htmlspecialchars($city['state']); ?></small><h3><?php echo htmlspecialchars($city['city']); ?></h3></span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php if (!$travelPalLoggedIn): ?>
        <section class="rp-member-wrap" aria-labelledby="restaurantMemberTitle">
            <div class="rp-shell">
                <div class="rp-member-banner">
                    <div class="rp-member-icon" aria-hidden="true"><i class="fa-solid fa-utensils"></i></div>
                    <div class="rp-member-copy">
                        <h2 id="restaurantMemberTitle">Unlock Member Restaurant Benefits</h2>
                        <p>Sign in to save restaurants to your shared favorites and use them in My Trips.</p>
                    </div>
                    <div class="rp-member-actions">
                        <a class="rp-member-button rp-member-button--primary" href="/TravelPal/auth/login.php">Sign In</a>
                        <a class="rp-member-button rp-member-button--secondary" href="/TravelPal/auth/register.php">Register Free</a>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="rp-section rp-section--white" aria-labelledby="restaurantSpotlightTitle">
        <div class="rp-shell">
            <div class="rp-heading">
                <div>
                    <span class="rp-kicker">Dining spotlight</span>
                    <h2 id="restaurantSpotlightTitle">Popular places and typical meal prices</h2>
                </div>
            </div>

            <div class="rp-spotlight" id="restaurantSpotlight" aria-live="polite">
                <a class="rp-spotlight__image" id="spotlightLink" href="all.php?city=johor-bahru">
                    <img id="spotlightImage" src="<?php echo htmlspecialchars($cities['johor-bahru']['image']); ?>" alt="Johor Bahru dining">
                </a>
                <div class="rp-spotlight__content">
                    <span class="rp-kicker" id="spotlightLocation">Johor Bahru, Johor</span>
                    <h3 id="spotlightName">Johor Bahru dining picks</h3>
                    <div class="rp-spotlight__price">
                        <small>Average food price</small>
                        <strong id="spotlightPrice">RM 25–55 per person</strong>
                    </div>
                    <p id="spotlightDescription">Browse popular local kitchens, cafes and casual restaurants selected from the live restaurant search.</p>
                    <div class="rp-spotlight__footer">
                        <span id="spotlightRating"><i class="fa-solid fa-star"></i> Popular local choices</span>
                        <div class="rp-spotlight__dots" id="spotlightDots" aria-label="Featured restaurant slides"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="rp-section rp-section--white">
        <div class="rp-shell">
            <div class="rp-heading">
                <div><span class="rp-kicker">Plan with confidence</span><h2>Everything you need before you go</h2></div>
            </div>
            <div class="rp-feature-grid">
                <article class="rp-feature"><span class="rp-feature__icon"><i class="fa-solid fa-star"></i></span><h3>Real traveler ratings</h3><p>Compare live ratings, review totals and recent comments from the restaurant provider.</p></article>
                <article class="rp-feature"><span class="rp-feature__icon"><i class="fa-solid fa-circle-info"></i></span><h3>Useful restaurant details</h3><p>Check addresses, opening information, contact links, photos and available menu items.</p></article>
                <article class="rp-feature"><span class="rp-feature__icon"><i class="fa-solid fa-heart"></i></span><h3>One shared favorites list</h3><p>Save restaurants together with flights, hotels and attractions, then use the same choices in My Trips.</p></article>
            </div>
        </div>
    </section>

    <section class="rp-section rp-section--white">
        <div class="rp-shell">
            <div class="rp-guide-banner">
                <div><span class="rp-kicker">Prefer local dishes?</span><h2>Open the Malaysia Food Guide</h2><p>Your original guide remains available for browsing signature foods by state and city.</p></div>
                <div><a class="rp-btn" href="food-guide.php"><i class="fa-solid fa-bowl-food"></i> Browse food guide</a></div>
            </div>
        </div>
    </section>
</div>

<script src="restaurant_app.js?v=2"></script>
<script>
const landingState = document.getElementById('landingState');
const landingCity = document.getElementById('landingCity');
function syncLandingCity() {
    const state = landingState.value;
    const option = [...landingCity.options].find(item => item.dataset.state === state);
    if (option) landingCity.value = option.value;
}
landingState.addEventListener('change', syncLandingCity);
landingCity.addEventListener('change', () => {
    const selected = landingCity.selectedOptions[0];
    if (selected) landingState.value = selected.dataset.state;
});
syncLandingCity();

const fallbackSpotlights = [
    <?php
    $fallbackPrices = ['RM 25–55', 'RM 20–50', 'RM 25–65', 'RM 18–45', 'RM 20–55', 'RM 22–58', 'RM 30–75', 'RM 18–48'];
    $fallbackDescriptions = [
        'Explore heritage cafes, family restaurants and local Johor favourites.',
        'Discover Peranakan cooking, riverside dining and classic Melaka flavours.',
        'Compare modern cafes, local restaurants and popular Selangor dining spots.',
        'Find old-town coffee shops, local noodle houses and well-loved Ipoh dishes.',
        'Browse hawker favourites, heritage restaurants and George Town cafes.',
        'Explore seafood restaurants, local rice dishes and relaxed Kuantan dining.',
        'Discover fresh seafood, night markets and waterfront restaurants in Sabah.',
        'Try Sarawak favourites, heritage cafes and welcoming Kuching restaurants.',
    ];
    $fallbackIndex = 0;
    foreach ($cities as $slug => $city):
    ?>
    {
        id: <?php echo json_encode('fallback-' . $slug); ?>,
        name: <?php echo json_encode($city['city'] . ' dining picks'); ?>,
        city: <?php echo json_encode($city['city']); ?>,
        state: <?php echo json_encode($city['state']); ?>,
        citySlug: <?php echo json_encode($slug); ?>,
        image: <?php echo json_encode($city['image']); ?>,
        summary: <?php echo json_encode($fallbackDescriptions[$fallbackIndex]); ?>,
        price: <?php echo json_encode($fallbackPrices[$fallbackIndex]); ?>,
        rating: ''
    },
    <?php $fallbackIndex++; endforeach; ?>
];

const spotlightElements = {
    root: document.getElementById('restaurantSpotlight'),
    link: document.getElementById('spotlightLink'),
    image: document.getElementById('spotlightImage'),
    location: document.getElementById('spotlightLocation'),
    name: document.getElementById('spotlightName'),
    price: document.getElementById('spotlightPrice'),
    description: document.getElementById('spotlightDescription'),
    rating: document.getElementById('spotlightRating'),
    dots: document.getElementById('spotlightDots')
};
let spotlightItems = fallbackSpotlights.slice(0, 6);
let spotlightIndex = 0;
let spotlightTimer;

function restaurantPriceRange(summary) {
    const groups = String(summary || '').match(/\${1,4}/g) || [];
    const levels = {1: [12, 30], 2: [30, 65], 3: [65, 130], 4: [130, 220]};
    const first = levels[Math.min(4, groups[0]?.length || 2)];
    const last = levels[Math.min(4, groups.at(-1)?.length || groups[0]?.length || 2)];
    return `RM ${first[0]}–${last[1]}`;
}

function renderSpotlight(index) {
    const item = spotlightItems[index];
    if (!item) return;
    const detailUrl = String(item.id).startsWith('fallback-')
        ? `all.php?city=${encodeURIComponent(item.citySlug)}`
        : `detail.php?id=${encodeURIComponent(item.id)}&city=${encodeURIComponent(item.citySlug)}&party=2`;
    spotlightElements.root.classList.remove('is-changing');
    void spotlightElements.root.offsetWidth;
    spotlightElements.root.classList.add('is-changing');
    spotlightElements.link.href = detailUrl;
    spotlightElements.image.src = item.image || fallbackSpotlights[0].image;
    spotlightElements.image.alt = item.name;
    spotlightElements.location.textContent = `${item.city}, ${item.state}`;
    spotlightElements.name.textContent = item.name;
    spotlightElements.price.textContent = `${item.price || restaurantPriceRange(item.summary)} per person`;
    spotlightElements.description.textContent = item.summary || 'Open the live listing to view traveler ratings and restaurant details.';
    spotlightElements.rating.innerHTML = item.rating
        ? `<i class="fa-solid fa-star"></i> ${escapeRestaurantHtml(item.rating)} · ${escapeRestaurantHtml(item.reviewCount || 'Traveler rated')}`
        : '<i class="fa-solid fa-utensils"></i> Popular local choices';
    spotlightElements.dots.querySelectorAll('button').forEach((dot, dotIndex) => {
        dot.classList.toggle('is-active', dotIndex === index);
        dot.setAttribute('aria-current', dotIndex === index ? 'true' : 'false');
    });
}

function buildSpotlightDots() {
    spotlightElements.dots.innerHTML = spotlightItems.map((item, index) =>
        `<button type="button" aria-label="Show ${escapeRestaurantHtml(item.name)}" class="${index === spotlightIndex ? 'is-active' : ''}"></button>`
    ).join('');
    spotlightElements.dots.querySelectorAll('button').forEach((dot, index) => dot.addEventListener('click', () => {
        spotlightIndex = index;
        renderSpotlight(spotlightIndex);
        startSpotlightTimer();
    }));
}

function startSpotlightTimer() {
    clearInterval(spotlightTimer);
    spotlightTimer = setInterval(() => {
        spotlightIndex = (spotlightIndex + 1) % spotlightItems.length;
        renderSpotlight(spotlightIndex);
    }, 5000);
}

async function loadSpotlights() {
    buildSpotlightDots();
    renderSpotlight(spotlightIndex);
    startSpotlightTimer();
    try {
        const response = await fetch('api/restaurant_list.php?city=johor-bahru&party=2');
        const payload = await response.json();
        if (!response.ok || !payload.ok) return;
        const liveItems = (payload.data.restaurants || []).filter(item => item.image).slice(0, 6);
        if (!liveItems.length) return;
        spotlightItems = liveItems.map(item => ({...item, citySlug: 'johor-bahru', price: restaurantPriceRange(item.summary)}));
        spotlightIndex = 0;
        buildSpotlightDots();
        renderSpotlight(spotlightIndex);
        startSpotlightTimer();
    } catch (error) {
        // The prepared city spotlights remain visible when the live service is unavailable.
    }
}

spotlightElements.root.addEventListener('mouseenter', () => clearInterval(spotlightTimer));
spotlightElements.root.addEventListener('mouseleave', startSpotlightTimer);
loadSpotlights();

<?php if (!$travelPalLoggedIn): ?>
window.addEventListener('load', () => {
    window.setTimeout(() => window.TravelPalLoginPopup?.open(), 250);
}, {once: true});
<?php endif; ?>
</script>
<?php include '../footer.php'; ?>
