<?php
require 'db.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST['userName'];

    $sql = "DELETE FROM register WHERE userName = ?";

    if($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $userName);

        if(mysqli_stmt_execute($stmt)) {
            if(mysqli_stmt_affected_rows($stmt) > 0) {
                echo "Employee deleted successfully.";
            } else {
                echo "No such employee found.";
            }
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
?>
