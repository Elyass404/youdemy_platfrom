
<?php
session_start();
$_SESSION["name"]="elyass";
// session_unset();
// session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Youdemy</title>
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
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
                <div class="text-gray-600">Welcome, Admin</div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Total Courses -->
                <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
                    <div class="text-gray-800">
                        <h3 class="text-xl font-semibold">Total Courses</h3>
                        <p class="text-3xl font-bold">120</p>
                    </div>
                    <div class="bg-blue-500 text-white p-4 rounded-full">
                        <i class="fas fa-book"></i>
                    </div>
                </div>
                <!-- Total Users -->
                <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
                    <div class="text-gray-800">
                        <h3 class="text-xl font-semibold">Total Users</h3>
                        <p class="text-3xl font-bold">350</p>
                    </div>
                    <div class="bg-green-500 text-white p-4 rounded-full">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <!-- Total Teachers -->
                <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
                    <div class="text-gray-800">
                        <h3 class="text-xl font-semibold">Total Teachers</h3>
                        <p class="text-3xl font-bold">45</p>
                    </div>
                    <div class="bg-yellow-500 text-white p-4 rounded-full">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                </div>
            </div>

            <!-- More Detailed Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Top 3 Teachers -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Top 3 Teachers</h3>
                    <ul class="space-y-4">
                        <li class="flex justify-between">
                            <span class="font-semibold">John Doe</span>
                            <span class="text-gray-500">45 courses</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="font-semibold">Jane Smith</span>
                            <span class="text-gray-500">38 courses</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="font-semibold">Emily Johnson</span>
                            <span class="text-gray-500">32 courses</span>
                        </li>
                    </ul>
                </div>

                <!-- Enrolled Courses (Total Enrollments) -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Total Enrollments</h3>
                    <p class="text-3xl font-bold text-gray-700">1500</p>
                </div>

                <!-- Pending Teacher Approvals -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Pending Teacher Approvals</h3>
                    <ul class="space-y-4">
                        <li class="flex justify-between">
                            <span class="font-semibold">Mark Taylor</span>
                            <span class="text-yellow-500">Pending Approval</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="font-semibold">Sophia Clark</span>
                            <span class="text-yellow-500">Pending Approval</span>
                        </li>
                    </ul>
                </div>
            </div>

            

            <!-- User Management Table -->
            <div class="bg-white p-6 rounded-lg shadow-md mt-8">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Manage Users</h3>

                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="text-left bg-gray-100">
                            <th class="py-2 px-4 text-sm text-center font-semibold text-gray-700">ID</th>
                            <th class="py-2 px-4 text-sm text-center font-semibold text-gray-700">Email</th>
                            <th class="py-2 px-4 text-sm text-center font-semibold text-gray-700">Role</th>
                            <th class="py-2 px-4 text-sm text-center font-semibold text-gray-700">Name</th>
                            <th class="py-2 px-4 text-sm text-center font-semibold text-gray-700">Status</th>
                            <th class="py-2 px-4 text-sm text-center font-semibold text-gray-700">Gender</th>
                            <th class="py-2 px-4 text-sm text-center font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample data for users -->
                        <tr class="border-b">
                            <td class="py-3 px-4 text-gray-800 text-center ">31</td>
                            <td class="py-3 px-4 text-gray-800 text-center">ilyass</td>
                            <td class="py-3 px-4 text-gray-800 text-center">ilyass.mar@example.com</td>
                            <td class="py-3 px-4 text-gray-800 text-center">Student</td>
                            <td class="py-3 px-4 text-gray-800 text-center">
                                <?php
                                $status = "pending";
                                if($status === "activated"):
                                ?>
                                <span class="px-2 py-1 bg-green-500 text-white text-sm rounded-full text-center">Activated</span>
                                <?php 
                                elseif($status === "pending"):
                                ?>
                                <span class="px-2 py-1 bg-orange-500 text-white text-sm rounded-full text-center">Activated</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-3 px-4 text-gray-800">Male</td>
                            <td class="py-3 px-4 text-gray-800 text-center">
                                <a href="#" class="text-blue-600 hover:underline mr-3">Activate</a>
                                <a href="#" class="text-yellow-600 hover:underline mr-3">Suspend</a>
                                <a href="#" class="text-red-600 hover:underline">Delete</a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>
</html>
