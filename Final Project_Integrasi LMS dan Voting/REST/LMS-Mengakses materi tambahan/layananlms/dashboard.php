<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

echo "<a href='voting.php'>Voting</a><br>";
echo "<a href='materiTambahan.php'>Materi Tambahan</a><br>";
?>