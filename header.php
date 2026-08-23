<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$travelPalLoggedIn = !empty($_SESSION['user_id']);
$travelPalScript = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
$showFavoriteFab = in_array($travelPalScript, [
    '/TravelPal/index.php', '/TravelPal/flights/index.php', '/TravelPal/hotels/index.php',
    '/TravelPal/restaurant/index.php', '/TravelPal/attractions/index.php'
], true);
?>
<!-- header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelPal</title>
    <link rel="stylesheet" href="/TravelPal/css/style.css?v=2026">
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>

<nav class="navbar">
    <div class="navbar-container">
        <a href="/TravelPal/index.php" class="logo">
            <img src="/TravelPal/logo.png" alt="TravelPal Logo">
        </a>

        <div class="nav-links">
            <a href="/TravelPal/index.php">Home</a>
            <a href="/TravelPal/flights/index.php">Flights</a>
            <a href="/TravelPal/hotels/index.php">Hotels</a>
            <a href="/TravelPal/restaurant/index.php">Restaurants</a>
            <a href="/TravelPal/attractions/index.php">Attractions</a>
            <?php if ($travelPalLoggedIn): ?>
                <a href="/TravelPal/trips/index.php">My Trips</a>
                <a href="/TravelPal/trips/index.php#transactions">Transactions</a>
            <?php else: ?>
                <a href="#" onclick="event.preventDefault(); window.TravelPalLoginPopup && window.TravelPalLoginPopup.open();">My Trips</a>
            <?php endif; ?>
            <a href="/TravelPal/settings/index.php">Settings</a>
            <a href="/TravelPal/auth/login.php" class="btn-login">Sign in</a>

            <a href="/TravelPal/settings/index.php" class="profile-avatar" aria-label="Open account settings" title="Account settings">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="8" r="4"></circle>
                    <path d="M4.5 21a7.5 7.5 0 0 1 15 0"></path>
                </svg>
            </a>
        </div>
    </div>
</nav>

<?php include __DIR__ . '/login_popup.php'; ?>

<?php if ($showFavoriteFab): ?>
    <a class="travelpal-favorite-fab" href="<?php echo $travelPalLoggedIn ? '/TravelPal/trips/favorites.php' : '#'; ?>" <?php echo $travelPalLoggedIn ? '' : 'onclick="event.preventDefault(); window.TravelPalLoginPopup && window.TravelPalLoginPopup.open();"'; ?> aria-label="Open favorites and trip timetable" title="Favorites & timetable">
        <i class="fa-solid fa-heart"></i>
    </a>
<?php endif; ?>

<main>
