<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'header.php'; 
?>

<!-- 这里已经改成了 time()，绝对不会再有缓存问题！ -->
<link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<main>
    <!-- 1. 四个带有【智能实时数据】的分类方格 -->
    <section class="home-grid-section">
        <div class="grid-section-header">
            <h2>Explore TravelPal by Category</h2>
            <p>Your complete guide to traveling across Malaysia</p>
        </div>
        
       <div class="home-interest-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
            <?php 
            // 业务卡片数据
            $smartData = [
                'flights' => [
                    'icon' => 'fa-plane',
                    'title' => 'Flights', 'desc' => 'Domestic & International', 
                    'label' => 'Lowest Fares From', 'val' => 'RM 89', 'trend' => 92,
                    'link' => '/TravelPal/flights/index.php'
                ],
                'hotels' => [
                    'icon' => 'fa-hotel',
                    'title' => 'Hotels', 'desc' => 'Resorts & City Stays', 
                    'label' => 'Properties Available', 'val' => '120+', 'trend' => 85,
                    'link' => '/TravelPal/hotels/index.php'
                ],
                'restaurants' => [
                    'icon' => 'fa-utensils',
                    'title' => 'Restaurants', 'desc' => 'Local Delicacies', 
                    'label' => 'Top Rated Spots', 'val' => '4.8★', 'trend' => 88,
                    'link' => '/TravelPal/restaurant/index.php'
                ]
            ];

            // 1. 渲染前三个业务卡片
            foreach ($smartData as $key => $data): ?>
            <!-- 统一设置：圆角 12px, 阴影更柔和, 高度 200px 增加呼吸感 -->
            <a href="<?php echo $data['link']; ?>" style="text-decoration: none; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 12px; padding: 24px; display: flex; flex-direction: column; justify-content: space-between; height: 200px; box-shadow: 0 4px 12px rgba(0,0,0,0.04); transition: transform 0.2s ease, box-shadow 0.2s ease;">
                
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

                <div style="display: flex; align-items: center; gap: 8px; margin-top: auto; padding-top: 14px; border-top: 1px solid #f3f4f6;">
                    <div style="width: 14px; height: 14px; border-radius: 50%; background: conic-gradient(#047857 calc(<?php echo $data['trend']; ?> * 1%), #e5e7eb 0); display: flex; align-items: center; justify-content: center;">
                        <div style="width: 8px; height: 8px; border-radius: 50%; background: #ffffff;"></div>
                    </div>
                    <span style="font-size: 12px; font-weight: 700; color: #4b5563;">Trending: <?php echo $data['trend']; ?>%</span>
                </div>
            </a>
            <?php endforeach; ?>

            <!-- 2. 第四个会员卡片 (尺寸、圆角与前面的完全一致) -->
            <a href="/TravelPal/auth/login.php" style="text-decoration: none; background: #047857; border-radius: 12px; padding: 24px; display: flex; flex-direction: column; justify-content: space-between; height: 200px; box-shadow: 0 6px 16px rgba(4,120,87,0.25); transition: transform 0.2s ease;">
                
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
            
        </div>

    <!-- 2. 四个左右交替的自动轮播模块 -->
    <div class="home-zigzag-container">
        <!-- Flights -->
        <section class="zigzag-row-flat">
            <div class="zigzag-content">
                <span class="zigzag-tag">Explore The Skies</span>
                <h2>Flights to Top Destinations</h2>
                <p>Compare and book cheap flights across Malaysia. Find the best airlines and lowest fares for your next getaway.</p>
                <a href="/TravelPal/flights/index.php" class="zigzag-btn">Search Flights</a>
            </div>
            <div class="zigzag-slider" data-interval="5000">
                <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=800&q=80" class="slide active">
                <img src="https://images.unsplash.com/photo-1544644181-1484b3fdfc62?w=800&q=80" class="slide">
            </div>
        </section>

        <!-- Hotels -->
        <section class="zigzag-row-flat">
            <div class="zigzag-slider" data-interval="5000">
                <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80" class="slide active">
                <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?w=800&q=80" class="slide">
            </div>
            <div class="zigzag-content">
                <span class="zigzag-tag">Comfortable Stays</span>
                <h2>Hotels & Holiday Rentals</h2>
                <p>From luxury 5-star beachfront resorts in Penang to cozy boutique stays in KL, discover thousands of accommodations with real-time prices.</p>
                <a href="/TravelPal/hotels/index.php" class="zigzag-btn">Explore Hotels</a>
            </div>
        </section>

        <!-- Restaurants -->
        <section class="zigzag-row-flat">
            <div class="zigzag-content">
                <span class="zigzag-tag">Culinary Journeys</span>
                <h2>Restaurants & Local Food</h2>
                <p>Savor the best local delicacies and fine dining. Discover top-rated eateries, street food guides, and cozy cafes recommended by locals.</p>
                <a href="/TravelPal/restaurants/index.php" class="zigzag-btn">Find Restaurants</a>
            </div>
            <div class="zigzag-slider" data-interval="5000">
                <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=800&q=80" class="slide active">
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800&q=80" class="slide">
            </div>
        </section>

        <!-- Attractions -->
        <section class="zigzag-row-flat">
            <div class="zigzag-slider" data-interval="5000">
                <img src="https://images.unsplash.com/photo-1596422846543-75c6fc197f07?w=800&q=80" class="slide active">
                <img src="https://images.unsplash.com/photo-1589308078059-be1415eab4c3?w=800&q=80" class="slide">
            </div>
            <div class="zigzag-content">
                <span class="zigzag-tag">Unforgettable Experiences</span>
                <h2>Attractions & Activities</h2>
                <p>Immerse yourself in culture, nature, and adventure. Book tickets to iconic landmarks, theme parks, and hidden nature trails across Malaysia.</p>
                <a href="/TravelPal/attractions/index.php" class="zigzag-btn">Discover Attractions</a>
            </div>
        </section>
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