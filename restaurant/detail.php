<?php 
// 引入位于 travelPal 主目录下的头部文件
include '../header.php'; 
?>

<!-- 引入独立的餐厅详情 CSS 文件和图标库 -->
<link rel="stylesheet" href="/TravelPal/restaurant/restaurant_detail.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<main class="detail-container">
    
    <!-- 1. 顶部标题与操作栏 -->
    <div class="detail-header">
        <div class="title-area">
            <div class="detail-title">
                <h1>Madam Kwan's</h1>
            </div>
            <div class="detail-rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <span>4.8</span>
                <span class="review-count">(1,245 Reviews)</span>
                <span style="color:#d1d5db;">|</span>
                <span style="color:#6b7280; font-weight:normal; font-size:0.95rem;">Malaysian, Asian, Halal</span>
            </div>
        </div>
        <div class="action-btns">
            <button class="btn"><i class="far fa-star"></i> Save</button>
            <button class="btn"><i class="fas fa-share-alt"></i> Share</button>
            <button class="btn btn-primary"><i class="fas fa-pen"></i> Write a Review</button>
        </div>
    </div>

    <!-- 2. 相册展示 (3+1 布局) -->
    <div class="gallery-grid">
        <img src="https://images.unsplash.com/photo-1559314809-0d155014e29e?w=1000&q=80" class="gallery-item main-img" alt="Main Dish">
        <img src="https://images.unsplash.com/photo-1627067828062-8e108d8e1247?w=400&q=80" class="gallery-item" alt="Interior">
        <img src="https://images.unsplash.com/photo-1564834724105-918b73d1b9e0?w=400&q=80" class="gallery-item" alt="Food">
        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=400&q=80" class="gallery-item" alt="Drinks">
    </div>

    <!-- 3. 主体内容左右分栏 -->
    <div class="content-layout">
        
        <!-- 左侧：主要信息 (描述、菜单、评论) -->
        <div class="main-content">
            
            <!-- 关于餐厅 -->
            <div class="info-card">
                <h2>About the Restaurant</h2>
                <p style="color: #4b5563; line-height: 1.7;">
                    Experience the true taste of Malaysia at Madam Kwan's. Known for combining recipes from different cultures across the country, this iconic restaurant offers a cozy ambiance and unforgettable flavors. From their signature Nasi Lemak to the rich Beef Rendang, every dish is prepared with passion and authentic ingredients.
                </p>
            </div>

            <!-- 菜单展示 -->
            <div class="info-card">
                <h2>Signature Menu</h2>
                <div class="menu-list">
                    <div class="menu-item">
                        <div>
                            <div class="menu-name">Madam Kwan's Nasi Lemak</div>
                            <div class="menu-desc">Coconut rice served with chicken curry, dried shrimp floss, and sambal.</div>
                        </div>
                        <div class="menu-price">RM 28.90</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <div class="menu-name">Malaysian Curry Laksa</div>
                            <div class="menu-desc">Noodles in spicy coconut curry broth with chicken and prawns.</div>
                        </div>
                        <div class="menu-price">RM 24.50</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <div class="menu-name">Beef Rendang</div>
                            <div class="menu-desc">Slow-cooked beef in rich coconut milk and traditional spices.</div>
                        </div>
                        <div class="menu-price">RM 32.00</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <div class="menu-name">Cendol</div>
                            <div class="menu-desc">Traditional shaved ice dessert with pandan jelly and palm sugar.</div>
                        </div>
                        <div class="menu-price">RM 12.50</div>
                    </div>
                </div>
            </div>

            <!-- 评论区 (含照片) -->
            <div class="info-card">
                <h2>Traveler Reviews</h2>
                
                <!-- 评论 1 -->
                <div class="review-item">
                    <div class="reviewer-info">
                        <div class="reviewer-avatar" style="background:#3b82f6;">J</div>
                        <div>
                            <span class="reviewer-name">Jason Lee</span>
                            <span class="review-date">Reviewed 2 weeks ago</span>
                        </div>
                        <div style="margin-left: auto; color: #f59e0b; font-size: 0.9rem;">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div class="review-text">
                        Absolutely amazing Nasi Lemak! The chicken curry was tender and the sambal had the perfect kick. The restaurant was quite busy during lunch hours, but the service was incredibly fast and friendly. Highly recommend booking in advance.
                    </div>
                    <div class="review-photos">
                        <img src="https://images.unsplash.com/photo-1559314809-0d155014e29e?w=200&q=80" alt="Review Photo">
                        <img src="https://images.unsplash.com/photo-1564834724105-918b73d1b9e0?w=200&q=80" alt="Review Photo">
                    </div>
                </div>

                <!-- 评论 2 -->
                <div class="review-item" style="border-bottom: none; margin-bottom: 0; padding-bottom: 0;">
                    <div class="reviewer-info">
                        <div class="reviewer-avatar" style="background:#ec4899;">S</div>
                        <div>
                            <span class="reviewer-name">Sarah Wilson</span>
                            <span class="review-date">Reviewed 1 month ago</span>
                        </div>
                        <div style="margin-left: auto; color: #f59e0b; font-size: 0.9rem;">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                        </div>
                    </div>
                    <div class="review-text">
                        Great ambiance and very authentic flavors. The Beef Rendang melted in my mouth. A bit on the pricey side for local food, but the hygiene, environment, and quality completely justify it. Will definitely come back.
                    </div>
                </div>
                
            </div>
        </div>

        <!-- 右侧：侧边栏信息 (地址、联系方式、时间) -->
        <div class="sidebar">
            <div class="info-card">
                <h2>Contact & Location</h2>
                
                <div class="sidebar-item">
                    <i class="fas fa-map-marker-alt" style="color: #ef4444;"></i>
                    <div>
                        <strong>Address</strong>
                        <p>Suria KLCC, Lot 420, 4th Floor,<br>Kuala Lumpur City Centre,<br>50088 Kuala Lumpur, Malaysia</p>
                    </div>
                </div>
                
                <div class="sidebar-item">
                    <i class="fas fa-phone-alt" style="color: #3b82f6;"></i>
                    <div>
                        <strong>Phone Number</strong>
                        <p>+60 3-2026 2297</p>
                    </div>
                </div>

                <div class="sidebar-item">
                    <i class="fas fa-globe" style="color: #10b981;"></i>
                    <div>
                        <strong>Website</strong>
                        <p><a href="#" style="color: #2563eb; text-decoration: none;">www.madamkwans.com.my</a></p>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <h2>Operating Hours</h2>
                <div class="sidebar-item">
                    <i class="far fa-clock" style="color: #f59e0b;"></i>
                    <div style="width: 100%;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span>Monday</span> <span>11:00 AM - 10:00 PM</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span>Tuesday</span> <span>11:00 AM - 10:00 PM</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span>Wednesday</span> <span>11:00 AM - 10:00 PM</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span>Thursday</span> <span>11:00 AM - 10:00 PM</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-weight: bold; color: #111827;">
                            <span>Friday (Today)</span> <span>11:00 AM - 10:30 PM</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span>Saturday</span> <span>11:00 AM - 10:30 PM</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span>Sunday</span> <span>11:00 AM - 10:00 PM</span>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #e5e7eb; color: #10b981; font-weight: bold; text-align: center;">
                    <i class="fas fa-circle" style="font-size: 0.6rem; vertical-align: middle; margin-right: 5px;"></i> Open Now
                </div>
            </div>
        </div>

    </div>
</main>

<?php 
// 引入位于 travelPal 主目录下的底部文件
include '../footer.php'; 
?>