<?php
session_start();

/* DB CONNECTION */
$conn = mysqli_connect("localhost", "root", "", "community_connect");
if (!$conn) {
    die("Database connection failed");
}

/* LOGIN CHECK */
if (!isset($_SESSION['login_user'])) {
    die("Login required");
}

/* CAPTCHA CHECK */
if ($_POST['captcha'] != $_SESSION['captcha']) {
    die("Invalid Captcha");
}

/* USER DATA */
$user      = $_SESSION['login_user'];
$user_id   = $user['user_id'];

/* FORM DATA */
$event_id  = intval($_POST['event_id']);
$name      = mysqli_real_escape_string($conn, $_POST['name']);
$email     = mysqli_real_escape_string($conn, $_POST['email']);
$phone     = mysqli_real_escape_string($conn, $_POST['phone']);
$district  = mysqli_real_escape_string($conn, $_POST['district']);
$event_code = $_POST['event_code'] ?? '';

/* 🔹 FETCH EVENT DETAILS */
$event_sql = "SELECT event_name, location FROM community_events WHERE id = '$event_id'";
$event_res = mysqli_query($conn, $event_sql);

if (!$event_res || mysqli_num_rows($event_res) == 0) {
    die("Invalid Event");
}

$event = mysqli_fetch_assoc($event_res);
$event_name     = mysqli_real_escape_string($conn, $event['event_name']);
$event_location = mysqli_real_escape_string($conn, $event['location']);

/* IMAGE UPLOAD */
$image_name = "";
if (!empty($_FILES['image']['name'])) {
    $image_name = time() . "_" . basename($_FILES['image']['name']);
    move_uploaded_file(
        $_FILES['image']['tmp_name'],
        "event_registration_id/" . $image_name
    );
}

/* ✅ INSERT FULL DATA */
$sql = "
INSERT INTO registrations
(
  user_id,
  event_id,
  event_name,
  location,
  name,
  email,
  phone,
  district,
  id_card,
  event_code,
  status
)
VALUES
(
  '$user_id',
  '$event_id',
  '$event_name',
  '$event_location',
  '$name',
  '$email',
  '$phone',
  '$district',
  '$image_name',
  '$event_code',
  'pending'
)
";

if (mysqli_query($conn, $sql)) {
    header("Location: registration_success.php");
    exit();
} else {
    echo "DB Error: " . mysqli_error($conn);
}
?>
