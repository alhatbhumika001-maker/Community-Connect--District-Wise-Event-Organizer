<?php
     $conn = new mysqli("localhost", "root", "", "community_connect");
    // LIST OF COMMUNITIES
    $user_id = $_SESSION['user_id'] ?? 0;
 // Fetch communities Count
    $community_query = "SELECT * FROM communities";
    $community_result = mysqli_query($conn, $community_query);
    $community_count = mysqli_num_rows($community_result);

    // Fetch Users Count
    $users_query = "SELECT * FROM users";
    $users_result = mysqli_query($conn, $users_query);
    $users_count = mysqli_num_rows($users_result);

    // Fetch events Count
    $events_query = "SELECT * FROM community_events";
    $events_result = mysqli_query($conn, $events_query);
    $events_count = mysqli_num_rows($events_result);

    // Fetch events latest...
    $events_qu = "
    SELECT community_events.*, communities.community_name 
    FROM community_events 
    JOIN communities ON community_events.community = communities.id
    ORDER BY community_events.id DESC LIMIT 5";
   $events_re = mysqli_query($conn, $events_qu);
    $events_co = mysqli_num_rows($events_re);

     // Fetch events latest...
    $communities_qu = "
    SELECT * FROM communities ORDER BY id DESC LIMIT 5";
   $communities_re = mysqli_query($conn, $communities_qu);
    $communities_co = mysqli_num_rows($communities_re);
?>
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
    .list-card {
    margin-bottom: 20px;
}

    </style>
</head>

<body class="no-strip">
<?php
$active = 'adminDashboard';
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

<div class="content container">

    <!-- ===== METRIC CARDS ===== -->
    <div class="row g-3">

        <div class="col-md-6">
            <div class="metric-card">
                <div class="metric-top">
                    <div class="metric-icon"><i class="bi bi-people"></i></div>
                    <div class="metric-title text-muted"><span style="color: #312E81; font-weight:600;">Total Communities<span><br><span style="font-size:20px; color:gray;">Joined Comunities to Community Connect</span></div>
                </div>
                <div class="metric-value"><span style="color: black; font-size:26px;">Total Communities: </span><?php echo $community_count; ?></div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="metric-card">
                <div class="metric-top">
                    <div class="metric-icon"><i class="bi bi-calendar-event"></i></div>
                    <div class="metric-title text-muted"><span style="color: #312E81; font-weight:600;">Total Events<span><br><span style="font-size:20px; color:gray;">Joined Events to Community Connect</span></div>
                </div>
                <div class="metric-value"><span style="color: black; font-size:26px;">Total Events: </span> <?php echo $events_count; ?></div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="metric-card">
                <div class="metric-top">
                    <div class="metric-icon"><i class="bi bi-person-check"></i></div>
                    <div class="metric-title text-muted"><span style="color: #312E81; font-weight:600;">Total Users<span><br><span style="font-size:20px; color:gray;">Joined Users to Community Connect</span></div>
                </div>
                <div class="metric-value"><span style="color: black; font-size:26px;">Total Users: </span><?php echo $users_count; ?></div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="metric-card">
                <div class="metric-top">
                    <div class="metric-icon"><i class="bi bi-lightning-charge"></i></div>
                    <div class="metric-title text-muted"><span style="color: #312E81; font-weight:600;">Active Events<span><br><span style="font-size:20px; color:gray;">Active Events to Community Connect</span></div>
                </div>
                <div class="metric-value"><span style="color: black; font-size:26px;">Active Events: </span><?php echo $row['active_events']; ?></div>
            </div>
        </div>

    </div>

    <!-- ===== RECENT EVENTS ===== -->
    <h4 class="section-title">Recent Events</h4>

    <?php if ($events_co > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($events_re)): ?>
            <?php $event_id = $row['id']; ?>
            <div class="list-card mx-auto">
                <div class="row g-0 align-items-stretch">
                    <div class="col-md-4 list-card-img-wrap">
                        <img src="<?php echo $row['image']; ?>" class="list-card-img">
                    </div>
                    <div class="col-md-8">
                        <div class="list-card-body">
                            <h5 class="list-card-title"><?php echo $row['event_name']; ?></h5>
                            <p class="list-card-text"><?php echo $row['about']; ?></p>
                            <p class="list-card-meta">
                                Community: <?php echo $row['community_name']; ?><br>
                                Date: <?php echo date("d M Y", strtotime($row['date'])); ?>
                            </p>
                            <a href="viewEvent.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-navy">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="text-center">No recent events found.</p>
    <?php endif; ?>

    <!-- ===== RECENT COMMUNITIES ===== -->
    <h4 class="section-title">Recent Community</h4>

    <?php if ($communities_co > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($communities_re)): ?>
            <?php $cid = $row['id']; ?>
            <div class="list-card mx-auto">
                <div class="row g-0 align-items-stretch">
                    <div class="col-md-4 list-card-img-wrap">
                        <img src="<?php echo $row['image']; ?>" class="list-card-img">
                    </div>
                    <div class="col-md-8">
                        <div class="list-card-body">
                            <h5 class="list-card-title"><?php echo $row['community_name']; ?></h5>
                            <p class="list-card-text"><?php echo $row['about']; ?></p>
                            <p class="list-card-meta">
                                Date: <?php echo date("d M Y", strtotime($row['created_at'])); ?>
                            </p>
                            <a href="com-Events.php?id=<?= $cid ?>" class="btn btn-sm btn-outline-navy">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="text-center">No communities found.</p>
    <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
