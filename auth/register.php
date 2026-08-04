<?php 
// 引入 header
include '../header.php'; 
?>
<!-- 引入 auth 专用的 css 模块 -->
<link rel="stylesheet" href="../css/modules/auth.css">

<main class="auth-wrapper">
    <div class="auth-container">
        <!-- 左侧 Logo 区域 -->
        <div class="auth-left">
            <img src="../logo.png" alt="TravelPal Logo">
            <h2>Join TravelPal</h2>
            <p>Explore more, journey better.</p>
        </div>

        <!-- 右侧 注册表单区域 -->
        <div class="auth-right">
            <h2>Create Account</h2>

            <!-- 错误提示 -->
            <?php if (isset($_GET['error'])): ?>
                <div class="auth-alert error"><?php echo htmlspecialchars($_GET['error']); ?></div>
            <?php endif; ?>

            <form action="register.php" method="POST">
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Create a password" required>
                </div>
                <div class="input-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
                </div>
                <button type="submit" name="submit_register" class="btn-primary">Register</button>
            </form>

            <div class="divider">
                <span>OR</span>
            </div>

            <button class="btn-google">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google Icon">
                Continue with Google
            </button>

            <p class="auth-switch">Already have an account? <a href="login.php">Sign In</a></p>
        </div>
    </div>
</main>

</body>
</html>