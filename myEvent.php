<?php
session_start();


error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'mainNav.php';

// Database connection
$conn = new mysqli("localhost", "root", "", "community_connect");
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['login_user'])) {
    $user = $_SESSION['login_user'];
    $username = $user['username'];
    $email = $user['email'];
    $full_name = $user['full_name'];
    $role = $user['role'];
    $district = $user['district'];
    $bio = $user['bio'];
    $user_id = $user['user_id'];
}

// Initialize events array and count
$events = [];
$event_count = 0;

// ================= FETCH ONLY LOGGED-IN USER EVENTS =================
if ($user_id > 0) {

    $stmt = $conn->prepare("
        SELECT id, event_name, date, start_time, district, image
        FROM community_events
        WHERE created_by = ?
        ORDER BY date DESC
    ");

    if (!$stmt) {
        die("EVENT QUERY ERROR: " . $conn->error);
    }

    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    $stmt->bind_result(
        $id,
        $event_name,
        $date,
        $start_time,
        $district,
        $image
    );

    while ($stmt->fetch()) {
        $events[] = [
            'id'         => $id,
            'name'       => $event_name,
            'date'       => $date,
            'time'       => $start_time,
            'district'   => $district,
            'image'      => $image ?: 'default_event.jpg' // fallback image
        ];
    }

    $event_count = count($events);
    $stmt->close();
}

// ================= FETCH REGISTRATIONS FOR EVENTS =================
$event_requests = [];

if ($user_id > 0 && $event_count > 0) {
    $event_ids = array_column($events, 'id');
    $ids_str = implode(',', $event_ids);

   $reg_query = "
    SELECT id, event_id, user_id, name, email, phone, district, status
    FROM registrations
    WHERE event_id IN ($ids_str)
    ORDER BY created_at DESC
";



    $res = $conn->query($reg_query);
    if ($res) {
        while ($row = $res->fetch_assoc()) {
            $event_requests[$row['event_id']][] = $row;
        }
    }
}

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
    <div class="text-center py-4 border-bottom">
    <?php if (isset($_SESSION['login_user'])): ?>
      <a href="profile.php">
        <img src="user.png" alt="Profile" class="sidebar-profile-img" />
      </a>
      <h6 class="mt-3 mb-0"><?= htmlspecialchars($full_name) ?></h6>
    <?php else: ?>
      <a href="login.php">
        <img src="user.png" alt="Guest" class="sidebar-profile-img" />
      </a>
      <h6 class="mt-3 mb-0">Guest</h6>
    <?php endif; ?>
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
                    <div class="metric-title">Total Events Created</div>
                </div>
               <div class="metric-count" style="color: #34275f;">Total Event:<?= $event_count ?></div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="metric-card">
                <div class="metric-top">
                    <div class="metric-icon-box"><i class="bi bi-people"></i></div>
                    <div class="metric-title">Total Attendees Events</div>
                </div>
                <div class="metric-count" style="color: #34275f;">Attendees: 0</div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="metric-card">
                <div class="metric-top">
                    <div class="metric-icon-box"><i class="bi bi-person-fill-add"></i></div>
                    <div class="metric-title">New Attendees Last Week</div>
                </div>
                <div class="metric-count" style="color: #34275f;">New Attendees:0</div>
            </div>
        </div>
    </div>

  <?php if ($event_count > 0): ?>

    <?php foreach ($events as $event): ?>
        <div class="event-card">
            <div class="event-banner">
                <img src="<?= htmlspecialchars($event['image']) ?>" alt="Event Banner">
            </div>

            <h3 style="font-size:25px; color: #4b378d; font-weight:bold;">
                <?= htmlspecialchars($event['name']) ?>
            </h3>

            <p>
                <strong style=" color: #4b378d;">Date: </strong>
                <?= date("d M Y", strtotime($event['date'])) ?>
                | <?= htmlspecialchars($event['district']) ?>
            </p>

            <p>  
                <strong style=" color: #4b378d;">Time: </strong>
                <?= date("h:i A", strtotime($event['time'])) ?>
            </p>

            <a href="viewEvent.php?id=<?= $event['id'] ?>" class="btn btn-outline-indigo">
                View Event
            </a>

            <!-- ======= Event Requests Section ======= -->
            <?php if (!empty($event_requests[$event['id']])): ?>
                <h5 class="mt-4" style="color:#4b378d;">Event Requests</h5>
                <table class="table table-bordered mt-2">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>District</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>Profile</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($event_requests[$event['id']] as $req): ?>
                            <tr>
                                <td><?= htmlspecialchars($req['name']) ?></td>
                                <td><?= htmlspecialchars($req['email']) ?></td>
                                <td><?= htmlspecialchars($req['phone']) ?></td>
                                <td><?= htmlspecialchars($req['district']) ?></td>
                                <td><?= ucfirst($req['status']) ?></td>
                                <td>
                                    <?php if ($req['status'] === 'pending'): ?>
                                        <a href="updateRequest.php?id=<?= $req['id'] ?>&action=approve" class="btn btn-success btn-sm">Accept</a>
                                        <a href="updateRequest.php?id=<?= $req['id'] ?>&action=reject" class="btn btn-danger btn-sm">Reject</a>
                                    <?php else: ?>
                                        <button class="btn btn-success btn-sm">Accepted</button>
                                    <?php endif; ?>
                                </td>
                                <td>
                                  <a href="event_member_profile.php?user_id=<?= $req['user_id'] ?>" class="btn btn-info btn-sm">
    Profile
</a>


                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-muted mt-3">No requests for this event yet.</p>
            <?php endif; ?>
            <!-- ======= End Event Requests ======= -->

        </div> <!-- end event-card -->
    <?php endforeach; ?>

<?php else: ?>
    <!-- No Events Found -->
    <div class="empty-card text-center mb-4">
        <div class="bi bi-calendar-x" style="font-size:80px;color:#8540f5;"></div>
        <h4>No Events Found</h4>
        <p class="text-muted">
            You have not created any events yet.<br>
            Please create an event to get started.
        </p>
        <a href="createEvent.php" class="btn btn-outline-indigo">
            Create Event
        </a>
    </div>
<?php endif; ?>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
