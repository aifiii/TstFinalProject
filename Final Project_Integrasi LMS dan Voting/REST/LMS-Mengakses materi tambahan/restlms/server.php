<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json");

// Aktifkan debugging untuk membantu menemukan error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Hanya izinkan metode GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['userId']) && !empty($_GET['userId'])) {
        $userId = $_GET['userId'];

        // Pemanggilan SOAP untuk cek status voting
        try {
            $soapClient = new SoapClient(null, [
                'location' => "http://localhost/restlms/soap_server.php", // Pastikan URL ini benar
                'uri' => "http://localhost/restlms/soap_server.php"
            ]);

            // Panggil metode SOAP 'checkVotingStatus'
            $result = $soapClient->__soapCall('checkVotingStatus', [$userId]);
            
            if ($result['hasVoted']) {
                // Siswa telah voting, beri akses ke materi tambahan
                $response = [
                    "userId" => $userId,
                    "accessGranted" => true,
                    "message" => "Akses ke materi tambahan diberikan.",
                    "status" => "success"
                ];
            } else {
                // Siswa belum voting
                $response = [
                    "userId" => $userId,
                    "accessGranted" => false,
                    "message" => "Anda belum melakukan voting. Harap voting terlebih dahulu.",
                    "status" => "info"
                ];
            }
        } catch (Exception $e) {
            // Tangani error SOAP
            $response = [
                "message" => "Kesalahan pada SOAP service: " . $e->getMessage(),
                "status" => "error"
            ];
        }
    } else {
        $response = [
            "message" => "Parameter userId tidak valid atau kosong.",
            "status" => "error"
        ];
    }

    echo json_encode($response);
} else {
    http_response_code(405);
    echo json_encode([
        "message" => "Metode tidak diizinkan. Gunakan metode GET.",
        "status" => "error"
    ]);
}
?>