<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<p>You must be logged in to view course details.</p>";
    exit();
}

// Connect to the database
$conn = new mysqli('127.0.0.1', 'root', '', 'learning_platform');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the course ID from the GET request
$id = $_GET['id'] ?? 0;

// Fetch course details
$query = "SELECT * FROM courses WHERE id=$id";
$result = $conn->query($query);
$course = $result->fetch_assoc();
if (!$course) {
    echo "<p>Course not found.</p>";
    exit();
}

// Fetch additional details for the course
$additional_query = "SELECT * FROM course_details WHERE course_id=$id";
$additional_result = $conn->query($additional_query);
$additional_details = $additional_result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Course Details</title>
</head>
<body>
    <h1><?php echo $course['title']; ?></h1>
    <p><strong>Description:</strong> <?php echo $course['description']; ?></p>
    <p><strong>Category:</strong> <?php echo $course['category']; ?></p>
    <?php if ($additional_details): ?>
        <p><strong>Duration:</strong> <?php echo $additional_details['duration']; ?></p>
        <p><strong>Price:</strong> $<?php echo $additional_details['price']; ?></p>
        <p><strong>Learning Objectives:</strong></p>
        <ul>
            <?php
            $objectives = explode(',', $additional_details['objectives']);
            foreach ($objectives as $objective) {
                echo "<li>" . htmlspecialchars($objective) . "</li>";
            }
            ?>
        </ul>
        <div>
            <h3>Course Video Module:</h3>
            <video width="640" height="360" controls>
                <source src="videos/<?php echo $additional_details['video_file']; ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    <?php else: ?>
        <p>No additional details available for this course.</p>
    <?php endif; ?>
    <form method="POST" action="enroll.php">
        <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
        <button type="submit">Enroll</button>
    </form>
    <a href="index.php">Back to Courses</a>
</body>
</html>
