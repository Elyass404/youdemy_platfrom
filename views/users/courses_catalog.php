<?php

echo "Hello this is the Courses catalog limaaaaaaaaaaaaaaaaakkk!"


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Online Learning Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <header class="bg-blue-600 p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- Logo or Site Title -->
            <h1 class="text-white text-xl font-bold">Youdemy</h1>

            <!-- Navigation Bar (Search Bar, Login, Register, Profile, Logout) -->
            <div class="flex items-center space-x-4">
                <!-- Search Bar and Button -->
                <div class="flex items-center space-x-2">
                    <input type="text" placeholder="Search Courses..." class="p-2 rounded-md w-64" />
                    <button class="text-white bg-blue-500 px-4 py-2 rounded-md">Search</button>
                </div>

                <!-- Login and Register Buttons (Visible when no session) -->
                <div class="space-x-4 hidden sm:block">
                    <button class="text-white bg-blue-500 px-4 py-2 rounded-md">Login</button>
                    <button class="text-white bg-blue-500 px-4 py-2 rounded-md">Register</button>
                </div>

                <!-- Profile Picture and Logout Button (Visible when session exists) -->
                <div class="space-x-4 sm:block hidden flex items-center">
                    <img src="profile-pic-placeholder.jpg" alt="Profile Picture" class="w-8 h-8 rounded-full border-2 border-white">
                    <button class="text-white bg-red-500 px-4 py-2 rounded-md">Logout</button>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative bg-cover bg-center h-[60vh]" style="background-image: url('hero-image.jpg');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative z-10 text-center text-white p-10">
            <h2 class="text-4xl font-bold mb-4">Education, for anyone, anywhere!</h2>
            <p class="text-lg mb-8 max-w-xl mx-auto">At Youdemy, we offer personalized and interactive learning experiences for students and teachers worldwide. Unlock your potential today and take control of your future, no matter where you are in the world. Join our global community of learners!</p>
        </div>
    </section>

    <!-- Course Listings -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <h3 class="text-2xl font-semibold mb-8">Explore Our Courses</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Course Card 1 -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="course-image.jpg" alt="Course Image" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h4 class="text-lg font-semibold">Course Title 1</h4>
                        <p class="text-sm text-gray-500">by Author Name</p>
                        <p class="text-sm text-gray-400 mt-2">Enrolled: 120 students</p>
                        <button class="mt-4 w-full py-2 bg-blue-500 text-white rounded-md">Go to Course</button>
                    </div>
                </div>
                <!-- Course Card 2 -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="course-image.jpg" alt="Course Image" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h4 class="text-lg font-semibold">Course Title 2</h4>
                        <p class="text-sm text-gray-500">by Author Name</p>
                        <p class="text-sm text-gray-400 mt-2">Enrolled: 90 students</p>
                        <button class="mt-4 w-full py-2 bg-blue-500 text-white rounded-md">Go to Course</button>
                    </div>
                </div>
                <!-- More Course Cards can go here, following the same structure -->
            </div>
        </div>
    </section>

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
