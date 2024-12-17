<?php
session_start();
require 'koneksiDatabase.php';

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT voting_status FROM users WHERE id = :id");
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch();

if ($user['voting_status']) {
    echo "Anda sudah melakukan voting!";
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $stmt = $pdo->prepare("UPDATE users SET voting_status = 1 WHERE id = :id");
        $stmt->execute(['id' => $user_id]);
        echo "Voting berhasil!";
    } else {
        echo "<form method='POST'><button type='submit'>Lakukan Voting</button></form>";
    }
}
?>