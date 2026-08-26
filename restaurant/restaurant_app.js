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

function toggleRestaurantFavorite(item) {
    if (!window.TravelPalLoginPopup || !window.TravelPalLoginPopup.isLoggedIn) {
        window.TravelPalLoginPopup?.open();
        return false;
    }
    const items = readRestaurantFavorites();
    const index = items.findIndex(saved => String(saved.id) === String(item.id));
    if (index >= 0) {
        items.splice(index, 1);
    } else {
        items.unshift(item);
    }
    writeRestaurantFavorites(items);
    const saved = index < 0;
    fetch('/TravelPal/trips/favorites_action.php', {
        method: 'POST', headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({
            action: saved ? 'save' : 'remove', item_type: 'restaurant', item_key: 'restaurant-' + item.id,
            title: item.name || 'Restaurant', subtitle: [item.city, item.state].filter(Boolean).join(', '),
            image_url: item.image || '', unit_price: Number(item.estimatedPrice || item.price || 45) * Math.max(1, Number(item.party || 2)),
            metadata: {guests: Math.max(1, Number(item.party || 2))}
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
    const detailUrl = `detail.php?id=${encodeURIComponent(item.id)}&city=${encodeURIComponent(citySlug || item.citySlug || '')}&party=${party}`;
    return `<article class="rp-card" data-name="${escapeRestaurantHtml(item.name.toLowerCase())}" data-summary="${escapeRestaurantHtml((item.summary || '').toLowerCase())}" data-rating="${Number(item.rating || 0)}">
        <a class="rp-card__photo" href="${detailUrl}">${image}${item.badge ? `<span class="rp-card__badge">${escapeRestaurantHtml(item.badge)}</span>` : ''}</a>
        <button class="rp-favorite ${saved ? 'is-saved' : ''}" type="button" data-favorite-id="${escapeRestaurantHtml(item.id)}" aria-label="${saved ? 'Remove from' : 'Add to'} favorites" aria-pressed="${saved ? 'true' : 'false'}"><i class="${saved ? 'fa-solid' : 'fa-regular'} fa-heart"></i></button>
        <div class="rp-card__body">
            <div class="rp-card__place"><i class="fa-solid fa-location-dot"></i> ${escapeRestaurantHtml(item.city)}${item.state ? `, ${escapeRestaurantHtml(item.state)}` : ''}</div>
            <h2><a href="${detailUrl}">${escapeRestaurantHtml(item.name)}</a></h2>
            <p class="rp-card__summary">${escapeRestaurantHtml(item.summary || 'Restaurant')}</p>
            <div class="rp-card__meta">
                ${item.rating ? `<span class="rp-rating">★ ${escapeRestaurantHtml(item.rating)}</span>` : '<span>Not rated</span>'}
                ${item.reviewCount ? `<span>${escapeRestaurantHtml(item.reviewCount)} reviews</span>` : ''}
                ${item.status ? `<span>${escapeRestaurantHtml(item.status)}</span>` : ''}
            </div>
        </div>
    </article>`;
}
