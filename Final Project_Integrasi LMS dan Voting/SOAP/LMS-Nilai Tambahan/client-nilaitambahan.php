<?php
class NilaiTambahan {
    private $history = [];  // Menyimpan history nilai tambahan

    public function getNilaiTambahan($voteMenang) {
        $initialScore = 60;
        if ($voteMenang) {
            $finalScore = $initialScore + 20;
            $this->history[] = ["voteMenang" => true, "finalScore" => $finalScore];
            return "Vote Anda menang! Nilai akhir Anda adalah: " . $finalScore;
        } else {
            $this->history[] = ["voteMenang" => false, "finalScore" => $initialScore];
            return "Vote Anda tidak menang. Nilai Anda tetap: " . $initialScore;
        }
    }

    // Menambahkan metode untuk mengambil history
    public function getHistory() {
        return $this->history;
    }
}

// Cek apakah request yang diterima adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    $nimSiswa = isset($_POST['nim']) ? $_POST['nim'] : '';

    // Simulasi data history untuk NIM
    $historyData = [
        '225150607111010' => [
            ['voteMenang' => true, 'finalScore' => 85],
            ['voteMenang' => false, 'finalScore' => 70]
        ],
        '225150601111002' => [
            ['voteMenang' => true, 'finalScore' => 90],
            ['voteMenang' => true, 'finalScore' => 92]
        ]
    ];

    if ($action === 'getHistory' && $nimSiswa) {
        if (isset($historyData[$nimSiswa])) {
            echo json_encode($historyData[$nimSiswa]);
        } else {
            echo json_encode([]);
        }
    } else {
        echo json_encode(['error' => 'Invalid action or missing NIM']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
