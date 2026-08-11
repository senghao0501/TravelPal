<?php
// 1. Get Hotel ID from URL (e.g., detail.php?id=2)
$hotel_id = isset($_GET['id']) ? intval($_GET['id']) : 1;

/*
// =========================================================================
// DATABASE INTEGRATION EXAMPLE (Uncomment and edit when using MySQL)
// =========================================================================
$db = new PDO('mysql:host=localhost;dbname=your_database;charset=utf8', 'username', 'password');
$stmt = $db->prepare('SELECT * FROM hotels WHERE id = ?');
$stmt->execute([$hotel_id]);
$hotel = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$hotel) {
    die("Hotel not found!");
}
// =========================================================================
*/

// 2. Dynamic Mock Hotel Data (Each hotel now has distinct prices)
$hotels_data = [
    1 => [
        'id' => 1,
        'name' => 'The Ritz-Carlton, Kyoto',
        'location' => 'Nakagyo Ward, Kyoto, Japan',
        'price_per_night' => 850,
        'currency' => '$',
        'rating' => '4.9',
        'reviews_count' => 128,
        'main_image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1200&q=80',
        'description' => 'Situated along the banks of the Kamogawa river, offering stunning views of the Higashiyama mountains. Blending traditional Japanese architecture with modern luxury.',
        'amenities' => ['Free High-Speed Wi-Fi', 'Indoor Heated Pool', 'Luxury SPA Center', 'Michelin-starred Dining', '24-Hour Butler Service']
    ],
    2 => [
        'id' => 2,
        'name' => 'Marina Bay Sands',
        'location' => 'Bayfront Avenue, Singapore',
        'price_per_night' => 620,
        'currency' => '$',
        'rating' => '4.8',
        'reviews_count' => 310,
        'main_image' => 'https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=1200&q=80',
        'description' => 'An iconic landmark in Singapore featuring the world\'s largest rooftop infinity pool with breathtaking skyline views of Marina Bay.',
        'amenities' => ['57th Floor Infinity Pool', 'SkyPark Observation Deck', 'Premier Shopping Mall', '24-Hour Fitness Center', 'Luxury Airport Shuttle']
    ],
    3 => [
        'id' => 3,
        'name' => 'Grand Hyatt Bali',
        'location' => 'Nusa Dua, Bali, Indonesia',
        'price_per_night' => 280,
        'currency' => '$',
        'rating' => '4.7',
        'reviews_count' => 95,
        'main_image' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=1200&q=80',
        'description' => 'A tropical paradise in Nusa Dua offering private beach access, lush gardens, multiple outdoor swimming pools, and authentic Balinese luxury.',
        'amenities' => ['Private Beach Access', 'Lagoon Pools', 'Balinese Spa', 'Water Sports Center', 'Kids Club']
    ],
    4 => [
        'id' => 4,
        'name' => 'Burj Al Arab',
        'location' => 'Jumeirah Beach, Dubai, UAE',
        'price_per_night' => 1500,
        'currency' => '$',
        'rating' => '5.0',
        'reviews_count' => 420,
        'main_image' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=1200&q=80',
        'description' => 'The world\'s most luxurious hotel, standing on its own island. Featuring sail-shaped architecture, suite-only accommodations, and private helicopter transfers.',
        'amenities' => ['Private Helipad', 'Duplex Suites', 'Chauffeur-driven Rolls-Royce', 'Private Beach', 'Underwater Restaurant']
    ]
];

// Fallback to hotel ID 1 if ID is invalid or not found
$hotel = isset($hotels_data[$hotel_id]) ? $hotels_data[$hotel_id] : $hotels_data[1];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($hotel['name']); ?> - Hotel Details</title>
    <!-- Linked CSS with cache busting -->
    <link rel="stylesheet" href="../css/modules/hotels.css">
</head>
<body style="background-color: #0f172a; margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">

<div class="detail-container">

    <!-- ================= 1. LEFT: HOTEL DETAILS ================= -->
    <div class="detail-info">
        <!-- Hotel Name & Location -->
        <h1><?php echo htmlspecialchars($hotel['name']); ?></h1>
        <p class="location">📍 <?php echo htmlspecialchars($hotel['location']); ?></p>

        <!-- Main Image -->
        <div class="gallery">
            <img src="<?php echo htmlspecialchars($hotel['main_image']); ?>" alt="<?php echo htmlspecialchars($hotel['name']); ?>">
        </div>

        <!-- Description -->
        <h3>About This Hotel</h3>
        <p><?php echo htmlspecialchars($hotel['description']); ?></p>

        <!-- Amenities -->
        <h3>Amenities & Services</h3>
        <div class="amenities-tags" style="margin-top: 15px;">
            <?php foreach ($hotel['amenities'] as $amenity): ?>
                <span class="amenity-chip">✓ <?php echo htmlspecialchars($amenity); ?></span>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- ================= 2. RIGHT: FLOATING BOOKING CARD ================= -->
    <div class="booking-card">
        <!-- Dynamic Price Header -->
        <div class="price-header">
            <span class="price-amount" id="basePriceDisplay"><?php echo $hotel['currency'] . $hotel['price_per_night']; ?></span>
            <span class="price-unit">/ night</span>
        </div>

        <!-- Booking Form -->
        <form class="booking-form" action="process_booking.php" method="POST">
            <!-- Hidden input for hotel ID -->
            <input type="hidden" name="hotel_id" value="<?php echo $hotel['id']; ?>">

            <!-- Date Selectors -->
            <div class="form-group-row">
                <div class="form-group">
                    <label for="checkin">Check-in</label>
                    <input type="date" id="checkin" name="check_in" required>
                </div>
                <div class="form-group">
                    <label for="checkout">Check-out</label>
                    <input type="date" id="checkout" name="check_out" required>
                </div>
            </div>

            <!-- Guests Dropdown -->
            <div class="form-group">
                <label for="guests">Guests</label>
                <select id="guests" name="guests">
                    <option value="1">1 Adult</option>
                    <option value="2" selected>2 Adults</option>
                    <option value="3">3 Adults</option>
                    <option value="4">4 Guests (Family Suite)</option>
                </select>
            </div>

            <!-- Room Type Dropdown with Price Multipliers -->
            <div class="form-group">
                <label for="room_type">Room Type</label>
                <select id="room_type" name="room_type">
                    <option value="standard" data-multiplier="1.0">Standard Deluxe Room</option>
                    <option value="executive" data-multiplier="1.4">Executive Suite (+40%)</option>
                    <option value="presidential" data-multiplier="2.2">Presidential Suite (+120%)</option>
                </select>
            </div>

            <!-- Dynamic Price Calculation Display -->
            <div id="priceSummary" style="display: none; background: #f8fafc; padding: 14px; border-radius: 10px; font-size: 14px; color: #475569; margin-top: 10px; border: 1px solid #e2e8f0;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                    <span><span id="effectiveRate">$0</span> × <span id="nightCount">1</span> night(s)</span>
                    <span id="subtotalAmount">$0</span>
                </div>
                <div style="display: flex; justify-content: space-between; font-weight: 700; color: #0f172a; border-top: 1px dashed #cbd5e1; padding-top: 8px; font-size: 15px;">
                    <span>Total Estimated Price</span>
                    <span id="totalAmount" style="color: #ff385c;">$0</span>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-submit-booking">Book Now</button>
            <p class="booking-note">You won't be charged yet</p>
        </form>
    </div>

</div>

<!-- ================= 3. JS: REAL-TIME NIGHT & ROOM MULTIPLIER CALCULATION ================= -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const checkinInput = document.getElementById("checkin");
    const checkoutInput = document.getElementById("checkout");
    const roomTypeSelect = document.getElementById("room_type");
    
    const basePriceDisplay = document.getElementById("basePriceDisplay");
    const priceSummary = document.getElementById("priceSummary");
    const effectiveRateSpan = document.getElementById("effectiveRate");
    const nightCountSpan = document.getElementById("nightCount");
    const subtotalAmountSpan = document.getElementById("subtotalAmount");
    const totalAmountSpan = document.getElementById("totalAmount");

    const basePricePerNight = <?php echo floatval($hotel['price_per_night']); ?>;
    const currency = "<?php echo $hotel['currency']; ?>";

    // Set default check-in to today, check-out to tomorrow
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);

    checkinInput.value = today.toISOString().split('T')[0];
    checkoutInput.value = tomorrow.toISOString().split('T')[0];

    function calculateTotal() {
        const checkinDate = new Date(checkinInput.value);
        const checkoutDate = new Date(checkoutInput.value);

        // Get room multiplier from selected option
        const selectedOption = roomTypeSelect.options[roomTypeSelect.selectedIndex];
        const multiplier = parseFloat(selectedOption.getAttribute("data-multiplier")) || 1.0;

        const currentNightlyRate = Math.round(basePricePerNight * multiplier);

        // Update top price header
        basePriceDisplay.textContent = currency + currentNightlyRate;

        if (checkinDate && checkoutDate && checkoutDate > checkinDate) {
            const timeDiff = checkoutDate.getTime() - checkinDate.getTime();
            const nights = Math.ceil(timeDiff / (1000 * 3600 * 24));
            const totalPrice = nights * currentNightlyRate;

            effectiveRateSpan.textContent = currency + currentNightlyRate;
            nightCountSpan.textContent = nights;
            subtotalAmountSpan.textContent = currency + totalPrice;
            totalAmountSpan.textContent = currency + totalPrice;
            priceSummary.style.display = "block";
        } else {
            priceSummary.style.display = "none";
        }
    }

    // Listeners for input change
    checkinInput.addEventListener("change", calculateTotal);
    checkoutInput.addEventListener("change", calculateTotal);
    roomTypeSelect.addEventListener("change", calculateTotal);

    // Initial calculation on page load
    calculateTotal();
});
</script>

</body>
</html>