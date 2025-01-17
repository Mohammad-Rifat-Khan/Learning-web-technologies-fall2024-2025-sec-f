<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php
    if (isset($_SESSION['error'])) {
        echo "<p style='color: red;'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['message'])) {
        echo "<p style='color: green;'>" . $_SESSION['message'] . "</p>";
        unset($_SESSION['message']);
    }
    ?>
    <form action="../controllers/login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="register_form.php">Register here</a>.</p>
</body>
</html>