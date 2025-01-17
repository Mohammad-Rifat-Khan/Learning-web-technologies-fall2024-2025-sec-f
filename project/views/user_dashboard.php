<?php
session_start();
/*if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Dashboard</title>
</head>
<body>
    <h1>Welcome, User!</h1>
    <a href="user_courselist.php">View Courses</a>
    <a href="logout.php">Logout</a>
</body>
</html>