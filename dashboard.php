<?php
// require_once 'config/Connection.php';
require_once __DIR__ . '/vendor/autoload.php'; 
use Config\Connection;
use Models\Category;
use Models\Tag;
use Models\User;

$database = new Connection();
$db = $database->getConnection();

$category = new Category($db);
$tag = new Tag($db);
$user = new User($db);
$userData = [
    'name' => 'imran',
    'email' => 'imran@example.com',
    'password' => 'barca',
    'role' => 'student',
    'photo' => "https://images.unsplash.com/profile-1700009111141-05e9502e95c4image?w=150&dpr=1&crop=faces&bg=%23fff&h=150&auto=format&fit=crop&q=60&ixlib=rb-4.0.3",
    'gender' => 'male',
    'status' => 'Activated',
    'bio' => 'Just a student.',
    'birthdate' => '2008-12-02'
];

// $user->register($userData);
$email="imran@example.com";
$password="barca";
if($user->login($email,$password)){
    if ($_SESSION['role']=== "Admin"){
        echo "you are an admin!";
    }elseif($_SESSION['role']==="teacher"){
        echo "you are a teacher!";

    }else{
        echo "you are a student!";
    }
    

};

// $user->logout();
// if (!isset($_SESSION['role'])) {
    
//     // echo $_SESSION['role'];
//     echo "Session doesnt exists.";
// }





// $category->create(["category_name"=>"development"]);
// $tag->create(["tag_name"=>"UI/UX"]);
// $tag->create(["tag_name"=>"PHP"]);
// $tag->update(["tag_name"=>"CSS5"],["id"=>"2"]);





if ($db) {
    echo "WArah khdaaaaaaaaaaaaaammma!<br>";
} else {
    echo "Connection failed!";
}








?>