<?php
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$conn = new mysqli("localhost", "root", "", "community_connect");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("<script>alert('User not logged in'); window.location='login.php';</script>");
}

$user_id = $_SESSION['user_id'];

// File upload
$folder = '';
if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    if (!is_dir('event_images')) {
        mkdir('event_images', 0777, true); // create folder if not exists
    }

    $filename = time() . '_' . basename($_FILES['image']['name']); // unique file name
    $tmpname = $_FILES['image']['tmp_name'];
    $folder = 'event_images/' . $filename;

    if (!move_uploaded_file($tmpname, $folder)) {
        die("<script>alert('Failed to upload image'); history.back();</script>");
    }
}

// Sanitize inputs
$event_name = mysqli_real_escape_string($conn, $_POST['event_name']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
$other_category = mysqli_real_escape_string($conn, $_POST['other_category']);
$district = mysqli_real_escape_string($conn, $_POST['district']);
$start_time = mysqli_real_escape_string($conn, $_POST['start_time']);
$end_time = mysqli_real_escape_string($conn, $_POST['end_time']);
$date = mysqli_real_escape_string($conn, $_POST['date']);
$details = mysqli_real_escape_string($conn, $_POST['details']);
$location = mysqli_real_escape_string($conn, $_POST['location']);
$event_type = mysqli_real_escape_string($conn, $_POST['event_type']);
$event_ty = mysqli_real_escape_string($conn, $_POST['event_ty']);
$registration_deadline = mysqli_real_escape_string($conn, $_POST['registration_deadline']);
$about = mysqli_real_escape_string($conn, $_POST['about']);
$community = (int)$_POST['community'];
$privacy = $_POST['privacy'];
$event_code = mysqli_real_escape_string($conn, $_POST['event_code'] ?? '');

// Check private event code
if ($privacy === 'private' && empty($event_code)) {
    die("<script>alert('Event Code is required for private events.'); history.back();</script>");
}

// Prepared statement to insert data safely
$stmt = $conn->prepare("INSERT INTO community_events 
(event_name, category, other_category, district, image, start_time, end_time, date, event_type, community, about, created_by, event_code, privacy, details, location, event_ty, registration_deadline) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if ($stmt === false) {
    die("<script>alert('Prepare failed: " . $conn->error . "');</script>");
}

$stmt->bind_param(
    "sssssssssisissssss",
    $event_name,
    $category,
    $other_category,
    $district,
    $folder,
    $start_time,
    $end_time,
    $date,
    $event_type,
    $community,
    $about,
    $user_id,
    $event_code,
    $privacy,
    $details,
    $location,
    $event_ty,
    $registration_deadline
);

// Execute and check
if ($stmt->execute()) {
    echo "<script>alert('Event Created Successfully'); window.location='exploreEvent.php';</script>";
} else {
    echo "<script>alert('Error inserting event: " . $stmt->error . "'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
