<?php
header("Content-Type: text/xml");

// Inisialisasi SOAP Server
$server = new SoapServer(null, ['uri' => "http://localhost/restlms/soap_server.php"]);

//layanan untuk mengechek status voting dengan id pengguna 
class VotingService {
    public function checkVotingStatus($userId) {
        // Simulasi data siswa yang sudah voting
        $votingData = [
            "235150601111003" => true,  // User sudah voting
            "235150601111010" => false, // User belum voting
        ];

        if (isset($votingData[$userId])) {
            return [
                "userId" => $userId,
                "hasVoted" => $votingData[$userId],
                "message" => $votingData[$userId]
                    ? "Siswa sudah melakukan voting."
                    : "Siswa belum melakukan voting."
            ];
        } else {
            return [
                "userId" => $userId,
                "hasVoted" => false,
                "message" => "Data siswa tidak ditemukan."
            ];
        }
    }
}

// Hubungkan kelas VotingService dengan SOAP Server
$server->setClass("VotingService");
$server->handle();
?>