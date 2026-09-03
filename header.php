<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$travelPalLoggedIn = !empty($_SESSION['user_id']);

$travelPalUserName = $_SESSION['user_name'] ?? 'My Account';
$travelPalEmail = $_SESSION['user_email'] ?? 'Not Provided';

$travelPalScript = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
$travelPalNavPath = strtolower($travelPalScript);
$travelPalNavSection = '';

if (in_array($travelPalNavPath, ['/travelpal/index.php', '/travelpal/home/index.php'], true)) {
    $travelPalNavSection = 'home';
} elseif (strpos($travelPalNavPath, '/travelpal/flights/') === 0) {
    $travelPalNavSection = 'flights';
} elseif (strpos($travelPalNavPath, '/travelpal/hotels/') === 0) {
    $travelPalNavSection = 'hotels';
} elseif (strpos($travelPalNavPath, '/travelpal/restaurant/') === 0) {
    $travelPalNavSection = 'restaurants';
} elseif (strpos($travelPalNavPath, '/travelpal/attractions/') === 0) {
    $travelPalNavSection = 'attractions';
} elseif (strpos($travelPalNavPath, '/travelpal/trips/') === 0) {
    $travelPalNavSection = 'trips';
}

$showFavoriteFab = in_array($travelPalScript, [
    '/TravelPal/index.php', '/TravelPal/flights/index.php', '/TravelPal/hotels/index.php',
    '/TravelPal/restaurant/index.php', '/TravelPal/attractions/index.php'
], true);

// 🌟 全站自动货币转换引擎
function displayPrice($myrPrice) {
    $currency = $_SESSION['currency'] ?? 'MYR';
    $price = (float)$myrPrice;

    if ($currency == 'USD') {
        $converted = $price / 4.70; 
        return 'USD ' . number_format($converted, 0); 
    } elseif ($currency == 'SGD') {
        $converted = $price / 3.48; 
        return 'SGD ' . number_format($converted, 0);
    }
    
    return 'RM ' . number_format($price, 0);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelPal</title>
    <link rel="stylesheet" href="/TravelPal/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<nav class="navbar">
    <div class="navbar-container">
        <a href="/TravelPal/index.php" class="logo">
            <img src="/TravelPal/logo.png" alt="TravelPal Logo">
        </a>

        <button id="tp-mobile-btn" class="mobile-menu-btn" aria-label="Menu">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="nav-links">
            <a href="/TravelPal/index.php"<?php echo $travelPalNavSection === 'home' ? ' class="tp-nav-current" aria-current="page"' : ''; ?>>Home</a>
            <a href="/TravelPal/flights/index.php"<?php echo $travelPalNavSection === 'flights' ? ' class="tp-nav-current" aria-current="page"' : ''; ?>>Flights</a>
            <a href="/TravelPal/hotels/index.php"<?php echo $travelPalNavSection === 'hotels' ? ' class="tp-nav-current" aria-current="page"' : ''; ?>>Hotels</a>
            <a href="/TravelPal/restaurant/index.php"<?php echo $travelPalNavSection === 'restaurants' ? ' class="tp-nav-current" aria-current="page"' : ''; ?>>Restaurants</a>
            <a href="/TravelPal/attractions/index.php"<?php echo $travelPalNavSection === 'attractions' ? ' class="tp-nav-current" aria-current="page"' : ''; ?>>Attractions</a>
            
            <?php if ($travelPalLoggedIn): ?>
                <a href="/TravelPal/trips/index.php"<?php echo $travelPalNavSection === 'trips' ? ' class="tp-nav-current" aria-current="page"' : ''; ?>>My Trips</a>
                
                <div class="avatar-dropdown-container">
                    <div class="profile-avatar" aria-label="Open account menu" title="My Account">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <circle cx="12" cy="8" r="4"></circle>
                            <path d="M4.5 21a7.5 7.5 0 0 1 15 0"></path>
                        </svg>
                    </div>
                    
                    <div class="avatar-dropdown-menu">
                        <div class="dropdown-user-info">
                            <span id="nav-dropdown-name"><?php echo htmlspecialchars($travelPalUserName); ?></span>
                            <small>TravelPal Member</small>
                        </div>
                        <a href="#" onclick="event.preventDefault(); openSettingsModal('profile');"><i class="fa-solid fa-user"></i> Profile Settings</a>
                        <a href="#" onclick="event.preventDefault(); openSettingsModal('notifications');"><i class="fa-solid fa-bell"></i> Notifications</a>
                        <hr class="dropdown-divider">
                        <a href="/TravelPal/auth/logout.php" style="color: #e11d48 !important;">
                            <i class="fa-solid fa-arrow-right-from-bracket" style="color: #e11d48;"></i> Log out
                        </a>
                    </div>
                </div>

            <?php else: ?>
                <a href="/TravelPal/auth/login.php" class="btn-login">Sign in</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileBtn = document.getElementById('tp-mobile-btn');
    const navLinks = document.querySelector('.nav-links');
    
    if(mobileBtn && navLinks) {
        mobileBtn.addEventListener('click', function() {
            navLinks.classList.toggle('active');
            const icon = mobileBtn.querySelector('i');
            if(navLinks.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-xmark'); 
                document.body.style.overflow = 'hidden'; 
            } else {
                icon.classList.remove('fa-xmark');
                icon.classList.add('fa-bars');
                document.body.style.overflow = ''; 
            }
        });
    }
});
</script>

<?php include __DIR__ . '/login_popup.php'; ?>

<div id="tpSettingsModal" class="tp-modal-overlay">
    <div class="tp-modal-box">
        <div class="tp-modal-header">
            <h3>Preferences</h3>
            <button class="tp-modal-close" onclick="closeSettingsModal()">&times;</button>
        </div>
        
        <div class="tp-modal-tabs">
            <button class="tp-tab-btn" id="tabBtn-profile" onclick="switchSettingsTab('profile')">Profile</button>
            <button class="tp-tab-btn" id="tabBtn-notifications" onclick="switchSettingsTab('notifications')">Notifications</button>
        </div>
        
        <div class="tp-modal-body">
            <div id="tab-profile" class="tp-tab-content">
                <div class="tp-form-group">
                    <label>Display Name</label>
                    <input type="text" id="input-display-name" class="tp-input" value="<?php echo htmlspecialchars($travelPalUserName); ?>">
                </div>
                <div class="tp-form-group">
                    <label>Email Address</label>
                    <input type="email" class="tp-input" value="<?php echo htmlspecialchars($travelPalEmail); ?>" disabled style="background:#f3f4f6; color:#9ca3af;">
                </div>
            </div>

            <div id="tab-notifications" class="tp-tab-content">
                <div class="tp-toggle-row">
                    <div>
                        <strong>Booking Updates</strong>
                        <small>Get alerts about your flights and hotels</small>
                    </div>
                    <label class="tp-switch"><input type="checkbox" checked><span class="tp-slider"></span></label>
                </div>
                <div class="tp-toggle-row">
                    <div>
                        <strong>Promotions & Deals</strong>
                        <small>Receive exclusive 15% OFF member deals</small>
                    </div>
                    <label class="tp-switch"><input type="checkbox"><span class="tp-slider"></span></label>
                </div>
            </div>
        </div>
        
        <div class="tp-modal-footer">
            <p id="tp-save-status" class="tp-save-status" role="status" aria-live="polite"></p>
            <button class="tp-btn-cancel" onclick="closeSettingsModal()">Cancel</button>
            <button type="button" id="tp-save-button" class="tp-btn-save" onclick="saveSettingsModal()">Save Changes</button>
        </div>
    </div>
</div>

<script>
    function openSettingsModal(tabId) {
        document.getElementById('tpSettingsModal').classList.add('active');
        setSettingsStatus('', '');
        switchSettingsTab(tabId);
    }

    function closeSettingsModal() {
        document.getElementById('tpSettingsModal').classList.remove('active');
    }

    function switchSettingsTab(tabId) {
        document.querySelectorAll('.tp-tab-content').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.tp-tab-btn').forEach(el => el.classList.remove('active'));
        document.getElementById('tab-' + tabId).classList.add('active');
        document.getElementById('tabBtn-' + tabId).classList.add('active');
    }

    function setSettingsStatus(message, type) {
        const statusElement = document.getElementById('tp-save-status');
        statusElement.textContent = message;
        statusElement.className = 'tp-save-status' + (type ? ' ' + type : '');
    }

    async function saveSettingsModal() {
        const nameInput = document.getElementById('input-display-name');
        const saveButton = document.getElementById('tp-save-button');
        const newName = nameInput.value.trim().replace(/\s+/g, ' ');

        if (Array.from(newName).length < 2 || Array.from(newName).length > 100) {
            setSettingsStatus('Display name must contain between 2 and 100 characters.', 'error');
            nameInput.focus();
            return;
        }

        const formData = new FormData();
        formData.append('display_name', newName);

        saveButton.disabled = true;
        saveButton.textContent = 'Saving...';
        setSettingsStatus('', '');

        try {
            const response = await fetch('/TravelPal/settings/update_prefs.php', {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            const responseText = await response.text();
            let data;

            try {
                data = JSON.parse(responseText);
            } catch (error) {
                throw new Error('The server returned an invalid response.');
            }

            if (!response.ok || !data.success) {
                if (data.silent) {
                    console.error('Profile settings could not be saved.');
                    setSettingsStatus('', '');
                    return;
                }
                throw new Error(data.message || 'Your profile could not be saved.');
            }

            nameInput.value = data.profile.display_name;
            const nameElement = document.getElementById('nav-dropdown-name');
            if (nameElement) {
                nameElement.textContent = data.profile.display_name;
            }

            setSettingsStatus(data.message, 'success');
            window.setTimeout(() => window.location.reload(), 650);
        } catch (error) {
            console.error('Error:', error);
            setSettingsStatus(error.message || 'Your profile could not be saved.', 'error');
        } finally {
            saveButton.disabled = false;
            saveButton.textContent = 'Save Changes';
        }
    }
</script>

<?php if ($showFavoriteFab): ?>
    <a class="travelpal-favorite-fab" href="<?php echo $travelPalLoggedIn ? '/TravelPal/trips/favorites.php' : '#'; ?>" <?php echo $travelPalLoggedIn ? '' : 'onclick="event.preventDefault(); window.TravelPalLoginPopup && window.TravelPalLoginPopup.open();"'; ?> aria-label="Open favorites and trip timetable" title="Favorites & timetable">
        <i class="fa-solid fa-heart"></i>
    </a>
<?php endif; ?>

<main>