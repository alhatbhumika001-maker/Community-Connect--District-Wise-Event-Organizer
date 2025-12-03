<?php

$conn = mysqli_connect("localhost", "root", "", "community_connect");

$full_name = $_POST['full_name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$role = $_POST['role'];
$district = $_POST['district'];

// Check password match
if ($password !== $confirm_password) {
    header("Location: signup.php?error=Password and Confirm Password do not match!");
    exit();
}

// ---- CHECK USERNAME ----
$checkUsername = "SELECT * FROM users WHERE username='$username'";
$resUsername = mysqli_query($conn, $checkUsername);
if (mysqli_num_rows($resUsername) > 0) {
    header("Location: signup.php?error=Username already exists!");
    exit();
}

// ---- CHECK EMAIL ----
$checkEmail = "SELECT * FROM users WHERE email='$email'";
$resEmail = mysqli_query($conn, $checkEmail);
if (mysqli_num_rows($resEmail) > 0) {
    header("Location: signup.php?error=Email already exists!");
    exit();
}

// ---- CHECK PASSWORD ----
// (Only works if passwords are stored as plain text)
$checkPassword = "SELECT * FROM users WHERE password='$password'";
$resPassword = mysqli_query($conn, $checkPassword);
if (mysqli_num_rows($resPassword) > 0) {
    header("Location: signup.php?error=Password already exists!");
    exit();
}

// Insert Query (plain text password)
$q = "INSERT INTO users (full_name, username, email, password, role, district)
      VALUES ('$full_name', '$username', '$email', '$password', '$role', '$district')";

$result = mysqli_query($conn, $q);

if ($result) {
    echo "<script>alert('Account Created Successfully'); window.location='login.php';</script>";
} else {
    header("Location: signup.php?error=Something went wrong!");
}

?>
