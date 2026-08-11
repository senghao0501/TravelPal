<?php 
include '../header.php'; 
?>

<link rel="stylesheet" href="/TravelPal/restaurant/restaurant.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<section class="welcome-hero">
    <div class="welcome-badge">TASTE THE BEST OF SEA</div>
    <h1>Discover Local Flavors <span class="plane-icon">🍴</span></h1>
    <p class="subtitle">Find top-rated restaurants across Thailand, Vietnam, Indonesia, and Malaysia.</p>
</section>


<section class="search-container">
    <div class="search">
        <input type="text" id="searchBar" placeholder="Search for dishes, restaurants, or cities...">
        <button type="button" onclick="navigateSearch()" id="searching" title="Search"></button>
    </div>
    <div class="error-message" id="searchError"></div>
</section>


<section class="scrolling-section">
    <h2>Taste of Malaysia<br><span>Rich spices and vibrant street food culture</span></h2>
    <div class="slider-wrapper">
        <div class="images" id="slider-malaysia">
            <!-- 1. Kuala Lumpur -->
			<a href="detail.php">
            <div class="image-card"><img src="https://images.unsplash.com/photo-1559314809-0d155014e29e?w=500&q=80" alt="KL Food"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">Madam Kwan's</span><span class="country-tag">Kuala Lumpur</span></div></div>
			</a>
            <!-- 2. Penang -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1565299624-44c66f470508?w=500&q=80" alt="Penang Food"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">Line Clear Nasi Kandar</span><span class="country-tag">Penang</span></div></div>
            <!-- 3. Melaka -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1627067828062-8e108d8e1247?w=500&q=80" alt="Melaka Food"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">Jonker 88</span><span class="country-tag">Melaka</span></div></div>
            <!-- 4. Perak (Ipoh) -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1625944525533-473f1a3d54e7?w=500&q=80" alt="Ipoh Food"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">Lou Wong Bean Sprout Chicken</span><span class="country-tag">Perak</span></div></div>
            <!-- 5. Johor -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=500&q=80" alt="Johor Food"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">Restoran Hua Mui</span><span class="country-tag">Johor</span></div></div>
            <!-- 6. Sarawak (Kuching) -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500&q=80" alt="Sarawak Food"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">Lepau Restaurant</span><span class="country-tag">Sarawak</span></div></div>
            <!-- 7. Sabah (Kota Kinabalu) -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1534080564583-6be75777b70a?w=500&q=80" alt="Sabah Seafood"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">Welcome Seafood</span><span class="country-tag">Sabah</span></div></div>
            <!-- 8. Kedah (Langkawi) -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1606527581699-2826fc5d2a6a?w=500&q=80" alt="Kedah Food"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">The Cliff Restaurant</span><span class="country-tag">Kedah</span></div></div>
        </div>
        <button type="button" class="next-arrow" onclick="scrollSlider('slider-malaysia')" title="Next">➔</button>
    </div>
</section>


<section class="scrolling-section">
    <h2>Must-Try in Thailand<br><span>The perfect balance of sweet, sour, spicy, and salty</span></h2>
    <div class="slider-wrapper">
        <div class="images" id="slider-thailand">
            <!-- 1. Bangkok -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=500&q=80" alt="Bangkok"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">Blue Elephant</span><span class="country-tag">Bangkok</span></div></div>
            <!-- 2. Chiang Mai -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1564834724105-918b73d1b9e0?w=500&q=80" alt="Chiang Mai"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">Khao Soi Mae Sai</span><span class="country-tag">Chiang Mai</span></div></div>
            <!-- 3. Phuket -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1544148103-0773bf10d330?w=500&q=80" alt="Phuket"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">Raya Restaurant</span><span class="country-tag">Phuket</span></div></div>
            <!-- 4. Chonburi (Pattaya) -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1626804475297-41609ea004eb?w=500&q=80" alt="Chonburi"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">The Glass House</span><span class="country-tag">Chonburi</span></div></div>
            <!-- 5. Krabi -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1565557618462-06b9cc86e582?w=500&q=80" alt="Krabi"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">The Grotto</span><span class="country-tag">Krabi</span></div></div>
            <!-- 6. Prachuap Khiri Khan (Hua Hin) -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=500&q=80" alt="Hua Hin"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">Chao Lay Seafood</span><span class="country-tag">Prachuap Khiri Khan</span></div></div>
            <!-- 7. Ayutthaya -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1534080564583-6be75777b70a?w=500&q=80" alt="Ayutthaya"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">Sala Ayutthaya Eatery</span><span class="country-tag">Ayutthaya</span></div></div>
            <!-- 8. Khon Kaen -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1514933651103-005eec06c04b?w=500&q=80" alt="Khon Kaen"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">Kai Yang Rabeab</span><span class="country-tag">Khon Kaen</span></div></div>
        </div>
        <button type="button" class="next-arrow" onclick="scrollSlider('slider-thailand')" title="Next">➔</button>
    </div>
</section>


<section class="scrolling-section">
    <h2>Vietnam Flavors<br><span>Fresh herbs, pho, and authentic street eats</span></h2>
    <div class="slider-wrapper">
        <div class="images" id="slider-vietnam">
            <!-- 1. Ho Chi Minh City -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1582878826629-29b7ad1cdc43?w=500&q=80" alt="HCMC"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">Secret Garden</span><span class="country-tag">Ho Chi Minh City</span></div></div>
            <!-- 2. Hanoi -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=500&q=80" alt="Hanoi"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">Bun Cha Huong Lien</span><span class="country-tag">Hanoi</span></div></div>
            <!-- 3. Da Nang -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1559314809-0d155014e29e?w=500&q=80" alt="Da Nang"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">Ngon Villa</span><span class="country-tag">Da Nang</span></div></div>
            <!-- 4. Quang Nam (Hoi An) -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1627067828062-8e108d8e1247?w=500&q=80" alt="Hoi An"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">Morning Glory Original</span><span class="country-tag">Quang Nam</span></div></div>
            <!-- 5. Thua Thien Hue (Hue) -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1564834724105-918b73d1b9e0?w=500&q=80" alt="Hue"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">Hanh Restaurant</span><span class="country-tag">Hue</span></div></div>
            <!-- 6. Khanh Hoa (Nha Trang) -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1565557618462-06b9cc86e582?w=500&q=80" alt="Nha Trang"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">Sailing Club</span><span class="country-tag">Khanh Hoa</span></div></div>
            <!-- 7. Lam Dong (Da Lat) -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500&q=80" alt="Da Lat"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">Goc Ha Thanh</span><span class="country-tag">Lam Dong</span></div></div>
            <!-- 8. Kien Giang (Phu Quoc) -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=500&q=80" alt="Phu Quoc"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">Xin Chao Restaurant</span><span class="country-tag">Kien Giang</span></div></div>
        </div>
        <button type="button" class="next-arrow" onclick="scrollSlider('slider-vietnam')" title="Next">➔</button>
    </div>
</section>


<section class="scrolling-section">
    <h2>Indonesia Delights<br><span>Discover the rich archipelago flavors</span></h2>
    <div class="slider-wrapper">
        <div class="images" id="slider-indonesia">
            <!-- 1. Bali -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?w=500&q=80" alt="Bali"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">Bebek Bengil</span><span class="country-tag">Bali</span></div></div>
            <!-- 2. Jakarta -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1565557618462-06b9cc86e582?w=500&q=80" alt="Jakarta"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">Bandar Djakarta</span><span class="country-tag">Jakarta</span></div></div>
            <!-- 3. Special Region of Yogyakarta -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=500&q=80" alt="Yogyakarta"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">House of Raminten</span><span class="country-tag">Yogyakarta</span></div></div>
            <!-- 4. West Java (Bandung) -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1626804475297-41609ea004eb?w=500&q=80" alt="West Java"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">Kampung Daun</span><span class="country-tag">West Java</span></div></div>
            <!-- 5. East Java (Surabaya) -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1544148103-0773bf10d330?w=500&q=80" alt="East Java"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">Layar Seafood</span><span class="country-tag">East Java</span></div></div>
            <!-- 6. North Sumatra (Medan) -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1559314809-0d155014e29e?w=500&q=80" alt="North Sumatra"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">Tip Top Restaurant</span><span class="country-tag">North Sumatra</span></div></div>
            <!-- 7. West Nusa Tenggara (Lombok) -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=500&q=80" alt="Lombok"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">Asmara Restaurant</span><span class="country-tag">West Nusa Tenggara</span></div></div>
            <!-- 8. South Sulawesi (Makassar) -->
            <div class="image-card"><img src="https://images.unsplash.com/photo-1534080564583-6be75777b70a?w=500&q=80" alt="South Sulawesi"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><div class="image-info"><span class="place-name">Konro Karebosi</span><span class="country-tag">South Sulawesi</span></div></div>
        </div>
        <button type="button" class="next-arrow" onclick="scrollSlider('slider-indonesia')" title="Next">➔</button>
    </div>
</section>

<section class="top-picks-section">
    <h2 class="section-title" style="color: #111827;">Highest Rated</h2>
    <div class="slider-wrapper">
        <div id="topPicks" class="images">
            <!-- 1-8 -->
            <div class="pick-card"><img class="pick-image" src="https://images.unsplash.com/photo-1514933651103-005eec06c04b?w=500&q=80" alt="Bar"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><p>Canopy Rooftop Bar</p><div class="rating">⭐ 4.9 <span style="color:#777; font-size:0.8rem; font-weight:normal;">(Malaysia)</span></div></div>
            <div class="pick-card"><img class="pick-image" src="https://images.unsplash.com/photo-1544148103-0773bf10d330?w=500&q=80" alt="Dining"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><p>Gaggan Anand</p><div class="rating">⭐ 4.9 <span style="color:#777; font-size:0.8rem; font-weight:normal;">(Thailand)</span></div></div>
            <div class="pick-card"><img class="pick-image" src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=500&q=80" alt="BBQ"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><p>Naughty Nuri's</p><div class="rating">⭐ 4.8 <span style="color:#777; font-size:0.8rem; font-weight:normal;">(Indonesia)</span></div></div>
            <div class="pick-card"><img class="pick-image" src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=500&q=80" alt="Banh Mi"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><p>Bánh Mì Huỳnh Hoa</p><div class="rating">⭐ 4.8 <span style="color:#777; font-size:0.8rem; font-weight:normal;">(Vietnam)</span></div></div>
            <div class="pick-card"><img class="pick-image" src="https://images.unsplash.com/photo-1564834724105-918b73d1b9e0?w=500&q=80" alt="Seafood"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><p>Jay Fai</p><div class="rating">⭐ 4.9 <span style="color:#777; font-size:0.8rem; font-weight:normal;">(Thailand)</span></div></div>
            <div class="pick-card"><img class="pick-image" src="https://images.unsplash.com/photo-1559314809-0d155014e29e?w=500&q=80" alt="Local"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><p>Locavore</p><div class="rating">⭐ 4.8 <span style="color:#777; font-size:0.8rem; font-weight:normal;">(Indonesia)</span></div></div>
            <div class="pick-card"><img class="pick-image" src="https://images.unsplash.com/photo-1627067828062-8e108d8e1247?w=500&q=80" alt="Dining"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><p>De.Wan 1958</p><div class="rating">⭐ 4.7 <span style="color:#777; font-size:0.8rem; font-weight:normal;">(Malaysia)</span></div></div>
            <div class="pick-card"><img class="pick-image" src="https://images.unsplash.com/photo-1565557618462-06b9cc86e582?w=500&q=80" alt="Dining"><button type="button" class="save-btn" onclick="toggleSave(this)"><i class="far fa-star"></i></button><p>Cuc Gach Quan</p><div class="rating">⭐ 4.8 <span style="color:#777; font-size:0.8rem; font-weight:normal;">(Vietnam)</span></div></div>
        </div>
        <button type="button" class="next-arrow" onclick="scrollSlider('topPicks')" title="Next">➔</button>
    </div>
</section>


<script>
   
    function toggleSave(btn) {
        btn.classList.toggle('saved');
        const icon = btn.querySelector('i');
        
        if (btn.classList.contains('saved')) {
            icon.classList.remove('far');
            icon.classList.add('fas');
        } else {
            icon.classList.remove('fas');
            icon.classList.add('far');
        }
    }

   
    function scrollSlider(sliderId) {
        const slider = document.getElementById(sliderId);
        if (slider) {
            if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth - 10) {
                slider.scrollTo({ left: 0, behavior: "smooth" });
            } else {
                slider.scrollBy({ left: 270, behavior: "smooth" });
            }
        }
    }
</script>

<?php 
include '../footer.php'; 
?>