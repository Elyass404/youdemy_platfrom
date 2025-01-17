<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tags - Youdemy</title>
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
                <h1 class="text-3xl font-bold text-gray-800">Manage Tags</h1>
                <div class="text-gray-600">Welcome, Admin</div>
            </div>

            <!-- Tags Table -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Tags List</h3>

                <!-- Add Tag Button -->
                <a href="/admin/tags/add" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 mb-6 inline-block">Add Tag</a>

                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="text-left bg-gray-100">
                            <th class="py-2 px-4 text-sm text-center font-semibold text-gray-700">ID</th>
                            <th class="py-2 px-4 text-sm text-center font-semibold text-gray-700">Tag Name</th>
                            <th class="py-2 px-4 text-sm text-center font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example tag row (you can loop this in PHP or backend) -->
                        <tr class="border-b">
                            <td class="py-3 px-4 text-gray-800 text-center">1</td>
                            <td class="py-3 px-4 text-gray-800 text-center">Web Development</td>
                            <td class="py-3 px-4 text-gray-800 text-center">
                                <a href="/admin/tags/edit/1" class="text-yellow-600 hover:underline mr-3">Edit</a>
                                <a href="/admin/tags/delete/1" class="text-red-600 hover:underline">Delete</a>
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-3 px-4 text-gray-800 text-center">2</td>
                            <td class="py-3 px-4 text-gray-800 text-center">Design</td>
                            <td class="py-3 px-4 text-gray-800 text-center">
                                <a href="/admin/tags/edit/2" class="text-yellow-600 hover:underline mr-3">Edit</a>
                                <a href="/admin/tags/delete/2" class="text-red-600 hover:underline">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>
</html>
