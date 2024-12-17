<?php
include('../includes/db.php');
include('../includes/session.php');
checkLogin();

$query = "SELECT * FROM grades WHERE user_id = '{$_SESSION['user']['id']}'";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Grades</title>
</head>
<body>

<?php include('../includes/header.php'); ?>

<h1>Your Grades</h1>
<table>
    <tr>
        <th>Course</th>
        <th>Grade</th>
    </tr>
    <?php
    while ($grade = mysqli_fetch_assoc($result)) {
        echo "<tr><td>{$grade['course_name']}</td><td>{$grade['grade']}</td></tr>";
    }
    ?>
</table>

<?php include('../includes/footer.php'); ?>
</body>
</html>
