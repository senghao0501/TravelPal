<?php include '../header.php'; ?>
<link rel="stylesheet" href="../css/modules/flights.css">

<!-- 1. Hero & Domestic Search Filter Bar -->
<section class="hero-section">
    <div class="hero-content">
        <h1>Explore Domestic Flights Across Malaysia</h1>
        <p>Seamless flight bookings between Selangor, Penang, Sabah, Sarawak, and more.</p>
    </div>

    <div class="search-container">
        <!-- Trip Type Selector -->
        <div class="trip-type-selector">
            <label class="radio-label">
                <input type="radio" name="trip_type" value="round_trip" checked>
                <span class="custom-radio"></span> Round-trip
            </label>
            <label class="radio-label">
                <input type="radio" name="trip_type" value="one_way">
                <span class="custom-radio"></span> One-way
            </label>
        </div>

        <!-- Filter Bar -->
        <form action="#" method="GET" class="filter-bar">
            <!-- Departure (Origin Dropdown) -->
            <div class="input-group">
                <i class="fa-solid fa-plane-departure icon"></i>
                <div class="input-wrapper">
                    <label>From (Origin)</label>
                    <select name="origin" required>
                        <option value="KUL">Selangor (KUL / SZB)</option>
                        <option value="JHB">Johor (JHB)</option>
                        <option value="MKZ">Melaka (MKZ)</option>
                        <option value="IPH">Perak (IPH)</option>
                        <option value="PEN">Penang (PEN)</option>
                        <option value="PKG">Pahang (PKG - Tioman)</option>
                        <option value="BKI">Sabah (BKI / SDK / TWU)</option>
                        <option value="KCH">Sarawak (KCH / MYY / BTU)</option>
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
                        <option value="PEN" selected>Penang (PEN)</option>
                        <option value="KUL">Selangor (KUL / SZB)</option>
                        <option value="JHB">Johor (JHB)</option>
                        <option value="MKZ">Melaka (MKZ)</option>
                        <option value="IPH">Perak (IPH)</option>
                        <option value="PKG">Pahang (PKG - Tioman)</option>
                        <option value="BKI">Sabah (BKI / SDK / TWU)</option>
                        <option value="KCH">Sarawak (KCH / MYY / BTU)</option>
                    </select>
                </div>
            </div>

            <!-- Passengers -->
            <div class="input-group">
                <i class="fa-solid fa-user icon"></i>
                <div class="input-wrapper">
                    <label>Passengers</label>
                    <select name="passengers">
                        <option value="1">1 Adult, Economy</option>
                        <option value="2">2 Adults, Economy</option>
                        <option value="3">3 Adults, Economy</option>
                        <option value="4">Family (2+2)</option>
                    </select>
                </div>
            </div>

            <!-- Search Button -->
            <button type="submit" class="btn-search">
                <i class="fa-solid fa-magnifying-glass"></i> Search Flights
            </button>
        </form>
    </div>
</section>

<main class="main-content">
    <!-- 2. Visual Destination Gallery (已移动到会员提示框上方) -->
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
            <button class="tab-btn active" onclick="switchTab('routes')">Popular Routes</button>
            <button class="tab-btn" onclick="switchTab('cities')">Cities Covered</button>
            <button class="tab-btn" onclick="switchTab('airports')">Airports Served</button>
        </div>

        <!-- Content Container 1: Routes -->
        <div id="tab-routes" class="tab-content active">
            <div class="routes-grid">
                <a href="#" class="route-card">
                    <img src="https://images.unsplash.com/photo-1512100356356-de1b84283e18?auto=format&fit=crop&w=150&q=80" alt="Penang">
                    <div class="route-details">
                        <span class="city-pair">Selangor <i class="fa-solid fa-arrow-right"></i> Penang</span>
                        <span class="route-sub">Domestic • 0h 55m</span>
                    </div>
                </a>
                <a href="#" class="route-card">
                    <img src="https://images.unsplash.com/photo-1596422846543-75c6fc197f07?auto=format&fit=crop&w=150&q=80" alt="Sabah">
                    <div class="route-details">
                        <span class="city-pair">Selangor <i class="fa-solid fa-arrow-right"></i> Sabah</span>
                        <span class="route-sub">Domestic • 2h 35m</span>
                    </div>
                </a>
                <a href="#" class="route-card">
                    <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=150&q=80" alt="Sarawak">
                    <div class="route-details">
                        <span class="city-pair">Selangor <i class="fa-solid fa-arrow-right"></i> Sarawak</span>
                        <span class="route-sub">Domestic • 1h 45m</span>
                    </div>
                </a>
                <a href="#" class="route-card">
                    <img src="https://images.unsplash.com/photo-1525625293386-3f8f99389edd?auto=format&fit=crop&w=150&q=80" alt="Johor">
                    <div class="route-details">
                        <span class="city-pair">Penang <i class="fa-solid fa-arrow-right"></i> Johor</span>
                        <span class="route-sub">Domestic • 1h 10m</span>
                    </div>
                </a>
                <a href="#" class="route-card">
                    <img src="https://images.unsplash.com/photo-1508009603885-50cf7c579365?auto=format&fit=crop&w=150&q=80" alt="Perak">
                    <div class="route-details">
                        <span class="city-pair">Johor <i class="fa-solid fa-arrow-right"></i> Perak</span>
                        <span class="route-sub">Domestic • 1h 15m</span>
                    </div>
                </a>
                <a href="#" class="route-card">
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
</main>

<script>
    function switchTab(tabName) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));

        document.getElementById('tab-' + tabName).classList.add('active');
        event.currentTarget.classList.add('active');
    }
</script>