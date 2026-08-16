<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'config.php';
require_once 'flights_data.php';
require_once 'api_functions.php';

$flight_id   = $_GET['id'] ?? 1001;
$depart_date = $_GET['depart_date'] ?? date('Y-m-d');
$passengers  = $_GET['passengers'] ?? 1;

$flight = getFlightById($flight_id);

if (!$flight) {
    foreach ($all_flights as $f) {
        if ($f['id'] == $flight_id) {
            $flight = $f;
            break;
        }
    }
}

if (!$flight) {
    $flight = $all_flights[0];
}

$price = $flight['price'];
$airline = $flight['airline'];
$flightNo = $flight['flight_no'];
$fromState = $flight['from_state'];
$toState = $flight['to_state'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Search - TravelPal</title>
    
    <!-- 修正后的 CSS 路径 -->
    <link rel="stylesheet" href="../css/modules/flights.css?v=<?php echo time(); ?>">
    
    <!-- Font Awesome 图标库 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body>

<main class="detail-container">
    <div>
        <h1 style="font-size: 1.8rem; font-weight: 800;"><?php echo htmlspecialchars($airline); ?> (<?php echo htmlspecialchars($flightNo); ?>)</h1>
        <p style="color: var(--slate-500); margin-top: 4px;">
            <i class="fa-solid fa-plane-departure"></i> <?php echo htmlspecialchars($fromState); ?> 
            <i class="fa-solid fa-arrow-right" style="margin: 0 8px;"></i> 
            <i class="fa-solid fa-plane-arrival"></i> <?php echo htmlspecialchars($toState); ?>
        </p>
    </div>

    <div class="detail-layout">
        <div>
            <div class="info-card">
                <h3>Flight Overview</h3>
                <div class="overview-box">
                    <div class="overview-item">
                        <div class="label">Departure Time</div>
                        <div class="val"><?php echo htmlspecialchars($flight['departure_time']); ?></div>
                    </div>
                    <div class="overview-item">
                        <div class="label">Duration</div>
                        <div class="val"><?php echo htmlspecialchars($flight['duration'] ?? '1h 05m'); ?></div>
                    </div>
                    <div class="overview-item">
                        <div class="label">Class</div>
                        <div class="val"><?php echo htmlspecialchars($flight['class_type'] ?? $flight['class'] ?? 'Economy'); ?></div>
                    </div>
                    <div class="overview-item">
                        <div class="label">Date</div>
                        <div class="val"><?php echo date('d M Y', strtotime($depart_date)); ?></div>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <h3>Included Amenities</h3>
                <div class="amenity-grid">
                    <div class="amenity-item"><i class="fa-solid fa-suitcase"></i> 7kg Hand Baggage</div>
                    <div class="amenity-item"><i class="fa-solid fa-wifi"></i> Onboard Wi-Fi (Select flights)</div>
                    <div class="amenity-item"><i class="fa-solid fa-plug"></i> USB Power Outlets</div>
                    <div class="amenity-item"><i class="fa-solid fa-shield-halved"></i> Flight Insurance Eligible</div>
                </div>
            </div>
        </div>

        <div>
            <div class="booking-card">
                <div style="margin-bottom: 16px;">
                    <div style="font-size: 0.8rem; color: var(--slate-500);">Fare starting from</div>
                    <div style="font-size: 1.8rem; font-weight: 900; color: var(--slate-900);">RM <?php echo number_format($price, 2); ?></div>
                </div>

                <form action="checkout.php" method="GET">
                    <input type="hidden" name="flight_id" value="<?php echo $flight['id']; ?>">
                    <div class="form-group">
                        <label>Departure Date</label>
                        <input type="date" class="form-control" name="depart_date" value="<?php echo htmlspecialchars($depart_date); ?>">
                    </div>
                    <div class="form-group">
                        <label>Passengers</label>
                        <input type="number" class="form-control" name="passengers" min="1" max="9" value="<?php echo htmlspecialchars($passengers); ?>">
                    </div>
                    <button type="submit" class="btn-select-flight" style="width: 100%; text-align: center; border: none; font-size: 1rem; cursor: pointer;">
                        Proceed to Checkout
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>
</body>
</html>