<?php
// flights.php - TravelPal domestic flight search page

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/flights_data.php';
require_once __DIR__ . '/api_functions.php';

$isSearched = ($_GET['search_submitted'] ?? '') === '1';

$tripType = normalizeTripType($_GET['trip_type'] ?? 'round_trip');
$origin = strtoupper(trim($_GET['origin'] ?? DEFAULT_ORIGIN));
$destination = strtoupper(trim($_GET['destination'] ?? DEFAULT_DESTINATION));
$departDate = sanitizeDate($_GET['depart_date'] ?? date('Y-m-d'));
$returnDate = sanitizeDate($_GET['return_date'] ?? date('Y-m-d', strtotime($departDate . ' +1 day')));
$passengers = normalizePassengers($_GET['passengers'] ?? DEFAULT_PASSENGERS);
$sort = $_GET['sort'] ?? 'recommended';

$errors = [];
$outboundFlights = [];
$returnFlights = [];
$flightResults = [];
$liveApiUsed = false;

if (!isValidAirportCode($origin)) {
    $errors[] = 'Please select a valid departure airport.';
    $origin = DEFAULT_ORIGIN;
}

if (!isValidAirportCode($destination)) {
    $errors[] = 'Please select a valid destination airport.';
    $destination = DEFAULT_DESTINATION;
}

if ($origin === $destination) {
    $errors[] = 'Departure and destination cannot be the same.';
}

if (isDateBeforeToday($departDate)) {
    $errors[] = 'Departure date cannot be in the past.';
    $departDate = date('Y-m-d');
}

if ($tripType === 'round_trip' && $returnDate < $departDate) {
    $errors[] = 'Return date must be on or after the departure date.';
    $returnDate = date('Y-m-d', strtotime($departDate . ' +1 day'));
}

if ($isSearched && !$errors) {
    $outboundFlights = loadFlightsForRoute($origin, $destination, $departDate, $passengers);

    // Round-trip is a real two-leg search, not just a UI label.
    if ($tripType === 'round_trip') {
        $returnFlights = loadFlightsForRoute($destination, $origin, $returnDate, $passengers);
    }

    // Pair each outbound flight with the same airline where possible.
    foreach ($outboundFlights as $outbound) {
        $returnFlight = null;

        if ($tripType === 'round_trip' && $returnFlights) {
            foreach ($returnFlights as $candidate) {
                if (strcasecmp((string)($candidate['airline'] ?? ''), (string)($outbound['airline'] ?? '')) === 0) {
                    $returnFlight = $candidate;
                    break;
                }
            }

            $returnFlight ??= $returnFlights[0];
        }

        $outboundPrice = (float)($outbound['price'] ?? 0);
        $returnPrice = $returnFlight ? (float)($returnFlight['price'] ?? 0) : 0.0;
        $perPassengerTotal = $outboundPrice + $returnPrice;

        $flightResults[] = [
            'outbound' => $outbound,
            'return' => $returnFlight,
            'per_passenger_total' => $perPassengerTotal,
            'total_price' => $perPassengerTotal * $passengers
        ];
    }

    switch ($sort) {
        case 'price_low':
            usort($flightResults, fn($a, $b) => $a['total_price'] <=> $b['total_price']);
            break;
        case 'price_high':
            usort($flightResults, fn($a, $b) => $b['total_price'] <=> $a['total_price']);
            break;
        case 'rating':
            usort(
                $flightResults,
                fn($a, $b) => ((float)($b['outbound']['rating'] ?? 0)) <=> ((float)($a['outbound']['rating'] ?? 0))
            );
            break;
        default:
            usort($flightResults, function ($a, $b) {
                $aRating = (float)($a['outbound']['rating'] ?? 0);
                $bRating = (float)($b['outbound']['rating'] ?? 0);
                $aPrice = (float)$a['total_price'];
                $bPrice = (float)$b['total_price'];

                // Recommended = rating matters first, then total price.
                return ($bRating <=> $aRating) ?: ($aPrice <=> $bPrice);
            });
            break;
    }

    // The module uses fallback automatically if live API + DB both fail.
    // This tag means "the current dataset contains at least one API result".
    foreach ($outboundFlights as $flight) {
        if (($flight['_source'] ?? '') === 'api') {
            $liveApiUsed = true;
            break;
        }
    }
}

$airportCodes = getSearchAirportCodes();

function h($value): string
{
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function buildSearchUrl(array $overrides = []): string
{
    $params = [
        'search_submitted' => '1',
        'trip_type' => $GLOBALS['tripType'],
        'origin' => $GLOBALS['origin'],
        'destination' => $GLOBALS['destination'],
        'depart_date' => $GLOBALS['departDate'],
        'return_date' => $GLOBALS['returnDate'],
        'passengers' => $GLOBALS['passengers'],
        'sort' => $GLOBALS['sort']
    ];

    $params = array_merge($params, $overrides);
    return htmlspecialchars($_SERVER['PHP_SELF'] . '?' . http_build_query($params), ENT_QUOTES, 'UTF-8');
}

include __DIR__ . '/../header.php';
?>

<link rel="stylesheet" href="../css/modules/flights.css?v=2">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<section class="hero-section">
    <div class="hero-content">
        <span class="hero-kicker">TRAVELPAL · MALAYSIA</span>
        <h1>Find Your Next Domestic Flight</h1>
        <p>Compare routes across Penang, Johor, Sabah, Sarawak and more.</p>
    </div>

    <div class="search-container">
        <form id="flight-search-form" action="<?php echo h($_SERVER['PHP_SELF']); ?>" method="GET" novalidate>
            <input type="hidden" name="search_submitted" value="1">

            <div class="trip-type-selector" role="radiogroup" aria-label="Trip type">
                <label class="radio-label">
                    <input type="radio" name="trip_type" value="round_trip" <?php echo $tripType === 'round_trip' ? 'checked' : ''; ?> data-trip-type="round_trip">
                    <span class="custom-radio"></span>
                    Round-trip
                </label>
                <label class="radio-label">
                    <input type="radio" name="trip_type" value="one_way" <?php echo $tripType === 'one_way' ? 'checked' : ''; ?> data-trip-type="one_way">
                    <span class="custom-radio"></span>
                    One-way
                </label>
            </div>

            <div class="filter-bar">
                <div class="input-group search-location-group">
                    <i class="fa-solid fa-plane-departure icon"></i>
                    <div class="input-wrapper">
                        <label for="origin">From</label>
                        <select id="origin" name="origin" required>
                            <?php foreach ($airportCodes as $code): ?>
                                <option value="<?php echo h($code); ?>" <?php echo $origin === $code ? 'selected' : ''; ?>>
                                    <?php echo h(getAirportLabel($code)); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <button type="button" class="swap-button" id="swap-airports" title="Swap departure and destination" aria-label="Swap departure and destination">
                    <i class="fa-solid fa-arrow-right-arrow-left"></i>
                </button>

                <div class="input-group search-location-group">
                    <i class="fa-solid fa-plane-arrival icon"></i>
                    <div class="input-wrapper">
                        <label for="destination">To</label>
                        <select id="destination" name="destination" required>
                            <?php foreach ($airportCodes as $code): ?>
                                <option value="<?php echo h($code); ?>" <?php echo $destination === $code ? 'selected' : ''; ?>>
                                    <?php echo h(getAirportLabel($code)); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="input-group">
                    <i class="fa-solid fa-calendar-day icon"></i>
                    <div class="input-wrapper">
                        <label for="depart_date">Departure</label>
                        <input id="depart_date" type="date" name="depart_date" value="<?php echo h($departDate); ?>" min="<?php echo h(date('Y-m-d')); ?>" required>
                    </div>
                </div>

                <div class="input-group return-date-group" id="return-date-group">
                    <i class="fa-solid fa-calendar-check icon"></i>
                    <div class="input-wrapper">
                        <label for="return_date">Return</label>
                        <input id="return_date" type="date" name="return_date" value="<?php echo h($returnDate); ?>" min="<?php echo h($departDate); ?>" <?php echo $tripType === 'one_way' ? 'disabled' : ''; ?> required>
                    </div>
                </div>

                <div class="input-group passenger-group">
                    <i class="fa-solid fa-user-group icon"></i>
                    <div class="input-wrapper">
                        <label for="passengers">Passengers</label>
                        <select id="passengers" name="passengers" required>
                            <?php for ($i = 1; $i <= MAX_PASSENGERS; $i++): ?>
                                <option value="<?php echo $i; ?>" <?php echo $passengers === $i ? 'selected' : ''; ?>>
                                    <?php echo $i; ?> <?php echo $i === 1 ? 'Adult' : 'Adults'; ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span>Search Flights</span>
                </button>
            </div>

            <p class="search-helper" id="search-helper">Prices are shown per passenger. Choose your passenger count before searching.</p>
        </form>
    </div>
</section>

<main class="main-content">
    <?php if ($errors): ?>
        <div class="search-alert" role="alert">
            <i class="fa-solid fa-circle-exclamation"></i>
            <div>
                <?php foreach ($errors as $error): ?>
                    <p><?php echo h($error); ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($isSearched && !$errors): ?>
        <section class="search-results-section">
            <div class="search-results-header">
                <div>
                    <div class="results-title-row">
                        <h2><?php echo $tripType === 'round_trip' ? 'Round-trip Flights' : 'Available Flights'; ?></h2>
                        <?php if ($liveApiUsed): ?>
                            <span class="live-api-tag"><i class="fa-solid fa-bolt"></i> Live API Data</span>
                        <?php elseif (($outboundFlights[0]['_source'] ?? '') === 'database'): ?>
                            <span class="fallback-tag"><i class="fa-solid fa-database"></i> Cached Data</span>
                        <?php else: ?>
                            <span class="fallback-tag"><i class="fa-solid fa-flask"></i> Demo Data</span>
                        <?php endif; ?>
                    </div>
                    <p class="results-subtitle">
                        <?php echo h(getAirportLabel($origin)); ?> → <?php echo h(getAirportLabel($destination)); ?>
                        · <?php echo h(date('d M Y', strtotime($departDate))); ?>
                        <?php if ($tripType === 'round_trip'): ?>
                            · return <?php echo h(date('d M Y', strtotime($returnDate))); ?>
                        <?php endif; ?>
                        · <?php echo $passengers; ?> <?php echo $passengers === 1 ? 'passenger' : 'passengers'; ?>
                    </p>
                </div>

                <form action="<?php echo h($_SERVER['PHP_SELF']); ?>" method="GET" class="sort-form">
                    <input type="hidden" name="search_submitted" value="1">
                    <input type="hidden" name="trip_type" value="<?php echo h($tripType); ?>">
                    <input type="hidden" name="origin" value="<?php echo h($origin); ?>">
                    <input type="hidden" name="destination" value="<?php echo h($destination); ?>">
                    <input type="hidden" name="depart_date" value="<?php echo h($departDate); ?>">
                    <input type="hidden" name="return_date" value="<?php echo h($returnDate); ?>">
                    <input type="hidden" name="passengers" value="<?php echo $passengers; ?>">
                    <label for="sort">Sort by</label>
                    <select id="sort" name="sort" onchange="this.form.submit()">
                        <option value="recommended" <?php echo $sort === 'recommended' ? 'selected' : ''; ?>>Recommended</option>
                        <option value="price_low" <?php echo $sort === 'price_low' ? 'selected' : ''; ?>>Total price: Low to High</option>
                        <option value="price_high" <?php echo $sort === 'price_high' ? 'selected' : ''; ?>>Total price: High to Low</option>
                        <option value="rating" <?php echo $sort === 'rating' ? 'selected' : ''; ?>>Highest Rated</option>
                    </select>
                </form>
            </div>

            <?php if (!$flightResults): ?>
                <div class="empty-state">
                    <i class="fa-solid fa-plane-circle-xmark"></i>
                    <h3>No flights found</h3>
                    <p>Try another route or date.</p>
                </div>
            <?php else: ?>
                <div class="flight-list">
                    <?php foreach ($flightResults as $result):
                        $outbound = $result['outbound'];
                        $return = $result['return'];
                        $outboundId = $outbound['id'];
                        $returnId = $return['id'] ?? '';
                        $perPassengerTotal = (float)$result['per_passenger_total'];
                        $totalPrice = (float)$result['total_price'];
                        $outboundPrice = (float)($outbound['price'] ?? 0);
                        $returnPrice = (float)($return['price'] ?? 0);
                        $detailUrl = 'detail.php?' . http_build_query([
                            'id' => $outboundId,
                            'return_id' => $returnId,
                            'trip_type' => $tripType,
                            'passengers' => $passengers,
                            'depart_date' => $departDate,
                            'return_date' => $returnDate
                        ]);
                    ?>
                        <article class="hotel-style-card flight-result-card">
                            <div class="flight-card-main">
                                <div class="airline-brand-box">
                                    <img src="<?php echo h($outbound['logo_url'] ?? DEFAULT_AIRLINE_LOGO); ?>" alt="<?php echo h($outbound['airline'] ?? 'Airline'); ?>">
                                    <div class="airline-info">
                                        <h3><?php echo h($outbound['airline'] ?? 'Airline'); ?></h3>
                                        <div class="airline-tags">
                                            <span class="badge badge-code"><?php echo h($outbound['flight_no'] ?? 'N/A'); ?></span>
                                            <span class="badge badge-type"><?php echo ((int)($outbound['stops'] ?? 0) === 0) ? 'Direct' : ((int)$outbound['stops'] . ' Stop'); ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flight-leg-block">
                                    <div class="leg-label">Outbound · <?php echo h(date('D, d M', strtotime($departDate))); ?></div>
                                    <div class="flight-route-timeline">
                                        <div class="time-block origin">
                                            <span class="time"><?php echo h($outbound['departure_time'] ?? 'N/A'); ?></span>
                                            <span class="code"><?php echo h($outbound['from_code'] ?? $origin); ?></span>
                                            <span class="city"><?php echo h($outbound['from_state'] ?? getStateName($origin)); ?></span>
                                        </div>

                                        <div class="duration-block">
                                            <span class="duration-text"><i class="fa-regular fa-clock"></i> <?php echo h($outbound['duration'] ?? 'N/A'); ?></span>
                                            <div class="route-line">
                                                <span class="dot"></span>
                                                <span class="line"></span>
                                                <i class="fa-solid fa-plane plane-icon"></i>
                                                <span class="line"></span>
                                                <span class="dot"></span>
                                            </div>
                                            <span class="route-type"><?php echo ((int)($outbound['stops'] ?? 0) === 0) ? 'Non-stop' : 'Connecting'; ?></span>
                                        </div>

                                        <div class="time-block destination">
                                            <span class="time"><?php echo h($outbound['arrival_time'] ?? 'N/A'); ?></span>
                                            <span class="code"><?php echo h($outbound['to_code'] ?? $destination); ?></span>
                                            <span class="city"><?php echo h($outbound['to_state'] ?? getStateName($destination)); ?></span>
                                        </div>
                                    </div>
                                </div>

                                <?php if ($tripType === 'round_trip' && $return): ?>
                                    <div class="return-leg-summary">
                                        <div>
                                            <span class="leg-label">Return · <?php echo h(date('D, d M', strtotime($returnDate))); ?></span>
                                            <strong><?php echo h($return['departure_time'] ?? 'N/A'); ?> <?php echo h($return['from_code'] ?? $destination); ?> → <?php echo h($return['arrival_time'] ?? 'N/A'); ?> <?php echo h($return['to_code'] ?? $origin); ?></strong>
                                        </div>
                                        <span class="return-price">+ RM <?php echo number_format($returnPrice, 2); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="flight-card-side">
                                <div class="price-box">
                                    <span class="price-label">Total for <?php echo $passengers; ?> <?php echo $passengers === 1 ? 'passenger' : 'passengers'; ?></span>
                                    <div class="price-amount">RM <?php echo number_format($totalPrice, 2); ?></div>
                                    <span class="price-sub">
                                        RM <?php echo number_format($perPassengerTotal, 2); ?> / passenger
                                        <?php if ($tripType === 'round_trip'): ?>
                                            · return included
                                        <?php endif; ?>
                                    </span>
                                </div>
                                <a href="<?php echo h($detailUrl); ?>" class="btn-select-flight">
                                    View Flight <i class="fa-solid fa-chevron-right"></i>
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    <?php else: ?>
        <section class="gallery-section">
            <div class="section-header">
                <h2>Explore Malaysia's Top Destinations</h2>
                <p>Popular places to fly to from major Malaysian airports.</p>
            </div>
            <div class="gallery-grid">
                <div class="gallery-card"><img src="https://images.unsplash.com/photo-1596422846543-75c6fc197f07?auto=format&fit=crop&w=700&q=80" alt="Sabah"><div class="gallery-overlay"><h3>Sabah</h3><p>Mount Kinabalu & islands</p></div></div>
                <div class="gallery-card"><img src="https://images.unsplash.com/photo-1512100356356-de1b84283e18?auto=format&fit=crop&w=700&q=80" alt="Penang"><div class="gallery-overlay"><h3>Penang</h3><p>Heritage & street food</p></div></div>
                <div class="gallery-card"><img src="https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?auto=format&fit=crop&w=700&q=80" alt="Selangor"><div class="gallery-overlay"><h3>Selangor</h3><p>Modern skyline & Batu Caves</p></div></div>
                <div class="gallery-card"><img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=700&q=80" alt="Sarawak"><div class="gallery-overlay"><h3>Sarawak</h3><p>Rainforests & culture</p></div></div>
                <div class="gallery-card"><img src="https://images.unsplash.com/photo-1508009603885-50cf7c579365?auto=format&fit=crop&w=700&q=80" alt="Melaka"><div class="gallery-overlay"><h3>Melaka</h3><p>History & architecture</p></div></div>
                <div class="gallery-card"><img src="https://images.unsplash.com/photo-1525625293386-3f8f99389edd?auto=format&fit=crop&w=700&q=80" alt="Perak"><div class="gallery-overlay"><h3>Perak</h3><p>Ipoh, caves & cuisine</p></div></div>
            </div>
        </section>

        <section class="staycation-member-banner" aria-labelledby="staycation-member-title">
            <div class="staycation-banner-icon" aria-hidden="true">
                <i class="fa-solid fa-tags"></i>
            </div>
            <div class="staycation-banner-copy">
                <h2 id="staycation-member-title">Unlock Member Flight Benefits</h2>
    <p>Sign in to access member-only fares, saved flight preferences and faster booking.</p>
            </div>
            <div class="staycation-banner-actions">
                <a href="/TravelPal/auth/login.php" class="staycation-btn staycation-btn-primary">Sign In</a>
                <a href="/TravelPal/auth/register.php" class="staycation-btn staycation-btn-secondary">Register Free</a>
            </div>
        </section>

        <section class="features-section">
            <div class="feature-item"><div class="feature-icon-wrapper"><i class="fa-solid fa-route"></i></div><div class="feature-info"><h4>Route-aware Search</h4><p>Change origin, destination and travel dates directly in the search bar.</p></div></div>
            <div class="feature-item"><div class="feature-icon-wrapper"><i class="fa-solid fa-users"></i></div><div class="feature-info"><h4>Passenger-aware Pricing</h4><p>Choose up to 9 passengers and the displayed total updates accordingly.</p></div></div>
            <div class="feature-item"><div class="feature-icon-wrapper"><i class="fa-solid fa-arrows-rotate"></i></div><div class="feature-info"><h4>One-way or Round-trip</h4><p>Round-trip searches include a separate return-leg date and fare.</p></div></div>
        </section>

        <section class="routes-section">
            <div class="section-header">
                <h2>Popular Domestic Routes</h2>
                <p>Jump straight into a route search.</p>
            </div>

            <div class="category-tabs">
                <button type="button" class="tab-btn active" data-tab="routes">Popular Routes</button>
                <button type="button" class="tab-btn" data-tab="cities">Cities Covered</button>
                <button type="button" class="tab-btn" data-tab="airports">Airports Served</button>
            </div>

            <div id="tab-routes" class="tab-content active">
                <div class="routes-grid">
                    <?php
                    $popularRoutes = [
                        ['KUL', 'PEN', 'Penang', '1h 00m'],
                        ['KUL', 'BKI', 'Sabah', '2h 35m'],
                        ['KUL', 'KCH', 'Sarawak', '1h 45m'],
                        ['PEN', 'JHB', 'Johor', '1h 10m'],
                        ['JHB', 'IPH', 'Perak', '1h 15m'],
                        ['KUL', 'PKG', 'Pahang', '1h 00m']
                    ];
                    foreach ($popularRoutes as [$from, $to, $name, $duration]):
                    ?>
                        <a class="route-card" href="<?php echo buildSearchUrl(['origin' => $from, 'destination' => $to, 'sort' => 'recommended']); ?>">
                            <div class="route-icon"><i class="fa-solid fa-plane"></i></div>
                            <div class="route-details">
                                <span class="city-pair"><?php echo h(getStateName($from)); ?> <i class="fa-solid fa-arrow-right"></i> <?php echo h($name); ?></span>
                                <span class="route-sub">Domestic · approx. <?php echo h($duration); ?></span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <div id="tab-cities" class="tab-content">
                <div class="simple-list-grid">
                    <div class="list-item"><i class="fa-solid fa-city"></i> Kuala Lumpur / Subang</div>
                    <div class="list-item"><i class="fa-solid fa-city"></i> George Town</div>
                    <div class="list-item"><i class="fa-solid fa-city"></i> Johor Bahru</div>
                    <div class="list-item"><i class="fa-solid fa-city"></i> Kota Kinabalu</div>
                    <div class="list-item"><i class="fa-solid fa-city"></i> Kuching</div>
                    <div class="list-item"><i class="fa-solid fa-city"></i> Ipoh</div>
                    <div class="list-item"><i class="fa-solid fa-city"></i> Melaka City</div>
                    <div class="list-item"><i class="fa-solid fa-city"></i> Kuantan / Tioman</div>
                </div>
            </div>

            <div id="tab-airports" class="tab-content">
                <div class="simple-list-grid">
                    <?php foreach ($airportCodes as $code): ?>
                        <div class="list-item"><i class="fa-solid fa-plane"></i> <?php echo h(getAirportLabel($code)); ?></div>
                    <?php endforeach; ?>
                </div>
            </div>

            <p class="disclaimer-text">* Live fares are subject to API availability. Demo data is shown automatically when live data cannot be loaded.</p>
        </section>
    <?php endif; ?>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('flight-search-form');
    if (!form) return;

    const origin = document.getElementById('origin');
    const destination = document.getElementById('destination');
    const departDate = document.getElementById('depart_date');
    const returnDate = document.getElementById('return_date');
    const returnGroup = document.getElementById('return-date-group');
    const passengers = document.getElementById('passengers');
    const helper = document.getElementById('search-helper');
    const swapButton = document.getElementById('swap-airports');
    const tripInputs = form.querySelectorAll('input[name="trip_type"]');

    function updateTripType() {
        const selected = form.querySelector('input[name="trip_type"]:checked').value;
        const isRoundTrip = selected === 'round_trip';
        returnDate.disabled = !isRoundTrip;
        returnDate.required = isRoundTrip;
        returnGroup.classList.toggle('is-disabled', !isRoundTrip);
        helper.textContent = isRoundTrip
            ? 'Round-trip search compares an outbound fare and a return fare.'
            : 'One-way search shows the outbound fare only.';

        if (isRoundTrip && returnDate.value < departDate.value) {
            returnDate.value = departDate.value;
        }
        returnDate.min = departDate.value;
    }

    function validateSearch() {
        if (origin.value === destination.value) {
            alert('Please choose a different origin and destination.');
            return false;
        }
        if (departDate.value && departDate.value < new Date().toISOString().slice(0, 10)) {
            alert('Departure date cannot be in the past.');
            return false;
        }
        const selected = form.querySelector('input[name="trip_type"]:checked').value;
        if (selected === 'round_trip' && returnDate.value < departDate.value) {
            alert('Return date must be on or after the departure date.');
            return false;
        }
        return true;
    }

    tripInputs.forEach(input => input.addEventListener('change', updateTripType));
    departDate.addEventListener('change', function () {
        returnDate.min = departDate.value;
        if (!returnDate.disabled && returnDate.value < departDate.value) {
            returnDate.value = departDate.value;
        }
    });

    swapButton.addEventListener('click', function () {
        const oldOrigin = origin.value;
        origin.value = destination.value;
        destination.value = oldOrigin;
        swapButton.classList.add('swapped');
        setTimeout(() => swapButton.classList.remove('swapped'), 250);
    });

    form.addEventListener('submit', function (event) {
        if (!validateSearch()) {
            event.preventDefault();
        }
        void passengers;
    });

    document.querySelectorAll('.tab-btn').forEach(button => {
        button.addEventListener('click', function () {
            const tabName = this.dataset.tab;
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
            this.classList.add('active');
            document.getElementById('tab-' + tabName)?.classList.add('active');
        });
    });

    updateTripType();
});
</script>

<?php
if (file_exists(__DIR__ . '/../footer.php')) {
    include __DIR__ . '/../footer.php';
} elseif (file_exists(__DIR__ . '/../includes/footer.php')) {
    include __DIR__ . '/../includes/footer.php';
}
?>
