<?php
    session_start();

    error_reporting(E_ALL & ~E_NOTICE);  
    ini_set('display_errors', 0);

    if(isset($_POST['submit'])){
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);

        if(empty($username) || empty($password)){
            echo "<h3>Username or Password is emtpy</h3>";
        }
        else if($_SESSION["username"] === $username && $_SESSION["password"] === $password){
            $_SESSION['status'] = true;
            setcookie('flag', 'true', time()+3600, '/');
            header("location:home_page.php");
        }
        else{
            echo "<h3>Invalid Username and Password!</h3>";
        }

    }
    else{
        header("location:login.html");
    }
?>