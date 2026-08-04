<?php include '../header.php'; ?>

<!-- 引入 CSS 样式文件 -->
<link rel="stylesheet" href="../css/modules/hotels.css">

<section class="hotels-hero">
    <h1>Top Places to Stay in Southeast Asia</h1>
    <p>Hand-picked hotels near iconic, unique attractions with airport proximity guides.</p>
</section>

<div class="hotels-container">

    <!-- ================= 🇹🇭 THAILAND (8个不重复景点) ================= -->
    <section class="country-section">
        <div class="country-header"><h2>🇹🇭 Thailand</h2></div>
        
        <div class="slider-wrapper">
            <button class="slider-arrow prev" onclick="slide('thailand-slider', -320)">❮</button>
            
            <div class="slider-container" id="thailand-slider">
                <!-- 1. 景点: 大皇宫 Grand Palace -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🚶‍♂️ 5 min walk</span>
                        <div class="hotel-star-badge">★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">Sala Rattanakosin</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near The Grand Palace</div>
                            <div class="near-airport">✈️ Don Mueang (DMK) - 30m</div>
                        </div>
                        <a href="detail.php?id=sala_rattanakosin" class="btn-detail">View Details</a>
                    </div>
                </div>

                <!-- 2. 景点: 郑王庙 Wat Arun -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🚶‍♂️ 2 min walk</span>
                        <div class="hotel-star-badge">★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">Arun Residence</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Wat Arun</div>
                            <div class="near-airport">✈️ Don Mueang (DMK) - 32m</div>
                        </div>
                        <a href="detail.php?id=arun_residence" class="btn-detail">View Details</a>
                    </div>
                </div>

                <!-- 3. 景点: 大城遗址 Ayutthaya -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🚶‍♂️ Adjacent</span>
                        <div class="hotel-star-badge">★★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">Sala Ayutthaya</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Ayutthaya Ruins</div>
                            <div class="near-airport">✈️ Don Mueang (DMK) - 50m</div>
                        </div>
                        <a href="detail.php?id=sala_ayutthaya" class="btn-detail">View Details</a>
                    </div>
                </div>

                <!-- 4. 景点: 丹嫩沙朵水上市场 Damnoen Saduak -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🚶‍♂️ 3 min walk</span>
                        <div class="hotel-star-badge">★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">Maikaew Damnoen Resort</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Floating Market</div>
                            <div class="near-airport">✈️ Suvarnabhumi (BKK) - 1.5h</div>
                        </div>
                        <a href="detail.php?id=maikaew_damnoen" class="btn-detail">View Details</a>
                    </div>
                </div>

                <!-- 5. 景点: 契迪龙寺 Wat Chedi Luang (清迈) -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🚶‍♂️ 4 min walk</span>
                        <div class="hotel-star-badge">★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">U Chiang Mai</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Wat Chedi Luang</div>
                            <div class="near-airport">✈️ Chiang Mai (CNX) - 15m</div>
                        </div>
                        <a href="detail.php?id=u_chiang_mai" class="btn-detail">View Details</a>
                    </div>
                </div>

                <!-- 6. 景点: 芭提雅真理寺 Sanctuary of Truth -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🚗 5 min drive</span>
                        <div class="hotel-star-badge">★★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">Cape Dara Resort</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Sanctuary of Truth</div>
                            <div class="near-airport">✈️ U-Tapao (UTP) - 45m</div>
                        </div>
                        <a href="detail.php?id=cape_dara" class="btn-detail">View Details</a>
                    </div>
                </div>

                <!-- 7. 景点: 普吉岛芭东海滩 Patong Beach -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🚶‍♂️ 2 min walk</span>
                        <div class="hotel-star-badge">★★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">Amari Phuket</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Patong Beach</div>
                            <div class="near-airport">✈️ Phuket (HKT) - 50m</div>
                        </div>
                        <a href="detail.php?id=amari_phuket" class="btn-detail">View Details</a>
                    </div>
                </div>

                <!-- 8. 景点: 甲米莱利海滩 Railay Beach -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🚶‍♂️ Beachfront</span>
                        <div class="hotel-star-badge">★★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">Rayavadee Krabi</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Railay Beach</div>
                            <div class="near-airport">✈️ Krabi (KBV) - 40m</div>
                        </div>
                        <a href="detail.php?id=rayavadee_krabi" class="btn-detail">View Details</a>
                    </div>
                </div>
            </div>

            <button class="slider-arrow next" onclick="slide('thailand-slider', 320)">❯</button>
        </div>
    </section>


    <!-- ================= 🇻🇳 VIETNAM (8个不重复景点) ================= -->
    <section class="country-section">
        <div class="country-header"><h2>🇻🇳 Vietnam</h2></div>
        
        <div class="slider-wrapper">
            <button class="slider-arrow prev" onclick="slide('vietnam-slider', -320)">❮</button>
            
            <div class="slider-container" id="vietnam-slider">
                <!-- 1. 景点: 河内老街 Old Quarter -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🚶‍♂️ 3 min walk</span>
                        <div class="hotel-star-badge">★★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">Sofitel Legend Metropole</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Hanoi Old Quarter</div>
                            <div class="near-airport">✈️ Noi Bai (HAN) - 35m</div>
                        </div>
                        <a href="detail.php?id=sofitel_metropole" class="btn-detail">View Details</a>
                    </div>
                </div>

                <!-- 2. 景点: 下龙湾 Ha Long Bay -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">⛵ At Marina</span>
                        <div class="hotel-star-badge">★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">Paradise Suites Hotel</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Tuan Chau Marina</div>
                            <div class="near-airport">✈️ Cat Bi (HPH) - 45m</div>
                        </div>
                        <a href="detail.php?id=paradise_suites" class="btn-detail">View Details</a>
                    </div>
                </div>

                <!-- 3. 景点: 会安古镇 Hoi An Ancient Town -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1566665797739-1674de7a421a?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🚶‍♂️ 5 min walk</span>
                        <div class="hotel-star-badge">★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">Hoi An Historic Hotel</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Ancient Town</div>
                            <div class="near-airport">✈️ Da Nang (DAD) - 45m</div>
                        </div>
                        <a href="detail.php?id=hoi_an_historic" class="btn-detail">View Details</a>
                    </div>
                </div>

                <!-- 4. 景点: 岘港巴拿山 Ba Na Hills -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🚶‍♂️ Cable Car Station</span>
                        <div class="hotel-star-badge">★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">Mercure Danang Ba Na</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Golden Bridge</div>
                            <div class="near-airport">✈️ Da Nang (DAD) - 1h</div>
                        </div>
                        <a href="detail.php?id=mercure_bana" class="btn-detail">View Details</a>
                    </div>
                </div>

                <!-- 5. 景点: 芽庄海滩 Nha Trang Beach -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🚶‍♂️ Beachfront</span>
                        <div class="hotel-star-badge">★★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">InterContinental Nha Trang</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Nha Trang Beach</div>
                            <div class="near-airport">✈️ Cam Ranh (CXR) - 35m</div>
                        </div>
                        <a href="detail.php?id=intercon_nhatrang" class="btn-detail">View Details</a>
                    </div>
                </div>

                <!-- 6. 景点: 统一宫 Independence Palace (胡志明) -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🚶‍♂️ 4 min walk</span>
                        <div class="hotel-star-badge">★★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">Caravelle Saigon</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Independence Palace</div>
                            <div class="near-airport">✈️ Tan Son Nhat (SGN) - 30m</div>
                        </div>
                        <a href="detail.php?id=caravelle_saigon" class="btn-detail">View Details</a>
                    </div>
                </div>

                <!-- 7. 景点: 梯田 Sapa Terraces -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🏔 Valley View</span>
                        <div class="hotel-star-badge">★★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">Hotel de la Coupole Sapa</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Sapa Rice Terraces</div>
                            <div class="near-airport">✈️ Noi Bai (HAN) - 4.5h drive</div>
                        </div>
                        <a href="detail.php?id=coupole_sapa" class="btn-detail">View Details</a>
                    </div>
                </div>

                <!-- 8. 景点: 富国岛 Sunset Sanato (Phu Quoc) -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🏖 Oceanfront</span>
                        <div class="hotel-star-badge">★★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">Salinda Resort Phu Quoc</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Long Beach Sunset</div>
                            <div class="near-airport">✈️ Phu Quoc (PQC) - 10m</div>
                        </div>
                        <a href="detail.php?id=salinda_phuquoc" class="btn-detail">View Details</a>
                    </div>
                </div>
            </div>

            <button class="slider-arrow next" onclick="slide('vietnam-slider', 320)">❯</button>
        </div>
    </section>


    <!-- ================= 🇮🇩 INDONESIA (8个不重复景点) ================= -->
    <section class="country-section">
        <div class="country-header"><h2>🇮🇩 Indonesia</h2></div>
        
        <div class="slider-wrapper">
            <button class="slider-arrow prev" onclick="slide('indonesia-slider', -320)">❮</button>
            
            <div class="slider-container" id="indonesia-slider">
                <!-- 1. 景点: 圣猴森林 Monkey Forest (乌布) -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🌿 Rainforest View</span>
                        <div class="hotel-star-badge">★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">Alaya Resort Ubud</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Sacred Monkey Forest</div>
                            <div class="near-airport">✈️ Ngurah Rai (DPS) - 1.2h</div>
                        </div>
                        <a href="detail.php?id=alaya_ubud" class="btn-detail">View Details</a>
                    </div>
                </div>

                <!-- 2. 景点: 婆罗浮屠 Borobudur -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🚶‍♂️ 2 min walk</span>
                        <div class="hotel-star-badge">★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">Manohara Resort</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Adjacent to Borobudur</div>
                            <div class="near-airport">✈️ YIA Airport - 1h</div>
                        </div>
                        <a href="detail.php?id=manohara_resort" class="btn-detail">View Details</a>
                    </div>
                </div>

                <!-- 3. 景点: 海神庙 Tanah Lot -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🚗 5 min drive</span>
                        <div class="hotel-star-badge">★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">Nirwana Bali Resort</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Tanah Lot Temple</div>
                            <div class="near-airport">✈️ Ngurah Rai (DPS) - 1h</div>
                        </div>
                        <a href="detail.php?id=nirwana_bali" class="btn-detail">View Details</a>
                    </div>
                </div>

                <!-- 4. 景点: 乌鲁瓦图断崖 Uluwatu Temple -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🌊 Cliffside View</span>
                        <div class="hotel-star-badge">★★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">Anantara Uluwatu</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Uluwatu Temple</div>
                            <div class="near-airport">✈️ Ngurah Rai (DPS) - 40m</div>
                        </div>
                        <a href="detail.php?id=anantara_uluwatu" class="btn-detail">View Details</a>
                    </div>
                </div>

                <!-- 5. 景点: 布罗莫火山 Mount Bromo -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🌋 Mountain Edge</span>
                        <div class="hotel-star-badge">★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">Jiwa Jawa Resort Bromo</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Mt Bromo Viewpoint</div>
                            <div class="near-airport">✈️ Juanda (SUB) - 2.5h drive</div>
                        </div>
                        <a href="detail.php?id=jiwa_jawa" class="btn-detail">View Details</a>
                    </div>
                </div>

                <!-- 6. 景点: 科莫多粉色沙滩 Pink Beach Komodo -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🛥 Boat Terminal</span>
                        <div class="hotel-star-badge">★★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">Ayana Komodo Resort</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Komodo Islands</div>
                            <div class="near-airport">✈️ Komodo (LBJ) - 15m</div>
                        </div>
                        <a href="detail.php?id=ayana_komodo" class="btn-detail">View Details</a>
                    </div>
                </div>

                <!-- 7. 景点: 雅加达国家纪念塔 Monas -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🚶‍♂️ 8 min walk</span>
                        <div class="hotel-star-badge">★★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">Hotel Indonesia Kempinski</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Monas Tower</div>
                            <div class="near-airport">✈️ Soekarno-Hatta (CGK) - 45m</div>
                        </div>
                        <a href="detail.php?id=kempinski_jakarta" class="btn-detail">View Details</a>
                    </div>
                </div>

                <!-- 8. 景点: 佩尼达岛精灵海滩 Kelingking Beach -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🚗 15 min drive</span>
                        <div class="hotel-star-badge">★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">MAUA Nusa Penida</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Kelingking Beach</div>
                            <div class="near-airport">✈️ Ngurah Rai (DPS) - Boat Transfer</div>
                        </div>
                        <a href="detail.php?id=maua_penida" class="btn-detail">View Details</a>
                    </div>
                </div>
            </div>

            <button class="slider-arrow next" onclick="slide('indonesia-slider', 320)">❯</button>
        </div>
    </section>


    <!-- ================= 🇲🇾 MALAYSIA (8个不重复景点) ================= -->
    <section class="country-section">
        <div class="country-header"><h2>🇲🇾 Malaysia</h2></div>
        
        <div class="slider-wrapper">
            <button class="slider-arrow prev" onclick="slide('malaysia-slider', -320)">❮</button>
            
            <div class="slider-container" id="malaysia-slider">
                <!-- 1. 景点: 双峰塔 Petronas Towers -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1596422846543-75c6fc197f07?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🚶‍♂️ 1 min walk</span>
                        <div class="hotel-star-badge">★★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">Mandarin Oriental, KL</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Petronas Twin Towers</div>
                            <div class="near-airport">✈️ KLIA / KLIA2 - 45m</div>
                        </div>
                        <a href="detail.php?id=mandarin_oriental" class="btn-detail">View Details</a>
                    </div>
                </div>

                <!-- 2. 景点: 黑风洞 Batu Caves -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🚗 10 min drive</span>
                        <div class="hotel-star-badge">★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">Batu Caves Business Hotel</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Batu Caves Temple</div>
                            <div class="near-airport">✈️ Subang (SZB) - 30m</div>
                        </div>
                        <a href="detail.php?id=batu_caves_hotel" class="btn-detail">View Details</a>
                    </div>
                </div>

                <!-- 3. 景点: 槟城乔治市 George Town -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🚶‍♂️ In Heritage Area</span>
                        <div class="hotel-star-badge">★★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">E&O Hotel Penang</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near George Town Heritage</div>
                            <div class="near-airport">✈️ Penang (PEN) - 30m</div>
                        </div>
                        <a href="detail.php?id=eo_hotel" class="btn-detail">View Details</a>
                    </div>
                </div>

                <!-- 4. 景点: 马六甲鸡场街 Jonker Street -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🚶‍♂️ 3 min walk</span>
                        <div class="hotel-star-badge">★★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">Casa del Rio Melaka</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Jonker Street</div>
                            <div class="near-airport">✈️ KLIA - 1.5h</div>
                        </div>
                        <a href="detail.php?id=casa_del_rio" class="btn-detail">View Details</a>
                    </div>
                </div>

                <!-- 5. 景点: 云顶高原 Genting Highlands -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🚠 Direct Cable Car Access</span>
                        <div class="hotel-star-badge">★★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">Crockfords Genting</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Genting SkyWorlds</div>
                            <div class="near-airport">✈️ KLIA - 1.5h</div>
                        </div>
                        <a href="detail.php?id=crockfords_genting" class="btn-detail">View Details</a>
                    </div>
                </div>

                <!-- 6. 景点: 兰卡威天空之桥 Langkawi SkyBridge -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🚗 10 min drive</span>
                        <div class="hotel-star-badge">★★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">The Danna Langkawi</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Langkawi SkyCab</div>
                            <div class="near-airport">✈️ Langkawi (LGK) - 15m</div>
                        </div>
                        <a href="detail.php?id=danna_langkawi" class="btn-detail">View Details</a>
                    </div>
                </div>

                <!-- 7. 景点: 沙巴神山 Mount Kinabalu -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🌅 Sunset View</span>
                        <div class="hotel-star-badge">★★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">Shangri-La Tanjung Aru</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Kota Kinabalu City</div>
                            <div class="near-airport">✈️ Kota Kinabalu (BKI) - 10m</div>
                        </div>
                        <a href="detail.php?id=shangrila_kk" class="btn-detail">View Details</a>
                    </div>
                </div>

                <!-- 8. 景点: 仙本那仙境水屋 Semporna Water Village -->
                <div class="hotel-card">
                    <div class="hotel-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=600&q=80" class="hotel-img">
                        <span class="distance-tag">🏝 Water Chalet</span>
                        <div class="hotel-star-badge">★★★★</div>
                    </div>
                    <div class="hotel-content">
                        <h3 class="hotel-name">Sipadan Kapalai Resort</h3>
                        <div class="location-info">
                            <div class="near-attraction">📍 Near Kapalai Reef</div>
                            <div class="near-airport">✈️ Tawau (TWU) - Boat Transfer</div>
                        </div>
                        <a href="detail.php?id=kapalai_resort" class="btn-detail">View Details</a>
                    </div>
                </div>
            </div>

            <button class="slider-arrow next" onclick="slide('malaysia-slider', 320)">❯</button>
        </div>
    </section>

</div>

<script>
    function slide(sliderId, distance) {
        const container = document.getElementById(sliderId);
        container.scrollBy({ left: distance, behavior: 'smooth' });
    }
</script>