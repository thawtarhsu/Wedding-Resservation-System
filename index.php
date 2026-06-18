<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Wedding Management System</title>
    <style>
        * { margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; }
        .nav { background: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .logo { font-size: 24px; font-weight: bold; color: #E91E63; }
        .nav-links { display: flex; gap: 30px; }
        .nav-links a { text-decoration: none; color: #333; font-weight: 500; }
        .nav-links a:hover { color: #E91E63; }
        .auth { display: flex; gap: 10px; align-items: center; }
        .auth a { text-decoration: none; padding: 8px 15px; border-radius: 3px; }
        .login { border: 2px solid #E91E63; color: #E91E63; }
        .signup { background: #E91E63; color: white; }
        .admin-btn { background: #FF9800; color: white; }
        .hero { background: url('https://images.unsplash.com/photo-1519741497674-611481863552?w=1200&h=600&fit=crop') center/cover; height: 500px; display: flex; flex-direction: column; justify-content: center; align-items: center; color: white; text-align: center; }
        .hero-overlay { background: rgba(0,0,0,0.3); width: 100%; height: 100%; display: flex; flex-direction: column; justify-content: center; align-items: center; }
        .hero h1 { font-size: 48px; margin-bottom: 10px; }
        .hero p { font-size: 24px; margin-bottom: 30px; }
        .hero button { background: #E91E63; color: white; border: none; padding: 15px 40px; font-size: 18px; cursor: pointer; border-radius: 3px; }
        .hero button:hover { background: #c2185b; }
        .container { max-width: 1200px; margin: 0 auto; padding: 40px 20px; }
        .sections { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
        .section { background: white; padding: 30px; text-align: center; border-radius: 5px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .section h3 { color: #E91E63; margin: 10px 0; }
        .section a { color: #E91E63; text-decoration: none; font-weight: 500; }
        .section a:hover { text-decoration: underline; }
        .footer { background: #E91E63; color: white; text-align: center; padding: 20px; }
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
