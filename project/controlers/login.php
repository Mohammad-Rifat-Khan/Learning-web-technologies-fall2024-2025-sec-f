<?php
session_start();

// Database connection
$conn = new mysqli("127.0.0.1", "root", "", "learning_platform");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Admin login - updated credentials
    if ($username === 'admin' && $password === 'admin') {
        $_SESSION['username'] = 'admin';
        $_SESSION['is_admin'] = true;
        header("Location: ../views/admin_dashboard.php");
        exit();
    }

    // User login
     // User check
     $query = "SELECT username, password FROM users WHERE username = ? LIMIT 1";
     $stmt = $conn->prepare($query);
     $stmt->bind_param("s", $username);
     $stmt->execute();
     $result = $stmt->get_result();
 
     if ($result && $result->num_rows === 1) {
         $user = $result->fetch_assoc();
         if ($password === $user['password']) {  // Direct password comparison
             $_SESSION['username'] = $username;
             $_SESSION['is_admin'] = false;
             header("Location: ../views/user_courselist.php");
             exit();
         }
     }
     
     // Invalid login
     $_SESSION['error'] = "Invalid username or password";
     echo $_SESSION['error'];
     exit();
}
?>