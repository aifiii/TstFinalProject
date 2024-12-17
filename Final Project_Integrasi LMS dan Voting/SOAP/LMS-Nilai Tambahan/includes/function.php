<?php

// Fungsi untuk validasi email
function validateEmail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

// Fungsi untuk format waktu
function formatTime($timestamp) {
    return date("d-m-Y H:i", strtotime($timestamp)); // Mengubah format tanggal dan waktu
}

// Fungsi untuk mengamankan input pengguna dari XSS
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Fungsi untuk meng-hash password
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}
?>
