<?php
session_start();

if (!isset($_SESSION['username'])) {
    // Jika pengguna belum login, arahkan ke halaman login
    header('Location: login.php');
    exit;
}

// Mengonfirmasi bahwa form telah disubmit dan file telah diupload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['taskFile'])) {
    // Mendapatkan informasi file yang diupload
    $file = $_FILES['taskFile'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    // Menentukan direktori tujuan untuk menyimpan file
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($fileName);

    // Memeriksa apakah file berhasil diupload
    if ($fileError === 0) {
        if ($fileSize < 5000000) { // Batasi ukuran file 5MB
            // Mengecek tipe file
            $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf', 'text/plain'];
            if (in_array($fileType, $allowedTypes)) {
                // Memindahkan file ke direktori tujuan
                if (move_uploaded_file($fileTmpName, $uploadFile)) {
                    // Mengupdate status unggahan tugas di database
                    // Ganti dengan kode database Anda untuk menyimpan data unggahan tugas
                    $taskUploaded = true; // Status unggahan berhasil
                    $username = $_SESSION['username'];

                    // Update status unggahan di database
                    // Asumsi Anda sudah membuat tabel untuk menyimpan status tugas
                    // Misalnya menggunakan MySQL: `UPDATE tasks SET status = 'uploaded' WHERE username = ? AND course_id = ?`
                    $courseId = $_GET['course'];
                    $db = new mysqli('localhost', 'username', 'password', 'database'); // Ganti dengan detail database Anda
                    if ($db->connect_error) {
                        die("Connection failed: " . $db->connect_error);
                    }

                    // Persiapkan query untuk memperbarui status unggahan
                    $stmt = $db->prepare("UPDATE student_tasks SET task_uploaded = 1, task_file = ? WHERE username = ? AND course_id = ?");
                    $stmt->bind_param('ssi', $uploadFile, $username, $courseId);
                    if ($stmt->execute()) {
                        echo "Tugas berhasil diunggah!";
                    } else {
                        echo "Gagal mengunggah tugas. Coba lagi.";
                    }
                    $stmt->close();
                    $db->close();
                } else {
                    echo "Terjadi kesalahan saat memindahkan file.";
                }
            } else {
                echo "Jenis file tidak diizinkan. Hanya file gambar (JPG/PNG), PDF, dan TXT yang diizinkan.";
            }
        } else {
            echo "Ukuran file terlalu besar. Maksimal 5MB.";
        }
    } else {
        echo "Terjadi kesalahan saat mengunggah file. Error code: " . $fileError;
    }
} else {
    echo "Tidak ada file yang diunggah.";
}
?>

<!-- Mengarahkan kembali ke halaman kursus setelah pengunggahan -->
<script>
    setTimeout(function() {
        window.location.href = 'student-course.php?course=<?php echo $_GET['course']; ?>';
    }, 3000); // Mengarahkan setelah 3 detik
</script>
