<?php
session_start();


if (isset($_SESSION['message'])){

   $message = $_SESSION['message'];
   unset($_SESSION['message']);
}else{
    echo '<script type="text/javascript">
         window.history.back();
        </script>';
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletion Result</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    
    <div class="flex items-center justify-center min-h-screen bg-gray-100">

    <div class="text-center bg-white p-8 rounded-lg shadow-lg w-1/3">

    <h1 class="text-3xl font-bold mb-6"><?= $message ?></h1>

            
    <a onclick="history.back()" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
         Back to previous </a>
    
        </div>

    </div>

</body>
</html>