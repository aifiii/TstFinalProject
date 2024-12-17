<?php
session_start();
include('includes/Authentication.php');
include('db.php');

$auth = new Authentication($db);
$auth->logout();

header('Location: index.php'); // Redirect ke halaman utama setelah logout
exit();
?>
