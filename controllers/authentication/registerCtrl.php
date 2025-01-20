<?php

session_start();

use Config\Connection;
use Models\Auth;
require __DIR__.'/../../vendor/autoload.php';



$database = new Connection();
$db = $database->getConnection();

$registerObj = new Auth($db);

$userData = [
    'name' => 'soufiane',
    'email' => 'soufiane@example.com',
    'password' => 'rajawi',
    'role' => 'teacher',
    'photo' => "https://images.unsplash.com/profile-1700009111141-05e9502e95c4image?w=150&dpr=1&crop=faces&bg=%23fff&h=150&auto=format&fit=crop&q=60&ixlib=rb-4.0.3",
    'gender' => 'male',
    'status' => 'Activated',
    'bio' => 'Just a teacher.',
    'birthdate' => '2008-12-02'
];

if($registerObj -> register($userData)){
    echo "you added a new user, Congratulations!";
}



?>