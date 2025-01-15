<?php

namespace Config;

use PDO;
use PDOException;
use Dotenv\Dotenv;
require __DIR__.'/../vendor/autoload.php'; // Composer autoloader



// Load .env file from the root of your project
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

class Connection{

    private $host ;
    private $db_name ;
    private $username;
    private $password ;
    private $conn;

    public function __construct() {
        // Bring values from the loaded environment variables
        $this->host = $_ENV['DB_SERVER'];
        $this->db_name = $_ENV['DB_NAME'];
        $this->username = $_ENV['DB_USERNAME'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->conn = null;
    }

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}


?>