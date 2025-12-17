<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Community Connect</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="adminStyle.css">

    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    .metric-card {
        background: #ffffff;
        border-radius: 10px;
        padding: 16px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
    }

    .metric-top {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .metric-icon {
        width: 60px;
        height: 60px;
        background: #eef2ff;
        color: #4f46e5;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
    }

    .metric-title {
        font-size: 23px;
        font-weight: 500;
        line-height: 1.2;
    }

    .metric-value {
        margin-top: 14px;
        font-size: 28px;
        font-weight: 600;
    }

    .list-card {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        max-width: 900px;
        width: 100%;
        height: 100%;
    }

    .list-card-img-wrap {
        background: #f1f3f5;
        height: 100%;
        min-height: 100%;
        max-height: 180px;
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

    .section-title {
        font-size: 20px;
        font-weight: 600;
        margin: 40px 0 16px;
    }
    </style>
</head>

<body class="no-strip">
    <?php
    $active = 'adminDashboard';
    include 'adminNav.php';
    ?>

    <div class="content container">
        <div class="row g-3">

            <!-- Card 1 -->
            <div class="col-md-6">
                <div class="metric-card">
                    <div class="metric-top">
                        <div class="metric-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="metric-title text-muted">
                            Total<br>Communities
                        </div>
                    </div>
                    <div class="metric-value">Total Communtiies present</div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-6">
                <div class="metric-card">
                    <div class="metric-top">
                        <div class="metric-icon">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                        <div class="metric-title text-muted">
                            Total<br>Events
                        </div>
                    </div>
                    <div class="metric-value">Total events. add Past events too</div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-6">
                <div class="metric-card">
                    <div class="metric-top">
                        <div class="metric-icon">
                            <i class="bi bi-person-check"></i>
                        </div>
                        <div class="metric-title text-muted">
                            Total<br>Users
                        </div>
                    </div>
                    <div class="metric-value">Total Users</div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-md-6">
                <div class="metric-card">
                    <div class="metric-top">
                        <div class="metric-icon">
                            <i class="bi bi-lightning-charge"></i>
                        </div>
                        <div class="metric-title text-muted">
                            Active<br>Events
                        </div>
                    </div>
                    <div class="metric-value">Events which have not happened yet.</div>
                </div>
            </div>

        </div>

        <h4 class="section-title">Recent Events</h4>

        <div class="list-card mb-3 mx-auto">

            <!-- Loop this area for listing 5 recent events.  -->

            <div class="row g-0 align-items-stretch mb-3">

                <!-- Image -->
                <div class="col-md-4 list-card-img-wrap">
                    <img src="" class="img-fluid" alt="Event image">
                </div>

                <!-- Content -->
                <div class="col-md-8">
                    <div class="list-card-body">
                        <h5 class="list-card-title">Blood Donation Camp</h5>

                        <p class="list-card-text">
                            Organized by Helping Hands Community. A social service event to encourage blood
                            donation.
                        </p>

                        <p class="list-card-meta">
                            Community: Helping Hands<br>
                            Date: 12 Oct 2025
                        </p>

                        <a href="#" class="btn btn-sm btn-outline-navy mt-2">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="section-title">Recent Community</h4>

        <div class="list-card mb-3 mx-auto">

            <!-- Loop this area for listing 5 recent community.  -->

            <div class="row g-0 align-items-stretch mt-2">

                <!-- Image -->
                <div class="col-md-4 list-card-img-wrap">
                    <img src="#" class="img-fluid" alt="Community image">
                </div>

                <!-- Content -->
                <div class="col-md-8">
                    <div class="list-card-body">
                        <h5 class="list-card-title">Community Name</h5>

                        <p class="list-card-text">
                            Community Description
                        </p>

                        <p class="list-card-meta">
                            Created By:<br>
                            Name of creator
                        </p>

                        <a href="#" class="btn btn-sm btn-outline-navy mt-2">
                            View Details
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Bootstrap JS  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>