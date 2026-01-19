<?php
$conn = mysqli_connect("localhost", "root", "", "community_connect");
include 'mainNav.php';

$id = $_SESSION['login_user']['id'] ?? 0;

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

/* ===== ALL JOINED EVENTS ===== */
/* ===== ALL JOINED EVENTS WITH DETAILS ===== */
$stmt = $conn->prepare(
    "SELECT 
        r.id AS id,
        r.event_id,
        r.status,
        e.event_name,
        e.location,
        e.district,
        e.date AS event_date,
        e.start_time,
        e.image
     FROM registrations r
     JOIN community_events e ON r.event_id = e.id
     WHERE r.user_id = ?
     ORDER BY e.date DESC, e.start_time DESC"
);


if (!$stmt) {
    die("SQL ERROR: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$joinedEvents = $stmt->get_result();


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Joined Events</title>

<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
    font-family: Outfit, sans-serif;
    background:#eef4ff;
    margin-top:120px;
}

/* ===== FIXED SIDEBAR ===== */
 .sidebar {
    width: 280px;
    position: fixed;
    top: 80px;
    left: 0;
    bottom: 0;
    background: linear-gradient(90deg, #f9f2ff 0%, #d4c0ff 100%);
    padding-top: 20px;
    overflow-y: auto;
    box-shadow: 2px 0 8px rgb(117 94 189 / 0.15);
    border-right: 1px solid #c3b7f7;
  }

  .sidebar-profile-img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #a076ff;
    box-shadow: 0 0 10px #a076ff88;
  }

  .sidebar-nav .nav-link {
    color: #6b55a5;
    font-weight: 600;
    padding: 12px 25px;
    border-radius: 12px;
    transition: background-color 0.3s ease;
  }

  .sidebar-nav .nav-link.active,
  .sidebar-nav .nav-link:hover {
    background: #d9c9ff;
    color: #512da8;
  }

.main{
    margin-left:280px;
}

/* CARD (same as your design) */
.list-card{
    background:#fff;
    border-radius:10px;
    box-shadow:0 4px 12px rgba(0,0,0,.05);
    overflow:hidden;
    max-width:1150px;
}

.list-card-img-wrap{
    background:#f1f3f5;
    min-height:180px;
}

.list-card-img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.list-card-body{
    padding:16px;
}

.list-card-title{
    font-size:18px;
    font-weight:600;
}

.list-card-text{
    font-size:14px;
    color:#374151;
}

.list-card-meta{
    font-size:13px;
    color:#6b7280;
}

.btn-outline-indigo{
    border:1px solid #7e57c2;
    color:#6a1b9a;
    font-weight:600;
}
.btn-outline-indigo:hover{
    background:#7e57c2;
    color:#fff;
}

@media(max-width:768px){
    .sidebar{position:static;width:100%;}
    .main{margin-left:0;}
}
</style>
</head>

<body>

<!-- Sidebar (optional) -->
<div class="sidebar">
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
  <nav class="nav flex-column sidebar-nav mt-3 px-3">
    <a class="nav-link <?= ($active ?? '') == 'profile' ? 'active' : '' ?>" href="profile.php">Profile</a>
    <a class="nav-link <?= ($active ?? '') == 'myEvent' ? 'active' : '' ?>" href="myCommunity.php ">Created Communities</a>
    <a class="nav-link <?= ($active ?? '') == 'myCommunity' ? 'active' : '' ?>" href="myEvent.php">Created Events</a>
    <a class="nav-link <?= ($active ?? '') == 'joinedCom' ? 'active' : '' ?>" href="joinedCom.php">Joined Communities</a>
    <a class="nav-link <?= ($active ?? '') == 'joinedEve' ? 'active' : '' ?>" href="joinedEve.php">Joined Events</a>

    <a class="nav-link" data-bs-toggle="collapse" href="#createMenu" role="button" aria-expanded="false" aria-controls="createMenu">
      Create <span class="chevron">▾</span>
    </a>
    <div class="collapse ps-3" id="createMenu">
      <a class="nav-link small" href="createCommunity.php">Community</a>
      <a class="nav-link small" href="createEvent.php">Event</a>
    </div>
  </nav>

  <div class="mt-auto border-top">
    <?php if (isset($_SESSION['login_user'])): ?>
      <a href="logout.php" class="nav-link text-danger px-4 py-3">Logout</a>
    <?php else: ?>
      <a href="login.php" class="nav-link text-info px-4 py-3">Login</a>
    <?php endif; ?>
  </div>
</div>


<div class="main">

<h2 class="ms-lg-4 mt-5" style="font-size:30; color: #4b378d; font-weight:bold;">All Your Joined Events</h2>

<div class="container-fluid mt-4">
  <div class="row">
    <div class="col-12 ps-lg-4">

    <?php if ($joinedEvents->num_rows > 0): ?>
      <?php while($row = $joinedEvents->fetch_assoc()): ?>
      <div class="list-card mb-3">
        <div class="row g-0">

          <!-- Image -->
                    <div class="col-md-4 list-card-img-wrap">
                        <img src="<?= htmlspecialchars($row['image']) ?>"
                             class="list-card-img"
                             alt="Event image">
                    </div>


          <div class="col-md-8">
            <div class="list-card-body">

              <h5 class="list-card-title" style="font-size:25px; color: #4b378d;"><?= htmlspecialchars($row['event_name']) ?></h5>

              <p class="list-card-text">
                  <strong style=" color: #4b378d; font-size:15px;"> Location: </strong> <?= htmlspecialchars($row['location']) ?> <br>
                  <strong style=" color: #4b378d; font-size:15px;"> District:</strong>  <?= htmlspecialchars($row['district']) ?>
              </p>

              <p class="list-card-meta">
                   <strong style=" color: #4b378d; font-size:15px;">Date :</strong><?= date('d M Y', strtotime($row['event_date'])) ?>
                  | <?= date('h:i A', strtotime($row['start_time'])) ?>
              </p>

              <p>
              <?php if ($row['status'] === 'approved'): ?>
                  <span class="badge text-bg-success">Request Accepted</span>
              <?php else: ?>
                  <span class="badge text-bg-warning">Request Pending</span>
              <?php endif; ?>
              </p>

              <a href="viewEvent.php?id=<?= $row['event_id'] ?>" class="btn btn-sm btn-outline-indigo">
                  View Details
              </a>

            </div>
          </div>

        </div>
      </div>
      <?php endwhile; ?>

    <?php else: ?>
       <!-- EMPTY STATE -->
            <div class="text-center my-5">
                <i class="bi bi-emoji-neutral" style="font-size:70px; color:#8540f5;"></i>
                <h4 class="mt-3">No Events found</h4>
                <p>You have not joined any communities yet.</p>
                <a href="event.php" class="btn btn-outline-indigo">
                    Explore Events
                </a>
            </div>
    <?php endif; ?>

    </div>
  </div>
</div>


</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
