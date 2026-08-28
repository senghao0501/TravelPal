<?php
require_once __DIR__ . '/../includes/trip_service.php';
if (!tp_user_id()) tp_json_response(['ok' => false], 401);
$userId = tp_user_id(); $input = tp_post_json(); $action = $input['action'] ?? '';
global $auth_db;
if ($action === 'range') {
    if (($input['method'] ?? 'get') === 'save') {
        $start = (string) ($input['start_date'] ?? ''); $end = (string) ($input['end_date'] ?? '');
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $start) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $end) || $end < $start || (strtotime($end) - strtotime($start)) > 31 * 86400) tp_json_response(['ok' => false], 422);
        $stmt = $auth_db->prepare('INSERT INTO trip_timetable_plan_ranges (user_id, start_date, end_date) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE start_date = VALUES(start_date), end_date = VALUES(end_date)');
        $stmt->bind_param('iss', $userId, $start, $end); $stmt->execute(); $stmt->close();
        tp_json_response(['ok' => true, 'start_date' => $start, 'end_date' => $end]);
    }
    $stmt = $auth_db->prepare('SELECT start_date, end_date FROM trip_timetable_plan_ranges WHERE user_id = ?');
    $stmt->bind_param('i', $userId); $stmt->execute(); $range = $stmt->get_result()->fetch_assoc(); $stmt->close();
    tp_json_response(['ok' => true, 'has_range' => (bool) $range, 'range' => $range ?: ['start_date' => date('Y-m-d'), 'end_date' => date('Y-m-d')]]);
}
if ($action === 'dates') {
    $stmt = $auth_db->prepare('SELECT schedule_date, COUNT(*) AS item_count FROM trip_timetable_items WHERE user_id = ? GROUP BY schedule_date HAVING COUNT(*) > 0 ORDER BY schedule_date');
    $stmt->bind_param('i', $userId); $stmt->execute(); $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); $stmt->close();
    tp_json_response(['ok' => true, 'dates' => $rows]);
}
if ($action === 'list') {
    $date = (string) ($input['schedule_date'] ?? date('Y-m-d'));
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) tp_json_response(['ok' => false], 422);
    $stmt = $auth_db->prepare('SELECT * FROM trip_timetable_items WHERE user_id = ? AND schedule_date = ? ORDER BY start_hour, id');
    $stmt->bind_param('is', $userId, $date); $stmt->execute(); $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); $stmt->close();
    tp_json_response(['ok' => true, 'items' => $rows]);
}
if ($action === 'save') {
    $items = is_array($input['items'] ?? null) ? $input['items'] : [];
    $date = (string) ($input['schedule_date'] ?? date('Y-m-d'));
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) tp_json_response(['ok' => false], 422);
    $auth_db->begin_transaction();
    try {
        $del = $auth_db->prepare('DELETE FROM trip_timetable_items WHERE user_id = ? AND schedule_date = ?'); $del->bind_param('is', $userId, $date); $del->execute(); $del->close();
        $add = $auth_db->prepare('INSERT INTO trip_timetable_items (user_id, schedule_date, item_type, item_key, title, unit_price, quantity, start_hour, end_hour) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
        foreach ($items as $item) {
            $type = in_array($item['item_type'] ?? '', ['flight','hotel','restaurant','attraction'], true) ? $item['item_type'] : 'hotel';
            $key = substr((string)($item['item_key'] ?? ''), 0, 160); $title = substr((string)($item['title'] ?? ''), 0, 190);
            $price = max(0, (float)($item['unit_price'] ?? 0)); $qty = max(1, min(30, (int)($item['quantity'] ?? 1)));
            $start = max(0, min(23, (int)($item['start_hour'] ?? 0))); $end = max($start + 1, min(24, (int)($item['end_hour'] ?? ($start + 1))));
            $add->bind_param('issssdiii', $userId, $date, $type, $key, $title, $price, $qty, $start, $end); $add->execute();
        }
        $add->close(); $auth_db->commit(); tp_json_response(['ok' => true]);
    } catch (Throwable $e) { $auth_db->rollback(); tp_json_response(['ok' => false], 500); }
}
tp_json_response(['ok' => false], 422);
