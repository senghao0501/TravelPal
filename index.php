<?php include 'header.php'; ?>

<!-- 页面完整样式 -->
<style>
    /* ================= 1. Welcome 标语区域 ================= */
    .welcome-hero {
        text-align: center;
        padding: 3rem 1.5rem 1rem;
        max-width: 900px;
        margin: 0 auto;
    }

    .welcome-badge {
        display: inline-block;
        background: #e6f7f0;
        color: #00aa6c;
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        padding: 0.4rem 1.2rem;
        border-radius: 50px;
        margin-bottom: 1rem;
        box-shadow: 0 2px 8px rgba(0, 170, 108, 0.1);
    }

    .welcome-hero h1 {
        font-size: 2.8rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 0.6rem;
        letter-spacing: -0.5px;
    }

    .welcome-hero h1 span.plane-icon {
        display: inline-block;
        transition: transform 0.3s ease;
    }

    .welcome-hero h1:hover span.plane-icon {
        transform: translateY(-4px) translateX(4px);
    }

    .welcome-hero p.subtitle {
        font-size: 1.25rem;
        color: #64748b;
        font-weight: 400;
        margin-bottom: 1rem;
    }

    /* ================= 2. 搜索栏 ================= */
    .search-section {
        padding: 0.5rem 1rem 1.5rem;
        display: flex;
        justify-content: center;
    }

    .search-box {
        display: flex;
        align-items: center;
        background: #ffffff;
        border: 2px solid #e2e8f0;
        border-radius: 40px;
        padding: 0.4rem 0.6rem 0.4rem 1.5rem;
        width: 100%;
        max-width: 750px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .search-box:focus-within {
        border-color: #00aa6c;
        box-shadow: 0 6px 24px rgba(0, 170, 108, 0.15);
    }

    .search-box input {
        border: none;
        outline: none;
        width: 100%;
        font-size: 1rem;
        color: #1e293b;
    }

    .btn-search {
        background-color: #00aa6c;
        color: white;
        border: none;
        padding: 0.7rem 1.8rem;
        border-radius: 25px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
        white-space: nowrap;
    }

    .btn-search:hover {
        background-color: #008856;
    }

    /* ================= 3. 动态 Hero 横幅 ================= */
    .hero-container {
        max-width: 1200px;
        margin: 1rem auto 3.5rem;
        padding: 0 1rem;
    }

    .hero-card {
        background-color: #00aa6c;
        border-radius: 24px;
        display: flex;
        overflow: hidden;
        box-shadow: 0 12px 30px rgba(0, 170, 108, 0.2);
        min-height: 420px;
    }

    .hero-left {
        flex: 1;
        position: relative;
        min-height: 380px;
        overflow: hidden;
    }

    .carousel-slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 0.8s ease-in-out;
        background-size: cover;
        background-position: center;
    }

    .carousel-slide.active {
        opacity: 1;
    }

    .image-overlay-content {
        position: absolute;
        bottom: 20px;
        left: 20px;
        z-index: 10;
    }

    .location-tag {
        background: rgba(0, 0, 0, 0.55);
        backdrop-filter: blur(4px);
        color: white;
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .hero-right {
        flex: 1;
        padding: 3.5rem 3rem;
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .hero-right h1 {
        font-size: 2.8rem;
        line-height: 1.15;
        font-weight: 800;
        margin-bottom: 1rem;
        letter-spacing: -0.5px;
    }

    .hero-right p {
        font-size: 1.15rem;
        opacity: 0.95;
        margin-bottom: 2rem;
        line-height: 1.5;
    }

    .hero-cta-btn {
        align-self: flex-start;
        background-color: #1e293b;
        color: white;
        padding: 0.9rem 2.2rem;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 700;
        font-size: 1rem;
        transition: background 0.2s, transform 0.2s;
    }

    .hero-cta-btn:hover {
        background-color: #0f172a;
        transform: translateY(-2px);
    }

    /* ================= 4. 新增：核心优势 (Features Section) ================= */
    .features-section {
        max-width: 1200px;
        margin: 0 auto 4rem;
        padding: 0 1rem;
        text-align: center;
    }

    .section-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }

    .section-subtitle {
        color: #64748b;
        margin-bottom: 2.5rem;
        font-size: 1.05rem;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .feature-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 2rem 1.5rem;
        text-align: left;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .feature-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        border-color: #cbd5e1;
    }

    .feature-icon {
        width: 50px;
        height: 50px;
        background: #e6f7f0;
        color: #00aa6c;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1.2rem;
    }

    .feature-card h3 {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }

    .feature-card p {
        color: #64748b;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    /* ================= 5. 新增：数据信任条 (Stats Banner) ================= */
    .stats-section {
        background-color: #f8fafc;
        border-top: 1px solid #e2e8f0;
        border-bottom: 1px solid #e2e8f0;
        padding: 3rem 1rem;
        margin-bottom: 4rem;
    }

    .stats-container {
        max-width: 1000px;
        margin: 0 auto;
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        gap: 2rem;
        text-align: center;
    }

    .stat-item h2 {
        font-size: 2.5rem;
        font-weight: 800;
        color: #00aa6c;
        margin-bottom: 0.2rem;
    }

    .stat-item p {
        color: #64748b;
        font-weight: 600;
        font-size: 0.95rem;
    }

    /* ================= 6. 新增：底部引导注册 (CTA Section) ================= */
    .cta-container {
        max-width: 1200px;
        margin: 0 auto 4rem;
        padding: 0 1rem;
    }

    .cta-card {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border-radius: 24px;
        padding: 3.5rem 2rem;
        text-align: center;
        color: white;
    }

    .cta-card h2 {
        font-size: 2.2rem;
        font-weight: 800;
        margin-bottom: 0.8rem;
    }

    .cta-card p {
        color: #94a3b8;
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto 2rem;
    }

    .cta-btn-group {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-primary-cta {
        background-color: #00aa6c;
        color: white;
        padding: 0.85rem 2rem;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 700;
        transition: background 0.2s;
    }

    .btn-primary-cta:hover {
        background-color: #008856;
    }

    .btn-secondary-cta {
        background-color: transparent;
        color: white;
        border: 2px solid #334155;
        padding: 0.85rem 2rem;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 700;
        transition: border-color 0.2s, background 0.2s;
    }

    .btn-secondary-cta:hover {
        border-color: #64748b;
        background: rgba(255, 255, 255, 0.05);
    }

    /* 响应式适配 */
    @media (max-width: 850px) {
        .welcome-hero h1 { font-size: 2.2rem; }
        .hero-card { flex-direction: column; }
        .hero-left { min-height: 280px; }
        .hero-right h1 { font-size: 2rem; }
    }
</style>

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

<!-- 4. 新增：核心功能与优势 (Features) -->
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

<!-- 5. 新增：数据信任条 (Stats) -->
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

<!-- 6. 新增：底部引导登录/注册 (CTA) -->
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