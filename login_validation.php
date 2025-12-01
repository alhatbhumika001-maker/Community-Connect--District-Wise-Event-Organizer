<?php
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

$link = mysqli_connect('localhost', 'root', '', 'community_connect');

$q = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($link, $q);

if (mysqli_num_rows($result) >= 1) {
    $data = mysqli_fetch_array($result);
    $_SESSION['login_user'] = $data;
    header("Location: index.php");
    exit();
} else {
    // Always show the same error message
    header("Location: login.php?error=1"); // error=1 set flag=1 or not
    exit();
}
?>
