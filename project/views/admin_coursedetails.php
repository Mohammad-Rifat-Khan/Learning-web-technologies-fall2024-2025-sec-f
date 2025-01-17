<?php
// Start the session and include necessary files
session_start();
require_once '../config/database.php';
require_once '../controlers/CourseController.php';

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
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form submission
            document.getElementById('courseForm').addEventListener('submit', function(e) {
                e.preventDefault();
                // AJAX request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '../controlers/CourseController.php?action=update', true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var res = JSON.parse(xhr.responseText);
                        if (res.error) {
                            alert('Error: ' + res.error);
                        } else {
                            alert('Course updated successfully.');
                            location.reload();
                        }
                    }
                };
                xhr.send(new FormData(this));
            });

            // Delete course
            document.getElementById('deleteCourse').addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('Are you sure you want to delete this course?')) {
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', '../controlers/CourseController.php?action=delete', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            var res = JSON.parse(xhr.responseText);
                            if (res.error) {
                                alert('Error: ' + res.error);
                            } else {
                                alert('Course deleted successfully.');
                                window.location.href = 'admin_courselist.php';
                            }
                        }
                    };
                    xhr.send('id=' + <?php echo $id; ?>);
                }
            });

            // Display selected image
            document.getElementById('image').addEventListener('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('courseImage').src = e.target.result;
                };
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
</head>
<body>
    <h1><?php echo htmlspecialchars($course['title']); ?></h1>
    <form id="courseForm" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $course['id']; ?>">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($course['title']); ?>">
        <br>
        <label for="description">Description:</label>
        <textarea name="description" id="description"><?php echo htmlspecialchars($course['description']); ?></textarea>
        <br>
        <label for="category">Category:</label>
        <input type="text" name="category" id="category" value="<?php echo htmlspecialchars($course['category']); ?>">
        <br>
        <label for="module">Module:</label>
        <input type="text" name="module" id="module" value="<?php echo htmlspecialchars($course['module']); ?>">
        <br>
        <label for="duration">Duration (hours):</label>
        <input type="number" name="duration" id="duration" value="<?php echo htmlspecialchars($course['duration']); ?>">
        <br>
        <label for="price">Price ($):</label>
        <input type="number" name="price" id="price" value="<?php echo htmlspecialchars($course['price']); ?>">
        <br>
        <label for="image">Image:</label>
        <input type="file" name="image" id="image">
        <br>
        <img id="courseImage" src="../uploads/<?php echo htmlspecialchars($course['image']); ?>" alt="Course Image">
        <br>
        <button type="submit">Save</button>
        <button id="deleteCourse">Delete Course</button>
    </form>
</body>
</html>