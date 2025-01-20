
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

require __DIR__.'/../../vendor/autoload.php'; 

$database = new Connection();
$db = $database->getConnection();

$courseObj= new Course($db);
$textCourses = $courseObj->read();
$videoCourses = $courseObj->read("video");
$pendingCourses= $courseObj->readCertainCourses(["course_status"=>"pending"]);
$totalCourses= Course::countCourses($db);
$totalEnrolledCourses= Course::countEnrolledCourses($db);
$topCourses= Course::topCourses($db);


// var_dump($pendingCourses);
// var_dump($textCourses);
// var_dump($videoCourses);
// var_dump($textCourses[0]['teacher_name']);



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
    <title>Manage Courses - Youdemy</title>
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
                <li><a href="/admin/tags" class="block p-4 hover:bg-blue-700">Manage Tags</a></li>
                <li><a href="/logout" class="block p-4 hover:bg-blue-700">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">

            <!-- Navigation Bar (Top Bar) -->
            <div class="bg-white shadow-md p-4 flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Manage Courses</h1>
                <div class="text-gray-600">Welcome, Admin</div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-2 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Total Courses</h3>
                    <p class="text-4xl font-bold text-gray-800"><?= $totalCourses ?></p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Enrolled Courses</h3>
                    <p class="text-4xl font-bold text-gray-800"><?=$totalEnrolledCourses?></p>
                </div>
            </div>

            <!-- Top 3 Courses -->
            <div class="mb-8">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Top 3 Courses</h3>
                <div class="grid grid-cols-3 gap-6">
                    <?php
                    $counting = 1;
                    foreach($topCourses as $course):
                    ?>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div>#<?= $counting?></div>
                        <img src="<?= $course['featured_image']?>" alt="Course 1" class="w-full h-40 object-cover rounded-lg mb-4">
                        <h4 class="text-lg font-semibold text-gray-800"><?= $course['title']?></h4>
                        <p class="text-sm text-gray-600">Teacher: <?= $course['teacher_name']?></p>
                        <p class="text-sm text-gray-600">Enrolled Students: <?= $course['total_enrollments']?></p>
                        <a href="../users/course_page.php?id=<?=$course['id']?>" class="text-white bg-blue-500 rounded px-2 py-1 w-full text-center hover:underline mt-4 inline-block">View Course</a>
                    </div>
                    <?php $counting++?>
                    <?php endforeach; ?>
                </div>
            </div>


            <!-- Pending Courses Table -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Pending Courses</h3>
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="text-left bg-gray-100">
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">ID</th>
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">Title</th>
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">Teacher</th>
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">Date of Creation</th>
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">Category</th>
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">Status</th>
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">View</th>
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($pendingCourses as $course):
                        ?>

                        <tr class="border-b">
                            <td class="py-3 px-4 text-center"><?= $course['id']?></td>
                            <td class="py-3 px-4 text-center"><?= $course['title']?></td>
                            <td class="py-3 px-4 text-center"><?= $course['teacher_name']?></td>
                            <td class="py-3 px-4 text-center"><?= $course['created_at']?></td>
                            <td class="py-3 px-4 text-center"><?= $course['category_name']?></td>
                            <td class="py-3 px-4 text-center"><span class="bg-orange-500 px-2 py-1 rounded-md text-white"><?= $course['course_status']?></span></td>
                            <td class="py-3 px-4 text-center"><a href="../users/course_page.php?id=<?=$course['id']?>" class="text-blue-600 hover:underline">View</a></td>
                            <td class="py-3 px-4 text-center">
                                <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600"><a href="../../controllers/courses/acceptCourseCtrl.php?id=<?= $course['id']?>">Accept</a></button>
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600"><a href="../../controllers/courses/refuseCourseCtrl.php?id=<?= $course['id']?>">Refuse</a></button>
                            </td>
                        </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Toggle Button for Course Type -->
            <div class="mb-6">
                <button id="toggle-courses-btn" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600" onclick="toggleCourseTables()">Show Video-based Courses</button>
            </div>

            <!-- Courses Table (Text-based) -->
<div id="text-courses" class="bg-white p-6 rounded-lg shadow-md mb-8">
    <h3 class="text-2xl font-semibold text-gray-800 mb-6">Text-Based Courses</h3>
    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr class="text-left bg-gray-100">
                <th class="py-2 px-4 text-sm font-semibold text-gray-700">ID</th>
                <th class="py-2 px-4 text-sm font-semibold text-gray-700">Title</th>
                <th class="py-2 px-4 text-sm font-semibold text-gray-700">Teacher</th>
                <th class="py-2 px-4 text-sm font-semibold text-gray-700">Date of Creation</th>
                <th class="py-2 px-4 text-sm font-semibold text-gray-700">Category</th>
                <th class="py-2 px-4 text-sm font-semibold text-gray-700">Status</th>
                <th class="py-2 px-4 text-sm font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($textCourses as $course): ?>
                <tr class="border-b">
                    <td class="py-3 px-4 text-center"><?= $course['id']?></td>
                    <td class="py-3 px-4 text-center"><?= $course['title']?></td>
                    <td class="py-3 px-4 text-center"><?= $course['teacher_name']?></td>
                    <td class="py-3 px-4 text-center"><?= $course['created_at']?></td>
                    <td class="py-3 px-4 text-center">
                        <span class="bg-green-400 px-2 py-1 rounded-md"><?= $course['category_name']?></span>
                    </td>
                    
                    <!-- Course Status Column with Modify Button -->
                    <td class="py-3 px-4 text-center">
                        <span id="status-text-<?= $course['id']?>" class="bg-green-500 px-2 py-1 rounded-md"><?= $course['course_status']?></span>

                        <!-- Hidden Select Input with Save/Cancel -->
                        <div id="status-select-container-<?= $course['id']?>" class="hidden">
                            <form method="post" action="../../controllers/courses/modifyCourseCtrl.php?id=<?= $course['id']?>">
                                <select name="course_status" class="px-2 py-1">
                                    <option value="accepted" <?= $course['course_status'] == 'accepted' ? 'selected' : '' ?>>Accepted</option>
                                    <option value="refused" <?= $course['course_status'] == 'refused' ? 'selected' : '' ?>>Refused</option>
                                    <option value="pending" <?= $course['course_status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                </select>
                                <button type="submit" name="save" class="bg-blue-500 text-white px-4 py-1 rounded-md">Save</button>
                                <button type="button" class="bg-gray-500 text-white px-4 py-1 rounded-md cancel-btn">Cancel</button>
                            </form>
                        </div>
                    </td>

                    <!-- Actions Column with Modify Button -->
                    <td class="py-3 px-4 text-center">
                        <a href="../users/course_page.php?id=<?=$course['id']?>" class="text-blue-600 hover:underline">View</a>
                        <button class="text-yellow-600 hover:underline ml-3 modify-btn" data-course-id="<?= $course['id'] ?>">Modify</button>
                        <a href="../../controllers/courses/deleteCourseCtrl.php?id=<?= $course['id']?>" class="text-red-600 hover:underline ml-3">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

            <!-- Courses Table (Video-based) -->
            <div id="video-courses" class="bg-white p-6 rounded-lg shadow-md mb-8 hidden">
    <h3 class="text-2xl font-semibold text-gray-800 mb-6">Video-Based Courses</h3>
    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr class="text-left bg-gray-100">
                <th class="py-2 px-4 text-sm font-semibold text-gray-700">ID</th>
                <th class="py-2 px-4 text-sm font-semibold text-gray-700">Title</th>
                <th class="py-2 px-4 text-sm font-semibold text-gray-700">Teacher</th>
                <th class="py-2 px-4 text-sm font-semibold text-gray-700">Date of Creation</th>
                <th class="py-2 px-4 text-sm font-semibold text-gray-700">Category</th>
                <th class="py-2 px-4 text-sm font-semibold text-gray-700">Status</th>
                <th class="py-2 px-4 text-sm font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($videoCourses as $course): ?>
            <tr class="border-b">
                <td class="py-3 px-4 text-center"><?= $course['id']?></td>
                <td class="py-3 px-4 text-center"><?= $course['title']?></td>
                <td class="py-3 px-4 text-center"><?= $course['teacher_name']?></td>
                <td class="py-3 px-4 text-center"><?= $course['created_at']?></td>
                <td class="py-3 px-4 text-center"><span class="bg-yellow-400 px-2 py-1 rounded-md"><?= $course['category_name']?></span></td>
                
                <!-- Course Status Column with Modify Button -->
                <td class="py-3 px-4 text-center">
                    <span id="status-text-<?= $course['id']?>" class="bg-green-500 px-2 py-1 rounded-md"><?= $course['course_status']?></span>
                    
                    <!-- Hidden Select Input with Save/Cancel -->
                    <div id="status-select-container-<?= $course['id']?>" class="hidden">
                        <form method="POST" action="../../controllers/courses/modifyCourseCtrl.php?id=<?= $course['id']?>">
                            <select name="course_status" class="px-2 py-1">
                                <option value="accepted" <?= $course['course_status'] == 'accepted' ? 'selected' : '' ?>>Accepted</option>
                                <option value="refused" <?= $course['course_status'] == 'refused' ? 'selected' : '' ?>>Refused</option>
                                <option value="pending" <?= $course['course_status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                            </select>
                            <button type="submit" name="save" class="bg-blue-500 text-white px-4 py-1 rounded-md">Save</button>
                            <button type="button" class="bg-gray-500 text-white px-4 py-1 rounded-md cancel-btn">Cancel</button>
                        </form>
                    </div>
                </td>

                <!-- Actions Column with Modify Button -->
                <td class="py-3 px-4 text-center">
                    <a href="../users/course_page.php?id=<?=$course['id']?>" class="text-blue-600 hover:underline">View</a>
                    <button class="text-yellow-600 hover:underline ml-3 modify-btn" data-course-id="<?= $course['id'] ?>">Modify</button>
                    <a href="../../controllers/courses/deleteCourseCtrl.php?id=<?= $course['id']?>" class="text-red-600 hover:underline ml-3">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
            </div>

        </div>
    </div>

    <script>
        function toggleCourseTables() {
            var textCourses = document.getElementById("text-courses");
            var videoCourses = document.getElementById("video-courses");
            var button = document.getElementById("toggle-courses-btn");

            if (textCourses.classList.contains("hidden")) {
                textCourses.classList.remove("hidden");
                videoCourses.classList.add("hidden");
                button.textContent = "Show Video-based Courses";
                document.querySelector('h3.text-2xl').textContent = "Video-Based Courses";
            } else {
                textCourses.classList.add("hidden");
                videoCourses.classList.remove("hidden");
                button.textContent = "Show Text-based Courses";
                document.querySelector('h3.text-2xl').textContent = "Text-Based Courses";
            }
        }





        document.querySelectorAll('.modify-btn').forEach(button => {
        button.addEventListener('click', function() {
            const courseId = this.dataset.courseId;

            // Show the select input and hide the status text
            document.getElementById('status-text-' + courseId).classList.add('hidden');
            document.getElementById('status-select-container-' + courseId).classList.remove('hidden');
        });
    });

    // Cancel button functionality
    document.querySelectorAll('.cancel-btn').forEach(button => {
        button.addEventListener('click', function() {
            const courseId = this.closest('form').querySelector('input[name="course_id"]').value;

            // Hide the select input and show the status text again
            document.getElementById('status-text-' + courseId).classList.remove('hidden');
            document.getElementById('status-select-container-' + courseId).classList.add('hidden');
        });
    });

    </script>

</body>
</html>

