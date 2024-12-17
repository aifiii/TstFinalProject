<?php

class Kelas {
    /**
     * Mengecek apakah siswa terdaftar dalam kelas
     * @param string $nisn
     * @return bool
     */
    public function cekKelas($nisn) {
        // Simulasi data NISN yang terdaftar
        $siswaTerdaftar = ["12345", "67890", "11223"];
        return in_array($nisn, $siswaTerdaftar);
    }
}
?>
