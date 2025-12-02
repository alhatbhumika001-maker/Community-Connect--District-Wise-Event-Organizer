<?php
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

$link = mysqli_connect('localhost', 'root', '', 'community_connect');

$q = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($link, $q);

if (mysqli_num_rows($result) >= 1) {       // ← you deleted this by mistake
    $data = mysqli_fetch_assoc($result);   // ← you must fetch $data

    // Redirect based on user role
    if ($data['role'] === 'admin') {
        header("Location: adminDashboard.php");
    } 
    elseif ($data['role'] === 'volunteer') {
        header("Location: volunteerDashboard.php");
    } 
    else {
        header("Location: index.php"); // default user
    }

    exit();
} 
else {
    header("Location: login.php?error=1");
    exit();
}
?>
