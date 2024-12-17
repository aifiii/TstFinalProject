<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'koneksiDatabase.php'; // Koneksi database

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Cek apakah username sudah ada
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        // Username sudah digunakan
        echo "Username sudah terdaftar, silakan gunakan username lain.";
    } else {
        // Tambahkan user baru ke database
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->execute(['username' => $username, 'password' => $password]);

        // Tampilkan pesan berhasil
        echo "Anda telah berhasil melakukan registrasi";
        exit; // Menghentikan eksekusi untuk memastikan tidak ada form yang ditampilkan
    }
}
?>
<form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Register</button>
</form>
