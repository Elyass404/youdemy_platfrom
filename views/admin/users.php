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
                <div class="text-gray-600">Welcome, Admin</div>
            </div>

            <!-- Add User Button -->
            <div class="mb-6">
                <a href="/admin/users/add_user.php" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Add New User</a>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Total Users</h3>
                    <p class="text-4xl font-bold text-gray-800">200</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Total Students</h3>
                    <p class="text-4xl font-bold text-gray-800">150</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Total Teachers</h3>
                    <p class="text-4xl font-bold text-gray-800">50</p>
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
                        <tr class="border-b">
                            <td class="py-3 px-4 text-center">1</td>
                            <td class="py-3 px-4 text-center">John Doe</td>
                            <td class="py-3 px-4 text-center">Male</td>
                            <td class="py-3 px-4 text-center">john.doe@example.com</td>
                            <td class="py-3 px-4 text-center">Student</td>
                            <td class="py-3 px-4 text-center">Pending</td>
                            <td class="py-3 px-4 text-center">
                                <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600" onclick="acceptUser(1)">Accept</button>
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 ml-2" onclick="banUser(1)">Ban</button>
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-3 px-4 text-center">2</td>
                            <td class="py-3 px-4 text-center">Jane Smith</td>
                            <td class="py-3 px-4 text-center">Female</td>
                            <td class="py-3 px-4 text-center">jane.smith@example.com</td>
                            <td class="py-3 px-4 text-center">Teacher</td>
                            <td class="py-3 px-4 text-center">Pending</td>
                            <td class="py-3 px-4 text-center">
                                <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600" onclick="acceptUser(2)">Accept</button>
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 ml-2" onclick="banUser(2)">Ban</button>
                            </td>
                        </tr>
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
                        <tr class="border-b">
                            <td class="py-3 px-4 text-center">1</td>
                            <td class="py-3 px-4 text-center">Alice Johnson</td>
                            <td class="py-3 px-4 text-center">Female</td>
                            <td class="py-3 px-4 text-center">alice.johnson@example.com</td>
                            <td class="py-3 px-4 text-center">Student</td>
                            <td class="py-3 px-4 text-center">
                                <span id="status-1" class="status-display">Accepted</span>
                                <div id="status-modify-1" class="hidden">
                                    <select id="status-select-1" class="border px-2 py-1 rounded-md">
                                        <option value="Accepted">Accepted</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Rejected">Rejected</option>
                                    </select>
                                    <button class="bg-red-500 text-white px-2 py-1 rounded ml-2" onclick="cancelModifyStatus(1)">Cancel</button>
                                    <button class="bg-green-500 text-white px-2 py-1 rounded ml-2" onclick="saveStatus(1)">Save</button>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <button class="text-yellow-600 hover:underline" onclick="modifyStatus(1)">Modify Status</button>
                            </td>
                        </tr>
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
                        <tr class="border-b">
                            <td class="py-3 px-4 text-center">1</td>
                            <td class="py-3 px-4 text-center">John Doe</td>
                            <td class="py-3 px-4 text-center">Male</td>
                            <td class="py-3 px-4 text-center">john.doe@example.com</td>
                            <td class="py-3 px-4 text-center">Teacher</td>
                            <td class="py-3 px-4 text-center">
                                <span id="status-2" class="status-display">Accepted</span>
                                <div id="status-modify-2" class="hidden">
                                    <select id="status-select-2" class="border px-2 py-1 rounded-md">
                                        <option value="Accepted">Accepted</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Rejected">Rejected</option>
                                    </select>
                                    <button class="bg-red-500 text-white px-2 py-1 rounded ml-2" onclick="cancelModifyStatus(2)">Cancel</button>
                                    <button class="bg-green-500 text-white px-2 py-1 rounded ml-2" onclick="saveStatus(2)">Save</button>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <button class="text-yellow-600 hover:underline" onclick="modifyStatus(2)">Modify Status</button>
                            </td>
                        </tr>
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

        function saveStatus(userId) {
            const statusSelect = document.getElementById(`status-select-${userId}`);
            const statusDisplay = document.getElementById(`status-${userId}`);
            const statusModify = document.getElementById(`status-modify-${userId}`);

            // Save the new status and hide modify input
            statusDisplay.textContent = statusSelect.value;
            statusDisplay.classList.remove('hidden');
            statusModify.classList.add('hidden');
        }

        function acceptUser(userId) {
            alert(`User ${userId} accepted!`);
        }

        function banUser(userId) {
            alert(`User ${userId} banned!`);
        }
    </script>

</body>

</html>
