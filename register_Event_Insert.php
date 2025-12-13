<?php
session_start();

// DB connection
$conn = mysqli_connect("localhost", "root", "", "community_connect");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Check user login
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('User not logged in'); window.location='login.php';</script>";
    exit;
}

$user_id  = $_SESSION['user_id'];

if (!isset($_POST['event_id'])) {
    die("Event ID missing");
}

$event_id = intval($_POST['event_id']); // sanitize

// Fetch event info
$eventQuery = mysqli_prepare($conn, "SELECT privacy, event_code, event_name, date, start_time, location FROM community_events WHERE id = ?");
if (!$eventQuery) {
    die("Prepare failed: " . mysqli_error($conn));
}
mysqli_stmt_bind_param($eventQuery, "i", $event_id);
mysqli_stmt_execute($eventQuery);
$result = mysqli_stmt_get_result($eventQuery);
$eventData = mysqli_fetch_assoc($result);

if (!$eventData) {
    die("Invalid Event");
}

// Assign variables
$privacy = $eventData['privacy'];
$db_event_code = $eventData['event_code'];
$event_name = $eventData['event_name'];
$date       = $eventData['date'];
$startTime  = $eventData['start_time'];
$location   = $eventData['location'];

// Private event validation
$event_code = null;
if ($privacy === 'private') {
    if (empty($_POST['event_code']) || $_POST['event_code'] !== $db_event_code) {
        echo "<script>alert('Invalid Event Code'); history.back();</script>";
        exit;
    }
    if (empty($_FILES['image']['name'])) {
        echo "<script>alert('ID Card required for private event'); history.back();</script>";
        exit;
    }
    $event_code = $_POST['event_code'];
}

// Optional ID card upload
$id_card_path = null;
if (!empty($_FILES['image']['name'])) {
    $filename = time() . "_" . basename($_FILES['image']['name']);
    $tmpname  = $_FILES['image']['tmp_name'];
    $id_card_path = "event_registration_id/" . $filename;
    move_uploaded_file($tmpname, $id_card_path);
}

// Form data
$name     = $_POST['name'];
$email    = $_POST['email'];
$phone    = $_POST['phone'];
$district = $_POST['district'];

// Set status: private = pending, public = accepted
$status = ($privacy === 'private') ? 'pending' : 'approved' : 'rejected';

// INSERT registration
$stmt = mysqli_prepare($conn, "
    INSERT INTO registrations
    (user_id, event_id, event_name, name, email, phone, id_card, district, event_date, location, event_code, start_time, status)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

if (!$stmt) {
    die("Prepare failed: " . mysqli_error($conn));
}

mysqli_stmt_bind_param(
    $stmt,
    "iisssssssssss",
    $user_id,
    $event_id,
    $event_name,
    $name,
    $email,
    $phone,
    $id_card_path,
    $district,
    $date,
    $location,
    $event_code,
    $startTime,
    $status
);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('Event Registered Successfully'); window.location='exploreEvent.php';</script>";
} else {
    echo "<script>alert('Registration Failed: " . mysqli_stmt_error($stmt) . "'); history.back();</script>";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
