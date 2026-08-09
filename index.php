<?php include 'header.php'; ?>

<!-- 引入样式文件 -->
<link rel="stylesheet" href="/TravelPal/style.css?v=2026">

<!-- 1. Welcome 标语区域 -->
<section class="welcome-hero">
    <div class="welcome-badge">EXPLORE MORE, JOURNEY BETTER</div>
    <h1>Welcome to TravelPal <span class="plane-icon">✈️</span></h1>
    <p class="subtitle">Your ultimate travel assistant.</p>
</section>

<!-- 2. 渐变绿轮播卡片 (scrollingView) -->
<section id="scrollingView">
    <h2>Explore Southeast Asia<br><span>Thailand · Vietnam · Indonesia · Malaysia</span></h2>
    
    <div class="images" id="image-slider">
        <img src="/TravelPal/images/thailand.jpg" alt="Thailand">
        <img src="/TravelPal/images/thailand2.jpg" alt="Thailand">
        <img src="/TravelPal/images/vietnam.jpg" alt="Vietnam">
        <img src="/TravelPal/images/vietnam2.jpg" alt="Vietnam">
        <img src="/TravelPal/images/indonesia.jpg" alt="Indonesia">
        <img src="/TravelPal/images/indonesia2.jpg" alt="Indonesia">
        <img src="/TravelPal/images/malaysia.jpg" alt="Malaysia">
        <img src="/TravelPal/images/malaysia2.jpg" alt="Malaysia">
    </div>
</section>

<!-- 3. 荧光绿搜索栏组件 -->
<section class="search-container">
    <div class="search">
        <input type="text" id="searchBar" placeholder="Search Malaysia, Vietnam, Thailand, Indonesia places to go, hotels...">
        <button type="button" onclick="navigateSearch()" id="searching" title="Search"></button>
    </div>
    <div class="error-message" id="searchError"></div>
</section>

<!-- 4. 四个国家卡片区域 (移到 Search Bar 正下方) -->
<section class="viewMore">
    <dialog id="travelPopup">
        <h3 id="popupTitle">Explore Country</h3>
        <div class="popup-links">
            <a id="flightLink">Flights</a>
            <a id="hotelLink">Hotels</a>
            <a id="restaurantLink">Restaurants</a>
            <a id="attractionLink">Attractions</a>
        </div>
        <button type="button" onclick="closeTravelPopup()">Close</button>
    </dialog>
    
    <div class="view-card">
        <h3>Thailand</h3>
        <img class="place-image" src="/TravelPal/images/thailand3.jpg" id="nightMarket" alt="Night market">
        <pre>· Waterfall  · Night Market</pre>
        <button type="button" onclick="openTravelPopup('Thailand')">View more</button>
    </div>
    
    <div class="view-card">
        <h3>Vietnam</h3>
        <img class="place-image" src="/TravelPal/images/vietnam3.jpg" id="ancientTowns" alt="Ancient towns">
        <pre>· Coffee  · Ancient Towns</pre>
        <button type="button" onclick="openTravelPopup('Vietnam')">View more</button>
    </div>
    
    <div class="view-card">
        <h3>Indonesia</h3>
        <img class="place-image" src="/TravelPal/images/indonesia3.jpg" id="mountBromo" alt="Mount Bromo">
        <pre>· Sunrise  · Mount Bromo</pre>
        <button type="button" onclick="openTravelPopup('Indonesia')">View more</button>
    </div>
    
    <div class="view-card">
        <h3>Malaysia</h3>
        <img class="place-image" src="/TravelPal/images/malaysia3.jpg" id="jonkerStreet" alt="Jonker street">
        <pre>· Heritage  · Jonker Street</pre>
        <button type="button" onclick="openTravelPopup('Malaysia')">View more</button>
    </div>
</section>

<!-- 5. Top Picks 推荐区块 (完整 8 个卡片) -->
<section class="top-picks-section">
    <h2 class="section-title">Top Picks</h2>
    <div class="top-picks-wrapper">
        <div id="topPicks">
            <!-- 1 -->
            <div class="pick-card">
                <img class="pick-image" src="/TravelPal/images/thailand.jpg" alt="Thailand Spot">
                <p>Bangkok Grand Palace</p>
                <div class="rating">⭐ 4.8</div>
            </div>
            <!-- 2 -->
            <div class="pick-card">
                <img class="pick-image" src="/TravelPal/images/vietnam.jpg" alt="Vietnam Spot">
                <p>Ha Long Bay Cruise</p>
                <div class="rating">⭐ 4.9</div>
            </div>
            <!-- 3 -->
            <div class="pick-card">
                <img class="pick-image" src="/TravelPal/images/indonesia.jpg" alt="Indonesia Spot">
                <p>Bali Nusa Penida</p>
                <div class="rating">⭐ 4.7</div>
            </div>
            <!-- 4 -->
            <div class="pick-card">
                <img class="pick-image" src="/TravelPal/images/malaysia.jpg" alt="Malaysia Spot">
                <p>Petronas Twin Towers</p>
                <div class="rating">⭐ 4.8</div>
            </div>
            <!-- 5 -->
            <div class="pick-card">
                <img class="pick-image" src="/TravelPal/images/thailand2.jpg" alt="Phuket">
                <p>Phuket Phi Phi Islands</p>
                <div class="rating">⭐ 4.9</div>
            </div>
            <!-- 6 -->
            <div class="pick-card">
                <img class="pick-image" src="/TravelPal/images/vietnam2.jpg" alt="Hanoi">
                <p>Hanoi Ancient Street</p>
                <div class="rating">⭐ 4.6</div>
            </div>
            <!-- 7 -->
            <div class="pick-card">
                <img class="pick-image" src="/TravelPal/images/indonesia2.jpg" alt="Bromo">
                <p>Mount Bromo Sunrise</p>
                <div class="rating">⭐ 4.8</div>
            </div>
            <!-- 8 -->
            <div class="pick-card">
                <img class="pick-image" src="/TravelPal/images/malaysia2.jpg" alt="Langkawi">
                <p>Langkawi Sky Bridge</p>
                <div class="rating">⭐ 4.7</div>
            </div>
        </div>
        <!-- 依然保留右滑按钮，点一下滑动看后面的卡片 -->
        <button type="button" class="next-arrow" onclick="scrollTopPicks()" title="Next">➔</button>
    </div>
</section><!-- 6. Features 核心功能与优势 -->
<section class="features-section">
    <h2 class="section-title" style="background:none; box-shadow:none;">Why TravelPal?</h2>
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

<!-- 7. 数据信任条 (Stats) -->
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

<!-- 8. 底部引导 CTA -->
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

<script>
    // 1. 顶部轮播图自动播放
    const slider = document.getElementById("image-slider");
    if (slider) {
        setInterval(() => {
            if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth - 5) {
                slider.scrollTo({ left: 0, behavior: "smooth" });
            } else {
                slider.scrollBy({ left: 260, behavior: "smooth" });
            }
        }, 3000);
    }

    // 2. Top Picks 向右滚动按钮
    function scrollTopPicks() {
        const topPicks = document.getElementById("topPicks");
        if (topPicks) {
            if (topPicks.scrollLeft + topPicks.clientWidth >= topPicks.scrollWidth - 5) {
                topPicks.scrollTo({ left: 0, behavior: "smooth" });
            } else {
                topPicks.scrollBy({ left: 280, behavior: "smooth" });
            }
        }
    }

    // 3. 搜索逻辑
    function navigateSearch() {
        const result = document.getElementById("searchBar").value.trim();
        const error = document.getElementById("searchError");
        error.textContent = "";
        
        const pages = {
            thailand: "Thailand",
            vietnam: "Vietnam",
            indonesia: "Indonesia",
            malaysia: "Malaysia"
        };
        
        if (result === "") {
            error.textContent = "Search cannot be blank.";
        } else if (pages[result.toLowerCase()]) {
            window.location.href = "/TravelPal/Attractions/" + pages[result.toLowerCase()];
        } else {
            error.textContent = "Country not found.";
        }
    }

    // 4. Modal 弹窗逻辑
    function openTravelPopup(country) {
        document.getElementById("popupTitle").textContent = "Explore " + country;
        document.getElementById("flightLink").href = "/TravelPal/Flights/" + country;
        document.getElementById("hotelLink").href = "/TravelPal/Hotels/" + country;
        document.getElementById("restaurantLink").href = "/TravelPal/Restaurants/" + country;
        document.getElementById("attractionLink").href = "/TravelPal/Attractions/" + country;
        document.getElementById("travelPopup").showModal();
    }

    function closeTravelPopup() {
        document.getElementById("travelPopup").close();
    }
</script>

<?php include 'footer.php'; ?>