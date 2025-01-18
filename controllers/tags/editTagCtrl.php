<?php
session_start();

use Config\Connection;
use Models\Tag;
use Models\course;
require __DIR__.'/../../vendor/autoload.php';



$database = new Connection();
$db = $database->getConnection();
$Message = '';

if (isset($_GET['id'])) {
    $condition = ["id" => $_GET['id']];
    $tagObj = new Tag($db);
    
        if (isset($_POST['tag_name']) && !empty($_POST['tag_name'])) {
            $tag_name = filter_var($_POST['tag_name'], FILTER_SANITIZE_STRING);
            $data = ["tag_name" => $tag_name];
            
            if ($tagObj->update($data, $condition)) {
                $_SESSION['message'] = "tag modified successfully.";
                header('Location:../../views/admin/tags.php');
                exit;
            } else {
                $_SESSION['message'] = "Failed to modify tag.";
                header('Location:../../views/admin/tags.php');
                exit;
            }
        } else {
            $_SESSION['message'] = "tag name is required.";
            header('Location:../../views/admin/tags.php');
            exit;
        }
    
} else {
    $_SESSION['message'] = "No ID provided.";
    header('Location:../../views/admin/tags.php');
    exit;
}

?>
