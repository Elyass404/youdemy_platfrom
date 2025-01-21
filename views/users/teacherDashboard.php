<?php
session_start();
use Config\Connection;
use Models\Course;
use Models\Teacher;
require __DIR__.'/../../vendor/autoload.php'; 

$database = new Connection();
$db = $database->getConnection();

$teacherObj = new Teacher($db);
$courseObj = new Course($db);
$teacherId = $_SESSION['teacher_id'];
$totalOwnCourses = $teacherObj->totalOwnCourses($teacherId);
$pendingOwnCourses = $teacherObj->pendingOwnCourses($teacherId);
$totalEnrolledStudents = $teacherObj->totalEnrolledStudents($teacherId);

$pendingCourses= $courseObj->readCertainCourses(["course_status"=>"pending", "teacher_id"=>$teacherId]);

var_dump($pendingCourses);







?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<!-- Navbar -->
<nav class="bg-gray-800 p-4 flex justify-between items-center text-white">
    <div class="flex items-center">
        <img src="your_logo_here.png" alt="Logo" class="w-10 h-10 mr-2">
        <span class="text-xl font-semibold">Teacher Dashboard</span>
    </div>
    <div class="flex items-center space-x-4">
        <span class="text-lg">Teacher</span>
        <img src="default_profile_image.png" alt="Profile" class="w-8 h-8 rounded-full border-2 border-white">
        <a href="logout.php" class="text-red-500 hover:text-red-700">Logout</a>
    </div>
</nav>

<!-- Main Content -->
<div class="container mx-auto p-6">
    
    <!-- Create Course Button -->
    <div class="mb-6 flex justify-end">
        <a href="create_course.php" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Create New Course</a>
    </div>

    <!-- Statistics Section -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <h3 class="text-lg font-semibold">Total Courses</h3>
            <p class="text-3xl"><?=$totalOwnCourses?></p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <h3 class="text-lg font-semibold">Total Enrolled Students</h3>
            <p class="text-3xl"><?= $totalEnrolledStudents ?></p> <!-- Static data, replace later -->
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <h3 class="text-lg font-semibold">Pending Courses</h3>
            <p class="text-3xl"><?=$pendingOwnCourses?></p> <!-- Static data, replace later -->
        </div>
    </div>

    <!-- Pending Courses Table -->
    <div class="mb-8">
        <h2 class="text-2xl font-semibold mb-4">Pending Courses</h2>
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Title</th>
                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Date of Creation</th>
                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Category</th>
                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Status</th>
                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Static row data, replace later -->
                 <?php 
                 foreach($pendingCourses as $course):
                 ?>
                <tr class="border-b">
                    <td class="py-3 px-4"><?= $course["title"] ?></td>
                    <td class="py-3 px-4"><?= $course["created_at"] ?></td>
                    <td class="py-3 px-4"><?= $course["category_name"] ?></td>
                    <td class="py-3 px-4"><?= $course["course_status"] ?></td>
                    <td class="py-3 px-4">
                        <a href="course_page.php?id=<?= $course["id"] ?>" class="text-blue-600 hover:underline">View</a>
                        <a href="../../controllers/courses/updateCourseCtrl.php?id=<?= $course['id']?>" class="text-yellow-600 hover:underline ml-3">Update</a>
                        <a href="../../controllers/courses/deleteCourseCtrl.php?id=<?= $course['id']?>" class="text-red-600 hover:underline ml-3">Delete</a>
                    </td>
                </tr>
                
                <?php endforeach; ?>
    
            </tbody>
        </table>
    </div>

    <!-- Courses Cards Section -->
    <h2 class="text-2xl font-semibold mb-4">Created Courses</h2>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <!-- Static course card data, replace later -->
        <div class="bg-white p-4 rounded-lg shadow-md">
            <img src="https://images.unsplash.com/photo-1737069222401-afd3720775ae?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Course Image" class="w-full h-48 object-cover rounded-lg mb-4">
            <h3 class="text-xl font-semibold">Course 1</h3>
            <p class="text-gray-500">Category 1</p>
            <div class="mt-2">
                <span class="text-sm text-gray-400">Tags: </span>
                <span class="text-sm text-blue-500">Tag 1, Tag 2</span>
            </div>
            <div class="mt-4">
                <p class="text-gray-500 text-sm">Total Students Enrolled: 50</p> <!-- Static data, replace later -->
            </div>
            <div class="mt-6 flex justify-between">
                <a href="course_page.php?id=1" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">View</a>
                <a href="update_course.php?id=1" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">Update</a>
                <a href="delete_course.php?id=1" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Delete</a>
            </div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-md">
            <img src="https://images.unsplash.com/photo-1737069222401-afd3720775ae?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Course Image" class="w-full h-48 object-cover rounded-lg mb-4">
            <h3 class="text-xl font-semibold">Course 2</h3>
            <p class="text-gray-500">Category 2</p>
            <div class="mt-2">
                <span class="text-sm text-gray-400">Tags: </span>
                <span class="text-sm text-blue-500">Tag 3, Tag 4</span>
            </div>
            <div class="mt-4">
                <p class="text-gray-500 text-sm">Total Students Enrolled: 60</p> <!-- Static data, replace later -->
            </div>
            <div class="mt-6 flex justify-between">
                <a href="course_page.php?id=2" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">View</a>
                <a href="update_course.php?id=2" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">Update</a>
                <a href="delete_course.php?id=2" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Delete</a>
            </div>
        </div>
    </div>

</div>

</body>
</html>
