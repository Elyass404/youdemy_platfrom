<?php
session_start();

if(isset($_SESSION["name"])){
   
    echo "you are loged in Mr.".$_SESSION['name'];
}else{
    echo "You should not be in this page, Get OUT!!!";
    header("Location: shouldLog.php");
}
use Config\Connection;
use Models\Course;
use Models\Category;
require __DIR__.'/../../vendor/autoload.php'; 

$database = new Connection();
$db = $database->getConnection();

$categoryObj= new Category($db);
$categories = $categoryObj->read();



var_dump($categories[0]);
print_r($_SESSION);




?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Sidebar (Navigation) -->
    <div class="flex">
        <div class="w-64 bg-blue-800 text-white min-h-screen">
            <div class="p-6 text-2xl font-bold">Youdemy Admin</div>
            <ul class="mt-8">
                <li><a href="/admin/dashboard" class="block p-4 hover:bg-blue-700">Dashboard</a></li>
                <li><a href="/admin/users" class="block p-4 hover:bg-blue-700">Manage Users</a></li>
                <li><a href="/admin/courses" class="block p-4 hover:bg-blue-700">Manage Courses</a></li>
                <li><a href="/admin/statistics" class="block p-4 hover:bg-blue-700">Statistics</a></li>
                <li><a href="/admin/categories" class="block p-4 hover:bg-blue-700">Manage Categories</a></li>
                <li><a href="/admin/Categories" class="block p-4 hover:bg-blue-700">Manage Tags</a></li>
                <li><a href="/logout" class="block p-4 hover:bg-blue-700">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">

            <!-- Navigation Bar (Top Bar) -->
            <div class="bg-white shadow-md p-4 flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Manage Categories</h1>
                <div class="text-gray-600">Welcome, Admin</div>
            </div>

            <!-- Categories Table -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Categories List</h3>

                <!-- Add Categorie Button -->
                <a href="/admin/Categories/add" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 mb-6 inline-block">Add Categorie</a>

                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="text-left bg-gray-100">
                            <th class="py-2 px-4 text-sm text-center font-semibold text-gray-700">ID</th>
                            <th class="py-2 px-4 text-sm text-center font-semibold text-gray-700">Categorie Name</th>
                            <th class="py-2 px-4 text-sm text-center font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example Categorie row (you can loop this in PHP or backend) -->
                        <?php foreach ($categories as $category):?>
                        <tr class="border-b">
                            <td class="py-3 px-4 text-gray-800 text-center"><?= $category["id"]?></td>
                            <td class="py-3 px-4 text-gray-800 text-center"><?= $category["category_name"]?></td>
                            <td class="py-3 px-4 text-gray-800 text-center">
                                <a href="/admin/Categories/edit/1" class="text-yellow-600 hover:underline mr-3">Edit</a>
                                <a href="../../controllers/deleteCategoryCtrl.php?id=<?= $category["id"]?>" class="text-red-600 hover:underline">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>
</html>
