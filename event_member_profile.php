<?php
include 'userHead.php';
$conn = mysqli_connect("localhost", "root", "", "community_connect");

if (!$conn) {
    die("DB Connection Failed: " . mysqli_connect_error());
}

// Get the member ID from URL
$member_id = $_GET['id'] ?? 0;

if ($member_id == 0) {
    die("Error: No member specified.");
}

// Fetch member data
$member_query = "
    SELECT 
        u.user_id,
        u.username,
        u.created_at,
        r.name,
        r.district,
        r.email,
        r.phone
    FROM users u
    LEFT JOIN registrations r ON u.user_id = r.user_id
    WHERE u.user_id = ?
    LIMIT 1
";

$stmt = mysqli_prepare($conn, $member_query);
if (!$stmt) {
    die("Prepare failed: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $member_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Member not found.");
}


$member = mysqli_fetch_assoc($result);

// Fetch events this member participated in
$events_query = "SELECT e.event_name, r.status 
                 FROM registrations r 
                 JOIN community_events e ON r.event_id = e.id 
                 WHERE r.user_id = ?";
$stmt2 = mysqli_prepare($conn, $events_query);
mysqli_stmt_bind_param($stmt2, "i", $member_id);
mysqli_stmt_execute($stmt2);
$events_result = mysqli_stmt_get_result($stmt2);

$member['events'] = [];
while ($row = mysqli_fetch_assoc($events_result)) {
    $member['events'][] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Profile - Community Connect</title>
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Outfit:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="userStyle.css" />
</head>
<style>
/* Keep all your existing CSS exactly the same */
.profile-card { max-width: 1200px; margin: auto; margin-top:27px; border-radius: 15px; overflow: hidden; box-shadow: 0 8px 20px rgba(0,0,0,0.15); transition: transform 0.3s, box-shadow 0.3s; background: #fff; }
.profile-card:hover { transform: translateY(-5px); box-shadow: 0 12px 25px rgba(0,0,0,0.2); }
.profile-header { background: linear-gradient(135deg, #f59fdaff, #de9af5ff, #c18feaff,  #c88ef7ff,  #f59fdaff); color: #fff; padding: 30px; text-align: center; }
.profile-header img { border: 4px solid #fff; width: 120px; height: 120px; object-fit: cover; }
.profile-header h4 { margin-top: 0px; font-weight: 600; font-size:35px}
.profile-header small { color: #f9f9f9ff;  font-size:20px; font-weight:500;}
.profile-section { padding: 20px 30px; }
.profile-section h5 { font-weight: 600; border-bottom: 1px solid #e0e0e0; padding-bottom: 5px; margin-bottom: 15px; }
.list-group-item .badge { font-size: 0.9rem; }
.profile-actions a { transition: 0.3s; }
.profile-actions a:hover { transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.15); }

</style>
<body>
<?php include 'userNav.php'; ?>
<div class="profile-card">
    <!-- Profile Header -->
    <div class="profile-header">
        <img src="<?= htmlspecialchars($member['avatar'] ?? 'lo.webp'); ?>" alt="Profile Picture" class="rounded-circle mb-2">
        <h4><?php echo htmlspecialchars($member['name']); ?></h4>
        <small><?= htmlspecialchars($member['username'] ?? '@user'); ?> | <?= htmlspecialchars($member['district']); ?></small>
    </div>

    <!-- Personal Info -->
    <div class="profile-section">
        <h5>Personal Information</h5>
        <ul class="list-unstyled mb-3">
            <li><strong>Email:</strong> <?= htmlspecialchars($member['email'] ?? 'Not provided'); ?></li>
            <li><strong>Phone:</strong> <?= htmlspecialchars($member['phone'] ?? 'Not provided'); ?></li>
            <li><strong>Registered on:</strong> <?php echo date("d M Y", strtotime($member['created_at'])); ?> | <?php echo date("h:i A", strtotime($member['created_at'])); ?></li>
        </ul>

        <!-- About / Bio -->
        <h5>About</h5>
        <p><?= htmlspecialchars($member['bio'] ?? 'This member has not provided any information.'); ?></p>

        <!-- Event Participation -->
        <h5>Events Participated</h5>
        <?php if (!empty($member['events'])): ?>
            <ul class="list-group mb-3">
                <?php foreach ($member['events'] as $event): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= htmlspecialchars($event['event_name']); ?>
                        <span class="badge bg-success rounded-pill"><?= htmlspecialchars($event['status']); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="text-muted">This member has not participated in any events yet.</p>
        <?php endif; ?>

        <!-- Action Buttons -->
        <div class="profile-actions d-flex gap-2">
            <a href="message.php?id=<?= $member['user_id']; ?>" class="btn btn-primary btn-sm">Send Message</a>
            <a href="follow.php?id=<?= $member['user_id']; ?>" class="btn btn-outline-secondary btn-sm">Follow</a>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
