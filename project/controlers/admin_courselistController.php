<?php
$conn = new mysqli('127.0.0.1', 'root', '', 'learning_platform');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the uploads directory exists
$uploads_dir = '../assets';
if (!is_dir($uploads_dir)) {
    mkdir($uploads_dir, 0777, true);
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action === 'create') {
        // Create a new course
        $title = $_POST['title'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $module = $_POST['module'];
        $duration = $_POST['duration'];
        $price = $_POST['price'];

        // Handle image upload
        $image = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], "$uploads_dir/$image");
        }

        $query = "INSERT INTO courses (title, description, category, module, duration, price, image) 
                  VALUES ('$title', '$description', '$category', '$module', '$duration', '$price', '$image')";
        if ($conn->query($query)) {
            header("Location: ../views/admin_courselist.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } elseif ($action === 'update') {
        // Update an existing course
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $module = $_POST['module'];
        $duration = $_POST['duration'];
        $price = $_POST['price'];

        // Handle image upload
        $image_query = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], "$uploads_dir/$image");
            $image_query = ", image='$image'";
        }

        $query = "UPDATE courses 
                  SET title='$title', description='$description', category='$category', module='$module', 
                      duration='$duration', price='$price' $image_query 
                  WHERE id='$id'";
        if ($conn->query($query)) {
            header("Location: ../views/admin_courselist.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } elseif ($action === 'delete') {
        // Delete a course
        $id = $_POST['id'];

        // Remove the associated image
        $query = "SELECT image FROM courses WHERE id='$id'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['image']) {
                $image_path = "$uploads_dir/" . $row['image'];
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
        }

        $query = "DELETE FROM courses WHERE id='$id'";
        if ($conn->query($query)) {
            header("Location: ../views/admin_courselist.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>
