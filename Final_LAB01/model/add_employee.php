<?php
require 'db.php'; 

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeeName = $_POST['employeeName'];
    $contact = $_POST['contact'];
    $userName = $_POST['userName'];
    $password = $_POST['password'];

    $sql = "INSERT INTO register (userName, employeeName, contact, password) VALUES (?, ?, ?, ?)";

    if($result = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($result, "ssss", $userName, $employeeName, $contact, $password);

        if(mysqli_stmt_execute($result)) {
            echo "Employee added successfully. <br>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        mysqli_stmt_close($result);
    }
    mysqli_close($conn);
}
?>
