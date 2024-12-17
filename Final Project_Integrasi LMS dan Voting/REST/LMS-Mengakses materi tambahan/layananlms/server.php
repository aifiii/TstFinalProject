<?php

// Mendapatkan metode HTTP yang digunakan
$method = $_SERVER['REQUEST_METHOD'];

// Mengambil path URL dan memecahnya menjadi array
$uri = isset($_SERVER['PATH_INFO']) ? explode("/", trim($_SERVER['PATH_INFO'], "/")) : [];

// Mengambil body request jika diperlukan
$body = file_get_contents("php://input");

// Fungsi untuk mengirimkan output JSON
function out($data, $status = 200) {
    http_response_code($status);
    header('content-type:application/json');
    echo json_encode($data);
    exit;
}

// Fungsi untuk menangani error jika path atau method salah
function error($message, $status = 404) {
    out(["error" => $message], $status);
}

// Menangani setiap metode HTTP
switch ($method) {
    case 'POST':
        $fun = array_shift($uri);  // Ambil endpoint dari URL
        // Parsing body JSON
        $requestData = json_decode($body, true);
        if ($fun === 'getMateriTambahan') {
            $userid = $requestData['user'] ?? null;
            $status = $requestData['status'] ?? null;
    
            if ($status === 'telahVoting') {
                $materi = getMateriTambahan();
                out($materi);  // Kirim data materi tambahan
            } else {
                out(["message" => "Anda harus melakukan voting terlebih dahulu untuk mengakses materi tambahan."], 403);
            }
        } else {
            error("Invalid endpoint for POST method");
        }
        break;
    


    // case 'GET':
    //     $fun = array_shift($uri);
    //     // Parsing body JSON jika ada
    //     $requestData = json_decode($body, true);
    //     if ($fun === 'getMateriTambahan') {
    //         $userid = $requestData['user'] ?? null;
    //         $status = $requestData['status'] ?? null;
    
    //         if ($status === 'telahVoting') {
    //             $materi = getMateriTambahan();
    //             out($materi);
    //         } else {
    //             out(["message" => "Anda harus melakukan voting terlebih dahulu untuk mengakses materi tambahan."], 403);
    //         }
    //     } else {
    //         error("Invalid endpoint for GET method");
    //     }
    //     break;

    // default:
    //     error("HTTP method not allowed", 405);  // Jika metode tidak dikenali
}

// Fungsi untuk mengambil materi tambahan
function getMateriTambahan() {
    // Contoh data statis (gunakan database pada implementasi nyata)
    return [
        [
            '{"status":"failed","message":"Anda harus melakukan voting terlebih dahulu untuk mengakses materi tambahan"c:false}',
        ]
    ];
}

?>
