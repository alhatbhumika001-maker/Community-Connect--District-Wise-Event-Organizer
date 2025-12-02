<?php

$conn = mysqli_connect("localhost", "root", "", "community_connect");

$full_name = $_POST['full_name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$role = $_POST['role'];
$district = $_POST['district'];

// 🔍 Check if password and confirm password match
if ($password !== $confirm_password) {
    echo "<script>alert('Password and Confirm Password do not match!');</script>";
    exit(); // stop further execution
}

// Insert Query
$q = "INSERT INTO users (user_id, full_name, username, email, password, confirm_password, role, district)
      VALUES (NULL, '$full_name', '$username', '$email', '$password', '$confirm_password', '$role', '$district')";

$result = mysqli_query($conn, $q);

if ($result) {
    echo "<script>alert('Account Created Successfully'); window.location='login.php';</script>";
} else {
    echo "<script>alert('Something went wrong'); window.location='signup.php';</script>";
}

?>
