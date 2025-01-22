<?php
session_start();
use Config\Connection;
use Models\Course;
use Models\Student;
use Models\Tag;

require __DIR__.'/../../vendor/autoload.php'; 

// if(isset($_SESSION['id']) && $_SESSION['role'] == "student"){
$database = new Connection();
$db = $database->getConnection();

$studentId = $_SESSION['id'];
$courseId = $_GET['id'];

$studentObj= new Course($db);
$studentObj->enrollInCourse($studentId,$courseId) ;

header("Location: ../../views/users/course_page.php?id=$courseId");

// }else{
//     header("Location: ../../views/users/register.php?id=$courseId");
// }




?>