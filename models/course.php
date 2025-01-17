<?php
namespace Models;
use Models\crud;
use PDO;
use PDOException;
require __DIR__.'/../vendor/autoload.php'; 


class Course {
    private $crud;
    private $db;

    public function __construct($db) {
        $this->crud = new CRUD($db);
        $this->db = $db;
    }


    public function createByDocument($data, $tags = []) {
        $query = "
            INSERT INTO courses 
            (title, description, featured_image, category_id, teacher_id, content, video_content)
            VALUES (:title, :description, :featured_image, :category_id, :teacher_id, :content, NULL)
        ";
    
        $stmt = $this->db->prepare($query);
    
        // Bind the parameters
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':featured_image', $data['featured_image']);
        $stmt->bindParam(':category_id', $data['category_id']);
        $stmt->bindParam(':teacher_id', $data['teacher_id']);
        $stmt->bindParam(':content', $data['content']);
    
        $result = $stmt->execute();
        return $result;
    }
    

    public function createByVideo($data, $tags = [],$type) {
        $query = "
            INSERT INTO courses 
            (title, description, featured_image, category_id, teacher_id, content, video_content)
            VALUES (:title, :description, :featured_image, :category_id, :teacher_id, NULL, :video_content)
        ";
    
        $stmt = $this->db->prepare($query);
    
        // Bind the parameters
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':featured_image', $data['featured_image']);
        $stmt->bindParam(':category_id', $data['category_id']);
        $stmt->bindParam(':teacher_id', $data['teacher_id']);
        $stmt->bindParam(':video_content', $data['video_content']);
    
        $result = $stmt->execute();
        return $result;
    }

    public function read($conditions = []) {
        $query = "SELECT courses.*, COUNT(enrolled_courses.course_id) as enrolled_students, users.name as teacher_name, categories.category_name as category_name
        FROM courses
        JOIN users ON users.id = courses.teacher_id
        JOIN categories ON categories.id = courses.category_id
        LEFT JOIN enrolled_courses ON enrolled_courses.course_id = courses.id";
        
        if (!empty($conditions)) {
            $whereConditions = [];
            foreach ($conditions as $key => $val) {
                $whereConditions[] = "$key = " . $this->db->quote($val);
            }
            $query .= " WHERE " . implode(" AND ", $whereConditions);
        }
    
        $stmt = $this->db->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    



    public function readDocumentCourse($conditions = []) {
        $query = "SELECT *, courses.id  , users.name as name  , categories.category_name  as category_name 
        FROM courses
        JOIN users ON users.id = courses.teacher_id
        JOIN categories ON categories.id = courses.category_id " ;
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", array_map(function($key) {
                return "$key = :$key";
            }, array_keys($conditions)));
        }
        $stmt = $this->db->prepare($query);

        foreach ($conditions as $key => &$val) {
            $stmt->bindParam(":$key", $val);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    


    public function update($data, $conditions, $tags = []) {
        //   update the course in the courses table
        $result = $this->crud->update($data, $conditions, 'courses');

        if ($result) {
     // get the course ID from conditions
            $courseId = $conditions['id'];

            // delete existing tags for the course
            $this->crud->delete(['course_id' => $courseId], 'course_tags');

        // insert the new tags into the course_tags table
            foreach ($tags as $tagId) {
                $this->crud->create(['course_id' => $courseId, 'tag_id' => $tagId], 'course_tags');
            }
        }

        return $result;
    }

    public function delete($conditions) {
        // delete the course in the courses table
        return $this->crud->delete($conditions, 'courses');
    }

    public function searchCourse($searchWord) {
        $searchWord = "%" . trim($searchWord) . "%";

        
        $query = "SELECT * FROM courses WHERE title LIKE :searchWord";
        
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':searchWord', $searchWord, PDO::PARAM_STR);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
     
            return $result ? $result : false;
        
    }

    public static function countcourses($db, $conditions = []) {
        $query = "SELECT COUNT(*) as total FROM courses";
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

    public static function countTopcourses($db){
        $query = "SELECT * FROM courses ORDER BY views DESC LIMIT 3";  // Top 3 courses ordered by views
    $stmt = $db->prepare($query);
    $stmt->execute();  // Execute the query
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 

    return $result;  
    }

    public static function countTopAuthors($db){
        $query = "SELECT username as name , count(*) as total_courses FROM courses JOIN users ON users.id = courses.author_id  GROUP BY name ORDER BY total_courses DESC LIMIT 3";
        $stmt = $db->prepare($query);
        $stmt->execute();  
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        }


        public function __call($name, $args) {
            if ($name === "create") {
                if (count($args) === 2) {
                    return $this->createByDocument($args[0],$args[1]);
                } elseif (count($args) === 3) {
                    return $this->createByVideo($args[0], $args[1],$args[2]);
                } else {
                    throw new Exception("Invalid number of arguments for create method.");
                }
            } 
        }



}
?>















































