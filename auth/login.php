<?php 
include '../header.php'; 
?>
<!-- 引入 auth 专用的 css 模块 -->
<link rel="stylesheet" href="../css/modules/auth.css">

<main class="auth-wrapper">
    <div class="auth-container">
        <!-- 左侧 轮播图区域 -->
        <div class="auth-left slideshow-container">
            <!-- Slide 1: Malaysia -->
            <div class="slide fade active">
                <img src="malaysia.jpe" alt="Kuala Lumpur">
                <div class="caption">
                    <h3>Kuala Lumpur</h3>
                    <p>Malaysia</p>
                </div>
            </div>

            <!-- Slide 2: Indonesia -->
            <div class="slide fade">
                <img src="indonesia.jpe" alt="Bali">
                <div class="caption">
                    <h3>Bali</h3>
                    <p>Indonesia</p>
                </div>
            </div>

            <!-- Slide 3: Vietnam -->
            <div class="slide fade">
                <img src="vietnam.jpe" alt="Hanoi">
                <div class="caption">
                    <h3>Hanoi</h3>
                    <p>Vietnam</p>
                </div>
            </div>

            <!-- Slide 4: Thailand -->
            <div class="slide fade">
                <img src="thailand.jpe" alt="Wat Arun">
                <div class="caption">
                    <h3>Wat Arun (Temple of Dawn)</h3>
                    <p>Thailand</p>
                </div>
            </div>
        </div>

        <!-- 右侧 登录表单区域 -->
        <div class="auth-right">
            <h2>Sign In</h2>

            <?php if (isset($_GET['error'])): ?>
                <div class="auth-alert error"><?php echo htmlspecialchars($_GET['error']); ?></div>
            <?php endif; ?>
            <?php if (isset($_GET['success'])): ?>
                <div class="auth-alert success"><?php echo htmlspecialchars($_GET['success']); ?></div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" name="submit_login" class="btn-primary">Sign In</button>
            </form>

            <div class="divider">
                <span>OR</span>
            </div>

            <button class="btn-google">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google Icon">
                Continue with Google
            </button>

            <p class="auth-switch">Don't have an account? <a href="register.php">Register</a></p>
        </div>
    </div>
</main>

<!-- JS 实现 5 秒定时自动轮播 -->
<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');

    function showSlides() {
        slides.forEach(slide => slide.classList.remove('active'));
        currentSlide = (currentSlide + 1) % slides.length;
        slides[currentSlide].classList.add('active');
    }

    // 每 5000 毫秒 (5秒) 切换一次图片
    setInterval(showSlides, 5000);
</script>

</body>
</html>