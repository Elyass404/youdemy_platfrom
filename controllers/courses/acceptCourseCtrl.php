<?php
session_start();

use Config\Connection;
use Models\Admin;
require __DIR__.'/../../vendor/autoload.php';



$database = new Connection();
$db = $database->getConnection();
$Message = '';

if(isset($_GET['id']) && !empty($_GET['id'])){
    echo $_GET['id'];
    $courseId = $_GET['id'];
    $adminObj = new Admin($db);
    if($adminObj->acceptCourse($courseId)){
        $_SESSION['message'] = "Course accepeted successfully.";
                header('Location:../../views/admin/courses.php');
                exit;
    }else {
        $_SESSION['message'] = "Failed to complete the operation.";
        header('Location:../../views/admin/courses.php');
        exit;
    }
}else{
    $_SESSION['message'] = "Course name is required.";
    header('Location:../../views/admin/categories.php');
    exit;
}

?>