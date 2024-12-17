<?php
// Mengganti db.php dengan pengolahan file JSON

function getUsers() {
    $file = 'users.json';  // Lokasi file JSON yang menyimpan data pengguna
    if (!file_exists($file)) {
        return [];  // Mengembalikan array kosong jika file tidak ditemukan
    }
    
    $data = file_get_contents($file);  // Membaca konten file JSON
    return json_decode($data, true);  // Mengembalikan data sebagai array
}
?>
