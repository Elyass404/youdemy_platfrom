<?php
namespace Controllers;
use Models\crud;

use PDO;
use PDOException;
require __DIR__.'/../vendor/autoload.php'; 

class Auth extends User{
    
    // public function __construct(){
    //     parent::__construct();
    // }

public function register (){

    if(isset($_POST['login'])){
        $this->emai = $_POST['email'];
        $result= $this -> login($email, $password);
            
    }
}
}

$v = new Auth();
$v->login();

?>