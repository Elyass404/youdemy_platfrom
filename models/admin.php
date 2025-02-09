<?php
namespace Models;
use Models\crud;
use Models\User;
use PDO;
use PDOException;


class Admin extends User {
    protected $crud;
    protected $db;

    // Constructor to initialize the CRUD object
    public function __construct($db) {
        $this->crud = new CRUD($db);
        $this->db = $db;
    }

   

    // Validate User 
    public function validateUser($userId) {
        $data = ['status' => 'activated']; // Change status to 'activated'
        $conditions = ['id' => $teacherId];
        return $this->crud->update($data, $conditions, 'users'); 
    }

    // Pending User
    public function pendingUser($userId) {
        $data = ['status' => 'pending']; // Change course_status to 'pending'
        $conditions = ['id' => $courseId];
        return $this->crud->update($data, $conditions, 'courses'); 
    }

    // Ban User
    public function banUser($userId) {
        $data = ['status' => 'banned']; // Change course_status to 'banned'
        $conditions = ['id' => $courseId];
        return $this->crud->update($data, $conditions, 'courses'); 
    }

    // Accept Course
    public function acceptCourse($courseId) {
        $data = ['course_status' => 'accepted']; // Change course_status to 'accepted'
        $conditions = ['id' => $courseId];
        return $this->crud->update($data, $conditions, 'courses'); 
    }
    


    // refuse Course
    public function refuseCourse($courseId) {
        $data = ['course_status' => 'Refused']; // Change course_status to 'refused'
        $conditions = ['id' => $courseId];
        return $this->crud->update($data, $conditions, 'courses'); 
    }

    // Add a new user 
    public function addUser($data) {
        return $this->crud->create($data, 'users'); 
    }

    // Update user information 
    public function updateUser($data, $conditions) {
        return $this->crud->update($data, $conditions, 'users'); 
    }

    // Delete a user 
    public function deleteUser($conditions) {
        return $this->crud->delete($conditions, 'users'); 
    }

    // Modify course details
    public function modifyCourse($data, $conditions) {
        return $this->crud->update($data, $conditions, 'courses'); 
    }

    // Get the total number of students
    public function totalStudents() {
        $query = "SELECT COUNT(*) as total FROM users WHERE role = 'student' AND status = 'activated'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // Get the total number of teachers
    public function totalTeachers() {
        $query = "SELECT COUNT(*) as total FROM users WHERE role = 'teacher' AND status = 'activated'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

        // Get the total of users in the platform 
    public function totalUsers() {
        $query = "SELECT COUNT(*) as total FROM users WHERE status = 'activated' AND role NOT IN (SELECT role FROM users WHERE role = 'admin')";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // Get the total number of courses
    public function totalCourses($db) {
        $query = "SELECT COUNT(*) as total FROM courses";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
}



?>