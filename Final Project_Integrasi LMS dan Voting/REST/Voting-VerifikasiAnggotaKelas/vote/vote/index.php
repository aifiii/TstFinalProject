<?php
session_start();
include "navbar.php";
include "function.php";
$conn=mysqli_connect("localhost:3306","root","","vote1");
if (isset($_POST["submit"])) {
    $nisn = $_POST["nisn"];
    $login = login($nisn);
    
    // Cek apakah login mengembalikan hasil yang valid
    if (!empty($login) && isset($login[0])) {
        $newNisn = $login[0]["nisn"];
        $newStatus = $login[0]["status"];
        $status = "belum voting";

        // Periksa NISN dan Status
        if ($nisn == $newNisn && $newStatus == $status) {
            $_SESSION["nisn"] = $nisn;
            echo "
            <script>
            alert('Selamat Datang! Silahkan Melakukan Voting');
            document.location.href='voter/vote.php';
            </script>
            ";
        } else {
            echo "
            <script>
            alert('Anda belum terdaftar dalam Kelas!');
            document.location.href='index.php';
            </script>
            ";
        }
    } else {
        echo "
        <script>
        alert('NISN tidak ditemukan');
        document.location.href='index.php';
        </script>
        ";
    }
}
?>

<div class="container min-vh-100 d-flex justify-content-center align-items-center">
    <form action="" method="post" class="d-flex flex-column gap-2 shadow-4 p-5">
        <label for="nisn" class="me-2">NIM</label>
        <input type="text" id="nisn" name="nisn" placeholder="Masukan Nim" style="width: 500px;">
        <button class="btn btn-primary" type="submit" name="submit">lakukan voting</button>
    </form>
</div>