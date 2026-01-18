<?php
session_start(); // Start the session at the top
?>
<!-- TOP NAVBAR -->
<nav class="navbar navbar-expand-lg bg-light shadow-sm fixed-top">
    <div class="container">

        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="lg.png" class="brand-logo" alt="">
            <span class="navbar-brand-text">Community Connect</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">

            <ul class="navbar-nav ms-3 me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="Community.php">Communities</a></li>
                <li class="nav-item"><a class="nav-link" href="event.php">Events</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#">FAQs</a></li>
            </ul>

            <!-- Right section -->
            <div class="d-flex align-items-center gap-2">

                <!-- Login button only for guest -->
                <?php if (!isset($_SESSION['username'])): ?>
                <a href="login.php" class="btn btn-outline-info btn-sm">Login</a>
                <?php endif; ?>

                <!-- Profile image -->
                <img src="user.png" class="profile-img" data-bs-toggle="offcanvas" data-bs-target="#sideNav"
                    alt="Profile">

            </div>

        </div>
    </div>
</nav>