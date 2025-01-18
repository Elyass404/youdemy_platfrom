<?php
session_start();

use Config\Connection;
use Models\Category;
use Models\course;
require __DIR__.'/../../vendor/autoload.php';



$database = new Connection();
$db = $database->getConnection();
$Message = '';

if (isset($_GET['id'])) {
    $condition = ["id" => $_GET['id']];
    $categoryObj = new Category($db);
    
        if (isset($_POST['category_name']) && !empty($_POST['category_name'])) {
            $category_name = filter_var($_POST['category_name'], FILTER_SANITIZE_STRING);
            $data = ["category_name" => $category_name];
            
            if ($categoryObj->update($data, $condition)) {
                $_SESSION['message'] = "Category modified successfully.";
                header('Location:../../views/admin/categories.php');
                exit;
            } else {
                $_SESSION['message'] = "Failed to modify category.";
                header('Location:../../views/admin/categories.php');
                exit;
            }
        } else {
            $_SESSION['message'] = "Category name is required.";
            header('Location:../../views/admin/categories.php');
            exit;
        }
    
} else {
    $_SESSION['message'] = "No ID provided.";
    header('Location:../../views/admin/categories.php');
    exit;
}

?>
