<?php
// detail.php - flight detail + passenger-aware price summary

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/flights_data.php';
require_once __DIR__ . '/api_functions.php';

$flightId = $_GET['id'] ?? null;
$returnId = $_GET['return_id'] ?? null;
$tripType = normalizeTripType($_GET['trip_type'] ?? 'one_way');
$departDate = sanitizeDate($_GET['depart_date'] ?? date('Y-m-d'));
$returnDate = sanitizeDate($_GET['return_date'] ?? date('Y-m-d', strtotime($departDate . ' +1 day')));
$passengers = normalizePassengers($_GET['passengers'] ?? 1);

// ========== 获取出站航班 ==========
$outbound = null;

// 1. 尝试从数据库获取
$outbound = getFlightById($flightId);

// 2. 如果数据库没有，从本地数据获取
if (!$outbound && $flightId) {
    $outbound = findLocalFallbackFlight($flightId);
}

// 3. 如果还是没有，遍历所有本地数据找匹配的ID
if (!$outbound && $flightId) {
    global $all_flights;
    foreach ($all_flights as $flight) {
        if ($flight['id'] == $flightId) {
            $outbound = convertLocalFlight($flight, $departDate);
            break;
        }
    }
}

// 4. 最后的保底：使用第一个航班
if (!$outbound) {
    global $all_flights;
    if (!empty($all_flights)) {
        $outbound = convertLocalFlight($all_flights[0], $departDate);
    }
}

// ========== 获取返程航班 ==========
$return = null;
if ($tripType === 'round_trip' && $returnId) {
    $return = getFlightById($returnId);
    if (!$return) {
        $return = findLocalFallbackFlight($returnId);
    }
    if (!$return) {
        global $all_flights;
        foreach ($all_flights as $flight) {
            if ($flight['id'] == $returnId) {
                $return = convertLocalFlight($flight, $returnDate);
                break;
            }
        }
    }
}

// 如果找不到指定ID的返程航班，尝试找相同航线反向的航班
if (!$return && $tripType === 'round_trip' && $outbound) {
    global $all_flights;
    foreach ($all_flights as $flight) {
        if ($flight['from_code'] === $outbound['to_code'] && $flight['to_code'] === $outbound['from_code']) {
            $return = convertLocalFlight($flight, $returnDate);
            break;
        }
    }
}

// 如果还是找不到返程，创建一个基本的返程
if (!$return && $tripType === 'round_trip' && $outbound) {
    $return = [
        'id' => rand(9000, 9999),
        'airline' => $outbound['airline'] ?? 'AirAsia',
        'flight_no' => 'RET-' . rand(100, 999),
        'from_state' => $outbound['to_state'],
        'from_code' => $outbound['to_code'],
        'to_state' => $outbound['from_state'],
        'to_code' => $outbound['from_code'],
        'departure_time' => date('h:i A', strtotime('14:00')),
        'arrival_time' => date('h:i A', strtotime('15:30')),
        'duration' => $outbound['duration'] ?? '1h 30m',
        'price' => $outbound['price'] * 0.9,
        'rating' => $outbound['rating'] ?? 8.0,
        'class_type' => $outbound['class_type'] ?? 'Economy',
        'logo_url' => $outbound['logo_url'] ?? DEFAULT_AIRLINE_LOGO,
        'stops' => 0,
        'is_direct' => 1,
        'departure_date' => $returnDate,
        '_source' => 'fallback'
    ];
}

if (!$outbound) {
    http_response_code(404);
    include __DIR__ . '/../header.php';
    ?>
    <link rel="stylesheet" href="../css/modules/flights.css?v=2">
    <main class="main-content">
        <div class="empty-state detail-empty-state">
            <i class="fa-solid fa-plane-circle-exclamation"></i>
            <h2>Flight not found</h2>
            <p>The selected flight is no longer available.</p>
            <a href="flights.php" class="btn-select-flight">Back to Flight Search</a>
        </div>
    </main>
    <?php
    if (file_exists(__DIR__ . '/../footer.php')) {
        include __DIR__ . '/../footer.php';
    }
    exit;
}

$outboundPrice = (float)($outbound['price'] ?? 0);
$returnPrice = $return ? (float)($return['price'] ?? 0) : 0.0;
$perPassengerTotal = $outboundPrice + $returnPrice;
$totalPrice = $perPassengerTotal * $passengers;

function h_detail($value): string
{
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

include __DIR__ . '/../header.php';
?>

<link rel="stylesheet" href="../css/modules/flights.css?v=2">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<main class="detail-page-container">
    <div class="detail-header">
        <div class="detail-kicker"><?php echo $tripType === 'round_trip' ? 'ROUND-TRIP' : 'ONE-WAY'; ?></div>
        <h1><?php echo h_detail($outbound['airline'] ?? 'Airline'); ?> <span>(<?php echo h_detail($outbound['flight_no'] ?? 'N/A'); ?>)</span></h1>
        <div class="detail-route">
            <strong><?php echo h_detail($outbound['from_state'] ?? 'Origin'); ?></strong>
            <i class="fa-solid fa-arrow-right-long"></i>
            <strong><?php echo h_detail($outbound['to_state'] ?? 'Destination'); ?></strong>
        </div>
    </div>

    <div class="detail-grid">
        <div class="detail-left">
            <section class="info-card">
                <h3><i class="fa-regular fa-clock"></i> Outbound flight</h3>
                <div class="overview-box">
                    <div class="overview-item"><div class="label">Departure</div><div class="val"><?php echo h_detail($outbound['departure_time'] ?? 'N/A'); ?></div></div>
                    <div class="overview-item"><div class="label">Arrival</div><div class="val"><?php echo h_detail($outbound['arrival_time'] ?? 'N/A'); ?></div></div>
                    <div class="overview-item"><div class="label">Duration</div><div class="val"><?php echo h_detail($outbound['duration'] ?? 'N/A'); ?></div></div>
                    <div class="overview-item"><div class="label">Class</div><div class="val"><?php echo h_detail($outbound['class_type'] ?? 'Economy'); ?></div></div>
                    <div class="overview-item"><div class="label">Date</div><div class="val"><?php echo h_detail(date('d M Y', strtotime($departDate))); ?></div></div>
                    <div class="overview-item"><div class="label">Stops</div><div class="val"><?php echo (int)($outbound['stops'] ?? 0) === 0 ? 'Non-stop' : ((int)$outbound['stops'] . ' stop'); ?></div></div>
                </div>
            </section>

            <?php if ($tripType === 'round_trip' && $return): ?>
                <section class="info-card return-card">
                    <h3><i class="fa-solid fa-rotate-left"></i> Return flight</h3>
                    <div class="return-flight-header">
                        <div>
                            <strong><?php echo h_detail($return['airline'] ?? 'Airline'); ?></strong>
                            <span><?php echo h_detail($return['flight_no'] ?? 'N/A'); ?></span>
                        </div>
                        <span class="badge badge-type">Return</span>
                    </div>
                    <div class="overview-box">
                        <div class="overview-item"><div class="label">Departure</div><div class="val"><?php echo h_detail($return['departure_time'] ?? 'N/A'); ?></div></div>
                        <div class="overview-item"><div class="label">Arrival</div><div class="val"><?php echo h_detail($return['arrival_time'] ?? 'N/A'); ?></div></div>
                        <div class="overview-item"><div class="label">Duration</div><div class="val"><?php echo h_detail($return['duration'] ?? 'N/A'); ?></div></div>
                        <div class="overview-item"><div class="label">Date</div><div class="val"><?php echo h_detail(date('d M Y', strtotime($returnDate))); ?></div></div>
                    </div>
                </section>
            <?php endif; ?>

            <section class="info-card">
                <h3><i class="fa-solid fa-suitcase-rolling"></i> Included information</h3>
                <div class="amenity-grid">
                    <div class="amenity-item"><i class="fa-solid fa-suitcase"></i> 7kg cabin baggage</div>
                    <div class="amenity-item"><i class="fa-solid fa-wifi"></i> Wi-Fi information</div>
                    <div class="amenity-item"><i class="fa-solid fa-plug"></i> USB / power availability</div>
                    <div class="amenity-item"><i class="fa-solid fa-circle-check"></i> Instant confirmation</div>
                </div>
                <p class="detail-note">Amenities are representative for this assignment demo. Final airline conditions should be verified before real purchase.</p>
            </section>
        </div>

        <aside class="detail-right">
            <div class="booking-card">
                <div class="booking-price">
                    <div class="fare-label">Price per passenger</div>
                    <div class="fare-amount" id="fare-amount">RM <?php echo number_format($perPassengerTotal, 2); ?></div>
                    <div class="fare-breakdown">
                        <span>Outbound</span><strong>RM <?php echo number_format($outboundPrice, 2); ?></strong>
                        <?php if ($tripType === 'round_trip' && $return): ?>
                            <span>Return</span><strong>RM <?php echo number_format($returnPrice, 2); ?></strong>
                        <?php endif; ?>
                    </div>
                    <div class="fare-total" id="fare-total">Total for <?php echo $passengers; ?> <?php echo $passengers === 1 ? 'passenger' : 'passengers'; ?>: RM <?php echo number_format($totalPrice, 2); ?></div>
                </div>

                <form action="checkout.php" method="GET" id="detail-checkout-form">
                    <input type="hidden" name="flight_id" value="<?php echo h_detail($outbound['id'] ?? $flightId); ?>">
                    <input type="hidden" name="return_id" value="<?php echo h_detail($return['id'] ?? $returnId ?? ''); ?>">
                    <input type="hidden" name="trip_type" value="<?php echo h_detail($tripType); ?>">
                    <input type="hidden" name="depart_date" value="<?php echo h_detail($departDate); ?>">
                    <input type="hidden" name="return_date" value="<?php echo h_detail($returnDate); ?>">

                    <div class="form-group">
                        <label for="detail-passengers">Passengers</label>
                        <select id="detail-passengers" class="form-control" name="passengers">
                            <?php for ($i = 1; $i <= MAX_PASSENGERS; $i++): ?>
                                <option value="<?php echo $i; ?>" <?php echo $passengers === $i ? 'selected' : ''; ?>>
                                    <?php echo $i; ?> <?php echo $i === 1 ? 'Adult' : 'Adults'; ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn-checkout">
                        Continue to Checkout <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </form>

                <p class="checkout-note">The checkout page should recalculate the total from the selected flight IDs and passenger count rather than trusting a URL total.</p>
            </div>
        </aside>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const passengerSelect = document.getElementById('detail-passengers');
    const fareAmount = document.getElementById('fare-amount');
    const fareTotal = document.getElementById('fare-total');

    const basePerPassenger = <?php echo json_encode($perPassengerTotal); ?>;

    function updateTotal() {
        const count = Math.max(1, Number(passengerSelect.value) || 1);
        const total = basePerPassenger * count;
        fareAmount.textContent = 'RM ' + basePerPassenger.toFixed(2);
        fareTotal.textContent = 'Total for ' + count + (count === 1 ? ' passenger' : ' passengers') + ': RM ' + total.toFixed(2);
    }

    passengerSelect.addEventListener('change', updateTotal);
});
</script>

<?php
if (file_exists(__DIR__ . '/../footer.php')) {
    include __DIR__ . '/../footer.php';
} elseif (file_exists(__DIR__ . '/../includes/footer.php')) {
    include __DIR__ . '/../includes/footer.php';
}
?>