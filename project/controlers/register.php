<?php
session_start();
require_once '../config/database.php';
require_once '../models/UserModel.php';

$conn = new mysqli("localhost", "root", "", "learning_platform");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userModel = new UserModel($conn);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validate input
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: ../views/register_form.php");
        exit();
    }

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: ../views/register_form.php");
        exit();
    }

    // Check if username or email already exists
    $existingUser = $userModel->getUserByUsername($username);
    if ($existingUser) {
        $_SESSION['error'] = "Username already taken.";
        header("Location: ../views/register_form.php");
        exit();
    }

    // Register user
    if ($userModel->createUser($username, $email, $password)) {
        $_SESSION['message'] = "Registration successful. Please log in.";
        header("Location: ../views/login_form.php");
        exit();
    } else {
        $_SESSION['error'] = "Registration failed. Please try again.";
        header("Location: ../views/register_form.php");
        exit();
    }
}

$conn->close();
?>