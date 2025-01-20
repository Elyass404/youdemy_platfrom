<!-- views/register.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Centered Form Container -->
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-3xl font-semibold text-gray-800 text-center mb-6">Create an Account</h2>

            <!-- Registration Form -->
            <form action="../../controllers/authentication/registerCtrl.php" method="POST">
                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-semibold text-gray-700">Name</label>
                    <input type="text" id="name" name="name" class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Enter your full name" required>
                </div>

                <!-- Gender -->
                <div class="mb-4">
                    <label for="gender" class="block text-sm font-semibold text-gray-700">Gender</label>
                    <select id="gender" name="gender" class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Enter your email address" required>
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Create a password" required>
                </div>

                <!-- Role -->
                <div class="mb-4">
                    <label for="role" class="block text-sm font-semibold text-gray-700">Role</label>
                    <select id="role" name="role" class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Select Role</option>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                    </select>
                </div>

                <!-- Photo URL -->
                <div class="mb-4">
                    <label for="photo" class="block text-sm font-semibold text-gray-700">Photo URL</label>
                    <input type="url" id="photo" name="photo" class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Enter photo URL (optional)">
                </div>

                <!-- Birthdate -->
                <div class="mb-4">
                    <label for="birthdate" class="block text-sm font-semibold text-gray-700">Birthdate</label>
                    <input type="date" id="birthdate" name="birthdate" class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                </div>

                <!-- Bio -->
                <div class="mb-6">
                    <label for="bio" class="block text-sm font-semibold text-gray-700">Bio</label>
                    <textarea id="bio" name="bio" class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" rows="4" placeholder="Tell us about yourself (optional)"></textarea>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-center">
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                        Register
                    </button>
                </div>
            </form>
            <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">Already have an account? <a href="login.php" class="text-blue-600 hover:underline">Login here</a></p>
        </div>
        </div>
    </div>

</body>
</html>
