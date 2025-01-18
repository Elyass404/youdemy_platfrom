<?php

use Config\Connection;
use Models\Course;
use Models\Tag;
require __DIR__.'/../../vendor/autoload.php'; 

$database = new Connection();
$db = $database->getConnection();
$Message;

    if (isset($_GET['id'])) {
        $condition = ["id" => $_GET['id']];
        $tagObj = new Tag($db);

        // Check if the tag exists before attempting to delete
        $tag = $tagObj->read($condition);
        if (!empty($tag)) {
            if ($tagObj->delete($condition)) {
                $Message = "You deleted the tag successfully.";
            } else {
                $Message = "Failed to delete the tag.";
            }
        } else {
            $Message = "There is no tag with the provided ID to delete.";
        }
    } else {
        $Message = "No ID provided.";
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletion Result</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    
    <div class="flex items-center justify-center min-h-screen bg-gray-100">

    <div class="text-center bg-white p-8 rounded-lg shadow-lg w-1/3">

    <h1 class="text-3xl font-bold mb-6"><?= $Message ?></h1>

            
    <a onclick="history.back()" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
         Back to Dashboard </a>
    
        </div>

    </div>

</body>
</html>

