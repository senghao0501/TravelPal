(function () {
    'use strict';

    function readFavorite(button) {
        try {
            return JSON.parse(button.dataset.favorite || '{}');
        } catch (error) {
            return {};
        }
    }

    function updateButton(button, isSaved) {
        const icon = button.querySelector('i');
        const label = button.querySelector('span');

        if (icon) {
            icon.className = isSaved ? 'fa-solid fa-heart' : 'fa-regular fa-heart';
            icon.style.color = isSaved ? '#7c3aed' : '#68788c';
        }

        if (label) {
            label.textContent = isSaved
                ? (button.dataset.savedLabel || 'Saved to Favorites')
                : (button.dataset.saveLabel || 'Save to Favorites');
        }

        button.classList.toggle('saved', isSaved);
        button.setAttribute('aria-pressed', isSaved ? 'true' : 'false');
    }

    function requestSignIn() {
        const popupCopy = document.querySelector('.travelpal-login-content p');

        if (popupCopy) {
            popupCopy.textContent = 'Sign in or create a TravelPal account to save attractions to Favorites.';
        }

        window.TravelPalLoginPopup?.open();
    }

    async function toggle(button, metadataProvider) {
        if (!window.TravelPalLoginPopup?.isLoggedIn) {
            requestSignIn();
            return;
        }

        const favorite = readFavorite(button);

        if (!favorite.item_key) {
            return;
        }

        const extraMetadata = typeof metadataProvider === 'function'
            ? metadataProvider(button)
            : {};

        favorite.item_type = 'attraction';
        favorite.action = 'toggle';
        favorite.metadata = Object.assign(
            {},
            favorite.metadata || {},
            extraMetadata || {}
        );

        button.disabled = true;

        try {
            const response = await fetch('/TravelPal/trips/favorites_action.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(favorite)
            });
            const result = await response.json();

            if (response.status === 401) {
                requestSignIn();
                return;
            }

            if (!response.ok || !result.ok) {
                throw new Error(result.message || 'Unable to update Favorites.');
            }

            updateButton(button, Boolean(result.saved));
        } catch (error) {
            window.alert(error.message || 'Unable to update Favorites right now.');
        } finally {
            button.disabled = false;
        }
    }

    function bind(selector, metadataProvider) {
        document.querySelectorAll(selector).forEach(function (button) {
            if (button.dataset.favoriteBound === 'true') {
                return;
            }

            button.dataset.favoriteBound = 'true';
            updateButton(button, button.getAttribute('aria-pressed') === 'true');
            button.addEventListener('click', function (event) {
                event.preventDefault();
                event.stopPropagation();
                toggle(button, metadataProvider);
            });
        });
    }

    window.TravelPalAttractionFavorites = {bind: bind};
}());
