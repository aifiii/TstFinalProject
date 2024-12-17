<?php
session_start();
require 'koneksiDatabase.php';

// Pastikan user sudah login dan memiliki session user_id
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Cek status voting pengguna
$stmt = $pdo->prepare("SELECT voting_status FROM users WHERE id = :id");
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch();

if (!$user['voting_status']) {
    echo "Anda harus melakukan voting terlebih dahulu untuk mengakses materi tambahan.";
} else {
    // Menampilkan materi tambahan setelah user melakukan voting
    $stmt = $pdo->query("SELECT * FROM materi");
    while ($materi = $stmt->fetch()) {
        // Menampilkan title dan content dari materi
        echo "<h3>{$materi['title']}</h3>";
        echo "<p>{$materi['content']}</p>";
    }
}
?>
