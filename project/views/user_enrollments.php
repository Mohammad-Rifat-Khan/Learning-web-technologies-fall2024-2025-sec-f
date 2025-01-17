<?php
session_start();
require_once '../config/database.php';
require_once '../models/EnrollmentModel.php';

$enrollmentModel = new EnrollmentModel($conn);
$user_id = 1; // Temporary user ID for testing

// Fetch enrollments
$enrollments = $enrollmentModel->getEnrollmentsByUser($user_id);

// Handle rating and comment submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course_id = $_POST['course_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    $query = "INSERT INTO course_ratings (user_id, course_id, rating, comment) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiis", $user_id, $course_id, $rating, $comment);
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Enrollments</title>
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
        .rate-button {
            display: inline-block;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .rate-button:hover {
            background-color: #0056b3;
        }
        .rating-form {
            margin-top: 10px;
        }
        .rating-form textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .rating-form button {
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .rating-form button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h1>My Enrollments</h1>
    <?php
    if ($enrollments->num_rows > 0) {
        while ($row = $enrollments->fetch_assoc()) {
            // Fetch course details
            $course_query = "SELECT * FROM courses WHERE id = ?";
            $course_stmt = $conn->prepare($course_query);
            $course_stmt->bind_param("i", $row['course_id']);
            $course_stmt->execute();
            $course_result = $course_stmt->get_result();
            $course = $course_result->fetch_assoc();

            echo "<div class='enrollment-card'>";
            echo "<h3>" . htmlspecialchars($course['title']) . "</h3>";
            echo "<p>Category: " . htmlspecialchars($course['category']) . "</p>";
            echo "<p>Module: " . htmlspecialchars($course['module']) . "</p>";
            echo "<p>Duration: " . htmlspecialchars($course['duration']) . " hours</p>";
            echo "<p>Price: $" . htmlspecialchars($course['price']) . "</p>";
            if (!empty($course['image'])) {
                echo "<p><img src='../uploads/" . htmlspecialchars($course['image']) . "' alt='Course Image'></p>";
            }
            echo "<form class='rating-form' method='POST'>";
            echo "<input type='hidden' name='course_id' value='" . $course['id'] . "'>";
            echo "<label for='rating'>Rating:</label>";
            echo "<select name='rating' id='rating'>";
            echo "<option value='1'>1</option>";
            echo "<option value='2'>2</option>";
            echo "<option value='3'>3</option>";
            echo "<option value='4'>4</option>";
            echo "<option value='5'>5</option>";
            echo "</select>";
            echo "<label for='comment'>Comment:</label>";
            echo "<textarea name='comment' id='comment' rows='4'></textarea>";
            echo "<button type='submit'>Submit Rating</button>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        echo "<p>No enrollments found.</p>";
    }
    $conn->close();
    ?>
</body>
</html>