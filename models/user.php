<?php
namespace Models;
use Models\crud;

use PDO;
use PDOException;
require __DIR__.'/../vendor/autoload.php'; 


class User {
    protected $id;  
    protected $name;
    protected $email;
    protected $password;
    protected $role;  
    protected $photo;
    protected $gender;
    protected $bio;
    protected $birthdate;
    protected $crud;

    public function __construct($db) {
        $this->crud = new CRUD($db);

    }

    public function register($data) {
        // Hash the password using Argon2
        $data["password"] = password_hash($data["password"], PASSWORD_ARGON2ID);
        
        return $this->crud->create($data, 'users');
    }

    public function login($email,$password) {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->crud->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;

    }

    public static function logout() {
        session_start();
        session_unset();
        session_destroy();
    }

    public function manageProfile($data, $conditions) {
        return $this->crud->update($data, $conditions, 'users');
    }

    public function read($conditions = []) {
        return $this->crud->read($conditions, 'users');
    }

    public function deleteUser($conditions) {
        return $this->crud->delete($conditions, 'users');
    }


    public static function countUsers($db, $conditions = []) {
        $query = "SELECT COUNT(*) as total FROM users";
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", array_map(function($key) {
                return "$key = :$key";
            }, array_keys($conditions)));
        }
        $stmt = $db->prepare($query);
        foreach ($conditions as $key => &$val) {
            $stmt->bindParam(":$key", $val);
        }
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    
    
    
}






?>

