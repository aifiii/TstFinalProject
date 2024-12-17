<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan LMS</title>
</head>
<body>
    <h1>Selamat Datang di Layanan LMS</h1>
    <p>Silakan pilih opsi berikut:</p>
    <ul>
        <?php if (!isset($_SESSION['user_id'])): ?>
            <!-- Tampilkan opsi login dan registrasi jika belum login -->
            <li><a href="loginUser.php">Login</a></li>
            <li><a href="registrasiUser.php">Registrasi</a></li>
        <?php else: ?>
            <!-- Tampilkan opsi dashboard jika sudah login -->
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        <?php endif; ?>
    </ul>
</body>
</html>