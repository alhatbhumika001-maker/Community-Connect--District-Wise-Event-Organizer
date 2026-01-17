<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "community_connect");
if (!$conn) {
    die("Database connection failed");
}

/* CAPTCHA Validation */
if (!isset($_POST['captcha']) || $_POST['captcha'] != $_SESSION['captcha']) {
    die("Invalid Captcha");
}

/* Get Form Data */
$event_id   = $_POST['event_id'];
$name       = $_POST['name'];
$email      = $_POST['email'];
$phone      = $_POST['phone'];
$district   = $_POST['district'];
$event_code = $_POST['event_code'] ?? '';

/* Image Upload */
$image_name = "";
if (!empty($_FILES['image']['name'])) {
    $image_name = time() . "_" . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], $image_name);
}

/* Insert Query */
$sql = "INSERT INTO registrations
(event_id, name, email, phone, district, id_card, event_code, status)
VALUES
('$event_id','$name','$email','$phone','$district','$image_name','$event_code','Pending')";

/* Execute Query */
if (mysqli_query($conn, $sql)) {

    // Store user name in session AFTER successful insert
    $_SESSION['user_name'] = $name;

    header("Location: registration_success.php");
    exit();

} else {
    echo "Database Error: " . mysqli_error($conn);
}
?>
