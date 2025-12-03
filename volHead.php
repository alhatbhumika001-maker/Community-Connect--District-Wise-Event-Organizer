<?php

if (isset($_SESSION['login_user'])) {
    $username = $_SESSION['login_user']['username'];
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
