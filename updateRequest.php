<?php
$conn = new mysqli("localhost", "root", "", "community_connect");
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}

$id = intval($_GET['id'] ?? 0);   // sanitize
$action = $_GET['action'] ?? '';

if ($id && in_array($action, ['approve','reject'])) {

    if ($action === 'approve') {
        // Update status to 'approved'
        $stmt = $conn->prepare("UPDATE registrations SET status='approved' WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

    } elseif ($action === 'reject') {
        // Delete the registration
        $stmt = $conn->prepare("DELETE FROM registrations WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}

$stmt->close();
$conn->close();

header("Location: myEvent.php");
exit;
?>
