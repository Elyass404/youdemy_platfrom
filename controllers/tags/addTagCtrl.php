<?php
session_start();

use Config\Connection;
use Models\Tag;
use Models\course;
require __DIR__.'/../../vendor/autoload.php';



$database = new Connection();
$db = $database->getConnection();
$Message = '';


    $tagObj = new Tag($db);
    
        if (isset($_POST['tag_name']) && !empty($_POST['tag_name'])) {
            $tag_name = filter_var($_POST['tag_name'], FILTER_SANITIZE_STRING);
            $data = ["tag_name" => $tag_name];
            
            if ($tagObj->create($data)) {
                $_SESSION['message'] = "Tag added successfully.";
                header('Location:../../views/admin/tags.php');
                exit;
            } else {
                $_SESSION['message'] = "Failed to add tag.";
                header('Location:../../views/admin/tags.php');
                exit;
            }
        } else {
            $_SESSION['message'] = "Tag name is required.";
            header('Location:../../views/admin/tags.php');
            exit;
        }
    


?>
