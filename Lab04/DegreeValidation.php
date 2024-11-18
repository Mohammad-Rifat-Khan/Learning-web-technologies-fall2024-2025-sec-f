<html>
<head>
    <title>Degree Form</title>
</head>
<body>
    <form method="post" action = "">
        <fieldset style="width: 250px">
            <legend>Degree</legend>
            <input type="checkbox" name="option[]" value="SSC"> SSC
            <input type="checkbox" name="option[]" value="HSC"> HSC
            <input type="checkbox" name="option[]" value="BSc"> BSc
            <input type="checkbox" name="option[]" value="MSc"> MSc
            <hr>
            <input type="submit" name="submit" value="Submit">
        </fieldset>
    </form>
</body>
</html>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if 'email' is set before accessing it
    $email = isset($_POST['email']) ? $_POST['email'] : null;

    if (isset($_POST['option']) && count($_POST['option']) >= 2) {
        // Assuming 'BDValidation.php' is the correct redirection URL
        header("Location: BGValidation.php");
        exit();
    } else {
        echo "Please select at least two options.";
    }
}
?>


