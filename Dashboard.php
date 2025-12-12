<?php
include 'userHead.php';
$conn = new mysqli("localhost", "root", "", "community_connect");
// LIST OF COMMUNITIES
$user_id = $_SESSION['user_id'] ?? 0;

// Fetch events created by logged-in user
$event_query = "
    SELECT e.*, c.community_name 
    FROM community_events e
    LEFT JOIN communities c ON e.id = c.id
    WHERE e.created_by = '$user_id'
    ORDER BY e.id DESC
";

$event_result = mysqli_query($conn, $event_query);

if (!$event_result) {
    die("Query Failed: " . mysqli_error($conn));
}

$event_count = mysqli_num_rows($event_result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard - Community Connect</title>

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Outfit:wght@400;600&display=swap"
        rel="stylesheet">

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom CSS  -->
    <link rel="stylesheet" href="userStyle.css">

    <!-- BOOTSTRAP ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
    body {
        background: #f7f9fb;
        font-family: "Outfit", sans-serif;
    }

    .greeting {
        color: #18122B;
    }

    /* Event row card - responsive using flex */
    .event-card {
        width: 100%;
        max-width: 1100px;
        margin-top: 20px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.03);
    }

    .event-row {
        display: flex;
        gap: 18px;
        align-items: stretch;
        padding: 18px;
        flex-wrap: wrap;
    }

    /* left (date) column */
    .event-date {
        min-width: 120px;
        max-width: 140px;
        flex: 0 0 140px;
        text-align: center;
        border-right: 1px dashed rgba(0, 0, 0, 0.04);
        padding-right: 12px;
    }

    .event-date .date {
        font-weight: 700;
        font-size: 18px;
        color: #111827;
    }

    .event-date .time {
        color: #6b7280;
        font-size: 13px;
    }

    /* right (content) column */
    .event-content {
        flex: 1 1 0;
        min-width: 220px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .photo-box {
        width: 100%;
        height: 220px;
        overflow: hidden;
        border-radius: 8px;
        background: #f2f2f2;
    }

    .photo-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .event-title {
        font-weight: 700;
        font-size: 20px;
        margin-bottom: 6px;
    }

    .event-meta {
        color: #6b7280;
        font-size: 14px;
        margin-bottom: 6px;
    }

    .event-desc {
        color: #431e43ff;
        font-weight: 500;
        font-size: 15px;
        margin-bottom: 8px;
    }

    /* bottom-right actions */
    .event-actions {
        display: flex;
        gap: 8px;
        justify-content: flex-end;
        margin-top: auto;
        /* push to bottom */
    }

    .btn-outline-indigo {
        color: #6c4ce0;
        border-color: rgba(108, 76, 224, 0.18);
        background: transparent;
    }

    .btn-outline-indigo:hover {
        background: rgba(108, 76, 224, 0.06);
        color: #4b2fc9;
    }

    @media (max-width: 900px) {
        .event-row {
            padding: 14px;
        }

        .event-date {
            flex-basis: 100%;
            border-right: none;
            border-bottom: 1px dashed rgba(0, 0, 0, 0.04);
            padding-bottom: 12px;
            text-align: left;
        }

        .event-content {
            gap: 8px;
        }

        .photo-box {
            height: 180px;
        }
    }

    @media (max-width: 480px) {
        .photo-box {
            height: 140px;
        }
    }
    </style>
</head>

<body>

    <?php
    $active = 'home';
    include 'userNav.php';
    ?>

    <main class="container my-4 d-flex flex-column align-items-center">
        <div class="wc" style="max-width:1100px; width:100%;">
            <h1 class="greeting">Welcome to Community Connect</h1>
            <h2 class="name"><?php echo $full_name; ?></h2>
            <h3 class="wel text-muted"><i>Here's what's happening in your community today.</i></h3>
        </div>

        <div class="upcoming-events" style="width:100%; max-width:1100px;">

            <?php if ($event_count > 0) { ?>

            <?php while ($row = mysqli_fetch_assoc($event_result)) { ?>
            <div class="event-card mb-4">
                <div class="event-row">

                    <div class="event-date">
                        <div class="date"><?php echo date("d M Y", strtotime($row['created_at'])); ?></div>
                        <div class="time"><small><?php echo date("h:i A", strtotime($row['created_at'])); ?></small>
                        </div>
                    </div>

                    <div class="event-content">
                        <div class="photo-box">
                            <?php if (!empty($row['image'])): ?>
                            <img src="<?php echo htmlspecialchars($row['image']); ?>"
                                alt="<?php echo htmlspecialchars($row['event_name']); ?>">
                            <?php else: ?>
                            <div class="d-flex align-items-center justify-content-center h-100"><i class="bi bi-image"
                                    style="font-size:48px;color:#d1d5db"></i></div>
                            <?php endif; ?>
                        </div>

                        <div>
                            <div class="event-title"><?php echo htmlspecialchars($row['event_name']); ?></div>
                            <div class="event-meta"><?php echo htmlspecialchars($row['community_name']); ?> •
                                <?php echo htmlspecialchars($row['district']); ?></div>
                            <div class="event-desc"><?php echo nl2br(htmlspecialchars($row['about'])); ?></div>
                        </div>

                        <!-- action buttons bottom-right -->
                        <div class="event-actions">
                            <a href="viewEvent.php?id=<?php echo $row['id']; ?>"
                                class="btn btn-sm btn-outline-indigo">View Event</a>
                            <a href="registerEvent.php?id=<?php echo $row['id']; ?>"
                                class="btn btn-sm btn-outline-indigo">Register</a>
                        </div>

                    </div>
                </div>
            </div>
            <?php } ?>

            <?php } else { ?>

            <!-- EMPTY STATE -->
            <div class="empty-card text-center mb-4 w-100">
                <div><i class="bi bi-calendar-plus" style="font-size:48px;color:#8540f5;"></i></div>
                <h4>No upcoming event found</h4>
                <p class="text-muted">Explore more events</p>
                <div class="d-flex justify-content-center mt-4">
                    <a href="event.php" class="btn btn-outline-indigo filter-pill">Explore</a>
                </div>
            </div>

            <?php } ?>

        </div>

    </main>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>