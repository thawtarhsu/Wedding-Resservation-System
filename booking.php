<?php
session_start();

$message = '';
$success = false;
$bookingData = [];

$weddingTypes = [
    1 => 'Garden Wedding',
    2 => 'Beach Wedding',
    3 => 'Modern Wedding',
    4 => 'Traditional Wedding',
    5 => 'Luxury Palace'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bride = trim($_POST['bride'] ?? '');
    $groom = trim($_POST['groom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $wedding_date = trim($_POST['wedding_date'] ?? '');
    $wedding_type = (int)($_POST['wedding_type'] ?? 0);
    $wedding_venue = trim($_POST['wedding_venue'] ?? '');
    $guest_count = (int)($_POST['guest_count'] ?? 0);
    $package_selected = trim($_POST['package_selected'] ?? 'Standard');
    $wedding_theme = trim($_POST['wedding_theme'] ?? 'Classic');
    $special_requests = trim($_POST['special_requests'] ?? '');

    if ($bride && $groom && $email && $wedding_date && $wedding_type && $wedding_venue && $guest_count > 0) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = 'Please enter a valid email address.';
        } elseif (!preg_match('/^[0-9+\-\s]{7,20}$/', $phone)) {
            $message = 'Please enter a valid phone number.';
        } else {
            $conn = mysqli_connect('db', 'root', 'wedding123', 'wedding_db');
            if ($conn) {
                $existingColumns = mysqli_query($conn, "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'tblweddingbook'");
                $columns = [];
                while ($row = mysqli_fetch_assoc($existingColumns)) {
                    $columns[] = $row['COLUMN_NAME'];
                }
                if (!in_array('contact_phone', $columns)) {
                    mysqli_query($conn, "ALTER TABLE tblweddingbook ADD COLUMN contact_phone VARCHAR(30) NOT NULL DEFAULT ''");
                }
                if (!in_array('wedding_venue', $columns)) {
                    mysqli_query($conn, "ALTER TABLE tblweddingbook ADD COLUMN wedding_venue VARCHAR(150) NOT NULL DEFAULT ''");
                }
                if (!in_array('guest_count', $columns)) {
                    mysqli_query($conn, "ALTER TABLE tblweddingbook ADD COLUMN guest_count INT(11) NOT NULL DEFAULT 0");
                }
                if (!in_array('package_selected', $columns)) {
                    mysqli_query($conn, "ALTER TABLE tblweddingbook ADD COLUMN package_selected VARCHAR(100) NOT NULL DEFAULT 'Standard'");
                }
                if (!in_array('wedding_theme', $columns)) {
                    mysqli_query($conn, "ALTER TABLE tblweddingbook ADD COLUMN wedding_theme VARCHAR(100) NOT NULL DEFAULT 'Classic'");
                }
                if (!in_array('special_requests', $columns)) {
                    mysqli_query($conn, "ALTER TABLE tblweddingbook ADD COLUMN special_requests TEXT NOT NULL");
                }
                if (!in_array('status', $columns)) {
                    mysqli_query($conn, "ALTER TABLE tblweddingbook ADD COLUMN status ENUM('Pending','Confirmed','Cancelled') NOT NULL DEFAULT 'Pending'");
                }

                $bride = mysqli_real_escape_string($conn, $bride);
                $groom = mysqli_real_escape_string($conn, $groom);
                $email = mysqli_real_escape_string($conn, $email);
                $phone = mysqli_real_escape_string($conn, $phone);
                $wedding_date = mysqli_real_escape_string($conn, $wedding_date);
                $wedding_type = (int)$wedding_type;
                $wedding_venue = mysqli_real_escape_string($conn, $wedding_venue);
                $guest_count = (int)$guest_count;
                $package_selected = mysqli_real_escape_string($conn, $package_selected);
                $wedding_theme = mysqli_real_escape_string($conn, $wedding_theme);
                $special_requests = mysqli_real_escape_string($conn, $special_requests);

                $query = "INSERT INTO tblweddingbook (user_id, bride, groom, wedding_date, wedding_type, user_email, organizer_id, contact_phone, wedding_venue, guest_count, package_selected, wedding_theme, special_requests, status) ";
                $query .= "VALUES (0, '$bride', '$groom', '$wedding_date', $wedding_type, '$email', 0, '$phone', '$wedding_venue', $guest_count, '$package_selected', '$wedding_theme', '$special_requests', 'Pending')";

                if (mysqli_query($conn, $query)) {
                    $success = true;
                    $message = 'Booking successful! Your reservation has been saved.';
                    $_SESSION['booking_id'] = mysqli_insert_id($conn);
                    $bookingData = compact('bride', 'groom', 'email', 'phone', 'wedding_date', 'wedding_type', 'wedding_venue', 'guest_count', 'package_selected', 'wedding_theme', 'special_requests');
                } else {
                    $message = 'Error: ' . mysqli_error($conn);
                }

                mysqli_close($conn);
            } else {
                $message = 'Database connection failed.';
            }
        }
    } else {
        $message = 'Please complete all required fields.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Book Your Wedding</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-PLACEHOLDER" crossorigin="anonymous">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial; background: #f5f5f5; }
        .nav { background: white; padding: 15px 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .nav a { color: #6f42c1; text-decoration: none; margin-right: 20px; }
        .container { max-width: 600px; margin: 40px auto; padding: 20px; }
        .form-box { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .form-box h1 { color: #6f42c1; margin-bottom: 20px; text-align: center; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; color: #333; font-weight: 500; }
        input, select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px; }
        input:focus, select:focus { outline: none; border-color: #6f42c1; box-shadow: 0 0 0 3px rgba(111,66,193,0.1); }
        button { width: 100%; padding: 12px; background: #6f42c1; color: white; border: none; border-radius: 5px; font-size: 16px; font-weight: 600; cursor: pointer; margin-top: 10px; }
        button:hover { background: #5a2fa0; }
        .message { padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .error { background: #ffebee; color: #c62828; border-left: 4px solid #c62828; }
        .success { background: #e8f5e9; color: #2e7d32; border-left: 4px solid #2e7d32; }
        .back { text-align: center; margin-top: 20px; }
        .back a { color: #6f42c1; text-decoration: none; }
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
                    <input type="text" id="bride" name="bride" class="form-control" value="<?= htmlspecialchars($bride ?? '') ?>" required>
                </div>

                <div class="form-group">
                    <label for="groom">Groom Name *</label>
                    <input type="text" id="groom" name="groom" class="form-control" value="<?= htmlspecialchars($groom ?? '') ?>" required>
                </div>

                <div class="row gy-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($email ?? '') ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Phone *</label>
                            <input type="text" id="phone" name="phone" class="form-control" placeholder="09xxxxxxx" value="<?= htmlspecialchars($phone ?? '') ?>" required>
                        </div>
                    </div>
                </div>

                <div class="row gy-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="wedding_date">Wedding Date *</label>
                            <input type="date" id="wedding_date" name="wedding_date" class="form-control" value="<?= htmlspecialchars($wedding_date ?? '') ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="guest_count">Guest Count *</label>
                            <input type="number" id="guest_count" name="guest_count" class="form-control" min="1" value="<?= htmlspecialchars($guest_count ?? '') ?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="wedding_type">Wedding Type *</label>
                    <select id="wedding_type" name="wedding_type" class="form-control" required>
                        <option value="">Select Type</option>
                        <?php foreach ($weddingTypes as $key => $type): ?>
                            <option value="<?= $key ?>" <?= ($wedding_type === $key ? 'selected' : '') ?>><?= htmlspecialchars($type) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="wedding_venue">Wedding Venue *</label>
                    <input type="text" id="wedding_venue" name="wedding_venue" class="form-control" value="<?= htmlspecialchars($wedding_venue ?? '') ?>" required>
                </div>

                <div class="row gy-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="package_selected">Package</label>
                            <select id="package_selected" name="package_selected" class="form-control">
                                <?php foreach (['Standard', 'Premium', 'Deluxe', 'Wedding Plus'] as $package): ?>
                                    <option value="<?= htmlspecialchars($package) ?>" <?= (isset($package_selected) && $package_selected === $package ? 'selected' : '') ?>><?= htmlspecialchars($package) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="wedding_theme">Theme</label>
                            <input type="text" id="wedding_theme" name="wedding_theme" class="form-control" placeholder="Romantic, Modern, Vintage" value="<?= htmlspecialchars($wedding_theme ?? '') ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="special_requests">Special Requests</label>
                    <textarea id="special_requests" name="special_requests" class="form-control" rows="4" placeholder="Let us know any special requests"><?= htmlspecialchars($special_requests ?? '') ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100">Book Now</button>
            </form>
            <?php else: ?>
            <div class="booking-id">
                <p>✅ Your booking has been confirmed!</p>
                <p><strong>Booking ID:</strong> <?= $_SESSION['booking_id'] ?? 'N/A' ?></p>
                <?php if ($bookingData): ?>
                    <p><strong>Wedding Date:</strong> <?= htmlspecialchars($bookingData['wedding_date']) ?></p>
                    <p><strong>Venue:</strong> <?= htmlspecialchars($bookingData['wedding_venue']) ?></p>
                    <p><strong>Guests:</strong> <?= htmlspecialchars($bookingData['guest_count']) ?></p>
                    <p><strong>Package:</strong> <?= htmlspecialchars($bookingData['package_selected']) ?></p>
                <?php endif; ?>
                <p>We will contact you shortly with confirmation details.</p>
            </div>
            <div class="back">
                <a href="index.php">Return to Home</a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
