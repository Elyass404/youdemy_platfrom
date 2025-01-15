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

    public function __construct($db, $data = []) {
        $this->crud = new CRUD($db);

        $this->name = $data['name'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->password = $data['password'] ?? null;
        $this->role = $data['role'] ?? null;  
        $this->profilePhoto = $data['photo'] ?? null;
        $this->gender = $data['gender'] ?? null;
        $this->bio = $data['bio'] ?? null;
        $this->birthdate = $data['birthdate'] ?? null;
    }

    public function register($data) {
        // Hash the password using Argon2
        $data["password"] = password_hash($data["password"], PASSWORD_ARGON2ID);
        
        return $this->crud->create($data, 'users');
    }

    public function login() {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->crud->conn->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($this->password, $user['password'])) {
            // Start session 
            session_start();
            $_SESSION['id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $this->id = $user['id']; 
            return true;
        }
        return false;
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

