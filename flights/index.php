<?php include '../header.php'; ?>
<link rel="stylesheet" href="../css/modules/flights.css">
<link rel="stylesheet" href="../css/modules/model.css">

<main class="flights-page">

    <!-- 1. English Airbnb-Style Floating Search Bar -->
    <section class="search-hero-container" id="searchHero">
        <div class="airbnb-search-bar" id="airbnbSearchBar">
            
            <!-- Destination Field -->
            <div class="search-segment destination-trigger" onclick="toggleDropdown('destDropdown')">
                <span class="label">✈️ Where</span>
                <span class="value" id="selectedDest">Search destinations</span>
                
                <div class="airbnb-dropdown dest-dropdown" id="destDropdown">
                    <div class="dropdown-title">Popular Flight Routes</div>
                    <a href="../destinations/malaysia.php" class="dest-item">
                        <div class="icon-box">🇲🇾</div>
                        <div><strong>Malaysia</strong><span>KUL - Kuala Lumpur / Penang / Sabah</span></div>
                    </a>
                    <a href="../destinations/thailand.php" class="dest-item">
                        <div class="icon-box">🇹🇭</div>
                        <div><strong>Thailand</strong><span>BKK - Bangkok / Phuket / Chiang Mai</span></div>
                    </a>
                    <a href="../destinations/indonesia.php" class="dest-item">
                        <div class="icon-box">🇮🇩</div>
                        <div><strong>Indonesia</strong><span>DPS - Bali / Jakarta / Lombok</span></div>
                    </a>
                    <a href="../destinations/vietnam.php" class="dest-item">
                        <div class="icon-box">🇻🇳</div>
                        <div><strong>Vietnam</strong><span>DAD - Da Nang / Hanoi / Ho Chi Minh</span></div>
                    </a>
                </div>
            </div>

            <div class="divider"></div>

            <!-- Date Field -->
            <div class="search-segment" onclick="toggleDropdown('dateDropdown')">
                <span class="label">📅 Dates</span>
                <span class="value">Add departure date</span>

                <div class="airbnb-dropdown date-dropdown" id="dateDropdown" onclick="event.stopPropagation()">
                    <div class="picker-tabs">
                        <span class="active">Exact Dates</span>
                        <span>Flexible Dates</span>
                    </div>
                    <div class="dummy-calendar">
                        <div class="cal-month">
                            <h4>August 2026</h4>
                            <div class="cal-days">
                                <span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span>
                                <span>8</span><span class="sel">9</span><span>10</span><span>11</span><span>12</span><span>13</span><span>14</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <!-- Guests Field -->
            <div class="search-segment" onclick="toggleDropdown('guestDropdown')">
                <span class="label">👤 Passengers</span>
                <span class="value">Add passengers</span>

                <div class="airbnb-dropdown guest-dropdown" id="guestDropdown" onclick="event.stopPropagation()">
                    <div class="guest-row">
                        <div><strong>Adults</strong><span>Age 13+</span></div>
                        <div class="counter"><span>-</span> 1 <span>+</span></div>
                    </div>
                    <div class="guest-row">
                        <div><strong>Children</strong><span>Ages 2-12</span></div>
                        <div class="counter"><span>-</span> 0 <span>+</span></div>
                    </div>
                </div>
            </div>

            <!-- Search Button -->
            <button class="search-btn" aria-label="Search Flights">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
            </button>
        </div>
    </section>

    <!-- Ticker Info Bar -->
    <div class="flight-ticker">
        <span>✈️ DIRECT FLIGHTS FROM MALAYSIA • DAILY REAL-TIME FARES UPDATED</span>
    </div>


    <!-- 2. Magazine Editorial Layout -->
    <div class="magazine-container">

        <!-- ISSUE 01: MALAYSIA -->
        <section class="magazine-issue">
            <div class="editorial-header">
                <div class="issue-meta">
                    <span class="issue-tag">POPULAR ROUTES — MALAYSIA</span>
                    <span class="flight-route-badge">✈️ FLY FROM MALAYSIA</span>
                </div>
                <h2 class="editorial-title">EXPLORE<br>MALAYSIA</h2>
                <div class="editorial-line"></div>
            </div>

            <div class="magazine-layout">
                <!-- Main Featured Hero Card -->
                <a href="../destinations/malaysia.php" class="hero-card">
                    <button class="fav-btn" title="Save to Favorites" onclick="toggleFav(event, this)">
                        <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    </button>
                    <div class="hero-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1596422846543-75c6fc197f07?w=1200&auto=format&fit=crop" alt="Kuala Lumpur">
                        <span class="card-badge">✈️ KUL ⇄ MAIN HUB</span>
                    </div>
                    <div class="hero-caption">
                        <div class="card-meta-line">
                            <span class="flight-tag">Direct Flight • Daily</span>
                            <span class="rating-pill">★ 4.9 <small>(1,280 reviews)</small></span>
                        </div>
                        <span class="city-name">Kuala Lumpur</span>
                        <p class="quote">“Where modern skyline meets authentic Malaysian heritage.”</p>
                        <div class="flight-schedule">📅 Daily departures • 08:30 AM | 02:15 PM</div>
                        <span class="explore-link">Explore Flights from RM 118 →</span>
                    </div>
                </a>

                <!-- 4 Small Cards -->
                <div class="small-cards-grid">
                    <a href="../destinations/malaysia.php" class="mini-card">
                        <button class="fav-btn" title="Save" onclick="toggleFav(event, this)">
                            <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </button>
                        <span class="mini-plane-badge">⇄ 1h 10m</span>
                        <img src="https://images.unsplash.com/photo-1544644181-1484b3fdfc62?w=600&auto=format&fit=crop" alt="Langkawi">
                        <div class="mini-info">
                            <div class="mini-rating">★ 4.8 <span>(412)</span></div>
                            <h4>Langkawi (LGK)</h4>
                            <p class="flight-time">Fri, 14 Aug • Direct</p>
                            <p class="price">from <strong>RM 142</strong></p>
                        </div>
                    </a>

                    <a href="../destinations/malaysia.php" class="mini-card">
                        <button class="fav-btn" title="Save" onclick="toggleFav(event, this)">
                            <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </button>
                        <span class="mini-plane-badge">⇄ 1h 00m</span>
                        <img src="https://images.unsplash.com/photo-1584281722572-8820c744f9c6?w=600&auto=format&fit=crop" alt="Penang">
                        <div class="mini-info">
                            <div class="mini-rating">★ 4.9 <span>(630)</span></div>
                            <h4>Penang (PEN)</h4>
                            <p class="flight-time">Sat, 15 Aug • Direct</p>
                            <p class="price">from <strong>RM 118</strong></p>
                        </div>
                    </a>

                    <a href="../destinations/malaysia.php" class="mini-card">
                        <button class="fav-btn" title="Save" onclick="toggleFav(event, this)">
                            <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </button>
                        <span class="mini-plane-badge">⇄ 2h 30m</span>
                        <img src="https://images.unsplash.com/photo-1628155930542-3c7a64e2c833?w=600&auto=format&fit=crop" alt="Kota Kinabalu">
                        <div class="mini-info">
                            <div class="mini-rating">★ 4.7 <span>(290)</span></div>
                            <h4>Kota Kinabalu (BKI)</h4>
                            <p class="flight-time">Thu, 20 Aug • Direct</p>
                            <p class="price">from <strong>RM 238</strong></p>
                        </div>
                    </a>

                    <a href="../destinations/malaysia.php" class="mini-card">
                        <button class="fav-btn" title="Save" onclick="toggleFav(event, this)">
                            <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </button>
                        <span class="mini-plane-badge">⇄ 1h 45m</span>
                        <img src="https://images.unsplash.com/photo-1508009603885-50cf7c579365?w=600&auto=format&fit=crop" alt="Kuching">
                        <div class="mini-info">
                            <div class="mini-rating">★ 4.8 <span>(180)</span></div>
                            <h4>Kuching (KCH)</h4>
                            <p class="flight-time">Sun, 23 Aug • Direct</p>
                            <p class="price">from <strong>RM 189</strong></p>
                        </div>
                    </a>
                </div>
            </div>
        </section>


        <!-- ISSUE 02: THAILAND -->
        <section class="magazine-issue reverse-layout">
            <div class="editorial-header">
                <div class="issue-meta">
                    <span class="issue-tag">ISSUE 02 — FLIGHTS TO THAILAND</span>
                    <span class="flight-route-badge">✈️ KUL → BKK / HKT</span>
                </div>
                <h2 class="editorial-title">EXPLORE<br>THAILAND</h2>
                <div class="editorial-line"></div>
            </div>

            <div class="magazine-layout">
                <a href="../destinations/thailand.php" class="hero-card">
                    <button class="fav-btn" title="Save to Favorites" onclick="toggleFav(event, this)">
                        <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    </button>
                    <div class="hero-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1508009603885-50cf7c579365?w=1200&auto=format&fit=crop" alt="Bangkok">
                        <span class="card-badge">✈️ KUL → BKK • 2h 10m</span>
                    </div>
                    <div class="hero-caption">
                        <div class="card-meta-line">
                            <span class="flight-tag">12+ Flights Daily</span>
                            <span class="rating-pill">★ 4.9 <small>(2,150 reviews)</small></span>
                        </div>
                        <span class="city-name">Bangkok (BKK)</span>
                        <p class="quote">“Vibrant night markets, golden temples, and street food paradises.”</p>
                        <div class="flight-schedule">📅 Departures every 2 hours starting at 06:10 AM</div>
                        <span class="explore-link">Explore Flights from RM 298 →</span>
                    </div>
                </a>

                <div class="small-cards-grid">
                    <a href="../destinations/thailand.php" class="mini-card">
                        <button class="fav-btn" title="Save" onclick="toggleFav(event, this)">
                            <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </button>
                        <span class="mini-plane-badge">✈️ 1h 25m</span>
                        <img src="https://images.unsplash.com/photo-1589394815804-964ed0be2eb5?w=600&auto=format&fit=crop" alt="Phuket">
                        <div class="mini-info">
                            <div class="mini-rating">★ 4.9 <span>(950)</span></div>
                            <h4>Phuket (HKT)</h4>
                            <p class="flight-time">Wed, 19 Aug • Non-stop</p>
                            <p class="price">from <strong>RM 312</strong></p>
                        </div>
                    </a>

                    <a href="../destinations/thailand.php" class="mini-card">
                        <button class="fav-btn" title="Save" onclick="toggleFav(event, this)">
                            <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </button>
                        <span class="mini-plane-badge">✈️ 2h 45m</span>
                        <img src="https://images.unsplash.com/photo-1598971861713-54ad16a7e72e?w=600&auto=format&fit=crop" alt="Chiang Mai">
                        <div class="mini-info">
                            <div class="mini-rating">★ 4.8 <span>(520)</span></div>
                            <h4>Chiang Mai (CNX)</h4>
                            <p class="flight-time">Fri, 21 Aug • Direct</p>
                            <p class="price">from <strong>RM 365</strong></p>
                        </div>
                    </a>

                    <a href="../destinations/thailand.php" class="mini-card">
                        <button class="fav-btn" title="Save" onclick="toggleFav(event, this)">
                            <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </button>
                        <span class="mini-plane-badge">✈️ 1h 40m</span>
                        <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=600&auto=format&fit=crop" alt="Koh Samui">
                        <div class="mini-info">
                            <div class="mini-rating">★ 4.7 <span>(310)</span></div>
                            <h4>Koh Samui (USM)</h4>
                            <p class="flight-time">Mon, 24 Aug • Direct</p>
                            <p class="price">from <strong>RM 520</strong></p>
                        </div>
                    </a>

                    <a href="../destinations/thailand.php" class="mini-card">
                        <button class="fav-btn" title="Save" onclick="toggleFav(event, this)">
                            <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </button>
                        <span class="mini-plane-badge">✈️ 2h 15m</span>
                        <img src="https://images.unsplash.com/photo-1506665531195-3566af2b4dfa?w=600&auto=format&fit=crop" alt="Krabi">
                        <div class="mini-info">
                            <div class="mini-rating">★ 4.8 <span>(430)</span></div>
                            <h4>Krabi (KBV)</h4>
                            <p class="flight-time">Thu, 27 Aug • Non-stop</p>
                            <p class="price">from <strong>RM 280</strong></p>
                        </div>
                    </a>
                </div>
            </div>
        </section>


        <!-- ISSUE 03: INDONESIA -->
        <section class="magazine-issue">
            <div class="editorial-header">
                <div class="issue-meta">
                    <span class="issue-tag">ISSUE 03 — FLIGHTS TO INDONESIA</span>
                    <span class="flight-route-badge">✈️ KUL → DPS / CGK</span>
                </div>
                <h2 class="editorial-title">ESCAPE TO<br>INDONESIA</h2>
                <div class="editorial-line"></div>
            </div>

            <div class="magazine-layout">
                <a href="../destinations/indonesia.php" class="hero-card">
                    <button class="fav-btn" title="Save to Favorites" onclick="toggleFav(event, this)">
                        <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    </button>
                    <div class="hero-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=1200&auto=format&fit=crop" alt="Bali">
                        <span class="card-badge">✈️ KUL → DPS • 3h 05m</span>
                    </div>
                    <div class="hero-caption">
                        <div class="card-meta-line">
                            <span class="flight-tag">Top Pick • Island Getaway</span>
                            <span class="rating-pill">★ 4.95 <small>(3,410 reviews)</small></span>
                        </div>
                        <span class="city-name">Bali (Denpasar)</span>
                        <p class="quote">“Tropical paradise, volcanic cliffs, and tranquil spirituality.”</p>
                        <div class="flight-schedule">📅 Daily non-stop flights at 09:45 AM & 06:20 PM</div>
                        <span class="explore-link">Explore Flights from RM 388 →</span>
                    </div>
                </a>

                <div class="small-cards-grid">
                    <a href="../destinations/indonesia.php" class="mini-card">
                        <button class="fav-btn" title="Save" onclick="toggleFav(event, this)">
                            <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </button>
                        <span class="mini-plane-badge">✈️ 2h 10m</span>
                        <img src="https://images.unsplash.com/photo-1555899434-94d1368aa7af?w=600&auto=format&fit=crop" alt="Jakarta">
                        <div class="mini-info">
                            <div class="mini-rating">★ 4.6 <span>(820)</span></div>
                            <h4>Jakarta (CGK)</h4>
                            <p class="flight-time">Tue, 18 Aug • Direct</p>
                            <p class="price">from <strong>RM 275</strong></p>
                        </div>
                    </a>

                    <a href="../destinations/indonesia.php" class="mini-card">
                        <button class="fav-btn" title="Save" onclick="toggleFav(event, this)">
                            <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </button>
                        <span class="mini-plane-badge">✈️ 3h 15m</span>
                        <img src="https://images.unsplash.com/photo-1570789210967-2cac24af3449?w=600&auto=format&fit=crop" alt="Lombok">
                        <div class="mini-info">
                            <div class="mini-rating">★ 4.8 <span>(340)</span></div>
                            <h4>Lombok (LOP)</h4>
                            <p class="flight-time">Sat, 22 Aug • Direct</p>
                            <p class="price">from <strong>RM 430</strong></p>
                        </div>
                    </a>

                    <a href="../destinations/indonesia.php" class="mini-card">
                        <button class="fav-btn" title="Save" onclick="toggleFav(event, this)">
                            <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </button>
                        <span class="mini-plane-badge">✈️ 2h 35m</span>
                        <img src="https://images.unsplash.com/photo-1584810359583-96fc3448beaa?w=600&auto=format&fit=crop" alt="Yogyakarta">
                        <div class="mini-info">
                            <div class="mini-rating">★ 4.7 <span>(210)</span></div>
                            <h4>Yogyakarta (YIA)</h4>
                            <p class="flight-time">Tue, 25 Aug • Direct</p>
                            <p class="price">from <strong>RM 340</strong></p>
                        </div>
                    </a>

                    <a href="../destinations/indonesia.php" class="mini-card">
                        <button class="fav-btn" title="Save" onclick="toggleFav(event, this)">
                            <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </button>
                        <span class="mini-plane-badge">✈️ 1h 05m</span>
                        <img src="https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?w=600&auto=format&fit=crop" alt="Medan">
                        <div class="mini-info">
                            <div class="mini-rating">★ 4.6 <span>(190)</span></div>
                            <h4>Medan (KNO)</h4>
                            <p class="flight-time">Fri, 28 Aug • Direct</p>
                            <p class="price">from <strong>RM 195</strong></p>
                        </div>
                    </a>
                </div>
            </div>
        </section>


        <!-- ISSUE 04: VIETNAM -->
        <section class="magazine-issue reverse-layout">
            <div class="editorial-header">
                <div class="issue-meta">
                    <span class="issue-tag">ISSUE 04 — FLIGHTS TO VIETNAM</span>
                    <span class="flight-route-badge">✈️ KUL → DAD / HAN</span>
                </div>
                <h2 class="editorial-title">UNCOVER<br>VIETNAM</h2>
                <div class="editorial-line"></div>
            </div>

            <div class="magazine-layout">
                <a href="../destinations/vietnam.php" class="hero-card">
                    <button class="fav-btn" title="Save to Favorites" onclick="toggleFav(event, this)">
                        <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    </button>
                    <div class="hero-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1559592413-7cec4d0cae2b?w=1200&auto=format&fit=crop" alt="Da Nang">
                        <span class="card-badge">✈️ KUL → DAD • 2h 45m</span>
                    </div>
                    <div class="hero-caption">
                        <div class="card-meta-line">
                            <span class="flight-tag">Coastal Route • Direct</span>
                            <span class="rating-pill">★ 4.88 <small>(1,840 reviews)</small></span>
                        </div>
                        <span class="city-name">Da Nang (DAD)</span>
                        <p class="quote">“Golden bridges suspending above mist and coastal marvels.”</p>
                        <div class="flight-schedule">📅 Daily morning flights at 10:15 AM</div>
                        <span class="explore-link">Explore Flights from RM 325 →</span>
                    </div>
                </a>

                <div class="small-cards-grid">
                    <a href="../destinations/vietnam.php" class="mini-card">
                        <button class="fav-btn" title="Save" onclick="toggleFav(event, this)">
                            <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </button>
                        <span class="mini-plane-badge">✈️ 3h 15m</span>
                        <img src="https://images.unsplash.com/photo-1509030450996-93f2e3d84298?w=600&auto=format&fit=crop" alt="Hanoi">
                        <div class="mini-info">
                            <div class="mini-rating">★ 4.8 <span>(780)</span></div>
                            <h4>Hanoi (HAN)</h4>
                            <p class="flight-time">Thu, 20 Aug • Direct</p>
                            <p class="price">from <strong>RM 350</strong></p>
                        </div>
                    </a>

                    <a href="../destinations/vietnam.php" class="mini-card">
                        <button class="fav-btn" title="Save" onclick="toggleFav(event, this)">
                            <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </button>
                        <span class="mini-plane-badge">✈️ 2h 05m</span>
                        <img src="https://images.unsplash.com/photo-1583417319070-4a69db38a482?w=600&auto=format&fit=crop" alt="Ho Chi Minh">
                        <div class="mini-info">
                            <div class="mini-rating">★ 4.7 <span>(1,120)</span></div>
                            <h4>Ho Chi Minh (SGN)</h4>
                            <p class="flight-time">Mon, 24 Aug • Direct</p>
                            <p class="price">from <strong>RM 260</strong></p>
                        </div>
                    </a>

                    <a href="../destinations/vietnam.php" class="mini-card">
                        <button class="fav-btn" title="Save" onclick="toggleFav(event, this)">
                            <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </button>
                        <span class="mini-plane-badge">✈️ 1h 50m</span>
                        <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=600&auto=format&fit=crop" alt="Phu Quoc">
                        <div class="mini-info">
                            <div class="mini-rating">★ 4.9 <span>(410)</span></div>
                            <h4>Phu Quoc (PQC)</h4>
                            <p class="flight-time">Wed, 26 Aug • Direct</p>
                            <p class="price">from <strong>RM 390</strong></p>
                        </div>
                    </a>

                    <a href="../destinations/vietnam.php" class="mini-card">
                        <button class="fav-btn" title="Save" onclick="toggleFav(event, this)">
                            <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </button>
                        <span class="mini-plane-badge">✈️ 2h 30m</span>
                        <img src="https://images.unsplash.com/photo-1528127269322-539801943592?w=600&auto=format&fit=crop" alt="Nha Trang">
                        <div class="mini-info">
                            <div class="mini-rating">★ 4.8 <span>(260)</span></div>
                            <h4>Nha Trang (CXR)</h4>
                            <p class="flight-time">Sat, 29 Aug • Direct</p>
                            <p class="price">from <strong>RM 310</strong></p>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <!-- 3. SPECIAL FLIGHT PACKAGES -->
        <section class="packages-section">
            <div class="section-title-box">
                <h2>FEATURED FLIGHT PACKAGES</h2>
                <p>Exclusive flight + baggage bundles tailored for your trip</p>
            </div>

            <div class="packages-grid">
                <div class="package-card">
                    <span class="pkg-badge">HOT DEAL</span>
                    <div class="pkg-header">
                        <h3>Southeast Asia Flexi Pass</h3>
                        <p class="route">KUL ✈️ BKK / DPS / DAD</p>
                    </div>
                    <div class="pkg-body">
                        <ul class="pkg-features">
                            <li>✔ Includes 20kg Checked Baggage</li>
                            <li>✔ Free Date Change (1x)</li>
                            <li>✔ Standard Seat Selection</li>
                        </ul>
                        <div class="pkg-price-box">
                            <span class="from">Save up to 25%</span>
                            <div class="price">RM 499 <span>/ person</span></div>
                        </div>
                        <a href="#" class="pkg-btn">Book Package</a>
                    </div>
                </div>

                <div class="package-card featured">
                    <span class="pkg-badge gold">BEST VALUE</span>
                    <div class="pkg-header">
                        <h3>Weekend Getaway Express</h3>
                        <p class="route">KUL ✈️ HKT / PEN / KBV</p>
                    </div>
                    <div class="pkg-body">
                        <ul class="pkg-features">
                            <li>✔ Priority Boarding Included</li>
                            <li>✔ In-flight Meal Included</li>
                            <li>✔ Express Check-in Counter</li>
                        </ul>
                        <div class="pkg-price-box">
                            <span class="from">Save up to 30%</span>
                            <div class="price">RM 388 <span>/ person</span></div>
                        </div>
                        <a href="#" class="pkg-btn">Book Package</a>
                    </div>
                </div>

                <div class="package-card">
                    <span class="pkg-badge">POPULAR</span>
                    <div class="pkg-header">
                        <h3>Island Hopper Bundle</h3>
                        <p class="route">KUL ✈️ LGK / USM / PQC</p>
                    </div>
                    <div class="pkg-body">
                        <ul class="pkg-features">
                            <li>✔ Direct Flights Only</li>
                            <li>✔ Cabin Bag 7kg + Carry-on</li>
                            <li>✔ Instant Confirmation</li>
                        </ul>
                        <div class="pkg-price-box">
                            <span class="from">Save up to 20%</span>
                            <div class="price">RM 299 <span>/ person</span></div>
                        </div>
                        <a href="#" class="pkg-btn">Book Package</a>
                    </div>
                </div>
            </div>
        </section>


        <!-- 4. TIPS ON BOOKING CHEAP FLIGHTS -->
        <section class="tips-section">
            <h2 class="tips-main-title">Tips on Booking Cheap Flights</h2>
            
            <div class="accordion-container">
                <div class="accordion-item">
                    <button class="accordion-header" onclick="toggleAccordion(this)">
                        <span>Fly during the working week</span>
                        <span class="acc-icon">∨</span>
                    </button>
                    <div class="accordion-content">
                        <p>Mid-week flights (Tuesday and Wednesday) are often cheaper than weekend flights due to lower demand from leisure travelers.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <button class="accordion-header" onclick="toggleAccordion(this)">
                        <span>Have a look at airline websites</span>
                        <span class="acc-icon">∨</span>
                    </button>
                    <div class="accordion-content">
                        <p>Comparing price aggregator results directly with official airline sites can sometimes unlock exclusive member discounts or free baggage upgrades.</p>
                    </div>
                </div>

                <div class="accordion-item active">
                    <button class="accordion-header" onclick="toggleAccordion(this)">
                        <span>Consider flights with less-popular departure times</span>
                        <span class="acc-icon">∧</span>
                    </button>
                    <div class="accordion-content" style="display: block;">
                        <p>You may also get a bargain flight if you're willing to fly at an early hour. It may well be less expensive to fly at 6 am than at later times due to that time spot being less popular. The only problem you could face is getting to the airport at this time; make sure that public transport is running if you can't take a taxi or get a lift to the airport.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <button class="accordion-header" onclick="toggleAccordion(this)">
                        <span>Find a better price on the app</span>
                        <span class="acc-icon">∨</span>
                    </button>
                    <div class="accordion-content">
                        <p>Exclusive mobile app promotions and promo codes often offer additional discounts compared to desktop web prices.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <button class="accordion-header" onclick="toggleAccordion(this)">
                        <span>Book early instead of waiting until the last minute</span>
                        <span class="acc-icon">∨</span>
                    </button>
                    <div class="accordion-content">
                        <p>Airfares generally rise within 3 weeks of departure. Booking 1 to 3 months in advance usually gets you the best rates.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <button class="accordion-header" onclick="toggleAccordion(this)">
                        <span>Use a credit card in a wiser way</span>
                        <span class="acc-icon">∨</span>
                    </button>
                    <div class="accordion-content">
                        <p>Check for travel credit card perks, airport lounge access, complimentary flight insurance, and air mile reward points.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <button class="accordion-header" onclick="toggleAccordion(this)">
                        <span>Choose flights with a connection</span>
                        <span class="acc-icon">∨</span>
                    </button>
                    <div class="accordion-content">
                        <p>Connecting flights with short layovers are frequently lower in price than direct non-stop flights for long-haul routes.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <button class="accordion-header" onclick="toggleAccordion(this)">
                        <span>Book package holidays which may offer cheap flight tickets</span>
                        <span class="acc-icon">∨</span>
                    </button>
                    <div class="accordion-content">
                        <p>Bundling flights with hotel bookings often unlocks wholesale rates not available when purchasing separately.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <button class="accordion-header" onclick="toggleAccordion(this)">
                        <span>Be aware of hidden costs of cheap flights</span>
                        <span class="acc-icon">∨</span>
                    </button>
                    <div class="accordion-content">
                        <p>Always factor in additional fees like checked baggage, seat selection, airport transfers, and payment processing charges.</p>
                    </div>
                </div>
            </div>
        </section>

    </div>

</main>

<!-- 5. 弹窗结构 -->
<div class="flight-modal-overlay" id="flightModal">
    <div class="flight-modal-container">
        
        <!-- Header -->
        <div class="modal-header">
            <div>
                <h3 class="route-title" id="modalRouteTitle">Kuala Lumpur ➔ Destination</h3>
                <div class="flight-meta">
                    <span id="modalDepartDate">Depart: Daily Schedule</span>
                    <span>|</span>
                    <span id="modalDuration">Duration: --</span>
                </div>
            </div>
            <button class="modal-close-btn" onclick="closeFlightModal()">✕</button>
        </div>

        <!-- 美化后的弹窗配置栏（已绑定逻辑） -->
        <div class="booking-form">
          <!-- Trip Type -->
          <div class="trip-type-toggle" role="radiogroup" aria-label="Trip type">
            <label class="trip-type-option active">
              <input type="radio" name="tripType" class="segment-btn" value="one-way" data-multiplier="1" checked onchange="setTripType(this)">
              <span class="trip-check" aria-hidden="true"></span>
              <span class="trip-type-text">One-Way</span>
            </label>

            <label class="trip-type-option">
              <input type="radio" name="tripType" class="segment-btn" value="round-trip" data-multiplier="1.85" onchange="setTripType(this)">
              <span class="trip-check" aria-hidden="true"></span>
              <span class="trip-type-text">Round-Trip</span>
            </label>
          </div>

          <!-- Departure Airport -->
          <div class="form-field">
            <label class="field-label">
              <span>🛫</span>
              <span>Departure</span>
            </label>
            <div class="select-wrapper">
              <select id="originAirport" class="custom-select" onchange="recalculateTotal()">
                <option value="KUL" data-adj="0" selected>Kuala Lumpur (KUL)</option>
                <option value="PEN" data-adj="35">Penang (PEN) [+$35]</option>
                <option value="JHB" data-adj="20">Johor Bahru (JHB) [+$20]</option>
                <option value="TGG" data-adj="15">Kuala Terengganu (TGG) [+$15]</option>
                <option value="KBR" data-adj="15">Kota Bharu (KBR) [+$15]</option>
                <option value="IPH" data-adj="25">Ipoh (IPH) [+$25]</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Flight Detail Segment -->
        <div class="modal-flight-details">
            <div class="time-box">
                <strong id="modalDeptTime">09:25</strong>
                <span id="modalDeptCode">KUL Kuala Lumpur</span>
            </div>
            <div class="airline-info">
                <div class="carrier" id="modalCarrier">Malaysia Airlines (MH5483)</div>
                <div class="aircraft">Economy Class • Direct Flight</div>
            </div>
            <div class="time-box" style="margin-left: auto;">
                <strong id="modalArrTime">10:50</strong>
                <span id="modalArrCode">DEST Airport</span>
            </div>
        </div>

        <!-- Scrollable Options Content -->
        <div class="modal-body">
            <div class="options-grid">
                <label class="option-card selected">
                    <input type="checkbox" class="card-checkbox" value="0" checked disabled onclick="recalculateTotal()">
                    <div>
                        <div class="class-name">Standard Economy</div>
                        <ul class="feature-list">
                            <li>🎒 Carry-on luggage: 1 piece</li>
                            <li>🧳 Checked baggage: 10 kg</li>
                            <li>❌ Non-refundable</li>
                        </ul>
                    </div>
                    <div class="option-price" id="basePriceTag">RM 0</div>
                </label>

                <label class="option-card">
                    <input type="checkbox" class="card-checkbox" value="50" onclick="recalculateTotal()">
                    <div>
                        <span class="tag-recommended">RECOMMENDED</span>
                        <div class="class-name">TripFlex Plus</div>
                        <ul class="feature-list">
                            <li>✅ Free Cancellation</li>
                            <li>✅ Free Date Change</li>
                            <li>🧳 Checked baggage: 20 kg</li>
                        </ul>
                    </div>
                    <div class="option-price">+ RM 50</div>
                </label>

                <label class="option-card">
                    <input type="checkbox" class="card-checkbox" value="30" onclick="recalculateTotal()">
                    <div>
                        <div class="class-name">Priority & Comfort</div>
                        <ul class="feature-list">
                            <li>⚡ Priority Boarding</li>
                            <li>🍱 Premium In-flight Meal</li>
                            <li>💺 Standard Seat Selection</li>
                        </ul>
                    </div>
                    <div class="option-price">+ RM 30</div>
                </label>
            </div>

            <div class="payment-section">
                <div class="payment-title">Select Payment Method</div>
                <div class="payment-options">
                    <label class="payment-label">
                        <input type="radio" name="payMethod" value="card" checked>
                        <span>💳 Credit / Debit Card</span>
                    </label>
                    <label class="payment-label">
                        <input type="radio" name="payMethod" value="tng">
                        <span>📱 Touch 'n Go eWallet</span>
                    </label>
                    <label class="payment-label">
                        <input type="radio" name="payMethod" value="fpx">
                        <span>🏦 FPX Online Banking</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <div class="total-price-display">
                <span>Total Amount</span>
                <strong id="modalTotalPrice">RM 0</strong>
            </div>
            <button class="add-to-cart-btn" onclick="addToCartAction()">Add to Cart</button>
        </div>

    </div>
</div>

<script>
let currentBasePrice = 0;
let currentTripMultiplier = 1;

// 单程 / 往返胶囊按钮切换逻辑
function setTripType(input) {
    document.querySelectorAll('.trip-type-option').forEach(option => {
        option.classList.toggle('active', option.contains(input));
    });

    document.querySelectorAll('.segment-btn').forEach(radio => {
        radio.checked = radio === input;
    });

    currentTripMultiplier = parseFloat(input.getAttribute('data-multiplier')) || 1;
    recalculateTotal();
}

// 重新计算价格
function recalculateTotal() {
    const airportSelect = document.getElementById('originAirport');
    const airportAdj = parseFloat(airportSelect.options[airportSelect.selectedIndex].getAttribute('data-adj')) || 0;

    // 实时更新出发地显示
    const originText = airportSelect.options[airportSelect.selectedIndex].text.split(' [')[0];
    document.getElementById('modalDeptCode').textContent = originText;

    // 计算总基础票价：(基础单价 + 机场差价) * 往返系数
    let dynamicBase = (currentBasePrice + airportAdj) * currentTripMultiplier;
    document.getElementById('basePriceTag').textContent = `RM ${dynamicBase.toFixed(0)}`;

    let total = dynamicBase;
    const checkboxes = document.querySelectorAll('.card-checkbox');
    
    checkboxes.forEach((cb, idx) => {
        const card = cb.closest('.option-card');
        if (cb.checked) {
            card.classList.add('selected');
            if (idx > 0) total += parseFloat(cb.value);
        } else {
            card.classList.remove('selected');
        }
    });

    document.getElementById('modalTotalPrice').textContent = `RM ${total.toFixed(0)}`;
}

// 弹窗初始化状态重置
function openFlightModal(destination, priceStr, duration) {
    const numericPrice = parseFloat(priceStr.replace(/[^0-9.]/g, '')) || 0;
    currentBasePrice = numericPrice;

    const modal = document.getElementById('flightModal');
    if (!modal) return;

    document.getElementById('modalRouteTitle').textContent = `Malaysia ➔ ${destination}`;
    document.getElementById('modalDuration').textContent = `Duration: ${duration || 'N/A'}`;

    const arrCodeEl = document.getElementById('modalArrCode');
    if (arrCodeEl) {
        arrCodeEl.textContent = destination.includes('(') ? destination : `${destination} Airport`;
    }
    
    // 重置配置框
    document.getElementById('originAirport').selectedIndex = 0;
    currentTripMultiplier = 1;
    document.querySelectorAll('.segment-btn').forEach((radio, idx) => {
        radio.checked = idx === 0;
    });

    document.querySelectorAll('.trip-type-option').forEach((option, idx) => {
        option.classList.toggle('active', idx === 0);
    });

    const checkboxes = modal.querySelectorAll('.card-checkbox');
    checkboxes.forEach((cb, idx) => {
        if (idx === 0) {
            cb.checked = true;
            cb.disabled = true;
        } else {
            cb.checked = false;
            cb.disabled = false;
        }
        cb.closest('.option-card').classList.toggle('selected', cb.checked);
    });

    recalculateTotal();
    modal.classList.add('active');
}

function closeFlightModal() {
    const modal = document.getElementById('flightModal');
    if (modal) modal.classList.remove('active');
}

function addToCartAction() {
    const total = document.getElementById('modalTotalPrice').textContent;
    alert(`Success! Flight added to cart with Total: ${total}`);
    closeFlightModal();
}

function toggleFav(event, btn) {
    event.preventDefault();
    event.stopPropagation();
    btn.classList.toggle('active');
}

function toggleDropdown(id) {
    const target = document.getElementById(id);
    if (!target) return;
    const isOpen = target.classList.contains('show');
    document.querySelectorAll('.airbnb-dropdown').forEach(d => d.classList.remove('show'));
    if (!isOpen) target.classList.add('show');
}

function toggleAccordion(button) {
    const item = button.parentElement;
    const content = item.querySelector('.accordion-content');
    const icon = button.querySelector('.acc-icon');
    const isOpen = item.classList.contains('active');
    
    document.querySelectorAll('.accordion-item').forEach(acc => {
        acc.classList.remove('active');
        const c = acc.querySelector('.accordion-content');
        if (c) c.style.display = 'none';
        const ic = acc.querySelector('.acc-icon');
        if (ic) ic.textContent = '∨';
    });

    if (!isOpen) {
        item.classList.add('active');
        if (content) content.style.display = 'block';
        if (icon) icon.textContent = '∧';
    }
}

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('flight-modal-overlay')) {
        closeFlightModal();
        return;
    }

    const card = e.target.closest('.hero-card, .mini-card, .package-card');
    if (card && !e.target.closest('.fav-btn')) {
        e.preventDefault();
        
        try {
            const cityEl = card.querySelector('.city-name') || card.querySelector('h4') || card.querySelector('h3');
            const priceEl = card.querySelector('.price strong') || card.querySelector('.price') || card.querySelector('.explore-link');
            const badgeEl = card.querySelector('.mini-plane-badge') || card.querySelector('.card-badge') || card.querySelector('.route');

            const cityName = cityEl ? cityEl.textContent.trim() : 'Destination';
            const priceText = priceEl ? priceEl.textContent.trim() : '0';
            const durationText = badgeEl ? badgeEl.textContent.replace(/[✈️⇄]/g, '').trim() : 'Direct';

            openFlightModal(cityName, priceText, durationText);
        } catch (err) {
            console.error("Modal Trigger Error:", err);
        }
        return;
    }

    if (!e.target.closest('.search-segment')) {
        document.querySelectorAll('.airbnb-dropdown').forEach(d => d.classList.remove('show'));
    }
});

window.addEventListener('scroll', function() {
    const searchHero = document.getElementById('searchHero');
    if (searchHero) {
        if (window.scrollY > 60) {
            searchHero.classList.add('sticky');
        } else {
            searchHero.classList.remove('sticky');
        }
    }
});
</script>

<?php include '../footer.php'; ?>