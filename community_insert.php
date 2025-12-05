<?php
$conn = mysqli_connect("localhost", "root", "", "community_connect");

    $filename = $_FILES["image"]["name"];
    $tmpname = $_FILES["image"]["tmp_name"];
    $folder="image/".$filename;
    move_uploaded_file($tmpname, $folder);
    
    $community_name = $_POST['community_name'];
    $category= $_POST['category'];
    $other_category	 = $_POST['other_category'];
    $privacy= $_POST['privacy'];
    $district = $_POST['district'];
    $about = $_POST['about'];

// 🔹 INSERT QUERY
$q = "INSERT INTO communities (community_name, category, other_category, privacy, image, district, about)
      VALUES ('$community_name', '$category', '$other_category', '$privacy', '$folder', '$district', '$about')";

$result = mysqli_query($conn, $q);

if ($result) {
    echo "<script>alert('Community Created Successfully'); window.location='createCommunity.php';</script>";
} else {
    header("Location: signup.php?error=Something went wrong! Please try again.");
}
?>
