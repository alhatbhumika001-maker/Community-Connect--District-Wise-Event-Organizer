<nav class="navbar navbar-expand-lg navbar-light nav-color">
    <div class="nav container-fluid d-flex align-items-center justify-content-between">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link <?php if ($active == 'home') echo 'active'; ?>"
                        aria-current="page" href="Dashboard.php">Home</a></li>

                <li class="nav-item dropdown <?php
                                                if (in_array($active, ['exploreEvent', 'myEvents']))
                                                    echo 'active'; ?>">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Events
                    </a>
                    <ul id="events" class="dropdown-menu">
                        <!-- List all the events here  -->
                        <li><a class="dropdown-item <?php if ($active == 'exploreEvent') echo 'active'; ?>"
                                href="exploreEvent.php">Explore</a></li>
                        <!-- Show created events by user here -->
                        <li><a class="dropdown-item <?php if ($active == 'myEvent') echo 'active'; ?>"
                                href="myEvents.php">Created events</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <!-- Allow creating new event only if they have created a community -->
                        <li><a class="dropdown-item" href="createEvent.php">Create</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown <?php
                    if (in_array($active, ['exploreCommunity', 'myCommunity'])) echo 'active'; ?>">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Community
                    </a>
                    <ul class="dropdown-menu">
                        <!-- List all the communities here -->
                        <li><a class="dropdown-item <?php if ($active == 'exploreCommunity') echo 'active'; ?>"
                                href="exploreCommunity.php">Explore</a></li>
                        <!-- Show created communities by user here -->
                        <li><a class="dropdown-item <?php if ($active == 'myCommunity') echo 'active'; ?>"
                                href="myCommunity.php">Created Communities</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <!-- Allow creating new community -->
                        <li><a class="dropdown-item" href="createCommunity.php">Create</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link <?php if ($active == 'profile') echo 'active'; ?>"
                        href="Profile.php">Profile</a></li>
            </ul>

            <div class="d-flex align-items-center gap-2">
                <a href="logout.php" class="btn btn-outline-indigo btn-sm">Logout</a>
            </div>
        </div>
    </div>
</nav>