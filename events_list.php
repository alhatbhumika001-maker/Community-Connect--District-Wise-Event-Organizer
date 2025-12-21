<?php
$conn = mysqli_connect("localhost", "root", "", "community_connect");
$today = date('Y-m-d');

$status   = $_GET['status']   ?? 'All';
$district = $_GET['district'] ?? '';
$search   = $_GET['q']        ?? '';

$where = " WHERE 1 ";

if (!empty($district)) {
    $where .= " AND district = '$district'";
}

if (!empty($search)) {
    $where .= " AND event_name LIKE '%$search%'";
}

/* STATUS LOGIC */
if ($status == 'Upcoming') {
    $where .= " AND date > '$today'";
}
elseif ($status == 'Ongoing') {
    $where .= " AND date <= '$today' AND registration_deadline >= '$today'";
}
elseif ($status == 'Completed') {
    $where .= " AND registration_deadline < '$today'";
}
elseif ($status == 'All') {
 $where = "WHERE registration_deadline >= '$today'";
}



$sql = "
SELECT 
    community_events.*,
    communities.community_name,
    CASE 
        WHEN status = 'Cancelled' THEN 'Cancelled'
        WHEN date > '$today' THEN 'Upcoming'
        WHEN date <= '$today' AND registration_deadline >= '$today' THEN 'Ongoing'
        ELSE 'Completed'
    END AS status
FROM community_events
JOIN communities ON community_events.community = communities.id
$where
ORDER BY date ASC
";


$result = mysqli_query($conn, $sql);

$modal_event = null;

if (isset($_GET['cancel_event_id'])) {
    $event_id = intval($_GET['cancel_event_id']);
    $res = mysqli_query($conn, "SELECT * FROM community_events WHERE id=$event_id LIMIT 1");
    $modal_event = mysqli_fetch_assoc($res);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Event - Community Connect</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="adminStyle.css">

    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    .events-list {
        max-width: 900px;
        margin-left: auto;
        margin-right: auto;
        background-color: white;
        box-shadow: 4px 4px 12px rgba(0, 0, 0, 0.1);
        padding: 15px;
        border-radius: 15px;
    }

    .eve-img {
        background-color: rgb(221, 218, 218);
        display: block;
        height: 200px;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .buttons {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        margin-top: 10px;
        gap: 10px;
    }

    .no-event {
        display: flex;
        flex-direction: column;
        text-align: center;
    }

    .bi-calendar {
        color: #8540f5;
        font-size: 50px;
    }
    </style>
</head>

<body>
    <?php
    $active = 'events';
    $topbar = 'events';
    $sub = 'event_action';
    include 'adminNav.php';
    ?>
    <div class="content">
        <h2 class="text-muted mb-1">All Events</h2>
        <div class="d-flex flex-wrap gap-4 mb-3 align-items-center">

            <!-- Search box -->
            <form method="GET" action="">
                <div class="input-group input-group-sm" style="max-width: 420px;">
                    <span class="input-group-text bg-light">
                        <i class="bi bi-search text-muted"></i>
                    </span>

                    <input type="text" name="q" class="form-control" placeholder="Search events">

                    <button type="submit" class="btn btn-outline-navy">
                        Search
                    </button>
                </div>
            </form>


            <!-- District filter -->
            <form method="GET" action="">
                <label class="small text-muted">District</label>
                <select name="district" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                    <opction>Select District</opction>
                    <option>Jalgaon</option>
                    <option>Pune</option>
                    <option>Mumbai</option>
                    <option>Nagpur</option>
                    <option>Thane</option>
                    <option>Nashik</option>
                    <option>Satara</option>
                    <option>Kolhapur</option>
                </select>
            </form>


                        <?php
            $status = $_GET['status'] ?? 'All';
            ?>
            <form method="GET">
                <label class="small text-muted">Status</label>
                <select name="status" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                    <option value="All" <?= ($status=='All')?'selected':'' ?>>All</option>
                    <option value="Upcoming" <?= ($status=='Upcoming')?'selected':'' ?>>Upcoming</option>
                    <option value="Ongoing" <?= ($status=='Ongoing')?'selected':'' ?>>Ongoing</option>
                    <option value="Completed" <?= ($status=='Completed')?'selected':'' ?>>Completed</option>
                </select>
            </form>

        </div>

        <h2 class="text-muted mb-3">Showing the events of <?php echo $district ?></h2>
       <?php
if ($result && mysqli_num_rows($result) > 0) {

    while ($event = mysqli_fetch_assoc($result)) {
?>
        <div class="events-list mb-3 container">
            <img src="<?= $event['image'] ?? 'event_image.png' ?>" class="eve-img mb-2">

            <h4><?= $event['event_name'] ?></h4>
            <h5><?= $event['community_name'] ?></h5>
            <h5 style="font-size:20px; color:gray; font-weight:700;"><?= $event['about'] ?></h5>

            <div class="mb-2">
                <?php if ($event['status'] == 'Upcoming') { ?>
                    <span class="badge bg-warning text-dark">Upcoming</span>
                <?php } elseif ($event['status'] == 'Ongoing') { ?>
                    <span class="badge bg-primary">Ongoing</span>
                <?php } else { ?>
                    <span class="badge bg-success">Completed</span>
                <?php } ?>

                <span class="small text-muted ms-2">
                    <?= date('d M Y', strtotime($event['date'])) ?>
                </span>
            </div>

            <div class="buttons">
                <a href="viewEvent.php?id=<?php echo $event['id']; ?>" class="btn btn-outline-navy btn-sm">View</a>

                <?php if ($event['status'] == 'Upcoming') { ?>
                    <a href="?cancel_event_id=<?= $event['id'] ?>" 
                    class="btn btn-outline-danger btn-sm">
                    Cancel Event
                    </a>
                <?php } ?>




            </div>
        </div>
<?php
    }

} else {
?>
    <div class="no-event mb-3">
        <i class="bi bi-calendar"></i>
        <h4>No events found</h4>
        <h5 class="text-muted">Try clearing the filters</h5>
    </div>
<?php
}
?>


        <!-- Modal for cancelling the event -->
        <?php if ($modal_event): ?>
<div class="modal fade show" id="cancelEventModal" tabindex="-1" style="display:block;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="cancel_event.php">
                <input type="hidden" name="event_id" value="<?= $modal_event['id'] ?>">

                <div class="modal-header">
                    <h5 class="modal-title">Cancel Event</h5>
                    <a href="events_list.php" class="btn-close"></a>
                </div>

                <div class="modal-body">
                    <p class="small">
                        Event: <strong><?= htmlspecialchars($modal_event['event_name']) ?></strong>
                    </p>
                    <input type="text" name="reason_title" class="form-control mb-2"
                        placeholder="Reason title (e.g. Inappropriate content)" required>
                    <p class="small text-muted">
                        Please provide a detailed explanation about the cancellation.
                    </p>
                    <textarea name="reason_detail" class="form-control" rows="3"
                        placeholder="Explain the reason in detail" required></textarea>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-outline-danger"
                        onclick="return confirm('Are you sure you want to cancel this event?')">
                        Cancel Event
                    </button>
                    <a href="events_list.php" class="btn btn-secondary">Close</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Backdrop -->
<div class="modal-backdrop fade show"></div>
<?php endif; ?>

   


    <!-- Bootstrap JS  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>