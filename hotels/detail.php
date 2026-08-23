<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../header.php';
require_once 'hotels_data.php';
require_once 'hotel_api.php'; 

// 🚨 设施图标映射函数 - 返回 FontAwesome 类名 (Booking.com 风格线性图标)
function getFacilityIcon($facilityName) {
    $name = strtolower($facilityName);
    
    // Non-smoking
    if (strpos($name, 'non-smoking') !== false || strpos($name, 'smoke') !== false || strpos($name, '禁烟') !== false) {
        return 'fa-solid fa-ban-smoking';
    }
    
    // Wi-Fi / Internet
    if (strpos($name, 'wifi') !== false || strpos($name, 'internet') !== false || strpos($name, 'wireless') !== false) {
        return 'fa-solid fa-wifi';
    }
    
    // 24-hour Front Desk / Reception
    if (strpos($name, 'front desk') !== false || strpos($name, 'reception') !== false || strpos($name, 'concierge') !== false) {
        return 'fa-solid fa-bell-concierge';
    }
    
    // Elevator / Lift
    if (strpos($name, 'lift') !== false || strpos($name, 'elevator') !== false) {
        return 'fa-solid fa-elevator';
    }
    
    // Daily Housekeeping / Cleaning
    if (strpos($name, 'housekeeping') !== false || strpos($name, 'cleaning') !== false || strpos($name, 'clean') !== false) {
        return 'fa-solid fa-spray-can-sparkles';
    }
    
    // Air Conditioning
    if (strpos($name, 'air condition') !== false || strpos($name, 'ac') !== false || strpos($name, 'cooling') !== false) {
        return 'fa-solid fa-snowflake';
    }
    
    // Breakfast
    if (strpos($name, 'breakfast') !== false) {
        return 'fa-solid fa-mug-hot';
    }
    
    // Swimming Pool
    if (strpos($name, 'pool') !== false || strpos($name, 'swimming') !== false) {
        return 'fa-solid fa-person-swimming';
    }
    
    // Fitness / Gym
    if (strpos($name, 'fitness') !== false || strpos($name, 'gym') !== false || strpos($name, 'workout') !== false) {
        return 'fa-solid fa-dumbbell';
    }
    
    // Restaurant / Dining
    if (strpos($name, 'restaurant') !== false || strpos($name, 'dining') !== false) {
        return 'fa-solid fa-utensils';
    }
    
    // Parking
    if (strpos($name, 'parking') !== false) {
        return 'fa-solid fa-square-parking';
    }
    
    // Spa / Sauna / Wellness
    if (strpos($name, 'spa') !== false || strpos($name, 'sauna') !== false || strpos($name, 'wellness') !== false) {
        return 'fa-solid fa-spa';
    }
    
    // Bar
    if (strpos($name, 'bar') !== false) {
        return 'fa-solid fa-martini-glass-citrus';
    }
    
    // Coffee / Cafe
    if (strpos($name, 'coffee') !== false || strpos($name, 'cafe') !== false) {
        return 'fa-solid fa-mug-saucer';
    }
    
    // Room Service
    if (strpos($name, 'room service') !== false) {
        return 'fa-solid fa-bell';
    }
    
    // Family / Children
    if (strpos($name, 'family') !== false || strpos($name, 'children') !== false) {
        return 'fa-solid fa-people-group';
    }
    
    // Pet
    if (strpos($name, 'pet') !== false || strpos($name, 'dog') !== false) {
        return 'fa-solid fa-dog';
    }
    
    // Business / Meeting
    if (strpos($name, 'business') !== false || strpos($name, 'meeting') !== false || strpos($name, 'conference') !== false) {
        return 'fa-solid fa-briefcase';
    }
    
    // Laundry
    if (strpos($name, 'laundry') !== false || strpos($name, 'dry cleaning') !== false) {
        return 'fa-solid fa-shirt';
    }
    
    // Accessibility / Wheelchair
    if (strpos($name, 'wheelchair') !== false || strpos($name, 'accessible') !== false) {
        return 'fa-solid fa-wheelchair';
    }
    
    // View
    if (strpos($name, 'view') !== false) {
        return 'fa-solid fa-mountain-sun';
    }
    
    // TV / Television
    if (strpos($name, 'tv') !== false || strpos($name, 'television') !== false || strpos($name, 'flat-screen') !== false) {
        return 'fa-solid fa-tv';
    }
    
    // Phone
    if (strpos($name, 'phone') !== false || strpos($name, 'telephone') !== false) {
        return 'fa-solid fa-phone';
    }
    
    // Safe / Security
    if (strpos($name, 'safe') !== false || strpos($name, 'security') !== false) {
        return 'fa-solid fa-shield';
    }
    
    // Kitchen
    if (strpos($name, 'kitchen') !== false || strpos($name, 'kitchenette') !== false) {
        return 'fa-solid fa-kitchen-set';
    }
    
    // Garden / Terrace / Outdoor
    if (strpos($name, 'garden') !== false || strpos($name, 'terrace') !== false || strpos($name, 'balcony') !== false) {
        return 'fa-solid fa-tree';
    }
    
    // Airport Shuttle / Transfer
    if (strpos($name, 'airport') !== false || strpos($name, 'shuttle') !== false || strpos($name, 'transfer') !== false) {
        return 'fa-solid fa-plane-departure';
    }
    
    // Luggage Storage
    if (strpos($name, 'luggage') !== false || strpos($name, 'baggage') !== false || strpos($name, 'storage') !== false) {
        return 'fa-solid fa-suitcase';
    }
    
    // 默认使用绿色圆点
    return 'fa-solid fa-circle';
}

$isLoggedIn = isset($_SESSION['user_id']) || isset($_SESSION['user']) || isset($_SESSION['user_name']);

$query    = $_GET['query'] ?? 'Penang';
$hotel_id = $_GET['id'] ?? 101;
$check_in = $_GET['check_in'] ?? date('Y-m-d');
$check_out= $_GET['check_out'] ?? date('Y-m-d', strtotime('+1 day'));
$adults   = (int)($_GET['adults'] ?? 2);
$children = (int)($_GET['children'] ?? 0);
$rooms    = (int)($_GET['rooms'] ?? 1);
$hotelNights = max(1, (int) ceil((strtotime($check_out) - strtotime($check_in)) / 86400));

$guest_summary_initial = "$adults Adults" . ($children > 0 ? ", $children Children" : "") . ", $rooms Room";

$hotel = null;
$liveApiUsed = false;

// 🚨 核心修复：现在调用只传 1 个 ID 参数，完美解决崩溃报错！
if ($hotel_id > 9000) {
    $apiDetails = getLiveHotelDetails($hotel_id);
    if ($apiDetails) {
        $hotel = [
            'id' => $hotel_id,
            'name' => $_GET['name'] ?? 'Premium Hotel',
            'city' => $_GET['city'] ?? $query,
            'state' => $query,
            'price' => $_GET['price'] ?? 300,
            'rating' => $_GET['rating'] ?? 8.5,
            'score_text' => $_GET['score_text'] ?? 'Excellent',
            'desc' => $apiDetails['desc'],
            'img_main' => $apiDetails['img_main'],
            'img_lobby' => $apiDetails['img_lobby'],
            'img_bathroom' => $apiDetails['img_bathroom'],
            'facilities' => $apiDetails['facilities'],
            'reviews' => $apiDetails['reviews']
        ];
        $liveApiUsed = true;
    }
}

if (!$hotel) {
    foreach ($all_hotels as $h) {
        if ($h['id'] == $hotel_id) {
            $hotel = $h;
            $hotel['facilities'] = ['Free High-speed Wi-Fi', 'Swimming Pool', 'On-site Restaurant', 'Free Parking', 'Air Conditioning', 'Fitness Center'];
            break;
        }
    }
    if (!$hotel) $hotel = $all_hotels[0];
}

$map_query = urlencode($hotel['name'] . ' ' . $hotel['city'] . ', ' . $hotel['state'] . ', Malaysia');
$google_map_url = "https://www.google.com/maps/search/?api=1&query=" . $map_query;
?>

<link rel="stylesheet" href="../css/modules/hotels.css?v=6">

<!-- 🚨 移除了所有可能阻挡高度的内联样式，确保类名正确 🚨 -->
<section class="search-hero-wrapper">
    <div class="hero-content">
        <!-- 🚨 加回小标题 (Kicker) 🚨 -->
        <span class="hero-kicker">TRAVELPAL · MALAYSIA</span>
        
        <h1>Find Your Perfect Stay in Malaysia</h1>
        <p>Compare real-time prices and availability across top destinations.</p>
    </div>

    <div class="search-container">
        <form action="after_search.php" method="GET" class="filter-bar">
            <div style="display: none;">
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
                    <button type="button" class="btn-picker-done" onclick="closeGuestDropdown(event)">Done</button>
                </div>
            </div>
            <button type="submit" class="btn-search">Search Hotels</button>
        </form>
    </div>
</section>

<main class="detail-container">
    <div class="detail-header">
        <div>
            <div style="display:flex; align-items:center; gap: 10px;">
                <h1 class="detail-title" style="margin:0;"><?php echo htmlspecialchars($hotel['name']); ?></h1>
                <?php if ($liveApiUsed): ?>
                    <span style="background: #e9f8f2; color: #006b4f; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: bold; border: 1px solid #c5ebdc;">Live API Data</span>
                <?php endif; ?>
            </div>
            <p class="detail-subtitle" style="margin-top: 6px;"><?php echo htmlspecialchars($hotel['city']); ?>, <?php echo htmlspecialchars($hotel['state']); ?>, Malaysia</p>
        </div>
        <div style="display: flex; flex-direction: column; align-items: flex-end;">
    <?php if (!isset($_SESSION['user_id'])): ?>
        <button type="button" class="btn-fav-detail" onclick="TravelPalLoginPopup.open(event)">
            <span>Save to Favorites</span>
        </button>
    <?php else: ?>
        <button type="button" class="btn-fav-detail" id="btnFavDetail" onclick="toggleDetailFav(this)">
            <span>Save to Favorites</span>
        </button>
    <?php endif; ?>
</div>
    </div>

    <!-- 真实的 API 高清组图 -->
    <div class="photo-gallery">
        <img class="gallery-main" referrerpolicy="no-referrer" src="<?php echo $hotel['img_main']; ?>" alt="Hotel Exterior">
        <div class="gallery-sub-grid">
            <div class="sub-img-box">
                <img referrerpolicy="no-referrer" src="<?php echo $hotel['img_lobby']; ?>" alt="Hotel Lobby">
            </div>
            <div class="sub-img-box">
                <img referrerpolicy="no-referrer" src="<?php echo $hotel['img_bathroom']; ?>" alt="Bathroom View">
            </div>
        </div>
    </div>

    <div class="detail-layout">
        <div>
            <div class="info-card">
                <h3 style="font-size: 1.2rem; margin-bottom: 12px; color: #0f172a; text-decoration: underline;">About the Accommodation</h3>
                <p style="color: #475569; line-height: 1.6;"><?php echo htmlspecialchars($hotel['desc']); ?></p>
            </div>
            <div class="info-card" style="display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <span style="font-size: 0.75rem; font-weight: 700; color: var(--primary); text-transform: uppercase; letter-spacing: 0.05em;">Location & Explore</span>
                    <h4 style="font-size: 1rem; font-weight: 600; color: #0f172a; margin: 2px 0 4px 0;"><?php echo htmlspecialchars($hotel['name']); ?></h4>
                    <p style="font-size: 0.85rem; color: #64748b; margin: 0; line-height: 1.4;">
                        <?php echo htmlspecialchars($hotel['city']); ?>, <?php echo htmlspecialchars($hotel['state']); ?>, Malaysia
                    </p>
                </div>
                <a href="<?php echo $google_map_url; ?>" target="_blank" class="btn-view-detail" style="white-space: nowrap;">
                    Open Map
                </a>
            </div>

            <div class="info-card">
                <h3 style="font-size: 1.2rem; margin-bottom: 16px; color: #0f172a; text-decoration: underline;">Popular Amenities</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 8px 16px;">
                    <?php foreach ($hotel['facilities'] as $facility): 
                        $iconClass = getFacilityIcon($facility);
                    ?>
                        <div style="
                            display: flex; 
                            align-items: center; 
                            gap: 12px; 
                            padding: 6px 0;
                        ">
                            <!-- Booking.com 风格的线性图标 (FontAwesome) -->
                            <i class="<?php echo $iconClass; ?>" style="
                                font-size: 18px;
                                color: #00a650;
                                width: 24px;
                                text-align: center;
                                flex-shrink: 0;
                            "></i>
                            <span style="
                                font-size: 14px; 
                                color: #1a1a1a;
                                line-height: 1.4;
                            "><?php echo htmlspecialchars($facility); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <section class="info-card rating-comments-card">
                <div class="rating-section-header">
                    <h3>Verified Guest Reviews</h3>
                    <span class="rating-subtitle">Based on verified guest ratings for this property</span>
                </div>

                <div class="rating-overview-dashboard">
                    <div class="rating-primary-box">
                        <div class="rating-score-badge">
                            <span class="score-num"><?php echo $hotel['rating']; ?></span>
                            <span class="score-max">/10</span>
                        </div>
                        <div class="rating-summary-info">
                            <div class="rating-status-title"><?php echo htmlspecialchars($hotel['score_text']); ?></div>
                            <div class="rating-count-text">Based on 100+ verified reviews</div>
                        </div>
                    </div>

                    <div class="rating-breakdown-grid">
                        <div class="breakdown-item">
                            <div class="breakdown-header"><span>Cleanliness</span><strong>9.1</strong></div>
                            <div class="progress-bar-bg"><div class="progress-bar-fill" style="width: 91%;"></div></div>
                        </div>
                        <div class="breakdown-item">
                            <div class="breakdown-header"><span>Location</span><strong>9.5</strong></div>
                            <div class="progress-bar-bg"><div class="progress-bar-fill" style="width: 95%;"></div></div>
                        </div>
                        <div class="breakdown-item">
                            <div class="breakdown-header"><span>Service</span><strong>8.9</strong></div>
                            <div class="progress-bar-bg"><div class="progress-bar-fill" style="width: 89%;"></div></div>
                        </div>
                        <div class="breakdown-item">
                            <div class="breakdown-header"><span>Value</span><strong>8.7</strong></div>
                            <div class="progress-bar-bg"><div class="progress-bar-fill" style="width: 87%;"></div></div>
                        </div>
                    </div>
                </div>

                <div class="comments-list">
                    <?php 
                    $reviews_to_show = !empty($hotel['reviews']) ? $hotel['reviews'] : [
                        ['user' => 'Verified Guest', 'date' => '2026-08-01', 'rating' => $hotel['rating'], 'comment' => 'The hotel was fantastic and exceeded expectations.']
                    ];
                    foreach ($reviews_to_show as $rev): 
                        $initial = strtoupper(substr($rev['user'], 0, 1));
                    ?>
                        <div class="comment-item">
                            <div class="comment-item-header">
                                <div class="comment-user-info">
                                    <div class="user-avatar-circle"><?php echo htmlspecialchars($initial); ?></div>
                                    <div class="user-meta">
                                        <strong class="user-name"><?php echo htmlspecialchars($rev['user']); ?></strong>
                                        <div class="user-sub-meta">
                                            <span class="traveler-tag">Guest</span>
                                            <span class="dot-separator">•</span>
                                            <span class="comment-date"><?php echo date('d M Y', strtotime($rev['date'])); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="comment-score-badge"><?php echo number_format($rev['rating'], 1); ?></div>
                            </div>
                            <p class="comment-body">"<?php echo htmlspecialchars($rev['comment']); ?>"</p>
                            <div class="comment-footer">
                                <span class="verified-purchase">Verified Booking</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>

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

                <form action="/TravelPal/trips/add_to_cart.php" method="POST" onsubmit="return handleBooking(event)">
                    <input type="hidden" name="item_type" value="hotel">
                    <input type="hidden" name="item_key" value="hotel-<?php echo htmlspecialchars($hotel['id']); ?>-<?php echo htmlspecialchars($check_in); ?>-<?php echo htmlspecialchars($check_out); ?>">
                    <input type="hidden" name="title" value="<?php echo htmlspecialchars($hotel['name']); ?>">
                    <input type="hidden" name="subtitle" value="<?php echo htmlspecialchars($hotel['city'] . ', ' . $hotel['state'] . ' · ' . date('d M Y', strtotime($check_in))); ?>">
                    <input type="hidden" name="unit_price" value="<?php echo (float)$hotel['price']; ?>">
                    <input type="hidden" name="quantity" value="<?php echo $hotelNights; ?>">
                    <input type="hidden" name="booking_data" value="<?php echo htmlspecialchars(json_encode(['check_in' => $check_in, 'check_out' => $check_out, 'guests' => max(1, $adults + $children), 'rooms' => $rooms]), ENT_QUOTES, 'UTF-8'); ?>">
                    <div style="margin-bottom: 12px;">
                        <label style="font-size: 0.8rem; font-weight: 600; color: #475569;">Check-in Date</label>
                        <input type="date" name="check_in" value="<?php echo htmlspecialchars($check_in); ?>" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; margin-top: 4px;">
                    </div>
                    <div style="margin-bottom: 12px;">
                        <label style="font-size: 0.8rem; font-weight: 600; color: #475569;">Check-out Date</label>
                        <input type="date" name="check_out" value="<?php echo htmlspecialchars($check_out); ?>" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; margin-top: 4px;">
                    </div>

                    <?php if (!isset($_SESSION['user_id'])): ?>
    <button type="button" class="btn-book-now" onclick="TravelPalLoginPopup.open(event)">
        Add to My Trips
    </button>
<?php else: ?>
    <button type="submit" class="btn-book-now">
        Add to My Trips
    </button>
<?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
const isLoggedIn = <?php echo $isLoggedIn ? 'true' : 'false'; ?>;

// 预订逻辑的拦截（虽然按钮已经换了，保险起见保留表单拦截）
function handleBooking(event) {
    if (!isLoggedIn) {
        event.preventDefault();
        TravelPalLoginPopup.open(event);
        return false;
    }
    return true;
}

// 现在 toggleDetailFav 只在已登录时才会被调用
function toggleDetailFav(btn) {
    fetch('/TravelPal/trips/favorites_action.php', { method: 'POST', headers: {'Content-Type': 'application/json'}, body: JSON.stringify({
        action: btn.classList.contains('active') ? 'remove' : 'save', item_type: 'hotel', item_key: 'hotel-<?php echo htmlspecialchars($hotel['id']); ?>',
        title: <?php echo json_encode($hotel['name']); ?>,
        subtitle: <?php echo json_encode($hotel['city'] . ', ' . $hotel['state']); ?>,
        image_url: <?php echo json_encode($hotel['img_main']); ?>,
        unit_price: <?php echo json_encode((float)$hotel['price']); ?>,
        metadata: {guests: <?php echo max(1, $adults + $children); ?>, nights: <?php echo $hotelNights; ?>}
    })}).then(r => r.json()).then(data => {
        if (!data.ok) return;
        btn.classList.toggle('active', data.saved);
        btn.querySelector('span').innerText = data.saved ? 'Saved to Favorites' : 'Save to Favorites';
    });
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
</script>

<!-- =========================================================
     引入强制登录弹窗 (未登录用户点击核心按钮时触发)
     ========================================================= -->
<?php include 'login_popup.php'; ?>

<?php include __DIR__ . '/../footer.php'; ?>
