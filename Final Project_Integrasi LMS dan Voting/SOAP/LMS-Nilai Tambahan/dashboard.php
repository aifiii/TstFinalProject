<?php
session_start();
if (!isset($_SESSION['user'])) {
    // Jika pengguna belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

<h2>Welcome, <?php echo $user['username']; ?>!</h2>
<p>Welcome to your dashboard.</p>

<!-- Konten dashboard lainnya -->

<a href="logout.php">Logout</a>

</body>
</html>
