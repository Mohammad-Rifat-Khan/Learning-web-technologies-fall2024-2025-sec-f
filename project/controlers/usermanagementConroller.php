<?php
$conn = new mysqli('127.0.0.1', 'root', '', 'learning_platform');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action === 'create') {
        // Create a new user
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        if ($conn->query($query)) {
            header("Location: ../views/admin_userlist.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } elseif ($action === 'update') {
        // Update an existing user
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = isset($_POST['password']) && !empty($_POST['password']) 
            ? password_hash($_POST['password'], PASSWORD_BCRYPT) 
            : null;

        $query = "UPDATE users SET name='$name', email='$email'";
        if ($password) {
            $query .= ", password='$password'";
        }
        $query .= " WHERE id='$id'";

        if ($conn->query($query)) {
            header("Location: ../views/admin_userlist.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } elseif ($action === 'delete') {
        // Delete a user
        $id = $_POST['id'];

        $query = "DELETE FROM users WHERE id='$id'";
        if ($conn->query($query)) {
            header("Location: ../views/admin_userlist.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>