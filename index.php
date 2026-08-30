<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'header.php'; 
?>

<!-- 强制时间戳刷新缓存 -->
<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- 🌟 零重复、纯视觉沉浸式的 Hero Section 🌟 -->
<section class="hero-section tp-hero-bg">
    
    <div class="hero-content tp-hero-content">
        <span class="hero-kicker tp-hero-kicker">
            TravelPal · Malaysia
        </span>
        <h1 class="tp-hero-title">
            Find Your Perfect Stay
        </h1>
        <p class="tp-hero-desc">
            Discover real-time prices, top attractions, and local delicacies across the best destinations in Malaysia.
        </p>

        <!-- 纯引导，无跳转的跳动箭头 -->
        <div class="tp-bounce-arrow">
            <span class="tp-bounce-text">
                Scroll to Explore
                <i class="fa-solid fa-chevron-down" style="font-size: 18px; color: #ffffff;"></i>
            </span>
        </div>
    </div>
</section>

<main style="padding-top: 10px; padding-bottom: 80px;">
    <!-- 核心结界：1440px 宽度 -->
    <div style="width: 100%; max-width: 1440px; margin: 0 auto; padding: 0 24px; box-sizing: border-box;">

        <!-- 🌟 Trending This Week -->
        <div class="tp-trend-section">
            <div class="tp-trend-header">
                <h2>Trending This Week</h2>
                <p>Get inspired and book these highly-rated destinations</p>
            </div>
            <div class="tp-trend-grid">
                <!-- 卡片 1 -->
                <a href="/TravelPal/hotels/after_search.php?query=Sabah" class="tp-trend-card">
                    <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=800&q=80" alt="Sabah">
                    <div class="tp-trend-overlay">
                        <div class="tp-trend-meta">
                            <span class="tp-trend-tag">Crystal Waters</span>
                            <span class="tp-trend-price">From RM 399 / night</span>
                        </div>
                        <h3 class="tp-trend-title">Semporna, Sabah <span class="rating"><i class="fa-solid fa-star" style="font-size:10px;"></i> 4.9</span></h3>
                        <p class="tp-trend-desc">Dive into the world's most beautiful archipelagos and coral reefs.</p>
                        <span class="tp-trend-btn">Explore Stays <i class="fa-solid fa-arrow-right" style="margin-left:5px;"></i></span>
                    </div>
                </a>
                <!-- 卡片 2 -->
                <a href="/TravelPal/hotels/after_search.php?query=Pahang" class="tp-trend-card">
                    <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80" alt="Cameron Highlands">
                    <div class="tp-trend-overlay">
                        <div class="tp-trend-meta">
                            <span class="tp-trend-tag">Cool Breezes</span>
                            <span class="tp-trend-price">From RM 180 / night</span>
                        </div>
                        <h3 class="tp-trend-title">Cameron Highlands <span class="rating"><i class="fa-solid fa-star" style="font-size:10px;"></i> 4.7</span></h3>
                        <p class="tp-trend-desc">Stroll through endless emerald tea plantations above the clouds.</p>
                        <span class="tp-trend-btn">Explore Stays <i class="fa-solid fa-arrow-right" style="margin-left:5px;"></i></span>
                    </div>
                </a>
                <!-- 卡片 3 -->
                <a href="/TravelPal/hotels/after_search.php?query=Penang" class="tp-trend-card">
                    <img src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80" alt="Penang">
                    <div class="tp-trend-overlay">
                        <div class="tp-trend-meta">
                            <span class="tp-trend-tag">Rich Culture</span>
                            <span class="tp-trend-price">From RM 150 / night</span>
                        </div>
                        <h3 class="tp-trend-title">Georgetown, Penang <span class="rating"><i class="fa-solid fa-star" style="font-size:10px;"></i> 4.8</span></h3>
                        <p class="tp-trend-desc">Explore living history and taste world-class street food.</p>
                        <span class="tp-trend-btn">Explore Stays <i class="fa-solid fa-arrow-right" style="margin-left:5px;"></i></span>
                    </div>
                </a>
            </div>
        </div>

        <!-- 1. 分类标题 -->
        <div style="text-align: left; margin-bottom: 24px;">
            <h2 style="margin: 0 0 6px 0; color: #111827; font-size: 26px; font-weight: 800; letter-spacing: -0.02em;">Explore TravelPal by Category</h2>
            <p style="margin: 0; color: #4b5563; font-size: 15px;">Your complete guide to traveling across Malaysia</p>
        </div>

        <!-- 2. 四个分类方格 -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 80px;">
            <?php 
            $smartData = [
                ['icon' => 'fa-plane', 'title' => 'Flights', 'desc' => 'Domestic & International', 'label' => 'Lowest Fares From', 'val' => 'RM 89', 'trend' => 92, 'link' => '/TravelPal/flights/index.php'],
                ['icon' => 'fa-hotel', 'title' => 'Hotels', 'desc' => 'Resorts & City Stays', 'label' => 'Properties Available', 'val' => '120+', 'trend' => 85, 'link' => '/TravelPal/hotels/index.php'],
                ['icon' => 'fa-utensils', 'title' => 'Restaurants', 'desc' => 'Local Delicacies', 'label' => 'Top Rated Spots', 'val' => '4.8★', 'trend' => 88, 'link' => '/TravelPal/restaurant/index.php']
            ];
            foreach ($smartData as $data): ?>
            <a class="tp-strict-card" href="<?php echo $data['link']; ?>" style="text-decoration: none; background: linear-gradient(135deg, #f8fbf9 0%, #dcfce7 100%); padding: 24px; display: flex; flex-direction: column; justify-content: space-between; height: 200px;">
                <div style="display: flex; align-items: center; gap: 14px;">
                    <div style="width: 44px; height: 44px; background: #ecfdf5; color: #047857; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                        <i class="fa-solid <?php echo $data['icon']; ?>"></i>
                    </div>
                    <div>
                        <h3 style="font-size: 17px; font-weight: 700; color: #111827; margin: 0 0 2px 0; line-height: 1.2;"><?php echo $data['title']; ?></h3>
                        <p style="font-size: 13px; color: #6b7280; margin: 0; line-height: 1.3;"><?php echo $data['desc']; ?></p>
                    </div>
                </div>
                <div style="margin-top: 20px;">
                    <span style="font-size: 11px; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;"><?php echo $data['label']; ?></span>
                    <div style="font-size: 26px; font-weight: 900; color: #047857; margin-top: 4px; line-height: 1;"><?php echo $data['val']; ?></div>
                </div>
                <div style="display: flex; align-items: center; gap: 8px; margin-top: auto; padding-top: 14px; border-top: 1px solid rgba(4,120,87,0.1);">
                    <div style="width: 14px; height: 14px; border-radius: 50%; background: conic-gradient(#047857 calc(<?php echo $data['trend']; ?> * 1%), rgba(4,120,87,0.2) 0); display: flex; align-items: center; justify-content: center;">
                        <div style="width: 8px; height: 8px; border-radius: 50%; background: #ffffff;"></div>
                    </div>
                    <span style="font-size: 12px; font-weight: 700; color: #4b5563;">Trending: <?php echo $data['trend']; ?>%</span>
                </div>
            </a>
            <?php endforeach; ?>

            <!-- 🌟🌟 第 4 个：智能判断的会员卡片 🌟🌟 -->
            <?php 
            $promoUsed = $_SESSION['promo_used'] ?? false; 
            ?>
            
            <?php if ($travelPalLoggedIn && $promoUsed): ?>
                <a class="tp-strict-card" href="/TravelPal/attractions/index.php" style="text-decoration: none; background: linear-gradient(135deg, #f8fbf9 0%, #dcfce7 100%); padding: 24px; display: flex; flex-direction: column; justify-content: space-between; height: 200px;">
                    <div style="display: flex; align-items: center; gap: 14px;">
                        <div style="width: 44px; height: 44px; background: #ecfdf5; color: #047857; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                            <i class="fa-solid fa-ticket-simple"></i>
                        </div>
                        <div>
                            <h3 style="font-size: 17px; font-weight: 700; color: #111827; margin: 0 0 2px 0; line-height: 1.2;">Attractions</h3>
                            <p style="font-size: 13px; color: #6b7280; margin: 0; line-height: 1.3;">Theme Parks & Tours</p>
                        </div>
                    </div>
                    <div style="margin-top: 20px;">
                        <span style="font-size: 11px; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">Top Experiences</span>
                        <div style="font-size: 26px; font-weight: 900; color: #047857; margin-top: 4px; line-height: 1;">50+</div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px; margin-top: auto; padding-top: 14px; border-top: 1px solid rgba(4,120,87,0.1);">
                        <div style="width: 14px; height: 14px; border-radius: 50%; background: conic-gradient(#047857 calc(89 * 1%), rgba(4,120,87,0.2) 0); display: flex; align-items: center; justify-content: center;">
                            <div style="width: 8px; height: 8px; border-radius: 50%; background: #ffffff;"></div>
                        </div>
                        <span style="font-size: 12px; font-weight: 700; color: #4b5563;">Trending: 89%</span>
                    </div>
                </a>

            <?php elseif ($travelPalLoggedIn && !$promoUsed): ?>
                <a class="tp-strict-member" href="/TravelPal/flights/index.php" style="text-decoration: none; background: #047857; padding: 24px; display: flex; flex-direction: column; justify-content: space-between; height: 200px; transition: transform 0.2s ease;">
                    <div style="display: flex; align-items: center; gap: 14px;">
                        <div style="width: 44px; height: 44px; background: #ffffff; color: #047857; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                            <i class="fa-solid fa-user-check"></i>
                        </div>
                        <div>
                            <h3 style="font-size: 17px; font-weight: 700; color: #ffffff; margin: 0 0 2px 0; line-height: 1.2;">Welcome Back!</h3>
                            <p style="font-size: 13px; color: rgba(255,255,255,0.85); margin: 0; line-height: 1.3;">TravelPal Member</p>
                        </div>
                    </div>
                    <div style="margin-top: 20px;">
                        <span style="font-size: 11px; font-weight: 700; color: rgba(255,255,255,0.85); text-transform: uppercase; letter-spacing: 0.05em;">Now you can enjoy your</span>
                        <div style="font-size: 28px; font-weight: 900; color: #C6FF34; margin-top: 4px; line-height: 1;">15% OFF</div>
                    </div>
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-top: auto; padding-top: 14px; border-top: 1px solid rgba(255,255,255,0.2);">
                        <span style="font-size: 12px; font-weight: 700; color: #ffffff;">Book your trip now</span>
                        <i class="fa-solid fa-arrow-right" style="color: #ffffff; font-size: 14px;"></i>
                    </div>
                </a>

            <?php else: ?>
                <a class="tp-strict-member" href="/TravelPal/auth/login.php" style="text-decoration: none; background: #047857; padding: 24px; display: flex; flex-direction: column; justify-content: space-between; height: 200px; transition: transform 0.2s ease;">
                    <div style="display: flex; align-items: center; gap: 14px;">
                        <div style="width: 44px; height: 44px; background: #ffffff; color: #047857; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                            <i class="fa-solid fa-gift"></i>
                        </div>
                        <div>
                            <h3 style="font-size: 17px; font-weight: 700; color: #ffffff; margin: 0 0 2px 0; line-height: 1.2;">Member Benefits</h3>
                            <p style="font-size: 13px; color: rgba(255,255,255,0.85); margin: 0; line-height: 1.3;">Unlock exclusive rewards</p>
                        </div>
                    </div>
                    <div style="margin-top: 20px;">
                        <span style="font-size: 11px; font-weight: 700; color: rgba(255,255,255,0.85); text-transform: uppercase; letter-spacing: 0.05em;">Register Free & Save Up To</span>
                        <div style="font-size: 28px; font-weight: 900; color: #C6FF34; margin-top: 4px; line-height: 1;">15% OFF</div>
                    </div>
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-top: auto; padding-top: 14px; border-top: 1px solid rgba(255,255,255,0.2);">
                        <span style="font-size: 12px; font-weight: 700; color: #ffffff;">Sign In / Join Now</span>
                        <i class="fa-solid fa-arrow-right" style="color: #ffffff; font-size: 14px;"></i>
                    </div>
                </a>
            <?php endif; ?>
        </div>

        <!-- 3. 左右交替图文 -->
        <div style="margin-bottom: 80px;">
            <div class="tp-zigzag-row">
                <div style="flex: 1; display: flex; flex-direction: column; align-items: flex-start;">
                    <span style="font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.12em; color: #047857; margin-bottom: 10px;">Explore The Skies</span>
                    <h2 style="font-size: 32px; font-weight: 800; color: #111827; margin: 0 0 16px 0; line-height: 1.2;">Flights to Top Destinations</h2>
                    <p style="font-size: 16px; color: #4b5563; margin: 0 0 28px 0; line-height: 1.6;">Compare and book cheap flights across Malaysia. Find the best airlines and lowest fares for your next getaway.</p>
                    <a href="/TravelPal/flights/index.php" class="tp-action-btn">Search Flights</a>
                </div>
                <div class="tp-strict-slider zigzag-slider" data-interval="5000">
                    <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=800&q=80" class="slide active">
                    <img src="https://images.unsplash.com/photo-1544644181-1484b3fdfc62?w=800&q=80" class="slide">
                </div>
            </div>

            <div class="tp-zigzag-row">
                <div style="flex: 1; display: flex; flex-direction: column; align-items: flex-start;">
                    <span style="font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.12em; color: #047857; margin-bottom: 10px;">Comfortable Stays</span>
                    <h2 style="font-size: 32px; font-weight: 800; color: #111827; margin: 0 0 16px 0; line-height: 1.2;">Hotels & Holiday Rentals</h2>
                    <p style="font-size: 16px; color: #4b5563; margin: 0 0 28px 0; line-height: 1.6;">From luxury 5-star beachfront resorts in Penang to cozy boutique stays in KL, discover thousands of accommodations with real-time prices.</p>
                    <a href="/TravelPal/hotels/index.php" class="tp-action-btn">Explore Hotels</a>
                </div>
                <div class="tp-strict-slider zigzag-slider" data-interval="5000">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80" class="slide active">
                    <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?w=800&q=80" class="slide">
                </div>
            </div>

            <div class="tp-zigzag-row">
                <div style="flex: 1; display: flex; flex-direction: column; align-items: flex-start;">
                    <span style="font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.12em; color: #047857; margin-bottom: 10px;">Culinary Journeys</span>
                    <h2 style="font-size: 32px; font-weight: 800; color: #111827; margin: 0 0 16px 0; line-height: 1.2;">Restaurants & Local Food</h2>
                    <p style="font-size: 16px; color: #4b5563; margin: 0 0 28px 0; line-height: 1.6;">Savor the best local delicacies and fine dining. Discover top-rated eateries, street food guides, and cozy cafes recommended by locals.</p>
                    <a href="/TravelPal/restaurants/index.php" class="tp-action-btn">Find Restaurants</a>
                </div>
                <div class="tp-strict-slider zigzag-slider" data-interval="5000">
                    <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=800&q=80" class="slide active">
                    <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800&q=80" class="slide">
                </div>
            </div>
            
            <div class="tp-zigzag-row">
                <div style="flex: 1; display: flex; flex-direction: column; align-items: flex-start;">
                    <span style="font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.12em; color: #047857; margin-bottom: 10px;">Unforgettable Experiences</span>
                    <h2 style="font-size: 32px; font-weight: 800; color: #111827; margin: 0 0 16px 0; line-height: 1.2;">Attractions & Activities</h2>
                    <p style="font-size: 16px; color: #4b5563; margin: 0 0 28px 0; line-height: 1.6;">Immerse yourself in culture, nature, and adventure. Book tickets to iconic landmarks, theme parks, and hidden nature trails across Malaysia.</p>
                    <a href="/TravelPal/attractions/index.php" class="tp-action-btn">Discover Attractions</a>
                </div>
                <div class="tp-strict-slider zigzag-slider" data-interval="5000">
                    <img src="https://images.unsplash.com/photo-1596422846543-75c6fc197f07?w=800&q=80" class="slide active">
                    <img src="https://images.unsplash.com/photo-1589308078059-be1415eab4c3?w=800&q=80" class="slide">
                </div>
            </div>
        </div>

        <!-- 4. About TravelPal -->
        <div style="display: flex; align-items: center; gap: 50px; margin-bottom: 80px; padding: 48px; background: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0;">
            <div style="flex: 1;">
                <span style="font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.12em; color: #047857; margin-bottom: 10px; display: block;">Our Story</span>
                <h2 style="font-size: 32px; font-weight: 800; color: #111827; margin: 0 0 16px 0; line-height: 1.2;">Connecting You to the Heart of Malaysia</h2>
                <p style="font-size: 16px; color: #4b5563; margin: 0 0 16px 0; line-height: 1.6;">
                    Founded with a simple mission: to make exploring Malaysia seamless, authentic, and unforgettable. TravelPal started as a vision to bring together the best flights, accommodations, and hidden local gems into one smart platform.
                </p>
                <p style="font-size: 16px; color: #4b5563; margin: 0 0 32px 0; line-height: 1.6;">
                    As a proudly local tech company, we combine cutting-edge technology with deep local knowledge to ensure every journey you take is perfectly crafted. From the bustling streets of Kuala Lumpur to the pristine beaches of Sabah, we are your ultimate travel companion.
                </p>
                <div style="display: flex; gap: 40px;">
                    <div>
                        <h4 style="font-size: 28px; font-weight: 900; color: #047857; margin: 0 0 4px 0; line-height: 1;">100%</h4>
                        <span style="font-size: 13px; color: #6b7280; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Locally Founded</span>
                    </div>
                    <div>
                        <h4 style="font-size: 28px; font-weight: 900; color: #047857; margin: 0 0 4px 0; line-height: 1;">8</h4>
                        <span style="font-size: 13px; color: #6b7280; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">States Covered</span>
                    </div>
                    <div>
                        <h4 style="font-size: 28px; font-weight: 900; color: #047857; margin: 0 0 4px 0; line-height: 1;">24/7</h4>
                        <span style="font-size: 13px; color: #6b7280; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Travel Support</span>
                    </div>
                </div>
            </div>
            <div style="flex: 1; border-radius: 12px; overflow: hidden; height: 380px; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
                <img src="https://images.unsplash.com/photo-1596422846543-75c6fc197f07?w=800&q=80" alt="About TravelPal" style="width: 100%; height: 100%; object-fit: cover; display: block;">
            </div>
        </div>

        <!-- 🌟🌟 5. Why Choose TravelPal 🌟🌟 -->
        <div class="tp-why-section">
            <h2 class="tp-why-title">Why choose TravelPal</h2>
            <div class="tp-why-grid">
                <div class="tp-why-item">
                    <div class="tp-why-icon-wrap"><i class="fa-solid fa-map-location-dot"></i></div>
                    <h4>Discover the possibilities</h4>
                    <p>With hundreds of flights, hotels & top attractions across Malaysia, you're sure to find joy.</p>
                </div>
                <div class="tp-why-item">
                    <div class="tp-why-icon-wrap"><i class="fa-solid fa-tags"></i></div>
                    <h4>Enjoy deals & delights</h4>
                    <p>Quality activities. Great prices. Plus, enjoy exclusive member discounts to save more.</p>
                </div>
                <div class="tp-why-item">
                    <div class="tp-why-icon-wrap"><i class="fa-solid fa-mobile-screen-button"></i></div>
                    <h4>Exploring made easy</h4>
                    <p>Book last minute, skip the lines & manage all your itineraries in one seamless dashboard.</p>
                </div>
                <div class="tp-why-item">
                    <div class="tp-why-icon-wrap"><i class="fa-solid fa-shield-heart"></i></div>
                    <h4>Travel you can trust</h4>
                    <p>Read real guest reviews & get reliable customer support. We're with you at every step.</p>
                </div>
            </div>
        </div>

        <!-- 🌟🌟 6. AI 宣传视频模块 (精致 4:3 左右排版版) 🌟🌟 -->
        <div class="tp-video-section">
            
            <!-- 左侧：文字情绪铺垫 -->
            <div class="tp-video-text">
                <span>The Escape Awaits</span>
                <h2>One Tap to Your Dream Getaway</h2>
                <p>From the dull daily grind to pristine beaches and cool misty highlands. Watch how TravelPal transforms your travel dreams into reality instantly.</p>
                <a href="#" onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;">
                    Start Planning <i class="fa-solid fa-arrow-up"></i>
                </a>
            </div>

            <!-- 右侧：精简版 4:3 比例视频 -->
            <!-- 🔽 在 CSS 中控制了这里的最大宽度 max-width: 480px 🔽 -->
            <div class="tp-video-wrapper">
                <video controls autoplay loop playsinline>
                    <source src="/TravelPal/assets/malaysia-promo.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

        </div>
    </div> 
</main>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".zigzag-slider").forEach(slider => {
        const slides = slider.querySelectorAll(".slide");
        let idx = 0;
        setInterval(() => {
            slides[idx].classList.remove("active");
            idx = (idx + 1) % slides.length;
            slides[idx].classList.add("active");
        }, parseInt(slider.getAttribute("data-interval")));
    });
});
</script>

<?php include 'footer.php'; ?>