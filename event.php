<?php
include 'mainNav.php';

$conn = mysqli_connect("localhost", "root", "", "community_connect");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

/* FILTERS */
$selectedDistrict = $_GET['district'] ?? 'all';
$selectedCategory = $_GET['category'] ?? '';
$todayFilter      = $_GET['date'] ?? '';

$event_query = "
SELECT community_events.*, communities.community_name 
FROM community_events 
JOIN communities ON community_events.community = communities.id
WHERE 1
";

if ($selectedDistrict !== 'all') {
    $event_query .= " AND community_events.district = '" . mysqli_real_escape_string($conn, $selectedDistrict) . "'";
}

if (!empty($selectedCategory)) {
    $event_query .= " AND community_events.category = '" . mysqli_real_escape_string($conn, $selectedCategory) . "'";
}

if ($todayFilter === 'today') {
    $event_query .= " AND community_events.date = CURDATE()";
}

$event_query .= " ORDER BY community_events.date ASC";

$event_result = mysqli_query($conn, $event_query);
$event_count  = mysqli_num_rows($event_result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Events | Community Connect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Huninn&family=Outfit:wght@100..900&display=swap"
        rel="stylesheet">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom CSS  -->
    <link rel="stylesheet" href="style.css">

    <style>
    body {
        background: #f4f7fb;
        font-family: 'Outfit', sans-serif;
        margin-top: 120px;
    }

    /* GRID */
    .event-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 24px;
        margin-top: 30px;
    }

    /* CARD */
    .event-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        transition: .3s;
        display: flex;
        flex-direction: column;
    }

    .event-card:hover {
        transform: translateY(-5px);
    }

    /* IMAGE */
    .event-card img {
        width: 100%;
        height: 190px;
        object-fit: cover;
    }

    /* CONTENT */
    .event-body {
        padding: 15px;
        flex: 1;
    }

    .event-title {
        font-size: 18px;
        font-weight: 600;
        color: #111827;
    }

    /* TITLE + BADGE FLEX */
    .event-title-wrap {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 6px;
    }

    .event-meta {
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 4px;
    }

    .event-meta span {
        color: #374151;
        font-weight: 500;
    }

    /* BADGES */
    .badge-custom {
        font-size: 11px;
        padding: 4px 10px;
        border-radius: 20px;
        font-weight: 600;
    }

    .badge-public {
        background: #dcfce7;
        color: #166534;
    }

    .badge-private {
        background: #fee2e2;
        color: #991b1b;
    }

    /* FOOTER BUTTONS */
    .event-footer {
        padding: 12px 15px;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    </style>
</head>

<body>

    <div class="container mt-5">

        <h2 class="fw-bold mb-2" style="margin-top:110px;">Events</h2>
        <p class="text-muted">Discover events happening near you</p>

        <div class="event-grid">

            <?php while ($row = mysqli_fetch_assoc($event_result)) { ?>

            <div class="event-card">

                <img
                    src="<?= !empty($row['image']) ? $row['image'] : 'https://via.placeholder.com/400x200?text=Event' ?>">

                <div class="event-body">

                    <!-- TITLE + PRIVACY BADGE -->
                    <div class="event-title-wrap">
                        <div class="event-title"><?= $row['event_name']; ?></div>
                        <?php if ($row['privacy'] == 'private') { ?>
                        <span class="badge-custom badge-private">Private Event</span>
                        <?php } else { ?>
                        <span class="badge-custom badge-public">Public Event</span>
                        <?php } ?>
                    </div>

                    <div class="event-meta">
                        <span>Community:</span> <?= $row['community_name']; ?>
                    </div>

                    <div class="event-meta">
                        <span>Date:</span> <?= date("d M Y", strtotime($row['date'])); ?>
                    </div>

                    <div class="event-meta">
                        <span>Time:</span> <?= date("h:i A", strtotime($row['start_time'])); ?>
                        | <?= $row['district']; ?>
                    </div>

                </div>

              <!-- FOOTER -->
<div class="event-footer">
    <?php
        $today = date('Y-m-d');
        $isLoggedIn = isset($_SESSION['user_id']); // Check if user is logged in

        if ($row['date'] < $today) {
            echo '<button class="btn btn-warning btn-sm" disabled>Ended</button>';
        } elseif ($row['date'] == $today) {
            echo '<button class="btn btn-primary btn-sm" disabled>Ongoing</button>';
        } else {
            if ($isLoggedIn) {
                // Logged-in users can register
                echo '<a href="registerEvent.php?id=' . $row['id'] . '" class="btn btn-outline-info btn-sm">Register</a>';
            } else {
                // Not logged-in users see a button that triggers a toast
                echo '<button class="btn btn-outline-info btn-sm" onclick="showLoginToast()">Register</button>';
            }
        }
    ?>
    <a href="viewEvent.php?id=<?= $row['id']; ?>" class="btn btn-outline-secondary btn-sm">View</a>
</div>

<!-- Bootstrap Toast -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="loginToast" class="toast align-items-center text-bg-warning border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                Please log in to register for this event!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<script>
function showLoginToast() {
    var toastEl = document.getElementById('loginToast');
    var toast = new bootstrap.Toast(toastEl);
    toast.show();
}
</script>


            </div>

            <?php } ?>

        </div>

        <?php if ($event_count == 0) { ?>
        <div class="text-center mt-5">
            <h4>No events found</h4>
            <a href="event.php" class="btn btn-outline-info mt-2">Clear Filters</a>
        </div>
        <?php } ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <?php include 'sidebar.php'; ?>
    <?php include 'footer.php'; ?>

</body>

</html>