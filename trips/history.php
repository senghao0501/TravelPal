<?php
require_once __DIR__ . '/../includes/trip_service.php';
$userId = tp_require_user();
global $auth_db;
$stmt = $auth_db->prepare('SELECT id, order_ref, total_amount, payment_status, created_at FROM trip_orders WHERE user_id = ? ORDER BY created_at DESC');
$stmt->bind_param('i', $userId);
$stmt->execute();
$orders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
include __DIR__ . '/../header.php';
?>
<link rel="stylesheet" href="/TravelPal/css/modules/trips-cart.css?v=2">
<section class="trips-page">
    <div class="trips-shell history-shell">
        <div class="trips-hero"><div><span>TRANSACTION HISTORY</span><h1>Past bookings</h1><p>View completed demo payments and open the related receipt.</p></div><a href="/TravelPal/trips/index.php" class="trips-outline">Back to My Trips</a></div>
        <section class="transaction-history">
            <?php if (!$orders): ?>
                <div class="empty-cart"><h2>No completed payments yet</h2><p>Your completed bookings will appear here.</p><a href="/TravelPal/trips/index.php">Go to My Trips</a></div>
            <?php else: ?><div class="order-list"><?php foreach ($orders as $order): ?><a href="receipt.php?order_id=<?php echo $order['id']; ?>"><span><strong><?php echo tp_h($order['order_ref']); ?></strong><small><?php echo date('d M Y, H:i', strtotime($order['created_at'])); ?></small></span><span><?php echo tp_h($order['payment_status']); ?> · RM <?php echo number_format($order['total_amount'], 2); ?> <i class="fa-solid fa-chevron-right"></i></span></a><?php endforeach; ?></div><?php endif; ?>
        </section>
    </div>
</section>
<?php include __DIR__ . '/../footer.php'; ?>
