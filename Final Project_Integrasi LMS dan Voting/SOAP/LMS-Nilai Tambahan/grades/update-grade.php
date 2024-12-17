<?php
include('../includes/db.php');
include('../includes/session.php');
checkLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $grade_id = $_POST['grade_id'];
    $new_grade = $_POST['grade'];

    $query = "UPDATE grades SET grade = '$new_grade' WHERE id = '$grade_id'";
    if (mysqli_query($conn, $query)) {
        echo "Grade updated successfully.";
    } else {
        echo "Error updating grade: " . mysqli_error($conn);
    }
}
?>

<form action="update-grade.php" method="POST">
    <label for="grade_id">Grade ID:</label>
    <input type="text" name="grade_id" required><br>
    <label for="grade">New Grade:</label>
    <input type="text" name="grade" required><br>
    <input type="submit" value="Update Grade">
</form>
