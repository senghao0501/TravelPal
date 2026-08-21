<?php
session_start();
unset($_SESSION['user_id'], $_SESSION['user_name']);
header('Location: /TravelPal/auth/login.php?logout=1');
exit;
?>