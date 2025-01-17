<?php

use Config\Connection;
use Models\Course;
use Models\Category;
require __DIR__.'/../vendor/autoload.php'; 

$database = new Connection();
$db = $database->getConnection();
$Message;

    if (isset($_GET['id'])) {
        $condition = ["id" => $_GET['id']];
        $categoryObj = new Category($db);
        echo "ID: " . htmlspecialchars($_GET['id']) . "<br>"; // For debugging

        // Check if the category exists before attempting to delete
        $category = $categoryObj->read($condition); // Assume read method exists to check if category exists
        if (!empty($category)) {
            $data = ["category_name"=>"development"];
            $conditions = ["id"=>$_GET['id']];

            if ($categoryObj->update($data,$condition)) { 
                $Message = "You Modified the category successfully.";
            } else {
                $Message = "Failed to Modify the category.";
            }
        } else {
            $Message = "There is no category with the provided ID to modify.";
        }
    } else {
        $Message = "No ID provided.";
    }

    echo $Message;

?>