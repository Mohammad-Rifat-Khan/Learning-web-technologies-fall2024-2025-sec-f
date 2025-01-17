<?php
// Start the session and establish a connection to the database
session_start();
require_once '../config/database.php';

// Initialize category from GET parameter
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Query to fetch all courses, or filter by category if set
$query = "SELECT * FROM courses";
if (!empty($category)) {
    $query .= " WHERE category = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $category);
} else {
    $stmt = $conn->prepare($query);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - View Courses</title>
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
        select, button {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
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
        .details-button {
            display: inline-block;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .details-button:hover {
            background-color: #0056b3;
        }
    </style>
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
            <option value="livestock" <?php echo ($category == 'livestock') ? 'selected' : ''; ?>>Livestock</option>
            <option value="marketing" <?php echo ($category == 'marketing') ? 'selected' : ''; ?>>Marketing</option>
        </select>
        <button type="submit">Filter</button>
    </form>

    <!-- Display All Courses -->
    <h2>Available Courses</h2>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='course-card'>";
            echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
            echo "<p>Category: " . htmlspecialchars($row['category']) . "</p>";
            if (!empty($row['image'])) {
                echo "<p><img src='../uploads/" . htmlspecialchars($row['image']) . "' alt='Course Image'></p>";
            }
            echo "<a class='details-button' href='user_coursedetails.php?id=" . $row['id'] . "'>Details</a>";
            echo "</div>";
        }
    } else {
        echo "<p>No courses found.</p>";
    }
    $conn->close();
    ?>
</body>
</html>