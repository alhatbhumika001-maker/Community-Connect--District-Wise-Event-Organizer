 <!-- if there are any events for the user - show the following. Only show the registered event -->
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

    .event-card {
        width: 100%;
        max-width: 960px;
        margin-top: 20px;
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

    /* Photo (middle-right) */
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
    }

    .bi-calendar-plus {
        color: #8540f5;
        font-size: 70px;
        margin-bottom: 20px;
    }
    </style>
</head>

<body>

    <?php 
        $active = 'home';
        include 'userNav.php';
    ?>

    <main class="container my-4">
        <div class="wc">
            <h1 class="greeting">Welcome to Community Connect</h1>
            <h2 class="name"><?php echo $full_name; ?></h2>
            <h3 class="wel text-muted"><i>Here's what's happening in your community today.</i></h3>
        </div>

        <div class="upcoming-events">

                <?php if ($event_count > 0) { ?>

                    <?php while ($row = mysqli_fetch_assoc($event_result)) { ?>
                        <div class="event-card mb-5 pe-4">

                            <div class="date-box">
                                <?php echo date("d M Y", strtotime($row['created_at'])); ?><br>
                                <small><?php echo date("h:i A", strtotime($row['created_at'])); ?></small>
                            </div>

                            <div class="photo-box mt-3 mb-3">
                                <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['event_name']; ?>">
                            </div>

                            <div class="content-box">
                                <div class="mb-2" style="font-weight:700">
                                    <?php echo $row['event_name']; ?>
                                </div>
                                <div class="mb-2">
                                    <?php echo $row['community_name']; ?>
                                </div>
                                <div class="mb-2 text-muted fs-6">
                                    <?php echo $row['district']; ?>
                                </div>
                                <div class="text-muted mb-2 fs-6">
                                    <?php echo $row['about']; ?>
                                </div>
                            </div>

                        </div>
                    <?php } ?>

                <?php } else { ?>

                    <!-- EMPTY STATE -->
                    <div class="empty-card text-center mb-4">
                        <div><i class="bi bi-calendar-plus"></i></div>
                        <h4>No upcoming event found</h4>
                        <p class="text-muted">Explore more events</p>
                        <div class="d-flex justify-content-center mt-4">
                            <a href="event.php" class="btn btn-outline-indigo filter-pill">Explore</a>
                        </div>
                    </div>

                <?php } ?>

            </div>

    </main>

    <!-- BOOTSTRAP JS (required for collapse/toggler) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>