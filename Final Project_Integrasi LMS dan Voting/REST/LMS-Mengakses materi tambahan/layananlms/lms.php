<?php

// class lms {

//     /**
//      * @param int $user_id
//      * @return mixed
//      */
//     public function getMateriTambahan($user_id) {
//         // Mengecek status voting dari database berdasarkan user_id
//         $statusVoting = $this->checkVotingStatus($user_id);

//         // Jika user sudah melakukan voting
//         if ($statusVoting) {
//             // Mengambil materi tambahan dari database
//             $materi = $this->fetchMateriTambahan();
//             return $materi;
//         } else {
//             // Jika user belum melakukan voting, tampilkan pesan
//             return "Anda harus melakukan voting terlebih dahulu untuk mengakses materi tambahan.";
//         }
//     }

//     /**
//      * @param int $user_id
//      * @return bool
//      */
//     private function checkVotingStatus($user_id) {
//         // Koneksi ke database (misalnya menggunakan PDO)
//         $pdo = new PDO("mysql:host=localhost;dbname=lms", "root", "");
//         $stmt = $pdo->prepare("SELECT voting_status FROM users WHERE id = :user_id");
//         $stmt->execute(['user_id' => $user_id]);
//         $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
//         // Mengembalikan status voting
//         return $user['voting_status'] == 1; // Jika status voting = 1, artinya sudah voting
//     }

//     /**
//      * @return array
//      */
//     private function fetchMateriTambahan() {
//         // Koneksi ke database
//         $pdo = new PDO("mysql:host=localhost;dbname=lms", "root", "");
//         $stmt = $pdo->query("SELECT * FROM materi_tambahan");
        
//         // Mengambil semua materi tambahan
//         $materi = [];
//         while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//             $materi[] = $row;
//         }

//         // Mengembalikan materi tambahan
//         return $materi;
//     }
// }

// Class untuk mengelola LMS API
class LMS {

    /**
     * Fungsi untuk mendapatkan materi tambahan berdasarkan status voting
     * @param int $user_id
     * @return array|string
     */
    public function getMateriTambahan($user_id) {
        // Mengecek status voting dari database berdasarkan user_id
        $statusVoting = $this->checkVotingStatus($user_id);

        // Jika user sudah melakukan voting
        if ($statusVoting) {
            // Mengambil materi tambahan dari database
            $materi = $this->fetchMateriTambahan();
            return json_encode([
                'status' => 'success',
                'materi' => $materi
            ]);
        } else {
            // Jika user belum melakukan voting, tampilkan pesan
            return json_encode([
                'status' => 'error',
                'message' => 'Anda harus melakukan voting terlebih dahulu untuk mengakses materi tambahan.'
            ]);
        }
    }

    // Fungsi untuk memeriksa status voting dari pengguna
    private function checkVotingStatus($user_id) {
        // Contoh koneksi dan query untuk mendapatkan status voting
        $pdo = new PDO("mysql:host=localhost;dbname=lms", "root", "");
        $stmt = $pdo->prepare("SELECT voting_status FROM users WHERE id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user['voting_status'] == 1;
    }

    // Fungsi untuk mengambil materi tambahan dari database
    private function fetchMateriTambahan() {
        // Koneksi dan query untuk mengambil materi tambahan
        $pdo = new PDO("mysql:host=localhost;dbname=lms", "root", "");
        $stmt = $pdo->query("SELECT * FROM materi_tambahan");
        $materi = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $materi[] = $row;
        }
        return $materi;
    }
}
?>


?>
