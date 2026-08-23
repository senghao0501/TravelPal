<?php
require_once __DIR__ . '/../includes/trip_service.php';
if (!tp_user_id()) tp_json_response(['ok' => false], 401);
$userId = tp_user_id(); $input = tp_post_json(); $action = $input['action'] ?? '';
global $auth_db;
if ($action === 'list') {
    $stmt = $auth_db->prepare('SELECT * FROM trip_timetable_items WHERE user_id = ? ORDER BY start_hour, id');
    $stmt->bind_param('i', $userId); $stmt->execute(); $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); $stmt->close();
    tp_json_response(['ok' => true, 'items' => $rows]);
}
if ($action === 'save') {
    $items = is_array($input['items'] ?? null) ? $input['items'] : [];
    $auth_db->begin_transaction();
    try {
        $del = $auth_db->prepare('DELETE FROM trip_timetable_items WHERE user_id = ?'); $del->bind_param('i', $userId); $del->execute(); $del->close();
        $add = $auth_db->prepare('INSERT INTO trip_timetable_items (user_id, item_type, item_key, title, unit_price, quantity, start_hour, end_hour) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        foreach ($items as $item) {
            $type = in_array($item['item_type'] ?? '', ['flight','hotel','restaurant'], true) ? $item['item_type'] : 'hotel';
            $key = substr((string)($item['item_key'] ?? ''), 0, 160); $title = substr((string)($item['title'] ?? ''), 0, 190);
            $price = max(0, (float)($item['unit_price'] ?? 0)); $qty = max(1, min(30, (int)($item['quantity'] ?? 1)));
            $start = max(0, min(23, (int)($item['start_hour'] ?? 0))); $end = max($start + 1, min(24, (int)($item['end_hour'] ?? ($start + 1))));
            $add->bind_param('isssdiii', $userId, $type, $key, $title, $price, $qty, $start, $end); $add->execute();
        }
        $add->close(); $auth_db->commit(); tp_json_response(['ok' => true]);
    } catch (Throwable $e) { $auth_db->rollback(); tp_json_response(['ok' => false], 500); }
}
tp_json_response(['ok' => false], 422);
