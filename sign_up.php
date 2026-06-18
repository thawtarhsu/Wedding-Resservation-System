<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <style>
        body { font-family: Arial; background: #f0f0f0; padding: 50px; margin: 0; }
        .form { max-width: 500px; margin: 0 auto; background: white; padding: 30px; border-radius: 5px; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #6f42c1; color: white; border: none; cursor: pointer; margin-top: 10px; }
        a { color: #6f42c1; }
        .error { color: red; padding: 10px; background: #ffe6e6; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="form">
        <h1>Sign Up for Your Wedding</h1>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstname = $_POST['firstname'] ?? '';
            $lastname = $_POST['lastname'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $wedding_date = $_POST['wedding_date'] ?? '';
            
            if ($firstname && $lastname && $email && $password && $wedding_date) {
                $_SESSION['user_id'] = rand(1000, 9999);
                $_SESSION['user_name'] = $firstname . ' ' . $lastname;
                $_SESSION['user_email'] = $email;
                $_SESSION['logged_in'] = true;
                echo "<div class='error'>Registration successful! Redirecting...</div>";
                echo "<script>setTimeout(() => window.location.href='index.php', 2000);</script>";
            } else {
                echo "<div class='error'>All fields required!</div>";
            }
        }
        ?>
        <form method="POST">
            <input type="text" name="firstname" placeholder="First Name" required>
            <input type="text" name="lastname" placeholder="Last Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="date" name="wedding_date" required>
            <button type="submit">Sign Up</button>
        </form>
        <p><a href="index.php">Home</a> | <a href="login.php">Login</a></p>
    </div>
</body>
</html>
