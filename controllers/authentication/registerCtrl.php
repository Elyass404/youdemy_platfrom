<?php

session_start();

use Config\Connection;
use Models\Auth;
require __DIR__.'/../../vendor/autoload.php';

$database = new Connection();
$db = $database->getConnection();

$registerObj = new Auth($db);
$Message = '';

// Check if all fields are set and not empty
if (
    isset($_POST['role'], $_POST['name'], $_POST['email'], $_POST['password'], $_POST['photo'], $_POST['gender'], $_POST['bio'], $_POST['birthdate'])
    && !empty($_POST['role']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['photo']) && !empty($_POST['gender']) && !empty($_POST['bio']) && !empty($_POST['birthdate'])
) {
    // Validate the role
    if ($_POST['role'] === "student") {
        $user_status = "activated";
    } elseif ($_POST['role'] === "teacher") {
        $user_status = "pending";
    } 

    // Validate email format
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Invalid email format!";
        header('Location:../../views/users/register.php');
        exit;
    }

    // Validate the photo URL format (ensure it's a valid URL and starts with http:// or https://)
    if (!filter_var($_POST['photo'], FILTER_VALIDATE_URL)) {
        $_SESSION['message'] = "Invalid photo URL!";
        header('Location:../../views/users/register.php');
        exit;
    }

    // Sanitize user inputs
    $userData = [
        'name' => htmlspecialchars(trim($_POST['name'])),
        'email' => htmlspecialchars(trim($_POST['email'])),
        'password' => $_POST['password'],
        'role' => htmlspecialchars(trim($_POST['role'])),
        'photo' => $_POST['photo'],
        'gender' => htmlspecialchars(trim($_POST['gender'])),
        'status' => $user_status,
        'bio' => htmlspecialchars(trim($_POST['bio'])),
        'birthdate' => htmlspecialchars(trim($_POST['birthdate']))
    ];

    // Register the user
    if ($registerObj->register($userData)) {
        $_SESSION['message'] = "Congratulations, you created an account successfully!";
        header('Location:../../views/users/login.php');
    } else {
        $_SESSION['message'] = "Something went wrong, please try again!";
        header('Location:../../views/users/register.php');
    }
} else {
    $_SESSION['message'] = "All fields are required!";
    header('Location:../../views/users/register.php');
    exit;
}

?>
