<?php
session_start();
require_once '../config/database.php';
require_once '../controlers/EnrollmentController.php';

$enrollmentController = new EnrollmentController($conn);

// Handle course deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_enrollment'])) {
    $enrollment_id = $_POST['enrollment_id'];
    if ($enrollmentController->deleteEnrollment($enrollment_id)) {
        echo "<p>Enrollment deleted successfully.</p>";
    } else {
        echo "<p>Failed to delete enrollment.</p>";
    }
    header("Location: admin_enrollments.php");
    exit();
}

// Handle adding a course to a user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_enrollment'])) {
    $user_id = $_POST['user_id'];
    $course_id = $_POST['course_id'];
    if ($enrollmentController->addEnrollment($user_id, $course_id)) {
        echo "<p>Enrollment added successfully.</p>";
    } else {
        echo "<p>Failed to add enrollment.</p>";
    }
    header("Location: admin_enrollments.php");
    exit();
}

// Fetch all enrollments
$enrollments = $enrollmentController->getAllEnrollments();

// Fetch all users and courses for the add enrollment form
$users = $enrollmentController->getAllUsers();
$courses = $enrollmentController->getAllCourses();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Enrollments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h1, h2 {
            color: #333;
        }
        .enrollment-card {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .enrollment-card img {
            max-width: 100px;
            height: auto;
            display: block;
            margin-bottom: 10px;
        }
        .delete-button {
            display: inline-block;
            padding: 10px 15px;
            background-color: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            border: none;
            cursor: pointer;
        }
        .delete-button:hover {
            background-color: #c82333;
        }
        .add-enrollment-form {
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .add-enrollment-form select, .add-enrollment-form button {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .add-enrollment-form button {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        .add-enrollment-form button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h1>Admin - Manage Enrollments</h1>
    <?php
    if ($enrollments->num_rows > 0) {
        while ($row = $enrollments->fetch_assoc()) {
            echo "<div class='enrollment-card'>";
            echo "<h3>Course: " . htmlspecialchars($row['title']) . "</h3>";
            echo "<p>User: " . htmlspecialchars($row['username']) . "</p>";
            echo "<p>Enrollment Date: " . htmlspecialchars($row['enrollment_date']) . "</p>";
            echo "<p>Rating: " . htmlspecialchars($row['rating']) . "</p>";
            echo "<p>Comment: " . htmlspecialchars($row['comment']) . "</p>";
            echo "<form method='POST'>";
            echo "<input type='hidden' name='enrollment_id' value='" . $row['enrollment_id'] . "'>";
            echo "<button type='submit' name='delete_enrollment' class='delete-button'>Delete Enrollment</button>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        echo "<p>No enrollments found.</p>";
    }
    ?>

    <h2>Add Course to User</h2>
    <form class="add-enrollment-form" method="POST">
        <label for="user_id">User:</label>
        <select name="user_id" id="user_id">
            <?php while ($user = $users->fetch_assoc()): ?>
                <option value="<?php echo $user['id']; ?>"><?php echo htmlspecialchars($user['username']); ?></option>
            <?php endwhile; ?>
        </select>
        <label for="course_id">Course:</label>
        <select name="course_id" id="course_id">
            <?php while ($course = $courses->fetch_assoc()): ?>
                <option value="<?php echo $course['id']; ?>"><?php echo htmlspecialchars($course['title']); ?></option>
            <?php endwhile; ?>
        </select>
        <button type="submit" name="add_enrollment">Add Enrollment</button>
    </form>
</body>
</html>