<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db_connection.php';

    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    $mobile = mysqli_real_escape_string($conn, $mobile);
    $password = sha1($password); // Hash the password

    $sql = "SELECT * FROM user WHERE mobile='$mobile' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['name'];
            $_SESSION['flash'] = "Login Succesfully.";
            header("Location: admin/dashboard.php");
            exit();
        } else {
            $_SESSION['login_error'] = "Invalid mobile number or password";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['login_error'] = "Database error. Please try again later";
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}

session_start();

$_SESSION = array();
session_destroy();
header("Location: login.php");
exit();
