<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: login_form.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1> <!-- Display the logged-in username -->
    <a href="admin_courselist.php">Manage Courses</a><br>
    <a href="usermanagement.php">Manage Users</a><br>
    <a href="../controlers/logout.php">Logout</a>
</body>
</html>