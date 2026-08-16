<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 引入逻辑配置文件与函数
require_once 'config.php';
require_once 'flights_data.php';
require_once 'api_functions.php';

// 接收搜索参数
$is_searched = isset($_GET['search_submitted']) && $_GET['search_submitted'] === '1';

$trip_type   = $_GET['trip_type'] ?? 'round_trip';
$origin      = $_GET['origin'] ?? 'KUL';
$destination = $_GET['destination'] ?? 'PEN';
$passengers  = $_GET['passengers'] ?? '1';
$sort        = $_GET['sort'] ?? 'recommended';
$depart_date = $_GET['depart_date'] ?? date('Y-m-d');

$filtered_flights = [];
$api_data_used = false;

if ($is_searched) {
    // 1. RapidAPI 实时查询
    $api_response = searchFlights($origin, $destination, $depart_date, intval($passengers));
    if ($api_response) {
        $parsed = parseAndStoreFlights($api_response, $origin, $destination, $depart_date);
        if (!empty($parsed)) {
            $filtered_flights = $parsed;
            $api_data_used = true;
        }
    }

    // 2. 本地数据库查询
    if (empty($filtered_flights)) {
        $filtered_flights = getFlightsByRoute($origin, $destination, $depart_date);
    }

    // 3. 全路线动态保底生成（确保不为空）
    if (empty($filtered_flights)) {
        $filtered_flights = getFallbackFlights($origin, $destination, $depart_date);
    }

    // 排序逻辑
    if ($sort === 'price_low') {
        usort($filtered_flights, fn($a, $b) => $a['price'] <=> $b['price']);
    } elseif ($sort === 'price_high') {
        usort($filtered_flights, fn($a, $b) => $b['price'] <=> $a['price']);
    } elseif ($sort === 'rating') {
        usort($filtered_flights, fn($a, $b) => ($b['rating'] ?? 0) <=> ($a['rating'] ?? 0));
    }
}

// 引入 header
include '../header.php'; 
?>

<!-- 模块专属样式表 -->
<link rel="stylesheet" href="../css/modules/flights.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- 1. Hero & Domestic Search Filter Bar -->
<section class="hero-section">
    <div class="hero-content">
        <h1>Explore Domestic Flights Across Malaysia</h1>
        <p>Seamless flight bookings between Selangor, Penang, Sabah, Sarawak, and more.</p>
    </div>

    <div class="search-container">
        <!-- 搜索表单提交至当前页面 -->
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">
            <input type="hidden" name="search_submitted" value="1">

            <!-- Trip Type Selector -->
            <div class="trip-type-selector">
                <label class="radio-label">
                    <input type="radio" name="trip_type" value="round_trip" <?php echo ($trip_type === 'round_trip') ? 'checked' : ''; ?>>
                    <span class="custom-radio"></span> Round-trip
                </label>
                <label class="radio-label">
                    <input type="radio" name="trip_type" value="one_way" <?php echo ($trip_type === 'one_way') ? 'checked' : ''; ?>>
                    <span class="custom-radio"></span> One-way
                </label>
            </div>

            <!-- Filter Bar -->
            <div class="filter-bar">
                <!-- Departure (Origin Dropdown) -->
                <div class="input-group">
                    <i class="fa-solid fa-plane-departure icon"></i>
                    <div class="input-wrapper">
                        <label>From (Origin)</label>
                        <select name="origin" required>
                            <option value="KUL" <?php echo ($origin === 'KUL') ? 'selected' : ''; ?>>Selangor (KUL / SZB)</option>
                            <option value="JHB" <?php echo ($origin === 'JHB') ? 'selected' : ''; ?>>Johor (JHB)</option>
                            <option value="MKZ" <?php echo ($origin === 'MKZ') ? 'selected' : ''; ?>>Melaka (MKZ)</option>
                            <option value="IPH" <?php echo ($origin === 'IPH') ? 'selected' : ''; ?>>Perak (IPH)</option>
                            <option value="PEN" <?php echo ($origin === 'PEN') ? 'selected' : ''; ?>>Penang (PEN)</option>
                            <option value="PKG" <?php echo ($origin === 'PKG') ? 'selected' : ''; ?>>Pahang (PKG - Tioman)</option>
                            <option value="BKI" <?php echo ($origin === 'BKI') ? 'selected' : ''; ?>>Sabah (BKI / SDK / TWU)</option>
                            <option value="KCH" <?php echo ($origin === 'KCH') ? 'selected' : ''; ?>>Sarawak (KCH / MYY / BTU)</option>
                        </select>
                    </div>
                </div>

                <div class="swap-icon">
                    <i class="fa-solid fa-arrow-right-arrow-left"></i>
                </div>

                <!-- Destination Dropdown -->
                <div class="input-group">
                    <i class="fa-solid fa-plane-arrival icon"></i>
                    <div class="input-wrapper">
                        <label>To (Destination)</label>
                        <select name="destination" required>
                            <option value="PEN" <?php echo ($destination === 'PEN') ? 'selected' : ''; ?>>Penang (PEN)</option>
                            <option value="KUL" <?php echo ($destination === 'KUL') ? 'selected' : ''; ?>>Selangor (KUL / SZB)</option>
                            <option value="JHB" <?php echo ($destination === 'JHB') ? 'selected' : ''; ?>>Johor (JHB)</option>
                            <option value="MKZ" <?php echo ($destination === 'MKZ') ? 'selected' : ''; ?>>Melaka (MKZ)</option>
                            <option value="IPH" <?php echo ($destination === 'IPH') ? 'selected' : ''; ?>>Perak (IPH)</option>
                            <option value="PKG" <?php echo ($destination === 'PKG') ? 'selected' : ''; ?>>Pahang (PKG - Tioman)</option>
                            <option value="BKI" <?php echo ($destination === 'BKI') ? 'selected' : ''; ?>>Sabah (BKI / SDK / TWU)</option>
                            <option value="KCH" <?php echo ($destination === 'KCH') ? 'selected' : ''; ?>>Sarawak (KCH / MYY / BTU)</option>
                        </select>
                    </div>
                </div>

                <!-- Date Selection -->
                <div class="input-group">
                    <i class="fa-solid fa-calendar icon"></i>
                    <div class="input-wrapper">
                        <label>Departure Date</label>
                        <input type="date" name="depart_date" value="<?php echo htmlspecialchars($depart_date); ?>" required>
                    </div>
                </div>

                <!-- Passengers -->
                <div class="input-group">
                    <i class="fa-solid fa-user icon"></i>
                    <div class="input-wrapper">
                        <label>Passengers</label>
                        <select name="passengers">
                            <option value="1" <?php echo ($passengers === '1') ? 'selected' : ''; ?>>1 Adult, Economy</option>
                            <option value="2" <?php echo ($passengers === '2') ? 'selected' : ''; ?>>2 Adults, Economy</option>
                            <option value="3" <?php echo ($passengers === '3') ? 'selected' : ''; ?>>3 Adults, Economy</option>
                            <option value="4" <?php echo ($passengers === '4') ? 'selected' : ''; ?>>Family (2+2)</option>
                        </select>
                    </div>
                </div>

                <!-- Search Button -->
                <button type="submit" class="btn-search">
                    <i class="fa-solid fa-magnifying-glass"></i> Search Flights
                </button>
            </div>
        </form>
    </div>
</section>

<main class="main-content">

    <?php if ($is_searched): ?>
        <!-- 只有在点击 Search 后显示：航班结果列表（采用 Hotel 风格的大卡片设计） -->
        <section class="search-results-section">
            <div class="search-results-header">
                <div>
                    <h2>Available Flights</h2>
                    <p>
                        Showing results for <strong><?php echo htmlspecialchars($origin); ?></strong> to <strong><?php echo htmlspecialchars($destination); ?></strong> on <strong><?php echo htmlspecialchars($depart_date); ?></strong>
                        <?php if ($api_data_used): ?>
                            <span class="live-api-tag"><i class="fa-solid fa-bolt"></i> Live API Data</span>
                        <?php endif; ?>
                    </p>
                </div>

                <!-- 排序表单 -->
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET" class="sort-form">
                    <input type="hidden" name="search_submitted" value="1">
                    <input type="hidden" name="origin" value="<?php echo htmlspecialchars($origin); ?>">
                    <input type="hidden" name="destination" value="<?php echo htmlspecialchars($destination); ?>">
                    <input type="hidden" name="depart_date" value="<?php echo htmlspecialchars($depart_date); ?>">
                    <input type="hidden" name="passengers" value="<?php echo htmlspecialchars($passengers); ?>">
                    <label>Sort by:</label>
                    <select name="sort" onchange="this.form.submit()">
                        <option value="recommended" <?php echo ($sort === 'recommended') ? 'selected' : ''; ?>>Recommended</option>
                        <option value="price_low" <?php echo ($sort === 'price_low') ? 'selected' : ''; ?>>Price: Low to High</option>
                        <option value="price_high" <?php echo ($sort === 'price_high') ? 'selected' : ''; ?>>Price: High to Low</option>
                        <option value="rating" <?php echo ($sort === 'rating') ? 'selected' : ''; ?>>Highest Rated</option>
                    </select>
                </form>
            </div>

            <!-- 大版面 Hotel 风格航班列表 -->
            <div class="flight-list">
                <?php foreach ($filtered_flights as $flight): 
                    $fId    = $flight['id'] ?? $flight->id;
                    $airline= $flight['airline'] ?? $flight->airline;
                    $fNo    = $flight['flight_no'] ?? $flight->flight_no;
                    $from   = $flight['from_state'] ?? $flight->from_state;
                    $fromC  = $flight['from_code'] ?? $flight->from_code;
                    $to     = $flight['to_state'] ?? $flight->to_state;
                    $toC    = $flight['to_code'] ?? $flight->to_code;
                    $depTime= $flight['departure_time'] ?? $flight->departure_time;
                    $arrTime= $flight['arrival_time'] ?? $flight->arrival_time ?? 'N/A';
                    $dur    = $flight['duration'] ?? $flight->duration ?? '1h 10m';
                    $price  = $flight['price'] ?? $flight->price;
                    $logo   = $flight['logo_url'] ?? $flight['logo'] ?? 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=800&q=80';
                    $stops  = $flight['stops'] ?? 0;
                    
                    $link = "detail.php?id={$fId}&passengers={$passengers}&depart_date={$depart_date}";
                ?>
                    <div class="flight-item-card hotel-style-card">
                        <!-- 左侧/中间：航空公司信息与详细航程路线图 -->
                        <div class="flight-card-main">
                            <!-- 航空公司 Logo 与 描述 -->
                            <div class="airline-brand-box">
                                <img src="<?php echo htmlspecialchars($logo); ?>" alt="Airline Logo">
                                <div class="airline-info">
                                    <h3><?php echo htmlspecialchars($airline); ?></h3>
                                    <div class="airline-tags">
                                        <span class="badge badge-code"><?php echo htmlspecialchars($fNo); ?></span>
                                        <span class="badge badge-type"><?php echo $stops == 0 ? 'Direct Flight' : "{$stops} Stop"; ?></span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- 类似酒店入住/退房样式的航程时间图 -->
                            <div class="flight-route-timeline">
                                <div class="time-block origin">
                                    <span class="time"><?php echo htmlspecialchars($depTime); ?></span>
                                    <span class="code"><?php echo htmlspecialchars($fromC); ?></span>
                                    <span class="city"><?php echo htmlspecialchars($from); ?></span>
                                </div>

                                <div class="duration-block">
                                    <span class="duration-text"><i class="fa-regular fa-clock"></i> <?php echo htmlspecialchars($dur); ?></span>
                                    <div class="route-line">
                                        <span class="dot"></span>
                                        <span class="line"></span>
                                        <i class="fa-solid fa-plane plane-icon"></i>
                                        <span class="line"></span>
                                        <span class="dot"></span>
                                    </div>
                                    <span class="route-type"><?php echo $stops == 0 ? 'Non-stop' : 'Connecting'; ?></span>
                                </div>

                                <div class="time-block destination">
                                    <span class="time"><?php echo htmlspecialchars($arrTime); ?></span>
                                    <span class="code"><?php echo htmlspecialchars($toC); ?></span>
                                    <span class="city"><?php echo htmlspecialchars($to); ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- 右侧：类似 Hotel 酒店预订区域的大尺寸价格与 CTA 按钮 -->
                        <div class="flight-card-side">
                            <div class="price-box">
                                <span class="price-label">Price per adult</span>
                                <div class="price-amount">RM <?php echo number_format($price, 2); ?></div>
                                <span class="price-sub">Includes taxes & fees</span>
                            </div>
                            <a href="<?php echo $link; ?>" class="btn-select-flight">
                                Select Flight <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

    <?php else: ?>
        <!-- 未点击 Search 时：展示原有首页模块 -->
        
        <!-- 2. Visual Destination Gallery -->
        <section class="gallery-section">
            <div class="section-header">
                <h2>Explore Malaysia’s Top Destinations</h2>
                <p>You are just a flight away from discovering Malaysia’s stunning beauty</p>
            </div>

            <div class="gallery-grid">
                <div class="gallery-card">
                    <img src="https://images.unsplash.com/photo-1596422846543-75c6fc197f07?auto=format&fit=crop&w=500&q=80" alt="Sabah">
                    <div class="gallery-overlay">
                        <h3>Sabah</h3>
                        <p>Mount Kinabalu & Islands</p>
                    </div>
                </div>
                <div class="gallery-card">
                    <img src="https://images.unsplash.com/photo-1512100356356-de1b84283e18?auto=format&fit=crop&w=500&q=80" alt="Penang">
                    <div class="gallery-overlay">
                        <h3>Penang</h3>
                        <p>Heritage & Street Food</p>
                    </div>
                </div>
                <div class="gallery-card">
                    <img src="https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?auto=format&fit=crop&w=500&q=80" alt="Selangor">
                    <div class="gallery-overlay">
                        <h3>Selangor</h3>
                        <p>Batu Caves & Modern Skyline</p>
                    </div>
                </div>
                <div class="gallery-card">
                    <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=500&q=80" alt="Sarawak">
                    <div class="gallery-overlay">
                        <h3>Sarawak</h3>
                        <p>Rainforests & Culture</p>
                    </div>
                </div>
                <div class="gallery-card">
                    <img src="https://images.unsplash.com/photo-1508009603885-50cf7c579365?auto=format&fit=crop&w=500&q=80" alt="Melaka">
                    <div class="gallery-overlay">
                        <h3>Melaka</h3>
                        <p>Historic Architecture</p>
                    </div>
                </div>
                <div class="gallery-card">
                    <img src="https://images.unsplash.com/photo-1525625293386-3f8f99389edd?auto=format&fit=crop&w=500&q=80" alt="Perak">
                    <div class="gallery-overlay">
                        <h3>Perak (Ipoh)</h3>
                        <p>Limestone Caves & Cuisine</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. Sign In Prompt Bar -->
        <section class="account-prompt-card">
            <div class="prompt-icon">
                <i class="fa-solid fa-passport"></i>
            </div>
            <div class="prompt-text">
                <h3>Unlock Exclusive Member Rates</h3>
                <p>Sign in to earn rewards, save domestic itineraries, and speed up checkout.</p>
            </div>
            <div class="prompt-buttons">
                <a href="#" class="btn-accent">Sign In</a>
                <a href="#" class="btn-outline">Create Account</a>
            </div>
        </section>

        <!-- 4. Feature Highlights -->
        <section class="features-section">
            <div class="feature-item">
                <div class="feature-icon-wrapper">
                    <i class="fa-solid fa-compass-drafting"></i>
                </div>
                <div class="feature-info">
                    <h4>100% Domestic Coverage</h4>
                    <p>Connecting all major states and regional airports in Malaysia.</p>
                </div>
            </div>

            <div class="feature-item">
                <div class="feature-icon-wrapper">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div class="feature-info">
                    <h4>Transparent Rates</h4>
                    <p>No hidden charges. Clear price breakdowns for state-to-state travel.</p>
                </div>
            </div>

            <div class="feature-item">
                <div class="feature-icon-wrapper">
                    <i class="fa-solid fa-sliders"></i>
                </div>
                <div class="feature-info">
                    <h4>Flexible Rescheduling</h4>
                    <p>Easy modification options for local airlines like AirAsia, MAS, & Firefly.</p>
                </div>
            </div>
        </section>

        <!-- 5. Popular Domestic Routes with Tab Switching -->
        <section class="routes-section">
            <div class="section-header">
                <h2>Popular Domestic Flight Routes</h2>
                <p>Direct routes connecting key states across East & West Malaysia</p>
            </div>

            <!-- Filter Category Tabs -->
            <div class="category-tabs">
                <button class="tab-btn active" onclick="switchTab('routes', event)">Popular Routes</button>
                <button class="tab-btn" onclick="switchTab('cities', event)">Cities Covered</button>
                <button class="tab-btn" onclick="switchTab('airports', event)">Airports Served</button>
            </div>

            <!-- Content Container 1: Routes -->
            <div id="tab-routes" class="tab-content active">
                <div class="routes-grid">
                    <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?search_submitted=1&origin=KUL&destination=PEN" class="route-card">
                        <img src="https://images.unsplash.com/photo-1512100356356-de1b84283e18?auto=format&fit=crop&w=150&q=80" alt="Penang">
                        <div class="route-details">
                            <span class="city-pair">Selangor <i class="fa-solid fa-arrow-right"></i> Penang</span>
                            <span class="route-sub">Domestic • 0h 55m</span>
                        </div>
                    </a>
                    <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?search_submitted=1&origin=KUL&destination=BKI" class="route-card">
                        <img src="https://images.unsplash.com/photo-1596422846543-75c6fc197f07?auto=format&fit=crop&w=150&q=80" alt="Sabah">
                        <div class="route-details">
                            <span class="city-pair">Selangor <i class="fa-solid fa-arrow-right"></i> Sabah</span>
                            <span class="route-sub">Domestic • 2h 35m</span>
                        </div>
                    </a>
                    <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?search_submitted=1&origin=KUL&destination=KCH" class="route-card">
                        <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=150&q=80" alt="Sarawak">
                        <div class="route-details">
                            <span class="city-pair">Selangor <i class="fa-solid fa-arrow-right"></i> Sarawak</span>
                            <span class="route-sub">Domestic • 1h 45m</span>
                        </div>
                    </a>
                    <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?search_submitted=1&origin=PEN&destination=JHB" class="route-card">
                        <img src="https://images.unsplash.com/photo-1525625293386-3f8f99389edd?auto=format&fit=crop&w=150&q=80" alt="Johor">
                        <div class="route-details">
                            <span class="city-pair">Penang <i class="fa-solid fa-arrow-right"></i> Johor</span>
                            <span class="route-sub">Domestic • 1h 10m</span>
                        </div>
                    </a>
                    <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?search_submitted=1&origin=JHB&destination=IPH" class="route-card">
                        <img src="https://images.unsplash.com/photo-1508009603885-50cf7c579365?auto=format&fit=crop&w=150&q=80" alt="Perak">
                        <div class="route-details">
                            <span class="city-pair">Johor <i class="fa-solid fa-arrow-right"></i> Perak</span>
                            <span class="route-sub">Domestic • 1h 15m</span>
                        </div>
                    </a>
                    <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?search_submitted=1&origin=KUL&destination=PKG" class="route-card">
                        <img src="https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?auto=format&fit=crop&w=150&q=80" alt="Pahang">
                        <div class="route-details">
                            <span class="city-pair">Selangor <i class="fa-solid fa-arrow-right"></i> Pahang</span>
                            <span class="route-sub">Domestic • 0h 45m</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Content Container 2: Cities Covered -->
            <div id="tab-cities" class="tab-content">
                <div class="simple-list-grid">
                    <div class="list-item"><i class="fa-solid fa-city"></i> Kuala Lumpur / Subang (Selangor)</div>
                    <div class="list-item"><i class="fa-solid fa-city"></i> George Town (Penang)</div>
                    <div class="list-item"><i class="fa-solid fa-city"></i> Johor Bahru (Johor)</div>
                    <div class="list-item"><i class="fa-solid fa-city"></i> Kota Kinabalu (Sabah)</div>
                    <div class="list-item"><i class="fa-solid fa-city"></i> Kuching (Sarawak)</div>
                    <div class="list-item"><i class="fa-solid fa-city"></i> Ipoh (Perak)</div>
                    <div class="list-item"><i class="fa-solid fa-city"></i> Malacca City (Melaka)</div>
                    <div class="list-item"><i class="fa-solid fa-city"></i> Kuantan / Tioman (Pahang)</div>
                </div>
            </div>

            <!-- Content Container 3: Airports Served -->
            <div id="tab-airports" class="tab-content">
                <div class="simple-list-grid">
                    <div class="list-item"><i class="fa-solid fa-plane"></i> KLIA / Subang Airport (KUL/SZB)</div>
                    <div class="list-item"><i class="fa-solid fa-plane"></i> Penang International Airport (PEN)</div>
                    <div class="list-item"><i class="fa-solid fa-plane"></i> Senai International Airport (JHB)</div>
                    <div class="list-item"><i class="fa-solid fa-plane"></i> Kota Kinabalu Airport (BKI)</div>
                    <div class="list-item"><i class="fa-solid fa-plane"></i> Kuching International Airport (KCH)</div>
                    <div class="list-item"><i class="fa-solid fa-plane"></i> Sultan Azlan Shah Airport (IPH)</div>
                    <div class="list-item"><i class="fa-solid fa-plane"></i> Melaka Airport (MKZ)</div>
                    <div class="list-item"><i class="fa-solid fa-plane"></i> Tioman Island Airport (PKG)</div>
                </div>
            </div>

            <p class="disclaimer-text">*Fares subject to availability. Flights exclusive to Malaysian domestic destinations.</p>
        </section>
    <?php endif; ?>
</main>

<script>
    function switchTab(tabName, evt) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));

        document.getElementById('tab-' + tabName).classList.add('active');
        if(evt && evt.currentTarget) {
            evt.currentTarget.classList.add('active');
        }
    }
</script>

<?php 
// 引入 footer
if (file_exists('../footer.php')) {
    include '../footer.php';
} elseif (file_exists('../includes/footer.php')) {
    include '../includes/footer.php';
}
?>