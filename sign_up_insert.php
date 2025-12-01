<?php
$conn = mysqli_connect("localhost", "root", "", "community_connect");

$full_name = $_POST['full_name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$role = $_POST['role'];
$district = $_POST['district'];

// Remove user_id from insert as it's auto-increment
$q = "INSERT INTO users (full_name, username, email, password, confirm_password, role, district) 
      VALUES ('$full_name', '$username', '$email', '$password', '$confirm_password', '$role', '$district')";

$result = mysqli_query($conn, $q);

if ($result) {
    echo "<script>
        alert('Account Created Successfully');
        window.location.href = 'index.php';
    </script>";
} else {
    $error = mysqli_error($conn);
    echo "<script>
        alert('Something went wrong: $error');
        window.location.href = 'signup.php';
    </script>";
    exit();
}
?>
