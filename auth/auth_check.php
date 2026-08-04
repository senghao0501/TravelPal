<?php
// 检查 session 是否开启
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 如果未登录，强制重定向到 login.php
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php?error=Please log in first");
    exit();
}
?>