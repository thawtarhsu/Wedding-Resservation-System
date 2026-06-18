<?php
session_start();
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    if ($email === 'admin@wedding.com' && $password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_email'] = $email;
        header('Location: /');
        exit;
    } else {
        $error = 'Invalid credentials';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body { font-family: Arial; background: linear-gradient(135deg, #667eea, #764ba2); min-height: 100vh; display: flex; justify-content: center; align-items: center; margin: 0; }
        .container { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); width: 100%; max-width: 400px; }
        h1 { color: #E91E63; text-align: center; margin-top: 0; }
        .form-group { margin: 20px 0; }
        label { display: block; margin-bottom: 8px; color: #333; font-weight: 500; }
        input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; font-size: 14px; }
        input:focus { outline: none; border-color: #E91E63; }
        button { width: 100%; padding: 12px; background: #E91E63; color: white; border: none; border-radius: 5px; font-size: 16px; font-weight: 600; cursor: pointer; margin-top: 10px; }
        button:hover { background: #c2185b; }
        .error { background: #ffebee; color: #c62828; padding: 12px; border-radius: 5px; margin-bottom: 20px; border-left: 4px solid #c62828; }
        .demo { background: #f5f5f5; padding: 15px; border-radius: 5px; margin-top: 20px; font-size: 13px; }
        a { color: #E91E63; text-decoration: none; display: block; text-align: center; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎊 Admin Login</h1>
        <?php if($error): ?><div class="error"><?=$error?></div><?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="admin@wedding.com" required autofocus>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" value="admin123" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <div class="demo">
            <strong>Demo:</strong><br>
            📧 admin@wedding.com<br>
            🔑 admin123
        </div>
        <a href="/">← Home</a>
    </div>
</body>
</html>
