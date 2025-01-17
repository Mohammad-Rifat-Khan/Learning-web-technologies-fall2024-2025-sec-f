<?php
require_once '../config/database.php';

class EnrollmentController {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function deleteEnrollment($enrollment_id) {
        $query = "DELETE FROM enrollments WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $enrollment_id);
        return $stmt->execute();
    }

    public function addEnrollment($user_id, $course_id) {
        $query = "INSERT INTO enrollments (user_id, course_id, enrollment_date) VALUES (?, ?, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $user_id, $course_id);
        return $stmt->execute();
    }

    public function getAllEnrollments() {
        $query = "SELECT enrollments.id AS enrollment_id, users.username, courses.title, enrollments.enrollment_date, course_ratings.rating, course_ratings.comment 
                  FROM enrollments 
                  JOIN users ON enrollments.user_id = users.id 
                  JOIN courses ON enrollments.course_id = courses.id 
                  LEFT JOIN course_ratings ON enrollments.user_id = course_ratings.user_id AND enrollments.course_id = course_ratings.course_id";
        return $this->conn->query($query);
    }

    public function getAllUsers() {
        $query = "SELECT id, username FROM users";
        return $this->conn->query($query);
    }

    public function getAllCourses() {
        $query = "SELECT id, title FROM courses";
        return $this->conn->query($query);
    }
}
?>