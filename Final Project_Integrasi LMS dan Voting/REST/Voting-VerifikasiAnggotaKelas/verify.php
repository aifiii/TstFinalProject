<?php
// Set Header JSON
header("Content-Type: application/json");

// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "vote1");

// Ambil data dari body request
$input = json_decode(file_get_contents("php://input"), true);
$nim = isset($input['nim']) ? $input['nim'] : null;

// Validasi input
if (!$nim) {
    $response = [
        "status" => "failed",
        "message" => "NIM is required",
        "eligible" => false
    ];
    echo json_encode($response);
    exit;
}

// Fungsi verifikasi keanggotaan
function verifyMembership($conn, $nim) {
    $query = "SELECT nim FROM lms_students WHERE nim = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nim);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

// Proses verifikasi
if (verifyMembership($conn, $nim)) {
    $response = [
        "status" => "success",
        "message" => "Silahkan melakukan voting",
        "eligible" => true
    ];
} else {
    $response = [
        "status" => "failed",
        "message" => "Anda tidak memenuhi syarat untuk voting",
        "eligible" => false
    ];
}

// Kirim respon dalam format JSON
echo json_encode($response);
?>
