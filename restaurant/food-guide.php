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

<link rel="stylesheet" href="/TravelPal/restaurant/restaurant.css?v=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="food-guide-page">
    <section class="food-hero">
        <div class="food-hero__content">
            <span class="food-kicker">MALAYSIA FOOD GUIDE</span>
            <h1>Plan what to eat before heading out</h1>
            <p>Filter local food by state and city, then save your choices into one simple travel food list.</p>
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

                            <button type="button" class="food-add-button" data-food-id="<?php echo (int)$food['id']; ?>">
                                <i class="fa-solid fa-plus"></i>
                                <span>Add to Favorites</span>
                            </button>
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

        <aside class="food-list-panel" aria-labelledby="foodListTitle">
            <div class="food-list-panel__header">
                <div>
                    <span class="food-eyebrow">Before heading out</span>
                    <h2 id="foodListTitle">My Favorites</h2>
                </div>
                <span id="savedFoodCount" class="food-list-count">0</span>
            </div>

            <p class="food-list-help">Saved food stays on this device. My Trips can use this same favorite list later.</p>

            <div id="savedFoodList" class="saved-food-list"></div>

            <div id="savedFoodEmpty" class="saved-food-empty">
                <i class="fa-regular fa-heart"></i>
                <p>No favorites yet.</p>
                <span>Save food options from the guide.</span>
            </div>

            <div class="food-list-actions">
                <button type="button" id="clearFoodList" class="food-list-action">
                    <i class="fa-regular fa-trash-can"></i> Clear
                </button>
            </div>
        </aside>
    </section>
</div>

<div id="foodToast" class="food-toast" role="status" aria-live="polite"></div>

<script>
const foodOptions = <?php echo json_encode($foodOptions, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
const foodById = new Map(foodOptions.map(food => [Number(food.id), food]));
// The My Trips page can read this same key when synchronization is added later.
const storageKey = 'travelpal_food_favorites_v1';
const previousStorageKey = 'travelpal_food_list_v1';

const stateFilter = document.getElementById('stateFilter');
const cityFilter = document.getElementById('cityFilter');
const foodSearch = document.getElementById('foodSearch');
const foodCards = Array.from(document.querySelectorAll('.food-card'));
const resultCount = document.getElementById('foodResultCount');
const emptyState = document.getElementById('foodEmptyState');
const savedListElement = document.getElementById('savedFoodList');
const savedEmptyElement = document.getElementById('savedFoodEmpty');
const savedCountElement = document.getElementById('savedFoodCount');
const toast = document.getElementById('foodToast');

let savedFoodIds = loadSavedFoodIds();
let toastTimer;

function loadSavedFoodIds() {
    try {
        const currentValue = localStorage.getItem(storageKey);
        const previousValue = localStorage.getItem(previousStorageKey);
        const stored = JSON.parse(currentValue || previousValue || '[]');
        if (!currentValue && previousValue) {
            localStorage.setItem(storageKey, JSON.stringify(stored));
        }
        return Array.isArray(stored) ? stored.map(Number).filter(id => foodById.has(id)) : [];
    } catch (error) {
        return [];
    }
}

function saveFoodIds() {
    localStorage.setItem(storageKey, JSON.stringify(savedFoodIds));
}

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

function showToast(message) {
    toast.textContent = message;
    toast.classList.add('show');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => toast.classList.remove('show'), 2200);
}

function toggleFood(foodId) {
    const existingIndex = savedFoodIds.indexOf(foodId);
    if (existingIndex >= 0) {
        savedFoodIds.splice(existingIndex, 1);
        showToast('Removed from Favorites');
    } else {
        savedFoodIds.push(foodId);
        showToast('Added to Favorites');
    }
    saveFoodIds();
    renderSavedFoodList();
    updateAddButtons();
}

function renderSavedFoodList() {
    savedListElement.innerHTML = '';
    savedFoodIds.forEach(id => {
        const food = foodById.get(id);
        if (!food) return;

        const item = document.createElement('div');
        item.className = 'saved-food-item';
        const details = document.createElement('div');
        details.className = 'saved-food-item__details';
        const name = document.createElement('strong');
        name.textContent = food.name;
        const location = document.createElement('span');
        location.textContent = `${food.city}, ${food.state}`;
        const price = document.createElement('small');
        price.textContent = food.price;
        details.append(name, location, price);

        const removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.className = 'saved-food-remove';
        removeButton.title = `Remove ${food.name}`;
        removeButton.setAttribute('aria-label', `Remove ${food.name}`);
        removeButton.innerHTML = '<i class="fa-solid fa-xmark"></i>';
        removeButton.addEventListener('click', () => toggleFood(id));
        item.append(details, removeButton);
        savedListElement.appendChild(item);
    });

    savedCountElement.textContent = savedFoodIds.length;
    savedEmptyElement.hidden = savedFoodIds.length > 0;
    document.getElementById('clearFoodList').disabled = savedFoodIds.length === 0;
}

function updateAddButtons() {
    document.querySelectorAll('.food-add-button').forEach(button => {
        const isSaved = savedFoodIds.includes(Number(button.dataset.foodId));
        button.classList.toggle('saved', isSaved);
        button.querySelector('i').className = isSaved ? 'fa-solid fa-heart' : 'fa-regular fa-heart';
        button.querySelector('span').textContent = isSaved ? 'Saved to Favorites' : 'Add to Favorites';
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
document.querySelectorAll('.food-add-button').forEach(button => {
    button.addEventListener('click', () => toggleFood(Number(button.dataset.foodId)));
});
document.getElementById('resetFoodFilters').addEventListener('click', resetFilters);
document.getElementById('clearFoodList').addEventListener('click', () => {
    if (savedFoodIds.length === 0) return;
    savedFoodIds = [];
    saveFoodIds();
    renderSavedFoodList();
    updateAddButtons();
    showToast('Your Favorites were cleared');
});

updateCityFilter();
applyFilters();
renderSavedFoodList();
updateAddButtons();
</script>

<?php include __DIR__ . '/../footer.php'; ?>
