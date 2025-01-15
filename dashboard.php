<?php
require_once 'config/Connection.php';
// use Config\Connection;

$database = new Connection();
$db = $database->getConnection();



if ($db) {
    echo "WArah khdaaaaaaaaaaaaaammma!<br>";
    echo $_SESSION['role'];
} else {
    echo "Connection failed!";
}





?>