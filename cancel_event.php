<?php

$conn = mysqli_connect("localhost", "root", "", "community_connect");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_id'])) {
    $event_id = intval($_POST['event_id']);
    $reason_title = mysqli_real_escape_string($conn, $_POST['reason_title']);
    $reason_detail = mysqli_real_escape_string($conn, $_POST['reason_detail']);

    // Update event status
    mysqli_query($conn, "UPDATE community_events SET status='Cancelled' WHERE id=$event_id");

    // Optional: Save reason
    mysqli_query($conn, "INSERT INTO event_cancellations (event_id, reason_title, reason_detail) VALUES ($event_id, '$reason_title', '$reason_detail')");

    // Redirect back
    header("Location: events_list.php?msg=cancelled");
    exit;
}
?>
