<?php
// api_functions.php - 完整的API函数和辅助函数

// ==================== 配置定义 ====================
if (!defined('DB_HOST')) {
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'flight_booking');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('RAPIDAPI_KEY', '818df8d0f4msh8674dcd11d46a2cp1d634fjsn4f396e6a6768');
    define('RAPIDAPI_HOST', 'booking-com15.p.rapidapi.com');
}

define('DEFAULT_ORIGIN', 'KUL');
define('DEFAULT_DESTINATION', 'PEN');
define('DEFAULT_PASSENGERS', 1);
define('MIN_PASSENGERS', 1);
define('MAX_PASSENGERS', 9);
define('DEFAULT_AIRLINE_LOGO', 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=800&q=80');

// ==================== 机场数据 ====================
$AIRPORTS = [
    'KUL' => ['state' => 'Selangor', 'label' => 'Selangor (KUL)', 'api_id' => 'KUL.AIRPORT'],
    'SZB' => ['state' => 'Selangor', 'label' => 'Selangor (SZB)', 'api_id' => 'SZB.AIRPORT'],
    'PEN' => ['state' => 'Penang', 'label' => 'Penang (PEN)', 'api_id' => 'PEN.AIRPORT'],
    'JHB' => ['state' => 'Johor', 'label' => 'Johor (JHB)', 'api_id' => 'JHB.AIRPORT'],
    'MKZ' => ['state' => 'Melaka', 'label' => 'Melaka (MKZ)', 'api_id' => 'MKZ.AIRPORT'],
    'IPH' => ['state' => 'Perak', 'label' => 'Perak (IPH)', 'api_id' => 'IPH.AIRPORT'],
    'PKG' => ['state' => 'Pahang', 'label' => 'Pahang (PKG)', 'api_id' => 'PKG.AIRPORT'],
    'BKI' => ['state' => 'Sabah', 'label' => 'Sabah (BKI)', 'api_id' => 'BKI.AIRPORT'],
    'SDK' => ['state' => 'Sabah', 'label' => 'Sabah (SDK)', 'api_id' => 'SDK.AIRPORT'],
    'TWU' => ['state' => 'Sabah', 'label' => 'Sabah (TWU)', 'api_id' => 'TWU.AIRPORT'],
    'KCH' => ['state' => 'Sarawak', 'label' => 'Sarawak (KCH)', 'api_id' => 'KCH.AIRPORT'],
    'MYY' => ['state' => 'Sarawak', 'label' => 'Sarawak (MYY)', 'api_id' => 'MYY.AIRPORT'],
    'BTU' => ['state' => 'Sarawak', 'label' => 'Sarawak (BTU)', 'api_id' => 'BTU.AIRPORT']
];

$SEARCH_AIRPORT_CODES = ['KUL', 'PEN', 'JHB', 'MKZ', 'IPH', 'PKG', 'BKI', 'KCH'];

// 向后兼容
$STATE_API_MAP = [];
$STATE_CODE_TO_NAME = [];
foreach ($AIRPORTS as $code => $airport) {
    $STATE_API_MAP[$code] = $airport['api_id'];
    $STATE_CODE_TO_NAME[$code] = $airport['state'];
}

// ==================== 辅助函数 ====================

/**
 * 规范化行程类型
 */
function normalizeTripType($value): string
{
    return $value === 'round_trip' ? 'round_trip' : 'one_way';
}

/**
 * 验证并清理日期
 */
function sanitizeDate($date): string
{
    if (empty($date)) {
        return date('Y-m-d');
    }
    $timestamp = strtotime($date);
    if ($timestamp === false) {
        return date('Y-m-d');
    }
    return date('Y-m-d', $timestamp);
}

/**
 * 检查日期是否在今天之前
 */
function isDateBeforeToday($date): bool
{
    $today = date('Y-m-d');
    return $date < $today;
}

/**
 * 验证乘客数量
 */
function normalizePassengers($count): int
{
    $count = (int)$count;
    if ($count < MIN_PASSENGERS) return MIN_PASSENGERS;
    if ($count > MAX_PASSENGERS) return MAX_PASSENGERS;
    return $count;
}

/**
 * 验证机场代码是否有效
 */
function isValidAirportCode($code): bool
{
    global $AIRPORTS;
    return isset($AIRPORTS[strtoupper($code)]);
}

/**
 * 获取机场标签
 */
function getAirportLabel($code): string
{
    global $AIRPORTS;
    $code = strtoupper($code);
    return isset($AIRPORTS[$code]) ? $AIRPORTS[$code]['label'] : $code;
}

/**
 * 获取州名称
 */
function getStateName($code): string
{
    global $AIRPORTS;
    $code = strtoupper($code);
    return isset($AIRPORTS[$code]) ? $AIRPORTS[$code]['state'] : $code;
}

/**
 * 获取搜索用的机场代码列表
 */
function getSearchAirportCodes(): array
{
    global $SEARCH_AIRPORT_CODES;
    return $SEARCH_AIRPORT_CODES;
}

/**
 * 获取机场的API ID
 */
function getApiAirportCode($code): string
{
    global $AIRPORTS;
    $code = strtoupper($code);
    return isset($AIRPORTS[$code]) ? $AIRPORTS[$code]['api_id'] : $code . '.AIRPORT';
}

// ==================== 数据库函数 ====================

/**
 * 获取数据库连接
 */
function getDBConnection() {
    try {
        $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
            DB_USER,
            DB_PASS
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        error_log("Database connection failed: " . $e->getMessage());
        return null;
    }
}

/**
 * 检查航班是否存在
 */
function checkFlightExists($flightNo, $departDate, $fromCode, $toCode) {
    $pdo = getDBConnection();
    if (!$pdo) return null;
    
    $stmt = $pdo->prepare(
        "SELECT * FROM flights WHERE flight_no = ? AND departure_date = ? AND from_code = ? AND to_code = ?"
    );
    $stmt->execute([$flightNo, $departDate, $fromCode, $toCode]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * 更新航班价格
 */
function updateFlightPrice($flightId, $newPrice) {
    $pdo = getDBConnection();
    if (!$pdo) return false;
    
    $stmt = $pdo->prepare("UPDATE flights SET price = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
    return $stmt->execute([$newPrice, $flightId]);
}

/**
 * 插入航班
 */
function insertFlight($data) {
    $pdo = getDBConnection();
    if (!$pdo) return false;
    
    $sql = "INSERT INTO flights (
        airline, flight_no, from_state, from_code, to_state, to_code,
        departure_time, arrival_time, duration, price, rating, class_type,
        logo_url, description, stops, is_direct, departure_date, api_flight_id
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([
        $data['airline'] ?? '',
        $data['flight_no'] ?? '',
        $data['from_state'] ?? '',
        $data['from_code'] ?? '',
        $data['to_state'] ?? '',
        $data['to_code'] ?? '',
        $data['departure_time'] ?? '',
        $data['arrival_time'] ?? '',
        $data['duration'] ?? '',
        $data['price'] ?? 0,
        $data['rating'] ?? 0,
        $data['class_type'] ?? 'Economy',
        $data['logo_url'] ?? '',
        $data['description'] ?? '',
        $data['stops'] ?? 0,
        $data['is_direct'] ?? 1,
        $data['departure_date'] ?? date('Y-m-d'),
        $data['api_flight_id'] ?? ''
    ]);
    
    return $result ? $pdo->lastInsertId() : false;
}

/**
 * 根据ID获取航班
 */
function getFlightById($id) {
    $pdo = getDBConnection();
    if (!$pdo) return null;
    
    $stmt = $pdo->prepare("SELECT * FROM flights WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * 根据航线获取航班
 */
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
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * 从本地数据查找备用航班（增强版）
 */
function findLocalFallbackFlight($id) {
    global $all_flights;
    if (empty($all_flights)) {
        return null;
    }
    foreach ($all_flights as $flight) {
        if (isset($flight['id']) && $flight['id'] == $id) {
            return convertLocalFlight($flight, date('Y-m-d'));
        }
    }
    return null;
}

// ==================== API调用函数 ====================

/**
 * 调用Booking.com API
 */
function callBookingAPI($endpoint, $params = []) {
    if (empty(RAPIDAPI_KEY)) {
        return null;
    }
    
    $url = "https://booking-com15.p.rapidapi.com/api/v1/flights/{$endpoint}";
    
    if (!empty($params)) {
        $url .= '?' . http_build_query($params);
    }
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'x-rapidapi-host: ' . RAPIDAPI_HOST,
        'x-rapidapi-key: ' . RAPIDAPI_KEY
    ]);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);
    
    if ($error) {
        error_log("cURL Error: " . $error);
        return null;
    }
    
    return json_decode($response, true);
}

/**
 * 搜索航班
 */
function searchFlights($fromCode, $toCode, $departDate, $adults = 1, $cabinClass = 'ECONOMY') {
    $fromId = getApiAirportCode($fromCode);
    $toId = getApiAirportCode($toCode);
    
    if (!$fromId || !$toId) {
        return null;
    }
    
    $params = [
        'fromId' => $fromId,
        'toId' => $toId,
        'pageNo' => 1,
        'adults' => $adults,
        'children' => '0,17',
        'sort' => 'BEST',
        'cabinClass' => $cabinClass,
        'currency_code' => 'MYR'
    ];
    
    if ($departDate) {
        $params['date'] = $departDate;
    }
    
    return callBookingAPI('searchFlights', $params);
}

/**
 * 获取最低价格
 */
function getMinPrice($fromCode, $toCode, $departDate, $cabinClass = 'ECONOMY') {
    $fromId = getApiAirportCode($fromCode);
    $toId = getApiAirportCode($toCode);
    
    if (!$fromId || !$toId) {
        return null;
    }
    
    $params = [
        'fromId' => $fromId,
        'toId' => $toId,
        'cabinClass' => $cabinClass,
        'currency_code' => 'MYR'
    ];
    
    if ($departDate) {
        $params['date'] = $departDate;
    }
    
    return callBookingAPI('getMinPrice', $params);
}

/**
 * 解析API返回的航班数据并存入数据库
 */
function parseAndStoreFlights($apiResponse, $fromCode, $toCode, $departDate) {
    if (!$apiResponse || !isset($apiResponse['data']['flights'])) {
        return [];
    }
    
    $flights = [];
    $flightData = $apiResponse['data']['flights'];
    
    foreach ($flightData as $flight) {
        $airline = $flight['airline'] ?? 'Unknown';
        $flightNo = $flight['flightNumber'] ?? '';
        $price = $flight['price'] ?? 0;
        $stops = $flight['stops'] ?? 0;
        $duration = $flight['duration'] ?? '';
        $departureTime = $flight['departure'] ?? '';
        $arrivalTime = $flight['arrival'] ?? '';
        $logoUrl = $flight['logo'] ?? DEFAULT_AIRLINE_LOGO;
        $rating = $flight['rating'] ?? 0;
        
        $existing = checkFlightExists($flightNo, $departDate, $fromCode, $toCode);
        
        if ($existing) {
            updateFlightPrice($existing['id'], $price);
            $flights[] = $existing;
        } else {
            $flightId = insertFlight([
                'airline' => $airline,
                'flight_no' => $flightNo,
                'from_state' => getStateName($fromCode),
                'from_code' => $fromCode,
                'to_state' => getStateName($toCode),
                'to_code' => $toCode,
                'departure_time' => $departureTime,
                'arrival_time' => $arrivalTime,
                'duration' => $duration,
                'price' => $price,
                'rating' => $rating,
                'class_type' => 'Economy',
                'logo_url' => $logoUrl,
                'stops' => $stops,
                'is_direct' => ($stops == 0) ? 1 : 0,
                'departure_date' => $departDate,
                'api_flight_id' => $flight['id'] ?? ''
            ]);
            
            if ($flightId) {
                $flights[] = getFlightById($flightId);
            }
        }
    }
    
    return $flights;
}

/**
 * 转换本地航班格式（确保所有字段都存在）
 */
function convertLocalFlight($flight, $departDate) {
    return [
        'id' => $flight['id'] ?? rand(9000, 9999),
        'airline' => $flight['airline'] ?? 'AirAsia',
        'flight_no' => $flight['flight_no'] ?? 'AK-' . rand(6000, 6999),
        'from_state' => $flight['from_state'] ?? getStateName($flight['from_code'] ?? 'KUL'),
        'from_code' => $flight['from_code'] ?? 'KUL',
        'to_state' => $flight['to_state'] ?? getStateName($flight['to_code'] ?? 'PEN'),
        'to_code' => $flight['to_code'] ?? 'PEN',
        'departure_time' => $flight['departure_time'] ?? date('h:i A', strtotime('08:00')),
        'arrival_time' => $flight['arrival_time'] ?? date('h:i A', strtotime('09:30')),
        'duration' => $flight['duration'] ?? '1h 30m',
        'price' => (float)($flight['price'] ?? 150.00),
        'rating' => (float)($flight['rating'] ?? 8.0),
        'class_type' => $flight['class_type'] ?? $flight['class'] ?? 'Economy',
        'logo_url' => $flight['logo'] ?? $flight['logo_url'] ?? DEFAULT_AIRLINE_LOGO,
        'description' => $flight['desc'] ?? $flight['description'] ?? '',
        'stops' => (int)($flight['stops'] ?? 0),
        'is_direct' => ((int)($flight['stops'] ?? 0) == 0) ? 1 : 0,
        'departure_date' => $departDate,
        '_source' => 'local'
    ];
}

/**
 * 加载航线航班（整合数据库、API、本地数据）
 * 保底机制：即使API和数据库都失败，也会返回本地示例数据
 */
function loadFlightsForRoute($fromCode, $toCode, $departDate, $passengers = 1) {
    $flights = [];
    $fromCode = strtoupper($fromCode);
    $toCode = strtoupper($toCode);
    
    // 1. 尝试从数据库获取
    try {
        $dbFlights = getFlightsByRoute($fromCode, $toCode, $departDate);
        if (!empty($dbFlights)) {
            foreach ($dbFlights as &$flight) {
                $flight['_source'] = 'database';
            }
            return $dbFlights;
        }
    } catch (Exception $e) {
        error_log("Database query failed: " . $e->getMessage());
    }
    
    // 2. 尝试从API获取（仅当API Key存在）
    if (!empty(RAPIDAPI_KEY)) {
        try {
            $apiResponse = searchFlights($fromCode, $toCode, $departDate, $passengers);
            if ($apiResponse && isset($apiResponse['data']['flights']) && !empty($apiResponse['data']['flights'])) {
                $apiFlights = parseAndStoreFlights($apiResponse, $fromCode, $toCode, $departDate);
                if (!empty($apiFlights)) {
                    foreach ($apiFlights as &$flight) {
                        $flight['_source'] = 'api';
                    }
                    return $apiFlights;
                }
            }
        } catch (Exception $e) {
            error_log("API call failed: " . $e->getMessage());
        }
    }
    
    // 3. 保底机制：从本地数据获取
    global $all_flights;
    
    // 3a. 精确匹配
    foreach ($all_flights as $flight) {
        if ($flight['from_code'] === $fromCode && $flight['to_code'] === $toCode) {
            $flights[] = convertLocalFlight($flight, $departDate);
        }
    }
    
    // 3b. 如果精确匹配没有结果，尝试反向匹配
    if (empty($flights)) {
        foreach ($all_flights as $flight) {
            if ($flight['from_code'] === $toCode && $flight['to_code'] === $fromCode) {
                $converted = convertLocalFlight($flight, $departDate);
                $converted['from_code'] = $fromCode;
                $converted['to_code'] = $toCode;
                $converted['from_state'] = getStateName($fromCode);
                $converted['to_state'] = getStateName($toCode);
                $converted['price'] = $converted['price'] * 1.05;
                $flights[] = $converted;
            }
        }
    }
    
    // 3c. 最后的保底：生成示例数据
    if (empty($flights)) {
        $fromState = getStateName($fromCode);
        $toState = getStateName($toCode);
        
        $flights[] = [
            'id' => rand(9000, 9999),
            'airline' => 'AirAsia',
            'flight_no' => 'AK-' . rand(6000, 6999),
            'from_state' => $fromState,
            'from_code' => $fromCode,
            'to_state' => $toState,
            'to_code' => $toCode,
            'departure_time' => date('h:i A', strtotime('08:00')),
            'arrival_time' => date('h:i A', strtotime('09:30')),
            'duration' => rand(60, 180) . 'm',
            'price' => rand(100, 300),
            'rating' => 7.5 + (rand(0, 15) / 10),
            'class_type' => 'Economy',
            'logo_url' => DEFAULT_AIRLINE_LOGO,
            'description' => "Direct flight from {$fromState} to {$toState}.",
            'stops' => 0,
            'is_direct' => 1,
            'departure_date' => $departDate,
            '_source' => 'fallback'
        ];
        
        $flights[] = [
            'id' => rand(9000, 9999),
            'airline' => 'Malaysia Airlines',
            'flight_no' => 'MH-' . rand(1000, 1999),
            'from_state' => $fromState,
            'from_code' => $fromCode,
            'to_state' => $toState,
            'to_code' => $toCode,
            'departure_time' => date('h:i A', strtotime('10:00')),
            'arrival_time' => date('h:i A', strtotime('11:30')),
            'duration' => rand(60, 180) . 'm',
            'price' => rand(200, 500),
            'rating' => 8.5 + (rand(0, 15) / 10),
            'class_type' => 'Economy',
            'logo_url' => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=800&q=80',
            'description' => "Full service flight from {$fromState} to {$toState}.",
            'stops' => 0,
            'is_direct' => 1,
            'departure_date' => $departDate,
            '_source' => 'fallback'
        ];
    }
    
    return $flights;
}