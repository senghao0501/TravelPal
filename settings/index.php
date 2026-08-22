<?php
// settings/index.php
// Existing Settings design is preserved. This file only adds database-backed
// account loading and keeps the existing preference/security UI.

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../auth/auth_db.php';

// Settings is available to guests for the existing public preference UI.
// Account/profile/security sections require a valid logged-in user.
$isLoggedIn = !empty($_SESSION['user_id']);

$userEmail = '';
$userName = '';

if ($isLoggedIn) {
    $settingsDb = $auth_db;
    $userId = (int) $_SESSION['user_id'];

    $stmt = $settingsDb->prepare(
        'SELECT id, full_name, email FROM accounts WHERE id = ? LIMIT 1'
    );

    if (!$stmt) {
        die('Unable to load account information.');
    }

    $stmt->bind_param('i', $userId);
    $stmt->execute();

    $result = $stmt->get_result();
    $account = $result->fetch_assoc();

    $stmt->close();

    if (!$account) {
        unset(
            $_SESSION['user_id'],
            $_SESSION['user_name'],
            $_SESSION['user_email']
        );

        header('Location: /TravelPal/auth/login.php?error=login_required');
        exit;
    }

    $userName = $account['full_name'];
    $userEmail = $account['email'];

    // Keep the session values consistent with the database.
    $_SESSION['user_name'] = $userName;
    $_SESSION['user_email'] = $userEmail;
}

// Show a success/error message after update_settings.php.
$settingsMessage = $_GET['message'] ?? '';
$settingsError = $_GET['error'] ?? '';

// 1. Include the existing root header.
include '../header.php';
?>

<!-- Existing Settings CSS: design is unchanged -->
<link rel="stylesheet" href="/TravelPal/settings/style.css?v=2026">

<div class="settings-container">
    <div class="settings-header">
        <h1>⚙️ Account Settings</h1>
        <p class="settings-subtitle">Manage your account preferences, region options, and safety settings.</p>
    </div>

    <!-- Existing guest notice/design -->
    <?php if (!$isLoggedIn): ?>
        <div class="guest-notice-card">
            <div class="guest-info">
                <span class="guest-icon">👋</span>
                <div>
                    <h3>You are currently browsing as a Guest</h3>
                    <p>Log in to sync your saved spots, unlock <strong>My Trip</strong> planner, and manage account security.</p>
                </div>
            </div>
            <a href="../auth/login.php" class="btn-guest-login">Log In / Register</a>
        </div>
    <?php endif; ?>

    <!-- Existing form and design preserved -->
    <form class="settings-form" method="POST" action="update_settings.php">

        <!-- Module 1: Preferences -->
        <div class="settings-card">
            <div class="card-title">
                <h2>🌐 Preferences</h2>
                <span class="card-badge">Public</span>
            </div>

            <div class="form-group">
                <label for="language">Preferred Language</label>
                <select id="language" name="language">
                    <option value="en" selected>English</option>
                    <option value="zh">中文 (Chinese)</option>
                    <option value="ms">Bahasa Melayu</option>
                </select>
                <small>Choose the language you want to see TravelPal in.</small>
            </div>

            <div class="form-group">
                <label for="currency">Display Currency</label>
                <select id="currency" name="currency">
                    <option value="MYR" selected>MYR (RM) - Malaysian Ringgit</option>
                    <option value="USD">USD ($) - US Dollar</option>
                    <option value="THB">THB (฿) - Thai Baht</option>
                    <option value="VND">VND (₫) - Vietnamese Dong</option>
                    <option value="IDR">IDR (Rp) - Indonesian Rupiah</option>
                </select>
                <small>All hotel and spot prices will automatically convert to this currency.</small>
            </div>
        </div>

        <!-- Module 2: Notifications -->
        <div class="settings-card">
            <div class="card-title">
                <h2>🔔 Notifications</h2>
            </div>

            <div class="form-group-checkbox">
                <input type="checkbox" id="email_promo" name="email_promo" checked>
                <label for="email_promo">Receive exclusive travel deals and discount notifications</label>
            </div>

            <div class="form-group-checkbox">
                <input type="checkbox" id="booking_remind" name="booking_remind" checked>
                <label for="booking_remind">Receive booking confirmation and itinerary updates</label>
            </div>
        </div>

        <!-- Module 3: Existing personal profile, now database-backed -->
        <?php if ($isLoggedIn): ?>
            <div class="settings-card">
                <div class="card-title">
                    <h2>👤 Personal Profile</h2>
                    <span class="card-badge user-badge">Account Active</span>
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input
                        type="text"
                        name="username"
                        value="<?= htmlspecialchars($userName) ?>"
                        placeholder="Your Name"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input
                        type="email"
                        value="<?= htmlspecialchars($userEmail) ?>"
                        disabled
                        class="disabled-input"
                    >
                    <small>Email address cannot be changed directly for security reasons.</small>
                </div>
            </div>

            <!-- Module 4: Existing security UI, now database-backed -->
            <div class="settings-card">
                <div class="card-title">
                    <h2>🔒 Security</h2>
                </div>

                <div class="form-group">
                    <label for="old_pass">Current Password</label>
                    <input
                        type="password"
                        id="old_pass"
                        name="old_pass"
                        placeholder="Enter current password"
                    >
                </div>

                <div class="form-group">
                    <label for="new_pass">New Password</label>
                    <input
                        type="password"
                        id="new_pass"
                        name="new_pass"
                        placeholder="Enter new password (min. 8 characters)"
                    >
                </div>
            </div>
        <?php endif; ?>

        <!-- Existing bottom actions -->
        <div class="form-actions">
            <button type="submit" class="btn-save-settings">Save Changes</button>

            <?php if ($isLoggedIn): ?>
                <a href="../auth/logout.php" class="btn-logout">Log Out</a>
            <?php endif; ?>
        </div>

    </form>
</div>

<?php include '../footer.php'; ?>
