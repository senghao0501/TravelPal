<?php
// api_functions.php - RapidAPI 交互与持久化
require_once 'config.php';

function callBookingAPI($endpoint, $params = []) {
    $url = "https://" . RAPIDAPI_HOST . "/api/v1/flights/{$endpoint}";
    if (!empty($params)) {
        $url .= '?' . http_build_query($params);
    }
    
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'x-rapidapi-host: ' . RAPIDAPI_HOST,
            'x-rapidapi-key: ' . RAPIDAPI_KEY
        ],
        CURLOPT_TIMEOUT => 20
    ]);
    
    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);
    
    if ($error) {
        error_log("RapidAPI Curl Error: " . $error);
        return null;
    }
    return json_decode($response, true);
}

function getApiAirportCode($code) {
    global $STATE_API_MAP;
    return $STATE_API_MAP[$code] ?? ($code . '.AIRPORT');
}

function getStateName($code) {
    global $STATE_CODE_TO_NAME;
    return $STATE_CODE_TO_NAME[$code] ?? $code;
}

// 实时机票查询
function searchFlights($fromCode, $toCode, $departDate, $adults = 1, $cabinClass = 'ECONOMY') {
    $fromId = getApiAirportCode($fromCode);
    $toId   = getApiAirportCode($toCode);
    
    if (!$fromId || !$toId) return null;
    
    $params = [
        'fromId'        => $fromId,
        'toId'          => $toId,
        'pageNo'        => 1,
        'adults'        => max(1, (int)$adults),
        'sort'          => 'BEST',
        'cabinClass'    => strtoupper($cabinClass),
        'currency_code' => 'MYR'
    ];
    
    if (!empty($departDate)) {
        $params['date'] = $departDate;
    }
    
    return callBookingAPI('searchFlights', $params);
}

// 解析与存储 API 响应
function parseAndStoreFlights($apiResponse, $fromCode, $toCode, $departDate) {
    if (!$apiResponse || empty($apiResponse['data'])) {
        return [];
    }
    
    $rawFlights = $apiResponse['data']['flightOffers'] ?? $apiResponse['data']['flights'] ?? [];
    $parsedList = [];
    
    foreach ($rawFlights as $item) {
        $airline       = $item['airline'] ?? $item['segments'][0]['airline']['name'] ?? 'AirAsia';
        $flightNo      = $item['flightNumber'] ?? $item['segments'][0]['flightNumber'] ?? ('FY-' . rand(1000, 9999));
        $price         = $item['price']['total'] ?? $item['price'] ?? 150.00;
        $stops         = $item['stops'] ?? count($item['segments'] ?? [1]) - 1;
        $duration      = $item['duration'] ?? '1h 15m';
        $departureTime = $item['departureTime'] ?? $item['departure'] ?? '09:00 AM';
        $arrivalTime   = $item['arrivalTime'] ?? $item['arrival'] ?? '10:15 AM';
        $logoUrl       = $item['logo'] ?? 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=800&q=80';
        $rating        = $item['rating'] ?? 8.5;

        $existing = checkFlightExists($flightNo, $departDate, $fromCode, $toCode);
        
        if ($existing) {
            updateFlightPrice($existing['id'], $price);
            $parsedList[] = getFlightById($existing['id']);
        } else {
            $flightId = insertFlight([
                'airline'        => $airline,
                'flight_no'      => $flightNo,
                'from_state'     => getStateName($fromCode),
                'from_code'      => $fromCode,
                'to_state'       => getStateName($toCode),
                'to_code'        => $toCode,
                'departure_time' => $departureTime,
                'arrival_time'   => $arrivalTime,
                'duration'       => $duration,
                'price'          => $price,
                'rating'         => $rating,
                'class_type'     => 'Economy',
                'logo_url'       => $logoUrl,
                'stops'          => $stops,
                'is_direct'      => ($stops == 0),
                'departure_date' => $departDate,
                'api_flight_id'  => $item['id'] ?? ''
            ]);
            
            if ($flightId) {
                $parsedList[] = getFlightById($flightId);
            }
        }
    }
    return $parsedList;
}

// 数据库交互
function getDBConnection() {
    static $pdo = null;
    if ($pdo !== null) return $pdo;
    
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        return $pdo;
    } catch (PDOException $e) {
        error_log("DB Error: " . $e->getMessage());
        return null;
    }
}

function checkFlightExists($flightNo, $departDate, $fromCode, $toCode) {
    $pdo = getDBConnection();
    if (!$pdo) return null;
    $stmt = $pdo->prepare("SELECT * FROM flights WHERE flight_no = ? AND departure_date = ? AND from_code = ? AND to_code = ?");
    $stmt->execute([$flightNo, $departDate, $fromCode, $toCode]);
    return $stmt->fetch();
}

function updateFlightPrice($flightId, $newPrice) {
    $pdo = getDBConnection();
    if (!$pdo) return false;
    $stmt = $pdo->prepare("UPDATE flights SET price = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
    return $stmt->execute([$newPrice, $flightId]);
}

function insertFlight($data) {
    $pdo = getDBConnection();
    if (!$pdo) return false;
    
    $sql = "INSERT INTO flights (
        airline, flight_no, from_state, from_code, to_state, to_code,
        departure_time, arrival_time, duration, price, rating, class_type,
        logo_url, stops, is_direct, departure_date, api_flight_id
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $pdo->prepare($sql);
    $ok = $stmt->execute([
        $data['airline'], $data['flight_no'], $data['from_state'], $data['from_code'],
        $data['to_state'], $data['to_code'], $data['departure_time'], $data['arrival_time'],
        $data['duration'], $data['price'], $data['rating'], $data['class_type'],
        $data['logo_url'], $data['stops'], $data['is_direct'], $data['departure_date'],
        $data['api_flight_id']
    ]);
    return $ok ? $pdo->lastInsertId() : false;
}

function getFlightById($id) {
    $pdo = getDBConnection();
    if (!$pdo) return null;
    $stmt = $pdo->prepare("SELECT * FROM flights WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function getFlightsByRoute($fromCode, $toCode, $departDate = null) {
    $pdo = getDBConnection();
    if (!$pdo) return [];
    
    $sql = "SELECT * FROM flights WHERE from_code = ? AND to_code = ?";
    $params = [$fromCode, $toCode];
    if ($departDate) {
        $sql .= " AND departure_date = ?";
        $params[] = $departDate;
    }
    $sql .= " ORDER BY price ASC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

// 当 API 和数据库均查无结果时调用的动态保底函数
function getFallbackFlights($fromCode, $toCode, $departDate) {
    $airlines = [
        ['name' => 'AirAsia', 'prefix' => 'AK', 'logo' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=800&q=80', 'base_price' => 129],
        ['name' => 'Malaysia Airlines', 'prefix' => 'MH', 'logo' => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=800&q=80', 'base_price' => 249],
        ['name' => 'Batik Air', 'prefix' => 'OD', 'logo' => 'https://images.unsplash.com/photo-1506015391300-4802dc74de2e?w=800&q=80', 'base_price' => 179]
    ];
    
    $results = [];
    $times = [
        ['dep' => '07:30 AM', 'arr' => '08:35 AM', 'dur' => '1h 05m'],
        ['dep' => '11:15 AM', 'arr' => '12:25 PM', 'dur' => '1h 10m'],
        ['dep' => '04:40 PM', 'arr' => '05:50 PM', 'dur' => '1h 10m'],
        ['dep' => '08:20 PM', 'arr' => '09:30 PM', 'dur' => '1h 10m']
    ];

    foreach ($times as $index => $t) {
        $air = $airlines[$index % count($airlines)];
        $results[] = [
            'id'             => 'fallback_' . ($index + 1),
            'airline'        => $air['name'],
            'flight_no'      => $air['prefix'] . '-' . rand(1000, 9999),
            'from_state'     => getStateName($fromCode),
            'from_code'      => $fromCode,
            'to_state'       => getStateName($toCode),
            'to_code'        => $toCode,
            'departure_time' => $t['dep'],
            'arrival_time'   => $t['arr'],
            'duration'       => $t['dur'],
            'price'          => $air['base_price'] + rand(0, 50),
            'rating'         => number_format(8.0 + (rand(0, 18) / 10), 1),
            'class_type'     => 'Economy',
            'logo_url'       => $air['logo'],
            'stops'          => 0,
            'is_direct'      => 1,
            'departure_date' => $departDate
        ];
    }
    return $results;
}
?>
