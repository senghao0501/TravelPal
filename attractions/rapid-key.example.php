<?php
declare(strict_types=1);

/* Copy to rapid-key.php, then replace the placeholder locally. */
$attractionRapidApiKey = trim((string) (
    getenv('TRAVELPAL_ATTRACTION_RAPIDAPI_KEY')
    ?: 'YOUR_RAPIDAPI_KEY'
));

if (!defined('RAPIDAPI_KEY')) {
    define('RAPIDAPI_KEY', $attractionRapidApiKey);
}

if (!defined('RAPIDAPI_HOST')) {
    define('RAPIDAPI_HOST', 'booking-com15.p.rapidapi.com');
}

