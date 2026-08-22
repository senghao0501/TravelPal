<?php
// auth_db.php
// Database connection used only by Login, Register and Settings.
// This file does NOT depend on the Flight module's config.php.

mysqli_report(MYSQLI_REPORT_OFF);

$auth_db = new mysqli(
    'localhost',        // DB_HOST
    'root',             // DB_USER
    '',                 // DB_PASS
    'flight_booking',   // DB_NAME
    3308                // MySQL Port
);

if ($auth_db->connect_errno) {
    die('Authentication database connection failed. Please check the flight_booking database in phpMyAdmin.');
}

$auth_db->set_charset('utf8mb4');
?>
