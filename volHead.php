    <?php
        session_start();

        $link = mysqli_connect("localhost", "root", "", "community_connect");

        $username = "Guest";

        if (isset($_SESSION['user_id'])) {
            $uid = $_SESSION['user_id'];
            $res = mysqli_query($link, "SELECT username FROM users WHERE user_id='$uid'");
            if ($row = mysqli_fetch_assoc($res)) {
                $username = $row['username'];
            }
        }
?>



<div class="initial">
    <div id="brand" class="d-flex align-items-center">
        <img src="lg.png" class="brand-logo" alt="logo">
        <span class="brand-text">Community Connect</span>
    </div>
    <div id="user" class="d-flex align-items-center">
        <span class="user-name">
           Welcome <?php echo $username; ?>
        </span>
        <img src="user.png" class="user-icon" alt="User Icon">
    </div>
</div>
