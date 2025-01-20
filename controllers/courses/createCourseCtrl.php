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
    "title" => 'Learn divs in HTML', 
    "description" => 'This you master the OOP using HTML ', 
    "featured_image" => "https://images.unsplash.com/profile-1700009111141-05e9502e95c4image?w=150&dpr=1&crop=faces&bg=%23fff&h=150&auto=format&fit=crop&q=60&ixlib=rb-4.0.3", 
    "category_id" =>'8', 
    "teacher_id" => '1', 
    "content" => 'this is a text course'
];

$tags = [1,2,3];

$course = $courseObj->create($courseData,$tags);



?>














