<?php
session_start();
include 'mainNav.php'; // or mainNav.php if needed

$conn = new mysqli("localhost", "root", "", "community_connect");
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

// Fetch communities created by logged-in user
$community_query = "SELECT * FROM communities WHERE created_by = $user_id ORDER BY id DESC";
$community_result = mysqli_query($conn, $community_query);
$community_count = mysqli_num_rows($community_result);

// Fetch total members
$community_members = "SELECT * FROM community_members";
$result = mysqli_query($conn, $community_members);
$res_count = mysqli_num_rows($result);

// Handle Approve / Reject requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['reject_request'])) {
        $request_id = intval($_POST['request_id']);
        $delete = $conn->query("DELETE FROM community_members WHERE id = $request_id");
        if ($delete) echo "<script>alert('Request rejected!'); window.location = window.location.href;</script>";
    }
    if (isset($_POST['approve_request'])) {
        $request_id = intval($_POST['request_id']);
        $update = $conn->query("UPDATE community_members SET status='approved' WHERE id=$request_id");
        if ($update) echo "<script>alert('Request approved!'); window.location = window.location.href;</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Created Community - Community Connect</title>

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

/* --------- Sidebar --------- */
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

/* --------- Main Content --------- */
.main {
    margin-left: 260px;
    padding: 40px 30px;
}

 .metric {
        padding: 10px;
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

/* Community Card */
.community {
    border-radius: 12px;
    padding: 20px;
    background-color: #ffffff;
    box-shadow: 0 6px 18px rgba(0,0,0,0.06);
    margin-bottom: 30px;
}

.com-banner {
    width: 100%;
    height: 160px;
    overflow: hidden;
    border-radius: 8px;
    margin-bottom: 12px;
    background: #efefef;
}

.com-banner img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Requests & Members */
.request-box, .member {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
}

.request-box img, .member img {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    object-fit: cover;
    background: #efefef;
    flex-shrink: 0;
}

.request-actions {
    margin-left: auto;
    display: flex;
    gap: 8px;
}

.buttons {
    margin-top: 12px;
    text-align: center;
}

@media (max-width: 768px) {
    .main {
        margin-left: 0;
        padding: 20px;
    }
}
.btn-outline-indigo {
    color: #6610f2;
    border: 1px solid #6610f2;
}

.btn-outline-indigo:hover {
    background-color: #6610f2;
    color: #fff;
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
                    <div class="metric-icon-box"><i class="bi bi-collection"></i></div>
                    <div class="metric-title">Total Communities Created</div>
                </div>
                <div class="metric-count" style="color: #34275f;">Total Community: <?= $community_count ?></div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="metric-card">
                <div class="metric-top">
                    <div class="metric-icon-box"><i class="bi bi-people"></i></div>
                    <div class="metric-title">Total Members</div>
                </div>
                <div class="metric-count" style="color: #34275f;">Total Members: 2</div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="metric-card">
                <div class="metric-top">
                    <div class="metric-icon-box"><i class="bi bi-person-fill-add"></i></div>
                    <div class="metric-title">New Members Joined Last Week</div>
                </div>
                <div class="metric-count" style="color: #34275f;">New Members: 0</div>
            </div>
        </div>
    </div>

    <!-- Communities List -->
    <?php if ($community_count > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($community_result)): ?>
            <div class="community">
                <div class="com-banner"><img src="<?= $row['image'] ?>" alt="Banner"></div>
                <h3 style="font-size:25px; color: #4b378d; font-weight:bold;"><?= htmlspecialchars($row['community_name']) ?></h3>
                <strong style=" color: #4b378d;">Date:</strong> <?= date("d M Y", strtotime($row['created_at'])); ?> | <?= htmlspecialchars($row['district']); ?><br>
                <strong  style=" color: #4b378d;">Time:</strong> <?= date("h:i A", strtotime($row['created_at'])); ?> <br>


                <?php
                $community_id = $row['id'];
                $stmt = $conn->prepare("
                    SELECT cm.id, cm.user_id, cm.joined_at, u.full_name, u.username
                    FROM community_members cm
                    JOIN users u ON u.user_id = cm.user_id
                    WHERE cm.community_id = ? AND cm.status='pending'
                ");
                $stmt->bind_param("i", $community_id);
                $stmt->execute();
                $requests = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                ?>
                <h6  style=" color: #7450ea; margin-top:10px;">New Requests:</h6>
                <?php if(count($requests) > 0): ?>
                    <?php foreach($requests as $req): ?>
                        <div class="request-box">
                            <img src="l.png" alt="Avatar">
                            <div>
                                <p style="font-weight:600;margin:0;"><?= htmlspecialchars($req['full_name']) ?></p>
                                <p class="username" style="margin:0;color:#6b7280;">
                                    @<?= htmlspecialchars($req['username']) ?> • <?= $req['joined_at'] ?>
                                </p>
                            </div>
                            <div class="request-actions">
                                <form method="post">
                                    <input type="hidden" name="request_id" value="<?= $req['id'] ?>">
                                    <input type="hidden" name="approve_request" value="1">
                                    <button class="btn btn-sm btn-outline-success">Accept</button>
                                </form>
                                <form method="post">
                                    <input type="hidden" name="request_id" value="<?= $req['id'] ?>">
                                    <input type="hidden" name="reject_request" value="1">
                                    <button class="btn btn-sm btn-outline-danger">Reject</button>
                                </form>
                                <a href="event_member_profile.php?id=<?= $req['user_id'] ?>" class="btn btn-sm btn-outline-primary"  style="padding-bottom:-40px; font-size: 0.8rem; line-height: 1; border-radius: 5px;">
                                    View Profile
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No pending requests.</p>
                <?php endif; ?>

                <!-- Members -->
                <?php
                $members_sql = "SELECT u.full_name, u.username, cm.joined_at
                                FROM community_members cm
                                JOIN users u ON cm.user_id = u.user_id
                                WHERE cm.community_id = $community_id AND cm.status='approved'";
                $members_res = $conn->query($members_sql);
                ?>
                <h6 style=" color: #7450ea; margin-top:10px;">Members:</h6>
                <?php if($members_res->num_rows > 0): ?>
                    <?php while($member = $members_res->fetch_assoc()): ?>
                        <div class="member">
                            <img src="lo.webp" alt="member">
                            <div>
                                <div><?= htmlspecialchars($member['full_name']) ?> (@<?= htmlspecialchars($member['username']) ?>)</div>
                                <small style="color:#6b7280;">Joined: <?= $member['joined_at'] ?></small>
                            </div>
                             <a href="event_member_profile.php?id=<?= $req['user_id'] ?>" class="btn btn-sm btn-outline-primary"  style="padding-bottom:-40px; font-size: 0.8rem; line-height: 1; border-radius: 5px; margin-left:500px;">
                                    View Profile
                                </a>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No members joined yet.</p>
                <?php endif; ?>

                <div class="buttons">
                    <a href="com-Events.php?id=<?= $row['id'] ?>" class=" btn btn-outline-indigo">View Community</a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="empty-card text-center mb-4">
            <div class="bi bi-emoji-neutral" style="font-size:80px;color:#8540f5;margin-bottom:12px"></div>
            <h4>No Communities Found</h4>
            <p class="text-muted">You have not created any communities yet.</p>
            <a href="createCommunity.php" class="btn btn-outline-indigo filter-pill">Create Community</a>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
