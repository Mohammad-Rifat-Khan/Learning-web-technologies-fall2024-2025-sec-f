<?php
class CourseModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getCourses() {
        $query = "SELECT * FROM courses";
        return $this->conn->query($query);
    }
    
    public function updateCourse($id, $title, $description, $category, $module, $duration, $price, $image) {
        $query = "UPDATE courses SET ";
        $params = [];
        $types = "";

        if ($title !== null) {
            $query .= "title = ?, ";
            $params[] = $title;
            $types .= "s";
        }
        if ($description !== null) {
            $query .= "description = ?, ";
            $params[] = $description;
            $types .= "s";
        }
        if ($category !== null) {
            $query .= "category = ?, ";
            $params[] = $category;
            $types .= "s";
        }
        if ($module !== null) {
            $query .= "module = ?, ";
            $params[] = $module;
            $types .= "s";
        }
        if ($duration !== null) {
            $query .= "duration = ?, ";
            $params[] = $duration;
            $types .= "i";
        }
        if ($price !== null) {
            $query .= "price = ?, ";
            $params[] = $price;
            $types .= "d";
        }
        if ($image !== null) {
            $query .= "image = ?, ";
            $params[] = $image;
            $types .= "s";
        }

        $query = rtrim($query, ", ") . " WHERE id = ?";
        $params[] = $id;
        $types .= "i";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param($types, ...$params);
        return $stmt->execute();
    }

    public function deleteCourse($id) {
        $query = "DELETE FROM courses WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>