<?php
// login_popup.php - Shared TravelPal login reminder popup.
// Include this file from any module that needs the login reminder.
// Set $loginPopupAutoShow = true before including it when the popup should
// open automatically on page load. Otherwise it opens only when requested.

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// The header now loads this shared popup for every page.  Detail pages that
// include it again should not emit duplicate IDs or duplicate event handlers.
if (!empty($GLOBALS['travelpal_login_popup_rendered'])) {
    return;
}
$GLOBALS['travelpal_login_popup_rendered'] = true;

$loginPopupAutoShow = $loginPopupAutoShow ?? false;
$loginPopupLoggedIn = !empty($_SESSION['user_id']);
?>

<?php if (!$loginPopupLoggedIn): ?>
<div id="travelpalLoginReminder" class="travelpal-login-overlay" aria-hidden="true">
    <div class="travelpal-login-modal" role="dialog" aria-modal="true" aria-labelledby="travelpalLoginTitle">
        <button type="button"
                class="travelpal-login-close"
                id="travelpalLoginClose"
                aria-label="Close login reminder">
            &times;
        </button>

        <div class="travelpal-login-content">
            <img src="/TravelPal/logo.png"
                 alt="TravelPal"
                 class="travelpal-login-logo">

            <h2 id="travelpalLoginTitle">Sign in to continue</h2>

            <p>
                Sign in or create a TravelPal account to save your flights and continue with your travel plans.
            </p>

            <a href="/TravelPal/auth/login.php" class="travelpal-login-button">
                Sign in or create an account
            </a>
        </div>
    </div>
</div>
<?php endif; ?>

<script>
window.TravelPalLoginPopup = window.TravelPalLoginPopup || {};
window.TravelPalLoginPopup.isLoggedIn = <?php echo $loginPopupLoggedIn ? 'true' : 'false'; ?>;

(function () {
    const overlay = document.getElementById('travelpalLoginReminder');
    const closeButton = document.getElementById('travelpalLoginClose');

    function closePopup() {
        if (!overlay) return;
        overlay.classList.remove('is-visible');
        overlay.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('travelpal-login-modal-open');
    }

    function openPopup() {
        if (!overlay || window.TravelPalLoginPopup.isLoggedIn) return;
        overlay.classList.add('is-visible');
        overlay.setAttribute('aria-hidden', 'false');
        document.body.classList.add('travelpal-login-modal-open');
    }

    window.TravelPalLoginPopup.open = openPopup;
    window.TravelPalLoginPopup.close = closePopup;

    if (closeButton) {
        closeButton.addEventListener('click', closePopup);
    }

    if (overlay) {
        overlay.addEventListener('click', function (event) {
            if (event.target === overlay) {
                closePopup();
            }
        });
    }

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closePopup();
        }
    });

    <?php if ($loginPopupAutoShow && !$loginPopupLoggedIn): ?>
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', openPopup, { once: true });
    } else {
        openPopup();
    }
    <?php endif; ?>
})();
</script>
