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
$sort     = $_GET['sort'] ?? 'popular';

// 3. 筛选酒店
$filtered_hotels = array_filter($all_hotels, function($h) use ($query, $type, $vibe) {
    if (!empty($query) && strcasecmp($h['state'], $query) === 0) return true;
    if (!empty($type) && strcasecmp($h['type'], $type) === 0) return true;
    if (!empty($vibe) && strcasecmp($h['vibe'], $vibe) === 0) return true;
    return empty($query) && empty($type) && empty($vibe);
});

// 默认显示 Penang
if (empty($filtered_hotels)) {
    $filtered_hotels = array_filter($all_hotels, fn($h) => $h['state'] === 'Penang');
}

// 排序逻辑
$filtered_hotels = array_values($filtered_hotels);

switch ($sort) {
    case 'price_low':
        usort($filtered_hotels, function($a, $b) {
            return $a['price'] - $b['price'];
        });
        break;
    case 'price_high':
        usort($filtered_hotels, function($a, $b) {
            return $b['price'] - $a['price'];
        });
        break;
    case 'rating':
        usort($filtered_hotels, function($a, $b) {
            return $b['rating'] <=> $a['rating'];
        });
        break;
    case 'popular':
    default:
        usort($filtered_hotels, function($a, $b) {
            return $b['rating'] <=> $a['rating'];
        });
        break;
}

$page_title = !empty($query) ? $query : (!empty($type) ? $type : (!empty($vibe) ? $vibe : 'Penang'));

// 初始化人数 Summary 格式
$guest_summary_initial = "$adults Adults" . ($children > 0 ? ", $children Children" : "") . ", $rooms Room";
?>

<link rel="stylesheet" href="../css/modules/hotels.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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

            <div class="input-group guest-selector-group">
                <i class="fa-solid fa-user-group icon"></i>
                <div class="input-wrapper" id="guestInputTrigger" style="cursor: pointer;">
                    <label>Guests & Rooms</label>
                    <div class="guest-display-text" id="guestSummary"><?php echo $guest_summary_initial; ?></div>
                </div>

                <input type="hidden" name="adults" id="input_adults" value="<?php echo $adults; ?>">
                <input type="hidden" name="children" id="input_children" value="<?php echo $children; ?>">
                <input type="hidden" name="rooms" id="input_rooms" value="<?php echo $rooms; ?>">

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

            <input type="hidden" name="sort" value="<?php echo htmlspecialchars($sort); ?>">

            <button type="submit" class="btn-search">
                <i class="fa-solid fa-magnifying-glass"></i> Search
            </button>
        </form>
    </div>
</section>

<!-- 2. 搜索结果列表区 -->
<main class="results-container">
    <div style="margin-bottom: 20px;">
        <h2 style="font-size: 1.5rem; color: #0f172a; font-weight: 700;">Stays in <?php echo htmlspecialchars($page_title); ?></h2>
        <p style="font-size: 0.9rem; color: #64748b; margin-top: 4px;">Found <?php echo count($filtered_hotels); ?> properties matching your search</p>
    </div>

    <!-- 排序栏 -->
    <div class="sort-bar">
        <div class="results-count">
            Showing <strong><?php echo count($filtered_hotels); ?></strong> properties
        </div>
        <div class="sort-group">
            <label for="sortSelect"><i class="fa-solid fa-arrow-up-wide-short"></i> Sort by:</label>
            <select id="sortSelect" onchange="applySort()">
                <option value="popular" <?php echo $sort === 'popular' ? 'selected' : ''; ?>>⭐ Most Popular</option>
                <option value="price_low" <?php echo $sort === 'price_low' ? 'selected' : ''; ?>>💰 Price: Low to High</option>
                <option value="price_high" <?php echo $sort === 'price_high' ? 'selected' : ''; ?>>💰 Price: High to Low</option>
                <option value="rating" <?php echo $sort === 'rating' ? 'selected' : ''; ?>>⭐ Rating: High to Low</option>
            </select>
        </div>
    </div>

    <div class="hotel-list">
        <?php foreach ($filtered_hotels as $hotel): 
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

let guestCounts = { 
    adults: <?php echo $adults; ?>, 
    children: <?php echo $children; ?>, 
    rooms: <?php echo $rooms; ?> 
};

function updateGuest(event, type, change) {
    if (event) event.stopPropagation();

    let minLimit = (type === 'children') ? 0 : 1;
    let currentVal = guestCounts[type];

    if (currentVal + change >= minLimit && currentVal + change <= 10) {
        guestCounts[type] += change;
        
        document.getElementById('cnt_' + type).innerText = guestCounts[type];
        document.getElementById('input_' + type).value = guestCounts[type];
        updateGuestSummary();
    }
}

function updateGuestSummary() {
    let adultText = guestCounts.adults + (guestCounts.adults > 1 ? ' Adults' : ' Adult');
    let childText = guestCounts.children > 0 ? `, ${guestCounts.children} ${guestCounts.children > 1 ? 'Children' : 'Child'}` : '';
    let roomText = guestCounts.rooms + (guestCounts.rooms > 1 ? ' Rooms' : ' Room');

    document.getElementById('guestSummary').innerText = `${adultText}${childText}, ${roomText}`;
}

const guestTrigger = document.getElementById('guestInputTrigger');
const guestDropdown = document.getElementById('guestDropdown');

if (guestTrigger && guestDropdown) {
    guestTrigger.addEventListener('click', function (e) {
        e.stopPropagation();
        guestDropdown.classList.toggle('show');
    });

    guestDropdown.addEventListener('click', function (e) {
        e.stopPropagation();
    });

    document.addEventListener('click', function () {
        guestDropdown.classList.remove('show');
    });
}

function closeGuestDropdown(e) {
    if (e) e.stopPropagation();
    if (guestDropdown) guestDropdown.classList.remove('show');
}

function applySort() {
    const select = document.getElementById('sortSelect');
    const sortValue = select.value;
    
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('sort', sortValue);
    
    window.location.href = window.location.pathname + '?' + urlParams.toString();
}
</script>