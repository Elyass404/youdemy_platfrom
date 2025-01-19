<?php
session_start();

$_SESSION["role"]="teacher";
if(isset($_SESSION["role"])){
   
    echo "you are logged in Mr.".$_SESSION['role'];
}else{
    echo "You should not be in this page, Get OUT!!!";
    header("Location: shouldLog.php");
}
use Config\Connection;
use Models\Course;
use Models\Tag;  
require __DIR__.'/../../vendor/autoload.php'; 

$database = new Connection();
$db = $database->getConnection();

$tagObj = new Tag($db);  
$tags = $tagObj->read();  

// var_dump($tags[0]);
// print_r($_SESSION);

if(isset($_SESSION['message']) && !empty($_SESSION['message'])){
    echo "<script type='text/javascript'>alert('" . $_SESSION['message'] . "');</script>";
    unset($_SESSION['message']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tags - Youdemy</title>  
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Sidebar (Navigation) -->
    <div class="flex">
        <div class="w-64 bg-blue-800 text-white min-h-screen">
            <div class="p-6 text-2xl font-bold">Youdemy Admin</div>
            <ul class="mt-8">
                <li><a href="dashboard.php" class="block p-4 hover:bg-blue-700">Dashboard</a></li>
                <li><a href="users.php" class="block p-4 hover:bg-blue-700">Manage Users</a></li>
                <li><a href="courses.php" class="block p-4 hover:bg-blue-700">Manage Courses</a></li>
                <li><a href="statistics.php" class="block p-4 hover:bg-blue-700">Statistics</a></li>
                <li><a href="categories.php" class="block p-4 hover:bg-blue-700">Manage Categories</a></li>
                <li><a href="tags.php" class="block p-4 hover:bg-blue-700">Manage Tags</a></li>  
                <li><a href="/logout" class="block p-4 hover:bg-blue-700">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">

            <!-- Navigation Bar (Top Bar) -->
            <div class="bg-white shadow-md p-4 flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Manage Tags</h1>  
                <div class="text-gray-600">Welcome, Admin</div>
            </div>

            <!-- Tags Table -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Tags List</h3>  

                <!-- Add Tag Button -->
                <button id="add-tag-btn" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 mb-6 inline-block" onclick="toggleTagForm()">Add Tag</button>  

                <!-- Tag Input Form (Initially hidden) -->
                <div id="add-tag-form" class="hidden mb-6 text-center">  
                    <form action="../../controllers/tags/addTagCtrl.php" method="POST">  
                        <div class="flex items-center justify-center space-x-4">
                            <input type="text" id="new-tag-name" name="tag_name" class="px-4 py-2 border border-gray-300 rounded-md" placeholder="Enter tag name" required />
                            <div class="flex items-center space-x-4">
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Add Tag</button>  
                                <button type="button" onclick="toggleTagForm()" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Cancel</button>  
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Tags Table -->
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="text-left bg-gray-100">
                            <th class="py-2 px-4 text-sm text-center font-semibold text-gray-700">ID</th>
                            <th class="py-2 px-4 text-sm text-center font-semibold text-gray-700">Tag Name</th>  
                            <th class="py-2 px-4 text-sm text-center font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example Tag Row (you can loop this in PHP or backend) -->
                        <?php foreach ($tags as $tag): ?>  
                        <tr class="border-b">
                            <td class="py-3 px-4 text-gray-800 text-center"><?= $tag["id"] ?></td>  
                            <td class="py-3 px-4 text-gray-800 text-center" id="tag-name-<?= $tag["id"] ?>">  
                                <span id="tag-text-<?= $tag["id"] ?>"><?= $tag["tag_name"] ?></span>  
                                <form id="edit-form-<?= $tag["id"] ?>" class="hidden" action="../../controllers/tags/editTagCtrl.php?id=<?= $tag["id"] ?>" method="POST">  
                                    <input type="text" name="tag_name" value="<?= $tag["tag_name"] ?>" class="px-4 py-2 border border-gray-300 rounded-md w-56">
                                    <div class="flex items-center space-x-4">
                                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Save</button>
                                        <button type="button" onclick="cancelEdit(<?= $tag['id'] ?>)" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Cancel</button>
                                    </div>
                                </form>
                            </td>
                            <td class="py-3 px-4 text-gray-800 text-center">
                                <button onclick="editTag(<?= $tag['id'] ?>)" class="text-yellow-600 hover:underline mr-3">Edit</button>  
                                <a href="../../controllers/tags/deleteTagCtrl.php?id=<?= $tag["id"] ?>" class="text-red-600 hover:underline">Delete</a>  
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- JavaScript -->
    <script>
        function toggleTagForm() {  
            const addButton = document.getElementById('add-tag-btn');  
            const form = document.getElementById('add-tag-form');  
            addButton.classList.toggle('hidden');
            form.classList.toggle('hidden');
        }

        function editTag(tagId) { 
            const tagText = document.getElementById('tag-text-' + tagId);  
            const editForm = document.getElementById('edit-form-' + tagId);  

            tagText.classList.add('hidden');
            editForm.classList.remove('hidden');
        }

        function cancelEdit(tagId) {  
            const tagText = document.getElementById('tag-text-' + tagId);  
            const editForm = document.getElementById('edit-form-' + tagId);  

            tagText.classList.remove('hidden');
            editForm.classList.add('hidden');
        }
    </script>
</body>
</html>
