
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
// $courses = $courseObj->read();

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
                    <p class="text-4xl font-bold text-gray-800">120</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Enrolled Courses</h3>
                    <p class="text-4xl font-bold text-gray-800">85</p>
                </div>
            </div>

            <!-- Top 3 Courses -->
            <div class="mb-8">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Top 3 Courses</h3>
                <div class="grid grid-cols-3 gap-6">
                    <!-- Course 1 -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <img src="https://images.unsplash.com/photo-1735437683931-b8a17f57912d?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Course 1" class="w-full h-40 object-cover rounded-lg mb-4">
                        <h4 class="text-lg font-semibold text-gray-800">Course Title 1</h4>
                        <p class="text-sm text-gray-600">Teacher: John Doe</p>
                        <p class="text-sm text-gray-600">Enrolled: 200 students</p>
                        <a href="/admin/courses/view/1" class="text-blue-600 hover:underline mt-4 inline-block">View Course</a>
                    </div>

                    <!-- Course 2 -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <img src="https://images.unsplash.com/photo-1735437683931-b8a17f57912d?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Course 2" class="w-full h-40 object-cover rounded-lg mb-4">
                        <h4 class="text-lg font-semibold text-gray-800">Course Title 2</h4>
                        <p class="text-sm text-gray-600">Teacher: Jane Smith</p>
                        <p class="text-sm text-gray-600">Enrolled: 180 students</p>
                        <a href="/admin/courses/view/2" class="text-blue-600 hover:underline mt-4 inline-block">View Course</a>
                    </div>

                    <!-- Course 3 -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <img src="https://images.unsplash.com/photo-1735437683931-b8a17f57912d?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Course 3" class="w-full h-40 object-cover rounded-lg mb-4">
                        <h4 class="text-lg font-semibold text-gray-800">Course Title 3</h4>
                        <p class="text-sm text-gray-600">Teacher: Sarah Lee</p>
                        <p class="text-sm text-gray-600">Enrolled: 150 students</p>
                        <a href="/admin/courses/view/3" class="text-blue-600 hover:underline mt-4 inline-block">View Course</a>
                    </div>
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
                        
                        <tr class="border-b">
                            <td class="py-3 px-4 text-center">101</td>
                            <td class="py-3 px-4 text-center">Intro to Python</td>
                            <td class="py-3 px-4 text-center">John Doe</td>
                            <td class="py-3 px-4 text-center">2025-01-15</td>
                            <td class="py-3 px-4 text-center">Programming</td>
                            <td class="py-3 px-4 text-center"><span class="bg-orange-500 px-2 py-1 rounded-md text-white">Pending</span></td>
                            <td class="py-3 px-4 text-center"><a href="#" class="text-blue-600 hover:underline">View</a></td>
                            <td class="py-3 px-4 text-center">
                                <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Accept</button>
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Refuse</button>
                            </td>
                        </tr>
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
                        <!-- Example Row -->
                        <tr class="border-b">
                            <td class="py-3 px-4 text-center">103</td>
                            <td class="py-3 px-4 text-center">Intro to Data Science</td>
                            <td class="py-3 px-4 text-center">Alice Brown</td>
                            <td class="py-3 px-4 text-center">2025-01-12</td>
                            <td class="py-3 px-4 text-center"><span class="bg-green-400 px-2 py-1 rounded-md">Science</span></td>
                            <td class="py-3 px-4 text-center"><span class="bg-green-500 px-2 py-1 rounded-md">Active</span></td>
                            <td class="py-3 px-4 text-center">
                                <a href="#" class="text-blue-600 hover:underline">View</a>
                                <button class="text-yellow-600 hover:underline ml-3">Modify</button>
                                <button class="text-red-600 hover:underline ml-3">Delete</button>
                            </td>
                        </tr>
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
                        <!-- Example Row -->
                        <tr class="border-b">
                            <td class="py-3 px-4 text-center">104</td>
                            <td class="py-3 px-4 text-center">Advanced React</td>
                            <td class="py-3 px-4 text-center">Michael Green</td>
                            <td class="py-3 px-4 text-center">2025-01-08</td>
                            <td class="py-3 px-4 text-center"><span class="bg-yellow-400 px-2 py-1 rounded-md">Web Development</span></td>
                            <td class="py-3 px-4 text-center"><span class="bg-green-500 px-2 py-1 rounded-md">Active</span></td>
                            <td class="py-3 px-4 text-center">
                                <a href="#" class="text-blue-600 hover:underline">View</a>
                                <button class="text-yellow-600 hover:underline ml-3">Modify</button>
                                <button class="text-red-600 hover:underline ml-3">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
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

    </script>

</body>
</html>

