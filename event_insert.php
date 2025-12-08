<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "community_connect");

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('User not logged in'); window.location='login.php';</script>";
    exit;
}


$user_id = $_SESSION['user_id'];

// File upload
$filename = $_FILES["image"]["name"];
$tmpname = $_FILES["image"]["tmp_name"];
$folder = "event_images/" . $filename;
move_uploaded_file($tmpname, $folder);

// Form values
$event_name    = $_POST['event_name'];
$category      = $_POST['category'];
$other_category= $_POST['other_category'];
$district      = $_POST['district'];
$start_time    = $_POST['start_time'];
$end_time      = $_POST['end_time'];
$date          = $_POST['date'];
$event_type    = $_POST['event_type'];
// Receive data  
$community = $_POST['community'];  // INT value
$about         = $_POST['about'];

// Insert query
$q = "INSERT INTO community_events 
(event_name, category, other_category, district, image, start_time, end_time, date, event_type, community, about, created_by)
VALUES 
('$event_name', '$category', '$other_category', '$district', '$folder', '$start_time', '$end_time', '$date', '$event_type', '$community', '$about', '$user_id')";

$result = mysqli_query($conn, $q);

if ($result) {
    echo "<script>alert('Event Created Successfully'); window.location='exploreEvent.php';</script>";
} else {
    // Show error in alert and redirect
    $error = mysqli_error($conn);
    echo "<script>alert('SQL Error: {$error}'); window.location='exploreEvent.php';</script>";
}
?>
