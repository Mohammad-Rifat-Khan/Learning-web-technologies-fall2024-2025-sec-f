<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="../controlers/login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter username" required>
        <br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter password" required>
        <br><br>
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="register_form.php">Register here</a></p>
</body>
</html>
