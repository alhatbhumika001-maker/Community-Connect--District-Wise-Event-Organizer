<?php
$conn = mysqli_connect("localhost", "root", "", "community_connect");

if (!$conn) {
    die("Connection Failed");
}

$full_name = $_POST['full_name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$role = $_POST['role'];
$district = $_POST['district'];
$bio = $_POST['bio'];


// 🔹 PASSWORD MATCH CHECK
if ($password !== $confirm_password) {
    header("Location: signup.php?password_error=Password and Confirm Password do not match");
    exit();
}


// 🔹 CHECK IF USERNAME EXISTS
$check_username = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
if (mysqli_num_rows($check_username) > 0) {
    header("Location: signup.php?username_error=Username already exists");
    exit();
}


// 🔹 CHECK IF EMAIL EXISTS
$check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
if (mysqli_num_rows($check_email) > 0) {
    header("Location: signup.php?email_error=Email already exists");
    exit();
}


// 🔹 INSERT QUERY
$q = "INSERT INTO users (full_name, username, email, password, role, district, bio)
      VALUES ('$full_name', '$username', '$email', '$password', '$role', '$district', '$bio')";

$result = mysqli_query($conn, $q);

if ($result) {
    echo "<script>alert('Account Created Successfully'); window.location='login.php';</script>";
} else {
    header("Location: signup.php?error=Something went wrong! Please try again.");
}
?>
