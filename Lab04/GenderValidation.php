<html>
<head>
    <title>Gender Form</title>
</head>
<body>
    <p>Please enter Gender</p>
    <form method="post">
        <fieldset style="width: 200px">
            <legend>GENDER</legend>

            <input type="radio" name="gender" value="male"> Male
            <input type="radio" name="gender" value="female"> Female
            <input type="radio" name="gender" value="other"> Other

            <hr>
            <input type="submit" name="submit" value="Submit">
        </fieldset>
    </form>
</body>
</html>


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gender = isset($_POST['gender']) ? $_POST['gender'] : null;

    if (!empty($gender)) {
        header("Location: DegreeValidation.php");
        exit();
    }
}
?>