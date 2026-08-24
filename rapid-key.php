<?php
declare(strict_types=1);

/*
 * Local RapidAPI credentials shared by the Booking COM15 modules.
 * This file is intentionally ignored by Git.
 */
$travelPalBookingRapidApiKey = trim((string) (
    getenv('TRAVELPAL_BOOKING_RAPIDAPI_KEY')
    ?: '9ee86a6170msh7db37f54aeee8cbp11e8afjsn713e8f9dc34c'
));

if (!defined('RAPIDAPI_KEY')) {
    define('RAPIDAPI_KEY', $travelPalBookingRapidApiKey);
}

if (!defined('RAPIDAPI_HOST')) {
    define('RAPIDAPI_HOST', 'booking-com15.p.rapidapi.com');
}

