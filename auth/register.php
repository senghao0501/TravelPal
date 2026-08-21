<?php
session_start();
if (!isset($_SESSION['travelpal_accounts'])) {
    $_SESSION['travelpal_accounts'] = [
        'demo@travelpal.my' => ['name' => 'Aina Rahman', 'password' => password_hash('TravelPal123!', PASSWORD_DEFAULT)],
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['username'] ?? '');
    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';
    if (mb_strlen($name) < 2) $error = 'Please enter your full name.';
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $error = 'Please enter a valid email address.';
    elseif (isset($_SESSION['travelpal_accounts'][$email])) $error = 'This email address is already registered.';
    elseif (strlen($password) < 8) $error = 'Your password must contain at least 8 characters.';
    elseif ($password !== $confirm) $error = 'Your passwords do not match.';
    else {
        $_SESSION['travelpal_accounts'][$email] = ['name' => $name, 'password' => password_hash($password, PASSWORD_DEFAULT)];
        header('Location: login.php?registered=1'); exit;
    }
}
include '../header.php';
?>
<link rel="stylesheet" href="../css/modules/auth.css?v=5">
<section class="auth-wrapper" aria-label="Create a TravelPal account">
    <div class="auth-container auth-register-layout">
        <aside class="auth-left slideshow-container" aria-label="Malaysia destination highlights">
            <article class="slide active"><img src="https://cdn.pixabay.com/photo/2016/11/13/12/52/kuala-lumpur-1820944_1280.jpg" alt="Kuala Lumpur skyline"><div class="caption"><span class="badge">City escape</span><h3>Kuala Lumpur</h3><p>Malaysia</p><div class="rating">★ 4.9 <span>18,640 travellers loved it</span></div></div></article>
            <article class="slide"><img src="https://a-us.storyblok.com/f/1018409/4000x2250/188672021b/malaysia-professional-visit-pass-9.jpg" alt="Penang"><div class="caption"><span class="badge">Food &amp; heritage</span><h3>Penang</h3><p>Malaysia</p><div class="rating">★ 4.8 <span>12,980 travellers loved it</span></div></div></article>
            <article class="slide"><img src="https://mediaim.expedia.com/destination/1/1fae69e907143c28cc0ea9771f67f041.jpg" alt="Semporna, Sabah"><div class="caption"><span class="badge">Island discovery</span><h3>Semporna, Sabah</h3><p>Malaysia</p><div class="rating">★ 4.9 <span>9,420 travellers loved it</span></div></div></article>
            <article class="slide"><img src="https://content.r9cdn.net/rimg/dimg/2f/8e/5e54c6c2-city-44529-1732ead8292.jpg?width=1366&amp;height=768&amp;xhint=3180&amp;yhint=1735&amp;crop=true" alt="Johor Bahru"><div class="caption"><span class="badge">Weekend favourite</span><h3>Johor Bahru</h3><p>Malaysia</p><div class="rating">★ 4.7 <span>10,260 travellers loved it</span></div></div></article>
            <div class="slide-dots" aria-hidden="true"><span class="active"></span><span></span><span></span><span></span></div>
        </aside>
        <div class="auth-right">
            <div class="auth-header"><span class="auth-eyebrow">Start exploring</span><h1>Create your account</h1><p>Save your favourite routes and keep every trip in one place.</p></div>
            <?php if (isset($error)): ?><div class="auth-alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
            <form method="post" id="registerForm">
                <div class="input-group"><label for="username">Full name</label><div class="input-wrapper"><span class="input-icon">◌</span><input type="text" id="username" name="username" autocomplete="name" placeholder="Your full name" required value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"></div></div>
                <div class="input-group"><label for="email">Email address</label><div class="input-wrapper"><span class="input-icon">@</span><input type="email" id="email" name="email" autocomplete="email" placeholder="name@email.com" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"></div></div>
                <div class="input-group"><label for="password">Password</label><div class="input-wrapper"><span class="input-icon">⌁</span><input type="password" id="password" name="password" autocomplete="new-password" placeholder="At least 8 characters" minlength="8" required><button type="button" class="eye-btn" data-password-toggle="password" aria-label="Show password"><svg viewBox="0 0 24 24" aria-hidden="true"><path class="eye-outline" d="M2 12s3.6-6 10-6 10 6 10 6-3.6 6-10 6S2 12 2 12Z"/><circle cx="12" cy="12" r="2.7"/></svg></button></div></div>
                <div class="input-group"><label for="confirm_password">Confirm password</label><div class="input-wrapper"><span class="input-icon">⌁</span><input type="password" id="confirm_password" name="confirm_password" autocomplete="new-password" placeholder="Repeat your password" minlength="8" required><button type="button" class="eye-btn" data-password-toggle="confirm_password" aria-label="Show password"><svg viewBox="0 0 24 24" aria-hidden="true"><path class="eye-outline" d="M2 12s3.6-6 10-6 10 6 10 6-3.6 6-10 6S2 12 2 12Z"/><circle cx="12" cy="12" r="2.7"/></svg></button></div></div>
                <button type="submit" class="btn-primary" id="submitButton">Create account</button>
            </form>
            <p class="auth-switch">Already have an account? <a href="login.php">Sign in</a></p>
            <p class="form-note">This version stores new accounts only for the current browser session. Database storage will be added later.</p>
        </div>
    </div>
</section>
<script>
document.querySelectorAll('[data-password-toggle]').forEach((button) => button.addEventListener('click', () => { const input = document.getElementById(button.dataset.passwordToggle); const isHidden = input.type === 'password'; input.type = isHidden ? 'text' : 'password'; button.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password'); button.classList.toggle('is-visible', isHidden); }));
document.getElementById('registerForm').addEventListener('submit', () => { document.getElementById('submitButton').textContent = 'Creating account…'; });
const slides = [...document.querySelectorAll('.slide')], dots = [...document.querySelectorAll('.slide-dots span')]; let active = 0; setInterval(() => { slides[active].classList.remove('active'); dots[active].classList.remove('active'); active = (active + 1) % slides.length; slides[active].classList.add('active'); dots[active].classList.add('active'); }, 5000);
</script>
</main></body></html>
