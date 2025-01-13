<?php
include_once "../model/employeemodel.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'search') {
    $searchTerm = trim($_POST['search_term']);
    $conn = get_connection();

    $sql = "SELECT * FROM users WHERE user_name LIKE '%$searchTerm%' OR employee_name LIKE '%$searchTerm%' OR contact_no LIKE '%$searchTerm%'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['user_name']}</td>
                    <td>{$row['employee_name']}</td>
                    <td>{$row['contact_no']}</td>
                    <td>
                        <a href='updateEmployee.php?user_name={$row['user_name']}'>Update</a>
                        <a href='../controller/deleteEmployee.php?user_name={$row['user_name']}' onclick=\"return confirm('Are you sure you want to delete this employee?');\">Delete</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No employees found</td></tr>";
    }

    mysqli_close($conn);
}
?>
