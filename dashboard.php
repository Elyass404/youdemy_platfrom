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

// $category->create(["category_name"=>"development"]);
// $tag->create(["tag_name"=>"UI/UX"]);
// $tag->create(["tag_name"=>"PHP"]);
$tag->update(["tag_name"=>"CSS5"],["id"=>"2"]);





if ($db) {
    echo "WArah khdaaaaaaaaaaaaaammma!<br>";
} else {
    echo "Connection failed!";
}








?>