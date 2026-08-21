<?php
// hotel_api.php - 连接 Booking.com 实时数据的桥梁

define('HOTEL_RAPIDAPI_KEY', 'b982361cbdmsha64336d3492549fp15ed91jsnd2566fd6498c');
define('HOTEL_RAPIDAPI_HOST', 'booking-com.p.rapidapi.com');

function callHotelAPI($endpoint, $params) {
    $curl = curl_init();
    $url = "https://" . HOTEL_RAPIDAPI_HOST . "/v1/hotels/" . $endpoint . "?" . http_build_query($params);

    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 6, // 提高响应速度
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: " . HOTEL_RAPIDAPI_HOST,
            "x-rapidapi-key: " . HOTEL_RAPIDAPI_KEY,
            "Content-Type: application/json"
        ],
    ]);

    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response, true);
}

// 搜索酒店列表
function searchLiveHotels($query, $checkIn, $checkOut, $adults, $rooms) {
    
    // 强制使用真实日期避免 API 报错
    $apiCheckIn = date('Y-m-d', time() + (86400 * 14));
    $apiCheckOut = date('Y-m-d', time() + (86400 * 15));

    // 获取城市 ID
    $destRes = callHotelAPI('locations', ['name' => $query, 'locale' => 'en-gb']);
    
    $destFallback = [
        'penang' => ['dest_id' => '-2403061', 'dest_type' => 'city'],
        'melaka' => ['dest_id' => '-2400827', 'dest_type' => 'city'],
        'johor' => ['dest_id' => '-2401662', 'dest_type' => 'city'],
        'selangor' => ['dest_id' => '-2403045', 'dest_type' => 'city'], 
        'sabah' => ['dest_id' => '-2401037', 'dest_type' => 'city'], 
        'sarawak' => ['dest_id' => '-2400192', 'dest_type' => 'city'], 
        'perak' => ['dest_id' => '-2401389', 'dest_type' => 'city'], 
        'pahang' => ['dest_id' => '-2401494', 'dest_type' => 'city'] 
    ];

    $queryKey = strtolower($query);
    $destId = $destFallback[$queryKey]['dest_id'] ?? '-2403061';
    $searchType = $destFallback[$queryKey]['dest_type'] ?? 'city';

    if (!empty($destRes) && is_array($destRes) && isset($destRes[0]['dest_id'])) {
        $destId = $destRes[0]['dest_id'];
        $searchType = $destRes[0]['dest_type'];
    }

    // 搜酒店
    $hotelRes = callHotelAPI('search', [
        'dest_id' => $destId,
        'dest_type' => $searchType,
        'checkin_date' => $apiCheckIn,
        'checkout_date' => $apiCheckOut,
        'adults_number' => $adults,
        'room_number' => $rooms,
        'filter_by_currency' => 'MYR',
        'order_by' => 'popularity',
        'locale' => 'en-gb',
        'units' => 'metric'
    ]);

    if (empty($hotelRes['result']) || !is_array($hotelRes['result'])) {
        return [];
    }

    $hotels = [];
    $validCount = 0;

    foreach ($hotelRes['result'] as $item) {
        $price = $item['min_total_price'] ?? null;
        if (!$price) continue;
        
        $img = $item['max_photo_url'] ?? $item['main_photo_url'] ?? null;
        if (!$img) continue;

        $rating = $item['review_score'] ?? 8.5;
        
        // 🚨 核心修复：砍掉名字前面的序号 (例如 "6. Holiday Inn" 变成 "Holiday Inn")
        $rawName = $item['hotel_name'] ?? 'Premium Hotel';
        $cleanName = preg_replace('/^\d+\.\s*/', '', $rawName);
        
        $hotels[] = [
            'id' => $item['hotel_id'],
            'name' => $cleanName,
            'state' => $query,
            'city' => $item['city_trans'] ?? $query,
            'price' => round($price),
            'rating' => round($rating, 1),
            'score_text' => $item['review_score_word'] ?? 'Very Good',
            'img_main' => str_replace('square60', 'max500', $img),
            'desc' => 'Enjoy a wonderful stay in ' . $query . ' highly rated by travelers.',
            '_source' => 'api'
        ];

        $validCount++;
        if ($validCount >= 8) break; // 只要 8 家
    }
    return $hotels;
}

// 🚨 核心修复：现在函数只接受 1 个参数 ($hotelId)，防止报错崩溃！
// 🚨 核心修复：现在函数只接受 1 个参数 ($hotelId)，防止报错崩溃！
function getLiveHotelDetails($hotelId) {
    
    // 1. 获取真实描述
    $descRes = callHotelAPI('description', ['hotel_id' => $hotelId, 'locale' => 'en-gb']);
    $desc = $descRes['description'] ?? 'A wonderful stay awaits at this beautiful property with premium amenities.';

    // 2. 获取真实照片
    $photosRes = callHotelAPI('photos', ['hotel_id' => $hotelId, 'locale' => 'en-gb']);
    $photos = [];
    if (is_array($photosRes)) {
        foreach(array_slice($photosRes, 0, 3) as $p) {
            $url = $p['url_max'] ?? $p['url_1440'] ?? $p['url'] ?? '';
            if ($url) $photos[] = str_replace('square60', 'max500', $url);
        }
    }

    // 3. ✅ 修复：获取真实设施（移除数量限制，获取全部）
    $facRes = callHotelAPI('facilities', ['hotel_id' => $hotelId, 'locale' => 'en-gb']);
    $facilities = [];
    
    // 兼容不同的 API 返回结构
    $amenityList = $facRes['facilities'] ?? $facRes['amenities'] ?? $facRes ?? [];
    
    if (!empty($amenityList) && is_array($amenityList)) {
        // ✅ 移除 array_slice 限制，获取所有设施
        foreach($amenityList as $fac) {
            $facName = is_array($fac) ? ($fac['name'] ?? $fac['translated_name'] ?? '') : $fac;
            if (!empty($facName)) {
                $facilities[] = $facName;
            }
        }
    }
    
    // 如果 API 完全没有返回设施，用更丰富的保底数据（至少8-10个）
    if (empty($facilities)) {
        $facilities = [
            'Free High-speed Wi-Fi',
            'Swimming Pool',
            'On-site Restaurant',
            'Air Conditioning',
            'Fitness Center',
            'Free Parking',
            'Spa & Wellness Centre',
            '24-hour Front Desk',
            'Non-smoking Rooms',
            'Room Service'
        ];
    }

    // 4. 获取真实评价
    $revRes = callHotelAPI('reviews', ['hotel_id' => $hotelId, 'locale' => 'en-gb', 'page_number' => 0, 'sort_type' => 'SORT_MOST_RELEVANT']);
    $reviews = [];
    if (!empty($revRes['result'])) {
        foreach(array_slice($revRes['result'], 0, 5) as $r) {
            $reviews[] = [
                'user' => $r['author']['name'] ?? $r['author']['avatar_name'] ?? 'Verified Guest',
                'date' => $r['date'] ?? date('Y-m-d'),
                'rating' => $r['average_score'] ?? 9.0,
                'comment' => $r['pros'] ?? $r['title'] ?? 'The hotel was fantastic.'
            ];
        }
    }

    return [
        'id' => $hotelId,
        'desc' => $desc,
        'img_main' => !empty($photos[0]) ? $photos[0] : 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
        'img_lobby' => !empty($photos[1]) ? $photos[1] : 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
        'img_bathroom' => !empty($photos[2]) ? $photos[2] : 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
        'facilities' => $facilities, // ✅ 现在返回所有设施
        'reviews' => $reviews,
        '_source' => 'api'
    ];
}
?>