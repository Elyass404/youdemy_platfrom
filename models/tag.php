<?php
namespace Models;
use Models\crud;
use PDO;
use PDOException;
 

class Tag {
    private $id;
    private $name;
    private $crud;

    public function __construct($db) {
        $this->crud = new CRUD($db);
    }

    public function create($data) {
        return $this->crud->create($data, 'tags');
    }

    public function read($conditions = []) {
        return $this->crud->read($conditions, 'tags');
    }

    public function update($data, $conditions) {
        return $this->crud->update($data, $conditions, 'tags');
    }

    public function delete($conditions) {
        return $this->crud->delete($conditions, 'tags');
    }

    public static function countTags($db, $conditions = []) {
        $query = "SELECT COUNT(*) as total FROM tags";
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

    public static function getTags($id,$db){
        $query = "SELECT tags.name as name FROM tags
        JOIN article_tags ON tags.id = article_tags.tag_id
        WHERE article_id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
}
?>





