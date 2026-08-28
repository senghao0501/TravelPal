<?php
// auth_db.php
// Database connection used by Login, Register and Settings.
// TravelPal MySQL is running on port 3308.

mysqli_report(MYSQLI_REPORT_OFF);

$auth_db = new mysqli(
    'localhost',        // DB_HOST
    'root',             // DB_USER
    '',                 // DB_PASS (empty)
    'flight_booking',   // DB_NAME
    3308                // MySQL Port
);

if ($auth_db->connect_errno) {
    die('Authentication database connection failed: ' . $auth_db->connect_error);
}

$auth_db->set_charset('utf8mb4');
?>