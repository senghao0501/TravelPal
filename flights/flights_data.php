<?php
// flights_data.php - 马来西亚国内航班真实价格参考数据
// 价格参考：https://www.wego.com.my/ (AirAsia), https://my.trip.com/ (Firefly), Expedia (Batik Air)

$all_flights = [
    // ==================== 吉隆坡/雪兰莪 (KUL/SZB) → 槟城 (PEN) ====================
    [
        'id' => 1001,
        'airline' => 'AirAsia',
        'flight_no' => 'AK-6110',
        'from_state' => 'Selangor',
        'from_code' => 'KUL',
        'to_state' => 'Penang',
        'to_code' => 'PEN',
        'departure_time' => '07:25 AM',
        'arrival_time' => '08:30 AM',
        'duration' => '1h 05m',
        'price' => 114.00,  // 参考 Wego [citation:5]
        'rating' => 8.8,
        'class_type' => 'Economy',
        'logo_url' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=800&q=80',
        'stops' => 0,
        'is_direct' => 1,
        'desc' => 'Direct flight from KLIA (KUL) to Penang International Airport (PEN).',
        'reviews' => [
            ['user' => 'Lee W.', 'date' => '2026-01-10', 'rating' => 9.0, 'comment' => 'Punctual flight and smooth boarding process.']
        ]
    ],
    [
        'id' => 1002,
        'airline' => 'Malaysia Airlines',
        'flight_no' => 'MH-1140',
        'from_state' => 'Selangor',
        'from_code' => 'KUL',
        'to_state' => 'Penang',
        'to_code' => 'PEN',
        'departure_time' => '08:35 AM',
        'arrival_time' => '09:35 AM',
        'duration' => '1h 00m',
        'price' => 159.00,  // 参考 Malaysia Airlines MATTA Fair [citation:2]
        'rating' => 9.2,
        'class_type' => 'Economy',
        'logo_url' => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=800&q=80',
        'stops' => 0,
        'is_direct' => 1,
        'desc' => 'Full-service flight connecting Selangor (KUL) to Penang (PEN).',
        'reviews' => [
            ['user' => 'John Tan', 'date' => '2026-01-15', 'rating' => 10.0, 'comment' => 'Excellent service and great lounge access.']
        ]
    ],
    [
        'id' => 1003,
        'airline' => 'Firefly',
        'flight_no' => 'FY-1422',
        'from_state' => 'Selangor',
        'from_code' => 'SZB',
        'to_state' => 'Penang',
        'to_code' => 'PEN',
        'departure_time' => '09:00 AM',
        'arrival_time' => '10:00 AM',
        'duration' => '1h 00m',
        'price' => 171.00,  // 参考 Trip.com [citation:3]
        'rating' => 8.9,
        'class_type' => 'Economy',
        'logo_url' => 'https://images.unsplash.com/photo-1506015391300-4802dc74de2e?w=800&q=80',
        'stops' => 0,
        'is_direct' => 1,
        'desc' => 'Direct city-centre departure from Subang Airport (SZB) to Penang.',
        'reviews' => []
    ],
    [
        'id' => 1004,
        'airline' => 'Batik Air',
        'flight_no' => 'OD-2102',
        'from_state' => 'Selangor',
        'from_code' => 'KUL',
        'to_state' => 'Penang',
        'to_code' => 'PEN',
        'departure_time' => '10:15 AM',
        'arrival_time' => '11:15 AM',
        'duration' => '1h 00m',
        'price' => 155.00,  // 参考 Batik Air 价格范围
        'rating' => 8.6,
        'class_type' => 'Economy',
        'logo_url' => 'https://images.unsplash.com/photo-1506015391300-4802dc74de2e?w=800&q=80',
        'stops' => 0,
        'is_direct' => 1,
        'desc' => 'Comfortable morning flight connecting Selangor with Penang.',
        'reviews' => []
    ],

    // ==================== 吉隆坡 (KUL) → 沙巴亚庇 (BKI) ====================
    [
        'id' => 1010,
        'airline' => 'AirAsia',
        'flight_no' => 'AK-5112',
        'from_state' => 'Selangor',
        'from_code' => 'KUL',
        'to_state' => 'Sabah',
        'to_code' => 'BKI',
        'departure_time' => '07:00 AM',
        'arrival_time' => '09:35 AM',
        'duration' => '2h 35m',
        'price' => 272.00,  // 参考 Wego [citation:5]
        'rating' => 8.6,
        'class_type' => 'Economy',
        'logo_url' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=800&q=80',
        'stops' => 0,
        'is_direct' => 1,
        'desc' => 'Direct flight from Selangor (KUL) to Kota Kinabalu, Sabah.',
        'reviews' => []
    ],
    [
        'id' => 1011,
        'airline' => 'Malaysia Airlines',
        'flight_no' => 'MH-2606',
        'from_state' => 'Selangor',
        'from_code' => 'KUL',
        'to_state' => 'Sabah',
        'to_code' => 'BKI',
        'departure_time' => '09:15 AM',
        'arrival_time' => '11:50 AM',
        'duration' => '2h 35m',
        'price' => 339.00,  // 参考 Malaysia Airlines 促销价 [citation:10]
        'rating' => 9.0,
        'class_type' => 'Economy',
        'logo_url' => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=800&q=80',
        'stops' => 0,
        'is_direct' => 1,
        'desc' => 'Full service flight to Sabah with premium service.',
        'reviews' => []
    ],

    // ==================== 吉隆坡 (KUL) → 砂拉越古晋 (KCH) ====================
    [
        'id' => 1020,
        'airline' => 'AirAsia',
        'flight_no' => 'AK-5210',
        'from_state' => 'Selangor',
        'from_code' => 'KUL',
        'to_state' => 'Sarawak',
        'to_code' => 'KCH',
        'departure_time' => '08:00 AM',
        'arrival_time' => '09:45 AM',
        'duration' => '1h 45m',
        'price' => 186.00,  // 参考 Wego [citation:5]
        'rating' => 8.5,
        'class_type' => 'Economy',
        'logo_url' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=800&q=80',
        'stops' => 0,
        'is_direct' => 1,
        'desc' => 'Direct flight from Selangor (KUL) to Kuching, Sarawak.',
        'reviews' => []
    ],
    [
        'id' => 1021,
        'airline' => 'Malaysia Airlines',
        'flight_no' => 'MH-2502',
        'from_state' => 'Selangor',
        'from_code' => 'KUL',
        'to_state' => 'Sarawak',
        'to_code' => 'KCH',
        'departure_time' => '10:30 AM',
        'arrival_time' => '12:15 PM',
        'duration' => '1h 45m',
        'price' => 339.00,  // 参考 Malaysia Airlines 促销价 [citation:10]
        'rating' => 8.9,
        'class_type' => 'Economy',
        'logo_url' => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=800&q=80',
        'stops' => 0,
        'is_direct' => 1,
        'desc' => 'Full service flight to Kuching, Sarawak.',
        'reviews' => []
    ],

    // ==================== 槟城 (PEN) → 新山 (JHB) ====================
    [
        'id' => 1030,
        'airline' => 'AirAsia',
        'flight_no' => 'AK-6140',
        'from_state' => 'Penang',
        'from_code' => 'PEN',
        'to_state' => 'Johor',
        'to_code' => 'JHB',
        'departure_time' => '11:00 AM',
        'arrival_time' => '12:10 PM',
        'duration' => '1h 10m',
        'price' => 155.00,
        'rating' => 8.4,
        'class_type' => 'Economy',
        'logo_url' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=800&q=80',
        'stops' => 0,
        'is_direct' => 1,
        'desc' => 'Direct flight from Penang to Johor Bahru.',
        'reviews' => []
    ],
    [
        'id' => 1031,
        'airline' => 'Batik Air',
        'flight_no' => 'OD-2404',
        'from_state' => 'Penang',
        'from_code' => 'PEN',
        'to_state' => 'Johor',
        'to_code' => 'JHB',
        'departure_time' => '01:00 PM',
        'arrival_time' => '02:10 PM',
        'duration' => '1h 10m',
        'price' => 301.00,  // 参考 Expedia [citation:8]
        'rating' => 8.7,
        'class_type' => 'Economy',
        'logo_url' => 'https://images.unsplash.com/photo-1506015391300-4802dc74de2e?w=800&q=80',
        'stops' => 0,
        'is_direct' => 1,
        'desc' => 'Full service flight from Penang to Johor Bahru.',
        'reviews' => []
    ],

    // ==================== 吉隆坡 (KUL) → 浮罗交怡 (LGK) ====================
    [
        'id' => 1040,
        'airline' => 'AirAsia',
        'flight_no' => 'AK-6302',
        'from_state' => 'Selangor',
        'from_code' => 'KUL',
        'to_state' => 'Langkawi',
        'to_code' => 'LGK',
        'departure_time' => '09:30 AM',
        'arrival_time' => '10:30 AM',
        'duration' => '1h 00m',
        'price' => 135.00,  // 参考 Wego [citation:5]
        'rating' => 8.3,
        'class_type' => 'Economy',
        'logo_url' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=800&q=80',
        'stops' => 0,
        'is_direct' => 1,
        'desc' => 'Direct flight from Kuala Lumpur to Langkawi.',
        'reviews' => []
    ],

    // ==================== 吉隆坡 (KUL) → 哥打巴鲁 (KBR) ====================
    [
        'id' => 1050,
        'airline' => 'AirAsia',
        'flight_no' => 'AK-6438',
        'from_state' => 'Selangor',
        'from_code' => 'KUL',
        'to_state' => 'Kota Bharu',
        'to_code' => 'KBR',
        'departure_time' => '08:30 AM',
        'arrival_time' => '09:30 AM',
        'duration' => '1h 00m',
        'price' => 106.00,  // 参考 Wego [citation:5]
        'rating' => 8.1,
        'class_type' => 'Economy',
        'logo_url' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=800&q=80',
        'stops' => 0,
        'is_direct' => 1,
        'desc' => 'Direct flight from Kuala Lumpur to Kota Bharu.',
        'reviews' => []
    ],

    // ==================== 返回航线 (反向) ====================
    [
        'id' => 1060,
        'airline' => 'AirAsia',
        'flight_no' => 'AK-6111',
        'from_state' => 'Penang',
        'from_code' => 'PEN',
        'to_state' => 'Selangor',
        'to_code' => 'KUL',
        'departure_time' => '09:00 AM',
        'arrival_time' => '10:05 AM',
        'duration' => '1h 05m',
        'price' => 114.00,  // 参考 Wego [citation:5]
        'rating' => 8.7,
        'class_type' => 'Economy',
        'logo_url' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=800&q=80',
        'stops' => 0,
        'is_direct' => 1,
        'desc' => 'Return flight from Penang to Selangor (KUL).',
        'reviews' => []
    ],
    [
        'id' => 1061,
        'airline' => 'Malaysia Airlines',
        'flight_no' => 'MH-1141',
        'from_state' => 'Penang',
        'from_code' => 'PEN',
        'to_state' => 'Selangor',
        'to_code' => 'KUL',
        'departure_time' => '10:30 AM',
        'arrival_time' => '11:30 AM',
        'duration' => '1h 00m',
        'price' => 159.00,  // 参考 Malaysia Airlines [citation:2]
        'rating' => 9.1,
        'class_type' => 'Economy',
        'logo_url' => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=800&q=80',
        'stops' => 0,
        'is_direct' => 1,
        'desc' => 'Direct connection from Penang to Selangor.',
        'reviews' => []
    ],
    [
        'id' => 1070,
        'airline' => 'AirAsia',
        'flight_no' => 'AK-5113',
        'from_state' => 'Sabah',
        'from_code' => 'BKI',
        'to_state' => 'Selangor',
        'to_code' => 'KUL',
        'departure_time' => '10:00 AM',
        'arrival_time' => '12:35 PM',
        'duration' => '2h 35m',
        'price' => 272.00,  // 参考 Wego [citation:5]
        'rating' => 8.6,
        'class_type' => 'Economy',
        'logo_url' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=800&q=80',
        'stops' => 0,
        'is_direct' => 1,
        'desc' => 'Return flight from Sabah to Selangor (KUL).',
        'reviews' => []
    ],
    [
        'id' => 1080,
        'airline' => 'AirAsia',
        'flight_no' => 'AK-6141',
        'from_state' => 'Johor',
        'from_code' => 'JHB',
        'to_state' => 'Penang',
        'to_code' => 'PEN',
        'departure_time' => '12:30 PM',
        'arrival_time' => '01:40 PM',
        'duration' => '1h 10m',
        'price' => 155.00,
        'rating' => 8.4,
        'class_type' => 'Economy',
        'logo_url' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=800&q=80',
        'stops' => 0,
        'is_direct' => 1,
        'desc' => 'Return flight from Johor Bahru to Penang.',
        'reviews' => []
    ],
];
?>