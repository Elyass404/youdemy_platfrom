<?php
// require_once 'config/Connection.php';
require_once __DIR__ . '/vendor/autoload.php'; 
use Config\Connection;

$database = new Connection();
$db = $database->getConnection();



if ($db) {
    echo "WArah khdaaaaaaaaaaaaaammma!<br>";
} else {
    echo "Connection failed!";
}





?>