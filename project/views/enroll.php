<?php
session_start();

// Database connection
$conn = new mysqli('127.0.0.1', 'root', '', 'learning_platform');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if course_id is provided
if (!isset($_POST['course_id'])) {
    $_SESSION['error'] = "Invalid course ID";
    header("Location: user_courselist.php");
    exit();
}

$course_id = $_POST['course_id'];
$username = $_SESSION['username'];

// Fetch user_id from username
$user_query = "SELECT id FROM users WHERE username = ?";
$user_stmt = $conn->prepare($user_query);
$user_stmt->bind_param('s', $username);
$user_stmt->execute();
$user_result = $user_stmt->get_result();

if ($user_result->num_rows === 1) {
    $user = $user_result->fetch_assoc();
    $user_id = $user['id'];
} else {
    $_SESSION['error'] = "User not found";
    header("Location: user_courselist.php");
    exit();
}

// Insert enrollment
$insert_query = "INSERT INTO enrollments (user_id, course_id) VALUES (?, ?)";
$insert_stmt = $conn->prepare($insert_query);
$insert_stmt->bind_param('ii', $user_id, $course_id);

if ($insert_stmt->execute()) {
    $_SESSION['message'] = "Successfully enrolled!";
} else {
    $_SESSION['error'] = "Enrollment failed: " . $insert_stmt->error;
}

// Close connections
$user_stmt->close();
$insert_stmt->close();
$conn->close();

header("Location: user_courselist.php");
exit();
?>