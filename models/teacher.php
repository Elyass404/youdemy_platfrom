<?php
namespace Models;
use Models\Crud;
use Models\User;
use PDO;
use PDOException;


class Teacher extends User {
    protected $crud;
    protected $db;

    // Constructor to initialize the CRUD object
    public function __construct($db) {
        $this->crud = new CRUD($db);
        $this->db = $db;
    }

    
    // Get total number of courses owned by the teacher
    public function totalOwnCourses($teacherId) {
        $query = "SELECT COUNT(*) as total_courses FROM courses WHERE teacher_id = :teacher_id";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':teacher_id', $teacherId);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_courses'];
    }

    // Get total number of pending courses created by the teacher
    public function pendingOwnCourses($teacherId) {
        $query = "SELECT COUNT(*) as total_pending_courses FROM courses WHERE teacher_id = :teacher_id AND course_status = 'pending'";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':teacher_id', $teacherId);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_pending_courses'];
    }

    // Get total number of enrolled students for the courses created by the teacher
    public function totalEnrolledStudents($teacherId) {
        $query = "
            SELECT COUNT(DISTINCT enrolled_courses.course_id) as total_enrolled
            FROM enrolled_courses
            JOIN courses ON courses.id = enrolled_courses.course_id
            WHERE courses.teacher_id = :teacher_id
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':teacher_id', $teacherId);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_enrolled'];
    }
}



?>


select * 
from users 
where id not in (select distinct user_id from enrolled_courses);