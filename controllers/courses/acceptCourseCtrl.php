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
        echo 'the course hass been accepted successfully';
    }
}









?>