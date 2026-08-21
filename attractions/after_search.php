<?php 
include '../header.php'; 

// 引入我们刚才创建的 API 文件
require_once 'api_functions.php';

// 获取前端表单传过来的数据 (默认为 Selangor)
$destination = isset($_GET['query']) ? $_GET['query'] : 'Selangor';
$visit_date = isset($_GET['visit_date']) ? $_GET['visit_date'] : date('Y-m-d');
$adults = isset($_GET['adults']) ? $_GET['adults'] : 2;
$children = isset($_GET['children']) ? $_GET['children'] : 0;

// 调用 API 获取数据
$api_results = searchAttractionsByLocation($destination);
?>

<!-- 复用你首页统一的高级紫绿配色 CSS -->
<link rel="stylesheet" href="../css/modules/attractions.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- 顶部简易版 Hero Section -->
<section class="hero-section" style="padding: 40px 0;">
    <div class="hero-content">
        <h1>Attractions in <?php echo htmlspecialchars($destination); ?></h1>
        <p>Showing live availability for <?php echo htmlspecialchars($visit_date); ?> 
           (<?php echo $adults; ?> Adults, <?php echo $children; ?> Children)</p>
    </div>
</section>

<main class="main-content">
    <div class="section-header">
        <h2>Top Experiences</h2>
        <!-- 实时 API 状态徽章 -->
        <span style="display: inline-block; background: #e0f2fe; color: #0284c7; padding: 4px 10px; border-radius: 4px; font-size: 12px; font-weight: 700; margin-top: 10px;">
            <i class="fa-solid fa-bolt"></i> Live API Results
        </span>
    </div>

    <?php
    // 检查 API 是否报错
    if (isset($api_results['error'])) {
        echo "<div style='padding: 20px; background: #fee2e2; color: #b91c1c; border-radius: 8px;'>API Error: " . htmlspecialchars($api_results['message']) . "</div>";
        echo "</main>";
        include '../footer.php';
        exit;
    }

    // 检查是否包含 products (通常 Booking attraction API 返回的数据在 products 数组中)
    if (!isset($api_results['data']['products']) || count($api_results['data']['products']) === 0) {
        echo "<div style='padding: 40px; text-align: center; color: #6b7280; background: #fff; border-radius: 12px; border: 1px solid #e5e7eb;'>";
        echo "<i class='fa-solid fa-map-location-dot' style='font-size: 40px; margin-bottom: 15px; color: #9ca3af;'></i>";
        echo "<h3>No attractions found for {$destination} right now.</h3>";
        echo "<p>Please try searching another destination.</p>";
        echo "</div>";
    } else {
        // 如果有数据，渲染网格卡片
        echo '<div class="attraction-grid">';
        
        foreach ($api_results['data']['products'] as $product) {
            // 解析 API 返回的字段 (这里根据 Booking API 的常见结构配置 fallback 防止报错)
            $title = $product['title'] ?? 'Unknown Attraction';
            $slug = $product['slug'] ?? ''; // 用于跳转详情页的唯一ID
            $img_url = $product['primaryPhoto']['small'] ?? 'https://via.placeholder.com/600x400?text=No+Image';
            $rating = $product['reviewsStats']['combinedNumericStats']['average'] ?? 'N/A';
            $review_count = $product['reviewsStats']['allReviewsCount'] ?? 0;
            
            // 价格解析
            $price_value = $product['representativePrice']['chargeAmount'] ?? null;
            $price_currency = $product['representativePrice']['currency'] ?? 'MYR';
            $price_display = $price_value ? "{$price_currency} {$price_value}" : "Check Price";

            // 输出卡片 HTML (完全套用 attractions.css 的样式)
            echo "
            <div class='property-card' onclick=\"window.location.href='detail.php?slug={$slug}'\">
                <div class='card-img-wrapper'>
                    <img src='{$img_url}' alt='{$title}'>
                    <button class='heart-btn' data-id='{$slug}' onclick='event.stopPropagation(); toggleHeart(this);'>
                        <i class='fa-regular fa-heart'></i>
                    </button>
                </div>
                <div class='card-content'>
                    <h3 style='white-space: nowrap; overflow: hidden; text-overflow: ellipsis;' title='{$title}'>{$title}</h3>
                    <p class='location'><i class='fa-solid fa-location-dot'></i> {$destination}</p>
                    <div class='card-footer'>
                        <span class='rating'><i class='fa-solid fa-star'></i> {$rating} ({$review_count})</span>
                        <span class='price'>{$price_display}</span>
                    </div>
                </div>
            </div>
            ";
        }
        
        echo '</div>'; // 关闭 attraction-grid
    }
    ?>
</main>

<?php include '../footer.php'; ?>

<!-- 加入你首页写的 localStorage 爱心收藏交互逻辑 -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let savedItems = JSON.parse(localStorage.getItem('travelPal_attractions')) || [];
        document.querySelectorAll('.heart-btn').forEach(btn => {
            let id = btn.getAttribute('data-id');
            if (savedItems.includes(id)) {
                let icon = btn.querySelector('i');
                icon.classList.remove('fa-regular');
                icon.classList.add('fa-solid');
                icon.style.color = '#7c3aed'; // 改为紫色的爱心收藏状态
            }
        });
    });

    function toggleHeart(btn) {
        const icon = btn.querySelector('i');
        const itemId = btn.getAttribute('data-id');
        let savedItems = JSON.parse(localStorage.getItem('travelPal_attractions')) || [];

        if(icon.classList.contains('fa-regular')) {
            icon.classList.remove('fa-regular');
            icon.classList.add('fa-solid');
            icon.style.color = '#7c3aed'; 
            if (!savedItems.includes(itemId)) savedItems.push(itemId);
        } else {
            icon.classList.remove('fa-solid');
            icon.classList.add('fa-regular');
            icon.style.color = '#68788c'; 
            savedItems = savedItems.filter(id => id !== itemId);
        }
        localStorage.setItem('travelPal_attractions', JSON.stringify(savedItems));
    }
</script>