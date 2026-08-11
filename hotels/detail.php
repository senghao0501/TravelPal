<?php 
if (file_exists('../header.php')) {
    include '../header.php';
} else if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/header.php')) {
    include $_SERVER['DOCUMENT_ROOT'] . '/header.php';
}

// 1. 获取 URL 中的 id 参数，默认显示 mandarin_kl
$hotel_id = isset($_GET['id']) ? $_GET['id'] : 'mandarin_kl';

// 2. 所有酒店的数据字典 (全线统一使用马币 RM)
$hotels_data = [
    // === 🇲🇾 MALAYSIA ===
    'mandarin_kl' => [
        'name' => 'Mandarin Oriental, Kuala Lumpur',
        'location' => '📍 Near Petronas Twin Towers, Kuala Lumpur, Malaysia',
        'price' => 'RM 680',
        'main_img' => 'https://images.unsplash.com/photo-1596422846543-75c6fc197f07?auto=format&fit=crop&w=1000&q=80',
        'sub_img1' => 'https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=500&q=80',
        'sub_img2' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=500&q=80',
        'about' => 'Set between the iconic Petronas Twin Towers and KLCC Park, Mandarin Oriental offers world-class luxury, an infinity pool with park views, and exceptional dining.',
        'amenities' => ['🏊‍♂️ Infinity Pool', '📶 Free Wi-Fi', '🍸 Rooftop Bar', '🏋️‍♂️ Fitness Center', '💆‍♀️ Luxury Spa'],
        'highlights' => ['🚶‍♂️ 1 min walk to Petronas Twin Towers', '🚶‍♂️ 3 min walk to Suria KLCC Mall', '🚗 45 min drive from KLIA']
    ],
    'eo_penang' => [
        'name' => 'Eastern & Oriental Hotel (E&O)',
        'location' => '📍 George Town, Penang, Malaysia',
        'price' => 'RM 450',
        'main_img' => 'https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=1000&q=80',
        'sub_img1' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=500&q=80',
        'sub_img2' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=500&q=80',
        'about' => 'A colonial-era luxury hotel in George Town, Penang. The E&O offers sea-facing suites, classic hospitality, and timeless heritage charm.',
        'amenities' => ['🌊 Sea Views', '🏊‍♂️ Outdoor Pool', '📶 Free Wi-Fi', '🍳 Heritage Breakfast', '🍸 Palm Court Bar'],
        'highlights' => ['🏛 Located in UNESCO World Heritage Zone', '🚶‍♂️ 5 min walk to George Town Food Streets', '🚗 20 min drive to Penang Airport']
    ],
    'casa_del_rio' => [
        'name' => 'Casa del Rio Melaka',
        'location' => '📍 Near Jonker Street, Melaka, Malaysia',
        'price' => 'RM 380',
        'main_img' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=1000&q=80',
        'sub_img1' => 'https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=500&q=80',
        'sub_img2' => 'https://images.unsplash.com/photo-1596422846543-75c6fc197f07?auto=format&fit=crop&w=500&q=80',
        'about' => 'A Mediterranean-inspired boutique hotel situated on the banks of the historic Melaka River, just steps away from Jonker Street.',
        'amenities' => ['🚣‍♂️ Riverfront View', '🏊‍♂️ Infinity Pool', '📶 Free Wi-Fi', '🍳 Daily Breakfast', '🚗 Free Parking'],
        'highlights' => ['🚶‍♂️ 3 min walk to Jonker Street Night Market', '🚶‍♂️ 5 min walk to The Stadthuys', '🚗 1.5 hours drive from KL']
    ],
    'st_regis_langkawi' => [
        'name' => 'The St. Regis Langkawi',
        'location' => '📍 Near Eagle Square, Langkawi, Malaysia',
        'price' => 'RM 890',
        'main_img' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1000&q=80',
        'sub_img1' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=500&q=80',
        'sub_img2' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=500&q=80',
        'about' => 'Nestled between an ancient rainforest and the Andaman Sea, offering luxurious suites, private villas, and butler service.',
        'amenities' => ['🏖 Private Beach', '🤵 24-hr St. Regis Butler', '🏊‍♂️ Infinity Pool', '💆‍♀️ Iridium Spa', '🍸 Kayuputi Overwater Bar'],
        'highlights' => ['🚗 20 min drive from Langkawi Airport', '🚶‍♂️ 5 min to Kuah Jetty', '🌊 Private Cove Beachfront']
    ],
    'kapalai_resort' => [
        'name' => 'Kapalai Dive Resort',
        'location' => '📍 Near Sipadan Island, Sabah, Malaysia',
        'price' => 'RM 1,200',
        'main_img' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=1000&q=80',
        'sub_img1' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=500&q=80',
        'sub_img2' => 'https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=500&q=80',
        'about' => 'A luxury water village built on stilts over Ligitan Reef. Famous for world-class diving and transparent crystal waters.',
        'amenities' => ['🌊 Overwater Chalets', '🤿 Scuba Diving Center', '🍳 All-inclusive Meals', '📶 Wi-Fi Available', '🌅 Sunset Deck'],
        'highlights' => ['🚤 45 min boat ride from Semporna', '🐠 World-famous Sipadan Diving Spot', '🐢 Turtle Spotting Deck']
    ],

    // === 🇹🇭 THAILAND (已自动换算为马币 RM) ===
    'sala_rattanakosin' => [
        'name' => 'Sala Rattanakosin Bangkok',
        'location' => '📍 Near Wat Arun & Grand Palace, Bangkok, Thailand',
        'price' => 'RM 620', // 原 4,800 THB 换算为马币
        'main_img' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1000&q=80',
        'sub_img1' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=500&q=80',
        'sub_img2' => 'https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=500&q=80',
        'about' => 'Scenic riverfront boutique hotel directly facing Wat Arun (Temple of Dawn) across the Chao Phraya River.',
        'amenities' => ['🛕 Temple View Suites', '🍸 Rooftop Bar', '📶 Free Wi-Fi', '🍳 Riverfront Restaurant'],
        'highlights' => ['🚶‍♂️ 5 min walk to Grand Palace', '🚤 2 min to Tha Tien Pier', '🛕 Best Sunset View of Wat Arun']
    ],
    'arun_residence' => [
        'name' => 'Arun Residence',
        'location' => '📍 Near Wat Arun, Bangkok, Thailand',
        'price' => 'RM 450', // 原 3,500 THB 换算为马币
        'main_img' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1000&q=80',
        'sub_img1' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=500&q=80',
        'sub_img2' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=500&q=80',
        'about' => 'Cozy wooden Sino-Portuguese style house transformed into a heritage hotel along the Bangkok riverbank.',
        'amenities' => ['🍸 The Deck Rooftop Restaurant', '📶 Free Wi-Fi', '🍳 Breakfast Included', '❄️ Air Conditioning'],
        'highlights' => ['🚶‍♂️ 2 min walk to Wat Pho', '🚶‍♂️ 8 min walk to Grand Palace', '🚤 Direct River Access']
    ]
];

// 3. 匹配当前 ID 的酒店，匹配不到则默认显示第 1 个
$hotel = isset($hotels_data[$hotel_id]) ? $hotels_data[$hotel_id] : $hotels_data['mandarin_kl'];
?>

<link rel="stylesheet" href="../css/modules/hotels.css">

<div class="detail-wrapper">
    
    <!-- 1. 头部：动态酒店名 + 参考价格 -->
    <div class="detail-header">
        <div class="detail-header-left">
            <h1><?php echo htmlspecialchars($hotel['name']); ?></h1>
            <div class="sub-location">
                <?php echo htmlspecialchars($hotel['location']); ?>
            </div>
        </div>
        
        <div class="reference-price-box">
            <div class="price-label">Est. Avg Rate</div>
            <div>
                <span class="price-amount"><?php echo htmlspecialchars($hotel['price']); ?></span>
                <span class="price-unit">/ night</span>
            </div>
        </div>
    </div>

    <!-- 2. 动态图片展示区 -->
    <div class="detail-gallery">
        <img class="gallery-main-img" src="<?php echo $hotel['main_img']; ?>" alt="Main View">
        <div class="gallery-sub-grid">
            <img class="gallery-sub-img" src="<?php echo $hotel['sub_img1']; ?>" alt="Sub 1">
            <img class="gallery-sub-img" src="<?php echo $hotel['sub_img2']; ?>" alt="Sub 2">
        </div>
    </div>

    <!-- 3. 动态内容区域 -->
    <div class="detail-content-body">
        
        <!-- 关于酒店 -->
        <section class="detail-info-section">
            <h2>🏨 About this hotel</h2>
            <p><?php echo htmlspecialchars($hotel['about']); ?></p>
        </section>

        <!-- 设施服务 -->
        <section class="detail-info-section">
            <h2>✨ Popular Amenities</h2>
            <div class="amenities-tags">
                <?php foreach ($hotel['amenities'] as $amenity): ?>
                    <span class="amenity-chip"><?php echo htmlspecialchars($amenity); ?></span>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- 位置亮点 -->
        <section class="detail-info-section">
            <h2>📍 Location Highlights</h2>
            <ul>
                <?php foreach ($hotel['highlights'] as $highlight): ?>
                    <li><?php echo htmlspecialchars($highlight); ?></li>
                <?php endforeach; ?>
            </ul>
        </section>

    </div>
</div>

<?php 
if (file_exists('../footer.php')) {
    include '../footer.php';
} else if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/footer.php')) {
    include $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
}
?>