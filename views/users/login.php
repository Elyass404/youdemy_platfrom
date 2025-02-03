
<?php 
session_start();
if (isset($_SESSION['message'])){

 echo ( $_SESSION['message']);
unset($_SESSION['message']);
}
// $_SESSION['role']="teacher";
// $_SESSION['user_id']="2";
// unset($_SESSION);


if (isset($_SESSION['role']) && isset($_SESSION['user_id']) ){
    header("Location: ../../views/users/courses_catalog.php");
    exit;
}




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Login to Your Account</h2>

        <form action="../../controllers/authentication/loginCtrl.php" method="POST">
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="w-full p-3 border border-gray-300 rounded-md" placeholder="Enter your email" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="w-full p-3 border border-gray-300 rounded-md" placeholder="Enter your password" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-md text-lg hover:bg-blue-700 transition duration-300">Login</button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">Don't have an account? <a href="register.php" class="text-blue-600 hover:underline">Register here</a></p>
        </div>
    </div>

</body>
</html>
