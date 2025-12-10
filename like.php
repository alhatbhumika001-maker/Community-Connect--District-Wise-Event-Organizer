<?php
$conn = mysqli_connect("localhost", "root", "", "community_connect");
if (!$conn) die("Connection failed: " . mysqli_connect_error());

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Check if post exists
    $check = $conn->prepare("SELECT id FROM posts WHERE id = ?");
    if (!$check) die("Prepare failed: " . $conn->error);

    $check->bind_param("i", $id);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows === 0) {
        die("Invalid post!");
    }

    // Increment likes
    $stmt = $conn->prepare("UPDATE posts SET likes = likes + 1 WHERE id = ?");
    if (!$stmt) die("Prepare failed: " . $conn->error);

    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) die("Execute failed: " . $stmt->error);

    $stmt->close();

   // After updating likes
$redirect = $_SERVER['HTTP_REFERER'] ?? 'com-Post.php';
header("Location: $redirect");
exit;

} else {
    die("No post ID provided.");
}
?>
