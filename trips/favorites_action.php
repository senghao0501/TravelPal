<?php
require_once __DIR__ . '/../includes/trip_service.php';
if (!tp_user_id()) tp_json_response(['ok' => false, 'message' => 'Please sign in first.'], 401);
$userId = tp_user_id();
$input = tp_post_json();
$type = $input['item_type'] ?? '';
$key = trim($input['item_key'] ?? '');
if (!in_array($type, ['flight', 'hotel', 'restaurant', 'attraction'], true) || $key === '') {
    tp_json_response(['ok' => false, 'message' => 'Invalid favorite.'], 422);
}
global $auth_db;
$check = $auth_db->prepare('SELECT id FROM trip_favorites WHERE user_id = ? AND item_type = ? AND item_key = ? LIMIT 1');
$check->bind_param('iss', $userId, $type, $key); $check->execute();
$existing = $check->get_result()->fetch_assoc(); $check->close();
if (($input['action'] ?? 'toggle') === 'remove' || ($input['action'] ?? '') === 'toggle' && $existing) {
    $delete = $auth_db->prepare('DELETE FROM trip_favorites WHERE id = ? AND user_id = ?');
    $delete->bind_param('ii', $existing['id'], $userId); $delete->execute(); $delete->close();
    tp_json_response(['ok' => true, 'saved' => false]);
}
$title = trim($input['title'] ?? 'Saved place');
$subtitle = trim($input['subtitle'] ?? '');
$image = trim($input['image_url'] ?? '');
$price = max(0, (float)($input['unit_price'] ?? 0));
$metadata = tp_json_encode(is_array($input['metadata'] ?? null) ? $input['metadata'] : []);
$insert = $auth_db->prepare('INSERT INTO trip_favorites (user_id, item_type, item_key, title, subtitle, image_url, unit_price, metadata) VALUES (?, ?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE title = VALUES(title), subtitle = VALUES(subtitle), image_url = VALUES(image_url), unit_price = VALUES(unit_price), metadata = VALUES(metadata)');
$insert->bind_param('isssssds', $userId, $type, $key, $title, $subtitle, $image, $price, $metadata); $insert->execute(); $insert->close();
tp_json_response(['ok' => true, 'saved' => true]);
