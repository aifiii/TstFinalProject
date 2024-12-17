<?php
include('../includes/db.php');
include('../includes/session.php');
checkLogin();

$course_id = 1; // ID kursus pertama
$query = "SELECT * FROM courses WHERE id = '$course_id'";
$result = mysqli_query($conn, $query);
$course = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $course['course_name']; ?></title>
</head>
<body>

<?php include('../includes/header.php'); ?>

<h1><?php echo $course['course_name']; ?></h1>
<p><?php echo $course['course_description']; ?></p>

<!-- Tugas untuk mengunduh atau mengunggah -->
<h2>Assignments</h2>
<ul>
    <?php
    $query = "SELECT * FROM assignments WHERE course_id = '$course_id'";
    $assignments = mysqli_query($conn, $query);
    while ($assignment = mysqli_fetch_assoc($assignments)) {
        echo "<li><a href='../tasks/download-task.php?id={$assignment['id']}'>Download Task: {$assignment['task_name']}</a></li>";
    }
    ?>
</ul>

<!-- Form untuk mengunggah tugas -->
<h2>Upload Your Assignment</h2>
<form action="../tasks/submit-task.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="task_file" required>
    <input type="submit" value="Upload Assignment">
</form>

<?php include('../includes/footer.php'); ?>
</body>
</html>
