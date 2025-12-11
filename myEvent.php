<?php
    include 'userHead.php'; 
    $conn = mysqli_connect("localhost", "root", "", "community_connect");
        // LIST OF EVENTS: Show only events created by logged-in user
        $user_id = $_SESSION['user_id'] ?? 0;

        // Fetch events created by logged-in user
        $event_query = "SELECT * FROM community_events WHERE created_by = $user_id ORDER BY id DESC";
        $event_result = mysqli_query($conn, $event_query);
        $event_count = mysqli_num_rows($event_result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Created Event - Community Connect</title>
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Outfit:wght@400;600&display=swap"
        rel="stylesheet">

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="userStyle.css" />

    <!-- BOOTSTRAP ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
    body {
        font-family: 'Outfit', sans-serif;
        background-color: #f8f9fa;
    }

    .metric-card {
        background: #ffffff;
        border-radius: 10px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
        transition: transform 0.15s ease;
    }

    .metric-card:hover {
        transform: translateY(-3px);
    }

    .metric-title {
        font-size: 25px;
        font-weight: 600;
        color: #374151;
    }

    .metric-value {
        font-size: 30px;
        font-weight: 200;
        color: #374563ff;
    }

    .metric-desc {
        font-size: 15px;
        color: #6b7280;
    }

    .metric-icon {
        font-size: 30px;
        color: #8540f5;
        /* Indigo tone */
    }

    .event-card {
        width: 100%;
        max-width: 960px;
        display: grid;
        grid-template-columns: 120px 1fr;
        grid-template-rows: auto 220px auto;
        /* (date, content), photo, button */
        border-radius: 8px;
        padding: 10px;
        box-sizing: border-box;
        background: #fff;
    }

    /* Date box (top-left) */
    .date-box {
        grid-column: 1 / 2;
        grid-row: 1 / 2;
        border: var(--border);
        border-radius: 6px;
        padding: 8px;
        text-align: center;
    }

    /* Content (top-right) */
    .content-box {
        grid-column: 2 / 3;
        grid-row: 2 / 3;
        border-radius: 6px;
        padding: 8px;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    /* Photo spanning full width under top row */
    .photo-box {
        grid-column: 2 / 3;
        grid-row: 1 / 2;
        border-radius: 6px;
        overflow: hidden;
        min-height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f2f2f2;
    }

    .photo-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* Button*/
    .button-box {
        grid-column: 2 / 3;
        grid-row: 3 / 4;
        padding: 6px;
        display: flex;
        justify-content: flex-end;
        align-items: end;
    }

    /* Responsive: stack to one column on small screens */
    @media (max-width: 720px) {
        .event-card {
            grid-template-columns: 1fr;
            /* one column */
            grid-template-rows: auto auto auto auto;
            /* date, content, photo, button */
        }

        .date-box {
            grid-column: 1 / 2;
            grid-row: 1 / 2;
            text-align: left;
        }

        .content-box {
            grid-column: 1 / 2;
            grid-row: 2 / 3;
        }

        .photo-box {
            grid-column: 1 / 2;
            grid-row: 3 / 4;
            min-height: 220px;
        }

        .button-box {
            grid-column: 1 / 2;
            grid-row: 4 / 5;
            justify-content: flex-end;
            padding-right: 8px;
        }
    }

    .bi-emoji-neutral {
        color: #8540f5;
        font-size: 80px;
        margin-bottom: 20px;
    }
    </style>
</head>

<body>
    
    <?php 
    $active = 'myEvent';
    include 'userNav.php'; ?>
    <div class="container-fluid mt-5 d-flex flex-column align-items-center">
        <div class="container mt-4 mb-2">
            <h2 class="fw-bold mb-3">My Created Events Dashboard</h2>
        </div>

        <!-- show this if the user has created events -->
        <!-- METRIC CARDS SECTION -->
        <div class="container mb-4">
            <div class="row g-3 justify-content-center mb-3">

                <!-- CARD 1 -->
                <div class="col-12 col-md-4">
                    <div class="metric-card p-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-calendar-event metric-icon"></i>
                            <span class="metric-title">Total Events</span>
                        </div>
                        <div class="metric-value">
                            Total Events: <?= $event_count ?>
                        </div>
                        <div class="metric-desc">Events you have organized</div>
                    </div>
                </div>


                <!-- CARD 2 -->
                <div class="col-12 col-md-4">
                    <div class="metric-card p-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-people metric-icon"></i>
                            <span class="metric-title">Registrations</span>
                        </div>
                        <div class="metric-value">
                           Total participant: <?= $total_registrations ?? 0 ?>
                        </div>
                        <div class="metric-desc">Total participant registrations</div>
                    </div>
                </div>

                <!-- CARD 3 -->
                <div class="col-12 col-md-4">
                    <div class="metric-card p-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-clock-history metric-icon"></i>
                            <span class="metric-title">Upcoming</span>
                        </div>
                        <div class="metric-value">
                            Happening soon: <?= $upcoming_events ?? 0 ?>
                        </div>
                        <div class="metric-desc">Happening soon</div>
                    </div>
                </div>

            </div>
        </div>

        <?php
                if ($event_count > 0) {
                while ($row = mysqli_fetch_assoc($event_result)) {
        ?>
                    <div class="event-card mt-3 mb-4">
                        <div class="date-box">
                            Date & Time: <br>
                            <small><?= $row['created_at'] ?></small>
                        </div>

                        <div class="photo-box mt-3 mb-3">
                            <img src="<?= $row['image'] ?>" alt="Event Image">
                        </div>

                        <div class="content-box">
                            <div class="mb-2" style="font-weight:700"><?= $row['event_name'] ?></div>
                            <div class="mb-2 text-muted" style="font-size:14px;"><?= $row['district'] ?></div>
                            <div class="text-muted mb-2" style="font-size:13px;"><?= $row['about'] ?></div>
                        </div>
                    </div>
        <?php
    }
} else {
    ?>
    <!-- EMPTY STATE -->
    <div class="empty-card text-center mb-4">
        <div><i class="bi bi-emoji-neutral"></i></div>
        <h4>No events found</h4>
        <p class="text-muted">You have not created any events yet.</p>
        <div class="d-flex justify-content-center mt-4">
            <a href="createEvent.php" class="btn btn-outline-indigo filter-pill">Create Event</a>
        </div>
    </div>
    <?php
}
?>
   
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>