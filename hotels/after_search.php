<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../header.php';
require_once 'hotels_data.php';
require_once 'hotel_api.php'; 

$isLoggedIn = isset($_SESSION['user_id']) || isset($_SESSION['user']) || isset($_SESSION['user_name']);

$query    = $_GET['query'] ?? '';
$check_in = $_GET['check_in'] ?? date('Y-m-d');
$check_out= $_GET['check_out'] ?? date('Y-m-d', strtotime('+1 day'));
$adults   = (int)($_GET['adults'] ?? 2);
$children = (int)($_GET['children'] ?? 0);
$rooms    = (int)($_GET['rooms'] ?? 1);
$sort     = $_GET['sort'] ?? 'popular';

$liveApiUsed = false;
$filtered_hotels = [];

// 1. 使用真实 API 搜索
if (!empty($query)) {
    $apiHotels = searchLiveHotels($query, $check_in, $check_out, $adults, $rooms);
    if (!empty($apiHotels)) {
        $filtered_hotels = $apiHotels;
        $liveApiUsed = true;
    }
}

// 2. 如果 API 失败/没拿到数据，退回假数据
if (empty($filtered_hotels)) {
    $filtered_hotels = array_filter($all_hotels, function($h) use ($query) {
        if (!empty($query) && strcasecmp($h['state'], $query) !== 0 && stripos($h['city'], $query) === false) return false;
        return true; 
    });
    if (empty($filtered_hotels) && empty($query)) {
        $filtered_hotels = array_filter($all_hotels, fn($h) => $h['state'] === 'Penang');
    }
    // Fallback 也只要前 8 家
    $filtered_hotels = array_slice($filtered_hotels, 0, 8);
}

$filtered_hotels = array_values($filtered_hotels);

switch ($sort) {
    case 'price_low': usort($filtered_hotels, fn($a, $b) => $a['price'] - $b['price']); break;
    case 'price_high': usort($filtered_hotels, fn($a, $b) => $b['price'] - $a['price']); break;
    case 'rating': usort($filtered_hotels, fn($a, $b) => $b['rating'] <=> $a['rating']); break;
    case 'popular':
    default: usort($filtered_hotels, fn($a, $b) => $b['rating'] <=> $a['rating']); break;
}

$page_title = !empty($query) ? $query : 'Penang';
$guest_summary_initial = "$adults Adults" . ($children > 0 ? ", $children Children" : "") . ", $rooms Room";
?>

<link rel="stylesheet" href="../css/modules/hotels.css?v=8">

<section class="search-hero-wrapper">
    <div class="hero-content">
        <h1>Find Your Perfect Stay in Malaysia</h1>
        <p>Compare real-time prices and availability across top destinations.</p>
    </div>

    <div class="search-container">
        <form action="after_search.php" method="GET" class="filter-bar">
            <div style="display: none;">
                <input type="hidden" name="sort" value="<?php echo htmlspecialchars($sort); ?>">
                <input type="hidden" name="adults" id="input_adults" value="<?php echo $adults; ?>">
                <input type="hidden" name="children" id="input_children" value="<?php echo $children; ?>">
                <input type="hidden" name="rooms" id="input_rooms" value="<?php echo $rooms; ?>">
            </div>

            <div class="input-group">
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
                <div class="input-wrapper">
                    <label>Check-in Date</label>
                    <input type="date" name="check_in" value="<?php echo htmlspecialchars($check_in); ?>" required>
                </div>
            </div>

            <div class="input-group">
                <div class="input-wrapper">
                    <label>Check-out Date</label>
                    <input type="date" name="check_out" value="<?php echo htmlspecialchars($check_out); ?>" required>
                </div>
            </div>

            <div class="input-group guest-selector-group">
                <div class="input-wrapper" id="guestInputTrigger" style="cursor: pointer;">
                    <label>Guests & Rooms</label>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="guest-display-text" id="guestSummary"><?php echo $guest_summary_initial; ?></div>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#172033" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 8px; margin-right: 8px; flex-shrink: 0;">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                </div>

                <div class="guest-picker-dropdown" id="guestDropdown">
                    <div class="picker-row">
                        <div class="picker-info"><span class="picker-title">Adults</span></div>
                        <div class="counter-controls">
                            <button type="button" class="btn-counter" onclick="updateGuest(event, 'adults', -1)">-</button>
                            <span class="counter-value" id="cnt_adults"><?php echo $adults; ?></span>
                            <button type="button" class="btn-counter" onclick="updateGuest(event, 'adults', 1)">+</button>
                        </div>
                    </div>
                    <div class="picker-row">
                        <div class="picker-info"><span class="picker-title">Children</span></div>
                        <div class="counter-controls">
                            <button type="button" class="btn-counter" onclick="updateGuest(event, 'children', -1)">-</button>
                            <span class="counter-value" id="cnt_children"><?php echo $children; ?></span>
                            <button type="button" class="btn-counter" onclick="updateGuest(event, 'children', 1)">+</button>
                        </div>
                    </div>
                    <div class="picker-row">
                        <div class="picker-info"><span class="picker-title">Rooms</span></div>
                        <div class="counter-controls">
                            <button type="button" class="btn-counter" onclick="updateGuest(event, 'rooms', -1)">-</button>
                            <span class="counter-value" id="cnt_rooms"><?php echo $rooms; ?></span>
                            <button type="button" class="btn-counter" onclick="updateGuest(event, 'rooms', 1)">+</button>
                        </div>
                    </div>
                    <button type="button" class="btn-picker-done" onclick="closeGuestDropdown(event)">Done</button>
                </div>
            </div>

            <button type="submit" class="btn-search">Search Hotels</button>
        </form>
    </div>
</section>

<main class="results-container">
    <div class="results-header-area">
        <!-- 🚨 完全保留了原本最原始的绿底牌子 🚨 -->
        <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 8px; flex-wrap: wrap;">
            <h2>Stay in <?php echo htmlspecialchars($page_title); ?></h2>
            <?php if ($liveApiUsed): ?>
                <span style="background: #e9f8f2; color: #006b4f; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: bold; border: 1px solid #c5ebdc;">Live API Data</span>
            <?php else: ?>
                <span style="background: #f1f3f6; color: #596579; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: bold; border: 1px solid #e0e4ea;">Cached Data</span>
            <?php endif; ?>
        </div>
        <!-- 🚨 改为新的文案 🚨 -->
        <p>Discover the best stays and experiences in <?php echo htmlspecialchars($page_title); ?></p>
    </div>

    <!-- 🚨 移除了 Showing 字段，将右边的排序推到边缘对齐 🚨 -->
    <div class="sort-bar" style="justify-content: flex-end;">
        <div class="sort-group">
            <label for="sortSelect">Sort by:</label>
            <select id="sortSelect" onchange="applySort()">
                <option value="popular" <?php echo $sort === 'popular' ? 'selected' : ''; ?>>Most Popular</option>
                <option value="price_low" <?php echo $sort === 'price_low' ? 'selected' : ''; ?>>Price: Low to High</option>
                <option value="price_high" <?php echo $sort === 'price_high' ? 'selected' : ''; ?>>Price: High to Low</option>
                <option value="rating" <?php echo $sort === 'rating' ? 'selected' : ''; ?>>Rating: High to Low</option>
            </select>
        </div>
    </div>

    <?php if(empty($filtered_hotels)): ?>
        <p style="text-align: center; color: #64748b; padding: 40px;">No hotels found for your selected filters.</p>
    <?php else: ?>
        <div class="hotel-list">
            <?php foreach ($filtered_hotels as $hotel): 
                $detail_url = "detail.php?id={$hotel['id']}&query=".urlencode($hotel['state'] ?? $query)."&name=".urlencode($hotel['name'])."&city=".urlencode($hotel['city'])."&price={$hotel['price']}&rating={$hotel['rating']}&score_text=".urlencode($hotel['score_text'])."&check_in=" . urlencode($check_in) . "&check_out=" . urlencode($check_out) . "&adults={$adults}&rooms={$rooms}";
            ?>
                <div class="hotel-card">
                    <div class="card-img-box">
                        <div class="fav-wrapper">
                            <button type="button" class="btn-fav" onclick="toggleFavorite(event, this, <?php echo $hotel['id']; ?>)">♡</button>
                            <div class="fav-tooltip">Please login first!</div>
                        </div>
                        <a href="<?php echo $detail_url; ?>" style="display:block; width:100%; height:100%;">
                            <img src="<?php echo htmlspecialchars($hotel['img_main']); ?>" referrerpolicy="no-referrer" alt="<?php echo htmlspecialchars($hotel['name']); ?>">
                        </a>
                    </div>

                    <div class="card-body">
                        <div>
                            <div class="hotel-title-row">
                                <a href="<?php echo $detail_url; ?>" class="hotel-title-link">
                                    <?php echo htmlspecialchars($hotel['name']); ?>
                                </a>
                                <span class="badge-score"><?php echo $hotel['rating']; ?></span>
                            </div>
                            <div class="hotel-location">
                                <?php echo htmlspecialchars($hotel['city']); ?>, <?php echo htmlspecialchars($hotel['state']); ?>
                            </div>
                            <p class="hotel-description">
                                <?php echo htmlspecialchars($hotel['desc']); ?>
                            </p>
                        </div>
                        <div class="hotel-card-footer">
                            <div>
                                <span class="free-cancellation">Free Cancellation</span>
                                <div style="margin-top: 4px;">
                                    <span class="hotel-price-label">Starts from</span>
                                    <div class="hotel-price-amount">RM <?php echo $hotel['price']; ?> <span class="hotel-price-suffix">/ night</span></div>
                                </div>
                            </div>
                            <a href="<?php echo $detail_url; ?>" class="btn-view-detail">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
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
        btn.tooltipTimer = setTimeout(() => wrapper.classList.remove('show-tooltip'), 2000);
        return false;
    }
    btn.classList.toggle('active');
}

let guestCounts = { adults: <?php echo $adults; ?>, children: <?php echo $children; ?>, rooms: <?php echo $rooms; ?> };

function updateGuest(event, type, change) {
    if (event) event.stopPropagation();
    let minLimit = (type === 'children') ? 0 : 1;
    if (guestCounts[type] + change >= minLimit && guestCounts[type] + change <= 10) {
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
    document.getElementById('guestSummary').innerText = `${adultText}, ${roomText}`;
}

const guestTrigger = document.getElementById('guestInputTrigger');
const guestDropdown = document.getElementById('guestDropdown');

if (guestTrigger && guestDropdown) {
    guestTrigger.addEventListener('click', function (e) {
        e.stopPropagation();
        guestDropdown.classList.toggle('show');
    });
    guestDropdown.addEventListener('click', e => e.stopPropagation());
    document.addEventListener('click', () => guestDropdown.classList.remove('show'));
}

function closeGuestDropdown(e) {
    if (e) e.stopPropagation();
    if (guestDropdown) guestDropdown.classList.remove('show');
}

function applySort() {
    const select = document.getElementById('sortSelect');
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('sort', select.value);
    window.location.href = window.location.pathname + '?' + urlParams.toString();
}
</script>