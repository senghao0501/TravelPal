<?php
$id = preg_replace('/[^0-9]/', '', (string)($_GET['id'] ?? ''));
$citySlug = preg_replace('/[^a-z0-9-]/', '', strtolower((string)($_GET['city'] ?? '')));
$partySize = max(1, min(8, (int)($_GET['party'] ?? 2)));
$cities = require __DIR__ . '/api/city_data.php';
$selectedCity = $cities[$citySlug] ?? ['city' => '', 'state' => ''];
include '../header.php';
?>
<link rel="stylesheet" href="restaurants.css?v=5">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<div class="rp-page">
    <div class="rp-shell rp-detail">
        <a class="rp-back" href="all.php?city=<?php echo urlencode($citySlug ?: 'johor-bahru'); ?>&party=<?php echo $partySize; ?>"><i class="fa-solid fa-arrow-left"></i> Back to restaurants</a>
        <div class="rp-state" id="detailState"><div class="rp-spinner"></div><h2>Loading restaurant details</h2><p>Getting live photos, information and traveler reviews.</p></div>
        <div id="restaurantDetail" hidden></div>
    </div>
</div>

<script src="restaurant_app.js?v=3"></script>
<script>
const restaurantId = <?php echo json_encode($id); ?>;
const restaurantCitySlug = <?php echo json_encode($citySlug); ?>;
const restaurantParty = <?php echo $partySize; ?>;
const restaurantCity = <?php echo json_encode($selectedCity['city']); ?>;
const restaurantState = <?php echo json_encode($selectedCity['state']); ?>;
const detailState = document.getElementById('detailState');
const detailRoot = document.getElementById('restaurantDetail');
let currentRestaurant = null;

function stars(value) {
    const rating = Math.max(0, Math.min(5, Math.round(Number(value || 0))));
    return '★'.repeat(rating) + '☆'.repeat(5 - rating);
}

function externalLink(url, text) {
    return url ? `<a href="${escapeRestaurantHtml(url)}" target="_blank" rel="noopener noreferrer">${escapeRestaurantHtml(text)}</a>` : '';
}

function renderGallery(photos, name) {
    if (!photos.length) return '<div class="rp-gallery"><div class="rp-gallery__empty"><i class="fa-solid fa-utensils fa-2x"></i></div></div>';
    const side = photos.slice(1, 3);
    return `<div class="rp-gallery"><img class="rp-gallery__main" src="${escapeRestaurantHtml(photos[0])}" alt="${escapeRestaurantHtml(name)}">${side.length ? `<div class="rp-gallery__side">${side.map((url, index) => `<img src="${escapeRestaurantHtml(url)}" alt="${escapeRestaurantHtml(name)} photo ${index + 2}">`).join('')}${side.length === 1 ? `<img src="${escapeRestaurantHtml(photos[0])}" alt="${escapeRestaurantHtml(name)}">` : ''}</div>` : ''}</div>`;
}

function renderReviews(reviews) {
    if (!reviews.length) return '<p>No recent traveler comments were included in this API response.</p>';
    return reviews.map(review => `<article class="rp-review">
        <div class="rp-review__head"><div class="rp-review__user"><span class="rp-review__avatar">${review.avatar ? `<img src="${escapeRestaurantHtml(review.avatar)}" alt="">` : escapeRestaurantHtml((review.author || 'T')[0])}</span><span><h3>${escapeRestaurantHtml(review.author || 'Traveler')}</h3><small>${escapeRestaurantHtml([review.hometown, review.date].filter(Boolean).join(' · '))}</small></span></div><span class="rp-rating" aria-label="${escapeRestaurantHtml(review.rating || 0)} out of 5">${stars(review.rating)}</span></div>
        ${review.title ? `<h4>${escapeRestaurantHtml(review.title)}</h4>` : ''}<p>${escapeRestaurantHtml(review.text)}</p>${review.visitDate ? `<small>Visited ${escapeRestaurantHtml(review.visitDate)}</small>` : ''}
    </article>`).join('');
}

function renderDetail(item) {
    const spend = restaurantSpendEstimate(item);
    currentRestaurant = {
        id: item.id || restaurantId,
        name: item.name,
        image: item.photos?.[0] || '',
        rating: item.rating,
        reviewCount: item.reviewCount,
        summary: item.summary || item.description,
        city: restaurantCity,
        state: restaurantState,
        citySlug: restaurantCitySlug,
        party: restaurantParty,
        estimatedPrice: spend.average,
        priceRange: spend.range
    };
    const saved = isRestaurantSaved(currentRestaurant.id);
    const addressMap = item.latitude && item.longitude
        ? `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(`${item.latitude},${item.longitude}`)}`
        : item.address ? `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(item.address)}` : '';
    const infoItems = [
        item.address ? `<li><i class="fa-solid fa-location-dot"></i><span>${externalLink(addressMap, item.address)}</span></li>` : '',
        item.phone ? `<li><i class="fa-solid fa-phone"></i><span><a href="tel:${escapeRestaurantHtml(item.phone)}">${escapeRestaurantHtml(item.phone)}</a></span></li>` : '',
        item.website ? `<li><i class="fa-solid fa-globe"></i><span>${externalLink(item.website, 'Visit restaurant website')}</span></li>` : '',
        item.menuUrl ? `<li><i class="fa-solid fa-book-open"></i><span>${externalLink(item.menuUrl, 'Open menu')}</span></li>` : '',
        item.hours?.length ? `<li><i class="fa-regular fa-clock"></i><span>${item.hours.map(escapeRestaurantHtml).join('<br>')}</span></li>` : ''
    ].filter(Boolean).join('');
    const menu = (item.menu || []).filter(entry => entry.name).slice(0, 8);

    detailRoot.innerHTML = `<header class="rp-detail-head"><div><span class="rp-kicker">Live restaurant details</span><h1>${escapeRestaurantHtml(item.name)}</h1><p>${item.rating ? `<span class="rp-rating">★ ${escapeRestaurantHtml(item.rating)}</span> ${escapeRestaurantHtml(item.reviewCount || '')} reviews` : 'Traveler information'}${item.status ? ` · ${escapeRestaurantHtml(item.status)}` : ''}</p></div><button class="rp-btn rp-btn--outline rp-detail-fav ${saved ? 'is-saved' : ''}" id="detailFavorite"><i class="${saved ? 'fa-solid' : 'fa-regular'} fa-heart"></i> ${saved ? 'Saved to Favorites' : 'Add to Favorites'}</button></header>
        ${renderGallery(item.photos || [], item.name)}
        <div class="rp-detail-grid"><main>
            <section class="rp-panel"><span class="rp-kicker">About this restaurant</span><h2>What travelers can expect</h2><p>${escapeRestaurantHtml(item.description || item.summary || 'More information is available from the restaurant provider.')}</p>${item.cuisines?.length ? `<h3>Cuisines</h3><div class="rp-chip-list">${item.cuisines.map(value => `<span class="rp-chip">${escapeRestaurantHtml(value)}</span>`).join('')}</div>` : ''}${item.serves?.length ? `<h3>Meals</h3><div class="rp-chip-list">${item.serves.map(value => `<span class="rp-chip">${escapeRestaurantHtml(value)}</span>`).join('')}</div>` : ''}</section>
            ${menu.length ? `<section class="rp-panel"><span class="rp-kicker">Menu preview</span><h2>Popular menu items</h2>${menu.map(entry => `<article class="rp-menu-item"><h3>${escapeRestaurantHtml(entry.name)} ${entry.price ? `<span class="rp-rating">${escapeRestaurantHtml(entry.price)}</span>` : ''}</h3>${entry.description ? `<p>${escapeRestaurantHtml(entry.description)}</p>` : ''}</article>`).join('')}</section>` : ''}
            <section class="rp-panel"><span class="rp-kicker">Community notes</span><h2>Traveler comments</h2>${renderReviews(item.reviews || [])}</section>
        </main><aside><section class="rp-panel"><span class="rp-kicker">Plan your visit</span><h2>Restaurant information</h2><div class="rp-detail-spend"><small>Average spend per person</small><strong>RM ${spend.average}</strong><span>${escapeRestaurantHtml(spend.range)} typical range</span></div>${infoItems ? `<ul class="rp-info-list">${infoItems}</ul>` : '<p>Contact and location information was not returned.</p>'}${item.tripadvisorUrl ? `<p style="margin-top:20px">${externalLink(item.tripadvisorUrl, 'View source listing')}</p>` : ''}</section></aside></div>`;
    detailRoot.hidden = false;
    detailState.hidden = true;
    document.title = `${item.name} | TravelPal`;
    document.getElementById('detailFavorite').addEventListener('click', () => {
        toggleRestaurantFavorite(currentRestaurant);
        renderDetail(item);
    });
}

async function loadRestaurantDetail() {
    if (!restaurantId) {
        detailState.innerHTML = '<h2>Restaurant not found</h2><p>No valid restaurant was selected.</p>';
        return;
    }
    try {
        const response = await fetch(`api/restaurant_details.php?id=${encodeURIComponent(restaurantId)}&party=${restaurantParty}`);
        const payload = await response.json();
        if (!response.ok || !payload.ok) throw new Error(payload.message || 'The restaurant details could not be loaded.');
        renderDetail(payload.data);
    } catch (error) {
        detailState.innerHTML = `<div class="rp-feature__icon" style="margin-inline:auto"><i class="fa-solid fa-triangle-exclamation"></i></div><h2>Details unavailable</h2><p>${escapeRestaurantHtml(error.message || 'Please try again shortly.')}</p>`;
    }
}
loadRestaurantDetail();
</script>
<?php include '../footer.php'; ?>
