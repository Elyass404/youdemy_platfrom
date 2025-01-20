<?php

namespace Models;
use Models\Crud;
use Models\User;
use PDO;
use PDOException;


class Auth extends User {
    protected $crud;

    // Constructor to initialize the CRUD object
    public function __construct($db) {
        $this->crud = new CRUD($db);
    }


}


?>