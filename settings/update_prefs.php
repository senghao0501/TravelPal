<?php
session_start();
// 引入你现有的数据库连接文件[cite: 11, 14]
require_once __DIR__ . '/../auth/auth_db.php'; 

// 检查用户是否已登录
if (empty($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$userId = (int) $_SESSION['user_id'];
$newName = trim($_POST['display_name'] ?? '');
$newLanguage = $_POST['language'] ?? 'EN';
$newCurrency = $_POST['currency'] ?? 'MYR';

if ($newName === '') {
    echo json_encode(['success' => false, 'message' => 'Name cannot be empty']);
    exit;
}

// 使用你的 $auth_db 连接更新数据库[cite: 11, 14]
$stmt = $auth_db->prepare('UPDATE accounts SET full_name = ?, language = ?, currency = ? WHERE id = ?');

if ($stmt) {
    $stmt->bind_param('sssi', $newName, $newLanguage, $newCurrency, $userId);
    
    if ($stmt->execute()) {
        // 更新活跃的 Session 变量，让前端 UI 能瞬间同步更改
        $_SESSION['user_name'] = $newName;
        $_SESSION['language'] = $newLanguage;
        $_SESSION['currency'] = $newCurrency;
        
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database update failed.']);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Database preparation failed.']);
}
?>