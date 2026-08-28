<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$travelPalLoggedIn = !empty($_SESSION['user_id']);

// 🌟 精准抓取你在 login.php 里面设置的 session 变量
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
<!-- header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelPal</title>
    <link rel="stylesheet" href="/TravelPal/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* 头像下拉菜单样式 */
        .avatar-dropdown-container { position: relative; display: inline-block; cursor: pointer; padding: 10px 0; }
        .avatar-dropdown-menu {
            position: absolute; top: 100%; right: 0; margin-top: -5px; width: 240px; background: #ffffff;
            border: 1px solid #e5e7eb; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            opacity: 0; visibility: hidden; transform: translateY(-10px); transition: all 0.2s ease;
            display: flex; flex-direction: column; z-index: 1000; padding: 8px 0;
        }
        .avatar-dropdown-container:hover .avatar-dropdown-menu { opacity: 1; visibility: visible; transform: translateY(0); }
        .dropdown-user-info { padding: 12px 20px; border-bottom: 1px solid #e5e7eb; margin-bottom: 8px; text-align: left; }
        .dropdown-user-info span { display: block; color: #111827; font-weight: 800; font-size: 15px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .dropdown-user-info small { color: #6b7280; font-size: 12px; font-weight: 600; }
        .avatar-dropdown-menu a {
            padding: 10px 20px; color: #4b5563 !important; font-size: 14px !important; font-weight: 600 !important;
            display: flex !important; align-items: center !important; gap: 12px !important; text-decoration: none;
            transition: background 0.15s ease, color 0.15s ease;
        }
        .avatar-dropdown-menu a:hover { background: #f8fafc; color: #047857 !important; }
        .avatar-dropdown-menu i { font-size: 16px; width: 20px; text-align: center; color: #9ca3af; transition: color 0.15s ease; }
        .avatar-dropdown-menu a:hover i { color: #047857; }
        .dropdown-divider { height: 1px; background: #e5e7eb; margin: 8px 0; border: none; }

        /* 设置弹窗样式 */
        .tp-modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.5); backdrop-filter: blur(4px);
            z-index: 10000; display: flex; align-items: center; justify-content: center;
            opacity: 0; visibility: hidden; transition: all 0.2s ease;
        }
        .tp-modal-overlay.active { opacity: 1; visibility: visible; }
        .tp-modal-box {
            background: #ffffff; width: 100%; max-width: 480px;
            border-radius: 16px; box-shadow: 0 20px 50px rgba(0,0,0,0.15);
            transform: translateY(20px); transition: transform 0.3s ease; overflow: hidden;
        }
        .tp-modal-overlay.active .tp-modal-box { transform: translateY(0); }
        .tp-modal-header { display: flex; justify-content: space-between; align-items: center; padding: 20px 24px; border-bottom: 1px solid #e5e7eb; }
        .tp-modal-header h3 { margin: 0; font-size: 18px; font-weight: 800; color: #111827; }
        .tp-modal-close { background: none; border: none; font-size: 24px; color: #9ca3af; cursor: pointer; transition: color 0.2s; }
        .tp-modal-close:hover { color: #ef4444; }
        .tp-modal-tabs { display: flex; background: #f8fafc; border-bottom: 1px solid #e5e7eb; }
        .tp-tab-btn {
            flex: 1; padding: 14px 0; background: none; border: none;
            font-size: 14px; font-weight: 700; color: #6b7280; cursor: pointer;
            border-bottom: 2px solid transparent; transition: all 0.2s;
        }
        .tp-tab-btn:hover { color: #111827; }
        .tp-tab-btn.active { color: #047857; border-bottom-color: #047857; }
        .tp-modal-body { padding: 24px; min-height: 180px; }
        .tp-tab-content { display: none; }
        .tp-tab-content.active { display: block; animation: fadeIn 0.3s ease; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        .tp-form-group { margin-bottom: 16px; text-align: left; }
        .tp-form-group label { display: block; font-size: 12px; font-weight: 700; color: #6b7280; margin-bottom: 6px; text-transform: uppercase; }
        .tp-input, .tp-select {
            width: 100%; padding: 12px 14px; border: 1px solid #d1d5db;
            border-radius: 8px; font-size: 14px; font-weight: 600; color: #111827; outline: none; box-sizing: border-box;
        }
        .tp-input:focus, .tp-select:focus { border-color: #047857; box-shadow: 0 0 0 3px rgba(4,120,87,0.1); }
        .tp-toggle-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; text-align: left; }
        .tp-toggle-row strong { display: block; font-size: 15px; color: #111827; }
        .tp-toggle-row small { font-size: 12px; color: #6b7280; }
        .tp-switch { position: relative; display: inline-block; width: 44px; height: 24px; flex-shrink: 0; }
        .tp-switch input { opacity: 0; width: 0; height: 0; }
        .tp-slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #cbd5e1; transition: .3s; border-radius: 24px; }
        .tp-slider:before { position: absolute; content: ""; height: 18px; width: 18px; left: 3px; bottom: 3px; background-color: white; transition: .3s; border-radius: 50%; }
        .tp-switch input:checked + .tp-slider { background-color: #047857; }
        .tp-switch input:checked + .tp-slider:before { transform: translateX(20px); }
        .tp-modal-footer {
            padding: 16px 24px; border-top: 1px solid #e5e7eb;
            display: flex; align-items: center; justify-content: flex-end; gap: 12px; background: #f8fafc;
        }
        .tp-btn-cancel { flex: 0 0 auto; white-space: nowrap; padding: 10px 18px; border: none; background: transparent; font-weight: 700; color: #6b7280; cursor: pointer; border-radius: 6px; }
        .tp-btn-cancel:hover { background: #e5e7eb; color: #111827; }
        .tp-btn-save { flex: 0 0 auto; white-space: nowrap; padding: 10px 24px; border: none; background: #047857; color: #fff; font-weight: 700; cursor: pointer; border-radius: 6px; transition: background 0.2s; }
        .tp-btn-save:hover { background: #065f46; }
        .tp-btn-save:disabled { background: #94a3b8; cursor: wait; }
        .tp-save-status { flex: 1 1 auto; min-width: 0; max-width: 190px; margin: 0 auto 0 0; font-size: 12px; line-height: 1.35; font-weight: 700; overflow-wrap: anywhere; }
        .tp-save-status.success { color: #047857; }
        .tp-save-status.error { color: #b91c1c; font-size: 11px; }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="navbar-container">
        <a href="/TravelPal/index.php" class="logo">
            <img src="/TravelPal/logo.png" alt="TravelPal Logo">
        </a>

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
                            <!-- 🌟 给这里加上了 id="nav-dropdown-name"，并且自动读取 PHP 名字 -->
                            <span id="nav-dropdown-name"><?php echo htmlspecialchars($travelPalUserName); ?></span>
                            <small>TravelPal Member</small>
                        </div>
                        <a href="#" onclick="event.preventDefault(); openSettingsModal('profile');"><i class="fa-solid fa-user"></i> Profile Settings</a>
                        <a href="#" onclick="event.preventDefault(); openSettingsModal('language');"><i class="fa-solid fa-globe"></i> Language & Currency</a>
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

<?php include __DIR__ . '/login_popup.php'; ?>

<!-- 高级设置弹窗 -->
<div id="tpSettingsModal" class="tp-modal-overlay">
    <div class="tp-modal-box">
        <div class="tp-modal-header">
            <h3>Preferences</h3>
            <button class="tp-modal-close" onclick="closeSettingsModal()">&times;</button>
        </div>
        
        <div class="tp-modal-tabs">
            <button class="tp-tab-btn" id="tabBtn-profile" onclick="switchSettingsTab('profile')">Profile</button>
            <button class="tp-tab-btn" id="tabBtn-language" onclick="switchSettingsTab('language')">Language</button>
            <button class="tp-tab-btn" id="tabBtn-notifications" onclick="switchSettingsTab('notifications')">Notifications</button>
        </div>
        
        <div class="tp-modal-body">
            <!-- 1. Profile -->
            <div id="tab-profile" class="tp-tab-content">
                <div class="tp-form-group">
                    <label>Display Name</label>
                    <input type="text" id="input-display-name" class="tp-input" value="<?php echo htmlspecialchars($travelPalUserName); ?>">
                </div>
                <div class="tp-form-group">
                    <label>Email Address</label>
                    <!-- 🌟 自动读取 PHP 真实邮箱 -->
                    <input type="email" class="tp-input" value="<?php echo htmlspecialchars($travelPalEmail); ?>" disabled style="background:#f3f4f6; color:#9ca3af;">
                </div>
            </div>

            <!-- 2. Language -->
            <div id="tab-language" class="tp-tab-content">
                <div class="tp-form-group">
                    <label>Language</label>
                    <?php $currentLang = $_SESSION['language'] ?? 'EN'; ?>
                    <select id="select-language" class="tp-select">
                        <option value="EN" <?php echo $currentLang == 'EN' ? 'selected' : ''; ?>>English (UK)</option>
                        <option value="MS" <?php echo $currentLang == 'MS' ? 'selected' : ''; ?>>Bahasa Melayu</option>
                        <option value="ZH" <?php echo $currentLang == 'ZH' ? 'selected' : ''; ?>>中文 (简体)</option>
                    </select>
                </div>
                <div class="tp-form-group">
                    <label>Currency</label>
                    <?php $currentCurr = $_SESSION['currency'] ?? 'MYR'; ?>
                    <select id="select-currency" class="tp-select">
                        <option value="MYR" <?php echo $currentCurr == 'MYR' ? 'selected' : ''; ?>>MYR - Malaysian Ringgit</option>
                        <option value="SGD" <?php echo $currentCurr == 'SGD' ? 'selected' : ''; ?>>SGD - Singapore Dollar</option>
                        <option value="USD" <?php echo $currentCurr == 'USD' ? 'selected' : ''; ?>>USD - US Dollar</option>
                    </select>
                </div>
            </div>

            <!-- 3. Notifications -->
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
        const newCurrency = document.getElementById('select-currency').value;
        const newLanguage = document.getElementById('select-language').value;

        if (Array.from(newName).length < 2 || Array.from(newName).length > 100) {
            setSettingsStatus('Display name must contain between 2 and 100 characters.', 'error');
            nameInput.focus();
            return;
        }

        const formData = new FormData();
        formData.append('display_name', newName);
        formData.append('currency', newCurrency);
        formData.append('language', newLanguage);

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
