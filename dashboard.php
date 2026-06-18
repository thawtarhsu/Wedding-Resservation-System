<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Admin Dashboard</title></head>
<body>
<h1>Admin Dashboard</h1>
<p>Welcome <?= $_SESSION['admin_email'] ?></p>
<p><a href="../index.php">Home</a> | <a href="logout.php">Logout</a></p>
</body>
</html>
