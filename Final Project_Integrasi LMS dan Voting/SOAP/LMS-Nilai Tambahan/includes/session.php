<?php
session_start(); // Memulai sesi pengguna

// Fungsi untuk memeriksa apakah pengguna sudah login
function checkLogin() {
    if (!isset($_SESSION['user'])) {
        header("Location: login.php"); // Arahkan ke halaman login jika belum login
        exit();
    }
}

// Fungsi untuk logout pengguna
function logout() {
    session_unset(); // Menghapus semua variabel sesi
    session_destroy(); // Menghancurkan sesi
    header("Location: login.php"); // Arahkan ke halaman login setelah logout
}
?>
