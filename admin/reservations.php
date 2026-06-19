<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}
$conn = mysqli_connect('db', 'root', 'wedding123', 'wedding_db');
if (!$conn) die('DB Error');

$allowedStatuses = ['Pending', 'Confirmed', 'Cancelled'];
$statusFilter = in_array($_GET['status'] ?? '', $allowedStatuses) ? $_GET['status'] : '';
$typeFilter = isset($_GET['type']) ? (int)$_GET['type'] : 0;

$where = [];
if ($statusFilter) {
    $statusSafe = mysqli_real_escape_string($conn, $statusFilter);
    $where[] = "status = '$statusSafe'";
}
if ($typeFilter > 0) {
    $where[] = "wedding_type = $typeFilter";
}
$whereSql = $where ? 'WHERE ' . implode(' AND ', $where) : '';

$weddingTypes = [
    1 => 'Garden Wedding',
    2 => 'Beach Wedding',
    3 => 'Modern Wedding',
    4 => 'Traditional Wedding',
    5 => 'Luxury Palace'
];

$query = "SELECT booking_id, bride, groom, wedding_date, wedding_type, user_email, contact_phone, wedding_venue, guest_count, package_selected, wedding_theme, special_requests, status FROM tblweddingbook $whereSql ORDER BY booking_id DESC";
$result = mysqli_query($conn, $query);
$bookings = [];
while ($row = mysqli_fetch_assoc($result)) {
    $bookings[] = $row;
}

$statsQuery = "SELECT 
    COUNT(*) AS total,
    SUM(status = 'Pending') AS pending_count,
    SUM(status = 'Confirmed') AS confirmed_count,
    SUM(status = 'Cancelled') AS cancelled_count,
    SUM(guest_count) AS total_guests,
    SUM(STR_TO_DATE(wedding_date, '%Y-%m-%d') >= CURDATE()) AS upcoming_count
FROM tblweddingbook";
$stats = mysqli_fetch_assoc(mysqli_query($conn, $statsQuery));

mysqli_close($conn);
$total = (int)$stats['total'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Reservations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-PLACEHOLDER" crossorigin="anonymous">
    <style>
        body{font-family:Arial;background:#f5f5f5;margin:0}
        .header{background:#6f42c1;color:white;padding:20px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap}
        .header .logout-link{color:white;text-decoration:none}
        .header .logout-link:hover{text-decoration:underline}
        .container{max-width:1400px;margin:20px auto;padding:20px}
        .stats-card{border-radius:12px;box-shadow:0 10px 30px rgba(15,23,42,.08)}
        .table-responsive{background:white;border-radius:12px;overflow:hidden;box-shadow:0 10px 30px rgba(15,23,42,.08)}
        .badge-status-pending{background:#fcd34d;color:#92400e}
        .badge-status-confirmed{background:#86efac;color:#166534}
        .badge-status-cancelled{background:#fecaca;color:#991b1b}
    </style>
</head>
<body>
<div class="header">
    <div>
        <h1 class="h3">Admin Reservations</h1>
        <p class="mb-0">Manage all wedding bookings and monitor reservation status.</p>
    </div>
    <div>
        <a href="logout.php" class="logout-link btn btn-outline-light btn-sm">Logout</a>
    </div>
</div>
<div class="container">
    <div class="row g-3 mb-3">
        <div class="col-md-3">
            <div class="p-4 bg-white stats-card">
                <h6>Total Bookings</h6>
                <p class="display-6 mb-0"><?= $stats['total'] ?></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-4 bg-white stats-card">
                <h6>Pending</h6>
                <p class="display-6 mb-0"><?= $stats['pending_count'] ?></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-4 bg-white stats-card">
                <h6>Confirmed</h6>
                <p class="display-6 mb-0"><?= $stats['confirmed_count'] ?></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-4 bg-white stats-card">
                <h6>Upcoming</h6>
                <p class="display-6 mb-0"><?= $stats['upcoming_count'] ?></p>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form class="row g-3" method="GET">
                <div class="col-md-4">
                    <label for="status" class="form-label">Status filter</label>
                    <select id="status" name="status" class="form-select">
                        <option value="">All Statuses</option>
                        <?php foreach ($allowedStatuses as $status): ?>
                            <option value="<?= htmlspecialchars($status) ?>" <?= ($statusFilter === $status ? 'selected' : '') ?>><?= htmlspecialchars($status) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="type" class="form-label">Wedding type</label>
                    <select id="type" name="type" class="form-select">
                        <option value="0">All Types</option>
                        <?php foreach ($weddingTypes as $key => $type): ?>
                            <option value="<?= $key ?>" <?= ($typeFilter === $key ? 'selected' : '') ?>><?= htmlspecialchars($type) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                    <a href="reservations.php" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <?php if ($total > 0): ?>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-secondary">
                    <tr>
                        <th>ID</th>
                        <th>Bride</th>
                        <th>Groom</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Venue</th>
                        <th>Guests</th>
                        <th>Package</th>
                        <th>Theme</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $b): ?>
                        <tr>
                            <td><?= htmlspecialchars($b['booking_id']) ?></td>
                            <td><?= htmlspecialchars($b['bride']) ?></td>
                            <td><?= htmlspecialchars($b['groom']) ?></td>
                            <td><?= htmlspecialchars($b['user_email']) ?></td>
                            <td><?= htmlspecialchars($b['contact_phone'] ?? '') ?></td>
                            <td><?= htmlspecialchars($b['wedding_date']) ?></td>
                            <td><?= htmlspecialchars($weddingTypes[$b['wedding_type']] ?? 'Other') ?></td>
                            <td><?= htmlspecialchars($b['wedding_venue'] ?? '') ?></td>
                            <td><?= htmlspecialchars($b['guest_count'] ?? 0) ?></td>
                            <td><?= htmlspecialchars($b['package_selected'] ?? '') ?></td>
                            <td><?= htmlspecialchars($b['wedding_theme'] ?? '') ?></td>
                            <td>
                                <?php $status = $b['status'] ?? 'Pending'; ?>
                                <span class="badge <?= $status === 'Confirmed' ? 'badge-status-confirmed' : ($status === 'Cancelled' ? 'badge-status-cancelled' : 'badge-status-pending') ?>">
                                    <?= htmlspecialchars($status) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-light text-center">No reservations found.</div>
    <?php endif; ?>

    <div class="mt-4">
        <a href="dashboard.php" class="btn btn-secondary">Dashboard</a>
        <a href="/" class="btn btn-outline-secondary">Home</a>
    </div>
</div>
</body>
</html>
