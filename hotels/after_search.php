<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../header.php';
require_once 'hotels_data.php';

// 1. 检测用户登录状态
$isLoggedIn = isset($_SESSION['user_id']) || isset($_SESSION['user']) || isset($_SESSION['user_name']);

// 2. 获取 URL 参数
$query    = $_GET['query'] ?? '';
$type     = $_GET['type'] ?? '';
$vibe     = $_GET['vibe'] ?? '';
$check_in = $_GET['check_in'] ?? date('Y-m-d');
$check_out= $_GET['check_out'] ?? date('Y-m-d', strtotime('+1 day'));
$adults   = (int)($_GET['adults'] ?? 2);
$children = (int)($_GET['children'] ?? 0);
$rooms    = (int)($_GET['rooms'] ?? 1);

// 3. 筛选酒店
$filtered_hotels = array_filter($all_hotels, function($h) use ($query, $type, $vibe) {
    if (!empty($query) && strcasecmp($h['state'], $query) === 0) return true;
    if (!empty($type) && strcasecmp($h['type'], $type) === 0) return true;
    if (!empty($vibe) && strcasecmp($h['vibe'], $vibe) === 0) return true;
    return empty($query) && empty($type) && empty($vibe);
});

if (empty($filtered_hotels)) {
    $filtered_hotels = array_filter($all_hotels, fn($h) => $h['state'] === 'Penang');
}

$page_title = !empty($query) ? $query : (!empty($type) ? $type : (!empty($vibe) ? $vibe : 'Penang'));

// 初始化人数 Summary 格式
$guest_summary_initial = "$adults Adults" . ($children > 0 ? ", $children Children" : "") . ", $rooms Room";
?>

<link rel="stylesheet" href="../css/modules/hotels.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* 顶部 Search Bar 基础 */
    .search-hero-wrapper {
        background: linear-gradient(135deg, #064e3b 0%, #0f172a 100%);
        padding: 35px 20px 45px 20px;
    }
    
    .results-container { 
        max-width: 1140px; 
        margin: 30px auto 60px; 
        padding: 0 20px; 
    }

    .hotel-list { 
        display: flex; 
        flex-direction: column; 
        gap: 24px; 
    }

    /* 🌟 解决加减失效的核心 CSS 修复 */
    .input-group {
        position: relative;
        overflow: visible !important; /* 必须是 visible，保证下拉面板能弹出 */
    }

    .guest-selector-group {
        position: relative;
    }

    .input-wrapper {
        min-width: 0; 
        flex: 1;
        overflow: hidden; /* 只让文字包裹层截断，不挤压右侧按钮 */
    }

    .guest-display-text {
        font-size: 0.85rem; 
        font-weight: 600;
        color: #0f172a;
        white-space: nowrap; 
        overflow: hidden; 
        text-overflow: ellipsis; 
    }

    /* 🌟 人数与房间选择弹出面板 */
    .guest-picker-dropdown {
        position: absolute;
        top: calc(100% + 12px);
        left: 0;
        width: 280px;
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 12px;
        padding: 18px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.18);
        z-index: 999;
        display: none; /* 默认隐藏 */
    }

    .guest-picker-dropdown.show {
        display: block !important; /* JS 控制显示 */
    }

    .picker-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 14px;
    }

    .picker-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: #0f172a;
        display: block;
    }

    .picker-subtitle {
        font-size: 0.75rem;
        color: #64748b;
    }

    .counter-controls {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .btn-counter {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: 1px solid #cbd5e1;
        background: #f8fafc;
        color: #0f172a;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .btn-counter:hover {
        background: #047857;
        color: #ffffff;
        border-color: #047857;
    }

    .counter-value {
        font-size: 0.95rem;
        font-weight: 700;
        min-width: 18px;
        text-align: center;
    }

    .btn-picker-done {
        width: 100%;
        padding: 8px;
        background: #047857;
        color: #fff;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 6px;
    }

    /* 酒店卡片与收藏按钮 */
    .hotel-card { 
        background: #ffffff; 
        border: 1px solid #e2e8f0; 
        border-radius: 16px; 
        display: flex; 
        overflow: hidden; 
        position: relative; 
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .hotel-card:hover { 
        transform: translateY(-3px); 
        box-shadow: 0 12px 28px rgba(0,0,0,0.08); 
        border-color: #047857; 
    }

    .card-img-box { 
        width: 320px; 
        height: 220px; 
        flex-shrink: 0; 
        position: relative; 
        overflow: hidden;
    }

    .card-img-box img { 
        width: 100%; 
        height: 100%; 
        object-fit: cover; 
        transition: transform 0.3s ease;
    }

    .hotel-card:hover .card-img-box img {
        transform: scale(1.05);
    }

    /* ❤️ 收藏按钮 & 局部提示 */
    .fav-wrapper {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 15;
    }

    .btn-fav { 
        background: rgba(255, 255, 255, 0.92); 
        border: none; 
        width: 38px; 
        height: 38px; 
        border-radius: 50%; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        cursor: pointer; 
        box-shadow: 0 2px 10px rgba(0,0,0,0.18); 
        transition: all 0.2s ease; 
    }

    .btn-fav:hover { 
        transform: scale(1.1); 
        background: #ffffff;
    }

    .btn-fav i { 
        font-size: 1.15rem; 
        color: #94a3b8; 
        transition: color 0.2s; 
    }

    .btn-fav.active i { 
        color: #ef4444; 
    }

    .fav-tooltip {
        position: absolute;
        top: 46px;
        right: 0;
        background: #1e293b;
        color: #ffffff;
        font-size: 0.78rem;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 6px;
        white-space: nowrap;
        box-shadow: 0 4px 14px rgba(0,0,0,0.2);
        opacity: 0;
        visibility: hidden;
        transform: translateY(-6px);
        transition: all 0.25s ease;
        pointer-events: none;
        z-index: 20;
    }

    .fav-tooltip::before {
        content: '';
        position: absolute;
        top: -4px;
        right: 13px;
        width: 8px;
        height: 8px;
        background: #1e293b;
        transform: rotate(45deg);
    }

    .fav-wrapper.show-tooltip .fav-tooltip {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .card-body { 
        padding: 20px 24px; 
        flex: 1; 
        display: flex; 
        flex-direction: column; 
        justify-content: space-between; 
    }

    .hotel-title-link {
        font-size: 1.3rem;
        font-weight: 700;
        color: #0f172a;
        text-decoration: none;
        position: relative;
        z-index: 5;
    }

    .hotel-title-link:hover {
        color: #047857;
        text-decoration: underline;
    }

    .badge-score { 
        background: #047857; 
        color: #fff; 
        font-weight: 700; 
        padding: 6px 12px; 
        border-radius: 8px; 
        font-size: 0.9rem; 
    }

    .btn-view-detail {
        background: #047857;
        color: #ffffff;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        position: relative;
        z-index: 5;
    }

    .btn-view-detail:hover {
        background: #065f46;
        color: #ffffff;
    }
</style>

<!-- 1. 顶部 Search Bar -->
<section class="search-hero-wrapper">
    <div class="search-container">
        <form action="after_search.php" method="GET" class="filter-bar">
            <div class="input-group">
                <i class="fa-solid fa-location-dot icon"></i>
                <div class="input-wrapper">
                    <label>Destination / State</label>
                    <select name="query" required>
                        <?php
                        $states = ['Penang', 'Johor', 'Selangor', 'Melaka', 'Sabah', 'Sarawak', 'Pahang', 'Perak'];
                        foreach ($states as $st) {
                            $selected = (strcasecmp($query, $st) === 0) ? 'selected' : '';
                            echo "<option value=\"$st\" $selected>$st</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="input-group">
                <i class="fa-solid fa-calendar-check icon"></i>
                <div class="input-wrapper">
                    <label>Check-in Date</label>
                    <input type="date" name="check_in" value="<?php echo htmlspecialchars($check_in); ?>" required>
                </div>
            </div>

            <div class="input-group">
                <i class="fa-solid fa-calendar-minus icon"></i>
                <div class="input-wrapper">
                    <label>Check-out Date</label>
                    <input type="date" name="check_out" value="<?php echo htmlspecialchars($check_out); ?>" required>
                </div>
            </div>

            <!-- 人数/房间组 -->
            <div class="input-group guest-selector-group">
                <i class="fa-solid fa-user-group icon"></i>
                <div class="input-wrapper" id="guestInputTrigger" style="cursor: pointer;">
                    <label>Guests & Rooms</label>
                    <div class="guest-display-text" id="guestSummary"><?php echo $guest_summary_initial; ?></div>
                </div>

                <input type="hidden" name="adults" id="input_adults" value="<?php echo $adults; ?>">
                <input type="hidden" name="children" id="input_children" value="<?php echo $children; ?>">
                <input type="hidden" name="rooms" id="input_rooms" value="<?php echo $rooms; ?>">

                <!-- 弹出面板 -->
                <div class="guest-picker-dropdown" id="guestDropdown">
                    <div class="picker-row">
                        <div class="picker-info">
                            <span class="picker-title">Adults</span>
                            <span class="picker-subtitle">Ages 13+</span>
                        </div>
                        <div class="counter-controls">
                            <button type="button" class="btn-counter" onclick="updateGuest(event, 'adults', -1)">-</button>
                            <span class="counter-value" id="cnt_adults"><?php echo $adults; ?></span>
                            <button type="button" class="btn-counter" onclick="updateGuest(event, 'adults', 1)">+</button>
                        </div>
                    </div>

                    <div class="picker-row">
                        <div class="picker-info">
                            <span class="picker-title">Children</span>
                            <span class="picker-subtitle">Ages 0 - 12</span>
                        </div>
                        <div class="counter-controls">
                            <button type="button" class="btn-counter" onclick="updateGuest(event, 'children', -1)">-</button>
                            <span class="counter-value" id="cnt_children"><?php echo $children; ?></span>
                            <button type="button" class="btn-counter" onclick="updateGuest(event, 'children', 1)">+</button>
                        </div>
                    </div>

                    <div class="picker-row">
                        <div class="picker-info">
                            <span class="picker-title">Rooms</span>
                        </div>
                        <div class="counter-controls">
                            <button type="button" class="btn-counter" onclick="updateGuest(event, 'rooms', -1)">-</button>
                            <span class="counter-value" id="cnt_rooms"><?php echo $rooms; ?></span>
                            <button type="button" class="btn-counter" onclick="updateGuest(event, 'rooms', 1)">+</button>
                        </div>
                    </div>

                    <button type="button" class="btn-picker-done" onclick="closeGuestDropdown(event)">Done</button>
                </div>
            </div>

            <button type="submit" class="btn-search">
                <i class="fa-solid fa-magnifying-glass"></i> Search
            </button>
        </form>
    </div>
</section>

<!-- 2. 搜索结果列表区 -->
<main class="results-container">
    <div style="margin-bottom: 24px;">
        <h2 style="font-size: 1.5rem; color: #0f172a; font-weight: 700;">Stays in <?php echo htmlspecialchars($page_title); ?></h2>
        <p style="font-size: 0.9rem; color: #64748b; margin-top: 4px;">Found <?php echo count($filtered_hotels); ?> properties matching your search</p>
    </div>

    <div class="hotel-list">
        <?php foreach ($filtered_hotels as $hotel): 
            // 💡 如果 detail.php 在根目录（与 index.php 同层），请把路径改为 "../detail.php?id=..."
            $detail_url = "detail.php?id={$hotel['id']}&check_in=" . urlencode($check_in) . "&check_out=" . urlencode($check_out) . "&adults={$adults}&rooms={$rooms}";
        ?>
            <div class="hotel-card">
                <div class="card-img-box">
                    <div class="fav-wrapper">
                        <button type="button" class="btn-fav" onclick="toggleFavorite(event, this, <?php echo $hotel['id']; ?>)">
                            <i class="fa-solid fa-heart"></i>
                        </button>
                        <div class="fav-tooltip">Please login first!</div>
                    </div>

                    <a href="<?php echo $detail_url; ?>" style="display:block; width:100%; height:100%;">
                        <img src="<?php echo htmlspecialchars($hotel['img_main']); ?>" alt="<?php echo htmlspecialchars($hotel['name']); ?>">
                    </a>
                </div>

                <div class="card-body">
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 12px;">
                            <a href="<?php echo $detail_url; ?>" class="hotel-title-link">
                                <?php echo htmlspecialchars($hotel['name']); ?>
                            </a>
                            <span class="badge-score"><?php echo $hotel['rating']; ?></span>
                        </div>

                        <div style="font-size: 0.85rem; color: #64748b; margin-top: 6px;">
                            <i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($hotel['city']); ?>, <?php echo htmlspecialchars($hotel['state']); ?>
                        </div>

                        <p style="font-size: 0.88rem; color: #475569; margin-top: 10px; line-height: 1.5;">
                            <?php echo htmlspecialchars($hotel['desc']); ?>
                        </p>
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-top: 20px; padding-top: 12px; border-top: 1px dashed #e2e8f0;">
                        <div>
                            <span style="color: #047857; font-size: 0.85rem; font-weight: 600;"><i class="fa-solid fa-circle-check"></i> Free Cancellation</span>
                            <div style="margin-top: 4px;">
                                <small style="color: #64748b; font-size: 0.75rem;">Starts from</small>
                                <div style="font-size: 1.4rem; font-weight: 800; color: #0f172a;">RM <?php echo $hotel['price']; ?> <span style="font-size:0.8rem; font-weight:400; color:#64748b;">/ night</span></div>
                            </div>
                        </div>

                        <a href="<?php echo $detail_url; ?>" class="btn-view-detail">
                            View Details <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<script>
const isLoggedIn = <?php echo $isLoggedIn ? 'true' : 'false'; ?>;

// 收藏按钮逻辑
function toggleFavorite(event, btn, hotelId) {
    event.stopPropagation();
    event.preventDefault();

    const wrapper = btn.closest('.fav-wrapper');

    if (!isLoggedIn) {
        if (btn.tooltipTimer) clearTimeout(btn.tooltipTimer);
        wrapper.classList.add('show-tooltip');
        btn.tooltipTimer = setTimeout(() => {
            wrapper.classList.remove('show-tooltip');
        }, 2000);
        return false;
    }

    btn.classList.toggle('active');
}

// 👨‍👩‍👧 核心修复：人数加减完整逻辑
let guestCounts = { 
    adults: <?php echo $adults; ?>, 
    children: <?php echo $children; ?>, 
    rooms: <?php echo $rooms; ?> 
};

function updateGuest(event, type, change) {
    if (event) event.stopPropagation(); // 阻止冒泡

    let minLimit = (type === 'children') ? 0 : 1;
    let currentVal = guestCounts[type];

    if (currentVal + change >= minLimit && currentVal + change <= 10) {
        guestCounts[type] += change;
        
        // 1. 更新面板上的数字
        document.getElementById('cnt_' + type).innerText = guestCounts[type];
        
        // 2. 更新隐藏的 Input 给 Form 提交
        document.getElementById('input_' + type).value = guestCounts[type];
        
        // 3. 更新输入框显示的 Summary 文字
        updateGuestSummary();
    }
}

function updateGuestSummary() {
    let adultText = guestCounts.adults + (guestCounts.adults > 1 ? ' Adults' : ' Adult');
    let childText = guestCounts.children > 0 ? `, ${guestCounts.children} ${guestCounts.children > 1 ? 'Children' : 'Child'}` : '';
    let roomText = guestCounts.rooms + (guestCounts.rooms > 1 ? ' Rooms' : ' Room');

    document.getElementById('guestSummary').innerText = `${adultText}${childText}, ${roomText}`;
}

// 面板开关控制
const guestTrigger = document.getElementById('guestInputTrigger');
const guestDropdown = document.getElementById('guestDropdown');

if (guestTrigger && guestDropdown) {
    // 点击 Trigger 打开/关闭
    guestTrigger.addEventListener('click', function (e) {
        e.stopPropagation();
        guestDropdown.classList.toggle('show');
    });

    // 点击 Dropdown 内部不关闭
    guestDropdown.addEventListener('click', function (e) {
        e.stopPropagation();
    });

    // 点击空白处关闭
    document.addEventListener('click', function () {
        guestDropdown.classList.remove('show');
    });
}

function closeGuestDropdown(e) {
    if (e) e.stopPropagation();
    if (guestDropdown) guestDropdown.classList.remove('show');
}
</script>