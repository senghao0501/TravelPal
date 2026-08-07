<?php include '../header.php'; ?>
<link rel="stylesheet" href="../css/modules/auth.css">

<main class="auth-wrapper">
    <div class="auth-container">
        <!-- 左侧：故事感轮播图 (与 Login 保持一致) -->
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

        <!-- 右侧：精简注册表单区 -->
        <div class="auth-right">
            <div class="auth-header">
                <h2>Create Account</h2>
                <p class="sub-title">Start your journey with TravelPal today.</p>
            </div>

            <?php if (isset($_GET['error'])): ?>
                <div class="auth-alert error"><?php echo htmlspecialchars($_GET['error']); ?></div>
            <?php endif; ?>
            <?php if (isset($_GET['success'])): ?>
                <div class="auth-alert success">✓ Account created successfully! <a href="login.php">Sign in now</a></div>
            <?php endif; ?>

            <form action="register.php" method="POST" id="registerForm">
                <!-- Full Name Input -->
                <div class="input-group">
                    <label for="username">Full Name</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <input type="text" id="username" name="username" placeholder="Enter your full name" required>
                    </div>
                </div>

                <!-- Email Input -->
                <div class="input-group">
                    <label for="email">Email</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                </div>

                <!-- Password Input -->
                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        <input type="password" id="password" name="password" placeholder="Create a password" required>
                        <button type="button" class="eye-btn" onclick="togglePassword('password')">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </button>
                    </div>
                </div>

                <!-- Confirm Password Input -->
                <div class="input-group">
                    <label for="confirm_password">Confirm Password</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
                        <button type="button" class="eye-btn" onclick="togglePassword('confirm_password')">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </button>
                    </div>
                </div>

                <!-- Primary Submit Button -->
                <button type="submit" name="submit_register" class="btn-primary" id="btnSubmit">Create Account</button>
            </form>

            <div class="divider">
                <span>OR</span>
            </div>

            <!-- Google Sign Up -->
            <button class="btn-google">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google Icon">
                Continue with Google
            </button>

            <p class="auth-switch">Already have an account? <a href="login.php">Sign In</a></p>
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

    // 2. 动态密码显隐切换 (支持多个密码框)
    function togglePassword(fieldId) {
        const passwordInput = document.getElementById(fieldId);
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    }

    // 3. 提交 Loading 状态展示
    document.getElementById('registerForm').addEventListener('submit', function() {
        const btn = document.getElementById('btnSubmit');
        btn.innerText = 'Creating account...';
        btn.style.opacity = '0.8';
    });
</script>

</body>
</html>