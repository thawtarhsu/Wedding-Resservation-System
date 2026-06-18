<?php
session_start();

$message = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bride = $_POST['bride'] ?? '';
    $groom = $_POST['groom'] ?? '';
    $wedding_date = $_POST['wedding_date'] ?? '';
    $wedding_type = $_POST['wedding_type'] ?? 0;
    $email = $_POST['email'] ?? '';

    if ($bride && $groom && $wedding_date && $wedding_type && $email) {
        $conn = mysqli_connect('db', 'root', 'wedding123', 'wedding_db');
        
        if ($conn) {
            $query = "INSERT INTO tblweddingbook (user_id, bride, groom, wedding_date, wedding_type, user_email, organizer_id) 
                      VALUES (0, '$bride', '$groom', '$wedding_date', $wedding_type, '$email', 0)";
            
            if (mysqli_query($conn, $query)) {
                $success = true;
                $message = 'Booking successful! Your reservation has been saved.';
                $_SESSION['booking_id'] = mysqli_insert_id($conn);
            } else {
                $message = 'Error: ' . mysqli_error($conn);
            }
            mysqli_close($conn);
        } else {
            $message = 'Database connection failed';
        }
    } else {
        $message = 'Please fill in all fields';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Book Your Wedding</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial; background: #f5f5f5; }
        .nav { background: white; padding: 15px 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .nav a { color: #E91E63; text-decoration: none; margin-right: 20px; }
        .container { max-width: 600px; margin: 40px auto; padding: 20px; }
        .form-box { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .form-box h1 { color: #E91E63; margin-bottom: 20px; text-align: center; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; color: #333; font-weight: 500; }
        input, select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px; }
        input:focus, select:focus { outline: none; border-color: #E91E63; box-shadow: 0 0 0 3px rgba(233,30,99,0.1); }
        button { width: 100%; padding: 12px; background: #E91E63; color: white; border: none; border-radius: 5px; font-size: 16px; font-weight: 600; cursor: pointer; margin-top: 10px; }
        button:hover { background: #c2185b; }
        .message { padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .error { background: #ffebee; color: #c62828; border-left: 4px solid #c62828; }
        .success { background: #e8f5e9; color: #2e7d32; border-left: 4px solid #2e7d32; }
        .back { text-align: center; margin-top: 20px; }
        .back a { color: #E91E63; text-decoration: none; }
        .booking-id { background: #e3f2fd; padding: 15px; border-radius: 5px; margin-top: 20px; text-align: center; }
    </style>
</head>
<body>
    <div class="nav">
        <a href="index.php">← Back to Home</a>
    </div>
    
    <div class="container">
        <div class="form-box">
            <h1>💍 Book Your Wedding</h1>
            
            <?php if ($message): ?>
                <div class="message <?php echo $success ? 'success' : 'error'; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>
            
            <?php if (!$success): ?>
            <form method="POST">
                <div class="form-group">
                    <label for="bride">Bride Name *</label>
                    <input type="text" id="bride" name="bride" required>
                </div>
                
                <div class="form-group">
                    <label for="groom">Groom Name *</label>
                    <input type="text" id="groom" name="groom" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="wedding_date">Wedding Date *</label>
                    <input type="date" id="wedding_date" name="wedding_date" required>
                </div>
                
                <div class="form-group">
                    <label for="wedding_type">Wedding Type *</label>
                    <select id="wedding_type" name="wedding_type" required>
                        <option value="">Select Type</option>
                        <option value="1">Garden Wedding</option>
                        <option value="2">Beach Wedding</option>
                        <option value="3">Modern Wedding</option>
                        <option value="4">Traditional Wedding</option>
                        <option value="5">Luxury Palace</option>
                    </select>
                </div>
                
                <button type="submit">Book Now</button>
            </form>
            <?php else: ?>
            <div class="booking-id">
                <p>✅ Your booking has been confirmed!</p>
                <p><strong>Booking ID:</strong> <?= $_SESSION['booking_id'] ?? 'N/A' ?></p>
                <p>Check your email for confirmation details.</p>
            </div>
            <div class="back">
                <a href="index.php">Return to Home</a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
