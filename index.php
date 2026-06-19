<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Wedding Management System</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-PLACEHOLDER" crossorigin="anonymous">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100%; }
        body {
            font-family: Arial, sans-serif;
            min-height: 100%;
            background: url('images/hh2.jpg') center/cover no-repeat fixed;
            color: #ffffff;
        }
        .nav { background: rgba(24, 3, 58, 0.82); padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; position: relative; z-index: 2; }
        .logo { font-size: 24px; font-weight: bold; color: #e1c0ff; }
        .nav-links { display: flex; gap: 30px; }
        .nav-links a { text-decoration: none; color: #f2e9ff; font-weight: 600; }
        .nav-links a:hover { color: #d3b3ff; }
        .auth { display: flex; gap: 10px; align-items: center; }
        .auth a { text-decoration: none; padding: 8px 15px; border-radius: 4px; font-weight: 600; }
        .login { border: 2px solid #c89cff; color: #f3e4ff; }
        .signup { background: #8a3fff; color: white; }
        .admin-btn { background: #5e2dd7; color: white; }
        .hero { min-height: calc(100vh - 90px); display: flex; align-items: center; justify-content: center; text-align: center; position: relative; }
        .hero-overlay { background: rgba(18, 4, 46, 0.55); width: 100%; height: 100%; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 0 20px; }
        .hero h1 { font-size: 58px; margin-bottom: 10px; color: #f8f1ff; text-shadow: 0 8px 25px rgba(0,0,0,0.35); }
        .hero p { font-size: 24px; margin-bottom: 30px; color: #e5d6ff; }
        .hero button { background: #a248ff; color: white; border: none; padding: 16px 44px; font-size: 18px; cursor: pointer; border-radius: 6px; box-shadow: 0 10px 25px rgba(97, 34, 242, 0.3); }
        .hero button:hover { background: #7d2bde; }
        .container { max-width: 1200px; margin: 0 auto; padding: 40px 20px; background: transparent; }
        .sections { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
        .section { background: rgba(13, 5, 30, 0.65); padding: 30px; text-align: center; border-radius: 16px; box-shadow: 0 20px 40px rgba(0,0,0,0.18); border: 1px solid rgba(255,255,255,0.08); }
        .section h3 { color: #d2b5ff; margin: 10px 0; }
        .section p { color: #f9f4ff; }
        .section a { color: #c59eff; text-decoration: none; font-weight: 600; }
        .section a:hover { color: #e7d5ff; text-decoration: underline; }
        .footer { background: rgba(80, 18, 146, 0.92); color: #f7f0ff; text-align: center; padding: 24px 20px; }
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
            <a href="#about">ABOUT</a>
        </div>
        <div class="auth">
            <?php if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']): ?>
                <span style="margin-right: 10px; color: #333;">Admin: <?= $_SESSION['admin_email'] ?></span>
                <a href="admin/reservations.php" class="admin-btn">📋 Reservations</a>
                <a href="admin/logout.php" class="login">Logout</a>
            <?php elseif (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                <span style="margin-right: 10px;">Hi <?= $_SESSION['user_name'] ?></span>
                <a href="logout.php" class="login">Logout</a>
            <?php else: ?>
                <a href="admin/login.php" class="login">ADMIN</a>
                <a href="booking.php" class="signup">JOIN NOW</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="hero">
        <div class="hero-overlay">
            <h1>Your Perfect Wedding Awaits</h1>
            <p>Plan your dream wedding with us</p>
            <a href="booking.php"><button>JOIN NOW</button></a>
        </div>
    </div>

    <div class="container">
        <div class="sections">
            <div class="section">
                <h3>💰 Pricing</h3>
                <p>Affordable wedding packages in Myanmar Kyat & USD</p>
                <a href="pricing.php">View Pricing →</a>
            </div>
            <div class="section">
                <h3>✨ Gallery</h3>
                <p>Beautiful wedding photos and inspirations</p>
                <a href="gallery.php">View Gallery →</a>
            </div>
            <div class="section">
                <h3>💡 Inspiration</h3>
                <p>Get ideas for your perfect wedding day</p>
                <a href="inspiration.php">Get Inspired →</a>
            </div>
            <div class="section">
                <h3>📅 Book Now</h3>
                <p>Reserve your wedding date today</p>
                <a href="booking.php">Sign Up →</a>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2025 Wedding Management System. All rights reserved.</p>
    </div>
</body>
</html>
