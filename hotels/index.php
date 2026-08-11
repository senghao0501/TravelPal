<?php 
if (file_exists('../header.php')) {
    include '../header.php';
} else if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/header.php')) {
    include $_SERVER['DOCUMENT_ROOT'] . '/header.php';
}
?>

<link rel="stylesheet" href="../css/modules/hotels.css">


<section class="hotels-hero">
    <h1>Top Places to Stay in Southeast Asia</h1>
    <p>Hand-picked luxury stays and boutique hotels near top landmarks.</p>
</section>

<div class="hotels-wrapper">

    <!-- ================= 1. 🇲🇾 MALAYSIA (1大4小) ================= -->
    <h2 class="country-section-title">🇲🇾 MALAYSIA</h2>
    
    <div class="hotel-grid-box">
        <!-- 左侧大卡片 -->
        <div class="hotel-card-large">
            <img class="bg-img" src="https://images.unsplash.com/photo-1596422846543-75c6fc197f07?auto=format&fit=crop&w=1000&q=80" alt="Mandarin Oriental">
            <div class="overlay"></div>
            <button class="star-fav-btn" onclick="toggleStar(event, this)">☆</button>

            <div class="card-content">
                <div></div>
                <div class="large-card-info">
                    <div class="large-tags-row">
                        <span class="tag-green-pill">🚶‍♂️ 1 min walk</span>
                        <span class="tag-rating-pill"><span>★ 4.9</span> (1,280 reviews)</span>
                    </div>
                    <h2>Mandarin Oriental, KL</h2>
                    <p class="sub-location">📍 Near Petronas Twin Towers, Kuala Lumpur</p>
                    <a href="detail.php?id=mandarin_kl" class="btn-explore">VIEW DETAILS & RATES →</a>
                </div>
            </div>
        </div>

        <!-- 右侧小卡片 1 -->
        <a href="detail.php?id=eo_penang" class="hotel-card-small">
            <button class="star-fav-btn" onclick="toggleStar(event, this)">☆</button>
            <div class="small-card-img">
                <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=500&q=80" alt="E&O Penang">
                <span class="hotel-walk-badge">🏛 Heritage</span>
            </div>
            <div class="small-card-body">
                <div>
                    <div class="small-rating"><span class="star">★ 4.8</span> <span class="count">(630)</span></div>
                    <div class="small-title">E&O Hotel Penang</div>
                    <div class="small-location">📍 Near George Town</div>
                </div>
                <div class="small-price">from <strong>RM 450</strong></div>
            </div>
        </a>

        <!-- 右侧小卡片 2 -->
        <a href="detail.php?id=casa_del_rio" class="hotel-card-small">
            <button class="star-fav-btn" onclick="toggleStar(event, this)">☆</button>
            <div class="small-card-img">
                <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=500&q=80" alt="Casa del Rio">
                <span class="hotel-walk-badge">🚶‍♂️ 3 min walk</span>
            </div>
            <div class="small-card-body">
                <div>
                    <div class="small-rating"><span class="star">★ 4.7</span> <span class="count">(412)</span></div>
                    <div class="small-title">Casa del Rio Melaka</div>
                    <div class="small-location">📍 Near Jonker Street</div>
                </div>
                <div class="small-price">from <strong>RM 380</strong></div>
            </div>
        </a>

        <!-- 右侧小卡片 3 -->
        <a href="detail.php?id=st_regis_langkawi" class="hotel-card-small">
            <button class="star-fav-btn" onclick="toggleStar(event, this)">☆</button>
            <div class="small-card-img">
                <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=500&q=80" alt="St. Regis Langkawi">
                <span class="hotel-walk-badge">🏖 Beachfront</span>
            </div>
            <div class="small-card-body">
                <div>
                    <div class="small-rating"><span class="star">★ 4.9</span> <span class="count">(520)</span></div>
                    <div class="small-title">St. Regis Langkawi</div>
                    <div class="small-location">📍 Near Eagle Square</div>
                </div>
                <div class="small-price">from <strong>RM 890</strong></div>
            </div>
        </a>

        <!-- 右侧小卡片 4 -->
        <a href="detail.php?id=kapalai_resort" class="hotel-card-small">
            <button class="star-fav-btn" onclick="toggleStar(event, this)">☆</button>
            <div class="small-card-img">
                <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=500&q=80" alt="Kapalai Resort">
                <span class="hotel-walk-badge">🌊 Overwater</span>
            </div>
            <div class="small-card-body">
                <div>
                    <div class="small-rating"><span class="star">★ 4.8</span> <span class="count">(290)</span></div>
                    <div class="small-title">Kapalai Dive Resort</div>
                    <div class="small-location">📍 Near Sipadan Island</div>
                </div>
                <div class="small-price">from <strong>RM 1,200</strong></div>
            </div>
        </a>
    </div>


    <!-- ================= 2. 🇹🇭 THAILAND (1大4小) ================= -->
    <h2 class="country-section-title">🇹🇭 THAILAND</h2>
    
    <div class="hotel-grid-box">
        <!-- 左侧大卡片 -->
        <div class="hotel-card-large">
            <img class="bg-img" src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1000&q=80" alt="Sala Rattanakosin">
            <div class="overlay"></div>
            <button class="star-fav-btn" onclick="toggleStar(event, this)">☆</button>

            <div class="card-content">
                <div></div>
                <div class="large-card-info">
                    <div class="large-tags-row">
                        <span class="tag-green-pill">🚶‍♂️ 5 min walk</span>
                        <span class="tag-rating-pill"><span>★ 4.8</span> (890 reviews)</span>
                    </div>
                    <h2>Sala Rattanakosin</h2>
                    <p class="sub-location">📍 Near Wat Arun & Grand Palace, Bangkok</p>
                    <a href="detail.php?id=sala_rattanakosin" class="btn-explore">VIEW DETAILS & RATES →</a>
                </div>
            </div>
        </div>

        <!-- 右侧小卡片 1 -->
        <a href="detail.php?id=arun_residence" class="hotel-card-small">
            <button class="star-fav-btn" onclick="toggleStar(event, this)">☆</button>
            <div class="small-card-img">
                <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=500&q=80" alt="Arun Residence">
                <span class="hotel-walk-badge">🚶‍♂️ 2 min</span>
            </div>
            <div class="small-card-body">
                <div>
                    <div class="small-rating"><span class="star">★ 4.7</span> <span class="count">(310)</span></div>
                    <div class="small-title">Arun Residence</div>
                    <div class="small-location">📍 Near Wat Arun</div>
                </div>
                <div class="small-price">from <strong>RM 450</strong></div>
            </div>
        </a>

        <!-- 右侧小卡片 2 -->
        <a href="detail.php?id=sala_ayutthaya" class="hotel-card-small">
            <button class="star-fav-btn" onclick="toggleStar(event, this)">☆</button>
            <div class="small-card-img">
                <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=500&q=80" alt="Sala Ayutthaya">
                <span class="hotel-walk-badge">📍 Adjacent</span>
            </div>
            <div class="small-card-body">
                <div>
                    <div class="small-rating"><span class="star">★ 4.9</span> <span class="count">(450)</span></div>
                    <div class="small-title">Sala Ayutthaya</div>
                    <div class="small-location">📍 Near Ayutthaya Ruins</div>
                </div>
                <div class="small-price">from <strong>RM 550</strong></div>
            </div>
        </a>

        <!-- 右侧小卡片 3 -->
        <a href="detail.php?id=phulay_bay" class="hotel-card-small">
            <button class="star-fav-btn" onclick="toggleStar(event, this)">☆</button>
            <div class="small-card-img">
                <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=500&q=80" alt="Phulay Bay">
                <span class="hotel-walk-badge">🏖 Beachfront</span>
            </div>
            <div class="small-card-body">
                <div>
                    <div class="small-rating"><span class="star">★ 4.9</span> <span class="count">(680)</span></div>
                    <div class="small-title">Phulay Bay Krabi</div>
                    <div class="small-location">📍 Near Krabi Beach</div>
                </div>
                <div class="small-price">from <strong>RM 1,550</strong></div>
            </div>
        </a>

        <!-- 右侧小卡片 4 -->
        <a href="detail.php?id=amari_phuket" class="hotel-card-small">
            <button class="star-fav-btn" onclick="toggleStar(event, this)">☆</button>
            <div class="small-card-img">
                <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=500&q=80" alt="Amari Phuket">
                <span class="hotel-walk-badge">🏖 Ocean View</span>
            </div>
            <div class="small-card-body">
                <div>
                    <div class="small-rating"><span class="star">★ 4.8</span> <span class="count">(920)</span></div>
                    <div class="small-title">Amari Phuket</div>
                    <div class="small-location">📍 Near Patong Beach</div>
                </div>
                <div class="small-price">from <strong>RM 660</strong></div>
            </div>
        </a>
    </div>


    <!-- ================= 3. 🇮🇩 INDONESIA (1大4小) ================= -->
    <h2 class="country-section-title">🇮🇩 INDONESIA</h2>
    
    <div class="hotel-grid-box">
        <!-- 左侧大卡片 -->
        <div class="hotel-card-large">
            <img class="bg-img" src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1000&q=80" alt="Amankila Bali">
            <div class="overlay"></div>
            <button class="star-fav-btn" onclick="toggleStar(event, this)">☆</button>

            <div class="card-content">
                <div></div>
                <div class="large-card-info">
                    <div class="large-tags-row">
                        <span class="tag-green-pill">🌋 Cliffside View</span>
                        <span class="tag-rating-pill"><span>★ 5.0</span> (740 reviews)</span>
                    </div>
                    <h2>Amankila, Bali</h2>
                    <p class="sub-location">📍 Overlooking Badung Strait, Karangasem, Bali</p>
                    <a href="detail.php?id=amankila_bali" class="btn-explore">VIEW DETAILS & RATES →</a>
                </div>
            </div>
        </div>

        <!-- 右侧小卡片 1 -->
        <a href="detail.php?id=padma_ubud" class="hotel-card-small">
            <button class="star-fav-btn" onclick="toggleStar(event, this)">☆</button>
            <div class="small-card-img">
                <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=500&q=80" alt="Padma Resort Ubud">
                <span class="hotel-walk-badge">🌿 Jungle View</span>
            </div>
            <div class="small-card-body">
                <div>
                    <div class="small-rating"><span class="star">★ 4.9</span> <span class="count">(1,120)</span></div>
                    <div class="small-title">Padma Resort Ubud</div>
                    <div class="small-location">📍 Near Payangan Forest, Bali</div>
                </div>
                <div class="small-price">from <strong>RM 780</strong></div>
            </div>
        </a>

        <!-- 右侧小卡片 2 -->
        <a href="detail.php?id=kempinski_jakarta" class="hotel-card-small">
            <button class="star-fav-btn" onclick="toggleStar(event, this)">☆</button>
            <div class="small-card-img">
                <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=500&q=80" alt="Hotel Indonesia Kempinski">
                <span class="hotel-walk-badge">🏙 City Center</span>
            </div>
            <div class="small-card-body">
                <div>
                    <div class="small-rating"><span class="star">★ 4.8</span> <span class="count">(850)</span></div>
                    <div class="small-title">Kempinski Jakarta</div>
                    <div class="small-location">📍 Near Bundaran HI, Jakarta</div>
                </div>
                <div class="small-price">from <strong>RM 590</strong></div>
            </div>
        </a>

        <!-- 右侧小卡片 3 -->
        <a href="detail.php?id=plataran_borobudur" class="hotel-card-small">
            <button class="star-fav-btn" onclick="toggleStar(event, this)">☆</button>
            <div class="small-card-img">
                <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=500&q=80" alt="Plataran Borobudur">
                <span class="hotel-walk-badge">🏛 Heritage</span>
            </div>
            <div class="small-card-body">
                <div>
                    <div class="small-rating"><span class="star">★ 4.9</span> <span class="count">(490)</span></div>
                    <div class="small-title">Plataran Borobudur</div>
                    <div class="small-location">📍 Near Borobudur Temple</div>
                </div>
                <div class="small-price">from <strong>RM 980</strong></div>
            </div>
        </a>

        <!-- 右侧小卡片 4 -->
        <a href="detail.php?id=ayana_bali" class="hotel-card-small">
            <button class="star-fav-btn" onclick="toggleStar(event, this)">☆</button>
            <div class="small-card-img">
                <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=500&q=80" alt="AYANA Resort Bali">
                <span class="hotel-walk-badge">🍹 Rock Bar Access</span>
            </div>
            <div class="small-card-body">
                <div>
                    <div class="small-rating"><span class="star">★ 4.9</span> <span class="count">(2,300)</span></div>
                    <div class="small-title">AYANA Resort & Spa</div>
                    <div class="small-location">📍 Near Jimbaran Bay, Bali</div>
                </div>
                <div class="small-price">from <strong>RM 890</strong></div>
            </div>
        </a>
    </div>


    <!-- ================= 4. 🇻🇳 VIETNAM (1大4小) ================= -->
    <h2 class="country-section-title">🇻🇳 VIETNAM</h2>
    
    <div class="hotel-grid-box">
        <!-- 左侧大卡片 -->
        <div class="hotel-card-large">
            <img class="bg-img" src="https://images.unsplash.com/photo-1528127269322-539801943592?auto=format&fit=crop&w=1000&q=80" alt="JW Marriott Phu Quoc">
            <div class="overlay"></div>
            <button class="star-fav-btn" onclick="toggleStar(event, this)">☆</button>

            <div class="card-content">
                <div></div>
                <div class="large-card-info">
                    <div class="large-tags-row">
                        <span class="tag-green-pill">🏖 Private Beach</span>
                        <span class="tag-rating-pill"><span>★ 4.9</span> (980 reviews)</span>
                    </div>
                    <h2>JW Marriott Phu Quoc</h2>
                    <p class="sub-location">📍 Khem Beach, Phu Quoc Island, Vietnam</p>
                    <a href="detail.php?id=jw_phuquoc" class="btn-explore">VIEW DETAILS & RATES →</a>
                </div>
            </div>
        </div>

        <!-- 右侧小卡片 1 -->
        <a href="detail.php?id=metropole_hanoi" class="hotel-card-small">
            <button class="star-fav-btn" onclick="toggleStar(event, this)">☆</button>
            <div class="small-card-img">
                <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=500&q=80" alt="Sofitel Legend Metropole">
                <span class="hotel-walk-badge">🏛 Colonial Heritage</span>
            </div>
            <div class="small-card-body">
                <div>
                    <div class="small-rating"><span class="star">★ 4.9</span> <span class="count">(1,400)</span></div>
                    <div class="small-title">Metropole Hanoi</div>
                    <div class="small-location">📍 Near Hoan Kiem Lake, Hanoi</div>
                </div>
                <div class="small-price">from <strong>RM 980</strong></div>
            </div>
        </a>

        <!-- 右侧小卡片 2 -->
        <a href="detail.php?id=anantara_hoian" class="hotel-card-small">
            <button class="star-fav-btn" onclick="toggleStar(event, this)">☆</button>
            <div class="small-card-img">
                <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=500&q=80" alt="Anantara Hoi An Resort">
                <span class="hotel-walk-badge">🚶‍♂️ 5 min walk</span>
            </div>
            <div class="small-card-body">
                <div>
                    <div class="small-rating"><span class="star">★ 4.8</span> <span class="count">(610)</span></div>
                    <div class="small-title">Anantara Hoi An</div>
                    <div class="small-location">📍 Near Hoi An Ancient Town</div>
                </div>
                <div class="small-price">from <strong>RM 680</strong></div>
            </div>
        </a>

        <!-- 右侧小卡片 3 -->
        <a href="detail.php?id=intercon_danang" class="hotel-card-small">
            <button class="star-fav-btn" onclick="toggleStar(event, this)">☆</button>
            <div class="small-card-img">
                <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=500&q=80" alt="InterContinental Danang">
                <span class="hotel-walk-badge">🏔 Cliff Resort</span>
            </div>
            <div class="small-card-body">
                <div>
                    <div class="small-rating"><span class="star">★ 4.9</span> <span class="count">(830)</span></div>
                    <div class="small-title">InterContinental Danang</div>
                    <div class="small-location">📍 Son Tra Peninsula, Da Nang</div>
                </div>
                <div class="small-price">from <strong>RM 1,280</strong></div>
            </div>
        </a>

        <!-- 右侧小卡片 4 -->
        <a href="detail.php?id=park_hyatt_saigon" class="hotel-card-small">
            <button class="star-fav-btn" onclick="toggleStar(event, this)">☆</button>
            <div class="small-card-img">
                <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=500&q=80" alt="Park Hyatt Saigon">
                <span class="hotel-walk-badge">📍 City Heart</span>
            </div>
            <div class="small-card-body">
                <div>
                    <div class="small-rating"><span class="star">★ 4.8</span> <span class="count">(950)</span></div>
                    <div class="small-title">Park Hyatt Saigon</div>
                    <div class="small-location">📍 Near Opera House, HCMC</div>
                </div>
                <div class="small-price">from <strong>RM 880</strong></div>
            </div>
        </a>
    </div>

</div>

<!-- JS：阻止点击收藏星星时触发跳转详情页 -->
<script>
    function toggleStar(event, btn) {
        event.preventDefault(); // 阻止 <a> 标签的页面跳转
        event.stopPropagation(); // 阻止事件冒泡
        
        btn.classList.toggle('active');
        if (btn.classList.contains('active')) {
            btn.innerHTML = '★'; // 实心黄星
        } else {
            btn.innerHTML = '☆'; // 空心星
        }
    }
</script>

<?php 
if (file_exists('../footer.php')) {
    include '../footer.php';
} else if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/footer.php')) {
    include $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
}
?>