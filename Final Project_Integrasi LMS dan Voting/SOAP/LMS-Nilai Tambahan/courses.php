<?php
session_start(); // Memulai session

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Daftar kursus yang tersedia
$courses = [
    ['id' => 1, 'title' => 'Course 1: Introduction to Programming'],
    ['id' => 2, 'title' => 'Course 2: Data Structures']
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f4f9; }
        .navbar { background-color: #343a40; }
        .navbar a { color: white; }
        .course-list { margin-top: 30px; }
        .course-card { margin-bottom: 15px; }
        .course-card a { text-decoration: none; }
        .logout-btn { margin-top: 20px; }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">LMS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="courses.php">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container course-list">
    <!-- Welcome message with user's name -->
    <h2 class="mt-5">Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
    <h3 class="mt-3">Available Courses</h3>

    <div class="row">
        <!-- Displaying available courses -->
        <?php foreach ($courses as $course): ?>
            <div class="col-md-4">
                <div class="card course-card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($course['title']); ?></h5>
                        <a href="student-course.php?course=<?php echo $course['id']; ?>" class="btn btn-primary">View Course</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Form untuk melihat history nilai tambahan -->
    <div class="mt-4">
        <h4>View Nilai Tambahan History</h4>
        <form id="history-form">
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" placeholder="Enter NIM">
            </div>
            <button type="button" id="his" class="btn btn-info">Get History</button>
        </form>
        <div id="output" class="mt-3"></div>
    </div>

    <!-- Logout Button -->
    <a href="logout.php" class="btn btn-danger logout-btn">Logout</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(() => {
        // Handle history request
        $('#his').on('click', () => {
            let nimSiswa = $('#nim').val();
            if (!nimSiswa) {
                $('#output').html('<p>Please enter a NIM.</p>');
                return;
            }

            $.ajax({
                url: 'client-nilaitambahan.php',
                method: 'POST',
                data: { action: 'getHistory', nim: nimSiswa },
                dataType: 'json'
            }).done((history) => {
                let html = '<h3>History Nilai Tambahan:</h3>';
                if (history && history.length > 0) {
                    history.forEach((h) => {
                        html += `<p>Vote Menang: ${h.voteMenang ? 'Yes' : 'No'}, Nilai Akhir: ${h.finalScore}</p>`;
                    });
                } else {
                    html += '<p>No history available for this NIM.</p>';
                }
                $('#output').html(html);
            }).fail((jqXHR, textStatus, errorThrown) => {
                $('#output').html(`<p>Error: ${textStatus}, ${errorThrown}</p>`);
            });
        });
    });
</script>

</body>
</html>
