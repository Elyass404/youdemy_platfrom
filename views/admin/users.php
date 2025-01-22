<?php

session_start();
use Config\Connection;
use Models\Admin;

require __DIR__.'/../../vendor/autoload.php'; 


$_SESSION["role"]="teacher";
$_SESSION["user_id"]=1;
$adminId = $_SESSION['user_id'] ;
echo "the id is $adminId";
if(isset($_SESSION["role"] )){
   
    echo "you are loged in Mr.".$_SESSION['role'];
}else{
    echo "You should not be in this page, Get OUT!!!";
    header("Location: shouldLog.php");
}


$database = new Connection();
$db = $database->getConnection();

$adminObj= new Admin($db);

$adminInfo = $adminObj->viewUsers(["id"=>$adminId]);

$allTeachers = $adminObj->read(["role"=>"teacher"]);
$allStudents = $adminObj->read(["role"=>"student"]);
$pendingUsers = $adminObj->read(["status"=>"pending"]);

$totalUsers = $adminObj->totalUsers();
$totalTeachers = $adminObj->totalTeachers();
$totalStudents = $adminObj->totalStudents();




// var_dump($adminInfo);
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
    <title>Manage Users - Youdemy</title>
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
                <h1 class="text-3xl font-bold text-gray-800">Manage Users</h1>
                <div class="text-gray-600">Welcome, <?=strtoupper( $adminInfo[0]["name"] )?></div>
            </div>

            <!-- Add User Button -->
            <div class="mb-6">
                <a href="/admin/users/add_user.php" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Add New User</a>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Total Users</h3>
                    <p class="text-4xl font-bold text-gray-800"><?= $totalUsers?></p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Total Students</h3>
                    <p class="text-4xl font-bold text-gray-800"><?= $totalStudents?></p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Total Teachers</h3>
                    <p class="text-4xl font-bold text-gray-800"><?= $totalTeachers?></p>
                </div>
            </div>

            <!-- Pending Users Table -->
            <div id="pending-users-table" class="bg-white p-6 rounded-lg shadow-md mb-8">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Pending Users</h3>
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="text-left bg-gray-100">
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">ID</th>
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">Name</th>
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">Gender</th>
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">Email</th>
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">Role</th>
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">Status</th>
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($pendingUsers as $pendingUser):
                        ?>
                        <tr class="border-b">
                            <td class="py-3 px-4 text-center"><?= $pendingUser["id"]?></td>
                            <td class="py-3 px-4 text-center"><?= $pendingUser["name"]?></td>
                            <td class="py-3 px-4 text-center"><?= $pendingUser["gender"]?></td>
                            <td class="py-3 px-4 text-center"><?= $pendingUser["email"]?></td>
                            <td class="py-3 px-4 text-center"><?= $pendingUser["role"]?></td>
                            <td class="py-3 px-4 text-center"><?= $pendingUser["status"]?></td>
                            <td class="py-3 px-4 text-center">
                                <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600"><a href="../../controllers/users/validateUserCtrl.php?id=<?= $pendingUser['id']?>">Accept</a></button>
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 ml-2"><a href="../../controllers/users/banUserCtrl.php?id=<?= $pendingUser['id']?>">Ban</a></button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Toggle Button for Students and Teachers -->
            <div class="mb-6">
                <button id="toggle-users-btn" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600" onclick="toggleUserTables()">Show Teachers</button>
            </div>

            <!-- Students Table -->
            <div id="students-table" class="bg-white p-6 rounded-lg shadow-md mb-8">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Students</h3>
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="text-left bg-gray-100">
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">ID</th>
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">Name</th>
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">Gender</th>
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">Email</th>
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">Role</th>
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">Status</th>
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($allStudents as $student):
                        ?>
                        <tr class="border-b">
                            <td class="py-3 px-4 text-center"><?= $student["id"]?></td>
                            <td class="py-3 px-4 text-center"><?= $student["name"]?></td>
                            <td class="py-3 px-4 text-center"><?= $student["gender"]?></td>
                            <td class="py-3 px-4 text-center"><?= $student["email"]?></td>
                            <td class="py-3 px-4 text-center"><?= $student["role"]?></td>
                            <td class="py-3 px-4 text-center">
                                <span id="status-<?=$student['id']?>" class="status-display"><?=$student['status']?></span>
                                <div id="status-modify-<?=$student['id']?>" class="hidden">
                                <form action="../../controllers/users/modifyUserCtrl.php?id=<?= $student['id']?>" method="POST">
                                    <select id="status-select-<?=$student['id']?>" name="user_status" class="border px-2 py-1 rounded-md">
                                        <option value="Activated" <?= $student['status'] == "Activated" ? "selected" : '' ?>>Activated</option>
                                        <option value="Pending"<?= $student['status'] == "Pending" ? "selected" : '' ?>>Pending</option>
                                        <option value="Banned"<?= $student['status'] == "Banned" ? "selected" : '' ?>>Banned</option>
                                    </select>
                                    <input type="button" class="bg-red-500 text-white px-2 py-1 rounded ml-2" onclick="cancelModifyStatus(<?=$student['id']?>)" value="Cancel">
                                    <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded ml-2">Save</button>
                                    </form>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <button class="text-yellow-600 hover:underline" onclick="modifyStatus(<?=$student['id']?>)">Modify</button>
                                <button class="text-red-600 hover:underline"><a href="../../controllers/users/deleteUserCtrl.php?id=<?= $student['id']?>">Delete</a></button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Teachers Table -->
            <div id="teachers-table" class="bg-white p-6 rounded-lg shadow-md mb-8 hidden">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Teachers</h3>
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="text-left bg-gray-100">
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">ID</th>
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">Name</th>
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">Gender</th>
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">Email</th>
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">Role</th>
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">Status</th>
                            <th class="py-2 px-4 text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($allTeachers as $teacher):
                        ?>
                        <tr class="border-b">
                            <td class="py-3 px-4 text-center"><?= $teacher["id"]?></td>
                            <td class="py-3 px-4 text-center"><?= $teacher["name"]?></td>
                            <td class="py-3 px-4 text-center"><?= $teacher["gender"]?></td>
                            <td class="py-3 px-4 text-center"><?= $teacher["email"]?></td>
                            <td class="py-3 px-4 text-center"><?= $teacher["role"]?></td>
                            <td class="py-3 px-4 text-center">
                                <span id="status-<?= $teacher['id']?>" class="status-display"><?= $teacher["status"]?></span>
                                <div id="status-modify-<?= $teacher['id']?>" class="hidden">
                                <form action="../../controllers/users/modifyUserCtrl.php?id=<?= $teacher['id']?>" method="POST">
                                    <select id="status-select-<?= $teacher['id']?>" name="user_status" class="border px-2 py-1 rounded-md">
                                        <option value="activated" <?= $teacher['status'] == "Activated" ? "selected" : '' ?>>Activated</option>
                                        <option value="pending" <?= $teacher['status'] == "Activated" ? "selected" : '' ?>>Pending</option>
                                        <option value="banned" <?= $teacher['status'] == "Activated" ? "selected" : '' ?>>Banned</option>
                                    </select>
                                    <button type="button" class="bg-red-500 text-white px-2 py-1 rounded ml-2" onclick="cancelModifyStatus(<?= $teacher['id']?>)">Cancel</button>
                                    <button type= "submit" class="bg-green-500 text-white px-2 py-1 rounded ml-2" onclick="saveStatus(<?= $teacher['id']?>)">Save</button>
                                </form>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <button class="text-yellow-600 hover:underline" onclick="modifyStatus(<?= $teacher['id']?>)">Modify</button>
                                <button class="text-red-600 hover:underline" "><a href="../../controllers/users/deleteUserCtrl.php?id=<?= $teacher['id']?>">Delete</a></button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script>
        function toggleUserTables() {
            const studentsTable = document.getElementById('students-table');
            const teachersTable = document.getElementById('teachers-table');
            const toggleButton = document.getElementById('toggle-users-btn');

            if (studentsTable.classList.contains('hidden')) {
                studentsTable.classList.remove('hidden');
                teachersTable.classList.add('hidden');
                toggleButton.textContent = "Show Teachers";
            } else {
                studentsTable.classList.add('hidden');
                teachersTable.classList.remove('hidden');
                toggleButton.textContent = "Show Students";
            }
        }

        function modifyStatus(userId) {
            const statusDisplay = document.getElementById(`status-${userId}`);
            const statusModify = document.getElementById(`status-modify-${userId}`);

            // Hide status display and show modify input
            statusDisplay.classList.add('hidden');
            statusModify.classList.remove('hidden');
        }

        function cancelModifyStatus(userId) {
            const statusDisplay = document.getElementById(`status-${userId}`);
            const statusModify = document.getElementById(`status-modify-${userId}`);

            // Restore the original status and hide modify input
            statusDisplay.classList.remove('hidden');
            statusModify.classList.add('hidden');
        }

    </script>

</body>

</html>
