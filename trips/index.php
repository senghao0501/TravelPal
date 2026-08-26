<?php
require_once __DIR__ . '/../includes/trip_service.php';
$userId = tp_require_user();
global $auth_db;

// 🌟 新增核心功能：检查用户是否为“首次购买”（有没有历史订单记录）
$orderCheck = $auth_db->prepare('SELECT COUNT(*) as count FROM trip_orders WHERE user_id = ?');
$orderCheck->bind_param('i', $userId);
$orderCheck->execute();
$isFirstTime = $orderCheck->get_result()->fetch_assoc()['count'] == 0;
$orderCheck->close();

function update_cart_from_request(int $userId): void {
    global $auth_db;
    foreach (($_POST['quantity'] ?? []) as $id => $requestedQuantity) {
        $id = (int)$id;
        $select = $auth_db->prepare('SELECT item_type, booking_data FROM trip_cart_items WHERE id = ? AND user_id = ?');
        $select->bind_param('ii', $id, $userId); $select->execute(); $row = $select->get_result()->fetch_assoc(); $select->close();
        if (!$row) continue;
        $quantityLimit = $row['item_type'] === 'flight' ? 9 : ($row['item_type'] === 'attraction' ? 20 : 30);
        $peopleLimit = $row['item_type'] === 'attraction' ? 20 : 12;
        $quantity = max(1, min($quantityLimit, (int)$requestedQuantity));
        $guests = max(1, min($peopleLimit, (int)($_POST['guests'][$id] ?? 1)));
        $data = json_decode($row['booking_data'] ?: '{}', true) ?: []; $data['guests'] = $guests;
        $update = $auth_db->prepare('UPDATE trip_cart_items SET quantity = ?, booking_data = ? WHERE id = ? AND user_id = ?');
        $json = tp_json_encode($data); $update->bind_param('isii', $quantity, $json, $id, $userId); $update->execute(); $update->close();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'update' || $action === 'pay') update_cart_from_request($userId);
    if ($action === 'remove') {
        $id = (int)($_POST['item_id'] ?? 0);
        $stmt = $auth_db->prepare('DELETE FROM trip_cart_items WHERE id = ? AND user_id = ?'); $stmt->bind_param('ii', $id, $userId); $stmt->execute(); $stmt->close();
        header('Location: index.php?updated=1'); exit;
    }
    if ($action === 'update') { header('Location: index.php?updated=1'); exit; }
    
    if ($action === 'pay') {
        $selected = array_values(array_filter(array_map('intval', $_POST['selected'] ?? [])));
        $items = tp_get_cart_items($userId, $selected);
        if (!$items) { header('Location: index.php?error=no_selection'); exit; }
        
        $subtotal = array_sum(array_column($items, 'line_total'));
        
        // 🌟 新增结算逻辑：如果是第一次买，总价直接打 85 折 (扣除 15%)
        $total = $isFirstTime ? ($subtotal * 0.85) : $subtotal;

        $auth_db->begin_transaction();
        try {
            $reference = 'TP-' . date('Ymd') . '-' . strtoupper(substr(bin2hex(random_bytes(4)), 0, 6));
            $order = $auth_db->prepare('INSERT INTO trip_orders (user_id, order_ref, total_amount) VALUES (?, ?, ?)');
            $order->bind_param('isd', $userId, $reference, $total); $order->execute(); $orderId = $auth_db->insert_id; $order->close();
            $insert = $auth_db->prepare('INSERT INTO trip_order_items (order_id, item_type, title, subtitle, unit_price, quantity, booking_data) VALUES (?, ?, ?, ?, ?, ?, ?)');
            foreach ($items as $item) {
                $bookingJson = $item['booking_data'] ? tp_json_encode($item['booking_data']) : '{}';
                $insert->bind_param('isssdis', $orderId, $item['item_type'], $item['title'], $item['subtitle'], $item['unit_price'], $item['quantity'], $bookingJson);
                $insert->execute();
            }
            $insert->close();
            $ids = implode(',', array_map('intval', $selected));
            $delete = $auth_db->prepare("DELETE FROM trip_cart_items WHERE user_id = ? AND id IN ($ids)"); $delete->bind_param('i', $userId); $delete->execute(); $delete->close();
            $auth_db->commit(); header('Location: receipt.php?order_id=' . $orderId); exit;
        } catch (Throwable $e) { $auth_db->rollback(); $error = 'Payment could not be completed. Please try again.'; }
    }
}
$items = tp_get_cart_items($userId);
$orders = [];
$stmt = $auth_db->prepare('SELECT id, order_ref, total_amount, payment_status, created_at FROM trip_orders WHERE user_id = ? ORDER BY created_at DESC');
$stmt->bind_param('i', $userId); $stmt->execute(); $orders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); $stmt->close();
include __DIR__ . '/../header.php';
?>
<link rel="stylesheet" href="/TravelPal/css/modules/trips-cart.css?v=1">
<section class="trips-page">
    <div class="trips-shell">
        <div class="trips-hero"><div><span>MY TRIPS</span><h1>Your travel cart</h1><p>Review booking details, adjust travellers, nights or attraction tickets, then pay securely.</p></div><a href="/TravelPal/trips/favorites.php" class="trips-outline"><i class="fa-regular fa-heart"></i> Favorites &amp; timetable</a></div>
        <?php if (isset($_GET['added'])): ?><div class="trips-alert success">Added to My Trips. Your booking is ready for checkout.</div><?php endif; ?>
        <?php if (isset($_GET['error']) || isset($error)): ?><div class="trips-alert error"><?php echo tp_h($error ?? 'Choose at least one booking to continue.'); ?></div><?php endif; ?>
        <form method="post" id="cartForm" class="trips-layout">
            <div class="cart-panel">
                <div class="cart-panel-head"><label><input type="checkbox" id="selectAll" checked> Select all</label><span><?php echo count($items); ?> booking<?php echo count($items) === 1 ? '' : 's'; ?></span></div>
                <?php if (!$items): ?>
                    <div class="empty-cart"><i class="fa-solid fa-suitcase-rolling"></i><h2>Your cart is empty</h2><p>Add a flight, hotel or attraction from its details page first.</p><a href="/TravelPal/flights/index.php">Find a flight</a> <a href="/TravelPal/hotels/index.php">Find a hotel</a> <a href="/TravelPal/attractions/index.php">Find an attraction</a></div>
                <?php else: foreach ($items as $item):
                    $data = $item['booking_data'];
                    $isFlight = $item['item_type'] === 'flight';
                    $isAttraction = $item['item_type'] === 'attraction';
                    $itemIcon = $isFlight ? 'plane' : ($isAttraction ? 'ticket' : 'hotel');
                    $quantityLabel = $isFlight ? 'Passengers' : ($isAttraction ? 'Tickets' : 'Nights');
                    $quantityMax = $isFlight ? 9 : ($isAttraction ? 20 : 30);
                    $peopleLabel = $isAttraction ? 'Visitors' : 'Guests';
                    $unitLabel = $isFlight ? '/ person' : ($isAttraction ? '/ ticket' : '/ night');
                ?>
                    <article class="cart-item" data-price="<?php echo $item['unit_price']; ?>">
                        <input class="cart-check" type="checkbox" name="selected[]" value="<?php echo $item['id']; ?>" checked aria-label="Select <?php echo tp_h($item['title']); ?>">
                        <div class="cart-icon <?php echo tp_h($item['item_type']); ?>"><i class="fa-solid fa-<?php echo $itemIcon; ?>"></i></div>
                        <div class="cart-info"><span class="cart-tag"><?php echo tp_h($item['item_type']); ?></span><h2><?php echo tp_h($item['title']); ?></h2><p><?php echo tp_h($item['subtitle']); ?></p><small><?php echo $quantityLabel; ?> can be changed before payment.</small></div>
                        <div class="cart-controls">
                            <label><?php echo $quantityLabel; ?><input class="qty-input" type="number" min="1" max="<?php echo $quantityMax; ?>" name="quantity[<?php echo $item['id']; ?>]" value="<?php echo $item['quantity']; ?>"></label>
                            <label><?php echo $peopleLabel; ?><input type="number" min="1" max="20" name="guests[<?php echo $item['id']; ?>]" value="<?php echo (int)($data['guests'] ?? $item['quantity']); ?>"></label>
                            <button type="submit" name="action" value="remove" onclick="this.form.item_id.value='<?php echo $item['id']; ?>'" class="remove-btn">Remove</button>
                        </div>
                        <div class="cart-price"><small>RM <?php echo number_format($item['unit_price'], 2); ?> <?php echo $unitLabel; ?></small><strong>RM <span class="line-total"><?php echo number_format($item['line_total'], 2); ?></span></strong></div>
                    </article>
                <?php endforeach; endif; ?>
                <input type="hidden" name="item_id" value="">
                <?php if ($items): ?><button type="submit" name="action" value="update" class="update-cart">Update cart</button><?php endif; ?>
            </div>
            
            <aside class="checkout-panel">
                <h2>Checkout summary</h2>
                <div class="summary-row"><span>Selected bookings</span><strong id="selectedCount">0</strong></div>
                
                <!-- 🌟 新增：显示原价小计 -->
                <div class="summary-row"><span>Subtotal</span><strong id="cartSubtotal">RM 0.00</strong></div>
                
                <!-- 🌟 新增：如果符合首次购买条件，动态显示 15% 折扣 -->
                <?php if ($isFirstTime): ?>
                    <div class="summary-row" style="color: #047857; margin-top: 8px;">
                        <span><i class="fa-solid fa-gift"></i> New Member (15% OFF)</span>
                        <strong id="cartDiscount">- RM 0.00</strong>
                    </div>
                <?php endif; ?>
                
                <div class="summary-row total" style="margin-top: 15px; padding-top: 15px; border-top: 1px dashed #d1d5db;">
                    <span>Total</span><strong>RM <span id="cartTotal">0.00</span></strong>
                </div>
                
                <p>Demo payment only. No real payment is collected.</p>
                <button class="pay-btn" type="submit" name="action" value="pay" <?php echo !$items ? 'disabled' : ''; ?>><i class="fa-solid fa-lock"></i> Pay &amp; get receipt</button>
            </aside>
        </form>
        <section class="transaction-history" id="transactions"><div><span>TRANSACTION HISTORY</span><h2>Past receipts</h2></div><?php if (!$orders): ?><p>No completed payments yet.</p><?php else: ?><div class="order-list"><?php foreach ($orders as $order): ?><a href="receipt.php?order_id=<?php echo $order['id']; ?>"><span><strong><?php echo tp_h($order['order_ref']); ?></strong><small><?php echo date('d M Y, H:i', strtotime($order['created_at'])); ?></small></span><span><?php echo tp_h($order['payment_status']); ?> · RM <?php echo number_format($order['total_amount'], 2); ?> <i class="fa-solid fa-chevron-right"></i></span></a><?php endforeach; ?></div><?php endif; ?></section>
    </div>
</section>

<!-- 🌟 JS 核心逻辑更新：自动计算并呈现 15% 折扣效果 -->
<script>
const isFirstTime = <?php echo $isFirstTime ? 'true' : 'false'; ?>;
const checks=[...document.querySelectorAll('.cart-check')], all=document.getElementById('selectAll'), total=document.getElementById('cartTotal'), count=document.getElementById('selectedCount');
const subtotalEl = document.getElementById('cartSubtotal');
const discountEl = document.getElementById('cartDiscount');

function refreshCart(){
    let sum=0, n=0; 
    checks.forEach(check=>{
        const item=check.closest('.cart-item');
        const q=Number(item.querySelector('.qty-input').value)||1;
        const price=Number(item.dataset.price)||0; 
        const linePrice = price * q;
        item.querySelector('.line-total').textContent = linePrice.toFixed(2);
        
        if(check.checked){ sum += linePrice; n++; }
    });
    
    let finalTotal = sum;
    if (count) count.textContent = n;
    if (subtotalEl) subtotalEl.textContent = 'RM ' + sum.toFixed(2);
    
    // 如果是首单，计算 15% 并从总价扣除
    if (isFirstTime && sum > 0) {
        let discountAmt = sum * 0.15;
        finalTotal = sum - discountAmt;
        if (discountEl) discountEl.textContent = '- RM ' + discountAmt.toFixed(2);
    }
    
    if (total) total.textContent = finalTotal.toFixed(2); 
    if (all) all.checked = (n === checks.length && n > 0);
}

checks.forEach(check=>check.addEventListener('change',refreshCart)); 
document.querySelectorAll('.qty-input').forEach(input=>input.addEventListener('input',refreshCart)); 
if(all) all.addEventListener('change',()=>{checks.forEach(c=>c.checked=all.checked); refreshCart();}); 
refreshCart();
</script>

<?php include __DIR__ . '/../footer.php'; ?>