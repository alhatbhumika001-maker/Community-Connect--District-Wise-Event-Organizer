<?php
include 'userHead.php';
$conn = mysqli_connect("localhost", "root", "", "community_connect");

if (!$conn) {
    die("DB Connection Failed: " . mysqli_connect_error());
}

$user_id = $_SESSION['user_id'] ?? 0;

if ($user_id == 0) {
    die("Error: User not logged in.");
}

// Main events query
$event_query = "SELECT * FROM community_events WHERE created_by = $user_id ORDER BY id DESC";
$event_result = mysqli_query($conn, $event_query);

if (!$event_result) {
    die("Event Query Failed: " . mysqli_error($conn));
}

$event_count = mysqli_num_rows($event_result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Created Events - Community Connect</title>
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Outfit:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="userStyle.css" />
</head>

<body>
<?php
$active = 'myEvent';
include 'userNav.php';
?>

<div class="container mt-5">
    <h2 class="fw-bold mb-4">My Created Events Dashboard</h2>

    <?php if ($event_count > 0): ?>
        <div class="row g-4">
        <?php while ($row = mysqli_fetch_assoc($event_result)):
            $event_id = (int)$row['id'];

            // Requests query
            $req_result = mysqli_query($conn, "SELECT r.r_id AS req_id, r.user_id, r.full_name AS name, r.username, r.avatar FROM event_requests r WHERE r.event_id = $event_id ORDER BY r.r_id DESC");
            $req_count = $req_result ? mysqli_num_rows($req_result) : 0;

            // Registered members query
            $mem_result = mysqli_query($conn, "SELECT er.reg_id, er.user_id, u.full_name AS name, u.username, u.avatar FROM registrations er LEFT JOIN users u ON er.user_id = u.user_id WHERE er.event_id = $event_id ORDER BY er.reg_id DESC");
            $mem_count = $mem_result ? mysqli_num_rows($mem_result) : 0;
            ?>

            <div class="col-12 col-md-12">
                <div class="card h-100 shadow-sm">
                    <div class="photo-box">
                        <?php if (!empty($row['image'])): ?>
                            <img src="<?= htmlspecialchars($row['image']); ?>" alt="Event Image" class="img-fluid w-100" style="height:300px; object-fit:cover;">
                        <?php else: ?>
                            <div class="d-flex align-items-center justify-content-center h-100" style="height:220px; background:#f2f2f2;">
                                <i class="bi bi-image" style="font-size:48px;color:#d1d5db"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['event_name']); ?></h5>
                        <p class="card-text">
                            <strong>Date:</strong> <?= date("d M Y", strtotime($row['date'])); ?><br>
                            <strong>Time:</strong> <?= date("h:i A", strtotime($row['start_time'])); ?> to <?= date("h:i A", strtotime($row['end_time'])); ?><br>
                            <strong>District:</strong> <?= htmlspecialchars($row['district']); ?>
                        </p>
                        <p class="card-text"><?= nl2br(htmlspecialchars($row['about'])); ?></p>

                        <?php if (($row['privacy'] ?? 'public') === 'private'): ?>
                            <h6>Join Requests (<?= $req_count ?>)</h6>
                            <?php if ($req_count > 0): ?>
                                <?php while ($r = mysqli_fetch_assoc($req_result)): ?>
                                    <div class="d-flex align-items-center mb-2">
                                        <img src="<?= htmlspecialchars($r['avatar'] ?? 'default-avatar.png'); ?>" alt="Avatar" width="40" height="40" class="rounded-circle me-2">
                                        <div>
                                            <?= htmlspecialchars($r['name'] ?? 'User'); ?><br>
                                            <small class="text-muted"><?= htmlspecialchars($r['username'] ?? '@user'); ?></small>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <small class="text-muted">No requests yet.</small>
                            <?php endif; ?>
                        <?php endif; ?>

                        <h6 class="mt-3">Registered Members (<?= $mem_count ?>)</h6>
                        <?php if ($mem_count > 0): ?>
                            <?php while ($m = mysqli_fetch_assoc($mem_result)): ?>
                                <div class="d-flex align-items-center mb-2">
                                    <img src="<?= htmlspecialchars($m['avatar'] ?? 'default-avatar.png'); ?>" width="40" height="40" class="rounded-circle me-2">
                                    <div>
                                        <?= htmlspecialchars($m['name'] ?? 'Member'); ?><br>
                                        <small class="text-muted"><?= htmlspecialchars($m['username'] ?? '@user'); ?></small>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <small class="text-muted">No members registered yet.</small>
                        <?php endif; ?>
                    </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <small class="text-muted">Created on <?= date("d M Y", strtotime($row['created_at'] ?? $row['date'])); ?></small>
                    <div class="d-flex gap-2">
                        <a href="viewEvent.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-secondary">View</a>
                        <a href="registerEvent.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-indigo">Register</a>
                    </div>
                </div>

                </div>
            </div>
        <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="text-center my-5">
            <i class="bi bi-emoji-neutral" style="font-size:70px; color:#8540f5;"></i>
            <h4>No events found</h4>
            <p class="text-muted">You have not created any events yet.</p>
            <a href="createEvent.php" class="btn btn-outline-dark">Create Event</a>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
