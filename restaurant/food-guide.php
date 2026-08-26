<?php
require_once __DIR__ . '/food_data.php';
include __DIR__ . '/../header.php';

function food_escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

$states = array_values(array_unique(array_column($foodOptions, 'state')));
sort($states);
?>

<link rel="stylesheet" href="/TravelPal/restaurant/restaurant.css?v=2">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="food-guide-page">
    <section class="food-hero">
        <div class="food-hero__content">
            <span class="food-kicker">MALAYSIA FOOD GUIDE</span>
            <h1>Plan what to eat before heading out</h1>
            <p>Filter local food by state and city, compare typical prices, and open each dish for useful details before heading out.</p>
        </div>
    </section>

    <section class="food-filter-section" aria-labelledby="filterTitle">
        <div class="food-section-heading">
            <div>
                <span class="food-eyebrow">Explore local flavours</span>
                <h2 id="filterTitle">Find food for your trip</h2>
            </div>
            <p>Available for eight selected Malaysian states.</p>
        </div>

        <form id="foodFilterForm" class="food-filter-bar">
            <div class="food-field">
                <label for="stateFilter"><i class="fa-solid fa-map-location-dot"></i> State</label>
                <select id="stateFilter" name="state">
                    <option value="">All states</option>
                    <?php foreach ($states as $state): ?>
                        <option value="<?php echo food_escape($state); ?>"><?php echo food_escape($state); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="food-field">
                <label for="cityFilter"><i class="fa-solid fa-city"></i> City</label>
                <select id="cityFilter" name="city" disabled>
                    <option value="">All cities</option>
                </select>
            </div>

            <div class="food-field food-field--search">
                <label for="foodSearch"><i class="fa-solid fa-magnifying-glass"></i> Food</label>
                <input id="foodSearch" name="food" type="search" placeholder="Example: laksa or coffee">
            </div>

            <button type="submit" class="food-filter-button">
                <i class="fa-solid fa-filter"></i> Apply filters
            </button>
        </form>

        <div class="food-state-shortcuts" aria-label="Quick state filters">
            <button type="button" class="food-state-chip active" data-state="">All</button>
            <?php foreach ($states as $state): ?>
                <button type="button" class="food-state-chip" data-state="<?php echo food_escape($state); ?>">
                    <?php echo food_escape($state); ?>
                </button>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="food-content-section">
        <div class="food-results-column">
            <div class="food-results-header">
                <div>
                    <span class="food-eyebrow">Recommended dishes</span>
                    <h2>Food options</h2>
                </div>
                <span id="foodResultCount" class="food-result-count"><?php echo count($foodOptions); ?> options</span>
            </div>

            <div id="foodCards" class="food-card-grid">
                <?php foreach ($foodOptions as $food): ?>
                    <article class="food-card"
                             data-id="<?php echo (int)$food['id']; ?>"
                             data-state="<?php echo food_escape($food['state']); ?>"
                             data-city="<?php echo food_escape($food['city']); ?>"
                             data-search="<?php echo food_escape(strtolower($food['name'] . ' ' . $food['category'] . ' ' . $food['description'])); ?>">
                        <a class="food-card__image-link" href="food-detail.php?id=<?php echo (int)$food['id']; ?>" aria-label="View details for <?php echo food_escape($food['name']); ?>">
                            <div class="food-card__image-wrap">
                                <img src="<?php echo food_escape($food['image']); ?>"
                                     alt="<?php echo food_escape($food['name']); ?>"
                                     loading="lazy">
                                <span class="food-card__category"><?php echo food_escape($food['category']); ?></span>
                                <span class="food-card__view"><i class="fa-solid fa-arrow-up-right-from-square"></i> View details</span>
                            </div>
                        </a>

                        <div class="food-card__body">
                            <div class="food-card__location">
                                <i class="fa-solid fa-location-dot"></i>
                                <?php echo food_escape($food['city']); ?>, <?php echo food_escape($food['state']); ?>
                            </div>
                            <h3><a href="food-detail.php?id=<?php echo (int)$food['id']; ?>"><?php echo food_escape($food['name']); ?></a></h3>
                            <p><?php echo food_escape($food['description']); ?></p>

                            <div class="food-card__meta">
                                <span><i class="fa-solid fa-wallet"></i> <?php echo food_escape($food['price']); ?></span>
                                <span><i class="fa-regular fa-clock"></i> <?php echo food_escape($food['best_time']); ?></span>
                            </div>

                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <div id="foodEmptyState" class="food-empty-state" hidden>
                <i class="fa-solid fa-bowl-food"></i>
                <h3>No food options found</h3>
                <p>Try another state, city or search word.</p>
                <button type="button" id="resetFoodFilters">Reset filters</button>
            </div>
        </div>

    </section>
</div>

<script src="/TravelPal/restaurant/restaurant_app.js?v=2"></script>
<script>
const foodOptions = <?php echo json_encode($foodOptions, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;

const stateFilter = document.getElementById('stateFilter');
const cityFilter = document.getElementById('cityFilter');
const foodSearch = document.getElementById('foodSearch');
const foodCards = Array.from(document.querySelectorAll('.food-card'));
const resultCount = document.getElementById('foodResultCount');
const emptyState = document.getElementById('foodEmptyState');

function getCitiesForState(state) {
    return [...new Set(foodOptions.filter(food => !state || food.state === state).map(food => food.city))].sort();
}

function updateCityFilter() {
    const selectedState = stateFilter.value;
    const previousCity = cityFilter.value;
    const cities = getCitiesForState(selectedState);

    cityFilter.innerHTML = '<option value="">All cities</option>';
    cities.forEach(city => {
        const option = document.createElement('option');
        option.value = city;
        option.textContent = city;
        cityFilter.appendChild(option);
    });

    cityFilter.disabled = selectedState === '';
    if (cities.includes(previousCity)) cityFilter.value = previousCity;
}

function applyFilters() {
    const state = stateFilter.value;
    const city = cityFilter.value;
    const search = foodSearch.value.trim().toLowerCase();
    let visibleCount = 0;

    foodCards.forEach(card => {
        const isVisible = (!state || card.dataset.state === state)
            && (!city || card.dataset.city === city)
            && (!search || card.dataset.search.includes(search));
        card.hidden = !isVisible;
        if (isVisible) visibleCount += 1;
    });

    resultCount.textContent = `${visibleCount} ${visibleCount === 1 ? 'option' : 'options'}`;
    emptyState.hidden = visibleCount !== 0;
    updateStateChips();
}

function updateStateChips() {
    document.querySelectorAll('.food-state-chip').forEach(chip => {
        chip.classList.toggle('active', chip.dataset.state === stateFilter.value);
    });
}

function resetFilters() {
    stateFilter.value = '';
    cityFilter.value = '';
    foodSearch.value = '';
    updateCityFilter();
    applyFilters();
}

document.getElementById('foodFilterForm').addEventListener('submit', event => {
    event.preventDefault();
    applyFilters();
});
stateFilter.addEventListener('change', () => {
    updateCityFilter();
    applyFilters();
});
cityFilter.addEventListener('change', applyFilters);
foodSearch.addEventListener('input', applyFilters);
document.querySelectorAll('.food-state-chip').forEach(chip => {
    chip.addEventListener('click', () => {
        stateFilter.value = chip.dataset.state;
        updateCityFilter();
        applyFilters();
    });
});
document.getElementById('resetFoodFilters').addEventListener('click', resetFilters);

updateCityFilter();
applyFilters();
</script>

<?php include __DIR__ . '/../footer.php'; ?>
