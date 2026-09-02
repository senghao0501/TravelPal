<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'header.php'; 
?>

<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<section class="hero-section tp-hero-bg">
    <div class="hero-content tp-hero-content">
        <span class="hero-kicker tp-hero-kicker">TravelPal · Malaysia</span>
        <h1 class="tp-hero-title">Find Your Perfect Stay</h1>
        <p class="tp-hero-desc">Discover real-time prices, top attractions, and local delicacies across the best destinations in Malaysia.</p>

        <div class="tp-bounce-arrow">
            <span class="tp-bounce-text">
                Scroll to Explore
                <i class="fa-solid fa-chevron-down"></i>
            </span>
        </div>
    </div>
</section>

<main class="tp-main-container">
    <div class="tp-content-wrapper">

        <div class="tp-trend-section">
            <div class="tp-trend-header">
                <h2>Trending This Week</h2>
                <p>Get inspired and book these highly-rated destinations</p>
            </div>
            <div class="tp-trend-grid">
                <a href="/TravelPal/hotels/after_search.php?query=Sabah" class="tp-trend-card">
                    <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=800&q=80" alt="Sabah">
                    <div class="tp-trend-overlay">
                        <div class="tp-trend-meta">
                            <span class="tp-trend-tag">Crystal Waters</span>
                            <span class="tp-trend-price">From RM 399 / night</span>
                        </div>
                        <h3 class="tp-trend-title">Semporna, Sabah <span class="rating"><i class="fa-solid fa-star"></i> 4.9</span></h3>
                        <p class="tp-trend-desc">Dive into the world's most beautiful archipelagos and coral reefs.</p>
                        <span class="tp-trend-btn">Explore Stays <i class="fa-solid fa-arrow-right"></i></span>
                    </div>
                </a>
                <a href="/TravelPal/hotels/after_search.php?query=Pahang" class="tp-trend-card">
                    <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80" alt="Cameron Highlands">
                    <div class="tp-trend-overlay">
                        <div class="tp-trend-meta">
                            <span class="tp-trend-tag">Cool Breezes</span>
                            <span class="tp-trend-price">From RM 180 / night</span>
                        </div>
                        <h3 class="tp-trend-title">Cameron Highlands <span class="rating"><i class="fa-solid fa-star"></i> 4.7</span></h3>
                        <p class="tp-trend-desc">Stroll through endless emerald tea plantations above the clouds.</p>
                        <span class="tp-trend-btn">Explore Stays <i class="fa-solid fa-arrow-right"></i></span>
                    </div>
                </a>
                <a href="/TravelPal/hotels/after_search.php?query=Penang" class="tp-trend-card">
                    <img src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80" alt="Penang">
                    <div class="tp-trend-overlay">
                        <div class="tp-trend-meta">
                            <span class="tp-trend-tag">Rich Culture</span>
                            <span class="tp-trend-price">From RM 150 / night</span>
                        </div>
                        <h3 class="tp-trend-title">Georgetown, Penang <span class="rating"><i class="fa-solid fa-star"></i> 4.8</span></h3>
                        <p class="tp-trend-desc">Explore living history and taste world-class street food.</p>
                        <span class="tp-trend-btn">Explore Stays <i class="fa-solid fa-arrow-right"></i></span>
                    </div>
                </a>
            </div>
        </div>

        <div class="tp-cat-header">
            <h2>Explore TravelPal by Category</h2>
            <p>Your complete guide to traveling across Malaysia</p>
        </div>

        <div class="tp-cat-grid">
            <?php 
            $smartData = [
                ['icon' => 'fa-plane', 'title' => 'Flights', 'desc' => 'Domestic & International', 'label' => 'Lowest Fares From', 'val' => 'RM 89', 'trend' => 92, 'link' => '/TravelPal/flights/index.php'],
                ['icon' => 'fa-hotel', 'title' => 'Hotels', 'desc' => 'Resorts & City Stays', 'label' => 'Properties Available', 'val' => '120+', 'trend' => 85, 'link' => '/TravelPal/hotels/index.php'],
                ['icon' => 'fa-utensils', 'title' => 'Restaurants', 'desc' => 'Local Delicacies', 'label' => 'Top Rated Spots', 'val' => '4.8★', 'trend' => 88, 'link' => '/TravelPal/restaurant/index.php']
            ];
            foreach ($smartData as $data): ?>
            <a class="tp-strict-card tp-cat-card" href="<?php echo $data['link']; ?>">
                <div class="tp-cat-top">
                    <div class="tp-cat-icon"><i class="fa-solid <?php echo $data['icon']; ?>"></i></div>
                    <div>
                        <h3 class="tp-cat-title"><?php echo $data['title']; ?></h3>
                        <p class="tp-cat-desc"><?php echo $data['desc']; ?></p>
                    </div>
                </div>
                <div class="tp-cat-mid">
                    <span class="tp-cat-label"><?php echo $data['label']; ?></span>
                    <div class="tp-cat-val"><?php echo $data['val']; ?></div>
                </div>
                <div class="tp-cat-bot">
                    <div class="tp-cat-trend-circle" style="background: conic-gradient(#047857 calc(<?php echo $data['trend']; ?> * 1%), rgba(4,120,87,0.2) 0);">
                        <div class="tp-cat-trend-inner"></div>
                    </div>
                    <span class="tp-cat-trend-txt">Trending: <?php echo $data['trend']; ?>%</span>
                </div>
            </a>
            <?php endforeach; ?>

           
            <?php $promoUsed = $_SESSION['promo_used'] ?? false; ?>
            
            <?php if ($travelPalLoggedIn && $promoUsed): ?>
                <a class="tp-strict-card tp-cat-card" href="/TravelPal/attractions/index.php">
                    <div class="tp-cat-top">
                        <div class="tp-cat-icon"><i class="fa-solid fa-ticket-simple"></i></div>
                        <div>
                            <h3 class="tp-cat-title">Attractions</h3>
                            <p class="tp-cat-desc">Theme Parks & Tours</p>
                        </div>
                    </div>
                    <div class="tp-cat-mid">
                        <span class="tp-cat-label">Top Experiences</span>
                        <div class="tp-cat-val">50+</div>
                    </div>
                    <div class="tp-cat-bot">
                        <div class="tp-cat-trend-circle" style="background: conic-gradient(#047857 calc(89 * 1%), rgba(4,120,87,0.2) 0);">
                            <div class="tp-cat-trend-inner"></div>
                        </div>
                        <span class="tp-cat-trend-txt">Trending: 89%</span>
                    </div>
                </a>

            <?php elseif ($travelPalLoggedIn && !$promoUsed): ?>
                <a class="tp-strict-member tp-member-card" href="/TravelPal/flights/index.php">
                    <div class="tp-cat-top">
                        <div class="tp-member-icon"><i class="fa-solid fa-user-check"></i></div>
                        <div>
                            <h3 class="tp-member-title">Welcome Back!</h3>
                            <p class="tp-member-desc">TravelPal Member</p>
                        </div>
                    </div>
                    <div class="tp-cat-mid">
                        <span class="tp-member-label">Now you can enjoy your</span>
                        <div class="tp-member-val">15% OFF</div>
                    </div>
                    <div class="tp-member-bot">
                        <span>Book your trip now</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </a>

            <?php else: ?>
                <a class="tp-strict-member tp-member-card" href="/TravelPal/auth/login.php">
                    <div class="tp-cat-top">
                        <div class="tp-member-icon"><i class="fa-solid fa-gift"></i></div>
                        <div>
                            <h3 class="tp-member-title">Member Benefits</h3>
                            <p class="tp-member-desc">Unlock exclusive rewards</p>
                        </div>
                    </div>
                    <div class="tp-cat-mid">
                        <span class="tp-member-label">Register Free & Save Up To</span>
                        <div class="tp-member-val">15% OFF</div>
                    </div>
                    <div class="tp-member-bot">
                        <span>Sign In / Join Now</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </a>
            <?php endif; ?>
        </div>

        <div class="tp-zigzag-container">
            <div class="tp-zigzag-row">
                <div class="tp-zigzag-text">
                    <span class="tp-zigzag-kicker">Explore The Skies</span>
                    <h2 class="tp-zigzag-title">Flights to Top Destinations</h2>
                    <p class="tp-zigzag-desc">Compare and book cheap flights across Malaysia. Find the best airlines and lowest fares for your next getaway.</p>
                    <a href="/TravelPal/flights/index.php" class="tp-action-btn">Search Flights</a>
                </div>
                <div class="tp-strict-slider zigzag-slider" data-interval="5000">
                    <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=800&q=80" class="slide active">
                    <img src="https://images.unsplash.com/photo-1544644181-1484b3fdfc62?w=800&q=80" class="slide">
                </div>
            </div>

            <div class="tp-zigzag-row">
                <div class="tp-zigzag-text">
                    <span class="tp-zigzag-kicker">Comfortable Stays</span>
                    <h2 class="tp-zigzag-title">Hotels & Holiday Rentals</h2>
                    <p class="tp-zigzag-desc">From luxury 5-star beachfront resorts in Penang to cozy boutique stays in KL, discover thousands of accommodations with real-time prices.</p>
                    <a href="/TravelPal/hotels/index.php" class="tp-action-btn">Explore Hotels</a>
                </div>
                <div class="tp-strict-slider zigzag-slider" data-interval="5000">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80" class="slide active">
                    <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?w=800&q=80" class="slide">
                </div>
            </div>

            <div class="tp-zigzag-row">
                <div class="tp-zigzag-text">
                    <span class="tp-zigzag-kicker">Culinary Journeys</span>
                    <h2 class="tp-zigzag-title">Restaurants & Local Food</h2>
                    <p class="tp-zigzag-desc">Savor the best local delicacies and fine dining. Discover top-rated eateries, street food guides, and cozy cafes recommended by locals.</p>
                    <a href="/TravelPal/restaurants/index.php" class="tp-action-btn">Find Restaurants</a>
                </div>
                <div class="tp-strict-slider zigzag-slider" data-interval="5000">
                    <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=800&q=80" class="slide active">
                    <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800&q=80" class="slide">
                </div>
            </div>
            
            <div class="tp-zigzag-row">
                <div class="tp-zigzag-text">
                    <span class="tp-zigzag-kicker">Unforgettable Experiences</span>
                    <h2 class="tp-zigzag-title">Attractions & Activities</h2>
                    <p class="tp-zigzag-desc">Immerse yourself in culture, nature, and adventure. Book tickets to iconic landmarks, theme parks, and hidden nature trails across Malaysia.</p>
                    <a href="/TravelPal/attractions/index.php" class="tp-action-btn">Discover Attractions</a>
                </div>
                <div class="tp-strict-slider zigzag-slider" data-interval="5000">
                    <img src="https://images.unsplash.com/photo-1596422846543-75c6fc197f07?w=800&q=80" class="slide active">
                    <img src="https://images.unsplash.com/photo-1589308078059-be1415eab4c3?w=800&q=80" class="slide">
                </div>
            </div>
        </div>

        <div class="tp-about-section">
            <div class="tp-about-text">
                <span class="tp-about-kicker">Our Story</span>
                <h2 class="tp-about-title">Connecting You to the Heart of Malaysia</h2>
                <p class="tp-about-desc">Founded with a simple mission: to make exploring Malaysia seamless, authentic, and unforgettable. TravelPal started as a vision to bring together the best flights, accommodations, and hidden local gems into one smart platform.</p>
                <p class="tp-about-desc">As a proudly local tech company, we combine cutting-edge technology with deep local knowledge to ensure every journey you take is perfectly crafted. From the bustling streets of Kuala Lumpur to the pristine beaches of Sabah, we are your ultimate travel companion.</p>
                
                <div class="tp-about-stats">
                    <div class="stat-box">
                        <h4>100%</h4><span>Locally Founded</span>
                    </div>
                    <div class="stat-box">
                        <h4>8</h4><span>States Covered</span>
                    </div>
                    <div class="stat-box">
                        <h4>24/7</h4><span>Travel Support</span>
                    </div>
                </div>
            </div>
            <div class="tp-about-img">
                <img src="https://images.unsplash.com/photo-1596422846543-75c6fc197f07?w=800&q=80" alt="About TravelPal">
            </div>
        </div>

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

        <div class="tp-video-section">
            <div class="tp-video-text">
                <span>The Escape Awaits</span>
                <h2>One Tap to Your Dream Getaway</h2>
                <p>From the dull daily grind to pristine beaches and cool misty highlands. Watch how TravelPal transforms your travel dreams into reality instantly.</p>
                <a href="#" onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;">
                    Start Planning <i class="fa-solid fa-arrow-up"></i>
                </a>
            </div>
            <div class="tp-video-wrapper">
                <video controls playsinline>
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