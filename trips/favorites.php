<?php

require_once __DIR__ . '/../includes/trip_service.php';

$userId = tp_require_user();
global $auth_db;

$favoriteTypes = [
    'flight' => ['label' => 'Flights', 'icon' => 'plane'],
    'hotel' => ['label' => 'Hotels', 'icon' => 'hotel'],
    'restaurant' => ['label' => 'Restaurants', 'icon' => 'utensils'],
    'attraction' => ['label' => 'Attractions', 'icon' => 'ticket'],
];
$favorites = tp_get_favorites($userId);
$selectedDate = (string) ($_GET['date'] ?? date('Y-m-d'));
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $selectedDate)) $selectedDate = date('Y-m-d');
$grouped = array_fill_keys(array_keys($favoriteTypes), []);

foreach ($favorites as $favorite) {
    $type = (string) ($favorite['item_type'] ?? '');

    if (isset($grouped[$type])) {
        $grouped[$type][] = $favorite;
    }
}

$stmt = $auth_db->prepare(
    'SELECT item_type, item_key, title, unit_price, quantity, start_hour, end_hour '
    . 'FROM trip_timetable_items WHERE user_id = ? AND schedule_date = ? ORDER BY start_hour, id'
);
$stmt->bind_param('is', $userId, $selectedDate);
$stmt->execute();
$scheduled = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

include __DIR__ . '/../header.php';
?>

<link rel="stylesheet" href="/TravelPal/css/modules/favorites.css?v=3">
<link rel="stylesheet" href="/TravelPal/css/modules/favorites-overrides.css?v=1">
<link rel="stylesheet" href="/TravelPal/css/modules/attraction-favorites.css?v=1">

<section class="favorites-page">
    <div class="favorites-shell">
        <header class="favorites-heading">
            <div>
                <span>TRIP PLANNER</span>
                <h1>Favorites &amp; timetable</h1>
                <p>
                    Plan each day separately. Drag a saved favorite into an hour,
                    then click its block to adjust or remove it.
                </p>
            </div>

            <a href="/TravelPal/trips/index.php">
                My Trips <i class="fa-solid fa-arrow-right"></i>
            </a>
        </header>

        <div class="planner-layout">
            <section class="timeline-card" id="printArea">
                <div class="timeline-card-head">
                    <div>
                        <span>Your day</span>
                        <h2>Trip timetable</h2>
                    </div>

                    <button class="clear-timetable no-print" id="clearTimetable">
                        Clear
                    </button>
                </div>

                <div class="timetable-date-bar no-print">
                    <span>Your trip dates</span>
                    <div class="schedule-date-tabs" id="scheduleDateTabs"></div>
                    <button type="button" class="change-date" id="changeDate">Change dates</button>
                    <input type="hidden" id="scheduleDate" value="<?= tp_h($selectedDate) ?>">
                </div>

                <div class="timeline">
                    <div class="timeline-hours">
                        <?php for ($hour = 0; $hour < 24; $hour++): ?>
                            <div class="timeline-row" data-hour="<?= $hour ?>">
                                <time><?= sprintf('%02d:00', $hour) ?></time>
                                <div class="timeline-drop" data-hour="<?= $hour ?>"></div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>

                <div class="timeline-bottom">
                    <div>
                        <span>ESTIMATED TOTAL</span>
                        <strong id="estimateRange">RM 0 – 0</strong>
                        <small>Based on favorites, passengers, tickets and nights.</small>
                    </div>

                    <button class="print-timetable no-print" id="printTimetable" type="button">
                        <i class="fa-solid fa-print"></i> Print timetable
                    </button>
                </div>
            </section>

            <aside class="favorite-list">
                <div class="favorite-list-head">
                    <span>SAVED ITEMS</span>
                    <h2>Drag into your day</h2>
                </div>

                <?php foreach ($favoriteTypes as $type => $config): ?>
                    <section class="favorite-category">
                        <h3>
                            <i class="fa-solid fa-<?= tp_h($config['icon']) ?>"></i>
                            <?= tp_h($config['label']) ?>
                        </h3>

                        <?php if ($grouped[$type] === []): ?>
                            <p class="no-favorites">
                                No saved <?= strtolower(tp_h($config['label'])) ?> yet.
                            </p>
                        <?php else: ?>
                            <?php foreach ($grouped[$type] as $item): ?>
                                <?php
                                $metadata = $item['metadata'] ?? [];
                                $quantity = max(1, (int) (
                                    $metadata['tickets']
                                    ?? $metadata['guests']
                                    ?? $metadata['nights']
                                    ?? 1
                                ));
                                $unitPrice = (float) $item['unit_price'];
                                if ($type === 'restaurant') {
                                    if (!empty($metadata['average_spend'])) {
                                        $unitPrice = (float) $metadata['average_spend'];
                                    } elseif ($unitPrice > 0 && $quantity > 1) {
                                        $unitPrice /= $quantity;
                                    } elseif ($unitPrice <= 0) {
                                        $unitPrice = 48;
                                    }
                                }
                                $durationHours = max(1, min(24, (int) (
                                    $metadata['duration_hours'] ?? 0
                                )));
                                $favoritePayload = json_encode([
                                    'item_type' => $item['item_type'],
                                    'item_key' => $item['item_key'],
                                    'title' => $item['title'],
                                    'unit_price' => $unitPrice,
                                    'quantity' => $quantity,
                                    'duration_hours' => $durationHours,
                                ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?: '{}';
                                $detailUrl = match ($type) {
                                    'hotel' => preg_match('/^hotel-([^\-]+)/', (string) $item['item_key'], $matches) ? '/TravelPal/hotels/detail.php?id=' . rawurlencode($matches[1]) : '/TravelPal/hotels/index.php',
                                    'restaurant' => preg_match('/^restaurant-(\d+)/', (string) $item['item_key'], $matches) ? '/TravelPal/restaurant/detail.php?id=' . rawurlencode($matches[1]) : '/TravelPal/restaurant/all.php',
                                    'flight' => preg_match('/^flight-([^-]+)/', (string) $item['item_key'], $matches) ? '/TravelPal/flights/detail.php?id=' . rawurlencode($matches[1]) : '/TravelPal/flights/index.php',
                                    default => (string) ($metadata['detail_url'] ?? '/TravelPal/attractions/index.php'),
                                };
                                ?>

                                <article
                                    class="favorite-item"
                                    draggable="true"
                                    data-favorite="<?= tp_h($favoritePayload) ?>"
                                    data-detail-url="<?= tp_h($detailUrl) ?>"
                                >
                                    <div class="favorite-icon <?= tp_h($type) ?>">
                                        <i class="fa-solid fa-<?= tp_h($config['icon']) ?>"></i>
                                    </div>

                                    <div>
                                        <strong><?= tp_h($item['title']) ?></strong>
                                        <small><?= tp_h($item['subtitle']) ?></small>
                                        <?php if ($type === 'restaurant'): ?>
                                            <em>Avg. RM <?= number_format($unitPrice, 2) ?> / person</em>
                                            <small>Est. RM <?= number_format($unitPrice * $quantity, 2) ?> for <?= $quantity ?> <?= $quantity === 1 ? 'diner' : 'diners' ?></small>
                                        <?php else: ?>
                                            <em>
                                                RM <?= number_format($unitPrice, 2) ?>
                                                <?php if ($type === 'attraction'): ?> / ticket<?php endif; ?>
                                            </em>
                                        <?php endif; ?>
                                    </div>

                                    <button type="button" class="favorite-remove" aria-label="Remove <?= tp_h($item['title']) ?> from favorites"><i class="fa-solid fa-trash"></i></button>
                                </article>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </section>
                <?php endforeach; ?>
            </aside>
        </div>
    </div>
</section>

<div class="planner-modal" id="dateModal" aria-hidden="true">
    <div class="planner-modal-card" role="dialog" aria-modal="true" aria-labelledby="dateModalTitle">
        <h2 id="dateModalTitle">Choose your trip dates</h2>
        <p>Choose the start and end date. A separate timetable will be kept for every day in this range.</p>
        <label>Start date <input type="date" id="modalStartDate" value="<?= tp_h($selectedDate) ?>"></label>
        <label>End date <input type="date" id="modalEndDate" value="<?= tp_h($selectedDate) ?>"></label>
        <div class="planner-modal-actions"><button type="button" class="modal-cancel" id="dateModalCancel">Cancel</button><button type="button" class="modal-confirm" id="dateModalConfirm">Create trip days</button></div>
    </div>
</div>

<div class="planner-modal" id="printModal" aria-hidden="true">
    <div class="planner-modal-card" role="dialog" aria-modal="true" aria-labelledby="printModalTitle">
        <h2 id="printModalTitle">Print a timetable</h2>
        <p>Only dates with saved timetable items are listed.</p>
        <select id="printScheduleDate"></select>
        <div class="planner-modal-actions"><button type="button" class="modal-cancel" id="printModalCancel">Cancel</button><button type="button" class="modal-confirm" id="printModalConfirm">Print</button></div>
    </div>
</div>

<script>
const savedSchedule = <?= json_encode(
    $scheduled,
    JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT
) ?>;
const blocks = [];
const timeline = document.querySelector('.timeline-hours');
const estimate = document.getElementById('estimateRange');
const scheduleDateInput = document.getElementById('scheduleDate');
const dateModal = document.getElementById('dateModal');
const printModal = document.getElementById('printModal');
let dragging = null;
let timetableBlockDragging = null;

function timeLabel(hour) {
    return String(hour).padStart(2, '0') + ':00';
}

function defaultLength(item) {
    if (Number(item.duration_hours) > 0) {
        return Math.min(24, Number(item.duration_hours));
    }

    if (item.item_type === 'flight') {
        return 8;
    }

    if (item.item_type === 'hotel') {
        return 4;
    }

    return item.item_type === 'attraction' ? 2 : 1;
}

function draw() {
    timeline.querySelectorAll('.scheduled-block').forEach(node => node.remove());

    blocks.forEach(function (item, index) {
        const slot = timeline.querySelector(
            `.timeline-drop[data-hour="${item.start_hour}"]`
        );

        if (!slot) {
            return;
        }

        const block = document.createElement('button');
        block.type = 'button';
        block.className = 'scheduled-block ' + item.item_type;
        block.style.height = `calc(${Math.max(1, item.end_hour - item.start_hour) * 52}px - 6px)`;
        block.innerHTML = `<strong>${escapeHtml(item.title)}</strong><span>${timeLabel(item.start_hour)} – ${timeLabel(item.end_hour)}</span>`;
        block.title = 'Click to set the end hour or remove this item';
        block.draggable = true;
        block.addEventListener('dragstart', function (event) { timetableBlockDragging = index; event.dataTransfer.effectAllowed = 'move'; });
        block.addEventListener('dragend', function () { timetableBlockDragging = null; });
        block.addEventListener('click', function () {
            const answer = prompt(
                `Finish time for ${item.title} (between ${item.start_hour + 1} and 24). Leave blank to remove.`,
                item.end_hour
            );

            if (answer === null) {
                return;
            }

            if (answer.trim() === '') {
                blocks.splice(index, 1);
            } else {
                item.end_hour = Math.max(
                    item.start_hour + 1,
                    Math.min(24, Number(answer) || item.end_hour)
                );
            }

            draw();
            save();
        });
        slot.appendChild(block);
    });

    const total = blocks.reduce(function (sum, item) {
        return sum + (Number(item.unit_price) || 0) * (Number(item.quantity) || 1);
    }, 0);
    estimate.textContent = `RM ${Math.round(total * 0.9).toLocaleString()} – ${Math.ceil(total * 1.1).toLocaleString()}`;
}

function escapeHtml(value) {
    const holder = document.createElement('div');
    holder.textContent = String(value || '');
    return holder.innerHTML;
}

function save() {
    fetch('/TravelPal/trips/timetable_action.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({action: 'save', schedule_date: scheduleDateInput.value, items: blocks})
    }).catch(function () {
        window.alert('The timetable could not be saved right now.');
    });
}

async function loadSchedule(dateValue) {
    if (!dateValue) return;
    const response = await fetch('/TravelPal/trips/timetable_action.php', {method: 'POST', headers: {'Content-Type': 'application/json'}, body: JSON.stringify({action: 'list', schedule_date: dateValue})});
    const result = await response.json();
    if (!response.ok || !result.ok) throw new Error('Unable to load this timetable.');
    blocks.splice(0, blocks.length, ...result.items.map(item => ({...item, start_hour: Number(item.start_hour), end_hour: Number(item.end_hour), unit_price: Number(item.unit_price), quantity: Number(item.quantity)})));
    scheduleDateInput.value = dateValue;
    renderDateTabs();
    draw();
}
let tripRange = {start_date: scheduleDateInput.value, end_date: scheduleDateInput.value};
function datesInRange() {
    const dates = [], cursor = new Date(tripRange.start_date + 'T00:00:00'), last = new Date(tripRange.end_date + 'T00:00:00');
    while (cursor <= last) { dates.push(cursor.toISOString().slice(0, 10)); cursor.setDate(cursor.getDate() + 1); }
    return dates;
}
function renderDateTabs() {
    document.getElementById('scheduleDateTabs').innerHTML = datesInRange().map(date => `<button type="button" class="schedule-date-tab${date === scheduleDateInput.value ? ' active' : ''}" data-date="${date}">${new Intl.DateTimeFormat('en-MY', {day:'numeric', month:'short'}).format(new Date(date + 'T00:00:00'))}</button>`).join('');
    document.querySelectorAll('.schedule-date-tab').forEach(button => button.addEventListener('click', () => loadSchedule(button.dataset.date).catch(error => window.alert(error.message))));
}
async function loadRange() {
    const response = await fetch('/TravelPal/trips/timetable_action.php', {method:'POST', headers:{'Content-Type':'application/json'}, body:JSON.stringify({action:'range'})});
    const result = await response.json(); tripRange = result.range; document.getElementById('modalStartDate').value = tripRange.start_date; document.getElementById('modalEndDate').value = tripRange.end_date;
    if (result.has_range && !datesInRange().includes(scheduleDateInput.value)) await loadSchedule(tripRange.start_date); else renderDateTabs();
    if (!result.has_range) showModal(dateModal);
}
async function saveRange() {
    const start = document.getElementById('modalStartDate').value, end = document.getElementById('modalEndDate').value;
    const response = await fetch('/TravelPal/trips/timetable_action.php', {method:'POST', headers:{'Content-Type':'application/json'}, body:JSON.stringify({action:'range', method:'save', start_date:start, end_date:end})});
    const result = await response.json(); if (!response.ok || !result.ok) throw new Error('Choose a valid date range of up to 32 days.');
    tripRange = result; await loadSchedule(start);
}
function showModal(modal) { modal.classList.add('is-visible'); modal.setAttribute('aria-hidden', 'false'); }
function hideModal(modal) { modal.classList.remove('is-visible'); modal.setAttribute('aria-hidden', 'true'); }

savedSchedule.forEach(function (item) {
    blocks.push({
        ...item,
        start_hour: Number(item.start_hour),
        end_hour: Number(item.end_hour),
        unit_price: Number(item.unit_price),
        quantity: Number(item.quantity)
    });
});

document.querySelectorAll('.favorite-item').forEach(function (item) {
    item.addEventListener('dragstart', function () {
        dragging = JSON.parse(item.dataset.favorite);
        item.classList.add('is-dragging');
    });
    item.addEventListener('dragend', function () {
        item.classList.remove('is-dragging');
    });
    item.addEventListener('click', function (event) {
        if (!event.target.closest('.favorite-remove') && !item.classList.contains('is-dragging')) window.location.href = item.dataset.detailUrl;
    });
});

document.querySelectorAll('.favorite-remove').forEach(function (button) {
    button.addEventListener('click', async function (event) {
        event.preventDefault(); event.stopPropagation();
        const item = button.closest('.favorite-item'); const favorite = JSON.parse(item.dataset.favorite);
        if (!confirm('Remove this item from Favorites?')) return;
        const response = await fetch('/TravelPal/trips/favorites_action.php', {method:'POST', headers:{'Content-Type':'application/json'}, body:JSON.stringify({action:'remove', item_type:favorite.item_type, item_key:favorite.item_key})});
        const result = await response.json(); if (response.ok && result.ok) item.remove(); else window.alert('This favorite could not be removed.');
    });
});

document.querySelectorAll('.timeline-drop').forEach(function (drop) {
    drop.addEventListener('dragover', function (event) {
        event.preventDefault();
        drop.classList.add('drag-over');
    });
    drop.addEventListener('dragleave', function () {
        drop.classList.remove('drag-over');
    });
    drop.addEventListener('drop', function (event) {
        event.preventDefault();
        drop.classList.remove('drag-over');

        if (!dragging) {
            return;
        }

        const start = Number(drop.dataset.hour);
        blocks.push({
            ...dragging,
            start_hour: start,
            end_hour: Math.min(24, start + defaultLength(dragging))
        });
        dragging = null;
        draw();
        save();
    });
});

document.getElementById('clearTimetable').addEventListener('click', function () {
    if (confirm('Clear your saved timetable?')) {
        blocks.splice(0);
        draw();
        save();
    }
});

document.getElementById('changeDate').addEventListener('click', () => showModal(dateModal));
document.getElementById('dateModalCancel').addEventListener('click', () => hideModal(dateModal));
document.getElementById('dateModalConfirm').addEventListener('click', () => { saveRange().then(() => hideModal(dateModal)).catch(error => window.alert(error.message)); });
dateModal.addEventListener('click', event => { if (event.target === dateModal) hideModal(dateModal); });

document.getElementById('printTimetable').addEventListener('click', async function () {
    const response = await fetch('/TravelPal/trips/timetable_action.php', {method: 'POST', headers: {'Content-Type': 'application/json'}, body: JSON.stringify({action: 'dates'})});
    const result = await response.json(); const select = document.getElementById('printScheduleDate');
    select.innerHTML = (result.dates || []).map(row => `<option value="${row.schedule_date}">${row.schedule_date} (${row.item_count} item${Number(row.item_count) === 1 ? '' : 's'})</option>`).join('');
    if (!select.options.length) { window.alert('There is no saved timetable to print yet.'); return; }
    select.value = scheduleDateInput.value; showModal(printModal);
});
document.getElementById('printModalCancel').addEventListener('click', () => hideModal(printModal));
document.getElementById('printModalConfirm').addEventListener('click', () => loadSchedule(document.getElementById('printScheduleDate').value).then(() => { hideModal(printModal); window.print(); }));

draw();
loadRange().catch(() => showModal(dateModal));
</script>

<?php include __DIR__ . '/../footer.php'; ?>
