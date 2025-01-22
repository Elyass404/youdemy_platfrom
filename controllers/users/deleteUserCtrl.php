<?php
session_start();
use Config\Connection;
use Models\Admin;
require __DIR__ . '/../../vendor/autoload.php';

$database = new Connection();
$db = $database->getConnection();
$Message = '';

// Initialize Admin object
$adminObj = new Admin($db);

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $userId = $_GET['id']; 

    // If ID is invalid
    if ($userId <= 0) {
        $_SESSION['message'] = "Invalid course ID.";
        echo '<script type="text/javascript"> window.history.back(); </script>';
        exit;
    }


$conditions = ["id" => $userId];

if ($adminObj->deleteUser($conditions)) {
    $_SESSION['message'] = "User Deleted successfully.";
    echo '<script type="text/javascript"> window.history.back(); </script>';
    exit;
    
} else {
    $_SESSION['message'] = "Failed to Delete User.";
    echo '<script type="text/javascript"> window.history.back(); </script>';
    exit;
}
}else {
    
    $_SESSION['message'] = "User ID is missing or invalid.";
    echo '<script type="text/javascript"> window.history.back(); </script>';
    exit;
}


?>
