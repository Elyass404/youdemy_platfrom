<?php
session_start();

use Config\Connection;
use Models\Course;
require __DIR__.'/../../vendor/autoload.php';



$database = new Connection();
$db = $database->getConnection();
$Message = '';

if (isset($_GET['id'])) {
    $condition = ["id" => $_GET['id']];
    $courseObj = new Course($db);
    
        if (isset($_POST['course_status']) && !empty($_POST['course_status'])) {
            $course_status = filter_var($_POST['course_status'], FILTER_SANITIZE_STRING);
            $data = ["course_status" => $course_status];
            
            if ($courseObj->update($data, $condition)) {
                $_SESSION['message'] = "Course status modified successfully.";
                header('Location:../../views/admin/courses.php');
                exit;
            } else {
                $_SESSION['message'] = "Failed to modify Course status.";
                header('Location:../../views/admin/courses.php');
                exit;
            }
        } else {
            $_SESSION['message'] = "Course name is required.";
            header('Location:../../views/admin/courses.php');
            exit;
        }
    
} else {
    $_SESSION['message'] = "No ID provided.";
    header('Location:../../views/admin/courses.php');
    exit;
}

?>
