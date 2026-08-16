<?php
// flights_data.php - 备用国内航班数据集
$all_flights = [
    [
        'id' => 1001, 'airline' => 'AirAsia', 'flight_no' => 'AK-6110',
        'from_state' => 'Selangor', 'from_code' => 'KUL', 'to_state' => 'Penang', 'to_code' => 'PEN',
        'departure_time' => '07:25 AM', 'arrival_time' => '08:30 AM', 'duration' => '1h 05m',
        'price' => 119.00, 'rating' => 8.8, 'class' => 'Economy',
        'logo' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=800&q=80',
        'desc' => 'Direct flight from KLIA Sepang (KUL), Selangor to Penang International Airport (PEN).',
        'reviews' => [
            ['user' => 'Lee W.', 'date' => '2026-01-10', 'rating' => 9.0, 'comment' => 'Punctual flight and smooth boarding process.']
        ]
    ],
    [
        'id' => 1002, 'airline' => 'Malaysia Airlines', 'flight_no' => 'MH-1140',
        'from_state' => 'Selangor', 'from_code' => 'KUL', 'to_state' => 'Penang', 'to_code' => 'PEN',
        'departure_time' => '08:35 AM', 'arrival_time' => '09:35 AM', 'duration' => '1h 00m',
        'price' => 210.00, 'rating' => 9.2, 'class' => 'Business',
        'logo' => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=800&q=80',
        'desc' => 'Full-service business flight connecting Selangor (KUL) to Penang (PEN).',
        'reviews' => [
            ['user' => 'John Tan', 'date' => '2026-01-15', 'rating' => 10.0, 'comment' => 'Excellent service and great lounge access.']
        ]
    ],
    [
        'id' => 1003, 'airline' => 'Firefly', 'flight_no' => 'FY-1422',
        'from_state' => 'Selangor', 'from_code' => 'SZB', 'to_state' => 'Penang', 'to_code' => 'PEN',
        'departure_time' => '09:00 AM', 'arrival_time' => '10:00 AM', 'duration' => '1h 00m',
        'price' => 145.00, 'rating' => 8.9, 'class' => 'Economy',
        'logo' => 'https://images.unsplash.com/photo-1506015391300-4802dc74de2e?w=800&q=80',
        'desc' => 'Direct city-center departure from Subang Airport (SZB), Selangor to Penang.',
        'reviews' => []
    ],
    [
        'id' => 1010, 'airline' => 'AirAsia', 'flight_no' => 'AK-5112',
        'from_state' => 'Selangor', 'from_code' => 'KUL', 'to_state' => 'Sabah', 'to_code' => 'BKI',
        'departure_time' => '07:00 AM', 'arrival_time' => '09:35 AM', 'duration' => '2h 35m',
        'price' => 220.00, 'rating' => 8.6, 'class' => 'Economy',
        'logo' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=800&q=80',
        'desc' => 'Direct flight from Selangor (KUL) to Kota Kinabalu, Sabah.',
        'reviews' => []
    ]
];
?>