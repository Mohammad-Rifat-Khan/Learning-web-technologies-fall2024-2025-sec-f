<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="../controller/userController.php" method="POST">
        <input type="hidden" name="action" value="login">
        <label>Username:</label>
        <input type="text" name="user_name" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
    <a href="signup.php">Don't have an account? Sign up</a>
</body>
</html>