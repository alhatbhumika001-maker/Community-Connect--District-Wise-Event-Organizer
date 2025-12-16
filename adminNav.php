<!-- TOPBAR -->
<div class="topbar">
    <!-- Mobile hamburger -->
    <button class="btn btn-sm btn-light d-md-none me-2" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
        <i class="bi bi-list"></i>
    </button>

    <img class="brand-logo" src="lg.png" alt="logo">
    <div class="brand">Community Connect</div>

    <a href="#" class="btn btn-sm btn-outline-navy ms-auto">Logout</a>
</div>

<!-- SIDEBAR (DESKTOP) -->
<div class="sidebar d-none d-md-block">
    <h5 style="font-weight: 700;"><i class="bi bi-gear-fill"></i> Admin Panel</h5>

    <a href="adminDashboard.php" class="<?php if ($active == 'adminDashboard') echo 'active'; ?>"><i
            class="bi bi-speedometer2 me-2"></i>Dashboard</a>
    <a href="eventInsights.php" class="<?php if ($active == 'events') echo 'active'; ?>"><i
            class="bi bi-calendar-event me-2"></i>Manage Events</a>
    <a href="communityInsights.php" class="<?php if ($active == 'communities') echo 'active'; ?>"><i
            class="bi bi-people me-2"></i>Manage Communities</a>
    <a href="profile.php" class="<?php if ($active == 'adminProfile') echo 'active'; ?>"><i
            class="bi bi-person me-2"></i>Profile</a>
    <a href="members.php" class="<?php if ($active == 'members') echo 'active'; ?>"><i
            class="bi bi-person-check-fill"></i>Members</a>

    <div>
        <hr style="border-color: rgba(255,255,255,.06);">
        <div class="small-muted">Logged in as</div>
        <div class="adminName">username</div>
    </div>
</div>

<!-- SIDEBAR (MOBILE OFFCANVAS) -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSidebar">
    <div class="offcanvas-header bg-dark text-white">
        <h5 class="offcanvas-title">Community Connect</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body p-0 bg-dark">
        <nav class="nav flex-column p-3">
            <a class="nav-link text-white <?php if ($active == 'adminDashboard') echo 'fw-bold'; ?>"
                href="adminDashboard.php"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
            <a class="nav-link text-white <?php if ($active == 'events') echo 'fw-bold'; ?>" href="eventInsights.php"><i
                    class="bi bi-calendar-event me-2"></i>Manage Events</a>
            <a class="nav-link text-white <?php if ($active == 'communities') echo 'fw-bold'; ?>"
                href="communityInsights.php"><i class="bi bi-people me-2"></i>Manage Communities</a>
            <a class="nav-link text-white <?php if ($active == 'adminProfile') echo 'fw-bold'; ?>"
                href="adminProfile.php"><i class="bi bi-person me-2"></i>Profile</a>
            <a href="members.php" class="<?php if ($active == 'members') echo 'active'; ?>"><i
                    class="bi bi-person-check-fill"></i>Members</a>

            <div>
                <hr style="border-color: rgba(255,255,255,.06);">
                <div class="small-muted">Logged in as</div>
                <div class="adminName">username</div>
            </div>
        </nav>
    </div>
</div>

<!-- SECTION STRIP : EVENTS  -->
<?php if (isset($topbar) && $topbar == 'events'): ?>
<div class="section-strip">
    <ul class="nav nav-pills gap-2 justify-content-center">
        <li class="nav-item">
            <a class="nav-link <?php if ($sub == 'eventInsights') echo 'active'; ?>"
                href="eventInsights.php">Insights</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($sub == 'events_list') echo 'active'; ?>" href="events_list.php">Events</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($sub == 'event_actions') echo 'active'; ?>"
                href="event_actions.php">Actions</a>
        </li>
    </ul>
</div>
<?php endif; ?>

<!-- SECTION STRIP : COMMUNITIES -->
<?php if (isset($topbar) && $topbar == 'communities'): ?>
<div class="section-strip">
    <ul class="nav nav-pills gap-2 justify-content-center">
        <li class="nav-item">
            <a class="nav-link <?php if ($sub == 'communityInsights') echo 'active'; ?>"
                href="communityInsights.php">Insights</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($sub == 'communities_list') echo 'active'; ?>"
                href="communities_list.php">Communities</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($sub == 'community_reports') echo 'active'; ?>"
                href="community_reports.php">Reports</a>
        </li>
    </ul>
</div>
<?php endif; ?>

<!-- PAGE CONTENT START -->
<div class="content"></div>