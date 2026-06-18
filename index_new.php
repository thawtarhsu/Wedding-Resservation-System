<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Wedding Management System</title>
    <style>
        * { margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; }
        .nav { background: white; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .logo { font-size: 20px; font-weight: bold; color: #6f42c1; }
        .nav-links { display: flex; gap: 20px; }
        .nav-links a { text-decoration: none; color: #333; }
        .nav-links a:hover { color: #6f42c1; }
        .auth-links { display: flex; gap: 10px; }
        .auth-links a { text-decoration: none; padding: 8px 15px; border-radius: 3px; }
        .login-btn { color: #6f42c1; border: 1px solid #6f42c1; }
        .signup-btn { background: #6f42c1; color: white; }
        .hero { position: relative; height: 500px; overflow: hidden; }
        .hero img { width: 100%; height: 100%; object-fit: cover; }
        .hero-overlay { position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.3); display: flex; flex-direction: column; justify-content: center; align-items: center; color: white; text-align: center; }
        .hero-overlay h1 { font-size: 48px; margin-bottom: 10px; }
        .hero-overlay p { font-size: 24px; margin-bottom: 30px; }
        .hero-overlay button { background: #6f42c1; color: white; border: none; padding: 12px 30px; font-size: 18px; cursor: pointer; border-radius: 3px; }
        .hero-overlay button:hover { background: #5a2fa0; }
        .container { max-width: 1200px; margin: 40px auto; padding: 0 20px; }
        .sections { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 40px; }
        .section-box { background: white; padding: 20px; border-radius: 5px; text-align: center; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .section-box h3 { color: #6f42c1; margin-bottom: 10px; }
        .section-box a { color: #6f42c1; text-decoration: none; }
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
                <span><?= $_SESSION['user_name'] ?></span>
                <a href="logout.php" class="login-btn">Logout</a>
            <?php else: ?>
                <a href="admin/login.php" class="login-btn">ADMIN LOGIN</a>
                <a href="login.php" class="login-btn">LOGIN</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="hero">
        <img src="https://images.unsplash.com/photo-1519741497674-611481863552?w=1200&h=600&fit=crop" alt="Wedding">
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
