<?php
require_once __DIR__ . '/../includes/trip_service.php';
$userId = tp_require_user();

$type = $_POST['item_type'] ?? '';
if (!in_array($type, ['flight', 'hotel'], true)) {
    header('Location: /TravelPal/trips/index.php?error=invalid_item'); exit;
}
$title = trim($_POST['title'] ?? 'Travel booking');
$subtitle = trim($_POST['subtitle'] ?? '');
$itemKey = trim($_POST['item_key'] ?? '');
$price = max(0, (float)($_POST['unit_price'] ?? 0));
$quantity = max(1, min($type === 'flight' ? 9 : 30, (int)($_POST['quantity'] ?? 1)));
$booking = json_decode($_POST['booking_data'] ?? '{}', true) ?: [];
if ($type === 'hotel' && !empty($_POST['check_in']) && !empty($_POST['check_out'])) {
    $checkIn = $_POST['check_in']; $checkOut = $_POST['check_out'];
    $nights = max(1, (int) ceil((strtotime($checkOut) - strtotime($checkIn)) / 86400));
    $quantity = min(30, $nights);
    $booking['check_in'] = $checkIn; $booking['check_out'] = $checkOut;
    $itemKey = preg_replace('/hotel-([^\-]+).*/', 'hotel-$1-' . $checkIn . '-' . $checkOut, $itemKey);
}
if ($itemKey === '' || $title === '' || $price <= 0) {
    header('Location: /TravelPal/trips/index.php?error=invalid_item'); exit;
}

global $auth_db;
$stmt = $auth_db->prepare('INSERT INTO trip_cart_items (user_id, item_type, item_key, title, subtitle, unit_price, quantity, booking_data) VALUES (?, ?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE unit_price = VALUES(unit_price), quantity = VALUES(quantity), booking_data = VALUES(booking_data), updated_at = CURRENT_TIMESTAMP');
$data = tp_json_encode($booking);
$stmt->bind_param('issssdis', $userId, $type, $itemKey, $title, $subtitle, $price, $quantity, $data);
$stmt->execute();
$stmt->close();
header('Location: /TravelPal/trips/index.php?added=' . urlencode($type));
exit;
