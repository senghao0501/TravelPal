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


<!-- 引入全局样式与专属 CSS 样式表 -->
<link rel="stylesheet" href="/TravelPal/style.css?v=2026">
<link rel="stylesheet" href="/TravelPal/settings/style.css?v=2026">
<!-- 引入 FontAwesome 图标库支持 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="settings-container">
    <div class="settings-header">
        <h1>Account Settings</h1>
        <p class="settings-subtitle">Manage your account preferences, region options, and safety settings.</p>
    </div>

    <!-- 未登录 (Guest) 专属：Booking.com 风格的 Help Center / 登录引导卡片 -->
    <?php if (!$isLoggedIn): ?>
        <div class="help-center-card">
            <div class="help-header-text">
                <h2>Welcome to the Help Center</h2>
                <p>Sign in to contact Customer Service – we're available 24 hours a day</p>
            </div>

            <!-- 客服选项两列布局 -->
            <div class="help-options-grid">
                <div class="help-option-item">
                    <div class="help-icon"><i class="fa-solid fa-comments"></i></div>
                    <div class="help-text">
                        <h3>Send us a message</h3>
                        <p>Contact our agents about your booking, and we'll reply as soon as possible.</p>
                    </div>
                </div>

                <div class="help-option-item">
                    <div class="help-icon"><i class="fa-solid fa-phone"></i></div>
                    <div class="help-text">
                        <h3>Call us</h3>
                        <p>For anything urgent, you can call us 24/7 at a local or international phone number.</p>
                    </div>
                </div>
            </div>

            <!-- 主按钮：Sign in (正确链接到 auth/login.php) -->
            <a href="../auth/login.php" class="btn-help-signin">Sign In</a>

            <!-- 底部辅助链接：游客继续浏览 -->
            <div class="help-footer-link">
                <a href="../index.php">Continue without an account</a>
            </div>
        </div>
    <?php endif; ?>

    <!-- 设置表单提交入口 -->
    <form class="settings-form" method="POST" action="update_settings.php">
        
        <!-- 模块 1: 偏好设置 (未登录 & 已登录 均可调，已移除多余货币) -->
        <div class="settings-card">
            <div class="card-title">
                <h2>Preferences</h2>
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
        </div>

        <!-- 模块 2: 通知设置 (未登录 & 已登录 均可调) -->
        <div class="settings-card">
            <div class="card-title">
                <h2>Notifications</h2>
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

        <!-- 模块 3: 账号与个人资料 (仅限已登录展示) -->
        <?php if ($isLoggedIn): ?>
            <div class="settings-card">
                <div class="card-title">
                    <h2>Personal Profile</h2>
                    <span class="card-badge user-badge">Account Active</span>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" value="<?php echo htmlspecialchars($userName); ?>" placeholder="Your Name">
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" value="<?php echo htmlspecialchars($userEmail); ?>" disabled class="disabled-input">
                    <small>Email address cannot be changed directly for security reasons.</small>
                </div>
            </div>

            <!-- 模块 4: 安全与密码 (仅限已登录展示) -->
            <div class="settings-card">
                <div class="card-title">
                    <h2>Security</h2>
                </div>
                <div class="form-group">
                    <label for="old_pass">Current Password</label>
                    <input type="password" id="old_pass" name="old_pass" placeholder="Enter current password">
                </div>
                <div class="form-group">
                    <label for="new_pass">New Password</label>
                    <input type="password" id="new_pass" name="new_pass" placeholder="Enter new password (min. 6 characters)">
                </div>
            </div>
        <?php endif; ?>

        <!-- 底部提交操作区 -->
        <div class="form-actions">
            <button type="submit" class="btn-save-settings">Save Changes</button>
            <?php if ($isLoggedIn): ?>
                <a href="../logout.php" class="btn-logout">Log Out</a>
            <?php endif; ?>
        </div>

    </form>
</div>

<!-- 3. 引入根目录下的 footer.php -->
<?php include '../footer.php'; ?>  