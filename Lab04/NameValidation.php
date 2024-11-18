<!DOCTYPE html>
<html>
<head>
    <title>Name Form</title>
</head>
<body>  
    <form method="post" action="">
        <fieldset style="width: 250px;">
            <legend>NAME</legend>
            <input type="text" name="name" value="" /> <br>
            <hr>
            <input type="submit" value="Submit">
        </fieldset>
    </form>
</body>
</html>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];

    if (empty($name)) {
        echo "Don't keep it empty";
    } else {
        $wordCount = str_word_count($name);

        if ($wordCount >= 2 && isValidName($name)) {
            header("Location: EmailValidation.php");
            exit();
        } else {
            echo "Please ensure it contains at least two words,<br>
            starts with a letter and only contains letters, period, and dash.";
        }
    }
}

function isValidName($name) {
    $validChars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ.- ';
    for ($i = 0; $i < strlen($name); $i++) {
        if (strpos($validChars, $name[$i]) === false) {
            return false;
        }
    }
    return true;
}
?>