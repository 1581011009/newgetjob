<?php
session_start();

$username = "";
$email = "";
$errors = array();

$dbconnect = @mysqli_connect('localhost', 'root', 'root', 'test');

if (isset($_POST['register'])) 
{
    $username = mysqli_real_escape_string($dbconnect,$_POST['username']);
    $email = mysqli_real_escape_string($dbconnect,$_POST ['email']);
    $password_1 = mysqli_real_escape_string($dbconnect,$_POST['password_1']);
    $password_2 = mysqli_real_escape_string($dbconnect,$_POST['password_2']);

    if (empty($username)) {
        array_push($errors, "Username is required ");
    }
    if (empty($email)) {
        array_push($errors, "Email is required ");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required ");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }
    if (count($errors) == 0) {
        $password = md5($password_1);
        $sql = "INSERT INTO member_account (username, email, password)
                    VALUES ('$username','$email','$password')";
        mysqli_query($dbconnect, $sql);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
    }
}

if (isset($_POST['login'])) 
{
    $email= mysqli_real_escape_string($dbconnect,$_POST['email']);
    $password = mysqli_real_escape_string($dbconnect,$_POST['password']);
    if (empty($email)) {
        array_push($errors, "Email is required ");
    }
    if (empty($password)) {
        array_push($errors, "Password is required ");
    }
    if (count($errors) == 0) 
    {
        $password = md5($password);
        $query = "SELECT * FROM member_account WHERE email='$email' AND password='$password'";
        $result = mysqli_query($dbconnect, $query);
        if (mysqli_num_rows($result) == 1) 
        {
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: index.html');
        }
        else
        {
            array_push($errors, "Wrong username/password combination");
        }
    }
}


if (isset($_GET['logout'])) 
{
    session_destroy();
    unset($_SESSION['username']);
    header('location: login.php');
}
?>