<?php
session_start();
require_once '../config/database.php';
require_once '../models/EnrollmentModel.php';

$enrollmentModel = new EnrollmentModel($conn);

// Get the course ID from the GET request
$id = $_GET['id'] ?? 0;

// Fetch course details
$query = "SELECT * FROM courses WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$course = $result->fetch_assoc();
if (!$course) {
    echo "<p>Course not found.</p>";
    exit();
}

// Handle enrollment
$enrollmentMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = 1; // Temporary user ID for testing
    $course_id = $id;

    if ($enrollmentModel->enrollUser($user_id, $course_id)) {
        $enrollmentMessage = "Successfully enrolled in the course!";
    } else {
        $enrollmentMessage = "Failed to enroll in the course.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h1, h2 {
            color: #333;
        }
        .course-details {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .course-details img {
            max-width: 100px;
            height: auto;
            display: block;
            margin-bottom: 10px;
        }
        button {
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .return-button {
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .return-button:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var message = "<?php echo $enrollmentMessage; ?>";
            if (message) {
                alert(message);
            }
        });
    </script>
</head>
<body>
    <h1><?php echo htmlspecialchars($course['title']); ?></h1>
    <div class="course-details">
        <p><?php echo htmlspecialchars($course['description']); ?></p>
        <p>Category: <?php echo htmlspecialchars($course['category']); ?></p>
        <p>Module: <?php echo htmlspecialchars($course['module']); ?></p>
        <p>Duration: <?php echo htmlspecialchars($course['duration']); ?> hours</p>
        <p>Price: $<?php echo htmlspecialchars($course['price']); ?></p>
        <?php if (!empty($course['image'])): ?>
            <p><img src="../uploads/<?php echo htmlspecialchars($course['image']); ?>" alt="Course Image"></p>
        <?php endif; ?>
        <form method="POST">
            <button type="submit">Enroll in this Course</button>
        </form>
        <a class="return-button" href="user_enrollments.php">View Enrolled Courses</a>
    </div>
</body>
</html>