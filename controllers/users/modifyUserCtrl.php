<?php
use Config\Connection;
use Models\Admin;
require __DIR__.'/../../vendor/autoload.php';



$database = new Connection();
$db = $database->getConnection();
$Message = '';

$adminObj = new Admin($db);
$status=$_POST['user_status'];
$data=["status"=>$status];

if(isset($_GET['id']) && !empty($_GET['id'])){
    $courseId = $_GET['id'];
    $conditions = ["id"=>$courseId];

    if(isset($_POST['user_status']) && !empty($_POST['user_status'])){
        
        $adminObj->updateUser($data, $conditions);
    }
}











?>