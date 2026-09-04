<?php include '../header.php'; ?>
<link rel="stylesheet" href="restaurants.css?v=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<div class="rp-page">
    <section class="rp-results-hero"><div class="rp-shell"><span class="rp-kicker">Before heading out</span><h1>My Restaurant Favorites</h1><p>All your saved restaurant options in one place.</p></div></section>
    <div class="rp-shell">
        <header class="rp-favorites-head"><div><span class="rp-kicker">Saved on this device</span><h1>Your shortlist</h1><p id="favoriteCount">Loading saved restaurants…</p></div><a class="rp-btn rp-btn--outline" href="all.php"><i class="fa-solid fa-magnifying-glass"></i> Find restaurants</a></header>
        <div class="rp-state" id="favoriteEmpty" hidden><div class="rp-feature__icon" style="margin-inline:auto"><i class="fa-regular fa-heart"></i></div><h2>No favorites yet</h2><p>Open the restaurant list and use the heart button to build your shortlist.</p><p style="margin-top:18px"><a class="rp-btn" href="all.php">Browse restaurants</a></p></div>
        <div class="rp-card-grid" id="favoriteGrid"></div>
    </div>
</div>

<script src="restaurant_app.js?v=3"></script>
<script>
const favoriteGrid = document.getElementById('favoriteGrid');
const favoriteEmpty = document.getElementById('favoriteEmpty');
const favoriteCount = document.getElementById('favoriteCount');
function renderFavoritePage() {
    const items = readRestaurantFavorites();
    favoriteCount.textContent = `${items.length} saved restaurant${items.length === 1 ? '' : 's'}`;
    favoriteEmpty.hidden = items.length > 0;
    favoriteGrid.hidden = items.length === 0;
    favoriteGrid.innerHTML = items.map(item => restaurantCardMarkup(item, item.citySlug || '')).join('');
    favoriteGrid.querySelectorAll('[data-favorite-id]').forEach(button => button.addEventListener('click', event => {
        event.preventDefault();
        const item = items.find(entry => String(entry.id) === String(button.dataset.favoriteId));
        if (item) toggleRestaurantFavorite(item);
        renderFavoritePage();
    }));
}
renderFavoritePage();
</script>
<?php include '../footer.php'; ?>
