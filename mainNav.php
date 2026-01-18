<?php
session_start(); // Start the session at the top
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
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
                    <li class="nav-item">
                        <a class="nav-link <?php if ($active == 'home') echo 'active'; ?>" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($active == 'communities') echo 'active'; ?>"
                            href="Community.php">Communities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($active == 'events') echo 'active'; ?>" href="event.php">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($active == 'about') echo 'active'; ?>" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($active == 'faqs') echo 'active'; ?>" href="faqs.php">FAQs</a>
                    </li>
                </ul>

                <!-- RIGHT SIDE -->
                <div class="d-flex align-items-center gap-2">

                    <!-- Profile image (always visible) -->
                    <img src="user.png" class="profile-img" data-bs-toggle="offcanvas" data-bs-target="#sideNav"
                        alt="Profile">

                    <!-- Login only for guest -->
                    <?php if (!isset($_SESSION['username'])): ?>
                    <a href="login.php" class="btn btn-outline-info btn-sm">Login</a>
                    <?php endif; ?>

                </div>

            </div>
        </div>
    </nav>

    <!-- SIDEBAR / OFFCANVAS -->
    <div class="offcanvas offcanvas-start prof-nav" tabindex="-1" id="sideNav">

        <div class="offcanvas-body d-flex flex-column p-0">

            <!-- Header -->
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title navbar-brand-text" style="font-size: 22px;">
                    Community Connect
                </h5>
            </div>

            <!-- Profile Section -->
            <div class="text-center py-4 border-bottom">
                <img src="user.png" class="sidebar-profile-img" alt="Profile">
                <h6 class="mt-2 mb-0 text-muted">
                    <?php echo isset($_SESSION['username'])
                        ? htmlspecialchars($_SESSION['username'])
                        : 'Guest'; ?>
                </h6>
            </div>

            <!-- Navigation -->
            <nav class="nav flex-column sidebar-nav mt-2">

                <?php if (isset($_SESSION['username'])): ?>

                <a class="nav-link" href="myEvent.php">Created Communities</a>
                <a class="nav-link" href="myCommunity.php">Created Events</a>
                <a class="nav-link" href="joinedCom.php">Joined Communities</a>
                <a class="nav-link" href="joinedEve.php">Joined Events</a>

                <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                    href="#createMenu" role="button" aria-expanded="false">
                    Create
                    <span class="chevron">▾</span>
                </a>

                <div class="collapse ps-3" id="createMenu">
                    <a class="nav-link small" href="createCommunity.php">Community</a>
                    <a class="nav-link small" href="createEvent.php">Event</a>
                </div>

                <a class="nav-link" href="profile.php">Profile</a>

                <?php endif; ?>

            </nav>

            <!-- Bottom Action -->
            <div class="mt-auto border-top">

                <?php if (isset($_SESSION['username'])): ?>
                <a class="nav-link text-danger px-4 py-3" href="logout.php">Logout</a>
                <?php else: ?>
                <a class="nav-link px-4 py-3" href="login.php">Login</a>
                <?php endif; ?>

            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>