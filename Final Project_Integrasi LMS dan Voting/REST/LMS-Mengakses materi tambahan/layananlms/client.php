<?php

$method = "GET";  // Metode HTTP yang digunakan
$url = 'http://localhost/layananlms/server.php/getMateriTambahan';  // URL Web Service dengan query parameters

$options = array(
    CURLOPT_CUSTOMREQUEST => $method,  // Metode GET
    CURLOPT_URL => $url,  // Endpoint API dengan parameter
    CURLOPT_RETURNTRANSFER => true,  // Mengembalikan hasil curl_exec() sebagai string
    CURLOPT_HTTPHEADER => array('Content-Type: application/json'),  // Header tipe JSON
    CURLOPT_SSL_VERIFYPEER => false  // Nonaktifkan verifikasi SSL
);

// Inisialisasi sesi cURL
$ch = curl_init();
curl_setopt_array($ch, $options);

// Eksekusi permintaan dan simpan hasilnya
$result = curl_exec($ch);

// Periksa apakah permintaan berhasil
if (curl_errno($ch)) {
    // Jika ada error, tampilkan pesan error
    echo 'Error:' . curl_error($ch);
} else {
    // Menampilkan hasil JSON yang diterima dari server
    echo "Response dari Server:\n";
    echo $result;
}

// Tutup sesi cURL
curl_close($ch);

?>
