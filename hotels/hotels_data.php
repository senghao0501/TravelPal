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
        'desc' => 'Colonial-style luxury suite right by the sea in historic Georgetown.',
        'reviews' => [
            ['user' => 'Ahmad F.', 'date' => '2026-07-15', 'rating' => 10, 'comment' => 'Absolutely stunning heritage hotel! The sea view from our suite was breathtaking. Staff went above and beyond to make our stay special.'],
            ['user' => 'Sarah L.', 'date' => '2026-06-28', 'rating' => 9, 'comment' => 'Loved the colonial charm and the infinity pool overlooking the straits. Breakfast buffet had amazing local options.'],
            ['user' => 'Tan W.K.', 'date' => '2026-06-10', 'rating' => 9, 'comment' => 'Perfect location in Georgetown. Walked to all the heritage sites. Room was spacious with old-world elegance.'],
            ['user' => 'Rina M.', 'date' => '2026-05-22', 'rating' => 8, 'comment' => 'Beautiful hotel with rich history. The afternoon tea was a highlight. Would recommend to anyone visiting Penang.'],
            ['user' => 'David C.', 'date' => '2026-05-05', 'rating' => 10, 'comment' => 'One of the best hotels I have ever stayed at. Service was impeccable and the views were unforgettable.']
        ]
    ],
    [
        'id' => 102, 'name' => 'Shangri-La Rasa Sayang Resort', 'state' => 'Penang', 'city' => 'Batu Ferringhi',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 650, 'rating' => 9.1, 'score_text' => 'Superb',
        'img_main' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Iconic beachfront sanctuary surrounded by centuries-old rain trees.',
        'reviews' => [
            ['user' => 'Nadia Z.', 'date' => '2026-07-20', 'rating' => 10, 'comment' => 'The most beautiful sunset views I have ever seen! The pool area is spectacular and the service is world-class.'],
            ['user' => 'Kamarul A.', 'date' => '2026-07-02', 'rating' => 9, 'comment' => 'Garden wing rooms are huge and well-maintained. The kids club kept my children entertained for hours.'],
            ['user' => 'Emily T.', 'date' => '2026-06-18', 'rating' => 9, 'comment' => 'Loved the spa treatments and the beachfront dining experience. Definitely coming back with my family.'],
            ['user' => 'Hafiz R.', 'date' => '2026-05-30', 'rating' => 8, 'comment' => 'Good resort but a bit pricey for the location. However, the facilities and service justify the cost.'],
            ['user' => 'Michelle L.', 'date' => '2026-05-12', 'rating' => 10, 'comment' => 'Perfect for a romantic getaway. The sunset bar is a must-visit! Staff are incredibly friendly.']
        ]
    ],
    [
        'id' => 103, 'name' => 'The Prestige Hotel Penang', 'state' => 'Penang', 'city' => 'Georgetown',
        'type' => 'Heritage Boutique', 'vibe' => 'Heritage', 'price' => 420, 'rating' => 9.0, 'score_text' => 'Superb',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Victorian-inspired modern luxury near Church Street Pier.',
        'reviews' => [
            ['user' => 'Lina C.', 'date' => '2026-07-18', 'rating' => 9, 'comment' => 'Gorgeous boutique hotel with amazing interior design. The rooftop bar has a fantastic view of the city.'],
            ['user' => 'Alex N.', 'date' => '2026-06-25', 'rating' => 10, 'comment' => 'Staff were extremely welcoming and helpful. The room was spotless and very comfortable.'],
            ['user' => 'Wong P.Y.', 'date' => '2026-06-05', 'rating' => 8, 'comment' => 'Great location for exploring Penang. Breakfast spread was decent. Would stay again.'],
            ['user' => 'Farah D.', 'date' => '2026-05-20', 'rating' => 9, 'comment' => 'The building itself is a piece of art! Loved the fusion of old and new design elements.'],
            ['user' => 'Tommy L.', 'date' => '2026-05-01', 'rating' => 9, 'comment' => 'Excellent value for money. The room was spacious and the staff were very attentive.']
        ]
    ],
    [
        'id' => 104, 'name' => 'G Hotel Gurney', 'state' => 'Penang', 'city' => 'Gurney Drive',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 390, 'rating' => 8.8, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Ultra-stylish hotel adjacent to Gurney Plaza & famous hawker food.',
        'reviews' => [
            ['user' => 'Shahira I.', 'date' => '2026-07-16', 'rating' => 9, 'comment' => 'Perfect for shopaholics! Direct access to Gurney Plaza. The room was modern and very clean.'],
            ['user' => 'Jason K.', 'date' => '2026-06-20', 'rating' => 8, 'comment' => 'Great location for food lovers. Walking distance to Gurney Drive hawker center.'],
            ['user' => 'Siti N.', 'date' => '2026-06-08', 'rating' => 9, 'comment' => 'Loved the modern design and the infinity pool. Staff were very professional.'],
            ['user' => 'Kelvin O.', 'date' => '2026-05-25', 'rating' => 8, 'comment' => 'Good hotel for business travelers. Fast Wi-Fi and good work desk in the room.'],
            ['user' => 'Aina R.', 'date' => '2026-05-08', 'rating' => 9, 'comment' => 'Amazing breakfast with so many choices! The location is unbeatable for shopping.']
        ]
    ],
    [
        'id' => 105, 'name' => 'Hard Rock Hotel Penang', 'state' => 'Penang', 'city' => 'Batu Ferringhi',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 480, 'rating' => 8.7, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'High-energy music-themed beach resort featuring a massive lagoon pool.',
        'reviews' => [
            ['user' => 'Ben S.', 'date' => '2026-07-22', 'rating' => 9, 'comment' => 'Best pool ever! The music vibe is amazing and the staff are super friendly. Kids loved it.'],
            ['user' => 'Mira H.', 'date' => '2026-07-01', 'rating' => 10, 'comment' => 'Had a blast at the Hard Rock! The live band at night was phenomenal. Great for families and couples.'],
            ['user' => 'Raja A.', 'date' => '2026-06-15', 'rating' => 8, 'comment' => 'The pool is huge but can get crowded. Rooms were comfortable and the beach is just steps away.'],
            ['user' => 'Elena G.', 'date' => '2026-05-28', 'rating' => 9, 'comment' => 'Fun atmosphere with great music all day. The room had all the amenities we needed.'],
            ['user' => 'Faisal M.', 'date' => '2026-05-10', 'rating' => 9, 'comment' => 'Great for a weekend getaway. Staff are very accommodating and the food was excellent.']
        ]
    ],
    [
        'id' => 106, 'name' => 'Seven Terraces', 'state' => 'Penang', 'city' => 'Georgetown',
        'type' => 'Heritage Boutique', 'vibe' => 'Heritage', 'price' => 510, 'rating' => 9.2, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Restored Anglo-Chinese shophouses with Peranakan antiques.',
        'reviews' => [
            ['user' => 'Peranakan C.', 'date' => '2026-07-19', 'rating' => 10, 'comment' => 'Truly authentic Peranakan experience! The antiques and decor are stunning. Felt like I stepped back in time.'],
            ['user' => 'Jonathan L.', 'date' => '2026-07-03', 'rating' => 9, 'comment' => 'Beautiful boutique hotel with incredible attention to detail. The staff were very knowledgeable about Peranakan history.'],
            ['user' => 'Wendy T.', 'date' => '2026-06-12', 'rating' => 9, 'comment' => 'The courtyard is so peaceful and serene. Breakfast served in the garden was a treat.'],
            ['user' => 'Hassan O.', 'date' => '2026-05-18', 'rating' => 8, 'comment' => 'Great heritage experience but rooms are a bit small. Still worth it for the unique atmosphere.'],
            ['user' => 'Pamela K.', 'date' => '2026-05-02', 'rating' => 10, 'comment' => 'Absolutely loved this place! Every corner is photo-worthy. Will come back again.']
        ]
    ],
    [
        'id' => 107, 'name' => 'PARKROYAL Penang Resort', 'state' => 'Penang', 'city' => 'Batu Ferringhi',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 430, 'rating' => 8.9, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Tropical paradise resort with ocean views and water sports.',
        'reviews' => [
            ['user' => 'Gina T.', 'date' => '2026-07-21', 'rating' => 9, 'comment' => 'Great family resort with plenty of activities for kids. The beach is well-maintained and safe.'],
            ['user' => 'Samantha R.', 'date' => '2026-07-05', 'rating' => 10, 'comment' => 'The ocean view from our room was spectacular! The sunset was magical every evening.'],
            ['user' => 'Ariff N.', 'date' => '2026-06-22', 'rating' => 8, 'comment' => 'Good resort but some facilities need upgrading. The staff were friendly and helpful.'],
            ['user' => 'Christine W.', 'date' => '2026-06-02', 'rating' => 9, 'comment' => 'Loved the water sports activities. The pool was also great for both kids and adults.'],
            ['user' => 'Zul K.', 'date' => '2026-05-15', 'rating' => 9, 'comment' => 'Very relaxing stay. The breakfast buffet had great local and international options.']
        ]
    ],
    [
        'id' => 108, 'name' => 'Macalister Mansion', 'state' => 'Penang', 'city' => 'Georgetown',
        'type' => 'Heritage Boutique', 'vibe' => 'Heritage', 'price' => 720, 'rating' => 9.4, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Boutique hotel in a restored 100-year-old historic manor.',
        'reviews' => [
            ['user' => 'Richard C.', 'date' => '2026-07-23', 'rating' => 10, 'comment' => 'Pure luxury! The attention to detail in every room is incredible. The service is world-class.'],
            ['user' => 'Nora M.', 'date' => '2026-07-08', 'rating' => 9, 'comment' => 'Feels like staying in a museum. The grounds are beautiful and the food is exquisite.'],
            ['user' => 'Jack L.', 'date' => '2026-06-17', 'rating' => 10, 'comment' => 'An unforgettable experience. The staff made us feel like royalty. Highly recommend for special occasions.'],
            ['user' => 'Lynn S.', 'date' => '2026-05-29', 'rating' => 8, 'comment' => 'Beautiful but expensive. The quality is there though. Perfect for a romantic getaway.'],
            ['user' => 'Hakim R.', 'date' => '2026-05-07', 'rating' => 9, 'comment' => 'One of the best boutique hotels in Malaysia. Great location and amazing hospitality.']
        ]
    ],

    // ==================== 2. JOHOR (柔佛) ====================
    [
        'id' => 201, 'name' => 'Legoland Hotel Malaysia', 'state' => 'Johor', 'city' => 'Iskandar Puteri',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 550, 'rating' => 8.8, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Ultimate family destination with themed rooms and Lego activities.',
        'reviews' => [
            ['user' => 'Family L.', 'date' => '2026-07-14', 'rating' => 10, 'comment' => 'My kids absolutely loved it! The Lego themed room was incredible. Will definitely come back.'],
            ['user' => 'Sara H.', 'date' => '2026-06-30', 'rating' => 9, 'comment' => 'Great for families with young children. The playground and activities kept my son busy all day.'],
            ['user' => 'Chris P.', 'date' => '2026-06-14', 'rating' => 8, 'comment' => 'Fun experience but can be crowded during peak season. Book early to avoid disappointment.'],
            ['user' => 'Anita W.', 'date' => '2026-05-26', 'rating' => 9, 'comment' => 'The breakfast spread was amazing and the staff were very friendly. Great value for money.'],
            ['user' => 'Rakesh N.', 'date' => '2026-05-09', 'rating' => 9, 'comment' => 'Kids had the time of their lives. The room had a treasure hunt which was a nice touch.']
        ]
    ],
    [
        'id' => 202, 'name' => 'Anantara Desaru Coast Resort', 'state' => 'Johor', 'city' => 'Desaru Coast',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 890, 'rating' => 9.5, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'High-end beachfront sanctuary along the golden sands of Desaru.',
        'reviews' => [
            ['user' => 'Vivian C.', 'date' => '2026-07-17', 'rating' => 10, 'comment' => 'Breathtaking property! The private beach was pristine and the villa was pure luxury.'],
            ['user' => 'Dato A.', 'date' => '2026-07-06', 'rating' => 10, 'comment' => 'World-class service. The staff anticipated our every need. A truly 5-star experience.'],
            ['user' => 'Megan T.', 'date' => '2026-06-21', 'rating' => 9, 'comment' => 'Beautiful resort with amazing infinity pool. The food was delicious and the spa was heavenly.'],
            ['user' => 'Zainal B.', 'date' => '2026-06-04', 'rating' => 9, 'comment' => 'Perfect place for a romantic escape. The sunset views from the beach are unforgettable.'],
            ['user' => 'Grace L.', 'date' => '2026-05-14', 'rating' => 10, 'comment' => 'Absolutely stunning! Every detail was perfect. Will come back with my family.']
        ]
    ],
    [
        'id' => 203, 'name' => 'The Westin Desaru Coast Resort', 'state' => 'Johor', 'city' => 'Desaru Coast',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 620, 'rating' => 9.0, 'score_text' => 'Superb',
        'img_main' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Relaxing seaside retreat featuring Heavenly Spa and oceanfront dining.',
        'reviews' => [
            ['user' => 'Chloe F.', 'date' => '2026-07-20', 'rating' => 9, 'comment' => 'The Heavenly Spa was amazing! The oceanfront dining experience was magical.'],
            ['user' => 'Eddie T.', 'date' => '2026-07-04', 'rating' => 9, 'comment' => 'Very relaxing environment. The pool was huge and the staff were very attentive.'],
            ['user' => 'Nina Y.', 'date' => '2026-06-19', 'rating' => 8, 'comment' => 'Great resort but the Wi-Fi was a bit slow. Otherwise everything was perfect.'],
            ['user' => 'Raj S.', 'date' => '2026-06-01', 'rating' => 9, 'comment' => 'Excellent for a weekend getaway. The breakfast buffet had a wide variety of options.'],
            ['user' => 'Pearly W.', 'date' => '2026-05-16', 'rating' => 10, 'comment' => 'Loved everything about this place! The rooms were spacious and the beach was clean.']
        ]
    ],
    [
        'id' => 204, 'name' => 'One&Only Desaru Coast', 'state' => 'Johor', 'city' => 'Desaru Coast',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 2400, 'rating' => 9.8, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Ultra-luxurious private suites nestled between lush rainforest and sea.',
        'reviews' => [
            ['user' => 'Sultan A.', 'date' => '2026-07-22', 'rating' => 10, 'comment' => 'Absolute perfection. The private pool villa was beyond amazing. Worth every penny.'],
            ['user' => 'Elaine H.', 'date' => '2026-07-09', 'rating' => 10, 'comment' => 'This is what true luxury looks like. Service, food, and facilities are all top-tier.'],
            ['user' => 'Victor N.', 'date' => '2026-06-23', 'rating' => 9, 'comment' => 'Incredible property but comes with a premium price. The experience is unforgettable though.'],
            ['user' => 'Sophia L.', 'date' => '2026-06-07', 'rating' => 10, 'comment' => 'The best resort I have ever visited. The staff remembered our names and preferences.'],
            ['user' => 'Kamal M.', 'date' => '2026-05-21', 'rating' => 10, 'comment' => 'A hidden paradise. The rainforest setting combined with the ocean view is breathtaking.']
        ]
    ],
    [
        'id' => 205, 'name' => 'Hard Rock Hotel Desaru Coast', 'state' => 'Johor', 'city' => 'Desaru Coast',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 490, 'rating' => 8.9, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Directly connected to Adventure Waterpark Desaru Coast.',
        'reviews' => [
            ['user' => 'Shamira A.', 'date' => '2026-07-18', 'rating' => 9, 'comment' => 'Perfect for families! The waterpark access was a huge bonus. Kids had a blast.'],
            ['user' => 'Ryan G.', 'date' => '2026-07-02', 'rating' => 8, 'comment' => 'Great hotel with good facilities. The room was comfortable and the pool area was fun.'],
            ['user' => 'Lisa T.', 'date' => '2026-06-16', 'rating' => 9, 'comment' => 'The rock and roll theme is really cool. Staff were very friendly and helpful.'],
            ['user' => 'Fazrin M.', 'date' => '2026-05-28', 'rating' => 9, 'comment' => 'Waterpark access made our stay extra special. The room was clean and spacious.'],
            ['user' => 'Natalie K.', 'date' => '2026-05-11', 'rating' => 8, 'comment' => 'Good value for money. Would definitely come back with the kids again.']
        ]
    ],
    [
        'id' => 206, 'name' => 'DoubleTree by Hilton Johor Bahru', 'state' => 'Johor', 'city' => 'Johor Bahru',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 310, 'rating' => 8.7, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Prime downtown location minutes away from Singapore Causeway.',
        'reviews' => [
            ['user' => 'Ahmad J.', 'date' => '2026-07-16', 'rating' => 9, 'comment' => 'Perfect location for business travelers. Close to the Causeway and shopping malls.'],
            ['user' => 'Crystal W.', 'date' => '2026-07-01', 'rating' => 8, 'comment' => 'Comfortable stay with friendly staff. The welcome cookie was a nice touch!'],
            ['user' => 'Taufiq B.', 'date' => '2026-06-14', 'rating' => 9, 'comment' => 'Good value hotel in JB. The room was clean and the breakfast was decent.'],
            ['user' => 'Angela C.', 'date' => '2026-05-27', 'rating' => 8, 'comment' => 'Convenient location for shopping at JB City Square. Staff were helpful.'],
            ['user' => 'Ridzuan K.', 'date' => '2026-05-05', 'rating' => 9, 'comment' => 'Good choice for a weekend stay. The pool and gym facilities were well-maintained.']
        ]
    ],
    [
        'id' => 207, 'name' => 'Amari Johor Bahru', 'state' => 'Johor', 'city' => 'Johor Bahru',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 280, 'rating' => 8.6, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Modern hotel steps away from Komtar JBCC and City Square malls.',
        'reviews' => [
            ['user' => 'Suraya A.', 'date' => '2026-07-19', 'rating' => 9, 'comment' => 'Great location for shopping. The room was spacious and the staff were friendly.'],
            ['user' => 'Jeremy C.', 'date' => '2026-07-03', 'rating' => 8, 'comment' => 'Good budget hotel with quality service. The breakfast selection was decent.'],
            ['user' => 'Pavithra M.', 'date' => '2026-06-20', 'rating' => 9, 'comment' => 'Very convenient for cross-border travel. Room was clean and comfortable.'],
            ['user' => 'Adam N.', 'date' => '2026-06-03', 'rating' => 8, 'comment' => 'Decent hotel for the price. The pool area was a nice bonus.'],
            ['user' => 'Karen L.', 'date' => '2026-05-18', 'rating' => 9, 'comment' => 'Love the modern design! Located right in the heart of JB city center.']
        ]
    ],
    [
        'id' => 208, 'name' => 'Renaissance Johor Bahru Hotel', 'state' => 'Johor', 'city' => 'Permas Jaya',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 340, 'rating' => 8.9, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Luxury 5-star hotel with award-winning Cantonese restaurant Wan Li.',
        'reviews' => [
            ['user' => 'Mei L.', 'date' => '2026-07-21', 'rating' => 10, 'comment' => 'The Wan Li restaurant is fantastic! The room was luxurious and very comfortable.'],
            ['user' => 'Daniel K.', 'date' => '2026-07-07', 'rating' => 9, 'comment' => 'Great hotel with excellent facilities. The staff went above and beyond to help us.'],
            ['user' => 'Safiah R.', 'date' => '2026-06-25', 'rating' => 8, 'comment' => 'Good hotel but a bit far from the city center. However, the quality makes up for it.'],
            ['user' => 'Omar F.', 'date' => '2026-06-09', 'rating' => 9, 'comment' => 'The service was top-notch. The room had a great view of the straits.'],
            ['user' => 'Jeslyn W.', 'date' => '2026-05-22', 'rating' => 9, 'comment' => 'Loved the stay! The pool was amazing and the food was delicious.']
        ]
    ],

    // ==================== 3. SELANGOR (雪兰莪) ====================
    [
        'id' => 301, 'name' => 'Sunway Resort Hotel', 'state' => 'Selangor', 'city' => 'Sunway City',
        'type' => 'Luxury Resort', 'vibe' => 'All Stays', 'price' => 520, 'rating' => 9.1, 'score_text' => 'Superb',
        'img_main' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Direct access to Sunway Lagoon theme park and Pyramid shopping mall.',
        'reviews' => [
            ['user' => 'ThemePark F.', 'date' => '2026-07-12', 'rating' => 10, 'comment' => 'Perfect location! Walked straight into Sunway Lagoon from the hotel. Kids were over the moon.'],
            ['user' => 'Maya R.', 'date' => '2026-06-29', 'rating' => 9, 'comment' => 'The pool is spectacular and the rooms are very comfortable. Staff were very accommodating.'],
            ['user' => 'Zack A.', 'date' => '2026-06-11', 'rating' => 8, 'comment' => 'Great hotel but a bit crowded during weekends. Still worth it for the convenience.'],
            ['user' => 'Lily T.', 'date' => '2026-05-24', 'rating' => 9, 'comment' => 'Amazing breakfast buffet with so many choices. The kids loved the kids club.'],
            ['user' => 'Fatin N.', 'date' => '2026-05-06', 'rating' => 9, 'comment' => 'The connecting rooms were perfect for our family. Will definitely stay again.']
        ]
    ],
    [
        'id' => 302, 'name' => 'One World Hotel', 'state' => 'Selangor', 'city' => 'Petaling Jaya',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 380, 'rating' => 8.9, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => '5-star hotel directly connected to 1 Utama Shopping Centre.',
        'reviews' => [
            ['user' => 'Shopaholic S.', 'date' => '2026-07-13', 'rating' => 9, 'comment' => 'Direct access to 1 Utama was amazing! The room was spacious and very clean.'],
            ['user' => 'Danny L.', 'date' => '2026-06-27', 'rating' => 8, 'comment' => 'Good business hotel with fast Wi-Fi. The lobby is quite impressive.'],
            ['user' => 'Suhaila M.', 'date' => '2026-06-09', 'rating' => 9, 'comment' => 'The staff were very helpful and friendly. The breakfast spread was excellent.'],
            ['user' => 'Kevin T.', 'date' => '2026-05-23', 'rating' => 8, 'comment' => 'Great location for shopping and food. Room was comfortable but the bathroom needs updating.'],
            ['user' => 'Aishah R.', 'date' => '2026-05-04', 'rating' => 9, 'comment' => 'Love the convenience of the mall connection. Perfect for weekend shopping trips.']
        ]
    ],
    [
        'id' => 303, 'name' => 'Le Meridien Putrajaya', 'state' => 'Selangor', 'city' => 'Sepang',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 410, 'rating' => 9.0, 'score_text' => 'Superb',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Direct access to IOI City Mall with stylish modern accommodation.',
        'reviews' => [
            ['user' => 'CityExplorer', 'date' => '2026-07-14', 'rating' => 9, 'comment' => 'Beautiful hotel with direct mall access. The infinity pool has a great view of Putrajaya.'],
            ['user' => 'Rizal H.', 'date' => '2026-06-26', 'rating' => 10, 'comment' => 'Exceptional service from the front desk. Room was modern and well-equipped.'],
            ['user' => 'Yana P.', 'date' => '2026-06-08', 'rating' => 8, 'comment' => 'Good hotel but the parking can be a challenge during peak hours. Otherwise everything was great.'],
            ['user' => 'Fikri A.', 'date' => '2026-05-21', 'rating' => 9, 'comment' => 'The bed was super comfortable! Had a great night sleep. The location is convenient.'],
            ['user' => 'Cindy W.', 'date' => '2026-05-03', 'rating' => 9, 'comment' => 'Loved the modern design and the facilities. The staff were very professional.']
        ]
    ],
    [
        'id' => 304, 'name' => 'Avani Sepang Goldcoast Resort', 'state' => 'Selangor', 'city' => 'Sepang',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 490, 'rating' => 8.5, 'score_text' => 'Very Good',
        'img_main' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Overwater palm-shaped villa resort over the Malacca Straits.',
        'reviews' => [
            ['user' => 'BeachLover', 'date' => '2026-07-11', 'rating' => 8, 'comment' => 'The overwater villas are amazing! Perfect for a romantic getaway. The sunset views are breathtaking.'],
            ['user' => 'Amir Z.', 'date' => '2026-06-24', 'rating' => 7, 'comment' => 'Unique resort design but some facilities need maintenance. The beach was clean though.'],
            ['user' => 'Sara K.', 'date' => '2026-06-06', 'rating' => 8, 'comment' => 'Loved the pool and the private beach. The breakfast buffet was decent. Would come back.'],
            ['user' => 'Hisham R.', 'date' => '2026-05-19', 'rating' => 9, 'comment' => 'Stunning views from the villa! The staff were very friendly and helpful.'],
            ['user' => 'Nina S.', 'date' => '2026-05-01', 'rating' => 8, 'comment' => 'Nice resort but a bit far from the city. The peace and quiet was worth the travel.']
        ]
    ],
    [
        'id' => 305, 'name' => 'Sheraton Petaling Jaya Hotel', 'state' => 'Selangor', 'city' => 'Petaling Jaya',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 430, 'rating' => 8.8, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Contemporary high-rise hotel featuring a rooftop infinity pool.',
        'reviews' => [
            ['user' => 'SkylineView', 'date' => '2026-07-15', 'rating' => 9, 'comment' => 'The rooftop pool is stunning! Great view of the city skyline. Rooms are modern and spacious.'],
            ['user' => 'Jimmy L.', 'date' => '2026-06-23', 'rating' => 8, 'comment' => 'Good business hotel. The club lounge had great food and drinks.'],
            ['user' => 'Aini M.', 'date' => '2026-06-04', 'rating' => 9, 'comment' => 'Excellent service! The staff were very attentive. The room was clean and comfortable.'],
            ['user' => 'Kenny T.', 'date' => '2026-05-17', 'rating' => 8, 'comment' => 'Convenient location with easy access to major highways. The gym was well-equipped.'],
            ['user' => 'Fara A.', 'date' => '2026-05-01', 'rating' => 9, 'comment' => 'Loved the infinity pool! Perfect for evening swims with a view. Will definitely come back.']
        ]
    ],
    [
        'id' => 306, 'name' => 'Cyberview Resort & Spa', 'state' => 'Selangor', 'city' => 'Cyberjaya',
        'type' => 'Nature & Eco Lodge', 'vibe' => 'Hot Springs', 'price' => 320, 'rating' => 8.6, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Lush tropical resort setting with full-service spa facilities.',
        'reviews' => [
            ['user' => 'SpaLover', 'date' => '2026-07-10', 'rating' => 9, 'comment' => 'The spa treatments were heavenly! Such a relaxing escape from the city. The natural surroundings are beautiful.'],
            ['user' => 'Faisal R.', 'date' => '2026-06-21', 'rating' => 8, 'comment' => 'Great place for a weekend retreat. The pool was nice and the food was good.'],
            ['user' => 'Nadia K.', 'date' => '2026-06-02', 'rating' => 9, 'comment' => 'Loved the resort vibe! The staff were very friendly and the rooms were comfortable.'],
            ['user' => 'Hakim N.', 'date' => '2026-05-15', 'rating' => 8, 'comment' => 'Peaceful environment with lots of greenery. The spa is a must-try!'],
            ['user' => 'Samantha T.', 'date' => '2026-05-01', 'rating' => 9, 'comment' => 'A hidden gem in Cyberjaya! Perfect for couples looking for a quiet getaway.']
        ]
    ],
    [
        'id' => 307, 'name' => 'The Saujana Hotel Kuala Lumpur', 'state' => 'Selangor', 'city' => 'Shah Alam',
        'type' => 'Luxury Resort', 'vibe' => 'All Stays', 'price' => 360, 'rating' => 8.7, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Set amidst 160 hectares of tropical gardens and two 18-hole golf courses.',
        'reviews' => [
            ['user' => 'GolferPro', 'date' => '2026-07-09', 'rating' => 9, 'comment' => 'The golf courses are fantastic! The resort is surrounded by beautiful tropical gardens.'],
            ['user' => 'Yusof M.', 'date' => '2026-06-19', 'rating' => 8, 'comment' => 'Spacious rooms with great views. The staff were very helpful and friendly.'],
            ['user' => 'Ivy C.', 'date' => '2026-06-01', 'rating' => 9, 'comment' => 'Love the colonial-style architecture! The pool area was very relaxing.'],
            ['user' => 'Razif A.', 'date' => '2026-05-14', 'rating' => 8, 'comment' => 'Great for a family staycation. The kids enjoyed the pool and the gardens.'],
            ['user' => 'Lynn W.', 'date' => '2026-05-01', 'rating' => 9, 'comment' => 'Beautiful setting with lots of nature. Perfect for a weekend escape from the city.']
        ]
    ],
    [
        'id' => 308, 'name' => 'Movenpick Hotel & Convention Centre KLIA', 'state' => 'Selangor', 'city' => 'Sepang',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 330, 'rating' => 8.8, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Islamic architectural masterpiece near KLIA airport with wellness pools.',
        'reviews' => [
            ['user' => 'TravelBug', 'date' => '2026-07-08', 'rating' => 9, 'comment' => 'Beautiful architecture! The wellness pools were amazing. Perfect for a stopover near the airport.'],
            ['user' => 'AirportFlyer', 'date' => '2026-06-18', 'rating' => 10, 'comment' => 'Perfect for early morning flights! The shuttle service was very convenient.'],
            ['user' => 'Siti Z.', 'date' => '2026-05-31', 'rating' => 8, 'comment' => 'Great hotel but the location is a bit isolated. However, the facilities make up for it.'],
            ['user' => 'Hazwan R.', 'date' => '2026-05-12', 'rating' => 9, 'comment' => 'The Islamic design is stunning. The rooms were clean and very comfortable.'],
            ['user' => 'Mira T.', 'date' => '2026-05-01', 'rating' => 9, 'comment' => 'Excellent service and great amenities. The pool area was very relaxing.']
        ]
    ],

    // ==================== 4. MELAKA (马六甲) ====================
    [
        'id' => 401, 'name' => 'Casa del Rio Melaka', 'state' => 'Melaka', 'city' => 'Melaka River',
        'type' => 'Heritage Boutique', 'vibe' => 'Heritage', 'price' => 460, 'rating' => 9.2, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Mediterranean-style boutique hotel sits right on the historic Melaka River.',
        'reviews' => [
            ['user' => 'RiverView', 'date' => '2026-07-15', 'rating' => 10, 'comment' => 'Perfect location on the river! The view from our room was spectacular. The staff were so welcoming.'],
            ['user' => 'MelakaLover', 'date' => '2026-06-28', 'rating' => 9, 'comment' => 'Beautiful hotel with great charm. The breakfast was delicious and the pool was lovely.'],
            ['user' => 'Kenny O.', 'date' => '2026-06-10', 'rating' => 9, 'comment' => 'Great location for exploring Jonker Walk. The room was spacious and comfortable.'],
            ['user' => 'Fiona S.', 'date' => '2026-05-22', 'rating' => 8, 'comment' => 'Nice hotel but a bit pricey. However, the river view made it worth it.'],
            ['user' => 'Azman H.', 'date' => '2026-05-05', 'rating' => 10, 'comment' => 'Exceptional service! The staff went out of their way to make our stay memorable.']
        ]
    ],
    [
        'id' => 402, 'name' => 'The Majestic Malacca', 'state' => 'Melaka', 'city' => 'Georgetown',
        'type' => 'Heritage Boutique', 'vibe' => 'Heritage', 'price' => 490, 'rating' => 9.3, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => '1920s classic mansion reflecting rich Peranakan culture and luxury.',
        'reviews' => [
            ['user' => 'PeranakanLover', 'date' => '2026-07-16', 'rating' => 10, 'comment' => 'What a gem! The Peranakan decor is stunning. Felt like we stepped into a museum.'],
            ['user' => 'Daniel C.', 'date' => '2026-06-29', 'rating' => 9, 'comment' => 'The history of this hotel is fascinating. The staff gave us a tour of the mansion.'],
            ['user' => 'Siew L.', 'date' => '2026-06-11', 'rating' => 9, 'comment' => 'Loved the colonial charm and the afternoon tea experience. Highly recommended!'],
            ['user' => 'Ravi K.', 'date' => '2026-05-23', 'rating' => 8, 'comment' => 'Beautiful hotel but the rooms are on the smaller side. Still very comfortable though.'],
            ['user' => 'Suzanne T.', 'date' => '2026-05-06', 'rating' => 10, 'comment' => 'Absolutely loved everything about this place! The service was impeccable.']
        ]
    ],
    [
        'id' => 403, 'name' => 'Courtyard by Marriott Melaka', 'state' => 'Melaka', 'city' => 'Melaka City',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 310, 'rating' => 8.9, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Contemporary urban comfort close to Jonker Street night market.',
        'reviews' => [
            ['user' => 'NightMarketLover', 'date' => '2026-07-14', 'rating' => 9, 'comment' => 'Perfect location for exploring Jonker Street. The room was modern and very clean.'],
            ['user' => 'Amin R.', 'date' => '2026-06-27', 'rating' => 8, 'comment' => 'Good value for money. The breakfast was decent and the staff were friendly.'],
            ['user' => 'Yee C.', 'date' => '2026-06-09', 'rating' => 9, 'comment' => 'Great hotel with all the amenities. The pool was nice after a hot day exploring.'],
            ['user' => 'Zahid M.', 'date' => '2026-05-21', 'rating' => 8, 'comment' => 'Comfortable stay. Close to everything. Would recommend for short trips.'],
            ['user' => 'Ling T.', 'date' => '2026-05-04', 'rating' => 9, 'comment' => 'The staff were very helpful and the room was spacious. Perfect for a weekend stay.']
        ]
    ],
    [
        'id' => 404, 'name' => 'DoubleTree by Hilton Melaka', 'state' => 'Melaka', 'city' => 'Hatten City',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 290, 'rating' => 8.8, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Family-friendly hotel with infinity pool overlooking Straits of Malacca.',
        'reviews' => [
            ['user' => 'FamilyGetaway', 'date' => '2026-07-13', 'rating' => 9, 'comment' => 'The infinity pool was amazing! Great view of the straits. Perfect for families.'],
            ['user' => 'Hannah P.', 'date' => '2026-06-25', 'rating' => 8, 'comment' => 'Good hotel with friendly staff. The welcome cookie was a nice touch.'],
            ['user' => 'Ridwan K.', 'date' => '2026-06-07', 'rating' => 9, 'comment' => 'Great location and good facilities. The kids loved the pool.'],
            ['user' => 'Zuraidah S.', 'date' => '2026-05-20', 'rating' => 8, 'comment' => 'Comfortable stay. Close to shopping malls. Breakfast could have more variety.'],
            ['user' => 'Elliott N.', 'date' => '2026-05-03', 'rating' => 9, 'comment' => 'Great value for money. The room was clean and the staff were very helpful.']
        ]
    ],
    [
        'id' => 405, 'name' => 'The Pines Melaka', 'state' => 'Melaka', 'city' => 'Melaka City',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 220, 'rating' => 8.6, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Spacious suite rooms featuring local original artwork.',
        'reviews' => [
            ['user' => 'ArtLover', 'date' => '2026-07-12', 'rating' => 9, 'comment' => 'The local artwork in the rooms was beautiful! Spacious rooms and great value.'],
            ['user' => 'Siti H.', 'date' => '2026-06-24', 'rating' => 8, 'comment' => 'Good budget hotel. Clean and comfortable. The location was convenient.'],
            ['user' => 'Khairol A.', 'date' => '2026-06-06', 'rating' => 9, 'comment' => 'The suite was huge! Great for families. The staff were very friendly.'],
            ['user' => 'Priscilla W.', 'date' => '2026-05-19', 'rating' => 8, 'comment' => 'Nice hotel with interesting art pieces. The bed was comfortable.'],
            ['user' => 'Nazri M.', 'date' => '2026-05-02', 'rating' => 9, 'comment' => 'Great value for money. The room was clean and spacious. Would stay again.']
        ]
    ],
    [
        'id' => 406, 'name' => 'Hatten Hotel Melaka', 'state' => 'Melaka', 'city' => 'Bandar Hilir',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 210, 'rating' => 8.4, 'score_text' => 'Very Good',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Heart of heritage city linked directly to Dataran Pahlawan Mall.',
        'reviews' => [
            ['user' => 'MallShopper', 'date' => '2026-07-11', 'rating' => 8, 'comment' => 'Direct link to the mall was super convenient. Great location for shopping.'],
            ['user' => 'Azri M.', 'date' => '2026-06-23', 'rating' => 7, 'comment' => 'Decent hotel but the room was a bit dated. However, the location makes up for it.'],
            ['user' => 'Catherine L.', 'date' => '2026-06-05', 'rating' => 8, 'comment' => 'Good value for money. The staff were friendly and helpful.'],
            ['user' => 'Shukri R.', 'date' => '2026-05-18', 'rating' => 9, 'comment' => 'Great location! Walking distance to many attractions. The room was comfortable.'],
            ['user' => 'Joyce T.', 'date' => '2026-05-01', 'rating' => 8, 'comment' => 'Nice hotel with good facilities. The pool was clean and the food was decent.']
        ]
    ],
    [
        'id' => 407, 'name' => 'Rosa Malacca', 'state' => 'Melaka', 'city' => 'Melaka City',
        'type' => 'Heritage Boutique', 'vibe' => 'Heritage', 'price' => 250, 'rating' => 8.7, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Industrial rustic design crafted from red bricks and timber.',
        'reviews' => [
            ['user' => 'ArchitectureLover', 'date' => '2026-07-10', 'rating' => 9, 'comment' => 'The industrial design is stunning! Beautiful use of red bricks and timber.'],
            ['user' => 'Hana A.', 'date' => '2026-06-22', 'rating' => 8, 'comment' => 'Unique hotel with great style. The room was comfortable and clean.'],
            ['user' => 'Yasmin F.', 'date' => '2026-06-04', 'rating' => 9, 'comment' => 'Loved the rustic vibe! The staff were very welcoming. Great location.'],
            ['user' => 'Aiman S.', 'date' => '2026-05-17', 'rating' => 8, 'comment' => 'Good boutique hotel. The design is very Instagram-worthy. Would recommend.'],
            ['user' => 'Grace C.', 'date' => '2026-05-01', 'rating' => 9, 'comment' => 'Beautiful hotel with lots of character. The room was spacious and comfortable.']
        ]
    ],
    [
        'id' => 408, 'name' => 'Philea Resort & Spa', 'state' => 'Melaka', 'city' => 'Ayer Keroh',
        'type' => 'Nature & Eco Lodge', 'vibe' => 'Highlands', 'price' => 380, 'rating' => 8.5, 'score_text' => 'Very Good',
        'img_main' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Log-cabin style eco resort surrounded by natural waterfalls.',
        'reviews' => [
            ['user' => 'NatureLover', 'date' => '2026-07-09', 'rating' => 9, 'comment' => 'Beautiful eco resort surrounded by nature! The waterfall sounds were so relaxing.'],
            ['user' => 'Sham K.', 'date' => '2026-06-21', 'rating' => 8, 'comment' => 'Great place for a nature getaway. The log-cabin style rooms were unique.'],
            ['user' => 'Farah N.', 'date' => '2026-06-03', 'rating' => 9, 'comment' => 'The spa was amazing! Perfect for a relaxing weekend. Will definitely come back.'],
            ['user' => 'Kamarul A.', 'date' => '2026-05-16', 'rating' => 8, 'comment' => 'Nice eco resort but a bit far from the city. The peace was worth it.'],
            ['user' => 'Elin T.', 'date' => '2026-05-01', 'rating' => 9, 'comment' => 'Loved the natural setting! The staff were very friendly and accommodating.']
        ]
    ],

    // ==================== 5. SABAH (沙巴) ====================
    [
        'id' => 501, 'name' => 'Shangri-La Tanjung Aru', 'state' => 'Sabah', 'city' => 'Kota Kinabalu',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 780, 'rating' => 9.3, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Famous for world-class sunsets at Sunset Bar and private beach.',
        'reviews' => [
            ['user' => 'SunsetChaser', 'date' => '2026-07-18', 'rating' => 10, 'comment' => 'The sunset views are out of this world! Sunset Bar is a must-visit. Best resort in KK.'],
            ['user' => 'SabahExplorer', 'date' => '2026-07-01', 'rating' => 9, 'comment' => 'The private beach was amazing. The staff were very attentive and friendly.'],
            ['user' => 'Nadia J.', 'date' => '2026-06-14', 'rating' => 10, 'comment' => 'Absolutely love this resort! Everything was perfect. Will definitely come back.'],
            ['user' => 'Rizal K.', 'date' => '2026-05-28', 'rating' => 9, 'comment' => 'Great facilities and great service. The pool area was fantastic.'],
            ['user' => 'Samantha M.', 'date' => '2026-05-11', 'rating' => 9, 'comment' => 'The rooms were spacious and comfortable. The breakfast buffet was excellent.']
        ]
    ],
    [
        'id' => 502, 'name' => 'Shangri-La Rasa Ria Resort', 'state' => 'Sabah', 'city' => 'Tuaran',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 710, 'rating' => 9.2, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Bordered by ocean and tropical rainforest with private nature reserve.',
        'reviews' => [
            ['user' => 'NatureLover', 'date' => '2026-07-19', 'rating' => 10, 'comment' => 'The rainforest setting is incredible! The nature reserve is a must-see.'],
            ['user' => 'EcoTraveler', 'date' => '2026-07-02', 'rating' => 9, 'comment' => 'Great eco-friendly resort. The beach was clean and the food was delicious.'],
            ['user' => 'Aina H.', 'date' => '2026-06-15', 'rating' => 10, 'comment' => 'Loved every moment here! The sunset views were amazing.'],
            ['user' => 'Hafiz R.', 'date' => '2026-05-29', 'rating' => 9, 'comment' => 'Wonderful resort with great activities. The staff were very friendly.'],
            ['user' => 'Yvonne C.', 'date' => '2026-05-12', 'rating' => 9, 'comment' => 'The rooms were beautiful and the service was excellent. Highly recommend.']
        ]
    ],
    [
        'id' => 503, 'name' => 'Gaya Island Resort', 'state' => 'Sabah', 'city' => 'Gaya Island',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 920, 'rating' => 9.4, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Eco-luxury island resort set within Tunku Abdul Rahman Marine Park.',
        'reviews' => [
            ['user' => 'IslandHopper', 'date' => '2026-07-20', 'rating' => 10, 'comment' => 'The marine park setting is breathtaking! Snorkeling right off the beach.'],
            ['user' => 'MarineLife', 'date' => '2026-07-03', 'rating' => 9, 'comment' => 'Great eco-resort with amazing marine life. The staff were very knowledgeable.'],
            ['user' => 'Sophie R.', 'date' => '2026-06-16', 'rating' => 10, 'comment' => 'Absolutely stunning! The villas were luxurious and the views were unforgettable.'],
            ['user' => 'Azrul M.', 'date' => '2026-05-30', 'rating' => 9, 'comment' => 'Wonderful escape from the city. The island vibes were perfect.'],
            ['user' => 'Mei L.', 'date' => '2026-05-13', 'rating' => 9, 'comment' => 'The food was fantastic and the service was impeccable. Will come back.']
        ]
    ],
    [
        'id' => 504, 'name' => 'The Pacific Sutera Hotel', 'state' => 'Sabah', 'city' => 'Kota Kinabalu',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 450, 'rating' => 8.8, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Integrated resort with 27-hole golf course and private marina.',
        'reviews' => [
            ['user' => 'GolferPro', 'date' => '2026-07-17', 'rating' => 9, 'comment' => 'The golf course is fantastic! Great facilities and nice marina views.'],
            ['user' => 'MarinaLover', 'date' => '2026-06-30', 'rating' => 8, 'comment' => 'Good resort with great views of the marina. The rooms were comfortable.'],
            ['user' => 'Aini S.', 'date' => '2026-06-13', 'rating' => 9, 'comment' => 'Loved the pool area and the beach. The staff were very helpful.'],
            ['user' => 'Zack R.', 'date' => '2026-05-27', 'rating' => 8, 'comment' => 'Good value for money. The location was convenient and the facilities were good.'],
            ['user' => 'Lina T.', 'date' => '2026-05-10', 'rating' => 9, 'comment' => 'Great stay! The breakfast was delicious and the room was spacious.']
        ]
    ],
    [
        'id' => 505, 'name' => 'Hyatt Regency Kinabalu', 'state' => 'Sabah', 'city' => 'Kota Kinabalu',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 380, 'rating' => 8.7, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Waterfront hotel in city center with views of South China Sea.',
        'reviews' => [
            ['user' => 'CityView', 'date' => '2026-07-16', 'rating' => 9, 'comment' => 'Great view of the sea! The location is perfect for exploring the city.'],
            ['user' => 'Haziq N.', 'date' => '2026-06-29', 'rating' => 8, 'comment' => 'Good hotel with friendly staff. The room was clean and comfortable.'],
            ['user' => 'Siti Z.', 'date' => '2026-06-12', 'rating' => 9, 'comment' => 'Love the waterfront location! Great views and nice pool area.'],
            ['user' => 'Fikri A.', 'date' => '2026-05-26', 'rating' => 8, 'comment' => 'Good value for money. The breakfast spread was decent.'],
            ['user' => 'Yuki T.', 'date' => '2026-05-09', 'rating' => 9, 'comment' => 'Excellent service! The staff went above and beyond to help us.']
        ]
    ],
    [
        'id' => 506, 'name' => 'Horizon Hotel Kota Kinabalu', 'state' => 'Sabah', 'city' => 'Kota Kinabalu',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 260, 'rating' => 8.5, 'score_text' => 'Very Good',
        'img_main' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Located directly on Gaya Street Sunday Night Market district.',
        'reviews' => [
            ['user' => 'MarketLover', 'date' => '2026-07-15', 'rating' => 9, 'comment' => 'Perfect location for the Sunday Night Market! Great value for money.'],
            ['user' => 'Syahirah R.', 'date' => '2026-06-28', 'rating' => 8, 'comment' => 'Good budget hotel. Clean and comfortable. The staff were friendly.'],
            ['user' => 'Kevin C.', 'date' => '2026-06-11', 'rating' => 9, 'comment' => 'Love the location! Close to everything. The room was spacious.'],
            ['user' => 'Hafeez M.', 'date' => '2026-05-25', 'rating' => 8, 'comment' => 'Good hotel for short stays. The breakfast was decent.'],
            ['user' => 'Rachel O.', 'date' => '2026-05-08', 'rating' => 9, 'comment' => 'Excellent location and great service. Would recommend for budget travelers.']
        ]
    ],
    [
        'id' => 507, 'name' => 'Sipadan Kapalai Dive Resort', 'state' => 'Sabah', 'city' => 'Semporna',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 1400, 'rating' => 9.6, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Water village built on stilts over Ligitan Reefs with world-class diving.',
        'reviews' => [
            ['user' => 'DiveMaster', 'date' => '2026-07-22', 'rating' => 10, 'comment' => 'World-class diving! The water village experience is unforgettable.'],
            ['user' => 'UnderwaterLover', 'date' => '2026-07-05', 'rating' => 10, 'comment' => 'Amazing marine life right beneath the resort. The staff were very professional.'],
            ['user' => 'Ahmad F.', 'date' => '2026-06-18', 'rating' => 9, 'comment' => 'Incredible experience! The views were stunning and the food was great.'],
            ['user' => 'Shahrul R.', 'date' => '2026-06-01', 'rating' => 10, 'comment' => 'Best diving resort in Malaysia! Will definitely come back again.'],
            ['user' => 'Megan S.', 'date' => '2026-05-15', 'rating' => 9, 'comment' => 'The overwater villas were amazing! The sunset views were breathtaking.']
        ]
    ],
    [
        'id' => 508, 'name' => 'Borneo Rainforest Lodge', 'state' => 'Sabah', 'city' => 'Danum Valley',
        'type' => 'Nature & Eco Lodge', 'vibe' => 'Highlands', 'price' => 1850, 'rating' => 9.7, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Nestled along Danum River in Sabah’s ancient primary rainforest.',
        'reviews' => [
            ['user' => 'JungleExplorer', 'date' => '2026-07-23', 'rating' => 10, 'comment' => 'The ancient rainforest is awe-inspiring! Saw so many wildlife.'],
            ['user' => 'EcoTourist', 'date' => '2026-07-06', 'rating' => 10, 'comment' => 'This is the ultimate eco-luxury experience. The lodge is beautiful.'],
            ['user' => 'Nurul H.', 'date' => '2026-06-19', 'rating' => 9, 'comment' => 'Incredible experience in the heart of the rainforest. The guides were very knowledgeable.'],
            ['user' => 'Danial A.', 'date' => '2026-06-02', 'rating' => 10, 'comment' => 'One of the best places I have ever visited. The night walks were amazing.'],
            ['user' => 'Sally T.', 'date' => '2026-05-16', 'rating' => 9, 'comment' => 'The lodge was luxurious and the rainforest was magical. Highly recommend.']
        ]
    ],

    // ==================== 6. SARAWAK (砂拉越) ====================
    [
        'id' => 601, 'name' => 'Pullman Kuching', 'state' => 'Sarawak', 'city' => 'Kuching',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 320, 'rating' => 8.8, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Perched atop Mathies Hill with panoramic views of Sarawak River.',
        'reviews' => [
            ['user' => 'RiverView', 'date' => '2026-07-14', 'rating' => 9, 'comment' => 'Stunning view of Sarawak River! The location is perfect for exploring Kuching.'],
            ['user' => 'SarawakLover', 'date' => '2026-06-27', 'rating' => 8, 'comment' => 'Good hotel with great views. The room was comfortable and clean.'],
            ['user' => 'Azizah M.', 'date' => '2026-06-10', 'rating' => 9, 'comment' => 'Love the hilltop location! The sunset views were amazing.'],
            ['user' => 'Faisal A.', 'date' => '2026-05-24', 'rating' => 8, 'comment' => 'Good value for money. The breakfast was decent.'],
            ['user' => 'Wendy T.', 'date' => '2026-05-07', 'rating' => 9, 'comment' => 'Excellent service! The staff were very helpful and friendly.']
        ]
    ],
    [
        'id' => 602, 'name' => 'Damai Beach Resort', 'state' => 'Sarawak', 'city' => 'Santubong',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 280, 'rating' => 8.5, 'score_text' => 'Very Good',
        'img_main' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Seaside resort at Mount Santubong foot, near Sarawak Cultural Village.',
        'reviews' => [
            ['user' => 'BeachLover', 'date' => '2026-07-13', 'rating' => 8, 'comment' => 'Nice beachfront resort. Close to Cultural Village. The pool was great.'],
            ['user' => 'Hafiz R.', 'date' => '2026-06-26', 'rating' => 7, 'comment' => 'Good value for money. The rooms need some updating but overall decent.'],
            ['user' => 'Nina S.', 'date' => '2026-06-09', 'rating' => 8, 'comment' => 'Loved the beachfront location! The staff were friendly.'],
            ['user' => 'Zulkifli M.', 'date' => '2026-05-23', 'rating' => 9, 'comment' => 'Great family resort. The kids enjoyed the pool.'],
            ['user' => 'Eva T.', 'date' => '2026-05-06', 'rating' => 8, 'comment' => 'Good stay with nice views of Mount Santubong.']
        ]
    ],
    [
        'id' => 603, 'name' => 'The Waterfront Hotel Kuching', 'state' => 'Sarawak', 'city' => 'Kuching',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 350, 'rating' => 9.0, 'score_text' => 'Superb',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Modern boutique luxury situated above Plaza Merdeka shopping mall.',
        'reviews' => [
            ['user' => 'Shopper', 'date' => '2026-07-12', 'rating' => 9, 'comment' => 'Direct access to Plaza Merdeka! Great location for shopping and food.'],
            ['user' => 'Aina R.', 'date' => '2026-06-25', 'rating' => 8, 'comment' => 'Nice boutique hotel with modern design. The room was comfortable.'],
            ['user' => 'Faiz A.', 'date' => '2026-06-08', 'rating' => 9, 'comment' => 'Love the location! Close to everything. The staff were friendly.'],
            ['user' => 'Cecilia L.', 'date' => '2026-05-22', 'rating' => 8, 'comment' => 'Good hotel for shopping trips. The breakfast was decent.'],
            ['user' => 'Amir H.', 'date' => '2026-05-05', 'rating' => 9, 'comment' => 'Great value for money! The room was spacious and clean.']
        ]
    ],
    [
        'id' => 604, 'name' => 'Miri Marriott Resort & Spa', 'state' => 'Sarawak', 'city' => 'Miri',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 390, 'rating' => 8.9, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Lush tropical paradise along Brighton Beach with freeform pool.',
        'reviews' => [
            ['user' => 'PoolLover', 'date' => '2026-07-11', 'rating' => 9, 'comment' => 'The freeform pool is amazing! Great beachfront location.'],
            ['user' => 'Nazirah S.', 'date' => '2026-06-24', 'rating' => 8, 'comment' => 'Good resort with nice facilities. The beach was clean.'],
            ['user' => 'Khairol N.', 'date' => '2026-06-07', 'rating' => 9, 'comment' => 'Loved the tropical vibe! The staff were very accommodating.'],
            ['user' => 'Siti A.', 'date' => '2026-05-21', 'rating' => 8, 'comment' => 'Great place for a weekend getaway. The food was good.'],
            ['user' => 'Raymond C.', 'date' => '2026-05-04', 'rating' => 9, 'comment' => 'Excellent resort! The service was top-notch.']
        ]
    ],
    [
        'id' => 605, 'name' => 'Hilton Kuching', 'state' => 'Sarawak', 'city' => 'Kuching',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 360, 'rating' => 8.7, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Iconic riverfront landmark with views of the DUN state building.',
        'reviews' => [
            ['user' => 'CityView', 'date' => '2026-07-10', 'rating' => 9, 'comment' => 'Great view of the river and DUN building. Perfect location.'],
            ['user' => 'Azman R.', 'date' => '2026-06-23', 'rating' => 8, 'comment' => 'Good hotel with friendly staff. The room was comfortable.'],
            ['user' => 'Farah L.', 'date' => '2026-06-06', 'rating' => 9, 'comment' => 'Love the riverfront location! The breakfast was delicious.'],
            ['user' => 'Haziq M.', 'date' => '2026-05-20', 'rating' => 8, 'comment' => 'Good value for money. The pool was nice.'],
            ['user' => 'Grace K.', 'date' => '2026-05-03', 'rating' => 9, 'comment' => 'Excellent service! The staff were very helpful.']
        ]
    ],
    [
        'id' => 606, 'name' => 'Cove 55 Kuching', 'state' => 'Sarawak', 'city' => 'Santubong',
        'type' => 'Heritage Boutique', 'vibe' => 'Heritage', 'price' => 580, 'rating' => 9.3, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Intimate luxury boutique retreat facing the South China Sea.',
        'reviews' => [
            ['user' => 'LuxurySeeker', 'date' => '2026-07-09', 'rating' => 10, 'comment' => 'Absolutely stunning! The sea views were breathtaking. Pure luxury.'],
            ['user' => 'Sarah T.', 'date' => '2026-06-22', 'rating' => 9, 'comment' => 'Beautiful boutique retreat. The staff were very attentive.'],
            ['user' => 'Amin S.', 'date' => '2026-06-05', 'rating' => 10, 'comment' => 'One of the best hotels in Sarawak. The sunset views were magical.'],
            ['user' => 'Ling N.', 'date' => '2026-05-19', 'rating' => 9, 'comment' => 'Great escape from the city. The rooms were luxurious.'],
            ['user' => 'Razi M.', 'date' => '2026-05-02', 'rating' => 9, 'comment' => 'Excellent stay! Will definitely come back.']
        ]
    ],
    [
        'id' => 607, 'name' => 'Imperial Hotel Miri', 'state' => 'Sarawak', 'city' => 'Miri',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 210, 'rating' => 8.4, 'score_text' => 'Very Good',
        'img_main' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => '4-star hotel connected directly to Permaisuri Imperial City Mall.',
        'reviews' => [
            ['user' => 'MallShopper', 'date' => '2026-07-08', 'rating' => 8, 'comment' => 'Direct mall connection made shopping easy. Good value for money.'],
            ['user' => 'Hafiz A.', 'date' => '2026-06-21', 'rating' => 7, 'comment' => 'Decent hotel. The room was clean but the decor was a bit dated.'],
            ['user' => 'Sarah K.', 'date' => '2026-06-04', 'rating' => 8, 'comment' => 'Good budget hotel. The staff were friendly and helpful.'],
            ['user' => 'Ahmad T.', 'date' => '2026-05-18', 'rating' => 9, 'comment' => 'Great location! Close to everything. Will stay again.'],
            ['user' => 'Nora S.', 'date' => '2026-05-01', 'rating' => 8, 'comment' => 'Nice hotel for the price. The breakfast was decent.']
        ]
    ],
    [
        'id' => 608, 'name' => 'Mulu Marriott Resort & Spa', 'state' => 'Sarawak', 'city' => 'Mulu',
        'type' => 'Nature & Eco Lodge', 'vibe' => 'Highlands', 'price' => 620, 'rating' => 9.5, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Luxurious rainforest lodge near UNESCO World Heritage Mulu Caves.',
        'reviews' => [
            ['user' => 'CaveExplorer', 'date' => '2026-07-07', 'rating' => 10, 'comment' => 'The Mulu Caves are spectacular! The lodge is luxurious and comfortable.'],
            ['user' => 'EcoTraveler', 'date' => '2026-06-20', 'rating' => 10, 'comment' => 'Perfect base for exploring Mulu. The rainforest setting is magical.'],
            ['user' => 'Zainab M.', 'date' => '2026-06-03', 'rating' => 9, 'comment' => 'Beautiful lodge with great facilities. The staff were very knowledgeable.'],
            ['user' => 'Khairul A.', 'date' => '2026-05-17', 'rating' => 10, 'comment' => 'One of the best resorts in Sarawak. The food was amazing.'],
            ['user' => 'Elena L.', 'date' => '2026-05-01', 'rating' => 9, 'comment' => 'Incredible experience! The night walks were unforgettable.']
        ]
    ],

    // ==================== 7. PAHANG (彭亨) ====================
    [
        'id' => 701, 'name' => 'The Ritz-Carlton Genting Highlands', 'state' => 'Pahang', 'city' => 'Genting Highlands',
        'type' => 'Luxury Resort', 'vibe' => 'Highlands', 'price' => 880, 'rating' => 9.4, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'High-altitude luxury retreat with cool mountain breeze and forest views.',
        'reviews' => [
            ['user' => 'MountainLover', 'date' => '2026-07-06', 'rating' => 10, 'comment' => 'The mountain views were amazing! The cool breeze was refreshing.'],
            ['user' => 'LuxuryTraveler', 'date' => '2026-06-17', 'rating' => 9, 'comment' => 'Excellent hotel with great facilities. The service was top-notch.'],
            ['user' => 'Aina Z.', 'date' => '2026-05-30', 'rating' => 10, 'comment' => 'Absolutely loved our stay! The room was luxurious and comfortable.'],
            ['user' => 'Faiz R.', 'date' => '2026-05-13', 'rating' => 9, 'comment' => 'Great place for a romantic getaway. The views were incredible.'],
            ['user' => 'Nadia L.', 'date' => '2026-05-01', 'rating' => 9, 'comment' => 'Excellent service and amazing views. Highly recommend!']
        ]
    ],
    [
        'id' => 702, 'name' => 'The Cameron Highlands Resort', 'state' => 'Pahang', 'city' => 'Cameron Highlands',
        'type' => 'Heritage Boutique', 'vibe' => 'Highlands', 'price' => 640, 'rating' => 9.2, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Grand Tudor-style resort surrounded by tea plantations and rolling hills.',
        'reviews' => [
            ['user' => 'TeaLover', 'date' => '2026-07-04', 'rating' => 10, 'comment' => 'The tea plantation views were stunning! Loved the Tudor-style architecture.'],
            ['user' => 'HighlandsExplorer', 'date' => '2026-06-15', 'rating' => 9, 'comment' => 'Perfect place for a cool getaway. The garden was beautiful.'],
            ['user' => 'Sarah R.', 'date' => '2026-05-28', 'rating' => 10, 'comment' => 'A magical place! The afternoon tea was a highlight.'],
            ['user' => 'Ahmad Z.', 'date' => '2026-05-11', 'rating' => 9, 'comment' => 'Beautiful resort with great charm. The staff were friendly.'],
            ['user' => 'Lynn T.', 'date' => '2026-05-01', 'rating' => 9, 'comment' => 'Highly recommend this resort! The surroundings were breathtaking.']
        ]
    ],
    [
        'id' => 703, 'name' => 'Hyatt Regency Kuantan Resort', 'state' => 'Pahang', 'city' => 'Kuantan',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 420, 'rating' => 8.9, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Beachfront luxury resort along Teluk Cempedak beach.',
        'reviews' => [
            ['user' => 'BeachLover', 'date' => '2026-07-03', 'rating' => 9, 'comment' => 'Great beachfront location! The pool was amazing.'],
            ['user' => 'KuantanExplorer', 'date' => '2026-06-14', 'rating' => 8, 'comment' => 'Good resort with nice facilities. The staff were friendly.'],
            ['user' => 'Nina R.', 'date' => '2026-05-27', 'rating' => 9, 'comment' => 'Loved the beachfront view! The room was spacious.'],
            ['user' => 'Fikri M.', 'date' => '2026-05-10', 'rating' => 8, 'comment' => 'Great value for money. The breakfast was delicious.'],
            ['user' => 'Cathy L.', 'date' => '2026-05-01', 'rating' => 9, 'comment' => 'Excellent stay! Will definitely come back.']
        ]
    ],
    [
        'id' => 704, 'name' => 'Club Med Cherating Beach', 'state' => 'Pahang', 'city' => 'Cherating',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 950, 'rating' => 9.1, 'score_text' => 'Superb',
        'img_main' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'All-inclusive eco-friendly resort in an unspoiled jungle sanctuary.',
        'reviews' => [
            ['user' => 'AllInclusiveLover', 'date' => '2026-07-02', 'rating' => 10, 'comment' => 'Best all-inclusive resort! The activities were fantastic.'],
            ['user' => 'JungleLover', 'date' => '2026-06-13', 'rating' => 9, 'comment' => 'Eco-friendly resort in a beautiful jungle setting. Great for families.'],
            ['user' => 'Amanda C.', 'date' => '2026-05-26', 'rating' => 10, 'comment' => 'Absolutely loved our stay! The staff were amazing.'],
            ['user' => 'Rizal K.', 'date' => '2026-05-09', 'rating' => 9, 'comment' => 'Great place for a family vacation. The kids club was fantastic.'],
            ['user' => 'Siti N.', 'date' => '2026-05-01', 'rating' => 9, 'comment' => 'Wonderful experience! Highly recommend.']
        ]
    ],
    [
        'id' => 705, 'name' => 'Grand Ion Delemen Hotel', 'state' => 'Pahang', 'city' => 'Genting Highlands',
        'type' => 'City Hotel', 'vibe' => 'Highlands', 'price' => 280, 'rating' => 8.4, 'score_text' => 'Very Good',
        'img_main' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Perched 6,000 feet above sea level with indoor heated pool.',
        'reviews' => [
            ['user' => 'CoolMountain', 'date' => '2026-07-01', 'rating' => 8, 'comment' => 'Great location in Genting. The indoor heated pool was a bonus.'],
            ['user' => 'Hafiz S.', 'date' => '2026-06-12', 'rating' => 7, 'comment' => 'Good hotel for the price. The room was comfortable.'],
            ['user' => 'Aina M.', 'date' => '2026-05-25', 'rating' => 8, 'comment' => 'Great value for money. The mountain views were nice.'],
            ['user' => 'Faisal A.', 'date' => '2026-05-08', 'rating' => 8, 'comment' => 'Good budget hotel in Genting. The staff were friendly.'],
            ['user' => 'Nadia L.', 'date' => '2026-05-01', 'rating' => 8, 'comment' => 'Nice stay! Would recommend for budget travelers.']
        ]
    ],
    [
        'id' => 706, 'name' => 'Lakehouse Cameron Highlands', 'state' => 'Pahang', 'city' => 'Ringlet',
        'type' => 'Heritage Boutique', 'vibe' => 'Highlands', 'price' => 590, 'rating' => 9.3, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Charming English country house overlooking Sultan Abu Bakar Lake.',
        'reviews' => [
            ['user' => 'LakeView', 'date' => '2026-06-30', 'rating' => 10, 'comment' => 'The lake view was stunning! The English country house charm was magical.'],
            ['user' => 'CountryLover', 'date' => '2026-06-11', 'rating' => 9, 'comment' => 'Beautiful setting with lots of charm. The afternoon tea was delicious.'],
            ['user' => 'Sarah T.', 'date' => '2026-05-24', 'rating' => 10, 'comment' => 'A hidden gem! The staff were very friendly and welcoming.'],
            ['user' => 'Azman R.', 'date' => '2026-05-07', 'rating' => 9, 'comment' => 'Great place for a quiet getaway. The garden was beautiful.'],
            ['user' => 'Lily W.', 'date' => '2026-05-01', 'rating' => 9, 'comment' => 'Highly recommend this place! The views were breathtaking.']
        ]
    ],
    [
        'id' => 707, 'name' => 'Swiss-Garden Beach Resort Kuantan', 'state' => 'Pahang', 'city' => 'Balok Beach',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 310, 'rating' => 8.6, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Relaxing beachfront stay with outdoor splash pool for kids.',
        'reviews' => [
            ['user' => 'FamilyBeach', 'date' => '2026-06-29', 'rating' => 9, 'comment' => 'Great beachfront resort for families. The kids loved the splash pool.'],
            ['user' => 'KuantanLover', 'date' => '2026-06-10', 'rating' => 8, 'comment' => 'Good resort with nice facilities. The beach was clean.'],
            ['user' => 'Nina H.', 'date' => '2026-05-23', 'rating' => 9, 'comment' => 'Great value for money. The staff were friendly.'],
            ['user' => 'Faisal Z.', 'date' => '2026-05-06', 'rating' => 8, 'comment' => 'Nice stay with good food. The pool was great for kids.'],
            ['user' => 'Cecilia R.', 'date' => '2026-05-01', 'rating' => 9, 'comment' => 'Excellent family resort! Would come back again.']
        ]
    ],
    [
        'id' => 708, 'name' => 'Colmar Tropicale Berjaya Hills', 'state' => 'Pahang', 'city' => 'Bukit Tinggi',
        'type' => 'Heritage Boutique', 'vibe' => 'Highlands', 'price' => 240, 'rating' => 8.3, 'score_text' => 'Very Good',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'French-themed village resort modeled after 16th-century Colmar town.',
        'reviews' => [
            ['user' => 'FrenchVillage', 'date' => '2026-06-28', 'rating' => 8, 'comment' => 'Beautiful French-themed village! Very unique experience.'],
            ['user' => 'BukitTinggi', 'date' => '2026-06-09', 'rating' => 7, 'comment' => 'Nice place for photos. The food was decent.'],
            ['user' => 'Aina R.', 'date' => '2026-05-22', 'rating' => 8, 'comment' => 'Great for a weekend getaway. The architecture was stunning.'],
            ['user' => 'Hafiz A.', 'date' => '2026-05-05', 'rating' => 8, 'comment' => 'Nice place with good views. The rooms were comfortable.'],
            ['user' => 'Sarah L.', 'date' => '2026-05-01', 'rating' => 8, 'comment' => 'Unique hotel experience! Worth a visit.']
        ]
    ],

    // ==================== 8. PERAK (霹雳) ====================
    [
        'id' => 801, 'name' => 'The Banjaran Hotsprings Retreat', 'state' => 'Perak', 'city' => 'Ipoh',
        'type' => 'Nature & Eco Lodge', 'vibe' => 'Hot Springs', 'price' => 1250, 'rating' => 9.6, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Luxury geothermal hot spring sanctuary set amidst 260 million-year-old limestone hills.',
        'reviews' => [
            ['user' => 'HotSpringLover', 'date' => '2026-06-27', 'rating' => 10, 'comment' => 'The geothermal hot springs were heavenly! The limestone hills setting was magical.'],
            ['user' => 'LuxuryRetreat', 'date' => '2026-06-08', 'rating' => 10, 'comment' => 'Pure luxury and relaxation. The private villa was amazing.'],
            ['user' => 'Aina Z.', 'date' => '2026-05-21', 'rating' => 9, 'comment' => 'Perfect for a romantic getaway. The spa was world-class.'],
            ['user' => 'Faisal M.', 'date' => '2026-05-04', 'rating' => 10, 'comment' => 'One of the best resorts in Malaysia. Highly recommend!'],
            ['user' => 'Nadia R.', 'date' => '2026-05-01', 'rating' => 9, 'comment' => 'Amazing experience! The natural hot springs were incredible.']
        ]
    ],
    [
        'id' => 802, 'name' => 'Pangkor Laut Resort', 'state' => 'Perak', 'city' => 'Pangkor Island',
        'type' => 'Luxury Resort', 'vibe' => 'Beach Resorts', 'price' => 980, 'rating' => 9.4, 'score_text' => 'Exceptional',
        'img_main' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Exclusive private island resort featuring world-class sea villas.',
        'reviews' => [
            ['user' => 'IslandLife', 'date' => '2026-06-26', 'rating' => 10, 'comment' => 'Private island paradise! The sea villas were breathtaking.'],
            ['user' => 'LuxuryTraveler', 'date' => '2026-06-07', 'rating' => 9, 'comment' => 'World-class resort! The service was impeccable.'],
            ['user' => 'Siti H.', 'date' => '2026-05-20', 'rating' => 10, 'comment' => 'An unforgettable experience. The sunset views were magical.'],
            ['user' => 'Ahmad R.', 'date' => '2026-05-03', 'rating' => 9, 'comment' => 'Perfect romantic getaway. The private beach was amazing.'],
            ['user' => 'Lynn C.', 'date' => '2026-05-01', 'rating' => 9, 'comment' => 'Highly recommend this resort! The food was fantastic.']
        ]
    ],
    [
        'id' => 803, 'name' => 'WEIL Hotel Ipoh', 'state' => 'Perak', 'city' => 'Ipoh',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 320, 'rating' => 8.9, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Adjoined to Ipoh Parade Shopping Mall, ideal for foodie staycations.',
        'reviews' => [
            ['user' => 'FoodieLover', 'date' => '2026-06-25', 'rating' => 9, 'comment' => 'Perfect for foodies! Close to Ipoh\'s famous food spots.'],
            ['user' => 'MallShopper', 'date' => '2026-06-06', 'rating' => 8, 'comment' => 'Direct mall access made shopping easy. Great location.'],
            ['user' => 'Hafiz M.', 'date' => '2026-05-19', 'rating' => 9, 'comment' => 'Good hotel with great food. The room was comfortable.'],
            ['user' => 'Aina S.', 'date' => '2026-05-02', 'rating' => 8, 'comment' => 'Nice stay with good value. The staff were friendly.'],
            ['user' => 'Rizal T.', 'date' => '2026-05-01', 'rating' => 9, 'comment' => 'Great location for exploring Ipoh. Highly recommend!']
        ]
    ],
    [
        'id' => 804, 'name' => 'The Haven All Suite Resort', 'state' => 'Perak', 'city' => 'Ipoh',
        'type' => 'Luxury Resort', 'vibe' => 'All Stays', 'price' => 450, 'rating' => 9.1, 'score_text' => 'Superb',
        'img_main' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Eco-resort set around a naturally formed lake and limestone rock outcrops.',
        'reviews' => [
            ['user' => 'NatureRetreat', 'date' => '2026-06-24', 'rating' => 10, 'comment' => 'The lake setting was stunning! The limestone outcrops were beautiful.'],
            ['user' => 'EcoLover', 'date' => '2026-06-05', 'rating' => 9, 'comment' => 'Great eco-resort with amazing natural surroundings.'],
            ['user' => 'Nina A.', 'date' => '2026-05-18', 'rating' => 10, 'comment' => 'Beautiful resort! Perfect for a relaxing stay.'],
            ['user' => 'Faisal R.', 'date' => '2026-05-01', 'rating' => 9, 'comment' => 'Loved the natural setting. The suite was spacious.']
        ]
    ],
    [
        'id' => 805, 'name' => 'M Roof Hotel & Residences', 'state' => 'Perak', 'city' => 'Ipoh',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 220, 'rating' => 8.7, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Trendy boutique hotel with stylish Scandinavian-inspired architecture.',
        'reviews' => [
            ['user' => 'DesignLover', 'date' => '2026-06-23', 'rating' => 9, 'comment' => 'Love the Scandinavian design! Very stylish and comfortable.'],
            ['user' => 'BudgetTraveler', 'date' => '2026-06-04', 'rating' => 8, 'comment' => 'Great value for money. The room was clean and trendy.'],
            ['user' => 'Amin H.', 'date' => '2026-05-17', 'rating' => 9, 'comment' => 'Nice boutique hotel. The staff were friendly.'],
            ['user' => 'Siti R.', 'date' => '2026-05-01', 'rating' => 8, 'comment' => 'Good stay with great design. Would recommend.']
        ]
    ],
    [
        'id' => 806, 'name' => 'Belum Rainforest Resort', 'state' => 'Perak', 'city' => 'Gerik',
        'type' => 'Nature & Eco Lodge', 'vibe' => 'Highlands', 'price' => 380, 'rating' => 8.8, 'score_text' => 'Fabulous',
        'img_main' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Gateway to Royal Belum State Park, one of the world\'s oldest rainforests.',
        'reviews' => [
            ['user' => 'RainforestExplorer', 'date' => '2026-06-22', 'rating' => 10, 'comment' => 'The oldest rainforest was incredible! Saw so much wildlife.'],
            ['user' => 'EcoTourist', 'date' => '2026-06-03', 'rating' => 9, 'comment' => 'Great eco-lodge. Perfect base for exploring Belum.'],
            ['user' => 'Aina M.', 'date' => '2026-05-16', 'rating' => 10, 'comment' => 'Amazing experience! The night safari was unforgettable.'],
            ['user' => 'Hafiz R.', 'date' => '2026-05-01', 'rating' => 9, 'comment' => 'Beautiful resort with great guides. Highly recommend!']
        ]
    ],
    [
        'id' => 807, 'name' => 'Ipoh French Hotel', 'state' => 'Perak', 'city' => 'Ipoh',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 160, 'rating' => 8.5, 'score_text' => 'Very Good',
        'img_main' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Cozy modern boutique stay located in the heart of Ipoh old town.',
        'reviews' => [
            ['user' => 'OldTownLover', 'date' => '2026-06-21', 'rating' => 9, 'comment' => 'Perfect location in Ipoh old town! Great value for money.'],
            ['user' => 'BudgetTraveler', 'date' => '2026-06-02', 'rating' => 8, 'comment' => 'Good budget hotel with clean rooms. The staff were friendly.'],
            ['user' => 'Aina S.', 'date' => '2026-05-15', 'rating' => 9, 'comment' => 'Nice boutique hotel. Close to all the famous food spots.'],
            ['user' => 'Faisal A.', 'date' => '2026-05-01', 'rating' => 8, 'comment' => 'Great location and comfortable stay. Would recommend.']
        ]
    ],
    [
        'id' => 808, 'name' => 'Hotel Regal Vista Ipoh', 'state' => 'Perak', 'city' => 'Ipoh',
        'type' => 'City Hotel', 'vibe' => 'All Stays', 'price' => 180, 'rating' => 8.3, 'score_text' => 'Very Good',
        'img_main' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&q=80',
        'img_lobby' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_room' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
        'img_bathroom' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'desc' => 'Convenient city-center hotel offering great value for budget travelers.',
        'reviews' => [
            ['user' => 'CityCenter', 'date' => '2026-06-20', 'rating' => 8, 'comment' => 'Great location in the city center. Good value for money.'],
            ['user' => 'BudgetTraveler', 'date' => '2026-06-01', 'rating' => 7, 'comment' => 'Decent budget hotel. The room was clean and comfortable.'],
            ['user' => 'Amin R.', 'date' => '2026-05-14', 'rating' => 8, 'comment' => 'Good stay with friendly staff. Would recommend for budget travelers.'],
            ['user' => 'Siti N.', 'date' => '2026-05-01', 'rating' => 8, 'comment' => 'Nice hotel for the price. Close to everything.']
        ]
    ]
];
?>