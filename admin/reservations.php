<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}
$conn = mysqli_connect('db', 'root', 'wedding123', 'wedding_db');
if (!$conn) die('DB Error');
$result = mysqli_query($conn, "SELECT booking_id, bride, groom, wedding_date, wedding_type FROM tblweddingbook");
$bookings = [];
while ($row = mysqli_fetch_assoc($result)) {
    $bookings[] = $row;
}
mysqli_close($conn);
$total = count($bookings);
?>
<html>
<head><title>Reservations</title>
<style>
body{font-family:Arial;background:#f5f5f5;margin:0}
.header{background:#E91E63;color:white;padding:20px;display:flex;justify-content:space-between}
.container{max-width:1200px;margin:20px auto;padding:20px}
table{width:100%;background:white;border-collapse:collapse;border-radius:5px}
th{background:#E91E63;color:white;padding:15px;text-align:left}
td{padding:15px;border-bottom:1px solid #ddd}
tr:hover{background:#f9f9f9}
.empty{background:white;padding:40px;text-align:center;border-radius:5px}
a{color:#E91E63;text-decoration:none}
a:hover{text-decoration:underline}
.links{margin-top:20px}
.btn{display:inline-block;padding:10px 20px;background:#E91E63;color:white;text-decoration:none;border-radius:5px;margin:5px}
.btn:hover{background:#c2185b}
</style>
</head>
<body>
<div class="header">
<h1>Reservations</h1>
<div><a href="logout.php" style="color:white">Logout</a></div>
</div>
<div class="container">
<p><strong>Total Bookings:</strong> <?=$total?></p>
<?php if($total>0): ?>
<table>
<tr><th>ID</th><th>Bride</th><th>Groom</th><th>Date</th><th>Type</th></tr>
<?php foreach($bookings as $b): ?>
<tr><td><?=$b['booking_id']?></td><td><?=$b['bride']?></td><td><?=$b['groom']?></td><td><?=$b['wedding_date']?></td><td><?=$b['wedding_type']?></td></tr>
<?php endforeach; ?>
</table>
<?php else: ?>
<div class="empty"><h2>No Reservations</h2><p>No bookings yet</p></div>
<?php endif; ?>
<div class="links">
<a href="dashboard.php" class="btn">Dashboard</a>
<a href="/" class="btn">Home</a>
</div>
</div>
</body>
</html>
