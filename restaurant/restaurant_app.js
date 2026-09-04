const RESTAURANT_FAVORITES_KEY = 'travelpal_restaurant_favorites_v1';

function prepareRestaurantNavigation() {
    const restaurantLink = Array.from(document.querySelectorAll('.nav-links a')).find(link => {
        try {
            return new URL(link.href, window.location.href).pathname.toLowerCase() === '/travelpal/restaurant/index.php';
        } catch (error) {
            return false;
        }
    });
    if (restaurantLink && window.location.pathname.toLowerCase().includes('/restaurant/')) {
        restaurantLink.classList.add('tp-nav-current');
        restaurantLink.setAttribute('aria-current', 'page');
    }

    const popupText = document.querySelector('#travelpalLoginReminder .travelpal-login-content p');
    if (popupText) {
        popupText.textContent = 'Sign in or create a TravelPal account to save restaurants and continue with your travel plans.';
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', prepareRestaurantNavigation, {once: true});
} else {
    prepareRestaurantNavigation();
}

function readRestaurantFavorites() {
    try {
        const value = JSON.parse(localStorage.getItem(RESTAURANT_FAVORITES_KEY) || '[]');
        return Array.isArray(value) ? value : [];
    } catch (error) {
        return [];
    }
}

function writeRestaurantFavorites(items) {
    localStorage.setItem(RESTAURANT_FAVORITES_KEY, JSON.stringify(items));
    window.dispatchEvent(new CustomEvent('restaurant-favorites-changed'));
}

function isRestaurantSaved(id) {
    return readRestaurantFavorites().some(item => String(item.id) === String(id));
}

function restaurantSpendEstimate(item = {}) {
    const suppliedAverage = Number(item.estimatedPrice);
    const suppliedRange = String(item.priceRange || item.price || '').trim();
    if (Number.isFinite(suppliedAverage) && suppliedAverage > 0) {
        return {average: Math.round(suppliedAverage), range: suppliedRange || `RM ${Math.round(suppliedAverage)}`};
    }

    const rangeValues = (suppliedRange.match(/\d+(?:\.\d+)?/g) || []).map(Number);
    if (rangeValues.length) {
        const lastValue = rangeValues[rangeValues.length - 1];
        return {average: Math.round((rangeValues[0] + lastValue) / 2), range: suppliedRange};
    }

    const levels = String(item.summary || item.description || '').match(/\${1,4}/g) || [];
    const priceLevels = {1: [15, 30], 2: [30, 65], 3: [65, 130], 4: [130, 220]};
    const first = priceLevels[Math.min(4, levels[0]?.length || 2)];
    const last = priceLevels[Math.min(4, levels.at(-1)?.length || levels[0]?.length || 2)];
    return {average: Math.round((first[0] + last[1]) / 2), range: `RM ${first[0]}–${last[1]}`};
}

function toggleRestaurantFavorite(item) {
    if (!window.TravelPalLoginPopup || !window.TravelPalLoginPopup.isLoggedIn) {
        window.TravelPalLoginPopup?.open();
        return false;
    }
    const spend = restaurantSpendEstimate(item);
    const pricedItem = {...item, estimatedPrice: spend.average, priceRange: spend.range};
    const items = readRestaurantFavorites();
    const index = items.findIndex(saved => String(saved.id) === String(item.id));
    if (index >= 0) {
        items.splice(index, 1);
    } else {
        items.unshift(pricedItem);
    }
    writeRestaurantFavorites(items);
    const saved = index < 0;
    fetch('/TravelPal/trips/favorites_action.php', {
        method: 'POST', headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({
            action: saved ? 'save' : 'remove', item_type: 'restaurant', item_key: 'restaurant-' + item.id,
            title: item.name || 'Restaurant', subtitle: [item.city, item.state].filter(Boolean).join(', '),
            image_url: item.image || '', unit_price: spend.average,
            metadata: {
                guests: Math.max(1, Number(item.party || 2)),
                average_spend: spend.average,
                price_range: spend.range
            }
        })
    }).catch(() => {});
    return index < 0;
}

function escapeRestaurantHtml(value) {
    return String(value ?? '')
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');
}

function restaurantCardMarkup(item, citySlug = '') {
    const saved = isRestaurantSaved(item.id);
    const image = item.image
        ? `<img src="${escapeRestaurantHtml(item.image)}" alt="${escapeRestaurantHtml(item.name)}" loading="lazy">`
        : '<span class="rp-gallery__empty"><i class="fa-solid fa-utensils"></i></span>';
    const party = Math.max(1, Math.min(8, Number(item.party || 2)));
    const spend = restaurantSpendEstimate(item);
    const detailUrl = `detail.php?id=${encodeURIComponent(item.id)}&city=${encodeURIComponent(citySlug || item.citySlug || '')}&party=${party}`;
    return `<article class="rp-card" data-name="${escapeRestaurantHtml(item.name.toLowerCase())}" data-summary="${escapeRestaurantHtml((item.summary || '').toLowerCase())}" data-rating="${Number(item.rating || 0)}">
        <a class="rp-card__photo" href="${detailUrl}">${image}${item.badge ? `<span class="rp-card__badge">${escapeRestaurantHtml(item.badge)}</span>` : ''}</a>
        <button class="rp-favorite ${saved ? 'is-saved' : ''}" type="button" data-favorite-id="${escapeRestaurantHtml(item.id)}" aria-label="${saved ? 'Remove from' : 'Add to'} favorites" aria-pressed="${saved ? 'true' : 'false'}"><i class="${saved ? 'fa-solid' : 'fa-regular'} fa-heart"></i></button>
        <div class="rp-card__body">
            <div class="rp-card__place"><i class="fa-solid fa-location-dot"></i> ${escapeRestaurantHtml(item.city)}${item.state ? `, ${escapeRestaurantHtml(item.state)}` : ''}</div>
            <h2><a href="${detailUrl}">${escapeRestaurantHtml(item.name)}</a></h2>
            <p class="rp-card__summary">${escapeRestaurantHtml(item.summary || 'Restaurant')}</p>
            <div class="rp-card__spend">
                <span><i class="fa-solid fa-wallet"></i> Average spend</span>
                <strong>RM ${spend.average} per person</strong>
                <small>${escapeRestaurantHtml(spend.range)} typical range</small>
            </div>
            <div class="rp-card__meta">
                ${item.rating ? `<span class="rp-rating">★ ${escapeRestaurantHtml(item.rating)}</span>` : '<span>Not rated</span>'}
                ${item.reviewCount ? `<span>${escapeRestaurantHtml(item.reviewCount)} reviews</span>` : ''}
                ${item.status ? `<span>${escapeRestaurantHtml(item.status)}</span>` : ''}
            </div>
        </div>
    </article>`;
}
