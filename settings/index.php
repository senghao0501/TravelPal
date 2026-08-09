

<!-- 2. 再引入 settings 子文件夹专属的 style.css -->
<link rel="stylesheet" href="/TravelPal/style.css?v=2026">
<?php 
// 1. 开启 Session 并检测登录状态
session_start();

// 这里的 'user' 可以替换为你项目登陆成功后存入 session 的 key（例如 'user_id' 或 'username'）
$isLoggedIn = isset($_SESSION['user']) || isset($_SESSION['user_id']); 
$userEmail = $isLoggedIn ? ($_SESSION['user_email'] ?? 'user@example.com') : '';
$userName  = $isLoggedIn ? ($_SESSION['username'] ?? 'Traveler') : '';

// 2. 引入根目录下的 header.php（使用 ../ 回退上一级）
include '../header.php'; 
?>

<!-- 引入同级目录下的专属 CSS 样式表 -->
<link rel="stylesheet" href="/TravelPal/settings/style.css?v=2026">

<div class="settings-container">
    <div class="settings-header">
        <h1>⚙️ Account Settings</h1>
        <p class="settings-subtitle">Manage your account preferences, region options, and safety settings.</p>
    </div>

    <!-- 未登录 (Guest) 引导提示卡片 -->
    <?php if (!$isLoggedIn): ?>
        <div class="guest-notice-card">
            <div class="guest-info">
                <span class="guest-icon">👋</span>
                <div>
                    <h3>You are currently browsing as a Guest</h3>
                    <p>Log in to sync your saved spots, unlock <strong>My Trip</strong> planner, and manage account security.</p>
                </div>
            </div>
            <a href="../login.php" class="btn-guest-login">Log In / Register</a>
        </div>
    <?php endif; ?>

    <!-- 设置表单提交入口 -->
    <form class="settings-form" method="POST" action="update_settings.php">
        
        <!-- 模块 1: 偏好设置 (未登录 & 已登录 均可调) -->
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

        <!-- 模块 2: 通知设置 (未登录 & 已登录 均可调) -->
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

        <!-- 模块 3: 账号与个人资料 (仅限已登录展示) -->
        <?php if ($isLoggedIn): ?>
            <div class="settings-card">
                <div class="card-title">
                    <h2>👤 Personal Profile</h2>
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
                    <h2>🔒 Security</h2>
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