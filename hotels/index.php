<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../header.php'; 
?>
<link rel="stylesheet" href="../css/modules/hotels.css?v=6">

<section class="hero-section">
    <div class="hero-content">
        <!-- 加上这一行作为小标题 (Kicker) -->
        <span class="hero-kicker">TRAVELPAL · MALAYSIA</span>
        
        <h1>Find Your Perfect Stay in Malaysia</h1>
        <p>Compare real-time prices and availability across top destinations.</p>
    </div>

    <div class="search-container">
        <form action="after_search.php" method="GET" class="filter-bar">
            <div style="display: none;">
                <input type="hidden" name="adults" id="input_adults" value="2">
                <input type="hidden" name="children" id="input_children" value="0">
                <input type="hidden" name="rooms" id="input_rooms" value="1">
            </div>

            <div class="input-group">
                <div class="input-wrapper">
                    <label>Destination / State</label>
                    <select name="query" required>
                        <option value="Penang" selected>Penang</option>
                        <option value="Johor">Johor</option>
                        <option value="Selangor">Selangor</option>
                        <option value="Melaka">Melaka</option>
                        <option value="Sabah">Sabah</option>
                        <option value="Sarawak">Sarawak</option>
                        <option value="Pahang">Pahang</option>
                        <option value="Perak">Perak</option>
                    </select>
                </div>
            </div>

            <div class="input-group">
                <div class="input-wrapper">
                    <label>Check-in Date</label>
                    <input type="date" name="check_in" id="check_in" required>
                </div>
            </div>

            <div class="input-group">
                <div class="input-wrapper">
                    <label>Check-out Date</label>
                    <input type="date" name="check_out" id="check_out" required>
                </div>
            </div>

            <div class="input-group guest-selector-group">
                <div class="input-wrapper" id="guestInputTrigger" style="cursor: pointer;">
                    <label>Guests & Rooms</label>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="guest-display-text" id="guestSummary">2 Adults, 0 Children, 1 Room</div>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#172033" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 8px; margin-right: 8px; flex-shrink: 0;">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                </div>

                <div class="guest-picker-dropdown" id="guestDropdown">
                    <div class="picker-row">
                        <div class="picker-info">
                            <span class="picker-title">Adults</span>
                            <span class="picker-subtitle">Ages 13+</span>
                        </div>
                        <div class="counter-controls">
                            <button type="button" class="btn-counter" onclick="updateGuest(event, 'adults', -1)">-</button>
                            <span class="counter-value" id="cnt_adults">2</span>
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
                            <span class="counter-value" id="cnt_children">0</span>
                            <button type="button" class="btn-counter" onclick="updateGuest(event, 'children', 1)">+</button>
                        </div>
                    </div>
                    <div class="picker-row">
                        <div class="picker-info">
                            <span class="picker-title">Rooms</span>
                            <span class="picker-subtitle">Number of rooms</span>
                        </div>
                        <div class="counter-controls">
                            <button type="button" class="btn-counter" onclick="updateGuest(event, 'rooms', -1)">-</button>
                            <span class="counter-value" id="cnt_rooms">1</span>
                            <button type="button" class="btn-counter" onclick="updateGuest(event, 'rooms', 1)">+</button>
                        </div>
                    </div>
                    <button type="button" class="btn-picker-done" onclick="closeGuestDropdown(event)">Done</button>
                </div>
            </div>

            <button type="submit" class="btn-search">
                Search Hotels
            </button>
        </form>
    </div>
</section>

<main class="main-content">
    
    <!-- 1. 顶部先展示 Top Staycation Destinations 网格 -->
    <section class="gallery-section">
        <div class="section-header">
            <h2>Top Staycation Destinations</h2>
            <p>Handpicked hotels across 8 stunning states in Malaysia</p>
        </div>
        <div class="gallery-grid">
            <a href="after_search.php?query=Penang" class="gallery-card">
                <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=500&q=80" alt="Penang">
                <span class="price-badge">From RM 215 / night</span>
                <div class="gallery-overlay">
                    <h3>Penang</h3><p>8 Hotels • Heritage & Beachfront</p>
                </div>
            </a>
            <a href="after_search.php?query=Sabah" class="gallery-card">
                <img src="https://images.unsplash.com/photo-1540541338287-41700207dee6?w=500&q=80" alt="Sabah">
                <span class="price-badge">From RM 230 / night</span>
                <div class="gallery-overlay">
                    <h3>Sabah</h3><p>8 Hotels • Island Resorts & Diving</p>
                </div>
            </a>
            <a href="after_search.php?query=Perak" class="gallery-card">
                <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=500&q=80" alt="Perak">
                <span class="price-badge">From RM 170 / night</span>
                <div class="gallery-overlay">
                    <h3>Perak</h3><p>8 Hotels • Hot Springs & Foodie Stays</p>
                </div>
            </a>
            <a href="after_search.php?query=Pahang" class="gallery-card">
                <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?w=500&q=80" alt="Pahang">
                <span class="price-badge">From RM 220 / night</span>
                <div class="gallery-overlay">
                    <h3>Pahang</h3><p>8 Hotels • Cameron Highlands & Genting</p>
                </div>
            </a>
            <a href="after_search.php?query=Melaka" class="gallery-card">
                <img src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=500&q=80" alt="Melaka">
                <span class="price-badge">From RM 60 / night</span>
                <div class="gallery-overlay">
                    <h3>Melaka</h3><p>8 Hotels • Riverfront & Jonker Walk</p>
                </div>
            </a>
            <a href="after_search.php?query=Johor" class="gallery-card">
                <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=500&q=80" alt="Johor">
                <span class="price-badge">From RM 220 / night</span>
                <div class="gallery-overlay">
                    <h3>Johor</h3><p>8 Hotels • Desaru Coast & Legoland</p>
                </div>
            </a>
        </div>
    </section>

<!-- 2. Sign In / Register 提示卡片 (外部 CSS 版) -->
    <?php if (!isset($_SESSION['user']) && !isset($_SESSION['user_id'])): ?>
        <section class="hotel-promo-banner" aria-labelledby="hotel-promo-title">
            
            <!-- 左侧：图标 -->
            <div class="hotel-promo-icon" aria-hidden="true">
                <i class="fa-solid fa-tags"></i>
            </div>
            
            <!-- 中间：文字说明 -->
            <div class="hotel-promo-content">
                <h2 id="hotel-promo-title">Unlock Member Secret Prices</h2>
                <p>Sign in to access exclusive hotel discounts, free room upgrades, and late check-outs.</p>
            </div>
            
            <!-- 右侧：按钮 -->
            <div class="hotel-promo-actions">
                <a href="../auth/login.php" class="hotel-btn hotel-btn-primary">Sign In</a>
                <a href="../auth/register.php" class="hotel-btn hotel-btn-outline">Register Free</a>
            </div>

        </section>
    <?php endif; ?>

    <!-- Feature Highlights -->
    <section class="features-section">
        <div class="feature-item">
            <div class="feature-icon-wrapper">
                <i class="fa-solid fa-shield-cat"></i>
            </div>
            <div class="feature-info">
                <h4>Best Price Guarantee</h4>
                <p>Found a lower rate? We’ll match it and give you extra rewards.</p>
            </div>
        </div>

        <div class="feature-item">
            <div class="feature-icon-wrapper">
                <i class="fa-solid fa-calendar-xmark"></i>
            </div>
            <div class="feature-info">
                <h4>Free Cancellation</h4>
                <p>Flexible stay plans on most properties. Cancel risk-free.</p>
            </div>
        </div>

        <div class="feature-item">
            <div class="feature-icon-wrapper">
                <i class="fa-solid fa-comments-dollar"></i>
            </div>
            <div class="feature-info">
                <h4>Pay at Hotel Available</h4>
                <p>Reserve online today and pay directly upon check-in.</p>
            </div>
        </div>
    </section>

    <!-- Travel Theme Dynamic Tabs -->
    <section class="routes-section">
        <div class="section-header">
            <h2>Find Stays by Travel Theme</h2>
            <p>Curated recommendations tailored for every type of traveler</p>
        </div>

        <div class="category-tabs">
            <button class="tab-btn active" onclick="switchTab(event, 'romantic')">Romantic Getaways</button>
            <button class="tab-btn" onclick="switchTab(event, 'family')">Family Fun</button>
            <button class="tab-btn" onclick="switchTab(event, 'foodie')">Foodie Escapes</button>
        </div>

        <div id="tab-romantic" class="tab-content active">
            <div class="theme-grid">
                <a href="detail.php?id=801" class="theme-card">
                    <i class="fa-solid fa-heart"></i>
                    <div>
                        <h4>The Banjaran Hotsprings (Ipoh)</h4>
                        <p>Private geothermal hot spring villas surrounded by nature.</p>
                    </div>
                </a>
                <a href="detail.php?id=401" class="theme-card">
                    <i class="fa-solid fa-water"></i>
                    <div>
                        <h4>Casa del Rio (Melaka)</h4>
                        <p>Luxury Mediterranean vibes right on the Melaka River.</p>
                    </div>
                </a>
                <a href="detail.php?id=802" class="theme-card">
                    <i class="fa-solid fa-umbrella-beach"></i>
                    <div>
                        <h4>Pangkor Laut Resort</h4>
                        <p>One island, one luxury resort experience.</p>
                    </div>
                </a>
            </div>
        </div>

        <div id="tab-family" class="tab-content">
            <div class="theme-grid">
                <a href="detail.php?id=201" class="theme-card">
                    <i class="fa-solid fa-gamepad"></i>
                    <div>
                        <h4>Legoland Hotel (Johor)</h4>
                        <p>Interactive themed rooms with treasure hunts for kids.</p>
                    </div>
                </a>
                <a href="detail.php?id=301" class="theme-card">
                    <i class="fa-solid fa-person-swimming"></i>
                    <div>
                        <h4>Sunway Resort (Selangor)</h4>
                        <p>Direct access to Sunway Lagoon Theme Park.</p>
                    </div>
                </a>
                <a href="detail.php?id=205" class="theme-card">
                    <i class="fa-solid fa-guitar"></i>
                    <div>
                        <h4>Hard Rock Hotel (Desaru)</h4>
                        <p>Waterpark access with fun rock & roll family suites.</p>
                    </div>
                </a>
            </div>
        </div>

        <div id="tab-foodie" class="tab-content">
            <div class="theme-grid">
                <a href="detail.php?id=101" class="theme-card">
                    <i class="fa-solid fa-utensils"></i>
                    <div>
                        <h4>E&O Hotel (Penang)</h4>
                        <p>3-minute walk to Penang’s top hawker stalls and nightlife.</p>
                    </div>
                </a>
                <a href="detail.php?id=803" class="theme-card">
                    <i class="fa-solid fa-bowl-food"></i>
                    <div>
                        <h4>WEIL Hotel (Ipoh)</h4>
                        <p>Connected to Ipoh’s famous dim sum & bean sprout chicken district.</p>
                    </div>
                </a>
                <a href="detail.php?id=506" class="theme-card">
                    <i class="fa-solid fa-store"></i>
                    <div>
                        <h4>Horizon Hotel (Kota Kinabalu)</h4>
                        <p>Located right on Gaya Street Sunday Night Market.</p>
                    </div>
                </a>
            </div>
        </div>
    </section>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);

        const formatDate = (date) => date.toISOString().split('T')[0];
        const checkInInput = document.getElementById('check_in');
        const checkOutInput = document.getElementById('check_out');

        if (checkInInput && checkOutInput) {
            checkInInput.min = formatDate(today);
            checkInInput.value = formatDate(today);
            checkOutInput.min = formatDate(tomorrow);
            checkOutInput.value = formatDate(tomorrow);

            checkInInput.addEventListener('change', function () {
                const selectedInDate = new Date(this.value);
                const nextDay = new Date(selectedInDate);
                nextDay.setDate(nextDay.getDate() + 1);
                checkOutInput.min = formatDate(nextDay);
                if (new Date(checkOutInput.value) <= selectedInDate) {
                    checkOutInput.value = formatDate(nextDay);
                }
            });
        }
    });

    let guestCounts = { adults: 2, children: 0, rooms: 1 };

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

    function switchTab(evt, tabName) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
        document.getElementById('tab-' + tabName).classList.add('active');
        if (evt && evt.currentTarget) {
            evt.currentTarget.classList.add('active');
        }
    }
</script>





<?php 
// 1. 开启自动弹窗
$loginPopupAutoShow = true; 
// 2. 引入同一目录下的弹窗文件
include 'login_popup.php'; 
?>

<?php include __DIR__ . '/../footer.php'; ?>