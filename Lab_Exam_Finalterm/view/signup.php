<!DOCTYPE html>
<html lang="en">
<head>
    <title>Signup</title>
    <script>
        function validateSignup() {
            const username = document.getElementById('username').value.trim();
            const employeeName = document.getElementById('employee_name').value.trim(); // Changed from author_name to employee_name
            const contactNo = document.getElementById('contact_no').value.trim();
            const password = document.getElementById('password').value.trim();
            let valid = true;

            if (!username) {
                document.getElementById('usernameError').innerText = 'Username is required.';
                valid = false;
            } else {
                document.getElementById('usernameError').innerText = '';
            }

            if (!employeeName) {
                document.getElementById('employeeNameError').innerText = 'Employee name is required.'; // Changed from 'Author' to 'Employee'
                valid = false;
            } else {
                document.getElementById('employeeNameError').innerText = '';
            }

            if (!contactNo) {
                document.getElementById('contactNoError').innerText = 'Contact number is required.';
                valid = false;
            } else {
                document.getElementById('contactNoError').innerText = '';
            }

            if (!password) {
                document.getElementById('passwordError').innerText = 'Password is required.';
                valid = false;
            } else {
                document.getElementById('passwordError').innerText = '';
            }

            return valid;
        }
    </script>
</head>
<body>
    <h1>Signup</h1>
    <form action="../controller/userController.php" method="POST" onsubmit="return validateSignup();">
        <input type="hidden" name="action" value="signup">
        <label for="username">Username:</label>
        <input type="text" id="username" name="user_name">
        <span id="usernameError" style="color: red;"></span><br><br>
        
        <label for="employee_name">Employee Name:</label> <!-- Changed from Author Name to Employee Name -->
        <input type="text" id="employee_name" name="employee_name">
        <span id="employeeNameError" style="color: red;"></span><br><br>
        
        <label for="contact_no">Contact Number:</label>
        <input type="text" id="contact_no" name="contact_no">
        <span id="contactNoError" style="color: red;"></span><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <span id="passwordError" style="color: red;"></span><br><br>
        
        <button type="submit">Signup</button>
    </form>
</body>
</html>