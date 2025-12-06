<?php
session_start(); // session start karna zaruri hai
$conn = mysqli_connect("localhost", "root", "", "community_connect");

// Logged-in user ID
$user_id = $_SESSION['user_id'] ?? 0; // agar session me id nahi hai to 0

if ($user_id == 0) {
    die("You must be logged in to create a community.");
}


// Image upload
$filename = $_FILES["image"]["name"];
$tmpname = $_FILES["image"]["tmp_name"];
$folder = "image/" . $filename;
move_uploaded_file($tmpname, $folder);

// Form data
$community_name = $_POST['community_name'];
$category= $_POST['category'];
$other_category = $_POST['other_category'];
$privacy= $_POST['privacy'];
$district = $_POST['district'];
$about = $_POST['about'];

// 🔹 INSERT QUERY with created_by
$q = "INSERT INTO communities 
      (community_name, category, other_category, privacy, image, district, about, created_by)
      VALUES 
      ('$community_name', '$category', '$other_category', '$privacy', '$folder', '$district', '$about', '$user_id')";

$result = mysqli_query($conn, $q);

if ($result) {
    echo "<script>alert('Community Created Successfully'); window.location='createCommunity.php';</script>";
} else {
    header("Location: signup.php?error=Something went wrong! Please try again.");
}
?>
