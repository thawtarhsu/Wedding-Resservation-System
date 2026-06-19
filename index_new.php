<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Wedding Management System</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { min-height: 100%; }
        body {
            font-family: Arial, sans-serif;
            background: url('images/hh2.jpg') center/cover no-repeat fixed;
            color: #f9f4ff;
        }
        .nav { background: rgba(20, 3, 45, 0.92); padding: 18px 24px; display: flex; justify-content: space-between; align-items: center; position: relative; z-index: 2; }
        .logo { font-size: 24px; font-weight: 700; color: #d3b6ff; }
        .nav-links { display: flex; gap: 22px; }
        .nav-links a { text-decoration: none; color: #f1e9ff; font-weight: 600; }
        .nav-links a:hover { color: #c59eff; }
        .auth-links { display: flex; gap: 10px; align-items: center; }
        .auth-links a { text-decoration: none; padding: 10px 18px; border-radius: 8px; font-weight: 600; }
        .login-btn { color: #d7c0ff; border: 1px solid #a178ff; }
        .signup-btn { background: #9d4dff; color: white; }
        .hero { min-height: calc(100vh - 82px); display: flex; align-items: center; justify-content: center; text-align: center; position: relative; }
        .hero::before { content: '';
            position: absolute;
            inset: 0;
            background: rgba(13, 5, 25, 0.55);
            backdrop-filter: blur(2px);
        }
        .hero-overlay { position: relative; z-index: 1; max-width: 900px; padding: 0 20px; }
        .hero-overlay h1 { font-size: 58px; margin-bottom: 16px; line-height: 1.05; color: #f7efff; text-shadow: 0 18px 35px rgba(0,0,0,0.35); }
        .hero-overlay p { font-size: 24px; margin-bottom: 32px; color: #e8ddff; }
        .hero-overlay button { background: #bf6dff; color: white; border: none; padding: 16px 42px; font-size: 18px; cursor: pointer; border-radius: 8px; transition: transform 0.2s ease, background 0.2s ease; }
        .hero-overlay button:hover { background: #8f3fff; transform: translateY(-2px); }
        .container { max-width: 1200px; margin: 40px auto; padding: 0 20px; }
        .sections { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 40px; }
        .section-box { background: rgba(24, 10, 67, 0.80); padding: 28px; border-radius: 22px; text-align: center; box-shadow: 0 20px 40px rgba(0,0,0,0.20); border: 1px solid rgba(255,255,255,0.08); }
        .section-box h3 { color: #d9c3ff; margin-bottom: 16px; }
        .section-box p { color: #e8dcff; margin-bottom: 18px; }
        .section-box a { color: #b693ff; text-decoration: none; font-weight: 600; }
        .section-box a:hover { color: #f3e4ff; }
    </style>
</head>
<body>
    <div class="nav">
        <div class="logo">WPMS</div>
        <div class="nav-links">
            <a href="index.php">HOME</a>
            <a href="pricing.php">PRICING</a>
            <a href="inspiration.php">INSPIRATION</a>
            <a href="gallery.php">GALLERY</a>
            <a href="#about">ABOUT US</a>
        </div>
        <div class="auth-links">
            <?php if (isset($_SESSION['logged_in'])): ?>
                <span style="color: #dbc8ff;"><?= $_SESSION['user_name'] ?></span>
                <a href="logout.php" class="login-btn">Logout</a>
            <?php else: ?>
                <a href="admin/login.php" class="login-btn">ADMIN LOGIN</a>
                <a href="login.php" class="login-btn">LOGIN</a>
            <?php endif; ?>
            <a href="sign_up.php" class="signup-btn">JOIN NOW</a>
        </div>
    </div>

    <div class="hero">
        <div class="hero-overlay">
            <h1>Your Perfect Wedding Awaits</h1>
            <p>Plan your dream wedding with us</p>
            <a href="sign_up.php"><button>JOIN NOW</button></a>
        </div>
    </div>

    <div class="container">
        <div class="sections">
            <div class="section-box">
                <h3>🎉 Pricing</h3>
                <p>Affordable wedding packages</p>
                <a href="pricing.php">View →</a>
            </div>
            <div class="section-box">
                <h3>✨ Gallery</h3>
                <p>Beautiful wedding photos</p>
                <a href="gallery.php">View →</a>
            </div>
            <div class="section-box">
                <h3>💡 Inspiration</h3>
                <p>Get wedding ideas</p>
                <a href="inspiration.php">View →</a>
            </div>
            <div class="section-box">
                <h3>📅 Book Now</h3>
                <p>Reserve your date</p>
                <a href="sign_up.php">Sign Up →</a>
            </div>
        </div>
    </div>
</body>
</html>
