<?php
session_start();
require_once '../config/database.php';
require_once '../models/CourseModel.php';

$conn = new mysqli("localhost", "root", "", "learning_platform");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$courseModel = new CourseModel($conn);
$result = $courseModel->getCourses();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Courses</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h1, h2 {
            color: #333;
        }
        form {
            margin-bottom: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input, textarea, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
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
        .course-card {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .course-card img {
            max-width: 100px;
            height: auto;
            display: block;
            margin-bottom: 10px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Form validation
            $("#courseForm").on("submit", function(e) {
                e.preventDefault();
                let isValid = true;
                $(this).find("input, textarea").each(function() {
                    if ($(this).val() === "") {
                        isValid = false;
                        alert("All fields are required.");
                        return false;
                    }
                });
                if (isValid) {
                    // AJAX request
                    $.ajax({
                        url: "../controlers/CourseController.php?action=create",
                        type: "POST",
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            alert("Course added successfully.");
                            location.reload();
                        },
                        error: function() {
                            alert("Error adding course.");
                        }
                    });
                }
            });

            // Update course
            $(".updateForm").on("submit", function(e) {
                e.preventDefault();
                let form = $(this);
                $.ajax({
                    url: "../controlers/CourseController.php?action=update",
                    type: "POST",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        alert("Course updated successfully.");
                        location.reload();
                    },
                    error: function() {
                        alert("Error updating course.");
                    }
                });
            });
        });
    </script>
</head>
<body>
    <h1>Admin Panel - Manage Courses</h1>

    <!-- Form to Add a New Course -->
    <h2>Add New Course</h2>
    <form id="courseForm" enctype="multipart/form-data">
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
    <h2>Existing Courses</h2>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='course-card'>";
            echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
            echo "<p>Category: " . htmlspecialchars($row['category']) . "</p>";
            echo "<p>Module: " . htmlspecialchars($row['module']) . "</p>";
            echo "<p>Duration: " . htmlspecialchars($row['duration']) . " hours</p>";
            echo "<p>Price: $" . htmlspecialchars($row['price']) . "</p>";
            if (!empty($row['image'])) {
                echo "<p><img src='../uploads/" . htmlspecialchars($row['image']) . "' alt='Course Image'></p>";
            }
            echo "<a href='admin_coursedetails.php?id=" . $row['id'] . "'>Details</a>";
            echo "</div>";
        }
    } else {
        echo "<p>No courses found.</p>";
    }
    $conn->close();
    ?>
</body>
</html>