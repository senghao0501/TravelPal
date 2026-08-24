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
$grouped = array_fill_keys(array_keys($favoriteTypes), []);

foreach ($favorites as $favorite) {
    $type = (string) ($favorite['item_type'] ?? '');

    if (isset($grouped[$type])) {
        $grouped[$type][] = $favorite;
    }
}

$stmt = $auth_db->prepare(
    'SELECT item_type, item_key, title, unit_price, quantity, start_hour, end_hour '
    . 'FROM trip_timetable_items WHERE user_id = ? ORDER BY start_hour, id'
);
$stmt->bind_param('i', $userId);
$stmt->execute();
$scheduled = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

include __DIR__ . '/../header.php';
?>

<link rel="stylesheet" href="/TravelPal/css/modules/favorites.css?v=2">
<link rel="stylesheet" href="/TravelPal/css/modules/attraction-favorites.css?v=1">

<section class="favorites-page">
    <div class="favorites-shell">
        <header class="favorites-heading">
            <div>
                <span>TRIP PLANNER</span>
                <h1>Favorites &amp; timetable</h1>
                <p>
                    Drag a saved favorite into the hour you want to be there.
                    Click a scheduled block to change its finish time.
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

                    <button class="print-timetable no-print" onclick="window.print()">
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
                                $durationHours = max(1, min(24, (int) (
                                    $metadata['duration_hours'] ?? 0
                                )));
                                $favoritePayload = json_encode([
                                    'item_type' => $item['item_type'],
                                    'item_key' => $item['item_key'],
                                    'title' => $item['title'],
                                    'unit_price' => (float) $item['unit_price'],
                                    'quantity' => $quantity,
                                    'duration_hours' => $durationHours,
                                ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?: '{}';
                                ?>

                                <article
                                    class="favorite-item"
                                    draggable="true"
                                    data-favorite="<?= tp_h($favoritePayload) ?>"
                                >
                                    <div class="favorite-icon <?= tp_h($type) ?>">
                                        <i class="fa-solid fa-<?= tp_h($config['icon']) ?>"></i>
                                    </div>

                                    <div>
                                        <strong><?= tp_h($item['title']) ?></strong>
                                        <small><?= tp_h($item['subtitle']) ?></small>
                                        <em>
                                            RM <?= number_format((float) $item['unit_price'], 2) ?>
                                            <?php if ($type === 'restaurant'): ?> est.<?php endif; ?>
                                            <?php if ($type === 'attraction'): ?> / ticket<?php endif; ?>
                                        </em>
                                    </div>

                                    <i class="fa-solid fa-grip-lines drag-mark"></i>
                                </article>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </section>
                <?php endforeach; ?>
            </aside>
        </div>
    </div>
</section>

<script>
const savedSchedule = <?= json_encode(
    $scheduled,
    JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT
) ?>;
const blocks = [];
const timeline = document.querySelector('.timeline-hours');
const estimate = document.getElementById('estimateRange');
let dragging = null;

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
        body: JSON.stringify({action: 'save', items: blocks})
    }).catch(function () {
        window.alert('The timetable could not be saved right now.');
    });
}

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

draw();
</script>

<?php include __DIR__ . '/../footer.php'; ?>
