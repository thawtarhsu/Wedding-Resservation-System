<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial; background: #f5f5f5; }
        .header { background: #E91E63; color: white; padding: 20px; display: flex; justify-content: space-between; align-items: center; }
        .header h1 { margin: 0; }
        .header a { color: white; text-decoration: none; margin-left: 20px; }
        .header a:hover { text-decoration: underline; }
        .container { max-width: 1000px; margin: 20px auto; padding: 20px; }
        .box { background: white; padding: 30px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center; }
        .box h2 { color: #E91E63; margin-bottom: 15px; }
        .box p { color: #666; margin-bottom: 20px; }
        .btn { display: inline-block; padding: 12px 30px; background: #E91E63; color: white; text-decoration: none; border-radius: 5px; margin: 10px 5px; }
        .btn:hover { background: #c2185b; }
    </style>
</head>
<body>
    <div class="header">
        <h1>🎊 Admin Dashboard</h1>
        <div>
            <span><?= $_SESSION['admin_email'] ?></span>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    
    <div class="container">
        <div class="box">
            <h2>Wedding Management System</h2>
            <p>Welcome to the admin panel. Manage your wedding reservations and bookings.</p>
            <a href="reservations.php" class="btn">📋 View All Reservations</a>
            <a href="../index.php" class="btn">🏠 Back to Home</a>
        </div>
    </div>
</body>
</html>
