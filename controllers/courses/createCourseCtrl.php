<?php
session_start();

echo "hello, you are in the page of the create course ";
use Config\Connection;
use Models\Course;
require __DIR__.'/../../vendor/autoload.php';



$database = new Connection();
$db = $database->getConnection();
$Message = '';
$courseObj = new Course($db);




$courseData = [
    "title" => $_POST['title'], 
    "description" => $_POST['title'], 
    "featured_image" => $_POST['title'], 
    "category_id" =>$_POST['title'], 
    "teacher_id" => $_POST['title']
];

if ($_POST['course_type']==="video"){
    $courseData["video_content"] = $_POST['video_content'];
    var_dump($courseData["video_content"]);
}elseif($_POST['course_type']==="document"){
    $courseData["content"]=$_POST['text_content'];
    var_dump($courseData["content"]);
}

$tags = [1,2,3]; 
var_dump($courseData);

// $course = $courseObj->create($courseData,$tags);



?>














