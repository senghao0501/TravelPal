<?php
session_start();

/* Temporary session-only accounts. Replace this with database queries later. */
if (!isset($_SESSION['travelpal_accounts'])) {
    $_SESSION['travelpal_accounts'] = [
        'demo@travelpal.my' => [
            'name' => 'Aina Rahman',
            'password' => password_hash('TravelPal123!', PASSWORD_DEFAULT),
        ],
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';
    $account = $_SESSION['travelpal_accounts'][$email] ?? null;

    if ($account && password_verify($password, $account['password'])) {
        $_SESSION['user_id'] = $email;
        $_SESSION['user_name'] = $account['name'];
        header('Location: /TravelPal/index.php?login=success');
        exit;
    }
    header('Location: login.php?error=1');
    exit;
}

include '../header.php';
?>
<link rel="stylesheet" href="../css/modules/auth.css?v=5">

<section class="auth-wrapper" aria-label="Sign in to TravelPal">
    <div class="auth-container auth-login-layout">
        <aside class="auth-left slideshow-container" aria-label="Malaysia destination highlights">
            <article class="slide active">
                <img src="https://cdn.pixabay.com/photo/2016/11/13/12/52/kuala-lumpur-1820944_1280.jpg" alt="Kuala Lumpur skyline">
                <div class="caption"><span class="badge">City escape</span><h3>Kuala Lumpur</h3><p>Malaysia</p><div class="rating">★ 4.9 <span>18,640 travellers loved it</span></div></div>
            </article>
            <article class="slide">
                <img src="https://a-us.storyblok.com/f/1018409/4000x2250/188672021b/malaysia-professional-visit-pass-9.jpg" alt="Penang">
                <div class="caption"><span class="badge">Food &amp; heritage</span><h3>Penang</h3><p>Malaysia</p><div class="rating">★ 4.8 <span>12,980 travellers loved it</span></div></div>
            </article>
            <article class="slide">
                <img src="https://mediaim.expedia.com/destination/1/1fae69e907143c28cc0ea9771f67f041.jpg" alt="Semporna, Sabah">
                <div class="caption"><span class="badge">Island discovery</span><h3>Semporna, Sabah</h3><p>Malaysia</p><div class="rating">★ 4.9 <span>9,420 travellers loved it</span></div></div>
            </article>
            <article class="slide">
                <img src="https://content.r9cdn.net/rimg/dimg/2f/8e/5e54c6c2-city-44529-1732ead8292.jpg?width=1366&amp;height=768&amp;xhint=3180&amp;yhint=1735&amp;crop=true" alt="Johor Bahru">
                <div class="caption"><span class="badge">Weekend favourite</span><h3>Johor Bahru</h3><p>Malaysia</p><div class="rating">★ 4.7 <span>10,260 travellers loved it</span></div></div>
            </article>
            <div class="slide-dots" aria-hidden="true"><span class="active"></span><span></span><span></span><span></span></div>
        </aside>

        <div class="auth-right">
            <div class="auth-header"><span class="auth-eyebrow">Welcome back</span><h1>Sign in to TravelPal</h1><p>Manage your trips and discover your next stay.</p></div>
            <?php if (isset($_GET['error'])): ?><div class="auth-alert error">The email or password is incorrect. Please try again.</div><?php endif; ?>
            <?php if (isset($_GET['registered'])): ?><div class="auth-alert success">Your account is ready. Please sign in.</div><?php endif; ?>
            <?php if (isset($_GET['logout'])): ?><div class="auth-alert success">You have signed out safely.</div><?php endif; ?>

            <form method="post" id="loginForm" novalidate>
                <div class="input-group"><label for="email">Email address</label><div class="input-wrapper"><span class="input-icon">@</span><input type="email" id="email" name="email" autocomplete="email" placeholder="name@email.com" required></div></div>
                <div class="input-group"><label for="password">Password</label><div class="input-wrapper"><span class="input-icon">⌁</span><input type="password" id="password" name="password" autocomplete="current-password" placeholder="Enter your password" required><button type="button" class="eye-btn" data-password-toggle="password" aria-label="Show password"><svg viewBox="0 0 24 24" aria-hidden="true"><path class="eye-outline" d="M2 12s3.6-6 10-6 10 6 10 6-3.6 6-10 6S2 12 2 12Z"/><circle cx="12" cy="12" r="2.7"/></svg></button></div></div>
                <div class="form-options"><label class="remember-me"><input type="checkbox" name="remember"> <span>Remember me</span></label><button type="button" class="text-button" id="resetNotice">Forgot password?</button></div>
                <p class="form-note" id="resetMessage" hidden>Password reset will be available after email delivery is configured.</p>
                <button type="submit" class="btn-primary" id="submitButton">Sign in</button>
            </form>
            <p class="auth-switch">New to TravelPal? <a href="register.php">Create an account</a></p>
            <p class="demo-hint">Demo account: <strong>demo@travelpal.my</strong> · <strong>TravelPal123!</strong></p>
        </div>
    </div>
</section>
<script>
document.querySelectorAll('[data-password-toggle]').forEach((button) => button.addEventListener('click', () => {
    const input = document.getElementById(button.dataset.passwordToggle);
    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';
    button.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
    button.classList.toggle('is-visible', isHidden);
}));
document.getElementById('resetNotice').addEventListener('click', () => document.getElementById('resetMessage').hidden = false);
document.getElementById('loginForm').addEventListener('submit', () => { document.getElementById('submitButton').textContent = 'Signing in…'; });
const slides = [...document.querySelectorAll('.slide')], dots = [...document.querySelectorAll('.slide-dots span')]; let active = 0;
setInterval(() => { slides[active].classList.remove('active'); dots[active].classList.remove('active'); active = (active + 1) % slides.length; slides[active].classList.add('active'); dots[active].classList.add('active'); }, 5000);
</script>
</main></body></html>
