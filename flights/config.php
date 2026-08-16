<?php
// config.php - 数据库与 API 全局配置
define('DB_HOST', 'localhost');
define('DB_NAME', 'flight_booking');
define('DB_USER', 'root');
define('DB_PASS', '');

define('RAPIDAPI_KEY', '818df8d0f4msh8674dcd11d46a2cp1d634fjsn4f396e6a6768');
define('RAPIDAPI_HOST', 'booking-com15.p.rapidapi.com');

// 马来西亚主要机场 API 代码映射
$STATE_API_MAP = [
    'KUL' => 'KUL.AIRPORT',
    'SZB' => 'SZB.AIRPORT', 
    'PEN' => 'PEN.AIRPORT',
    'JHB' => 'JHB.AIRPORT',
    'MKZ' => 'MKZ.AIRPORT',
    'IPH' => 'IPH.AIRPORT',
    'PKG' => 'PKG.AIRPORT',
    'BKI' => 'BKI.AIRPORT',
    'SDK' => 'SDK.AIRPORT',
    'TWU' => 'TWU.AIRPORT',
    'KCH' => 'KCH.AIRPORT',
    'MYY' => 'MYY.AIRPORT',
    'BTU' => 'BTU.AIRPORT'
];

// 机场代码至州名称映射
$STATE_CODE_TO_NAME = [
    'KUL' => 'Selangor',
    'SZB' => 'Selangor',
    'PEN' => 'Penang',
    'JHB' => 'Johor',
    'MKZ' => 'Melaka',
    'IPH' => 'Perak',
    'PKG' => 'Pahang',
    'BKI' => 'Sabah',
    'SDK' => 'Sabah',
    'TWU' => 'Sabah',
    'KCH' => 'Sarawak',
    'MYY' => 'Sarawak',
    'BTU' => 'Sarawak'
];
?>