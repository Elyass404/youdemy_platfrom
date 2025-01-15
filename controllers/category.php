<?php
namespace Controllers;
use Controllers\crud;
use PDO;
use PDOException;
// require_once 'crud.php';

class Category {
    private $id;
    private $name;
    private $crud;
    // private $table = "categories";

    public function __construct($db) {
        $this->crud = new CRUD($db);
    }

    public function create($data) {
        return $this->crud->create($data, 'categories');
    }

    public function read($conditions = []) {
        return $this->crud->read($conditions, 'categories');
    }

    public function update($data, $conditions) {
        return $this->crud->update($data, $conditions, 'categories');
    }

    public function delete($conditions) {
        return $this->crud->delete($conditions, 'categories');
    }

    public static function countCategories($db, $conditions = []) {
        $query = "SELECT COUNT(*) as total FROM categories";
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

    public static function getCategoryStats($db){
        $sql = "SELECT COUNT(*) as article_count, categories.name as category_name FROM articles JOIN categories ON articles.category_id = categories.id GROUP BY category_name;";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchALL(\PDO::FETCH_ASSOC);
        return $result;
    }
}
?>
