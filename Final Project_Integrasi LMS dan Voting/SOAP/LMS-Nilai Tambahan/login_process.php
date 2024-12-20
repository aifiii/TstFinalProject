<?php
session_start(); // Start the session

// Sanitasi Input dengan Fungsi sanitize_input()
function sanitize_input($data) {
    return htmlspecialchars(trim($data)); // Remove unnecessary spaces and prevent XSS
}

//  Logging Aktivitas dengan Fungsi log_activity()
function log_activity($message) {
    $log_file = 'activity_log.txt'; // Path to your log file
    $timestamp = date("Y-m-d H:i:s"); // Current timestamp
    $log_message = "[$timestamp] $message\n";
    file_put_contents($log_file, $log_message, FILE_APPEND); // Append log message to the file
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    // Sanitize input to prevent malicious data
    $username = sanitize_input($_POST['username']);
    $password = sanitize_input($_POST['password']);

    // Validasi Kredensial dari File JSON
    $json_data = file_get_contents('users.json');
    $users = json_decode($json_data, true); // Decode JSON to PHP array

    // Flag to check if login is successful
    $login_success = false;

    // Loop through the users to check if the username and nim match
    foreach ($users as $user) {
        // Check if the username and password match
        if ($user['username'] == $username && $user['nim'] == $password) {
            // If credentials match, set session variables and break out of loop
            $_SESSION['username'] = $user['username'];
            $_SESSION['name'] = $user['name'];
            $login_success = true;

            // Log successful login activity
            log_activity("User '$username' successfully logged in.");
            break;
        }
    }

    // Penggunaan Session untuk Otentikasi 
    if ($login_success) {
        // Regenerate session ID to prevent session fixation attacks
        session_regenerate_id(true);

        // Redirect to the courses page
        header('Location: courses.php'); // Redirect to courses page
        exit;
    } else {
        //  Pengelolaan Pesan Error
        $_SESSION['error_message'] = 'Invalid username or NIM!';

        // Log failed login attempt
        log_activity("Failed login attempt for username '$username'.");

        header('Location: login.php'); // Redirect back to the login page
        exit;
    }
}
?>
