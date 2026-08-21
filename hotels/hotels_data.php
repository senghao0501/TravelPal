<?php
// 马来西亚 8 个州属，每州 8 家酒店，完美均衡的 Vibe 比例！
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
        'id' => 106, 'name' => 'Penang Hill Nature Retreat', 'state' => 'Penang', 'city' => 'Ayer Itam',
        'type' => 'Nature & Eco Lodge', 'vibe' => 'Highlands', 'price' => 310, 'rating' => 8.9, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'A tranquil rainforest retreat located up on the cool Penang Hill.'
    ],
    [
        'id' => 107, 'name' => 'Ferringhi Hot Springs Resort', 'state' => 'Penang', 'city' => 'Batu Ferringhi',
        'type' => 'Luxury Resort', 'vibe' => 'Hot Springs', 'price' => 430, 'rating' => 8.5, 'score_text' => 'Very Good',
        'img_main' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Enjoy therapeutic thermal pools right by the sea.'
    ],
    [
        'id' => 108, 'name' => 'Macalister Mansion', 'state' => 'Penang', 'city' => 'Georgetown',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 720, 'rating' => 9.4, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Boutique city hotel in a restored 100-year-old historic manor.'
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
        'id' => 203, 'name' => 'Johor Bahru Heritage Mansion', 'state' => 'Johor', 'city' => 'Johor Bahru',
        'type' => 'Heritage Boutique', 'vibe' => 'Heritage', 'price' => 410, 'rating' => 9.0, 'score_text' => 'Superb',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'A restored colonial building right in the heart of JB old town.'
    ],
    [
        'id' => 204, 'name' => 'Gunung Pulai Nature Resort', 'state' => 'Johor', 'city' => 'Pulai',
        'type' => 'Nature & Eco Lodge', 'vibe' => 'Highlands', 'price' => 320, 'rating' => 8.9, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Immerse yourself in lush rainforests and cool mountain air.'
    ],
    [
        'id' => 205, 'name' => 'Desaru Coast Hot Springs', 'state' => 'Johor', 'city' => 'Desaru Coast',
        'type' => 'Luxury Resort', 'vibe' => 'Hot Springs', 'price' => 490, 'rating' => 8.8, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Rejuvenate your senses with our exclusive natural hot springs.'
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
        'id' => 207, 'name' => 'Muar Antique Boutique', 'state' => 'Johor', 'city' => 'Muar',
        'type' => 'Heritage Boutique', 'vibe' => 'Heritage', 'price' => 280, 'rating' => 8.6, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Step back in time in this beautiful Muar riverside heritage building.'
    ],
    [
        'id' => 208, 'name' => 'Hard Rock Hotel Desaru Coast', 'state' => 'Johor', 'city' => 'Desaru Coast',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 540, 'rating' => 8.9, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Directly connected to Adventure Waterpark Desaru Coast.'
    ],

    // ==================== 3. SELANGOR (雪兰莪) ====================
    [
        'id' => 301, 'name' => 'Sunway Resort Hotel', 'state' => 'Selangor', 'city' => 'Sunway City',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 520, 'rating' => 9.1, 'score_text' => 'Superb',
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
        'id' => 303, 'name' => 'Klang Heritage Mansion', 'state' => 'Selangor', 'city' => 'Klang',
        'type' => 'Heritage Boutique', 'vibe' => 'Heritage', 'price' => 410, 'rating' => 9.0, 'score_text' => 'Superb',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Discover the royal town of Klang in this exquisite heritage stay.'
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
        'id' => 305, 'name' => 'Sepang Ocean Resort', 'state' => 'Selangor', 'city' => 'Sepang',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 430, 'rating' => 8.8, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Beautiful sunset beach views just minutes from KLIA.'
    ],
    [
        'id' => 306, 'name' => 'Cyberview Hot Springs Spa', 'state' => 'Selangor', 'city' => 'Cyberjaya',
        'type' => 'Nature & Eco Lodge', 'vibe' => 'Hot Springs', 'price' => 320, 'rating' => 8.6, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Lush tropical resort setting with full-service hot springs and spa.'
    ],
    [
        'id' => 307, 'name' => 'Selangor Colonial Inn', 'state' => 'Selangor', 'city' => 'Shah Alam',
        'type' => 'Heritage Boutique', 'vibe' => 'Heritage', 'price' => 360, 'rating' => 8.7, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Classic architecture combined with modern luxury in Shah Alam.'
    ],
    [
        'id' => 308, 'name' => 'Bukit Fraser Nature Lodge', 'state' => 'Selangor', 'city' => 'Fraser Hill',
        'type' => 'Nature & Eco Lodge', 'vibe' => 'Highlands', 'price' => 330, 'rating' => 8.8, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Escape the city heat to this beautiful highland retreat.'
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
        'id' => 404, 'name' => 'Melaka Straits Beach Resort', 'state' => 'Melaka', 'city' => 'Hatten City',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 290, 'rating' => 8.8, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Family-friendly hotel with infinity pool overlooking Straits of Malacca.'
    ],
    [
        'id' => 405, 'name' => 'Klebang Ocean Resort', 'state' => 'Melaka', 'city' => 'Klebang',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 220, 'rating' => 8.6, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Enjoy the famous Klebang beach with stunning oceanfront suites.'
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
        'id' => 407, 'name' => 'Gadek Hot Springs Retreat', 'state' => 'Melaka', 'city' => 'Alor Gajah',
        'type' => 'Nature & Eco Lodge', 'vibe' => 'Hot Springs', 'price' => 250, 'rating' => 8.7, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Relaxing eco-resort featuring the famous Gadek healing hot waters.'
    ],
    [
        'id' => 408, 'name' => 'Philea Resort & Spa', 'state' => 'Melaka', 'city' => 'Ayer Keroh',
        'type' => 'Nature & Eco Lodge', 'vibe' => 'Highlands', 'price' => 380, 'rating' => 8.5, 'score_text' => 'Very Good',
        'img_main' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Log-cabin style eco resort surrounded by nature and pine trees.'
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
        'id' => 503, 'name' => 'Poring Hot Springs Resort', 'state' => 'Sabah', 'city' => 'Ranau',
        'type' => 'Nature & Eco Lodge', 'vibe' => 'Hot Springs', 'price' => 920, 'rating' => 9.4, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Soak in sulphuric hot springs deep within the Kinabalu National Park.'
    ],
    [
        'id' => 504, 'name' => 'Kota Kinabalu Heritage Inn', 'state' => 'Sabah', 'city' => 'Kota Kinabalu',
        'type' => 'Heritage Boutique', 'vibe' => 'Heritage', 'price' => 450, 'rating' => 8.8, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Experience the rich cultural heritage of North Borneo in pure comfort.'
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
        'id' => 507, 'name' => 'Sandakan Cultural Boutique', 'state' => 'Sabah', 'city' => 'Sandakan',
        'type' => 'Heritage Boutique', 'vibe' => 'Heritage', 'price' => 1400, 'rating' => 9.6, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'A unique stay steeped in the history of pre-war Sandakan.'
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
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Seaside resort at Mount Santubong foot, near Sarawak Cultural Village.'
    ],
    [
        'id' => 603, 'name' => 'Kuching Old Town Boutique', 'state' => 'Sarawak', 'city' => 'Kuching',
        'type' => 'Heritage Boutique', 'vibe' => 'Heritage', 'price' => 350, 'rating' => 9.0, 'score_text' => 'Superb',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Experience the history of Sarawak in this beautifully restored shophouse.'
    ],
    [
        'id' => 604, 'name' => 'Miri Marriott Resort & Spa', 'state' => 'Sarawak', 'city' => 'Miri',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 390, 'rating' => 8.9, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
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
        'id' => 607, 'name' => 'Annah Rais Hot Springs Lodge', 'state' => 'Sarawak', 'city' => 'Padawan',
        'type' => 'Nature & Eco Lodge', 'vibe' => 'Hot Springs', 'price' => 210, 'rating' => 8.4, 'score_text' => 'Very Good',
        'img_main' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Soak in the natural hot springs deeply rooted in Bidayuh culture.'
    ],
    [
        'id' => 608, 'name' => 'Mulu Marriott Resort & Spa', 'state' => 'Sarawak', 'city' => 'Mulu',
        'type' => 'Nature & Eco Lodge', 'vibe' => 'Highlands', 'price' => 620, 'rating' => 9.5, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
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
        'type' => 'Heritage Boutique', 'vibe' => 'Heritage', 'price' => 640, 'rating' => 9.2, 'score_text' => 'Exceptional',
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
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
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
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 280, 'rating' => 8.4, 'score_text' => 'Very Good',
        'img_main' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Perched 6,000 feet above sea level with indoor heated pool.'
    ],
    [
        'id' => 706, 'name' => 'Lakehouse Cameron Highlands', 'state' => 'Pahang', 'city' => 'Ringlet',
        'type' => 'Heritage Boutique', 'vibe' => 'Heritage', 'price' => 590, 'rating' => 9.3, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Charming English country house overlooking Sultan Abu Bakar Lake.'
    ],
    [
        'id' => 707, 'name' => 'Bentong Hot Springs Retreat', 'state' => 'Pahang', 'city' => 'Bentong',
        'type' => 'Nature & Eco Lodge', 'vibe' => 'Hot Springs', 'price' => 310, 'rating' => 8.6, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Relax and detoxify in natural hot springs surrounded by greenery.'
    ],
    [
        'id' => 708, 'name' => 'Colmar Tropicale Berjaya Hills', 'state' => 'Pahang', 'city' => 'Bukit Tinggi',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 240, 'rating' => 8.3, 'score_text' => 'Very Good',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
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
        'desc' => 'Luxury geothermal hot spring sanctuary set amidst limestone hills.'
    ],
    [
        'id' => 802, 'name' => 'Pangkor Laut Resort', 'state' => 'Perak', 'city' => 'Pangkor Island',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 980, 'rating' => 9.4, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
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
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 450, 'rating' => 9.1, 'score_text' => 'Superb',
        'img_main' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Eco-resort set around a naturally formed lake and limestone rock outcrops.'
    ],
    [
        'id' => 805, 'name' => 'M Roof Hotel & Residences', 'state' => 'Perak', 'city' => 'Ipoh',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 220, 'rating' => 8.7, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Trendy boutique hotel with stylish Scandinavian-inspired architecture.'
    ],
    [
        'id' => 806, 'name' => 'Belum Rainforest Resort', 'state' => 'Perak', 'city' => 'Gerik',
        'type' => 'Nature & Eco Lodge', 'vibe' => 'Highlands', 'price' => 380, 'rating' => 8.8, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Gateway to Royal Belum State Park, one of the world\'s oldest rainforests.'
    ],
    [
        'id' => 807, 'name' => 'Ipoh French Hotel', 'state' => 'Perak', 'city' => 'Ipoh',
        'type' => 'Heritage Boutique', 'vibe' => 'Heritage', 'price' => 160, 'rating' => 8.5, 'score_text' => 'Very Good',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Cozy modern boutique stay located in the heart of Ipoh old town.'
    ],
    [
        'id' => 808, 'name' => 'Hotel Regal Vista Ipoh', 'state' => 'Perak', 'city' => 'Ipoh',
        'type' => 'Heritage Boutique', 'vibe' => 'Heritage', 'price' => 180, 'rating' => 8.3, 'score_text' => 'Very Good',
        'img_main' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Convenient heritage-style hotel offering great value for travelers.'
    ]
];

// ==========================================
// 动态评论生成器（保证每家酒店都有 10 条高质量评论）
// ==========================================
$master_review_pool = [
    ['user' => 'Lim Kok Wai', 'date' => '2026-04-12', 'rating' => 9, 'comment' => 'Very pleasant stay! Clean rooms and friendly front desk staff.'],
    ['user' => 'Siti Nurhaliza', 'date' => '2026-04-05', 'rating' => 10, 'comment' => 'Exceptional hospitality. Will definitely choose this hotel again.'],
    ['user' => 'John Smith', 'date' => '2026-03-20', 'rating' => 8, 'comment' => 'Good location, convenient to get around. Room was comfortable.'],
    ['user' => 'Tan Mei Yee', 'date' => '2026-03-15', 'rating' => 9, 'comment' => 'Loved the interior design and the atmosphere. Great value for money.'],
    ['user' => 'Mohd Rizal', 'date' => '2026-03-10', 'rating' => 8, 'comment' => 'Satisfied with the overall experience. Decent breakfast and fast check-in.'],
    ['user' => 'Jessica Wong', 'date' => '2026-02-28', 'rating' => 10, 'comment' => 'Amazing views and top-notch facilities. Highly recommended!'],
    ['user' => 'David Tan', 'date' => '2026-02-14', 'rating' => 9, 'comment' => 'Quiet environment, perfect for a weekend relaxation.'],
    ['user' => 'Farhanah B.', 'date' => '2026-01-30', 'rating' => 8, 'comment' => 'Nice hotel with great service. Cleanliness can be slightly improved, but overall great.'],
    ['user' => 'Alex Turner', 'date' => '2026-01-15', 'rating' => 9, 'comment' => 'Superb location near local attractions. Staff were very helpful with recommendations.'],
    ['user' => 'Grace Lee', 'date' => '2026-01-02', 'rating' => 10, 'comment' => 'A wonderful experience from start to finish. Exceeded expectations!'],
    ['user' => 'Ahmad Faizal', 'date' => '2026-05-11', 'rating' => 9, 'comment' => 'Spacious room and very comfortable bed. Will come back.'],
    ['user' => 'Chloe Chen', 'date' => '2026-05-02', 'rating' => 10, 'comment' => 'Stunning rooftop pool and great sunset view.'],
    ['user' => 'Raj Kumar', 'date' => '2026-04-20', 'rating' => 8, 'comment' => 'Smooth check-in process and reliable Wi-Fi throughout the stay.']
];

foreach ($all_hotels as &$hotel) {
    if (!isset($hotel['reviews'])) {
        $hotel['reviews'] = [];
    }
    
    $existing_users = [];
    $existing_comments = [];
    
    foreach ($hotel['reviews'] as $rev) {
        $existing_users[] = $rev['user'];
        $existing_comments[] = $rev['comment'];
    }
    
    $available_pool = [];
    foreach ($master_review_pool as $pool_item) {
        if (!in_array($pool_item['user'], $existing_users) && !in_array($pool_item['comment'], $existing_comments)) {
            $available_pool[] = $pool_item;
        }
    }
    
    shuffle($available_pool);
    
    $pool_index = 0;
    while (count($hotel['reviews']) < 10 && isset($available_pool[$pool_index])) {
        $hotel['reviews'][] = $available_pool[$pool_index];
        $existing_users[] = $available_pool[$pool_index]['user'];
        $existing_comments[] = $available_pool[$pool_index]['comment'];
        $pool_index++;
    }
}
unset($hotel);
?>