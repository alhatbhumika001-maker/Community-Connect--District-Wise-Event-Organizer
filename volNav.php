<nav class="navbar navbar-expand-lg navbar-light nav-color">
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"
                aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link <?php if($active == 'home') echo 'active'; ?>" aria-current="page" href="volunteerDashboard.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link <?php if($active == 'events') echo 'active'; ?>" href="volEvent.php">Explore Events</a></li>
                    <li class="nav-item"><a class="nav-link <?php if($active == 'community') echo 'active'; ?>" href="volCommunity.php">Explore Community</a></li>
                    <li class="nav-item"><a class="nav-link <?php if($active == 'profile') echo 'active'; ?>" href="volProfile.php">Profile</a></li>
                </ul>

                <div class="d-flex align-items-center gap-2">
                    <a href="logout.php" class="btn btn-outline-indigo btn-sm">Logout</a>
                </div>
            </div>
        </div>
    </nav>
