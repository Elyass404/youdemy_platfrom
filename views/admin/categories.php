<?php
session_start();


$_SESSION["role"]="teacher";
if(isset($_SESSION["role"] )){
   
    echo "you are loged in Mr.".$_SESSION['role'];
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

// var_dump($categories[0]);
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
    <title>Manage Categories - Youdemy</title>
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
                <h1 class="text-3xl font-bold text-gray-800">Manage Categories</h1>
                <div class="text-gray-600">Welcome, Admin</div>
            </div>

            <!-- Categories Table -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Categories List</h3>

                <!-- Add Category Button -->
                <button id="add-category-btn" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 mb-6 inline-block" onclick="toggleCategoryForm()">Add Category</button>

                <!-- Category Input Form (Initially hidden) -->
                <div id="add-category-form" class="hidden mb-6 text-center">
                    <form action="../../controllers/categories/addCategoryCtrl.php" method="POST">
                        <div class="flex items-center justify-center space-x-4">
                            <input type="text" id="new-category-name" name="category_name" class="px-4 py-2 border border-gray-300 rounded-md" placeholder="Enter category name" required />
                            <div class="flex items-center space-x-4">
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Add Category</button>
                                <button type="button" onclick="toggleCategoryForm()" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Categories Table -->
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="text-left bg-gray-100">
                            <th class="py-2 px-4 text-sm text-center font-semibold text-gray-700">ID</th>
                            <th class="py-2 px-4 text-sm text-center font-semibold text-gray-700">Category Name</th>
                            <th class="py-2 px-4 text-sm text-center font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example Category Row (you can loop this in PHP or backend) -->
                        <?php foreach ($categories as $category): ?>
                        <tr class="border-b">
                            <td class="py-3 px-4 text-gray-800 text-center"><?= $category["id"] ?></td>
                            <td class="py-3 px-4 text-gray-800 text-center" id="category-name-<?= $category["id"] ?>">
                                <span id="category-text-<?= $category["id"] ?>"><?= $category["category_name"] ?></span>
                                <form id="edit-form-<?= $category["id"] ?>" class="hidden" action="../../controllers/categories/editCategoryCtrl.php?id=<?= $category["id"] ?>" method="POST">
                                    <input type="text" name="category_name" value="<?= $category["category_name"] ?>" class="px-4 py-2 border border-gray-300 rounded-md w-56">
                                    <div class="flex items-center space-x-4">
                                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Save</button>
                                        <button type="button" onclick="cancelEdit(<?= $category['id'] ?>)" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Cancel</button>
                                    </div>
                                </form>
                            </td>
                            <td class="py-3 px-4 text-gray-800 text-center">
                                <button onclick="editCategory(<?= $category['id'] ?>)" class="text-yellow-600 hover:underline mr-3">Edit</button>
                                <a href="../../controllers/categories/deleteCategoryCtrl.php?id=<?= $category["id"] ?>" class="text-red-600 hover:underline">Delete</a>
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
        function toggleCategoryForm() {
            // Toggle visibility of add button and form
            const addButton = document.getElementById('add-category-btn');
            const form = document.getElementById('add-category-form');
            addButton.classList.toggle('hidden');
            form.classList.toggle('hidden');
        }

        function editCategory(categoryId) {
            // Hide the category name and show the edit form
            const categoryText = document.getElementById('category-text-' + categoryId);
            const editForm = document.getElementById('edit-form-' + categoryId);

            categoryText.classList.add('hidden');
            editForm.classList.remove('hidden');
        }

        function cancelEdit(categoryId) {
            // Cancel the editing process, hide input and show the original category name again
            const categoryText = document.getElementById('category-text-' + categoryId);
            const editForm = document.getElementById('edit-form-' + categoryId);

            categoryText.classList.remove('hidden');
            editForm.classList.add('hidden');
        }
    </script>
</body>
</html>




