<!-- SIDEBAR / OFFCANVAS -->
<div class="offcanvas offcanvas-start prof-nav" tabindex="-1" id="sideNav">

    <div class="offcanvas-body d-flex flex-column p-0">

        <!-- Sidebar Header -->
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

        <!-- Sidebar Navigation -->
        <nav class="nav flex-column sidebar-nav mt-2">

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

        </nav>

        <!-- Bottom action -->
        <div class="mt-auto border-top">
            <?php if (isset($_SESSION['username'])): ?>
            <a class="nav-link text-danger px-4 py-3" href="logout.php">Logout</a>
            <?php else: ?>
            <a class="nav-link px-4 py-3" href="login.php">Login</a>
            <?php endif; ?>
        </div>

    </div>