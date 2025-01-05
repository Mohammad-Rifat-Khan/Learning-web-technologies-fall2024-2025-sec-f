<?php
include_once '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $database = new Database();
    $db = $database->connect();

    $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
        echo "Registration successful!";
        header("Location: login.php");
        exit();
    } else {
        echo "Registration failed.";
    }
}
?>
