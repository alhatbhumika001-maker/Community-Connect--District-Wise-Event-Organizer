<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Community Connect</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* WEBSITE BRAND NAME */
.navbar-brand-text {
  font-family: "Handlee", cursive;
  font-size: 1.7rem;
  margin-left: 6px;
}

/* NAVBAR */
.navbar {
  padding-top: 0.1rem !important;
  padding-bottom: 0.1rem !important;
}

.navbar .container {
  padding-left: 0.5rem !important;
  padding-right: 0.5rem !important;
  max-width: 100% !important;
}

.brand-logo {
  width: 80px;
  height: 80px;
  object-fit: cover;
  border-radius: 50%;
}

/* Profile image inside navbar */
.profile-img {
  width: 35px;
  height: 35px;
  border-radius: 50%;
  cursor: pointer;
}

.btn-outline-indigo {
  color: #8540f5;
  border-color: #8540f5;
}

.btn-outline-indigo:hover {
  background-color: #8540f5;
  color: white;
}
</style>
</head>
<body>

<!-- TOP NAVBAR -->
<nav class="navbar navbar-expand-lg bg-light shadow-sm fixed-top">
    <div class="container">

        <a class="navbar-brand d-flex align-items-center" href="index.php">
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
                <li class="nav-item"><a class="nav-link" href="faqs.php">FAQs</a></li>
            </ul>

            <!-- Right section -->
            <div class="d-flex align-items-center gap-2">
    <?php if (!isset($_SESSION['username'])): ?>
        <!-- Guest sees profile image, links to login -->
        <a href="profile.php">
            <img src="user.png" class="profile-img" alt="Guest Profile">
        </a>
        <a href="login.php" class="btn btn-outline-info btn-sm">Login</a>
    <?php else: ?>
        <!-- Logged-in user sees profile image, links to profile.php -->
        <a href="profile.php">
            <img src="user.png" class="profile-img" alt="Profile">
        </a>
    <?php endif; ?>
</div>

        </div>
    </div>
</nav>

<!-- Bootstrap JS (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
