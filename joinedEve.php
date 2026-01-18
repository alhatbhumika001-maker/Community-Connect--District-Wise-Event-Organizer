<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joined Communities - Community Connect</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            font-family: Outfit, sans-serif;
            background: #eef4ff;
            margin-top: 120px;
        }

        .list-card {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            max-width: 1150px;
            /* controls width nicely */
        }

        .list-card-img-wrap {
            background: #f1f3f5;
            min-height: 180px;
            display: flex;
        }

        .list-card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .list-card-body {
            padding: 16px;
        }

        .list-card-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #111827;
        }

        .list-card-text {
            font-size: 14px;
            color: #374151;
            margin-bottom: 8px;
        }

        .list-card-meta {
            font-size: 13px;
            color: #6b7280;
        }
    </style>
</head>

<body>

    <?php
    include 'mainNav.php';
    ?>

    <!-- PAGE TITLE -->
    <h2 class="ms-lg-4 mt-5">Your Upcoming Events</h2>

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12 ps-lg-4">

                <!-- SHOW THIS BLOCK IF EVENTS EXIST -->

                <div class="list-card mb-3">
                    <div class="row g-0 align-items-stretch">

                        <!-- Image -->
                        <div class="col-md-4 list-card-img-wrap">
                            <img src="" class="list-card-img" alt="Community image">
                        </div>

                        <!-- Content -->
                        <div class="col-md-8">
                            <div class="list-card-body">
                                <h5 class="list-card-title">Event Name</h5>

                                <p class="list-card-text">
                                    Event description goes here. This is a brief overview of the event.
                                </p>

                                <p class="list-card-meta">
                                    Event date<br>
                                    Type: Event type
                                </p>

                                <p>
                                    <!-- if request accepted, show: -->
                                    <span class="badge text-bg-success">Request Accepted</span>
                                    <!-- if request pending, show: -->
                                    <span class="badge text-bg-danger">Request Pending</span>
                                </p>

                                <a href="viewEvent.php" class="btn btn-sm btn-outline-indigo mt-2">
                                    View Details
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- EMPTY STATE (SHOW ONLY IF NO Events) -->

                <!--
                <div class="text-center my-5">
                    <i class="bi bi-emoji-neutral" style="font-size:70px; color:#8540f5;"></i>
                    <h4 class="mt-3">No Events found</h4>
                    <p>You have not joined any Events yet.</p>
                    <a href="exploreCommunities.php" class="btn btn-outline-indigo">
                        Explore Events
                    </a>
                </div>
                -->

            </div>
        </div>
    </div>

    <h2 class="ms-lg-4 mt-5">Your Past Events</h2>

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12 ps-lg-4">

                <!-- SHOW THIS BLOCK IF PAST EVENTS EXIST -->

                <div class="list-card mb-3">
                    <div class="row g-0 align-items-stretch">

                        <!-- Image -->
                        <div class="col-md-4 list-card-img-wrap">
                            <img src="" class="list-card-img" alt="Community image">
                        </div>

                        <!-- Content -->
                        <div class="col-md-8">
                            <div class="list-card-body">
                                <h5 class="list-card-title">Event Name</h5>

                                <p class="list-card-text">
                                    Event description goes here. This is a brief overview of the event.
                                </p>

                                <p class="list-card-meta">
                                    Event date<br>
                                    Type: Event type
                                </p>

                                <a href="viewEvent.php" class="btn btn-sm btn-outline-indigo mt-2">
                                    View Details
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- EMPTY STATE (SHOW ONLY IF NO EVENTS ATTENDED) -->

                <!--
                    <div class="text-center my-5">
                        <i class="bi bi-emoji-neutral" style="font-size:70px; color:#8540f5;"></i>
                        <h4 class="mt-3">No Past Events</h4>
                        <p>You have not attended any Events yet.</p>
                        <a href="exploreCommunities.php" class="btn btn-outline-indigo">
                            Explore Events
                        </a>
                    </div>
                    -->

            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <?php include 'sidebar.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>