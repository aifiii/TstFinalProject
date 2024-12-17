<?php
include('../includes/db.php');
include('../includes/session.php');
checkLogin();

$task_id = $_GET['id'];
$query = "SELECT * FROM assignments WHERE id = '$task_id'";
$result = mysqli_query($conn, $query);
$task = mysqli_fetch_assoc($result);

if ($task) {
    $task_path = $task['task_file_path'];
    if (file_exists($task_path)) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($task_path) . '"');
        readfile($task_path);
    } else {
        echo "File not found.";
    }
} else {
    echo "Invalid task.";
}
?>
