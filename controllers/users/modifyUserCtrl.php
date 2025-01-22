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

// Check if user status is set and valid
if (isset($_POST['user_status']) && !empty($_POST['user_status'])) {
    // Sanitize and validate user status
    $status = filter_var($_POST['user_status'], FILTER_SANITIZE_STRING);

    // Ensure status is one of the expected values (Activated, Pending, Banned)
    if (!in_array($status, ['Activated', 'Pending', 'Banned'])) {
        $_SESSION['message'] = 'Invalid status provided.';
        echo '<script type="text/javascript"> window.history.back(); </script>';
        exit;
        
    }
} else {
    
    $_SESSION['message'] = 'User status is missing.';
        echo '<script type="text/javascript"> window.history.back(); </script>';
        exit;
}

// Ensure the user ID is valid
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $userId = $_GET['id']; 

    // If ID is invalid
    if ($userId <= 0) {
        $_SESSION['message'] = "Invalid course ID.";
        echo '<script type="text/javascript"> window.history.back(); </script>';
        exit;
    }

    // Prepare data for update
    $data = ["status" => $status];
    $conditions = ["id" => $userId];

    // Update the user status if all conditions are met
    if ($adminObj->updateUser($data, $conditions)) {
        $_SESSION['message'] = "User status updated successfully.";
        echo '<script type="text/javascript"> window.history.back(); </script>';
        exit;
        
    } else {
        $_SESSION['message'] = "Failed to update user status.";
        echo '<script type="text/javascript"> window.history.back(); </script>';
        exit;
    }
} else {
    
    $_SESSION['message'] = "User ID is missing or invalid.";
    echo '<script type="text/javascript"> window.history.back(); </script>';
    exit;
}


?>
