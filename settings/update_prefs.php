<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json; charset=utf-8');

function sendPreferencesResponse(int $statusCode, array $payload): never
{
    http_response_code($statusCode);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    sendPreferencesResponse(405, [
        'success' => false,
        'message' => 'This endpoint only accepts POST requests.',
    ]);
}

if (empty($_SESSION['user_id'])) {
    sendPreferencesResponse(401, [
        'success' => false,
        'message' => 'Your session has expired. Please sign in again.',
    ]);
}

require_once __DIR__ . '/../auth/auth_db.php';

$userId = (int) $_SESSION['user_id'];
$newName = trim((string) ($_POST['display_name'] ?? ''));
$newName = preg_replace('/\s+/u', ' ', $newName) ?? $newName;
$newLanguage = strtoupper(trim((string) ($_POST['language'] ?? 'EN')));
$newCurrency = strtoupper(trim((string) ($_POST['currency'] ?? 'MYR')));

if (mb_strlen($newName) < 2 || mb_strlen($newName) > 100) {
    sendPreferencesResponse(422, [
        'success' => false,
        'message' => 'Display name must contain between 2 and 100 characters.',
    ]);
}

$allowedLanguages = ['EN', 'MS', 'ZH'];
$allowedCurrencies = ['MYR', 'SGD', 'USD'];

if (!in_array($newLanguage, $allowedLanguages, true)) {
    sendPreferencesResponse(422, [
        'success' => false,
        'message' => 'Please select a supported language.',
    ]);
}

if (!in_array($newCurrency, $allowedCurrencies, true)) {
    sendPreferencesResponse(422, [
        'success' => false,
        'message' => 'Please select a supported currency.',
    ]);
}

$stmt = $auth_db->prepare(
    'UPDATE accounts SET full_name = ?, language = ?, currency = ? WHERE id = ?'
);

if (!$stmt) {
    error_log('Profile settings prepare failed: ' . $auth_db->error);
    $auth_db->close();
    sendPreferencesResponse(500, [
        'success' => false,
        'silent' => true,
    ]);
}

$stmt->bind_param('sssi', $newName, $newLanguage, $newCurrency, $userId);
$success = $stmt->execute();

if (!$success) {
    error_log('Profile settings update failed: ' . $stmt->error);
    $stmt->close();
    $auth_db->close();
    sendPreferencesResponse(500, [
        'success' => false,
        'message' => 'Your profile could not be saved. Please try again.',
    ]);
}

$stmt->close();
$auth_db->close();

$_SESSION['user_name'] = $newName;
$_SESSION['language'] = $newLanguage;
$_SESSION['currency'] = $newCurrency;

sendPreferencesResponse(200, [
    'success' => true,
    'message' => 'Your profile has been saved.',
    'profile' => [
        'display_name' => $newName,
        'language' => $newLanguage,
        'currency' => $newCurrency,
    ],
]);
