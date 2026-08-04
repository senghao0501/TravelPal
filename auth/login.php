<?php include '../header.php'; ?>
<link rel="stylesheet" href="../css/modules/auth.css">

<main class="auth-wrapper">
    <div class="auth-container">
        <!-- 左侧：故事感 44% 宽度轮播图 -->
        <div class="auth-left slideshow-container">
            <!-- Slide 1: Malaysia -->
            <div class="slide fade active">
                <img src="malaysia.jpe" alt="Kuala Lumpur">
                <div class="caption">
                    <span class="badge">Popular Destination</span>
                    <h3>Kuala Lumpur</h3>
                    <p>Malaysia</p>
                    <div class="rating">★ 4.9 <span>(18,500+ Travelers)</span></div>
                </div>
            </div>

            <!-- Slide 2: Indonesia -->
            <div class="slide fade">
                <img src="indonesia.jpe" alt="Bali">
                <div class="caption">
                    <span class="badge">Island Paradise</span>
                    <h3>Bali</h3>
                    <p>Indonesia</p>
                    <div class="rating">★ 4.8 <span>(24,000+ Travelers)</span></div>
                </div>
            </div>

            <!-- Slide 3: Vietnam -->
            <div class="slide fade">
                <img src="vietnam.jpe" alt="Hanoi">
                <div class="caption">
                    <span class="badge">Cultural Experience</span>
                    <h3>Hanoi</h3>
                    <p>Vietnam</p>
                    <div class="rating">★ 4.7 <span>(12,300+ Travelers)</span></div>
                </div>
            </div>

            <!-- Slide 4: Thailand -->
            <div class="slide fade">
                <img src="thailand.jpe" alt="Wat Arun">
                <div class="caption">
                    <span class="badge">Historical Landmark</span>
                    <h3>Wat Arun</h3>
                    <p>Thailand</p>
                    <div class="rating">★ 4.9 <span>(15,100+ Travelers)</span></div>
                </div>
            </div>
        </div>

        <!-- 右侧：精简 56% 表单区 -->
        <div class="auth-right">
            <div class="auth-header">
                <h2>Sign In</h2>
                <p class="sub-title">Continue planning your next adventure.</p>
            </div>

            <?php if (isset($_GET['error'])): ?>
                <div class="auth-alert error">Invalid email or password.</div>
            <?php endif; ?>
            <?php if (isset($_GET['success'])): ?>
                <div class="auth-alert success">✓ Login Successful</div>
            <?php endif; ?>

            <form action="login.php" method="POST" id="loginForm">
                <!-- Email Input with Icon -->
                <div class="input-group">
                    <label for="email">Email</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                </div>

                <!-- Password Input with Icon & Toggle Eye -->
                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                        <button type="button" class="eye-btn" onclick="togglePassword()">
                            <svg id="eyeIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </button>
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span>Remember me</span>
                    </label>
                    <a href="#" class="forgot-link">Forgot password?</a>
                </div>

                <!-- Primary Submit Button -->
                <button type="submit" name="submit_login" class="btn-primary" id="btnSubmit">Sign In</button>
            </form>

            <div class="divider">
                <span>OR</span>
            </div>

            <!-- Google Sign In -->
            <button class="btn-google">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google Icon">
                Continue with Google
            </button>

            <p class="auth-switch">Don't have an account? <a href="register.php">Create account</a></p>
        </div>
    </div>
</main>

<script>
    // 1. 5秒自动轮播
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');
    function showSlides() {
        slides.forEach(slide => slide.classList.remove('active'));
        currentSlide = (currentSlide + 1) % slides.length;
        slides[currentSlide].classList.add('active');
    }
    setInterval(showSlides, 5000);

    // 2. 密码显隐切换
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    }

    // 3. 提交 Loading 状态展示
    document.getElementById('loginForm').addEventListener('submit', function() {
        const btn = document.getElementById('btnSubmit');
        btn.innerText = 'Signing in...';
        btn.style.opacity = '0.8';
    });
</script>

</body>
</html>