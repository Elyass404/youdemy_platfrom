<?php

session_start();
require __DIR__.'/../../vendor/autoload.php'; 


use Config\Connection;
use Models\Tag;
use Models\Category;

$database = new Connection();
$db = $database->getConnection();

$categoryObj = new Category($db);
$categories = $categoryObj-> read();

$tagObj = new Tag($db);
$tags = $tagObj-> read();

// var_dump($tags);
// var_dump($categories);

// Define roles as constants to avoid magic strings
define("ROLE_TEACHER", "teacher");
$_SESSION['role'] = "teacher" ;
// Assuming you are checking user role before accessing the page
if (isset($_SESSION['role'])) {
    // Check if the user is a teacher
    if ($_SESSION['role'] === ROLE_TEACHER) {
        // echo "Hello, teacher! You are logged in.";
    } else {
        // Redirect to login page if the role is not 'teacher'
        $_SESSION['error'] = "You must be a teacher to access this page.";
        header("Location: login.php");
        exit(); // Make sure no further code is executed after redirect
    }
} else {
    // If session role is not set, redirect to login page
    header("Location: login.php");
    exit();
}

if(isset($_SESSION['message']) && !empty($_SESSION['message'])){
    echo "<script type='text/javascript'>alert('" . $_SESSION['message'] . "');</script>";
    unset($_SESSION['message']);
}

if (!isset($_SESSION['role']) && !($_SESSION['role'] === "teacher")) {
    header("Location: ../../views/users/register.php");
    exit;
    } 

// var_dump($_SESSION['teacher_id'])

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Header/Navbar -->
    <header class="bg-blue-600 p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-white text-xl font-bold">Youdemy</h1>
            <div class="flex items-center space-x-4">
            </div>
        </div>
    </header>

    <!-- Add Course Form -->
    <div class="max-w-7xl mx-auto px-4 py-12">

        <h2 class="text-3xl font-semibold text-gray-800 mb-8 text-center">Add New Course</h2>

        <form action="../../controllers/courses/createCourseCtrl.php" method="POST" enctype="multipart/form-data">

            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Course Title</label>
                <input type="text" id="title" name="title" required class="w-full p-3 border border-gray-300 rounded-md">
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700">Course Description</label>
                <textarea id="description" name="description" required rows="4" class="w-full p-3 border border-gray-300 rounded-md"></textarea>
            </div>

            <!-- Category -->
            <div class="mb-4">
                <label for="category" class="block text-gray-700">Category</label>
                <select id="category" name="category" required class="w-full p-3 border border-gray-300 rounded-md">
                    <?php
                    foreach($categories as $category):
                    ?>
                    <option value="<?= $category['id']?>"><?= $category['category_name']?></option>
                    <?php endforeach;?>
                </select>
            </div>

            <!-- Course Type -->
            <div class="mb-4">
                <label for="course_type" class="block text-gray-700">Course Type</label>
                <select id="course_type" name="course_type" required class="w-full p-3 border border-gray-300 rounded-md">
                    <option value="video">Video</option>
                    <option value="document">Text Document</option>
                </select>
            </div>

            <!-- Content (Video URL or Text Content) -->
            <div id="video_input" class="mb-4">
                <label for="content_video" class="block text-gray-700">Course Content (Video URL)</label>
                <input type="url" id="content_video" name="video_content" placeholder="Enter YouTube URL or Video URL" class="w-full p-3 border border-gray-300 rounded-md">
            </div>

            <div id="text_input" class="mb-4 hidden">
                <label for="content_text" class="block text-gray-700">Course Content (Text Content)</label>
                <textarea id="content_text" name="text_content" rows="6" placeholder="Write course content here" class="w-full p-3 border border-gray-300 rounded-md"></textarea>
            </div>

            <!-- Featured Image -->
            <div class="mb-4">
                <label for="featured_image" class="block text-gray-700">Featured Image URL</label>
                <input type="text" id="featured_image" name="featured_image" accept="image/*" class="w-full p-3 border border-gray-300 rounded-md">
            </div>

           <!-- Tags (Checkboxes) -->
<div class="mb-4">
    <label class="block text-gray-700">Select Tags</label>
    <div class="space-y-2 mt-2">
        <!-- Checkbox options should be dynamically generated from your tags -->

        <?php foreach($tags as $tag):?>
        <div class="flex items-center">
            <input type="checkbox" id="tag-<?= $tag["id"]?>" name="tags[]" value="<?= $tag["id"]?>" class="h-4 w-4 text-blue-600 border-gray-300 rounded">
            <label for="tag-<?= $tag["id"]?>" class="ml-2 text-gray-700"><?= $tag["tag_name"]?></label>
        </div>
        <?php endforeach; ?>
    </div>
</div>


            <!-- Submit Button -->
            <div class="mb-4 text-center">
                <button type="submit" class=" w-full text-white bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-md text-lg">Add Course</button>
            </div>

        </form>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4 text-center">
        <p>&copy; <span id="year"></span> Youdemy. All rights reserved.</p>
    </footer>

    <!-- Script to dynamically display the current year -->
    <script>
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>

    <script>
        // JavaScript to toggle between video input and text input based on course type selection
        const courseTypeSelect = document.getElementById('course_type');
        const videoInput = document.getElementById('video_input');
        const textInput = document.getElementById('text_input');

        courseTypeSelect.addEventListener('change', function () {
            if (this.value === 'video') {
                videoInput.classList.remove('hidden');
                textInput.classList.add('hidden');
            } else if (this.value === 'document') {
                textInput.classList.remove('hidden');
                videoInput.classList.add('hidden');
            }
        });
    </script>

</body>

</html>
