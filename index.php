<?php include 'header.php'; ?>

<!-- 引入独立的 CSS 文件 -->
<link rel="stylesheet" href="/TravelPal/css/modules/intro.css">

<!-- 1. Welcome 标语区域 -->
<section class="welcome-hero">
    <div class="welcome-badge">EXPLORE MORE, JOURNEY BETTER</div>
    <h1>Welcome to TravelPal <span class="plane-icon">✈️</span></h1>
    <p class="subtitle">Your ultimate travel assistant.</p>
</section>

<!-- 2. 搜索栏组件 -->
<section class="search-section">
    <div class="search-box">
        <input type="text" placeholder="Search Malaysia, Vietnam, Thailand, Indonesia places to go, hotels...">
        <button class="btn-search">Search</button>
    </div>
</section>

<!-- 3. 主视觉 Hero 区域 -->
<div class="hero-container">
    <div class="hero-card">
        <div class="hero-left">
            <div class="carousel-slide active" style="background-image: url('https://images.unsplash.com/photo-1596422846543-75c6fc197f07?auto=format&fit=crop&w=800&q=80');">
                <div class="image-overlay-content">
                    <span class="location-tag">🇲🇾 Kuala Lumpur, Malaysia</span>
                </div>
            </div>
            <div class="carousel-slide" style="background-image: url('https://images.unsplash.com/photo-1528127269322-539801943592?auto=format&fit=crop&w=800&q=80');">
                <div class="image-overlay-content">
                    <span class="location-tag">🇻🇳 Ha Long Bay, Vietnam</span>
                </div>
            </div>
            <div class="carousel-slide" style="background-image: url('https://images.unsplash.com/photo-1508009603885-50cf7c579365?auto=format&fit=crop&w=800&q=80');">
                <div class="image-overlay-content">
                    <span class="location-tag">🇹🇭 Bangkok, Thailand</span>
                </div>
            </div>
            <div class="carousel-slide" style="background-image: url('https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=800&q=80');">
                <div class="image-overlay-content">
                    <span class="location-tag">🇮🇩 Bali, Indonesia</span>
                </div>
            </div>
        </div>

        <div class="hero-right">
            <h1>Find things to do<br>for everywhere you go</h1>
            <p>Explore top destinations across Malaysia, Vietnam, Thailand, and Indonesia. Book your dream journey with TravelPal.</p>
            <a href="/TravelPal/auth/login.php" class="hero-cta-btn">Sign in</a>
        </div>
    </div>
</div>

<!-- 4. 核心功能与优势 (Features) -->
<section class="features-section">
    <h2 class="section-title">Everything You Need for Your Next Trip</h2>
    <p class="section-subtitle">Discover how TravelPal makes travel planning effortless.</p>
    
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">🗺️</div>
            <h3>Smart Itinerary</h3>
            <p>Custom trip recommendations tailored to your style and timeline.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🌴</div>
            <h3>Top SEA Spots</h3>
            <p>Full coverage of Malaysia, Vietnam, Thailand, and Indonesia.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">⭐</div>
            <h3>Verified Reviews</h3>
            <p>Real traveler ratings to help you skip traps and find hidden gems.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🏨</div>
            <h3>All-in-One Booking</h3>
            <p>Manage attractions, hotels, and tours seamlessly in one place.</p>
        </div>
    </div>
</section>

<!-- 5. 数据信任条 (Stats) -->
<section class="stats-section">
    <div class="stats-container">
        <div class="stat-item">
            <h2>10k+</h2>
            <p>Happy Travelers</p>
        </div>
        <div class="stat-item">
            <h2>4</h2>
            <p>SEA Countries Covered</p>
        </div>
        <div class="stat-item">
            <h2>500+</h2>
            <p>Curated Destinations</p>
        </div>
        <div class="stat-item">
            <h2>4.9/5</h2>
            <p>User Satisfaction</p>
        </div>
    </div>
</section>

<!-- 6. 底部引导登录/注册 (CTA) -->
<div class="cta-container">
    <div class="cta-card">
        <h2>Ready to Explore the Unexplored?</h2>
        <p>Sign in or create a free account today to unlock personalized recommendations, top attraction lists, and smart travel planning.</p>
        <div class="cta-btn-group">
            <a href="/TravelPal/auth/login.php" class="btn-primary-cta">Sign In Now</a>
            <a href="/TravelPal/auth/register.php" class="btn-secondary-cta">Create Account</a>
        </div>
    </div>
</div>

<!-- JS 自动轮播控制逻辑 -->
<script>
    const slides = document.querySelectorAll('.carousel-slide');
    let currentIndex = 0;
    const intervalTime = 2500; // 2.5 秒切换

    function nextSlide() {
        slides[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + 1) % slides.length;
        slides[currentIndex].classList.add('active');
    }

    setInterval(nextSlide, intervalTime);
</script>

<?php include 'footer.php'; ?>