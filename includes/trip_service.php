<?php
// Shared persistence helpers for My Trips, favorites, orders and timetable.
// All records are scoped to the signed-in account.

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../auth/auth_db.php';

function tp_user_id(): int {
    return (int) ($_SESSION['user_id'] ?? 0);
}

function tp_h($value): string {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function tp_require_user(): int {
    $userId = tp_user_id();
    if (!$userId) {
        header('Location: /TravelPal/auth/login.php?error=login_required');
        exit;
    }
    return $userId;
}

function tp_json_response(array $payload, int $status = 200): void {
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($payload);
    exit;
}

function tp_post_json(): array {
    $raw = file_get_contents('php://input');
    $data = json_decode($raw ?: '', true);
    return is_array($data) ? $data : $_POST;
}

function tp_json_encode(array $value): string {
    return json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?: '{}';
}

function tp_get_cart_items(int $userId, ?array $ids = null): array {
    global $auth_db;
    $sql = 'SELECT * FROM trip_cart_items WHERE user_id = ?';
    if ($ids) {
        $ids = array_values(array_filter(array_map('intval', $ids)));
        if (!$ids) return [];
        // IDs have been converted to integers above, so this list is safe.
        $sql .= ' AND id IN (' . implode(',', $ids) . ')';
    }
    $sql .= ' ORDER BY created_at DESC';
    $stmt = $auth_db->prepare($sql);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    foreach ($rows as &$row) {
        $row['booking_data'] = json_decode($row['booking_data'] ?: '{}', true) ?: [];
        $row['line_total'] = round((float)$row['unit_price'] * (int)$row['quantity'], 2);
    }
    unset($row);
    return $rows;
}

function tp_get_favorites(int $userId): array {
    global $auth_db;
    $stmt = $auth_db->prepare('SELECT * FROM trip_favorites WHERE user_id = ? ORDER BY item_type, created_at DESC');
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    foreach ($rows as &$row) $row['metadata'] = json_decode($row['metadata'] ?: '{}', true) ?: [];
    unset($row);
    return $rows;
}
