<?php
 $conn = new mysqli("localhost", "root", "", "community_connect");

    $user_id = $_SESSION['user_id'] ?? 0;

// Fetch events Count
    $events_query = "SELECT * FROM community_events";
    $events_result = mysqli_query($conn, $events_query);
    $events_count = mysqli_num_rows($events_result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events - Community Connect</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="adminStyle.css">

    <!-- Bootstrap JS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    .metric-card {
        background: #ffffff;
        border-radius: 10px;
        padding: 16px;
        box-shadow: 6px 6px 12px rgba(0, 0, 0, 0.3);
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

    .section-title {
        font-weight: 540;
    }

    .graph {
        background-color: white;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.15);
        padding: 20px;
        border-radius: 16px;
        margin-top: 24px;
        width: 100%;
        overflow-x: hidden;
    }

    .graph canvas {
        width: 100% !important;
        height: 320px !important;
    }

    @media (max-width: 768px) {
        .content {
            padding: 20px 15px;
        }

        .graph {
            padding: 16px;
        }

        .graph canvas {
            height: 260px !important;
        }

        .metric-title {
            font-size: 18px;
        }

        .metric-value {
            font-size: 24px;
        }
    }
    </style>

</head>

<body>
    <?php
    $active = 'events';
    $topbar = 'events';
    $sub = 'eventInsights';
    include 'adminNav.php';
    ?>

    <?php
        // Active Events Count (logic same)
        $result = mysqli_query($conn, "
            SELECT COUNT(*) AS active_events 
            FROM community_events 
            WHERE date > CURDATE()
        ");
        $row = mysqli_fetch_assoc($result);
    ?>

    <?php
        // Past Events Count (logic same)
        $result = mysqli_query($conn, "
            SELECT COUNT(*) AS past_events 
            FROM community_events 
            WHERE date < CURDATE()
        ");
        $rows = mysqli_fetch_assoc($result);
    ?>

    <div class="content">
        <h1 class="mb-3 text-muted">Overview on Events</h1>
        <div class="row g-3">
            <!-- Card 1 -->
            <div class="col-md-6">
                <div class="metric-card">
                    <div class="metric-top">
                        <div class="metric-icon">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                        <div class="metric-title text-muted">
                            <span style="color: #312E81; font-weight:600;">Total Active Events</span><br><span style="font-size:20px; color:gray; font-weight:600;">In Community Connect</span>
                        </div>
                    </div>
                    <div class="metric-value"><span style="color: black; font-size:26px;">Active Events: </span> <?php echo $events_count; ?></div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-6">
                <div class="metric-card">
                    <div class="metric-top">
                        <div class="metric-icon">
                            <i class="bi bi-clipboard2-check"></i>
                        </div>
                        <div class="metric-title text-muted">
                             <span style="color: #312E81; font-weight:600;">Past Events</span><br><span style="font-size:20px; color:gray; font-weight:600;">In Community Connect</span>
                        </div>
                    </div>
                    <div class="metric-value"><span style="color: black; font-size:26px;">Past Events: </span><?php echo $rows['past_events']; ?> </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-md-6">
                <div class="metric-card">
                    <div class="metric-top">
                        <div class="metric-icon">
                            <i class="bi bi-x-square"></i>
                        </div>
                        <div class="metric-title text-muted">
                              <span style="color: #312E81; font-weight:600;"> Removed Events</span><br><span style="font-size:20px; color:gray; font-weight:600;">In Community Connect</span>
                        </div>
                    </div>
                    <div class="metric-value">Events Removed by Admin : 0</div>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="col-md-6">
                <div class="metric-card">
                    <div class="metric-top">
                        <div class="metric-icon">
                            <i class="bi bi-calendar2-plus"></i>
                        </div>
                        <div class="metric-title text-muted">
                             <span style="color: #312E81; font-weight:600;"> Upcoming Events</span><br><span style="font-size:20px; color:gray; font-weight:600;">In Community Connect</span>

                        </div>
                    </div>
                    <div class="metric-value"><span style="color: black; font-size:26px;">Upcoming Events: </span><?php echo $row['active_events']; ?></div>
                </div>
            </div>
        </div>

        <h2 class="mt-5 mb-3 text-muted">Event Analytics</h2>

        <div class="graphs">
            <div class="graph">
                <h3 class="section-title">
                    Events Per Month
                </h3>
                <canvas id="eventschart"></canvas>
            </div>
            <div class="graph">
                <h3 class="section-title">
                    Top 5 Communities by Events Conducted
                </h3>
                <canvas id="communitychart"></canvas>
            </div>
        </div>

    </div>

    <!-- JS for Graph -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    // Events Per Month Chart
    const monthCtx = document.getElementById('eventschart');

    new Chart(monthCtx, {
        type: 'bar',
        data: {
            // Add the php array for past 6 months and add it to label variable. 
            // Same with the data(add total events of the month).
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Events',
                data: [4, 7, 3, 9, 6, 5]
            }]
        }
    });

    // Events Per Community Chart
    const communityCtx = document.getElementById('communitychart');

    new Chart(communityCtx, {
        type: 'bar',
        data: {
            // Add the php array for community which have most events and add it to label variable.
            // Same with the data(add total events of that community).
            labels: ['Community A', 'Community B', 'Community C', 'Community D', 'Community E'],
            datasets: [{
                label: 'Events',
                data: [12, 9, 7, 5, 4]
            }]
        }
    });
    </script>

    <!-- Bootstrap JS  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>