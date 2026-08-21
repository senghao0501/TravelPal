<?php
$cities = require __DIR__ . '/api/city_data.php';
include '../header.php';
?>
<link rel="stylesheet" href="restaurants.css?v=1">
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
                <button class="rp-btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i> Search restaurants</button>
            </form>
        </div>
    </section>

    <section class="rp-section rp-section--white">
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

    <section class="rp-section">
        <div class="rp-shell">
            <div class="rp-heading">
                <div><span class="rp-kicker">Plan with confidence</span><h2>Everything you need before you go</h2></div>
            </div>
            <div class="rp-feature-grid">
                <article class="rp-feature"><span class="rp-feature__icon"><i class="fa-solid fa-star"></i></span><h3>Real traveler ratings</h3><p>Compare live ratings, review totals and recent comments from the restaurant provider.</p></article>
                <article class="rp-feature"><span class="rp-feature__icon"><i class="fa-solid fa-circle-info"></i></span><h3>Useful restaurant details</h3><p>Check addresses, opening information, contact links, photos and available menu items.</p></article>
                <article class="rp-feature"><span class="rp-feature__icon"><i class="fa-solid fa-heart"></i></span><h3>A separate favorites list</h3><p>Save restaurants in one clean list. It is ready to connect to My Trips when the user database is available.</p></article>
            </div>
        </div>
    </section>

    <section class="rp-section rp-section--white">
        <div class="rp-shell">
            <div class="rp-guide-banner">
                <div><span class="rp-kicker">Prefer local dishes?</span><h2>Open the Malaysia Food Guide</h2><p>Your original guide remains available for browsing signature foods by state and city.</p></div>
                <div><a class="rp-btn" href="food-guide.php"><i class="fa-solid fa-bowl-food"></i> Browse food guide</a> <a class="rp-btn rp-btn--outline" href="favorites.php"><i class="fa-regular fa-heart"></i> My favorites</a></div>
            </div>
        </div>
    </section>
</div>

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
</script>
<?php include '../footer.php'; ?>
