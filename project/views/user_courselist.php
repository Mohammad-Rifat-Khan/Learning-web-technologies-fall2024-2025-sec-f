<?php
// Start the session and establish a connection to the database
session_start();
$conn = new mysqli('127.0.0.1', 'root', '', 'learning_platform');

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize category from GET parameter
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Query to fetch all courses, or filter by category if set
$query = "SELECT * FROM courses";
if (!empty($category)) {
    $query .= " WHERE category = '$category'";
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - View Courses</title>
</head>
<body>
    <h1>Welcome, User! View Courses</h1>

    <!-- Filter by Category Form -->
    <h2>Filter Courses by Category</h2>
    <form method="GET" action="user_courselist.php">
        <label for="category">Category:</label>
        <select name="category" id="category">
            <option value="">All</option>
            <option value="technology" <?php echo ($category == 'technology') ? 'selected' : ''; ?>>Technology</option>
            <option value="crop" <?php echo ($category == 'crop') ? 'selected' : ''; ?>>Crop</option>
            <option value="livestock" <?php echo ($category == 'livestock') ? 'selected' : ''; ?>>livestock</option>
            <option value="marketing" <?php echo ($category == 'marketing') ? 'selected' : ''; ?>>Marketing</option>
        </select>
        <button type="submit">Filter</button>
    </form>

    <!-- Display All Courses -->
    <h2>Available Courses</h2>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div style='border:1px solid #ddd; padding:10px; margin-bottom:10px;'>";
            echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
            echo "<p><strong>Description:</strong> " . htmlspecialchars($row['description']) . "</p>";
            echo "<p><strong>Category:</strong> " . htmlspecialchars($row['category']) . "</p>";
            echo "<p><strong>Duration:</strong> " . htmlspecialchars($row['duration']) . "</p>";
            echo "<p><strong>Price:</strong> $" . htmlspecialchars($row['price']) . "</p>";

            // Display the image if it exists
            if (!empty($row['image'])) {
                echo "<img src='path_to_images/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['title']) . "' style='width:200px; height:auto;'><br>";
            }

            // Enroll Button (if not already enrolled)
            echo "<form action='enroll.php' method='POST'>"; // Form submits to enroll.php
            echo "<input type='hidden' name='course_id' value='" . $row['id'] . "'>";
            echo "<button type='submit'>Enroll</button>";
            echo "</form>";

            echo "</div><hr>";

            // Rating System
            echo "<form action='../controllers/ratingController.php' method='POST'>";
            echo "<label for='rating'>Rate this course: </label>";
            echo "<select name='rating' required>";
            for ($i = 1; $i <= 5; $i++) {
                echo "<option value='$i'>$i</option>";
            }
            echo "</select>";
            echo "<input type='hidden' name='course_id' value='" . $row['id'] . "'>";
            echo "<button type='submit'>Submit Rating</button>";
            echo "</form>";

            echo "</div><hr>";
        }
    } else {
        echo "<p>No courses available at the moment.</p>";
    }
    ?>
    <a href="login_form.php">Back to Home</a>
</body>
</html>