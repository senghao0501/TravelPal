<?php include '../header.php'; ?>

<!-- 引入酒店模块专属 CSS -->
<link rel="stylesheet" href="/TravelPal/css/modules/hotels.css">

<div class="hotels-container">
    <!-- 1. 页面标题 -->
    <div class="hotel-header">
        <h1>Find Your Ideal Hotel</h1>
        <p style="color: #64748b; margin-top: 0.4rem;">Discover best stays across Malaysia, Vietnam, Thailand, and Indonesia.</p>
    </div>

    <!-- 2. 筛选/搜索工具栏 -->
    <form class="hotel-filter-bar" action="index.php" method="GET">
        <div class="filter-group">
            <label for="destination">Destination / Hotel Name</label>
            <input type="text" id="destination" name="search" placeholder="e.g. Kuala Lumpur, Bali..." value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
        </div>
        
        <div class="filter-group">
            <label for="country">Country</label>
            <select id="country" name="country">
                <option value="">All Countries</option>
                <option value="Malaysia" <?php echo (($_GET['country'] ?? '') === 'Malaysia') ? 'selected' : ''; ?>>Malaysia 🇲🇾</option>
                <option value="Vietnam" <?php echo (($_GET['country'] ?? '') === 'Vietnam') ? 'selected' : ''; ?>>Vietnam 🇻🇳</option>
                <option value="Thailand" <?php echo (($_GET['country'] ?? '') === 'Thailand') ? 'selected' : ''; ?>>Thailand 🇹🇭</option>
                <option value="Indonesia" <?php echo (($_GET['country'] ?? '') === 'Indonesia') ? 'selected' : ''; ?>>Indonesia 🇮🇩</option>
            </select>
        </div>

        <div class="filter-group">
            <label for="price">Max Price per night</label>
            <select id="price" name="max_price">
                <option value="">Any Price</option>
                <option value="100">Under $100</option>
                <option value="200">Under $200</option>
                <option value="300">Under $300</option>
            </select>
        </div>

        <button type="submit" class="btn-filter">Search Hotels</button>
    </form>

    <!-- 3. 酒店列表网格展示 -->
    <div class="hotel-grid">
        <!-- 示例酒店卡片 1 -->
        <a href="details.php?id=1" class="hotel-card">
            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=600&q=80" alt="Grand Hyatt Kuala Lumpur" class="hotel-card-img">
            <div class="hotel-card-body">
                <h3 class="hotel-card-title">Grand Hyatt Kuala Lumpur</h3>
                <p class="hotel-card-location">📍 Kuala Lumpur, Malaysia</p>
                <div class="hotel-card-footer">
                    <span class="rating-badge">★ 4.8</span>
                    <div>
                        <span class="price-tag">$180</span>
                        <span class="price-unit">/ night</span>
                    </div>
                </div>
            </div>
        </a>

        <!-- 示例酒店卡片 2 -->
        <a href="details.php?id=2" class="hotel-card">
            <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=600&q=80" alt="Ayana Resort Bali" class="hotel-card-img">
            <div class="hotel-card-body">
                <h3 class="hotel-card-title">Ayana Resort & Spa</h3>
                <p class="hotel-card-location">📍 Bali, Indonesia</p>
                <div class="hotel-card-footer">
                    <span class="rating-badge">★ 4.9</span>
                    <div>
                        <span class="price-tag">$240</span>
                        <span class="price-unit">/ night</span>
                    </div>
                </div>
            </div>
        </a>

        <!-- 示例酒店卡片 3 -->
        <a href="details.php?id=3" class="hotel-card">
            <img src="https://images.unsplash.com/photo-1508009603885-50cf7c579365?auto=format&fit=crop&w=600&q=80" alt="Bangkok Marriott Marquis" class="hotel-card-img">
            <div class="hotel-card-body">
                <h3 class="hotel-card-title">Bangkok Marriott Marquis</h3>
                <p class="hotel-card-location">📍 Bangkok, Thailand</p>
                <div class="hotel-card-footer">
                    <span class="rating-badge">★ 4.7</span>
                    <div>
                        <span class="price-tag">$135</span>
                        <span class="price-unit">/ night</span>
                    </div>
                </div>
            </div>
        </a>

        <!-- 示例酒店卡片 4 -->
        <a href="details.php?id=4" class="hotel-card">
            <img src="https://images.unsplash.com/photo-1528127269322-539801943592?auto=format&fit=crop&w=600&q=80" alt="Vinpearl Resort Ha Long" class="hotel-card-img">
            <div class="hotel-card-body">
                <h3 class="hotel-card-title">Vinpearl Resort Ha Long</h3>
                <p class="hotel-card-location">📍 Ha Long Bay, Vietnam</p>
                <div class="hotel-card-footer">
                    <span class="rating-badge">★ 4.6</span>
                    <div>
                        <span class="price-tag">$110</span>
                        <span class="price-unit">/ night</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<?php include '../footer.php'; ?>