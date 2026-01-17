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
                    <li class="nav-item"><a class="nav-link <?php if($active == 'home') echo 'active'; ?>" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link <?php if($active == 'communities') echo 'active'; ?>" href="Community.php">Communities</a></li>
                    <li class="nav-item"><a class="nav-link <?php if($active == 'events') echo 'active'; ?>" href="event.php">Events</a></li>
                    <li class="nav-item"><a class="nav-link <?php if($active == 'about') echo 'active'; ?>" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link <?php if($active == 'faqs') echo 'active'; ?>" href="#">FAQs</a></li>
                </ul>

                <div class="d-flex gap-2">
                    <?php if(isset($_SESSION['username'])): ?>
                        <span class="navbar-text me-2">
                            Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>
                        </span>
                        <a href="logout.php" class="btn btn-outline-info btn-sm">Logout</a>
                    <?php else: ?>
                        <a href="signup.php" class="btn btn-outline-info btn-sm">Sign Up</a>
                        <a href="login.php" class="btn btn-outline-info btn-sm">Login</a>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
