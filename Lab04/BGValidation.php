<html>
<head>
    <title>Blood Group Form</title>
</head>
<body>
    <form method="post" action="">
        <fieldset style="width: 200px">
            <legend>Blood Group</legend>
            <select name="bloodGroup">
                <option value="">Select Blood Group</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
            </select>
            <hr>
            <br>
            <input type="submit" name="submit" value="Submit">
        </fieldset>
    </form>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedBloodGroup = $_POST['bloodGroup']; 
    
    if (empty($selectedBloodGroup)) {
        echo "Please select a blood group.";
    } elseif ($selectedBloodGroup === "Select Blood Group") {
        echo "Please select a valid blood group.";
    } else {
        echo "Validation successful. Selected blood group: $selectedBloodGroup";
    }
}
?>


