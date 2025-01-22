<?php
session_start();
use Config\Connection;
use Models\Course;
use Models\Student;
use Models\Tag;

$studentId=$_SESSION['student_id']=2;

require __DIR__.'/../../vendor/autoload.php'; 

$database = new Connection();
$db = $database->getConnection();

$studentObj = new Student($db);
$courseObj = new Course($db);
$tagObj = new Tag($db);

$studentId = $_SESSION['student_id'];

$totalCourses = $studentObj->totalCourses($studentId);
$totalInProgressCourses = $studentObj->totalInProgressCourses($studentId);
$totalCompletedCourses = $studentObj->totalCompletedCourses($studentId);

$incompletedCourses=$studentObj->inProgressCourses($studentId);
$completedCourses=$studentObj->completedCourses($studentId);

$studentInfo=$studentObj->viewUsers(["id"=>$studentId]);


// var_dump($studentInfo);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Top Bar -->
    <div class="bg-white shadow-md p-4 flex justify-between items-center mb-8">
        <div class="text-2xl font-semibold text-gray-800">Student Dashboard</div>
        <div class="flex items-center space-x-4">
            <a href="courses_catalog.php" class="text-gray-600 hover:text-gray-800">Home</a>
            <a href="../../controllers/authentication/logoutCtrl.php" class="text-gray-600 hover:text-gray-800">Logout</a>
            <img src="<?=$studentInfo[0]['photo']?>" alt="Profile" class="rounded-full w-10 h-10">
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex flex-col px-6">

        <!-- Statistics Cards Section -->
        <div class="grid grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Total Courses</h3>
                <p class="text-4xl font-bold text-gray-800"><?= $totalCourses ?></p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Completed Courses</h3>
                <p class="text-4xl font-bold text-gray-800"><?=$totalCompletedCourses?></p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">In Progress Courses</h3>
                <p class="text-4xl font-bold text-gray-800"><?=$totalInProgressCourses?></p>
            </div>
        </div>

        <!-- Incompleted Courses Section -->
        <div class="mb-8">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6">Incompleted Courses</h3>
            <div class="grid grid-cols-3 gap-6">
                <?php
                foreach($incompletedCourses as $incomplete):
                ?>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <img src="<?= $incomplete['featured_image'] ?>" alt="Course Image" class="w-full h-40 object-cover rounded-lg mb-4">
                    <h4 class="text-lg font-semibold text-gray-800"><?= $incomplete['title'] ?></h4>
                    <p class="text-sm text-gray-600"><?= $incomplete['description'] ?></p>
                    <a href="course_page.php?id=<?= $incomplete['course_id'] ?>" class="text-white bg-blue-500 rounded px-4 py-2 mt-4 inline-block text-center hover:bg-blue-600">View Course</a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Completed Courses Section -->
        <div>
            <h3 class="text-2xl font-semibold text-gray-800 mb-6">Completed Courses</h3>
            <div class="grid grid-cols-3 gap-6">
            <?php
                foreach($completedCourses as $complete):
                ?>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <img src="<?= $complete['featured_image'] ?>" alt="Course Image" class="w-full h-40 object-cover rounded-lg mb-4">
                    <h4 class="text-lg font-semibold text-gray-800"><?= $complete['title'] ?></h4>
                    <p class="text-sm text-gray-600"><?= $complete['description'] ?></p>
                    <a href="course_page.php?id=<?= $complete['course_id'] ?>" class="text-white bg-blue-500 rounded px-4 py-2 mt-4 inline-block text-center hover:bg-blue-600">View Course</a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
    
</body>
</html>
