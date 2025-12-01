<?php

$conn = mysqli_connect("localhost", "root", "", "community_connect");

$full_name = $_POST['full_name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$role = $_POST['role'];
$district = $_POST['district'];

// Fix: Remove 'user_id' from INSERT because it's auto_increment
$q = "INSERT INTO users (full_name, username, email, password, confirm_password, role, district) VALUES ('$full_name', '$username', '$email', '$password', '$confirm_password', '$role', '$district')";

$result = mysqli_query($conn, $q);

if ($result) {
    echo "<script>alert('Account Created Successfully'); window.location='index.php';</script>";
} else {
    echo "<script>alert('Something went wrong: " . mysqli_error($conn) . "'); window.location='signup.php';</script>";
}

?>
