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
    .detail-container { max-width: 1140px; margin: 30px auto 80px; padding: 0 20px; }
    .detail-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px; }
    
    .detail-title { font-size: 1.8rem; font-weight: 800; color: #0f172a; text-decoration: underline; }
    .detail-subtitle { color: #64748b; font-size: 0.95rem; margin-top: 4px; }
    
    .photo-gallery { 
        display: grid; 
        grid-template-columns: 2fr 1fr; 
        gap: 12px; 
        height: 420px; 
        border-radius: 16px; 
        overflow: hidden; 
        margin-bottom: 30px; 
    }
    .gallery-main { 
        width: 100%; 
        height: 100%; 
        object-fit: cover; 
        display: block; 
    }
    .gallery-sub-grid { 
        display: grid; 
        grid-template-rows: repeat(2, calc(50% - 6px));
        gap: 12px; 
        height: 100%; 
    }
    .sub-img-box { 
        position: relative; 
        width: 100%; 
        height: 100%; 
        overflow: hidden; 
        border-radius: 8px; 
    }
    .sub-img-box img { 
        width: 100%; 
        height: 100%; 
        object-fit: cover; 
        display: block; 
    }
    .img-tag { 
        position: absolute; 
        bottom: 10px; 
        left: 10px; 
        background: rgba(0, 0, 0, 0.65); 
        color: #fff; 
        font-size: 0.75rem; 
        padding: 4px 8px; 
        border-radius: 4px; 
        backdrop-filter: blur(4px); 
    }

    .detail-layout { display: grid; grid-template-columns: 2fr 1fr; gap: 30px; }
    .info-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; margin-bottom: 24px; }
    .amenity-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-top: 16px; }
    .amenity-item { display: flex; align-items: center; gap: 10px; color: #334155; font-size: 0.9rem; }
    .amenity-item i { color: #047857; font-size: 1.1rem; }

    .booking-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.06); position: sticky; top: 20px; }
    .booking-price { font-size: 2rem; font-weight: 800; color: #0f172a; }
    .btn-book-now { width: 100%; background: #047857; color: #fff; border: none; padding: 16px; border-radius: 10px; font-size: 1.1rem; font-weight: 700; cursor: pointer; transition: background 0.2s, transform 0.1s; margin-top: 20px; }
    .btn-book-now:hover { background: #065f46; transform: translateY(-2px); }
    
    .btn-fav-detail { background: #f1f5f9; border: 1px solid #cbd5e1; border-radius: 8px; padding: 8px 14px; cursor: pointer; display: flex; align-items: center; gap: 6px; font-weight: 600; color: #475569; transition: all 0.2s; }
    .btn-fav-detail.active { background: #fef9c3; border-color: #fde047; color: #854d0e; }
    .btn-fav-detail.active i { color: #eab308; }

    /* 🆕 新增提示消息样式 */
    #loginMsg {
        color: #dc2626;
        font-weight: 600;
        text-align: center;
        margin-bottom: 10px;
        padding: 8px;
        background: #fee2e2;
        border-radius: 6px;
        border: 1px solid #fca5a5;
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
        <button class="btn-fav-detail" id="btnFavDetail" onclick="toggleDetailFav(this)">
            <i class="fa-solid fa-star"></i> <span>Save to Favorites</span>
        </button>
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

                    <!-- 🆕 提示消息显示区 -->
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
        event.preventDefault(); // 阻止表单提交

        // 显示提示消息
        const msg = document.getElementById('loginMsg');
        msg.style.display = 'block';

        // 可选：5秒后自动隐藏（但要考虑用户可能再点，所以可以不自动隐藏，或者点击后一直显示）
        // 如果想自动消失，可以取消注释下面几行
        // setTimeout(() => {
        //     msg.style.display = 'none';
        // }, 5000);

        return false;
    }
    return true; // 允许提交
}

function toggleDetailFav(btn) {
    if (!isLoggedIn) {
        alert("must be login first");
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