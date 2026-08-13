<?php
// 马来西亚 8 个州属，每州 8 家酒店（共 64 家完整真实数据）
$all_hotels = [
    // ==================== 1. PENANG (槟城) ====================
    [
        'id' => 101, 'name' => 'Eastern & Oriental Hotel', 'state' => 'Penang', 'city' => 'Georgetown',
        'type' => 'Heritage Boutique', 'vibe' => 'Heritage', 'price' => 580, 'rating' => 9.3, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Colonial-style luxury suite right by the sea in historic Georgetown.'
    ],
    [
        'id' => 102, 'name' => 'Shangri-La Rasa Sayang Resort', 'state' => 'Penang', 'city' => 'Batu Ferringhi',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 650, 'rating' => 9.1, 'score_text' => 'Superb',
        'img_main' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Iconic beachfront sanctuary surrounded by centuries-old rain trees.'
    ],
    [
        'id' => 103, 'name' => 'The Prestige Hotel Penang', 'state' => 'Penang', 'city' => 'Georgetown',
        'type' => 'Heritage Boutique', 'vibe' => 'Heritage', 'price' => 420, 'rating' => 9.0, 'score_text' => 'Superb',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Victorian-inspired modern luxury near Church Street Pier.'
    ],
    [
        'id' => 104, 'name' => 'G Hotel Gurney', 'state' => 'Penang', 'city' => 'Gurney Drive',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 390, 'rating' => 8.8, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Ultra-stylish hotel adjacent to Gurney Plaza & famous hawker food.'
    ],
    [
        'id' => 105, 'name' => 'Hard Rock Hotel Penang', 'state' => 'Penang', 'city' => 'Batu Ferringhi',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 480, 'rating' => 8.7, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'High-energy music-themed beach resort featuring a massive lagoon pool.'
    ],
    [
        'id' => 106, 'name' => 'Seven Terraces', 'state' => 'Penang', 'city' => 'Georgetown',
        'type' => 'Heritage Boutique', 'vibe' => 'Heritage', 'price' => 510, 'rating' => 9.2, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Restored Anglo-Chinese shophouses with Peranakan antiques.'
    ],
    [
        'id' => 107, 'name' => 'PARKROYAL Penang Resort', 'state' => 'Penang', 'city' => 'Batu Ferringhi',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 430, 'rating' => 8.9, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Tropical paradise resort with ocean views and water sports.'
    ],
    [
        'id' => 108, 'name' => 'Macalister Mansion', 'state' => 'Penang', 'city' => 'Georgetown',
        'type' => 'Heritage Boutique', 'vibe' => 'Heritage', 'price' => 720, 'rating' => 9.4, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Boutique hotel in a restored 100-year-old historic manor.'
    ],

    // ==================== 2. JOHOR (柔佛) ====================
    [
        'id' => 201, 'name' => 'Legoland Hotel Malaysia', 'state' => 'Johor', 'city' => 'Iskandar Puteri',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 550, 'rating' => 8.8, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Ultimate family destination with themed rooms and Lego activities.'
    ],
    [
        'id' => 202, 'name' => 'Anantara Desaru Coast Resort', 'state' => 'Johor', 'city' => 'Desaru Coast',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 890, 'rating' => 9.5, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'High-end beachfront sanctuary along the golden sands of Desaru.'
    ],
    [
        'id' => 203, 'name' => 'The Westin Desaru Coast Resort', 'state' => 'Johor', 'city' => 'Desaru Coast',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 620, 'rating' => 9.0, 'score_text' => 'Superb',
        'img_main' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Relaxing seaside retreat featuring Heavenly Spa and oceanfront dining.'
    ],
    [
        'id' => 204, 'name' => 'One&Only Desaru Coast', 'state' => 'Johor', 'city' => 'Desaru Coast',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 2400, 'rating' => 9.8, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Ultra-luxurious private suites nestled between lush rainforest and sea.'
    ],
    [
        'id' => 205, 'name' => 'Hard Rock Hotel Desaru Coast', 'state' => 'Johor', 'city' => 'Desaru Coast',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 490, 'rating' => 8.9, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Directly connected to Adventure Waterpark Desaru Coast.'
    ],
    [
        'id' => 206, 'name' => 'DoubleTree by Hilton Johor Bahru', 'state' => 'Johor', 'city' => 'Johor Bahru',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 310, 'rating' => 8.7, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Prime downtown location minutes away from Singapore Causeway.'
    ],
    [
        'id' => 207, 'name' => 'Amari Johor Bahru', 'state' => 'Johor', 'city' => 'Johor Bahru',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 280, 'rating' => 8.6, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Modern hotel steps away from Komtar JBCC and City Square malls.'
    ],
    [
        'id' => 208, 'name' => 'Renaissance Johor Bahru Hotel', 'state' => 'Johor', 'city' => 'Permas Jaya',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 340, 'rating' => 8.9, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Luxury 5-star hotel with award-winning Cantonese restaurant Wan Li.'
    ],

    // ==================== 3. SELANGOR (雪兰莪) ====================
    [
        'id' => 301, 'name' => 'Sunway Resort Hotel', 'state' => 'Selangor', 'city' => 'Sunway City',
        'type' => 'Luxury Resort', 'vibe' => 'All Stays', 'price' => 520, 'rating' => 9.1, 'score_text' => 'Superb',
        'img_main' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Direct access to Sunway Lagoon theme park and Pyramid shopping mall.'
    ],
    [
        'id' => 302, 'name' => 'One World Hotel', 'state' => 'Selangor', 'city' => 'Petaling Jaya',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 380, 'rating' => 8.9, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => '5-star hotel directly connected to 1 Utama Shopping Centre.'
    ],
    [
        'id' => 303, 'name' => 'Le Meridien Putrajaya', 'state' => 'Selangor', 'city' => 'Sepang',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 410, 'rating' => 9.0, 'score_text' => 'Superb',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Direct access to IOI City Mall with stylish modern accommodation.'
    ],
    [
        'id' => 304, 'name' => 'Avani Sepang Goldcoast Resort', 'state' => 'Selangor', 'city' => 'Sepang',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 490, 'rating' => 8.5, 'score_text' => 'Very Good',
        'img_main' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Overwater palm-shaped villa resort over the Malacca Straits.'
    ],
    [
        'id' => 305, 'name' => 'Sheraton Petaling Jaya Hotel', 'state' => 'Selangor', 'city' => 'Petaling Jaya',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 430, 'rating' => 8.8, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Contemporary high-rise hotel featuring a rooftop infinity pool.'
    ],
    [
        'id' => 306, 'name' => 'Cyberview Resort & Spa', 'state' => 'Selangor', 'city' => 'Cyberjaya',
        'type' => 'Nature & Eco Lodge', 'vibe' => 'Hot Springs', 'price' => 320, 'rating' => 8.6, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Lush tropical resort setting with full-service spa facilities.'
    ],
    [
        'id' => 307, 'name' => 'The Saujana Hotel Kuala Lumpur', 'state' => 'Selangor', 'city' => 'Shah Alam',
        'type' => 'Luxury Resort', 'vibe' => 'All Stays', 'price' => 360, 'rating' => 8.7, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Set amidst 160 hectares of tropical gardens and two 18-hole golf courses.'
    ],
    [
        'id' => 308, 'name' => 'Movenpick Hotel & Convention Centre KLIA', 'state' => 'Selangor', 'city' => 'Sepang',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 330, 'rating' => 8.8, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Islamic architectural masterpiece near KLIA airport with wellness pools.'
    ],

    // ==================== 4. MELAKA (马六甲) ====================
    [
        'id' => 401, 'name' => 'Casa del Rio Melaka', 'state' => 'Melaka', 'city' => 'Melaka River',
        'type' => 'Heritage Boutique', 'vibe' => 'Heritage', 'price' => 460, 'rating' => 9.2, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Mediterranean-style boutique hotel sits right on the historic Melaka River.'
    ],
    [
        'id' => 402, 'name' => 'The Majestic Malacca', 'state' => 'Melaka', 'city' => 'Georgetown',
        'type' => 'Heritage Boutique', 'vibe' => 'Heritage', 'price' => 490, 'rating' => 9.3, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => '1920s classic mansion reflecting rich Peranakan culture and luxury.'
    ],
    [
        'id' => 403, 'name' => 'Courtyard by Marriott Melaka', 'state' => 'Melaka', 'city' => 'Melaka City',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 310, 'rating' => 8.9, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Contemporary urban comfort close to Jonker Street night market.'
    ],
    [
        'id' => 404, 'name' => 'DoubleTree by Hilton Melaka', 'state' => 'Melaka', 'city' => 'Hatten City',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 290, 'rating' => 8.8, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Family-friendly hotel with infinity pool overlooking Straits of Malacca.'
    ],
    [
        'id' => 405, 'name' => 'The Pines Melaka', 'state' => 'Melaka', 'city' => 'Melaka City',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 220, 'rating' => 8.6, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Spacious suite rooms featuring local original artwork.'
    ],
    [
        'id' => 406, 'name' => 'Hatten Hotel Melaka', 'state' => 'Melaka', 'city' => 'Bandar Hilir',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 210, 'rating' => 8.4, 'score_text' => 'Very Good',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Heart of heritage city linked directly to Dataran Pahlawan Mall.'
    ],
    [
        'id' => 407, 'name' => 'Rosa Malacca', 'state' => 'Melaka', 'city' => 'Melaka City',
        'type' => 'Heritage Boutique', 'vibe' => 'Heritage', 'price' => 250, 'rating' => 8.7, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Industrial rustic design crafted from red bricks and timber.'
    ],
    [
        'id' => 408, 'name' => 'Philea Resort & Spa', 'state' => 'Melaka', 'city' => 'Ayer Keroh',
        'type' => 'Nature & Eco Lodge', 'vibe' => 'Highlands', 'price' => 380, 'rating' => 8.5, 'score_text' => 'Very Good',
        'img_main' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Log-cabin style eco resort surrounded by natural waterfalls.'
    ],

    // ==================== 5. SABAH (沙巴) ====================
    [
        'id' => 501, 'name' => 'Shangri-La Tanjung Aru', 'state' => 'Sabah', 'city' => 'Kota Kinabalu',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 780, 'rating' => 9.3, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Famous for world-class sunsets at Sunset Bar and private beach.'
    ],
    [
        'id' => 502, 'name' => 'Shangri-La Rasa Ria Resort', 'state' => 'Sabah', 'city' => 'Tuaran',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 710, 'rating' => 9.2, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Bordered by ocean and tropical rainforest with private nature reserve.'
    ],
    [
        'id' => 503, 'name' => 'Gaya Island Resort', 'state' => 'Sabah', 'city' => 'Gaya Island',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 920, 'rating' => 9.4, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Eco-luxury island resort set within Tunku Abdul Rahman Marine Park.'
    ],
    [
        'id' => 504, 'name' => 'The Pacific Sutera Hotel', 'state' => 'Sabah', 'city' => 'Kota Kinabalu',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 450, 'rating' => 8.8, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Integrated resort with 27-hole golf course and private marina.'
    ],
    [
        'id' => 505, 'name' => 'Hyatt Regency Kinabalu', 'state' => 'Sabah', 'city' => 'Kota Kinabalu',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 380, 'rating' => 8.7, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Waterfront hotel in city center with views of South China Sea.'
    ],
    [
        'id' => 506, 'name' => 'Horizon Hotel Kota Kinabalu', 'state' => 'Sabah', 'city' => 'Kota Kinabalu',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 260, 'rating' => 8.5, 'score_text' => 'Very Good',
        'img_main' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Located directly on Gaya Street Sunday Night Market district.'
    ],
    [
        'id' => 507, 'name' => 'Sipadan Kapalai Dive Resort', 'state' => 'Sabah', 'city' => 'Semporna',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 1400, 'rating' => 9.6, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Water village built on stilts over Ligitan Reefs with world-class diving.'
    ],
    [
        'id' => 508, 'name' => 'Borneo Rainforest Lodge', 'state' => 'Sabah', 'city' => 'Danum Valley',
        'type' => 'Nature & Eco Lodge', 'vibe' => 'Highlands', 'price' => 1850, 'rating' => 9.7, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Nestled along Danum River in Sabah’s ancient primary rainforest.'
    ],

    // ==================== 6. SARAWAK (砂拉越) ====================
    [
        'id' => 601, 'name' => 'Pullman Kuching', 'state' => 'Sarawak', 'city' => 'Kuching',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 320, 'rating' => 8.8, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Perched atop Mathies Hill with panoramic views of Sarawak River.'
    ],
    [
        'id' => 602, 'name' => 'Damai Beach Resort', 'state' => 'Sarawak', 'city' => 'Santubong',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 280, 'rating' => 8.5, 'score_text' => 'Very Good',
        'img_main' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Seaside resort at Mount Santubong foot, near Sarawak Cultural Village.'
    ],
    [
        'id' => 603, 'name' => 'The Waterfront Hotel Kuching', 'state' => 'Sarawak', 'city' => 'Kuching',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 350, 'rating' => 9.0, 'score_text' => 'Superb',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Modern boutique luxury situated above Plaza Merdeka shopping mall.'
    ],
    [
        'id' => 604, 'name' => 'Miri Marriott Resort & Spa', 'state' => 'Sarawak', 'city' => 'Miri',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 390, 'rating' => 8.9, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Lush tropical paradise along Brighton Beach with freeform pool.'
    ],
    [
        'id' => 605, 'name' => 'Hilton Kuching', 'state' => 'Sarawak', 'city' => 'Kuching',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 360, 'rating' => 8.7, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Iconic riverfront landmark with views of the DUN state building.'
    ],
    [
        'id' => 606, 'name' => 'Cove 55 Kuching', 'state' => 'Sarawak', 'city' => 'Santubong',
        'type' => 'Heritage Boutique', 'vibe' => 'Heritage', 'price' => 580, 'rating' => 9.3, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Intimate luxury boutique retreat facing the South China Sea.'
    ],
    [
        'id' => 607, 'name' => 'Imperial Hotel Miri', 'state' => 'Sarawak', 'city' => 'Miri',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 210, 'rating' => 8.4, 'score_text' => 'Very Good',
        'img_main' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => '4-star hotel connected directly to Permaisuri Imperial City Mall.'
    ],
    [
        'id' => 608, 'name' => 'Mulu Marriott Resort & Spa', 'state' => 'Sarawak', 'city' => 'Mulu',
        'type' => 'Nature & Eco Lodge', 'vibe' => 'Highlands', 'price' => 620, 'rating' => 9.5, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Luxurious rainforest lodge near UNESCO World Heritage Mulu Caves.'
    ],

    // ==================== 7. PAHANG (彭亨) ====================
    [
        'id' => 701, 'name' => 'The Ritz-Carlton Genting Highlands', 'state' => 'Pahang', 'city' => 'Genting Highlands',
        'type' => 'Luxury Resort', 'vibe' => 'Highlands', 'price' => 880, 'rating' => 9.4, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'High-altitude luxury retreat with cool mountain breeze and forest views.'
    ],
    [
        'id' => 702, 'name' => 'The Cameron Highlands Resort', 'state' => 'Pahang', 'city' => 'Cameron Highlands',
        'type' => 'Heritage Boutique', 'vibe' => 'Highlands', 'price' => 640, 'rating' => 9.2, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Grand Tudor-style resort surrounded by tea plantations and rolling hills.'
    ],
    [
        'id' => 703, 'name' => 'Hyatt Regency Kuantan Resort', 'state' => 'Pahang', 'city' => 'Kuantan',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 420, 'rating' => 8.9, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Beachfront luxury resort along Teluk Cempedak beach.'
    ],
    [
        'id' => 704, 'name' => 'Club Med Cherating Beach', 'state' => 'Pahang', 'city' => 'Cherating',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 950, 'rating' => 9.1, 'score_text' => 'Superb',
        'img_main' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'All-inclusive eco-friendly resort in an unspoiled jungle sanctuary.'
    ],
    [
        'id' => 705, 'name' => 'Grand Ion Delemen Hotel', 'state' => 'Pahang', 'city' => 'Genting Highlands',
        'type' => 'City Hotel', 'vibe' => 'Highlands', 'price' => 280, 'rating' => 8.4, 'score_text' => 'Very Good',
        'img_main' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Perched 6,000 feet above sea level with indoor heated pool.'
    ],
    [
        'id' => 706, 'name' => 'Lakehouse Cameron Highlands', 'state' => 'Pahang', 'city' => 'Ringlet',
        'type' => 'Heritage Boutique', 'vibe' => 'Highlands', 'price' => 590, 'rating' => 9.3, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Charming English country house overlooking Sultan Abu Bakar Lake.'
    ],
    [
        'id' => 707, 'name' => 'Swiss-Garden Beach Resort Kuantan', 'state' => 'Pahang', 'city' => 'Balok Beach',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 310, 'rating' => 8.6, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Relaxing beachfront stay with outdoor splash pool for kids.'
    ],
    [
        'id' => 708, 'name' => 'Colmar Tropicale Berjaya Hills', 'state' => 'Pahang', 'city' => 'Bukit Tinggi',
        'type' => 'Heritage Boutique', 'vibe' => 'Highlands', 'price' => 240, 'rating' => 8.3, 'score_text' => 'Very Good',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'French-themed village resort modeled after 16th-century Colmar town.'
    ],

    // ==================== 8. PERAK (霹雳) ====================
    [
        'id' => 801, 'name' => 'The Banjaran Hotsprings Retreat', 'state' => 'Perak', 'city' => 'Ipoh',
        'type' => 'Nature & Eco Lodge', 'vibe' => 'Hot Springs', 'price' => 1250, 'rating' => 9.6, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Luxury geothermal hot spring sanctuary set amidst 260 million-year-old limestone hills.'
    ],
    [
        'id' => 802, 'name' => 'Pangkor Laut Resort', 'state' => 'Perak', 'city' => 'Pangkor Island',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 980, 'rating' => 9.4, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Exclusive private island resort featuring world-class sea villas.'
    ],
    [
        'id' => 803, 'name' => 'WEIL Hotel Ipoh', 'state' => 'Perak', 'city' => 'Ipoh',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 320, 'rating' => 8.9, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Adjoined to Ipoh Parade Shopping Mall, ideal for foodie staycations.'
    ],
    [
        'id' => 804, 'name' => 'The Haven All Suite Resort', 'state' => 'Perak', 'city' => 'Ipoh',
        'type' => 'Luxury Resort', 'vibe' => 'All Stays', 'price' => 450, 'rating' => 9.1, 'score_text' => 'Superb',
        'img_main' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Eco-resort set around a naturally formed lake and limestone rock outcrops.'
    ],
    [
        'id' => 805, 'name' => 'M roof Hotel & Residences', 'state' => 'Perak', 'city' => 'Ipoh',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 220, 'rating' => 8.7, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Trendy boutique hotel with stylish Scandinavian-inspired architecture.'
    ],
    [
        'id' => 806, 'name' => 'Belum Rainforest Resort', 'state' => 'Perak', 'city' => 'Gerik',
        'type' => 'Nature & Eco Lodge', 'vibe' => 'Highlands', 'price' => 380, 'rating' => 8.8, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Gateway to Royal Belum State Park, one of the world’s oldest rainforests.'
    ],
    [
        'id' => 807, 'name' => 'Ipoh French Hotel', 'state' => 'Perak', 'city' => 'Ipoh',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 160, 'rating' => 8.5, 'score_text' => 'Very Good',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Cozy modern boutique stay located in the heart of Ipoh old town.'
    ],
    [
        'id' => 808, 'name' => 'Hotel Regal Vista Ipoh', 'state' => 'Perak', 'city' => 'Ipoh',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 180, 'rating' => 8.3, 'score_text' => 'Very Good',
        'img_main' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Convenient city-center hotel offering great value for budget travelers.'
    ]
];