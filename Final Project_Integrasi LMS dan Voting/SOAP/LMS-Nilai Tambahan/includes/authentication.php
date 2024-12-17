<?php
class Authentication {
    // Fungsi untuk login
    public function login($username, $password) {
        global $db; // Menggunakan koneksi database yang didefinisikan di db.php
        
        // Menghindari SQL Injection dengan menggunakan mysqli_real_escape_string
        $username = mysqli_real_escape_string($db, $username);
        $password = mysqli_real_escape_string($db, $password);

        // Query untuk mencari pengguna di database
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = $db->query($query);

        // Memeriksa apakah pengguna ditemukan
        if ($result->num_rows > 0) {
            // Login berhasil, mengembalikan data pengguna
            return $result->fetch_assoc();
        } else {
            // Login gagal, mengembalikan false
            return false;
        }
    }
}
?>
