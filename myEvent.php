<?php
include 'mainNav.php';

$conn = new mysqli("localhost", "root", "", "community_connect");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'] ?? 0;

// Fetch events safely
$stmt = $conn->prepare("SELECT * FROM events WHERE created_by = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$event_result = $stmt->get_result();

if ($event_result) {
    $event_count = $event_result->num_rows;
} else {
    $event_count = 0; // default if query fails
}


// Fetch total attendees safely
$attendees_stmt = $conn->prepare("
    SELECT COUNT(*) as total_attendees 
    FROM event_attendees ea
    JOIN events e ON ea.event_id = e.id
    WHERE e.created_by = ?
");
if (!$attendees_stmt) die("Prepare failed: " . $conn->error);

$attendees_stmt->bind_param("i", $user_id);
$attendees_stmt->execute();
$attendees_stmt->bind_result($total_attendees);
$attendees_stmt->fetch();
$attendees_stmt->close();
$total_attendees = $total_attendees ?? 0;

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Events - Community Connect</title>

<!-- GOOGLE FONTS -->
<link href="https://fonts.googleapis.com/css2?family=Handlee&family=Outfit:wght@400;600&display=swap" rel="stylesheet" />

<!-- BOOTSTRAP CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

<style>
body {
    font-family: 'Outfit', sans-serif;
    background: #f8f9fa;
    margin: 0;
    color: #111827;
}
.sidebar {
    width: 260px;
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    background: linear-gradient(90deg, #f9f2ff 0%, #d4c0ff 100%);
    overflow-y: auto;
    padding-top: 80px;
    border-right: 1px solid #c3b7f7;
}
.sidebar-profile-img {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #a076ff;
    box-shadow: 0 0 10px #a076ff88;
    display: block;
    margin: 0 auto 10px auto;
}
.sidebar-nav .nav-link {
    color: #6b55a5;
    font-weight: 600;
    padding: 12px 20px;
    border-radius: 12px;
    display: block;
}
.sidebar-nav .nav-link.active,
.sidebar-nav .nav-link:hover {
    background: #d9c9ff;
    color: #512da8;
}
.sidebar .collapse .nav-link {
    padding-left: 40px;
}
.main {
    margin-left: 260px;
    padding: 40px 30px;
}
.metric-card {
    border-radius: 20px;
    padding: 18px;
    background: #ffffff;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
    transition: 0.25s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 150px;
}
.metric-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.16);
}
.metric-top {
    display: flex;
    align-items: center;
    gap: 16px;
}
.metric-icon-box {
    width: 72px;
    height: 72px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 6px 14px rgba(123, 47, 247, 0.12);
    flex-shrink: 0;
    background: #fff;
}
.bi {
    font-size: 2rem;
    color: #8540f5;
}
.metric-title {
    font-size: 18px;
    font-weight: 700;
    color: #333;
    line-height: 1.05;
}
.metric-count {
    margin-top: 14px;
    font-size: 28px;
    font-weight: 800;
    color: #111827;
}
.event-card {
    border-radius: 12px;
    padding: 20px;
    background-color: #ffffff;
    box-shadow: 0 6px 18px rgba(0,0,0,0.06);
    margin-bottom: 30px;
}
.event-banner {
    width: 100%;
    height: 160px;
    overflow: hidden;
    border-radius: 8px;
    margin-bottom: 12px;
    background: #efefef;
}
.event-banner img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.empty-card {
    padding: 40px;
    border-radius: 20px;
    background: #f3e8ff;
    box-shadow: 0 6px 18px rgba(123, 47, 247, 0.12);
}
.btn-outline-indigo {
    color: #6610f2;
    border: 1px solid #6610f2;
}
.btn-outline-indigo:hover {
    background-color: #6610f2;
    color: #fff;
}
@media (max-width: 768px) {
    .main {
        margin-left: 0;
        padding: 20px;
    }
}
</style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar" style="margin-top:25px;">
    <div class="text-center mb-3">
        <img src="user.png" alt="User" class="sidebar-profile-img">
        <h6><?= htmlspecialchars($_SESSION['user_name'] ?? 'Guest') ?></h6>
    </div>
    <nav class="sidebar-nav">
        <a class="nav-link <?= ($active ?? '') == 'profile' ? 'active' : '' ?>" href="profile.php">Profile</a>
        <a class="nav-link <?= ($active ?? '') == 'myCommunity' ? 'active' : '' ?>" href="myCommunity.php">Created Communities</a>
        <a class="nav-link <?= ($active ?? '') == 'myEvent' ? 'active' : '' ?>" href="myEvent.php">Created Events</a>
        <a class="nav-link <?= ($active ?? '') == 'joinedCom' ? 'active' : '' ?>" href="joinedCom.php">Joined Communities</a>
        <a class="nav-link <?= ($active ?? '') == 'joinedEve' ? 'active' : '' ?>" href="joinedEve.php">Joined Events</a>

        <a class="nav-link" data-bs-toggle="collapse" href="#createMenu" role="button" aria-expanded="false" aria-controls="createMenu">
            Create ▾
        </a>
        <div class="collapse ps-3" id="createMenu">
            <a class="nav-link small" href="createCommunity.php">Community</a>
            <a class="nav-link small" href="createEvent.php">Event</a>
        </div>
        <a class="nav-link text-danger mt-3" href="logout.php">Logout</a>
    </nav>
</div>

<!-- Main Content -->
<div class="main">
    <div class="container-fluid row g-4 mb-4">
        <!-- Metrics -->
        <div class="col-12 col-md-4">
            <div class="metric-card">
                <div class="metric-top">
                    <div class="metric-icon-box"><i class="bi bi-calendar-event"></i></div>
                    <div class="metric-title">Events Created</div>
                </div>
                <div class="metric-count" style="color: #34275f;"><?= $event_count ?></div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="metric-card">
                <div class="metric-top">
                    <div class="metric-icon-box"><i class="bi bi-people"></i></div>
                    <div class="metric-title">Total Attendees</div>
                </div>
                <div class="metric-count" style="color: #34275f;"><?= $total_attendees ?></div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="metric-card">
                <div class="metric-top">
                    <div class="metric-icon-box"><i class="bi bi-person-fill-add"></i></div>
                    <div class="metric-title">New Attendees Last Week</div>
                </div>
                <div class="metric-count" style="color: #34275f;">0</div>
            </div>
        </div>
    </div>

    <!-- Events List -->
    <?php if ($event_count > 0): ?>
    <!-- Loop through events -->
    <?php while ($event = $event_result->fetch_assoc()): ?>
        <div class="event-card">
            <div class="event-banner"><img src="<?= $event['image'] ?>" alt="Event Banner"></div>
            <h3><?= htmlspecialchars($event['event_name']) ?></h3>
            <p><?= date("d M Y", strtotime($event['event_date'])) ?> | <?= htmlspecialchars($event['district']) ?></p>
            <p><?= date("h:i A", strtotime($event['event_time'])) ?></p>
            <a href="eventDetails.php?id=<?= $event['id'] ?>" class="btn btn-outline-indigo">View Event</a>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <div class="empty-card text-center mb-4">
        <div class="bi bi-calendar-x" style="font-size:80px;color:#8540f5;margin-bottom:12px"></div>
        <h4>No Events Created</h4>
        <p class="text-muted">You haven’t organized any events yet. Start something amazing today!</p>
        <a href="createEvent.php" class="btn btn-outline-indigo">Create Your First Event</a>
    </div>
<?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
