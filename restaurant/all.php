<?php
$cities = require __DIR__ . '/api/city_data.php';
$requestedCity = strtolower(trim((string)($_GET['city'] ?? 'johor-bahru')));
if (!isset($cities[$requestedCity])) {
    $requestedCity = 'johor-bahru';
}
$partySize = max(1, min(8, (int)($_GET['party'] ?? 2)));
include '../header.php';
?>
<link rel="stylesheet" href="restaurants.css?v=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<div class="rp-page" id="restaurantResultsPage" data-city="<?php echo htmlspecialchars($requestedCity); ?>" data-party="<?php echo $partySize; ?>">
    <section class="rp-results-hero">
        <div class="rp-shell">
            <span class="rp-kicker">Live restaurant search</span>
            <h1 id="resultsTitle">Restaurants in <?php echo htmlspecialchars($cities[$requestedCity]['city']); ?></h1>
            <p>Compare places, open the full details, or save a restaurant for later.</p>
        </div>
    </section>

    <div class="rp-shell">
        <form class="rp-toolbar" id="resultsFilters">
            <div class="rp-field"><label for="stateFilter">State</label><select id="stateFilter"><?php foreach ($cities as $slug => $city): ?><option value="<?php echo htmlspecialchars($city['state']); ?>" data-city="<?php echo htmlspecialchars($slug); ?>" <?php echo $slug === $requestedCity ? 'selected' : ''; ?>><?php echo htmlspecialchars($city['state']); ?></option><?php endforeach; ?></select></div>
            <div class="rp-field"><label for="cityFilter">City</label><select id="cityFilter"><?php foreach ($cities as $slug => $city): ?><option value="<?php echo htmlspecialchars($slug); ?>" data-state="<?php echo htmlspecialchars($city['state']); ?>" <?php echo $slug === $requestedCity ? 'selected' : ''; ?>><?php echo htmlspecialchars($city['city']); ?></option><?php endforeach; ?></select></div>
            <div class="rp-field"><label for="restaurantKeyword">Restaurant or cuisine</label><input id="restaurantKeyword" type="search" placeholder="Try seafood or Japanese"></div>
            <div class="rp-field"><label for="restaurantSort">Sort</label><select id="restaurantSort"><option value="popular">Most popular</option><option value="rating">Highest rating</option><option value="name">Name A–Z</option></select></div>
        </form>

        <div class="rp-results-summary"><p id="resultsCount">Loading restaurants…</p><a class="rp-link" href="favorites.php"><i class="fa-regular fa-heart"></i> My favorites</a></div>
        <div class="rp-state" id="resultsState"><div class="rp-spinner"></div><h2>Finding restaurants</h2><p>Loading live listings for your selected city.</p></div>
        <div class="rp-card-grid" id="restaurantGrid" hidden></div>
    </div>
</div>

<script src="restaurant_app.js?v=1"></script>
<script>
const cityData = <?php echo json_encode($cities, JSON_UNESCAPED_SLASHES); ?>;
const grid = document.getElementById('restaurantGrid');
const stateBox = document.getElementById('resultsState');
const countBox = document.getElementById('resultsCount');
const titleBox = document.getElementById('resultsTitle');
const stateFilter = document.getElementById('stateFilter');
const cityFilter = document.getElementById('cityFilter');
const keyword = document.getElementById('restaurantKeyword');
const sortBox = document.getElementById('restaurantSort');
let restaurants = [];
let activeCity = document.getElementById('restaurantResultsPage').dataset.city;
const activeParty = Number(document.getElementById('restaurantResultsPage').dataset.party || 2);

function showResultsState(title, text, loading = false) {
    stateBox.hidden = false;
    grid.hidden = true;
    stateBox.innerHTML = `${loading ? '<div class="rp-spinner"></div>' : '<div class="rp-feature__icon" style="margin-inline:auto"><i class="fa-solid fa-utensils"></i></div>'}<h2>${escapeRestaurantHtml(title)}</h2><p>${escapeRestaurantHtml(text)}</p>`;
}

async function loadRestaurants(city) {
    activeCity = city;
    const info = cityData[city];
    titleBox.textContent = `Restaurants in ${info.city}`;
    history.replaceState(null, '', `all.php?city=${encodeURIComponent(city)}&party=${activeParty}`);
    showResultsState('Finding restaurants', `Loading live listings for ${info.city}.`, true);
    countBox.textContent = 'Loading restaurants…';
    try {
        const response = await fetch(`api/restaurant_list.php?city=${encodeURIComponent(city)}&party=${activeParty}`);
        const payload = await response.json();
        if (!response.ok || !payload.ok) throw new Error(payload.message || 'The restaurants could not be loaded.');
        restaurants = (payload.data.restaurants || []).map(item => ({...item, party: activeParty}));
        renderRestaurants();
    } catch (error) {
        showResultsState('Restaurants unavailable', error.message || 'Please try again shortly.');
        countBox.textContent = 'No results loaded';
    }
}

function renderRestaurants() {
    const query = keyword.value.trim().toLowerCase();
    const order = sortBox.value;
    const filtered = restaurants.filter(item => `${item.name} ${item.summary}`.toLowerCase().includes(query));
    filtered.sort((a, b) => order === 'rating' ? Number(b.rating || 0) - Number(a.rating || 0) : order === 'name' ? a.name.localeCompare(b.name) : 0);
    countBox.textContent = `${filtered.length} restaurant${filtered.length === 1 ? '' : 's'} shown`;
    if (!filtered.length) {
        showResultsState('No matching restaurants', 'Try a different restaurant name or cuisine.');
        return;
    }
    grid.innerHTML = filtered.map(item => restaurantCardMarkup(item, activeCity)).join('');
    grid.hidden = false;
    stateBox.hidden = true;
    bindFavoriteButtons();
}

function bindFavoriteButtons() {
    grid.querySelectorAll('[data-favorite-id]').forEach(button => button.addEventListener('click', event => {
        event.preventDefault();
        const item = restaurants.find(entry => String(entry.id) === String(button.dataset.favoriteId));
        if (!item) return;
        item.citySlug = activeCity;
        toggleRestaurantFavorite(item);
        renderRestaurants();
    }));
}

stateFilter.addEventListener('change', () => {
    const city = stateFilter.selectedOptions[0].dataset.city;
    cityFilter.value = city;
    loadRestaurants(city);
});
cityFilter.addEventListener('change', () => {
    stateFilter.value = cityFilter.selectedOptions[0].dataset.state;
    loadRestaurants(cityFilter.value);
});
keyword.addEventListener('input', renderRestaurants);
sortBox.addEventListener('change', renderRestaurants);
loadRestaurants(activeCity);
</script>
<?php include '../footer.php'; ?>
