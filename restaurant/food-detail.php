<?php
require_once __DIR__ . '/food_data.php';

function detail_escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function detail_build_reviews(array $food): array
{
    $names = ['Aina R.', 'Daniel L.', 'Mei Y.', 'Hafiz M.', 'Samantha K.', 'Arun P.', 'Nurul S.', 'Jason T.', 'Farah A.', 'Wei Jian C.', 'Izzati N.', 'Marcus G.'];
    $dates = ['6 days ago', '2 weeks ago', '3 weeks ago', '1 month ago', '6 weeks ago', '2 months ago', '3 months ago'];
    $notes = $food['review_notes'];
    $offset = ((int)$food['id']) % count($names);
    $ratings = [5, 4, 5, 5, 4, 5, 4];
    $texts = [
        'Tried ' . $food['name'] . ' on our first morning in ' . $food['city'] . '. The ' . $notes['flavour'] . ' made it feel very different from the versions I have had elsewhere.',
        'What stayed with me was the contrast between ' . $notes['texture'] . '. It looked simple at first, but every bite had something going on.',
        'The ' . $food['price'] . ' estimate was accurate for the stall we visited. It was filling without feeling too heavy, and I would happily order it again.',
        'I was unsure whether this would suit me, but the ' . $notes['flavour'] . ' won me over. My friend preferred it milder, so sharing first was a good idea.',
        'A useful tip from the person serving us: ' . $notes['tip'] . '. That small step made the whole dish taste more balanced.',
        'We stopped for this around ' . strtolower($food['best_time']) . ' and did not have to wait long. The portion was comfortable for one person and the food arrived fresh.',
        'This tasted like a dish connected to ' . $food['city'] . ', not just something prepared for tourists. I would come back for the ' . $notes['texture'] . ' alone.',
    ];

    $reviews = [];
    foreach ($texts as $index => $text) {
        $reviews[] = [
            'name' => $names[($offset + $index) % count($names)],
            'rating' => $ratings[$index],
            'date' => $dates[$index],
            'text' => $text,
        ];
    }

    return $reviews;
}

$foodId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$food = null;

foreach ($foodOptions as $option) {
    if ((int)$option['id'] === (int)$foodId) {
        $food = $option;
        break;
    }
}

if (!$food) {
    http_response_code(404);
}

include __DIR__ . '/../header.php';
?>

<link rel="stylesheet" href="/TravelPal/restaurant/restaurant_detail.css?v=4">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<?php if (!$food): ?>
    <section class="food-detail-error">
        <i class="fa-solid fa-bowl-food"></i>
        <h1>Food option not found</h1>
        <p>The selected food may no longer be available in this guide.</p>
        <a href="food-guide.php"><i class="fa-solid fa-arrow-left"></i> Back to Food Guide</a>
    </section>
<?php else: ?>
    <?php
    $area = $foodAreas[$food['city']] ?? [
        'name' => $food['city'] . ' Local Food Area',
        'address' => $food['city'] . ', ' . $food['state'] . ', Malaysia',
        'images' => [$food['image'], $food['image']],
        'photo_labels' => [$food['city'] . ' food area', $food['state'] . ' local area'],
    ];
    $mapUrl = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($area['address']);
    $galleryImages = [
        $food['image'],
        $area['images'][0],
        $area['images'][1],
    ];
    $comments = detail_build_reviews($food);
    ?>

    <div class="food-detail-page">
        <div class="food-detail-shell">
            <a class="food-detail-back" href="food-guide.php">
                <i class="fa-solid fa-arrow-left"></i> Back to Food Guide
            </a>

            <header class="food-detail-heading">
                <div>
                    <div class="food-detail-tags">
                        <span><?php echo detail_escape($food['category']); ?></span>
                        <span><?php echo detail_escape($food['city']); ?>, <?php echo detail_escape($food['state']); ?></span>
                    </div>
                    <h1><?php echo detail_escape($food['name']); ?></h1>
                    <p><i class="fa-solid fa-location-dot"></i> <?php echo detail_escape($area['name']); ?></p>
                </div>
            </header>

            <section class="food-detail-gallery" aria-label="Food and place photos">
                <img class="food-detail-gallery__main" src="<?php echo detail_escape($galleryImages[0]); ?>" alt="<?php echo detail_escape($food['name']); ?>">
                <img src="<?php echo detail_escape($galleryImages[1]); ?>" alt="<?php echo detail_escape($area['photo_labels'][0]); ?>">
                <img src="<?php echo detail_escape($galleryImages[2]); ?>" alt="<?php echo detail_escape($area['photo_labels'][1]); ?>">
            </section>

            <div class="food-detail-layout">
                <div class="food-detail-main">
                    <section class="food-detail-card">
                        <span class="food-detail-eyebrow">About this food</span>
                        <h2>A local flavour to try</h2>
                        <p><?php echo detail_escape($food['description']); ?></p>

                        <div class="food-detail-facts">
                            <div>
                                <i class="fa-solid fa-wallet"></i>
                                <span>Estimated price</span>
                                <strong><?php echo detail_escape($food['price']); ?></strong>
                            </div>
                            <div>
                                <i class="fa-regular fa-clock"></i>
                                <span>Best time</span>
                                <strong><?php echo detail_escape($food['best_time']); ?></strong>
                            </div>
                            <div>
                                <i class="fa-solid fa-utensils"></i>
                                <span>Category</span>
                                <strong><?php echo detail_escape($food['category']); ?></strong>
                            </div>
                        </div>
                    </section>

                    <section class="food-detail-card">
                        <div class="food-comments-heading">
                            <div>
                                <span class="food-detail-eyebrow">Community notes</span>
                                <h2>Traveler comments</h2>
                            </div>
                            <span class="sample-comment-label">7 reviews</span>
                        </div>

                        <div class="food-comment-list">
                            <?php foreach ($comments as $commentIndex => $comment): ?>
                                <article class="food-comment<?php echo $commentIndex >= 3 ? ' food-comment--extra' : ''; ?>">
                                    <div class="food-comment__avatar"><?php echo detail_escape(substr($comment['name'], 0, 1)); ?></div>
                                    <div class="food-comment__body">
                                        <div class="food-comment__meta">
                                            <div>
                                                <strong><?php echo detail_escape($comment['name']); ?></strong>
                                                <span><?php echo detail_escape($comment['date']); ?></span>
                                            </div>
                                            <div class="food-comment__stars" aria-label="<?php echo (int)$comment['rating']; ?> out of 5 stars">
                                                <?php for ($star = 1; $star <= 5; $star++): ?>
                                                    <i class="<?php echo $star <= $comment['rating'] ? 'fa-solid' : 'fa-regular'; ?> fa-star"></i>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                        <p><?php echo detail_escape($comment['text']); ?></p>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>

                        <button type="button" id="toggleReviewsButton" class="food-reviews-toggle" aria-expanded="false">
                            Show all 7 reviews <i class="fa-solid fa-chevron-down"></i>
                        </button>
                    </section>
                </div>

                <aside class="food-detail-sidebar">
                    <section class="food-location-card">
                        <div class="food-location-card__icon"><i class="fa-solid fa-map-location-dot"></i></div>
                        <span class="food-detail-eyebrow">Where to explore</span>
                        <h2><?php echo detail_escape($area['name']); ?></h2>
                        <p><?php echo detail_escape($area['address']); ?></p>
                        <a href="<?php echo detail_escape($mapUrl); ?>" target="_blank" rel="noopener noreferrer">
                            Open in Maps <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                    </section>

                    <section class="food-trip-note">
                        <i class="fa-solid fa-heart"></i>
                        <div>
                            <strong>Save the restaurant instead</strong>
                            <p>The Food Guide is for planning ideas. Add the restaurant itself to your shared favorites from the live restaurant pages.</p>
                        </div>
                    </section>
                </aside>
            </div>
        </div>
    </div>

    <script src="/TravelPal/restaurant/restaurant_app.js?v=2"></script>
    <script>
    const toggleReviewsButton = document.getElementById('toggleReviewsButton');

    toggleReviewsButton.addEventListener('click', () => {
        const isExpanded = document.body.classList.toggle('food-reviews-expanded');
        toggleReviewsButton.setAttribute('aria-expanded', String(isExpanded));
        toggleReviewsButton.innerHTML = isExpanded
            ? 'Show fewer reviews <i class="fa-solid fa-chevron-up"></i>'
            : 'Show all 7 reviews <i class="fa-solid fa-chevron-down"></i>';
    });

    </script>
<?php endif; ?>

<?php include __DIR__ . '/../footer.php'; ?>
