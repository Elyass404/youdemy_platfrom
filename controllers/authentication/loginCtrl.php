<?php
session_start();

use Config\Connection;
use Models\Auth;
require __DIR__.'/../../vendor/autoload.php';

$database = new Connection();
$db = $database->getConnection();

$loginObj = new Auth($db);
$Message = '';

// Check if email and password are set and not empty
if (!isset($_POST['email'], $_POST['password']) || empty($_POST['email']) || empty($_POST['password'])) {
    $_SESSION['message'] = "Email and password are required!";
    header("Location: ../../views/users/login.php");
    exit;
}

// Sanitize email input and trim any spaces
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$password = trim($_POST['password']);

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['message'] = "Invalid email format!";
    header("Location: ../../views/users/login.php");
    exit;
}

// login the user 
$user = $loginObj->login($email, $password);

// Check if the user exists and password matches
if ($user && password_verify($password, $user['password'])) {
    
    // Regenerate session ID to prevent session fixation attacks
    session_regenerate_id();

    // Store user information in session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['username'] = $user['name'];

    // Redirect based on role
    if ($_SESSION['role'] == "Admin" || $_SESSION['role'] == "Teacher") {
        header("Location: ../../views/admin/dashboard.php");
        exit;
    } elseif ($_SESSION['role'] == "Student") {
        header("Location: ../../views/users/courses_catalog.php");
        exit;
    }
} else {
    // If login failed, set an error message
    $_SESSION['message'] = "Invalid credentials. Please try again.";
    header("Location: ../../views/users/login.php");
    exit;
}

?>
