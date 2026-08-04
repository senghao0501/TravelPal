<?php include '../header.php'; ?>

<!-- 引入酒店模块专属 CSS -->
<link rel="stylesheet" href="/TravelPal/css/modules/hotels.css">

<div class="hotels-container">
    <!-- 1. 顶部标题与评分 -->
    <div class="hotel-details-header">
        <div>
            <h1 style="font-size: 2.2rem; font-weight: 800; color: #1e293b;">Grand Hyatt Kuala Lumpur</h1>
            <p style="color: #64748b; margin-top: 0.4rem;">📍 12 Jalan Pinang, Kuala Lumpur City Centre, 50450 Malaysia</p>
        </div>
        <div>
            <span class="rating-badge" style="font-size: 1rem; padding: 0.4rem 0.8rem;">★ 4.8 / 5.0 Exceptional</span>
        </div>
    </div>

    <!-- 2. 图片展示画廊 -->
    <div class="hotel-gallery">
        <div class="gallery-main">
            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1000&q=80" alt="Grand Hyatt Main View">
        </div>
        <div class="gallery-thumbs">
            <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=500&q=80" alt="Room Interior">
            <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=500&q=80" alt="Pool View">
        </div>
    </div>

    <!-- 3. 主体布局：左侧详情 + 右侧预订卡片 -->
    <div class="hotel-details-layout">
        <!-- 左侧：酒店信息说明 -->
        <div class="hotel-info-section">
            <h3>About this hotel</h3>
            <p class="hotel-description">
                Overlooking the iconic Petronas Twin Towers, Grand Hyatt Kuala Lumpur offers luxury accommodations featuring floor-to-ceiling windows, an outdoor swimming pool, and round-the-clock fitness facility. Located within walking distance from Kuala Lumpur Convention Centre (KLCC) and Pavilion Shopping Mall.
            </p>

            <h3>Popular Amenities</h3>
            <div class="amenities-list">
                <div class="amenity-item">🏊 Free Swimming Pool</div>
                <div class="amenity-item">📶 High-Speed Wi-Fi</div>
                <div class="amenity-item">🍸 Rooftop Bar & Lounge</div>
                <div class="amenity-item">🏋️ 24/7 Gym Center</div>
                <div class="amenity-item">🍳 Breakfast Included</div>
                <div class="amenity-item">🅿️ Free Parking</div>
            </div>

            <h3>Location Highlights</h3>
            <p class="hotel-description" style="margin-top: 0.5rem;">
                • 5 mins walk to Suria KLCC & Petronas Twin Towers<br>
                • 10 mins walk to Pavilion Shopping District<br>
                • 45 mins drive from Kuala Lumpur International Airport (KLIA)
            </p>
        </div>

        <!-- 右侧：预订与价格面板 -->
        <div class="booking-container">
            <div class="booking-card">
                <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 1.2rem;">
                    <div>
                        <span class="price-tag" style="font-size: 1.8rem;">$180</span>
                        <span class="price-unit">/ night</span>
                    </div>
                    <span style="color: #64748b; font-size: 0.85rem;">Taxes included</span>
                </div>

                <!-- 模拟日期与人数表单 -->
                <div style="display: flex; flex-direction: column; gap: 0.8rem;">
                    <div>
                        <label style="font-size: 0.85rem; font-weight: 600; color: #64748b;">Check-in / Check-out</label>
                        <input type="text" value="2026-08-10 to 2026-08-12" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem; margin-top: 0.2rem;" readonly>
                    </div>
                    <div>
                        <label style="font-size: 0.85rem; font-weight: 600; color: #64748b;">Guests & Rooms</label>
                        <input type="text" value="2 Adults, 1 Room" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem; margin-top: 0.2rem;" readonly>
                    </div>
                </div>

                <a href="/TravelPal/auth/login.php" style="text-decoration: none;">
                    <button class="btn-book-now">Reserve Now</button>
                </a>
                <p style="text-align: center; font-size: 0.8rem; color: #94a3b8; margin-top: 0.8rem;">You won't be charged yet</p>
            </div>
        </div>
    </div>
</div>

<?php include '../footer.php'; ?>