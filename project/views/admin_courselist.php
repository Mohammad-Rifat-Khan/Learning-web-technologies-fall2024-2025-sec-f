<?php
session_start();

// Ensure only admins can access this page
if (!isset($_SESSION['username'])) {
    echo "<p>Access denied. Only admins can view this page.</p>";
    exit();
}

$conn = new mysqli('127.0.0.1', 'root', '', 'learning_platform');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all courses
$query = "SELECT * FROM courses";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin - Manage Courses</title>
</head>
<body>
    <h1>Admin Panel - Manage Courses</h1>

    <!-- Form to Add a New Course -->
    <h2>Add New Course</h2>
    <form action="../controllers/CourseController.php?action=create" method="POST" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
        <br>
        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea>
        <br>
        <label for="category">Category:</label>
        <input type="text" name="category" id="category" required>
        <br>
        <label for="module">Module:</label>
        <input type="text" name="module" id="module" required>
        <br>
        <label for="duration">Duration (hours):</label>
        <input type="number" name="duration" id="duration" required>
        <br>
        <label for="price">Price ($):</label>
        <input type="number" step="0.01" name="price" id="price" required>
        <br>
        <label for="image">Image:</label>
        <input type="file" name="image" id="image" accept="image/*" required>
        <br>
        <button type="submit">Add Course</button>
    </form>

    <hr>

    <!-- Display All Courses -->
    <h2>Existing Courses:-</h2>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
            echo "<p>" . htmlspecialchars($row['description']) . "</p>";
            echo "<p>Category: " . htmlspecialchars($row['category']) . "</p>";
            echo "<p>Module: " . htmlspecialchars($row['module']) . "</p>";
            echo "<p>Duration: " . htmlspecialchars($row['duration']) . " hours</p>";
            echo "<p>Price: $" . htmlspecialchars($row['price']) . "</p>";
            if (!empty($row['image'])) {
                echo "<p><img src='../uploads/" . htmlspecialchars($row['image']) . "' alt='Course Image' style='width:100px;height:auto;'></p>";
            }

            // Update form
            echo "<form action='../controllers/admin_courselistController.php?action=update' method='POST' enctype='multipart/form-data'>";
            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
            echo "<label for='title'>Title:</label>";
            echo "<input type='text' name='title' value='" . htmlspecialchars($row['title']) . "' required>";
            echo "<br>";
            echo "<label for='description'>Description:</label>";
            echo "<textarea name='description' required>" . htmlspecialchars($row['description']) . "</textarea>";
            echo "<br>";
            echo "<label for='category'>Category:</label>";
            echo "<input type='text' name='category' value='" . htmlspecialchars($row['category']) . "' required>";
            echo "<br>";
            echo "<label for='module'>Module:</label>";
            echo "<input type='text' name='module' value='" . htmlspecialchars($row['module']) . "' required>";
            echo "<br>";
            echo "<label for='duration'>Duration (hours):</label>";
            echo "<input type='number' name='duration' value='" . htmlspecialchars($row['duration']) . "' required>";
            echo "<br>";
            echo "<label for='price'>Price ($):</label>";
            echo "<input type='number' step='0.01' name='price' value='" . htmlspecialchars($row['price']) . "' required>";
            echo "<br>";
            echo "<label for='image'>Image:</label>";
            echo "<input type='file' name='image' accept='image/*'>";
            echo "<br>";
            echo "<button type='submit'>Update Course</button>";
            echo "</form>";

            // Delete form
            echo "<form action='../controllers/admin_courselistController.php?action=delete' method='POST'>";
            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
            echo "<button type='submit'>Delete Course</button>";
            echo "</form>";

            echo "</div><hr>";
        }
    } else {
        echo "<p>No courses found.</p>";
    }
    ?>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>