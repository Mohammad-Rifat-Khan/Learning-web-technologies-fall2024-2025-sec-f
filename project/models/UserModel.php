<?php
class UserModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createUser($username, $email, $password) {
        $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $username, $email, $password);
        return $stmt->execute();
    }

    public function getUserByUsername($username) {
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateUser($id, $username, $email, $password) {
        $query = "UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssi", $username, $email, $password, $id);
        return $stmt->execute();
    }

    public function deleteUser($id) {
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>