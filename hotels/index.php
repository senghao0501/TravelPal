<?php include '../header.php'; ?>
<link rel="stylesheet" href="../css/modules/hotels.css">

<!-- 1. Hero & Hotel Search Box -->
<section class="hero-section">
    <div class="hero-content">
        <h1>Find Your Perfect Stay in Malaysia</h1>
        <p>From heritage mansions in Penang to overwater villas in Sabah</p>
    </div>

    <div class="search-container">
        <!-- Hotel Vibe Quick Filters -->
        <div class="vibe-tags">
            <span class="vibe-pill active"><i class="fa-solid fa-compass"></i> All Stays</span>
            <span class="vibe-pill"><i class="fa-solid fa-umbrella-beach"></i> Beach Resorts</span>
            <span class="vibe-pill"><i class="fa-solid fa-landmark"></i> Heritage</span>
            <span class="vibe-pill"><i class="fa-solid fa-mountain"></i> Highlands</span>
            <span class="vibe-pill"><i class="fa-solid fa-hot-tub-person"></i> Hot Springs</span>
        </div>

        <!-- Filter Bar -->
        <form action="after_search.php" method="GET" class="filter-bar">
            <!-- Destination State Dropdown -->
            <div class="input-group">
                <i class="fa-solid fa-location-dot icon"></i>
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

            <!-- Check-in Date -->
            <div class="input-group">
                <i class="fa-solid fa-calendar-check icon"></i>
                <div class="input-wrapper">
                    <label>Check-in Date</label>
                    <input type="date" name="check_in" id="check_in" required>
                </div>
            </div>

            <!-- Check-out Date -->
            <div class="input-group">
                <i class="fa-solid fa-calendar-minus icon"></i>
                <div class="input-wrapper">
                    <label>Check-out Date</label>
                    <input type="date" name="check_out" id="check_out" required>
                </div>
            </div>

            <!-- Guests & Rooms Custom Counter Dropdown -->
            <div class="input-group guest-selector-group">
                <i class="fa-solid fa-user-group icon"></i>
                <div class="input-wrapper" id="guestInputTrigger">
                    <label>Guests & Rooms</label>
                    <div class="guest-display-text" id="guestSummary">2 Adults, 0 Children, 1 Room</div>
                </div>

                <!-- 表单提交隐藏域 -->
                <input type="hidden" name="adults" id="input_adults" value="2">
                <input type="hidden" name="children" id="input_children" value="0">
                <input type="hidden" name="rooms" id="input_rooms" value="1">

                <!-- 弹出加减选择面板 -->
                <div class="guest-picker-dropdown" id="guestDropdown" style="display: none;">
                    <!-- Adults Row -->
                    <div class="picker-row">
                        <div class="picker-info">
                            <span class="picker-title">Adults</span>
                            <span class="picker-subtitle">Ages 13+</span>
                        </div>
                        <div class="counter-controls">
                            <button type="button" class="btn-counter" onclick="updateGuest('adults', -1)">-</button>
                            <span class="counter-value" id="cnt_adults">2</span>
                            <button type="button" class="btn-counter" onclick="updateGuest('adults', 1)">+</button>
                        </div>
                    </div>

                    <!-- Children Row -->
                    <div class="picker-row">
                        <div class="picker-info">
                            <span class="picker-title">Children</span>
                            <span class="picker-subtitle">Ages 0 - 12</span>
                        </div>
                        <div class="counter-controls">
                            <button type="button" class="btn-counter" onclick="updateGuest('children', -1)">-</button>
                            <span class="counter-value" id="cnt_children">0</span>
                            <button type="button" class="btn-counter" onclick="updateGuest('children', 1)">+</button>
                        </div>
                    </div>

                    <!-- Rooms Row -->
                    <div class="picker-row">
                        <div class="picker-info">
                            <span class="picker-title">Rooms</span>
                            <span class="picker-subtitle">Number of rooms</span>
                        </div>
                        <div class="counter-controls">
                            <button type="button" class="btn-counter" onclick="updateGuest('rooms', -1)">-</button>
                            <span class="counter-value" id="cnt_rooms">1</span>
                            <button type="button" class="btn-counter" onclick="updateGuest('rooms', 1)">+</button>
                        </div>
                    </div>

                    <button type="button" class="btn-picker-done" onclick="closeGuestDropdown()">Done</button>
                </div>
            </div>

            <!-- Search Button -->
            <button type="submit" class="btn-search">
                <i class="fa-solid fa-magnifying-glass"></i> Search Hotels
            </button>
        </form>
    </div>
</section>

<main class="main-content">
    <!-- 2. Property Types Grid -->
    <section class="property-types-section">
        <div class="section-header">
            <h2>Browse by Property Type</h2>
            <p>Find the style of accommodation that suits your journey</p>
        </div>

        <div class="property-grid">
            <a href="after_search.php?type=Luxury+Resort" class="property-card">
                <div class="property-icon"><i class="fa-solid fa-hotel"></i></div>
                <h3>Luxury Resorts</h3>
                <p>5-Star beachfront & island retreats</p>
            </a>
            <a href="after_search.php?type=City+Hotel" class="property-card">
                <div class="property-icon"><i class="fa-solid fa-city"></i></div>
                <h3>City Hotels</h3>
                <p>Prime locations near top malls & food</p>
            </a>
            <a href="after_search.php?type=Heritage+Boutique" class="property-card">
                <div class="property-icon"><i class="fa-solid fa-house-chimney-window"></i></div>
                <h3>Heritage Boutiques</h3>
                <p>Colonial architecture & local culture</p>
            </a>
            <a href="after_search.php?type=Nature+Eco+Lodge" class="property-card">
                <div class="property-icon"><i class="fa-solid fa-tree"></i></div>
                <h3>Nature & Eco Lodges</h3>
                <p>Highland escapes & rainforest villas</p>
            </a>
        </div>
    </section>

    <!-- 3. Member Exclusive Banner -->
    <section class="account-prompt-card">
        <div class="prompt-icon">
            <i class="fa-solid fa-gem"></i>
        </div>
        <div class="prompt-text">
            <h3>Save 15% or More on Staycations</h3>
            <p>Sign in to unlock Member Secret Prices, free room upgrades, and late check-outs.</p>
        </div>
        <div class="prompt-buttons">
            <a href="../auth/login.php" class="btn-accent">Sign In</a>
            <a href="../auth/register.php" class="btn-outline">Register Free</a>
        </div>
    </section>

    <!-- 4. Destination Showcase -->
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
                    <h3>Penang</h3>
                    <p>8 Hotels • Heritage & Beachfront</p>
                </div>
            </a>
            <a href="after_search.php?query=Sabah" class="gallery-card">
                <img src="https://images.unsplash.com/photo-1540541338287-41700207dee6?w=500&q=80" alt="Sabah">
                <span class="price-badge">From RM 230 / night</span>
                <div class="gallery-overlay">
                    <h3>Sabah</h3>
                    <p>8 Hotels • Island Resorts & Diving</p>
                </div>
            </a>
            <a href="after_search.php?query=Perak" class="gallery-card">
                <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=500&q=80" alt="Perak">
                <span class="price-badge">From RM 170 / night</span>
                <div class="gallery-overlay">
                    <h3>Perak</h3>
                    <p>8 Hotels • Hot Springs & Foodie Stays</p>
                </div>
            </a>
            <a href="after_search.php?query=Pahang" class="gallery-card">
                <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?w=500&q=80" alt="Pahang">
                <span class="price-badge">From RM 220 / night</span>
                <div class="gallery-overlay">
                    <h3>Pahang</h3>
                    <p>8 Hotels • Cameron Highlands & Genting</p>
                </div>
            </a>
            <a href="after_search.php?query=Melaka" class="gallery-card">
                <img src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=500&q=80" alt="Melaka">
                <span class="price-badge">From RM 60 / night</span>
                <div class="gallery-overlay">
                    <h3>Melaka</h3>
                    <p>8 Hotels • Riverfront & Jonker Walk</p>
                </div>
            </a>
            <a href="after_search.php?query=Johor" class="gallery-card">
                <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=500&q=80" alt="Johor">
                <span class="price-badge">From RM 220 / night</span>
                <div class="gallery-overlay">
                    <h3>Johor</h3>
                    <p>8 Hotels • Desaru Coast & Legoland</p>
                </div>
            </a>
        </div>
    </section>

    <!-- 5. Feature Highlights -->
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

    <!-- 6. Travel Theme Dynamic Tabs -->
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

        <!-- Content 1: Romantic -->
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

        <!-- Content 2: Family -->
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

        <!-- Content 3: Foodie -->
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
    // 1. 日期自动设置
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

    // 2. 加减控制逻辑
    let guestCounts = { adults: 2, children: 0, rooms: 1 };

    function updateGuest(type, change) {
        let minLimit = (type === 'children') ? 0 : 1;
        let maxLimit = 10;

        if (guestCounts[type] + change >= minLimit && guestCounts[type] + change <= maxLimit) {
            guestCounts[type] += change;
            document.getElementById('cnt_' + type).innerText = guestCounts[type];
            document.getElementById('input_' + type).value = guestCounts[type];
            updateGuestSummary();
        }
    }

    function updateGuestSummary() {
        let adultText = guestCounts.adults + (guestCounts.adults > 1 ? ' Adults' : ' Adult');
        let childText = guestCounts.children + (guestCounts.children === 1 ? ' Child' : ' Children');
        let roomText = guestCounts.rooms + (guestCounts.rooms > 1 ? ' Rooms' : ' Room');

        document.getElementById('guestSummary').innerText = `${adultText}, ${childText}, ${roomText}`;
    }

    // 3. 点击切换显示/隐藏面板
    const guestTrigger = document.getElementById('guestInputTrigger');
    const guestDropdown = document.getElementById('guestDropdown');

    if (guestTrigger && guestDropdown) {
        guestTrigger.addEventListener('click', function (e) {
            e.stopPropagation();
            if (guestDropdown.style.display === 'none' || guestDropdown.style.display === '') {
                guestDropdown.style.display = 'block';
            } else {
                guestDropdown.style.display = 'none';
            }
        });

        document.addEventListener('click', function (e) {
            if (!guestDropdown.contains(e.target) && !guestTrigger.contains(e.target)) {
                guestDropdown.style.display = 'none';
            }
        });
    }

    function closeGuestDropdown() {
        if (guestDropdown) {
            guestDropdown.style.display = 'none';
        }
    }

    // 4. Tab 切换
    function switchTab(evt, tabName) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));

        document.getElementById('tab-' + tabName).classList.add('active');
        if (evt && evt.currentTarget) {
            evt.currentTarget.classList.add('active');
        }
    }

    // 5. Vibe Pills 点击跳转支持
    document.querySelectorAll('.vibe-pill').forEach(pill => {
        pill.addEventListener('click', function() {
            document.querySelectorAll('.vibe-pill').forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            
            const vibeText = this.innerText.trim();
            if (vibeText !== 'All Stays') {
                window.location.href = 'after_search.php?vibe=' + encodeURIComponent(vibeText);
            }
        });
    });
</script>
<?php include __DIR__ . '/../footer.php'; ?>
