<?php

$conn = mysqli_connect("localhost", "root", "", "community_connect");

$full_name = $_POST['full_name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$role = $_POST['role'];
$district = $_POST['district'];

// Check if password and confirm password match
if ($password !== $confirm_password) {
    header("Location: signup.php?error=Password and Confirm Password do not match!");
    exit();
}

// Check if username already exists
$user_check = mysqli_query($conn,"SELECT * FROM users WHERE username='$username'");
if(mysqli_num_rows($user_check) > 0){
    header("Location: signup.php?username_error=Username already exists");
    exit();
}

// Check if email already exists
$email_check = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
if(mysqli_num_rows($email_check) > 0){
    header("Location: signup.php?email_error=Email already exists");
    exit();
}

// Insert Query
$q = "INSERT INTO users (user_id, full_name, username, email, password, confirm_password, role, district)
      VALUES (NULL, '$full_name', '$username', '$email', '$password', '$confirm_password', '$role', '$district')";

$result = mysqli_query($conn, $q);

if ($result) {
    echo "<script>alert('Account Created Successfully'); window.location='login.php';</script>";
} else {
    header("Location: signup.php?error=Something went wrong!");
}

?>
