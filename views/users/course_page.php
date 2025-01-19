<?php
use Config\Connection;
use Models\Course;
use Models\Tag;
require __DIR__.'/../../vendor/autoload.php'; 

$database = new Connection();
$db = $database->getConnection();

if(isset ($_GET['id'])){
    $courseId = ($_GET['id']);

};

if(isset ($_SESSION)){
    echo " you are log in_______";

}else{
    echo"you should not be in this page get out_______";
};


$courseObj = new Course($db);

$course = $courseObj->readCourseWithEnrollement(["courses.id" => $courseId]);

// var_dump($course['video_content']);

// var_dump(tag::getTags($courseId,$db)) ;


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Title - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Header/Navbar -->
    <header class="bg-blue-600 p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-white text-xl font-bold">Youdemy</h1>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <input type="text" placeholder="Search Courses..." class="p-2 rounded-md w-64" />
                    <button class="text-white bg-blue-500 px-4 py-2 rounded-md">Search</button>
                </div>
                <div class="space-x-4 sm:block hidden flex items-center">
                    <img src="profile-pic-placeholder.jpg" alt="Profile Picture" class="w-8 h-8 rounded-full border-2 border-white">
                    <button class="text-white bg-red-500 px-4 py-2 rounded-md">Logout</button>
                </div>
            </div>
        </div>
    </header>

    <!-- Course Single Page Content -->
    <div class="max-w-7xl mx-auto px-4 py-12">

        <!-- Back Button -->
        <div class="mb-4">
            <a href="javascript:history.back()" class="text-blue-600 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 text-blue-600">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span>Back to Courses</span>
            </a>
        </div>

        <!-- Course Information -->
        <div class="text-center mb-12">
            <h2 class="text-3xl font-semibold text-gray-800 mb-4"><?= $course[0]['title']?></h2>
            <img src="<?= $course[0]['featured_image']?>" alt="Course Featured Image" class="w-full h-96 object-cover rounded-lg shadow-md mb-4">
            
            <!-- Tags and Category -->
            <div class="flex justify-center space-x-4 mb-4">
                <span class="px-4 py-2 bg-blue-600 text-white rounded-full"><?= $course[0]['category_name']?></span>
                <?php 
                $getTags = tag::getTags($courseId,$db);
                                                
                 foreach ($getTags as $tag): ?>
                <span class="px-4 py-2 bg-gray-600 text-white rounded-full"><?=$tag['name']?></span>
                <?php endforeach ;?>
            </div>

            <!-- Horizontal Alignment for Course Information -->
            <div class="flex justify-center space-x-12 text-gray-600 mb-6">
                <p><strong>Teacher:</strong> <?= $course[0]['teacher_name']?></p>
                <p><strong>Enrollments:</strong> <?= $course[0]['enrolled_students']?></p>
                <p><strong>Published on:</strong> <?= date('d-m-Y', strtotime($course[0]['created_at']))?></p>
            </div>
        </div>
        <div class="flex justify-center w-full">
        <button class="mb-5 text-white bg-green-500 hover:bg-green-600 px-6 py-3 text-lg rounded-md shadow-md z-10">Enroll this Course</button>
        </div>
        <!-- Right Section: Video (iframe) or Course Text -->
        <div class="relative text-center mb-12">
            
            <!-- Enroll Button at Top Right (Fixed) -->
            
            <?php
                if ($course[0]['course_type'] === "Video"):
            ?>
            <!-- Video Section (iframe) -->
            <div class="mb-6 flex justify-center">
                <iframe width="80%" height="400" src=<?= $course[0]['video_content'] ?> title="YouTube video" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <?php elseif ($course[0]['course_type'] === "Document"):
                ?>

            <!-- Course Description Text (if not video-based) -->
            <div class="mb-6 px-4 md:px-0 text-left">
                <p class="text-lg text-gray-700"><?= $course[0]['content'] ?></p>
            </div>
            <?php endif;
                ?>
        </div>

    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4 text-center">
        <p>&copy; <span id="year"></span> Youdemy. All rights reserved.</p>
    </footer>

    <!-- Script to dynamically display the current year -->
    <script>
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>

</body>

</html>
