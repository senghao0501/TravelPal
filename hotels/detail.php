<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../header.php';
require_once 'hotels_data.php';

// 检测用户登录状态
$isLoggedIn = isset($_SESSION['user_id']) || isset($_SESSION['user']) || isset($_SESSION['user_name']);

$hotel_id = $_GET['id'] ?? 101;
$check_in = $_GET['check_in'] ?? date('Y-m-d');
$check_out= $_GET['check_out'] ?? date('Y-m-d', strtotime('+1 day'));
$adults   = $_GET['adults'] ?? 2;

// 在数据库中查找对应 ID 的酒店
$hotel = null;
foreach ($all_hotels as $h) {
    if ($h['id'] == $hotel_id) {
        $hotel = $h;
        break;
    }
}

// 没找到默认载入第一个
if (!$hotel) $hotel = $all_hotels[0];
?>

<link rel="stylesheet" href="../css/modules/hotels.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* 🆕 登录提示样式（在按钮上方显示） */
    #favLoginMsg {
        color: #dc2626;
        font-weight: 600;
        font-size: 0.85rem;
        text-align: center;
        margin-top: 8px;
        display: none;
    }
</style>

<main class="detail-container">
    <!-- 头部标题与收藏 -->
    <div class="detail-header">
        <div>
            <h1 class="detail-title"><?php echo htmlspecialchars($hotel['name']); ?></h1>
            <p class="detail-subtitle"><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($hotel['city']); ?>, <?php echo htmlspecialchars($hotel['state']); ?>, Malaysia</p>
        </div>
        <div style="display: flex; flex-direction: column; align-items: flex-end;">
            <button class="btn-fav-detail" id="btnFavDetail" onclick="toggleDetailFav(this)">
                <i class="fa-solid fa-star"></i> <span>Save to Favorites</span>
            </button>
            <!-- 🆕 提示消息 -->
            <div id="favLoginMsg">⚠️ Please login first</div>
        </div>
    </div>

    <!-- 三图组合相册 -->
    <div class="photo-gallery">
        <img class="gallery-main" src="<?php echo $hotel['img_main']; ?>" alt="Hotel Exterior">
        <div class="gallery-sub-grid">
            <div class="sub-img-box">
                <img src="<?php echo $hotel['img_lobby']; ?>" alt="Hotel Lobby">
                <span class="img-tag"><i class="fa-solid fa-building"></i> Lobby & Lounge</span>
            </div>
            <div class="sub-img-box">
                <img src="<?php echo $hotel['img_bathroom']; ?>" alt="Bathroom View">
                <span class="img-tag"><i class="fa-solid fa-bath"></i> Bathroom & Amenities</span>
            </div>
        </div>
    </div>

    <!-- 内容与预订侧边栏 -->
    <div class="detail-layout">
        <!-- 左侧信息区 -->
        <div>
            <div class="info-card">
                <h3 style="font-size: 1.2rem; margin-bottom: 12px; color: #0f172a; text-decoration: underline;">About the Accommodation</h3>
                <p style="color: #475569; line-height: 1.6;"><?php echo htmlspecialchars($hotel['desc']); ?> Designed with modern comforts and premium hospitality to ensure a memorable staycation experience in <?php echo htmlspecialchars($hotel['state']); ?>.</p>
            </div>

            <div class="info-card">
                <h3 style="font-size: 1.2rem; margin-bottom: 16px; color: #0f172a; text-decoration: underline;">Popular Amenities</h3>
                <div class="amenity-grid">
                    <div class="amenity-item"><i class="fa-solid fa-wifi"></i> Free High-speed Wi-Fi</div>
                    <div class="amenity-item"><i class="fa-solid fa-water-ladder"></i> Swimming Pool</div>
                    <div class="amenity-item"><i class="fa-solid fa-utensils"></i> On-site Restaurant</div>
                    <div class="amenity-item"><i class="fa-solid fa-square-parking"></i> Free Parking</div>
                    <div class="amenity-item"><i class="fa-solid fa-snowflake"></i> Air Conditioning</div>
                    <div class="amenity-item"><i class="fa-solid fa-dumbbell"></i> Fitness Center</div>
                </div>
            </div>

            <!-- 评论区域 -->
            <div class="reviews-section">
                <h3>
                    <i class="fa-solid fa-comments"></i> Guest Reviews
                    <span class="review-count">(<?php echo count($hotel['reviews']); ?> reviews)</span>
                </h3>

                <?php if (!empty($hotel['reviews'])): ?>
                    <?php foreach ($hotel['reviews'] as $review): ?>
                        <div class="review-item">
                            <div class="review-header">
                                <div>
                                    <span class="review-user"><?php echo htmlspecialchars($review['user']); ?></span>
                                    <span class="review-date">
                                        <i class="fa-regular fa-calendar"></i> <?php echo date('d M Y', strtotime($review['date'])); ?>
                                    </span>
                                </div>
                                <span class="review-rating"><?php echo $review['rating']; ?> / 10</span>
                            </div>
                            <p class="review-comment"><?php echo htmlspecialchars($review['comment']); ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="no-reviews">No reviews yet for this property.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- 右侧预订区 -->
        <div>
            <div class="booking-card">
                <div style="display: flex; justify-content: space-between; align-items: baseline;">
                    <div>
                        <small style="color: #64748b;">Starting from</small>
                        <div class="booking-price">RM <?php echo $hotel['price']; ?> <span style="font-size: 0.9rem; font-weight: normal; color: #64748b;">/ night</span></div>
                    </div>
                    <span style="background: #e0f2fe; color: #0369a1; padding: 4px 8px; border-radius: 6px; font-weight: 700; font-size: 0.85rem;"><?php echo $hotel['rating']; ?> / 10</span>
                </div>

                <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 18px 0;">

                <form action="checkout.php" method="GET" onsubmit="return handleBooking(event)">
                    <input type="hidden" name="hotel_id" value="<?php echo $hotel['id']; ?>">
                    <div style="margin-bottom: 12px;">
                        <label style="font-size: 0.8rem; font-weight: 600; color: #475569;">Check-in Date</label>
                        <input type="date" name="check_in" value="<?php echo htmlspecialchars($check_in); ?>" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; margin-top: 4px;">
                    </div>
                    <div style="margin-bottom: 12px;">
                        <label style="font-size: 0.8rem; font-weight: 600; color: #475569;">Check-out Date</label>
                        <input type="date" name="check_out" value="<?php echo htmlspecialchars($check_out); ?>" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; margin-top: 4px;">
                    </div>

                    <div id="loginMsg">⚠️ Please login first</div>

                    <button type="submit" class="btn-book-now">
                        <i class="fa-solid fa-bolt"></i> Book Now
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
const isLoggedIn = <?php echo $isLoggedIn ? 'true' : 'false'; ?>;

function handleBooking(event) {
    if (!isLoggedIn) {
        event.preventDefault();
        const msg = document.getElementById('loginMsg');
        msg.style.display = 'block';
        return false;
    }
    return true;
}

function toggleDetailFav(btn) {
    if (!isLoggedIn) {
        // 🆕 在按钮下方显示 "Please login first" 提示
        const msg = document.getElementById('favLoginMsg');
        msg.style.display = 'block';
        
        // 3秒后自动隐藏
        setTimeout(() => {
            msg.style.display = 'none';
        }, 3000);
        return;
    }
    
    btn.classList.toggle('active');
    const label = btn.querySelector('span');
    if(btn.classList.contains('active')) {
        label.innerText = 'Saved to Favorites';
    } else {
        label.innerText = 'Save to Favorites';
    }
}
</script>