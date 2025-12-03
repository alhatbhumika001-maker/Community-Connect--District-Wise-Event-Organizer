<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "community_connect");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Ensure user is logged in
if (!isset($_SESSION['login_user'])) {
    header("Location: login.php");
    exit;
}

// Logged-in user id
$user_id = $_SESSION['login_user']['user_id'];

// Get updated values from POST form
$full_name = $_POST['full_name'];
$username  = $_POST['username'];
$email     = $_POST['email'];
$role      = $_POST['role'];
$district  = $_POST['district'];
$bio       = $_POST['bio'];

// Update query
$q = "UPDATE users 
      SET full_name='$full_name',
          username='$username',
          role='$role',
          district='$district',
          bio='$bio',
          email='$email'
      WHERE user_id='$user_id'";

$result = mysqli_query($conn, $q);

?>
<style>
.success-msg {
    background: #d4edda;
    color: #155724;
    padding: 12px 18px;
    border-left: 5px solid #28a745;
    border-radius: 6px;
    font-weight: 600;
    font-size: 15px;
    margin: 15px 0;
}
</style>

<?php
// Show success message
if (mysqli_affected_rows($conn) >= 1) {
    echo '<div class="success-msg">✔ Profile updated successfully</div>';

     // Redirect back to profile page after 1 seconds even when success
    echo "<script>
            setTimeout(function(){
                window.location.href = 'login.php';
            }, 500);
          </script>";

} else {
    echo '<div style="color:red; font-weight:600;">Failed to update profile.</div>';

     // Redirect back to profile page after 1 seconds even when failed
    echo "<script>
            setTimeout(function(){
                window.location.href = 'volProfile.php';
            }, 500);
          </script>";

}
?>
