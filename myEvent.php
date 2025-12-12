<?php
include 'userHead.php'; 
$conn = mysqli_connect("localhost", "root", "", "community_connect");

// LIST OF EVENTS: Show only events created by logged-in user
$user_id = $_SESSION['user_id'] ?? 0;

// Fetch events
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
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Outfit:wght@400;600&display=swap" rel="stylesheet">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <link rel="stylesheet" href="userStyle.css" />

    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f8f9fa;
        }

        .event-card {
            width: 100%;
            display: grid;
            border-radius: 8px;
            padding: 10px;
            background: #fff;
        }

        .photo-box {
            width: 100%;
            height: 300px;
            overflow: hidden;
            border-radius: 6px;
            margin-bottom: 10px;
        }

        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .date-box {
            font-size: 16px;
            color: #3c3838ff;
        }
        span{
            color:black;
        }
        .text-muted
        {
            font-size: 15px;
            color: #431e43ff;
            font-weight:500;
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

    <!-- EVENT CARDS -->
    <div class="container">
        <div class="row g-4">

        <?php
        if ($event_count > 0) {
            while ($row = mysqli_fetch_assoc($event_result)) {
        ?>

        <!-- ⬇️ Card column (this makes multiple cards per row) -->
        <div class="col-12 col-md-6 col-lg-12">

            <div class="event-card">

                <div class="date-box mb-2">
                    <span>Date:</span> <?php echo date("d M Y", strtotime($row['date'])); ?> | 
                     <?php echo $row['district']; ?>
                </div>

                <div class="photo-box">
                    <img src="<?= $row['image'] ?>" alt="Event Image">
                </div>

                

                <div class="fw-bold mb-1"><?= $row['event_name'] ?></div>

                 Time: <?php echo date("h:i A", strtotime($row['start_time'])); ?> to <?php echo date("h:i A", strtotime($row['end_time'])); ?>

                <div class="text-muted"><?= $row['about'] ?></div>

            </div>

        </div>
        <!-- END card column -->

        <?php
            }
        } else {
        ?>

        <!-- EMPTY STATE -->
        <div class="text-center my-5">
            <i class="bi bi-emoji-neutral" style="font-size:70px; color:#8540f5;"></i>
            <h4>No events found</h4>
            <p class="text-muted">You have not created any events yet.</p>
            <a href="createEvent.php" class="btn btn-outline-dark">Create Event</a>
        </div>

        <?php } ?>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
