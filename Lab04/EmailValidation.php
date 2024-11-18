<!DOCTYPE html>
<html>
<head>
    <title>Email Form</title>
</head>
<body>
    <form method="post" action="">
        <fieldset style="width: 340px">
            <legend>EMAIL</legend>
            <input type="email" name="email" value="" placeholder="sample@example.com">
            <hr>
            <input type="submit" value="Submit">
        </fieldset>
    </form>
</body>
</html>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    if (empty($email)) {
        echo "Please enter a valid email address";
    } else {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: DOBValidation.php");
            exit();
        } else {
            echo "Please enter a valid email address";
        }
    }
}
?>
