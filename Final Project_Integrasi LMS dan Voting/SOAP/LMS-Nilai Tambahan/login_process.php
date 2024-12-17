<?php
session_start(); // Start the session

// Check if the form was submitted with username and password
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Load the user data from users.json file
    $json_data = file_get_contents('users.json');
    $users = json_decode($json_data, true); // Decode JSON to PHP array

    // Flag to check if login is successful
    $login_success = false;

    // Loop through the users to check if the username and nim match
    foreach ($users as $user) {
        if ($user['username'] == $username && $user['nim'] == $password) { // Check username and nim
            // If credentials match, set session variables and break out of loop
            $_SESSION['username'] = $user['username'];
            $_SESSION['name'] = $user['name'];
            $login_success = true;
            break;
        }
    }

    // If login is successful, redirect to the courses page
    if ($login_success) {
        header('Location: courses.php'); // Redirect to courses page
        exit;
    } else {
        // If login fails, show an error message
        $_SESSION['error_message'] = 'Invalid username or NIM!';
        header('Location: login.php'); // Redirect back to the login page
        exit;
    }
}
?>
