<?php
namespace Models;
use Models\Crud;
use Models\User;
use PDO;
use PDOException;


class Student extends User {
    protected $crud;
    protected $db;

    // Constructor to initialize the CRUD object
    public function __construct($db) {
        $this->crud = new CRUD($db);
        $this->db = $db;
    }

    public function inProgressCourses($studentId) {
        // SQL query to join enrolled_courses with courses and get all necessary information
        $query = "
            SELECT 
                enrolled_courses.course_id,
                enrolled_courses.user_id,
                enrolled_courses.status,
                enrolled_courses.enrolled_at,
                courses.title,
                courses.description,
                courses.featured_image,
                courses.teacher_id
            FROM enrolled_courses
            JOIN courses ON enrolled_courses.course_id = courses.id
            WHERE enrolled_courses.user_id = :student_id
            AND enrolled_courses.status = 'in progress'";
    
        // Prepare the query
        $stmt = $this->db->prepare($query);
    
        // Bind the student ID to the query
        $stmt->bindParam(':student_id', $studentId);
    
        // Execute the query
        $stmt->execute();
    
        // Fetch all results
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $results; 
    }


    public function completedCourses($studentId) {
        // SQL query to join enrolled_courses with courses and get all necessary information
        $query = "
            SELECT 
                enrolled_courses.course_id,
                enrolled_courses.user_id,
                enrolled_courses.status,
                enrolled_courses.enrolled_at,
                courses.title,
                courses.description,
                courses.featured_image,
                courses.teacher_id
            FROM enrolled_courses
            JOIN courses ON enrolled_courses.course_id = courses.id
            WHERE enrolled_courses.user_id = :student_id
            AND enrolled_courses.status = 'completed'";
    
        // Prepare the query
        $stmt = $this->db->prepare($query);
    
        // Bind the student ID to the query
        $stmt->bindParam(':student_id', $studentId);
    
        // Execute the query
        $stmt->execute();
    
        // Fetch all results
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $results; 
    }
    

    
    // Get total number of courses owned by the teacher
    public function totalCourses($studentId) {
        $query = "SELECT COUNT(*) as total_courses FROM enrolled_courses WHERE user_id = :student_id";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':student_id', $studentId);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_courses'];
    }

    public function totalCompletedCourses($studentId) {
        $query = "SELECT COUNT(*) as total_courses FROM enrolled_courses WHERE user_id = :student_id AND status = 'completed'";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':student_id', $studentId);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_courses'];
    }

    public function totalInProgressCourses($studentId) {
        $query = "SELECT COUNT(*) as total_courses FROM enrolled_courses WHERE user_id = :student_id AND status = 'in progress'";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':student_id', $studentId);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_courses'];
    }

    public function enrollInCourse($studentId, $courseId) {
        $query = "INSERT INTO enrolled_courses (student_id, course_id, status, enrolled_at) 
                  VALUES (:student_id, :course_id, 'in progress', NOW())";
        
        // Prepare the query
        $stmt = $this->db->prepare($query);
        
        // Bind the parameters
        $stmt->bindParam(':student_id', $studentId);
        $stmt->bindParam(':course_id', $courseId);
        
        // Execute the query
        if ($stmt->execute()) {
            return true; 
        } else {
            return false; 
        }
    }
    
    
}



?>


