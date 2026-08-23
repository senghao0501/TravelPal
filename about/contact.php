<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// 引入上一级的 header
include '../header.php'; 
?>

<style>
/* =========================================================
   Contact Us Page Styles (No Form Edition)
   ========================================================= */
.contact-hero {
    text-align: center;
    padding: 80px 20px 40px;
}

.contact-hero h1 {
    font-size: 38px;
    font-weight: 800;
    color: #111827;
    margin-bottom: 12px;
    letter-spacing: -0.02em;
}

.contact-hero p {
    font-size: 16px;
    color: #4b5563;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

.contact-layout {
    max-width: 1000px;
    margin: 0 auto 80px;
    padding: 0 20px;
    display: grid;
    /* 改成 3 列均分网格 */
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}

.contact-card {
    background: #ffffff;
    border: 1px solid rgba(0, 0, 0, 0.08);
    border-radius: 12px; /* 🚨 绝对统一的 12px 完美圆角 🚨 */
    padding: 40px 24px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.contact-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
}

.contact-icon {
    width: 64px;
    height: 64px;
    margin: 0 auto 24px;
    background: #ecfdf5; /* 浅绿底色 */
    color: #047857; /* 主题绿 */
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}

.contact-card h3 {
    margin: 0 0 12px;
    font-size: 18px;
    color: #111827;
    font-weight: 700;
}

.contact-card p {
    margin: 0;
    font-size: 14px;
    line-height: 1.6;
    color: #4b5563;
}

/* 响应式：手机端自动变成上下排列 */
@media (max-width: 768px) {
    .contact-layout {
        grid-template-columns: 1fr;
        gap: 16px;
    }
}
</style>

<main>
    <section class="contact-hero">
        <h1>Get in Touch</h1>
        <p>Need help with your travel plans? Our support team is always ready to assist you. Reach out to us through any of the channels below.</p>
    </section>

    <section class="contact-layout">
        <!-- 卡片 1：公司地址 -->
        <div class="contact-card">
            <div class="contact-icon">
                <i class="fa-solid fa-location-dot"></i>
            </div>
            <h3>Our Office</h3>
            <p>123 Tech Park Avenue,<br>Bayan Lepas, 11900<br>Penang, Malaysia</p>
        </div>

        <!-- 卡片 2：客服邮箱 -->
        <div class="contact-card">
            <div class="contact-icon">
                <i class="fa-solid fa-envelope"></i>
            </div>
            <h3>Email Us</h3>
            <!-- 加上 <br><br> 是为了让三张卡片高度在视觉上保持一致 -->
            <p>support@travelpal.com<br>partnerships@travelpal.com<br><br></p>
        </div>

        <!-- 卡片 3：联系电话 -->
        <div class="contact-card">
            <div class="contact-icon">
                <i class="fa-solid fa-phone"></i>
            </div>
            <h3>Call Us</h3>
            <p>+6014-676 9999<br><span style="color: #047857; font-weight: 600;">Mon-Fri, 9am-6pm (MYT)</span><br><br></p>
        </div>
    </section>
</main>

<?php include '../footer.php'; ?>