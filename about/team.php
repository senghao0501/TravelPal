<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// 引入上一级的 header
include '../header.php'; 
?>

<style>
/* =========================================================
   Our Team Page Styles
   ========================================================= */
.about-hero {
    text-align: center;
    padding: 80px 20px 40px;
    max-width: 800px;
    margin: 0 auto;
}

.about-hero h1 {
    font-size: 38px;
    font-weight: 800;
    color: #111827;
    margin-bottom: 16px;
    letter-spacing: -0.02em;
}

.about-hero p {
    font-size: 16px;
    color: #4b5563;
    line-height: 1.6;
}

.team-container {
    max-width: 1180px;
    margin: 0 auto 80px;
    padding: 0 20px;
}

.team-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
}

.team-card {
    background: #ffffff;
    border: 1px solid rgba(0, 0, 0, 0.08);
    border-radius: 12px; /* 🚨 这里从 16px 改回统一的 12px 🚨 */
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.team-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
}

.team-img {
    width: 100%;
    height: 260px;
    object-fit: cover;
    display: block;
}

.team-info {
    padding: 24px 20px;
    text-align: center;
}

.team-info h3 {
    margin: 0 0 4px;
    color: #111827;
    font-size: 18px;
    font-weight: 700;
}

.team-role {
    color: #047857; /* 主题绿 */
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 12px;
}

.team-desc {
    color: #6b7280;
    font-size: 13px;
    line-height: 1.5;
    margin: 0;
}

/* 响应式 */
@media (max-width: 992px) { .team-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 560px) { .team-grid { grid-template-columns: 1fr; } }
</style>

<main>
    <section class="about-hero">
        <h1>Meet the TravelPal Team</h1>
        <p>We are a passionate group of developers, designers, and travel enthusiasts dedicated to making your journey across Malaysia seamless and unforgettable.</p>
    </section>

    <section class="team-container">
        <div class="team-grid">
            <!-- Team Member 1 -->
            <div class="team-card">
                <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=500&q=80" alt="Team Member" class="team-img">
                <div class="team-info">
                    <h3>Sarah Lee</h3>
                    <div class="team-role">Project Manager</div>
                    <p class="team-desc">Ensures everything runs smoothly and keeps the team focused on delivering the best user experience.</p>
                </div>
            </div>
            <!-- Team Member 2 -->
            <div class="team-card">
                <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=500&q=80" alt="Team Member" class="team-img">
                <div class="team-info">
                    <h3>Jason Wong</h3>
                    <div class="team-role">Backend Engineer</div>
                    <p class="team-desc">The architect behind our fast hotel search API and secure user authentication system.</p>
                </div>
            </div>
            <!-- Team Member 3 -->
            <div class="team-card">
                <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=500&q=80" alt="Team Member" class="team-img">
                <div class="team-info">
                    <h3>Aisha Rahman</h3>
                    <div class="team-role">UI/UX Designer</div>
                    <p class="team-desc">Crafts the beautiful interfaces, green themes, and pixel-perfect layouts you see every day.</p>
                </div>
            </div>
            <!-- Team Member 4 -->
            <div class="team-card">
                <img src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?w=500&q=80" alt="Team Member" class="team-img">
                <div class="team-info">
                    <h3>David Chen</h3>
                    <div class="team-role">QA & Testing</div>
                    <p class="team-desc">Hunts down bugs and tests every feature to ensure your booking process is flawless.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include '../footer.php'; ?>