<?php
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

$link = mysqli_connect('localhost', 'root', '', 'community_connect');

$q = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($link, $q);

if (mysqli_num_rows($result) >= 1) {       
    $data = mysqli_fetch_assoc($result);   
    $_SESSION['login_user'] = $data;

    $role = strtolower($data['role']);  // normalize case

    if ($role == 'admin') {
        header("Location: adminDashboard.php");
    } 
    elseif ($role == 'volunteer') {
        header("Location: Dashboard.php");
    } 
    elseif ($role == 'organizer') {
        header("Location: Dashboard.php");
    }
    else {
        // Fallback redirect if role doesn't match
        header("Location: index.php");
    }

    exit();
} 
else {
    header("Location: login.php?error=1");
    exit();
}
?>