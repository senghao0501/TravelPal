<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// 引入同一目录下的 header
include 'header.php'; 
?>

<style>
/* =========================================================
   Travel Guide / FAQ Page Styles
   ========================================================= */
.faq-hero {
    text-align: center;
    padding: 80px 20px 40px;
}

.faq-hero h1 {
    font-size: 38px;
    font-weight: 800;
    color: #111827;
    margin-bottom: 12px;
    letter-spacing: -0.02em;
}

.faq-hero p {
    font-size: 16px;
    color: #4b5563;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

.faq-container {
    max-width: 800px; /* FAQ 不需要太宽，窄一点阅读体验更好 */
    margin: 0 auto 80px;
    padding: 0 20px;
}

.faq-category-title {
    font-size: 20px;
    font-weight: 800;
    color: #111827;
    margin: 40px 0 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #ecfdf5;
}

/* 🚨 严格统一的 12px 圆角折叠卡片 🚨 */
.faq-item {
    background: #ffffff;
    border: 1px solid rgba(0, 0, 0, 0.08);
    border-radius: 12px; 
    margin-bottom: 16px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.faq-item.active {
    border-color: #047857; /* 展开时边框变成主题绿 */
    box-shadow: 0 8px 20px rgba(4, 120, 87, 0.08);
}

.faq-question {
    width: 100%;
    text-align: left;
    padding: 22px 24px;
    background: transparent;
    border: none;
    font-size: 16px;
    font-weight: 700;
    color: #111827;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: color 0.2s ease;
}

.faq-question:hover {
    color: #047857;
}

.faq-icon {
    color: #047857;
    font-size: 18px;
    transition: transform 0.3s ease; /* 图标旋转动画 */
}

.faq-item.active .faq-icon {
    transform: rotate(180deg); /* 展开时箭头朝上 */
}

.faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease-out, padding 0.3s ease;
    background: #f8fafc; /* 答案区域用非常淡的灰色区分层次 */
}

.faq-item.active .faq-answer {
    max-height: 500px; /* 足够高以显示内容 */
    padding: 0 24px 24px;
}

.faq-answer p {
    margin: 0;
    color: #4b5563;
    font-size: 14px;
    line-height: 1.6;
}
</style>

<main>
    <section class="faq-hero">
        <h1>Travel Guide & FAQ</h1>
        <p>Find answers to common questions about booking flights, reserving hotels, and planning your perfect Malaysian getaway.</p>
    </section>

    <section class="faq-container">
        
        <h2 class="faq-category-title">General Questions</h2>
        
        <div class="faq-item">
            <button class="faq-question">
                Do I need to create an account to use TravelPal?
                <i class="fa-solid fa-chevron-down faq-icon"></i>
            </button>
            <div class="faq-answer">
                <p>No, you can search and browse flights and hotels without an account. However, creating a free TravelPal account allows you to unlock Member Secret Prices (up to 15% off), save your favorite stays, and manage all your bookings in one place.</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question">
                Is TravelPal only for traveling within Malaysia?
                <i class="fa-solid fa-chevron-down faq-icon"></i>
            </button>
            <div class="faq-answer">
                <p>Currently, TravelPal specializes in domestic travel within Malaysia, covering popular destinations like Penang, Kuala Lumpur, Sabah, and Sarawak. We are planning to expand to international Southeast Asian routes soon!</p>
            </div>
        </div>

        <h2 class="faq-category-title">Hotel Bookings</h2>

        <div class="faq-item">
            <button class="faq-question">
                What does "Free Cancellation" mean?
                <i class="fa-solid fa-chevron-down faq-icon"></i>
            </button>
            <div class="faq-answer">
                <p>Properties with a "Free Cancellation" tag allow you to cancel your booking without any penalty up to a certain date (usually 24 to 48 hours before check-in). Please check the specific hotel's policy during the checkout process.</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question">
                Can I pay directly at the hotel?
                <i class="fa-solid fa-chevron-down faq-icon"></i>
            </button>
            <div class="faq-answer">
                <p>Yes! Many of our partner hotels offer a "Pay at Hotel" option. You simply reserve your room online to lock in the price, and pay using cash or credit card when you arrive at the front desk.</p>
            </div>
        </div>

        <h2 class="faq-category-title">Flight Reservations</h2>

        <div class="faq-item">
            <button class="faq-question">
                Are baggage fees included in the flight ticket price?
                <i class="fa-solid fa-chevron-down faq-icon"></i>
            </button>
            <div class="faq-answer">
                <p>A standard 7kg carry-on baggage is usually included for all flights. Checked baggage policies depend on the airline (e.g., AirAsia, Malaysia Airlines, Firefly). You can view baggage details and add extra weight before completing your payment.</p>
            </div>
        </div>

    </section>
</main>

<script>
// 折叠面板 (Accordion) 互动逻辑
document.addEventListener("DOMContentLoaded", function() {
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const questionBtn = item.querySelector('.faq-question');
        
        questionBtn.addEventListener('click', () => {
            // 如果你想让其他打开的面板自动收起，可以取消下面这两行的注释：
            // faqItems.forEach(otherItem => {
            //     if (otherItem !== item) otherItem.classList.remove('active');
            // });

            // 切换当前面板的状态
            item.classList.toggle('active');
        });
    });
});
</script>

<?php include 'footer.php'; ?>