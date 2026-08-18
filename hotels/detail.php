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

            <!-- 评论区域（已精简：移除房型与出行方式副标题） -->
            <div class="info-card" style="margin-top: 24px;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                    <h3 style="font-size: 1.2rem; color: #0f172a; display: flex; align-items: center; gap: 8px; margin: 0;">
                        <i class="fa-solid fa-comments text-emerald-600"></i> Guest Reviews 
                        <span style="font-size: 0.9rem; font-weight: normal; color: #64748b;">(<?php echo !empty($hotel['reviews']) ? count($hotel['reviews']) : 0; ?>)</span>
                    </h3>
                    <div style="background: #f0fdf4; border: 1px solid #bbf7d0; padding: 4px 10px; border-radius: 8px; font-size: 0.85rem; font-weight: 600; color: #166534;">
                        Rating: <?php echo $hotel['rating']; ?> / 10
                    </div>
                </div>

                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <?php if (!empty($hotel['reviews'])): ?>
                        <?php foreach ($hotel['reviews'] as $index => $review): ?>
                            <?php 
                                // 🎨 预定义一组好看且互不相同的头像背景与文字配色
                                $avatar_colors = [
                                    ['bg' => '#d1fae5', 'text' => '#065f46'], // 绿
                                    ['bg' => '#dbeafe', 'text' => '#1e40af'], // 蓝
                                    ['bg' => '#fee2e2', 'text' => '#991b1b'], // 红
                                    ['bg' => '#f3e8ff', 'text' => '#6b21a8'], // 紫
                                    ['bg' => '#ffedd5', 'text' => '#9a3412'], // 橙
                                    ['bg' => '#fce7f3', 'text' => '#831843'], // 粉
                                ];
                                $color_index = abs(crc32($review['user'])) % count($avatar_colors);
                                $chosen_color = $avatar_colors[$color_index];
                            ?>
                            <!-- 🌟 默认第 6 条及以后的评论加入 review-hidden 并隐藏 -->
                            <div class="review-row <?php echo $index >= 5 ? 'review-hidden' : ''; ?>" style="<?php echo $index >= 5 ? 'display: none;' : ''; ?> padding-bottom: 16px; border-bottom: 1px solid #f1f5f9;">
                                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div style="width: 38px; height: 38px; border-radius: 50%; background: <?php echo $chosen_color['bg']; ?>; color: <?php echo $chosen_color['text']; ?>; font-weight: bold; display: flex; align-items: center; justify-content: center; font-size: 0.85rem;">
                                            <?php 
                                                $initials = isset($review['avatar_initials']) ? $review['avatar_initials'] : strtoupper(substr($review['user'], 0, 1));
                                                echo htmlspecialchars($initials); 
                                            ?>
                                        </div>
                                        <div>
                                            <h4 style="font-size: 0.9rem; font-weight: 600; color: #0f172a; margin: 0;">
                                                <?php echo htmlspecialchars($review['user']); ?> 
                                                <span style="font-size: 0.75rem; color: #94a3b8; font-weight: normal; margin-left: 4px;"><?php echo htmlspecialchars($review['country'] ?? 'MY'); ?></span>
                                            </h4>
                                        </div>
                                    </div>
                                    <div style="text-align: right;">
                                        <span style="background: #047857; color: white; font-size: 0.75rem; font-weight: bold; padding: 2px 6px; border-radius: 4px;"><?php echo $review['rating']; ?> / 10</span>
                                        <p style="font-size: 0.7rem; color: #94a3b8; margin: 4px 0 0 0;"><?php echo date('d M Y', strtotime($review['date'])); ?></p>
                                    </div>
                                </div>
                                <p style="font-size: 0.85rem; color: #475569; margin-top: 10px; line-height: 1.5;">
                                    <?php echo htmlspecialchars($review['comment']); ?>
                                </p>
                            </div>
                        <?php endforeach; ?>

                        <!-- 🌟 View More 按钮（当评论数大于 5 时显示） -->
                        <?php if (count($hotel['reviews']) > 5): ?>
                            <div style="text-align: center; margin-top: 10px;">
                                <button type="button" id="viewMoreReviewsBtn" data-expanded="false" onclick="toggleReviews()" style="background: #f8fafc; border: 1px solid #cbd5e1; color: #334155; padding: 10px 20px; border-radius: 8px; font-size: 0.85rem; font-weight: 600; cursor: pointer; transition: all 0.2s;">
                                    View More Reviews (<?php echo count($hotel['reviews']) - 5; ?>) <i class="fa-solid fa-chevron-down" style="margin-left: 4px; font-size: 0.75rem;"></i>
                                </button>
                            </div>
                        <?php endif; ?>

                    <?php else: ?>
                        <p style="color: #64748b; text-align: center; padding: 20px;">No reviews available yet.</p>
                    <?php endif; ?>
                </div>
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
        const msg = document.getElementById('favLoginMsg');
        msg.style.display = 'block';
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

// 🌟 评论展开/折叠控制函数
function toggleReviews() {
    const hiddenReviews = document.querySelectorAll('.review-hidden');
    const btn = document.getElementById('viewMoreReviewsBtn');
    
    const isExpanded = btn.getAttribute('data-expanded') === 'true';

    if (!isExpanded) {
        hiddenReviews.forEach(el => el.style.display = 'block');
        btn.innerHTML = 'Show Less <i class="fa-solid fa-chevron-up" style="margin-left: 4px; font-size: 0.75rem;"></i>';
        btn.setAttribute('data-expanded', 'true');
    } else {
        hiddenReviews.forEach(el => el.style.display = 'none');
        btn.innerHTML = `View More Reviews (${hiddenReviews.length}) <i class="fa-solid fa-chevron-down" style="margin-left: 4px; font-size: 0.75rem;"></i>`;
        btn.setAttribute('data-expanded', 'false');
        btn.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
}
</script>