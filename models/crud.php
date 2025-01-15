<?php

namespace Models;

use PDO;
use PDOException;

require __DIR__.'/../vendor/autoload.php'; 


class CRUD {
    public $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($data, $table) {
        $columns = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));
        $query = "INSERT INTO " . $table . " ($columns) VALUES ($values)";
        $stmt = $this->conn->prepare($query);

        foreach ($data as $key => &$val) {
            $stmt->bindParam(":$key", $val);
        }

        return $stmt->execute();
    }

    public function read($conditions = [], $table) {
        $query = "SELECT * FROM " . $table;
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", array_map(function($key) {
                return "$key = :$key";
            }, array_keys($conditions)));
        }
        $stmt = $this->conn->prepare($query);

        foreach ($conditions as $key => &$val) {
            $stmt->bindParam(":$key", $val);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($data, $conditions, $table) {
        $set = implode(", ", array_map(function($key) {
            return "$key = :$key";
        }, array_keys($data)));

        $where = implode(" AND ", array_map(function($key) {
            return "$key = :$key";
        }, array_keys($conditions)));

        $query = "UPDATE " . $table . " SET $set WHERE $where";
        $stmt = $this->conn->prepare($query);

        foreach (array_merge($data, $conditions) as $key => &$val) {
            $stmt->bindParam(":$key", $val);
        }

        return $stmt->execute();
    }

    public function delete($conditions, $table) {
        $query = "DELETE FROM " . $table;
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", array_map(function($key) {
                return "$key = :$key";
            }, array_keys($conditions)));
        }
        $stmt = $this->conn->prepare($query);

        foreach ($conditions as $key => &$val) {
            $stmt->bindParam(":$key", $val);
        }

        return $stmt->execute();
    }
}
?>
