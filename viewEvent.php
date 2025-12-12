<?php
include 'userHead.php';
$conn = mysqli_connect("localhost", "root", "", "community_connect");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the event ID from URL
if (!isset($_GET['id'])) {
    die("Event ID not specified.");
}

$event_id = intval($_GET['id']); // sanitize input

// SQL Query: fetch only this event
$event_query = "
    SELECT community_events.*, communities.community_name 
    FROM community_events 
    JOIN communities ON community_events.community = communities.id
    WHERE community_events.id = $event_id
    LIMIT 1
";

$event_result = mysqli_query($conn, $event_query);

if (!$event_result) {
    die("SQL Error: " . mysqli_error($conn));
}

if (mysqli_num_rows($event_result) == 0) {
    die("Event not found.");
}

// Fetch the single event
$row = mysqli_fetch_assoc($event_result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{Event-name}} - Community Connect</title>

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600&display=swap" rel="stylesheet">

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="userStyle.css">

    <!-- BOOTSTRAP ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
    body {
        font-family: 'Outfit', sans-serif;
        background: #f8f9f0;
        margin: 0;
    }

    /* Card container */
    .view-event {
        width: 100%;
        max-width: 1100px;
        /* prevents too wide layouts on desktop */
        margin: 20px auto;
        padding: 20px;
        background-color: white;
        border-radius: 20px;
        box-shadow: 2px 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Poster box */
    .event-photo {
        width: 100%;
        height: 220px;
        border-radius: 10px;
        overflow: hidden;
        background-color: rgba(128, 128, 128, 0.3);
    }

    .event-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* Mobile Responsive Tweaks */
    @media (max-width: 576px) {
        .view-event {
            padding: 16px;
        }

        h3.event-name {
            font-size: 1.3rem;
        }

        h5.event-dateTime {
            font-size: 1.1rem;
        }

        .event-button button {
            width: 100%;
        }

        .back-to-explore button {
            width: 100%;
            margin-top: 10px;
        }
    }
    </style>

</head>

<body>

    
    <?php
    include 'userNav.php';
    ?>
   
        <div class="view-event container-fluid mt-3 mb-3">
            <h3 class="event-name">
                <?= htmlspecialchars($row['event_name']) ?> | <?= htmlspecialchars($row['event_type']) ?>
            </h3>
            <h5 class="event-dateTime">
                <?= htmlspecialchars($row['date']) ?> at <?= htmlspecialchars($row['start_time']) ?>
            </h5>
           
            <hr>
            <div class="event-photo mb-3">
               
            <img src="<?php echo !empty($row['image']) ? $row['image'] : 'https://via.placeholder.com/300x210?text=No+Image'; ?>" alt="<?php echo $row['event_name']; ?>">
                
            </div>
            <h5>
                Sponsor Community: <?= htmlspecialchars($row['community_name']) ?> 
            </h5>
           
            <p class="eve-description"><?= nl2br(htmlspecialchars($row['about'])) ?></p>
            <p class="eve-address">District: <?= htmlspecialchars($row['district']) ?></p>
            <div class="event-button d-flex justify-content-end">
                <button class="btn btn-sm btn-outline-indigo px-4" type="button">
                    Register
                </button>
            </div>
        </div>
 



    <div class="back-to-explore d-flex justify-content-end mb-4" style="max-width:650px; margin:auto;">
        <a href="event.php" class="btn btn-sm btn-outline-indigo px-4" type="button">
            Back to Explore Page
        </a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>