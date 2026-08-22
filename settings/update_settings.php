<?php
// settings/update_settings.php
// Handles only the account data that already exists in the Settings page.

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['user_id'])) {
    header('Location: /TravelPal/auth/login.php?error=login_required');
    exit;
}

require_once __DIR__ . '/../auth/auth_db.php';

$db = $auth_db;

$userId = (int) $_SESSION['user_id'];

$username = trim($_POST['username'] ?? '');
$oldPassword = $_POST['old_pass'] ?? '';
$newPassword = $_POST['new_pass'] ?? '';

if (mb_strlen($username) < 2 || mb_strlen($username) > 100) {
    $db->close();
    header('Location: index.php?error=' . urlencode('Please enter a valid name.'));
    exit;
}

// Get the current password hash first.
$stmt = $db->prepare(
    'SELECT password_hash FROM accounts WHERE id = ? LIMIT 1'
);

if (!$stmt) {
    $db->close();
    header('Location: index.php?error=' . urlencode('Unable to update the account.'));
    exit;
}

$stmt->bind_param('i', $userId);
$stmt->execute();

$result = $stmt->get_result();
$account = $result->fetch_assoc();

$stmt->close();

if (!$account) {
    $db->close();

    unset(
        $_SESSION['user_id'],
        $_SESSION['user_name'],
        $_SESSION['user_email']
    );

    header('Location: /TravelPal/auth/login.php?error=login_required');
    exit;
}

/*
 * Username update.
 * Email remains unchanged because the existing Settings design explicitly
 * marks it as unavailable for direct editing.
 */
if ($oldPassword === '' && $newPassword === '') {
    $stmt = $db->prepare(
        'UPDATE accounts SET full_name = ? WHERE id = ?'
    );

    if (!$stmt) {
        $db->close();
        header('Location: index.php?error=' . urlencode('Unable to update your name.'));
        exit;
    }

    $stmt->bind_param('si', $username, $userId);
    $success = $stmt->execute();
    $stmt->close();

    if (!$success) {
        $db->close();
        header('Location: index.php?error=' . urlencode('Unable to update your name.'));
        exit;
    }

    $_SESSION['user_name'] = $username;
    $db->close();

    header('Location: index.php?message=saved');
    exit;
}

/*
 * If either password field is used, require both.
 */
if ($oldPassword === '' || $newPassword === '') {
    $db->close();
    header('Location: index.php?error=' . urlencode('Enter both your current and new password to change your password.'));
    exit;
}

if (strlen($newPassword) < 8) {
    $db->close();
    header('Location: index.php?error=' . urlencode('Your new password must contain at least 8 characters.'));
    exit;
}

if (!password_verify($oldPassword, $account['password_hash'])) {
    $db->close();
    header('Location: index.php?error=' . urlencode('Your current password is incorrect.'));
    exit;
}

$newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

$stmt = $db->prepare(
    'UPDATE accounts SET full_name = ?, password_hash = ? WHERE id = ?'
);

if (!$stmt) {
    $db->close();
    header('Location: index.php?error=' . urlencode('Unable to update your account.'));
    exit;
}

$stmt->bind_param('ssi', $username, $newPasswordHash, $userId);
$success = $stmt->execute();
$stmt->close();

if (!$success) {
    $db->close();
    header('Location: index.php?error=' . urlencode('Unable to update your account.'));
    exit;
}

$_SESSION['user_name'] = $username;

$db->close();

header('Location: index.php?message=saved');
exit;
?>
