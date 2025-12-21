<?php
// Connect to database
$conn = mysqli_connect("localhost", "root", "", "community_connect");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch only cancelled events
$query = "SELECT 
    ec.id, 
    e.event_name, 
    c.community_name, 
    ec.reason_title, 
    ec.reason_detail, 
    ec.cancelled_at
FROM event_cancellations ec
JOIN community_events e ON ec.event_id = e.id
JOIN communities c ON e.Community = c.id
ORDER BY ec.cancelled_at DESC;
";
$result = mysqli_query($conn, $query);

// Check if query succeeded
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events - Community Connect</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="adminStyle.css">

    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <?php
$active = 'events';
$topbar = 'events';
$sub = 'events_list';
include 'adminNav.php';

?>

<div class="content">
    <h2 class="text-muted">Activity History</h2>
    <div class="container">
        <table class="table table-sm align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Date</th>
                    <th>Event</th>
                    <th>Community</th>
                    <th>Action</th>
                    <th>Reason</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td class="small text-muted"><?= date("d M Y", strtotime($row['cancelled_at'])) ?></td>
                                <td><strong><?= htmlspecialchars($row['event_name']) ?></strong></td>
                                <td class="text-muted"><?= htmlspecialchars($row['community_name']) ?></td>
                                <td><span class="badge bg-danger">Cancelled</span></td>
                                <td class="text-muted">
                                    <?= htmlspecialchars(substr($row['reason_detail'], 0, 50)) ?>...
                                    <button class="btn btn-link btn-sm p-0 ms-1" data-bs-toggle="modal"
                                        data-bs-target="#reasonModal<?= $row['id'] ?>">
                                        View
                                    </button>

                                    <!-- Modal for each reason -->
                                    <div class="modal fade" id="reasonModal<?= $row['id'] ?>" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"><?= htmlspecialchars($row['event_name']) ?> - Reason</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                   <p class="text-muted mb-0"> Title: <?= htmlspecialchars($row['reason_title']) ?></p>

                                                    <p class="text-muted mb-0"><?= htmlspecialchars($row['reason_detail']) ?></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">No cancelled events found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
