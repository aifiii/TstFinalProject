<?php
session_start();

if (!isset($_SESSION['username'])) {
    // Jika pengguna belum login, arahkan ke halaman login
    header('Location: login.php');
    exit;
}

// Mendapatkan ID kursus dari query string
$courseId = isset($_GET['course']) ? $_GET['course'] : null;

// Cek apakah courseId valid
if ($courseId === null) {
    // Jika tidak ada ID kursus, arahkan kembali ke daftar kursus
    header('Location: courses.php');
    exit;
}

// Detail kursus berdasarkan ID
$courses = [
    1 => ['title' => 'Introduction to Programming', 'materi' => 'materi-course1.txt', 'tugas' => 'tugas-course1.txt'],
    2 => ['title' => 'Data Structures', 'materi' => 'materi-course2.txt', 'tugas' => 'tugas-course2.txt']
];

// Pastikan kursus yang diminta ada dalam array
$course = isset($courses[$courseId]) ? $courses[$courseId] : null;

if ($course === null) {
    // Jika kursus tidak ditemukan, arahkan kembali ke daftar kursus
    header('Location: courses.php');
    exit;
}

// Variabel untuk status tugas dan voting
$taskUploaded = true; 
$hasVoted = true; 
$voteWinner = true; 

// Nilai asli siswa (misalnya dari database)
$originalScore = 60;

// Menambahkan nilai tambahan jika tugas diunggah dan siswa menang voting
$bonusPoints = 0;
if ($taskUploaded && $hasVoted && $voteWinner) {
    $bonusPoints = 20; // Nilai tambahan jika menang voting
}

// Menghitung total nilai (nilai asli + nilai tambahan)
$totalScore = $originalScore + $bonusPoints;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details: <?php echo $course['title']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">LMS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="courses.php">Back to Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2><?php echo $course['title']; ?></h2>

    <div class="mt-4">
        <h4>Materi</h4>
        <a href="uploads/<?php echo $course['materi']; ?>" class="btn btn-info" download>Download Materi</a>
    </div>

    <div class="mt-4">
        <h4>Tugas</h4>
        <a href="uploads/<?php echo $course['tugas']; ?>" class="btn btn-info" download>Download Tugas</a>
    </div>

    <div class="mt-4">
        <h4>Upload Tugas</h4>
        <form action="submit-task.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="taskFile" class="form-label">Choose a file</label>
                <input type="file" class="form-control" id="taskFile" name="taskFile" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload Tugas</button>
        </form>
    </div>

    <!-- Menampilkan informasi nilai tambahan jika menang voting dan tugas sudah diunggah -->
    <?php if ($taskUploaded && $hasVoted): ?>
        <div class="mt-4 card p-3 bg-light">
            <h4>Status Voting:</h4>
            <?php if ($voteWinner): ?>
                <p class="text-success">Congratulations! You won the voting and received <?php echo $bonusPoints; ?> bonus points!</p>
            <?php else: ?>
                <p class="text-danger">Sorry, you lost the voting. No bonus points awarded.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- Menampilkan nilai asli dan nilai total -->
    <div class="mt-4 card p-3 bg-light">
        <h4>Nilai Anda:</h4>
        <p>Nilai Asli: <strong><?php echo $originalScore; ?></strong></p>
        <p>Nilai Tambahan: <strong><?php echo $bonusPoints; ?></strong></p>
        <h5>Total Nilai: <strong><?php echo $totalScore; ?></strong></h5>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
