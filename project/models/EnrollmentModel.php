<?php
class EnrollmentModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function enrollUser($user_id, $course_id) {
        $query = "INSERT INTO enrollments (user_id, course_id, enrollment_date) VALUES (?, ?, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $user_id, $course_id);
        return $stmt->execute();
    }

    public function getEnrollmentsByUser($user_id) {
        $query = "SELECT * FROM enrollments WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>