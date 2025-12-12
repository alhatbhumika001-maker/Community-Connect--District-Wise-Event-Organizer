<?php
include 'userHead.php';
$conn = mysqli_connect("localhost", "root", "", "community_connect");

// LIST OF EVENTS: Show only events created by logged-in user
$user_id = $_SESSION['user_id'] ?? 0;

// Fetch events
$event_query = "SELECT * FROM community_events WHERE created_by = $user_id ORDER BY id DESC";
$event_result = mysqli_query($conn, $event_query);
$event_count = mysqli_num_rows($event_result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Created Event - Community Connect</title>

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Outfit:wght@400;600&display=swap"
        rel="stylesheet">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <link rel="stylesheet" href="userStyle.css" />

    <style>
    body {
        font-family: 'Outfit', sans-serif;
        background-color: #f8f9fa;
    }

    /* Card layout */
    .event-card {
        border-radius: 10px;
        padding: 0;
        background: #fff;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(0, 0, 0, 0.03);
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .event-card .card-body {
        padding: 16px;
    }

    .photo-box {
        width: 100%;
        height: 220px;
        overflow: hidden;
        background: #f2f2f2;
    }

    .photo-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .date-box {
        font-size: 14px;
        color: #3c3838ff;
        font-weight: 600;
    }

    .event-title {
        font-weight: 700;
        font-size: 18px;
        margin-bottom: 6px;
    }

    .muted-custom {
        font-size: 15px;
        color: #431e43ff;
        font-weight: 500;
    }

    .time-line {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 8px;
    }

    .card-flex {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .card-footer {
        background: transparent;
        border-top: 1px solid rgba(0, 0, 0, 0.03);
        padding: 12px 16px;
    }

    /* Requests */
    .request-box {
        background: #ffffff;
        border-radius: 8px;
        padding: 10px;
        border: 1px solid rgba(0, 0, 0, 0.04);
        display: flex;
        gap: 12px;
        align-items: center;
        margin-bottom: 10px;
    }

    .request-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
        background: #efefef;
        flex-shrink: 0;
    }

    .member-item {
        display: flex;
        gap: 12px;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px dashed rgba(0, 0, 0, 0.03);
    }

    .btn-outline-indigo {
        color: #6c4ce0;
        border-color: rgba(108, 76, 224, 0.18);
        background: transparent;
    }

    .btn-outline-indigo:hover {
        background: rgba(108, 76, 224, 0.06);
        color: #4b2fc9;
    }

    @media (max-width: 576px) {
        .photo-box {
            height: 180px;
        }
    }
    </style>
</head>

<body>

    <?php
    $active = 'myEvent';
    include 'userNav.php'; ?>

    <div class="container-fluid mt-5 d-flex flex-column align-items-center">

        <div class="container mt-4 mb-2">
            <h2 class="fw-bold mb-3">My Created Events Dashboard</h2>
        </div>

        <!-- EVENT CARDS -->
        <div class="container">
            <div class="row g-4">

                <?php
                if ($event_count > 0) {
                    while ($row = mysqli_fetch_assoc($event_result)) {
                        // safe cast
                        $event_id = (int)$row['id'];

                        // fetch pending requests for this event (join with users to get names)
                       $req_query = "
    SELECT r.r_id AS req_id, r.user_id, r.full_name AS name, r.username, r.avatar
    FROM event_requests r
    WHERE r.event_id = $event_id
    ORDER BY r.r_id DESC
";

                        $req_result = mysqli_query($conn, $req_query);
                        $req_count = mysqli_num_rows($req_result);

                        // fetch registered members for this event
                        $mem_query = "
    SELECT 
        er.reg_id, 
        er.user_id, 
        u.full_name, 
        u.username
    FROM registrations er
    LEFT JOIN users u ON er.user_id = u.user_id
    WHERE er.event_id = $event_id
    ORDER BY er.reg_id DESC
";

                        $mem_result = mysqli_query($conn, $mem_query);
                        $mem_count = mysqli_num_rows($mem_result);
                ?>

                <!-- Card column -->
                <div class="col-12 col-md-6 col-lg-6 d-flex">
                    <div class="event-card card-flex w-100">

                        <!-- image -->
                        <div class="photo-box">
                            <?php if (!empty($row['image'])): ?>
                            <img src="<?= htmlspecialchars($row['image']); ?>" alt="Event Image">
                            <?php else: ?>
                            <!-- placeholder when no image -->
                            <div class="d-flex align-items-center justify-content-center h-100">
                                <i class="bi bi-image" style="font-size:48px;color:#d1d5db"></i>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <div class="event-title">
                                        <?= htmlspecialchars($row['event_name']); ?>
                                    </div>
                                    <div class="time-line">
                                        <span class="date-box">Date:</span>
                                        <?php echo date("d M Y", strtotime($row['date'])); ?> &nbsp; | &nbsp;
                                        <span class="date-box">District:</span>
                                        <?php echo htmlspecialchars($row['district']); ?>
                                    </div>
                                </div>
                                <!-- quick actions -->
                                <div class="text-end">
                                    <a href="viewEvent.php?id=<?= $row['id'] ?>"
                                        class="btn btn-sm btn-outline-secondary mb-1">View</a><br>
                                </div>
                            </div>

                            <div class="mb-2">
                                <strong>Time:</strong>
                                <?php echo date("h:i A", strtotime($row['start_time'])); ?> to
                                <?php echo date("h:i A", strtotime($row['end_time'])); ?>
                            </div>

                            <div class="muted-custom mb-3">
                                <?= nl2br(htmlspecialchars($row['about'])); ?>
                            </div>

                            <!-- Requests (visible only for private events) -->
                            <?php if (($row['privacy'] ?? 'public') === 'private'): ?>
                            <div class="mb-3">
                                <h6 class="mb-2">Requests to Join (
                                    <?= $req_count ?>)
                                </h6>

                                <?php if ($req_count > 0): ?>
                                <?php while ($r = mysqli_fetch_assoc($req_result)): ?>
                                <div class="request-box">
                                    <img src="<?= htmlspecialchars($r['avatar'] ?? 'default-avatar.png'); ?>"
                                        alt="avatar" class="request-avatar">
                                    <div class="flex-grow-1">
                                        <div style="font-weight:600">
                                            <?= htmlspecialchars($r['name'] ?? 'User'); ?>
                                        </div>
                                        <div class="text-muted" style="font-size:13px">
                                            <?= htmlspecialchars($r['username'] ?? '@user'); ?>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <!-- Accept form -->
                                        <form action="acceptRequest.php" method="post" style="display:inline-block">
                                            <input type="hidden" name="request_id" value="<?= (int)$r['req_id'] ?>">
                                            <input type="hidden" name="event_id" value="<?= $event_id ?>">
                                            <button class="btn btn-sm btn-outline-indigo" type="submit">Accept</button>
                                        </form>

                                        <!-- Reject form -->
                                        <form action="rejectRequest.php" method="post" style="display:inline-block">
                                            <input type="hidden" name="request_id" value="<?= (int)$r['req_id'] ?>">
                                            <input type="hidden" name="event_id" value="<?= $event_id ?>">
                                            <button class="btn btn-sm btn-outline-secondary"
                                                type="submit">Reject</button>
                                        </form>
                                    </div>
                                </div>
                                <?php endwhile; ?>
                                <?php else: ?>
                                <div class="text-muted">No requests yet.</div>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>

                            <!-- Registered members -->
                            <div class="mb-1">
                                <h6 class="mb-2">Registered Members (
                                    <?= $mem_count ?>)
                                </h6>

                                <?php if ($mem_count > 0): ?>
                                <?php while ($m = mysqli_fetch_assoc($mem_result)): ?>
                                <div class="member-item">
                                    <img src="<?= htmlspecialchars($m['avatar'] ?? 'default-avatar.png'); ?>" width="40"
                                        height="40" style="border-radius:50%;object-fit:cover" alt="member">
                                    <div>
                                        <div style="font-weight:600">
                                            <?= htmlspecialchars($m['name'] ?? 'Member'); ?>
                                        </div>
                                        <div class="text-muted" style="font-size:13px">
                                            <?= htmlspecialchars($m['username'] ?? '@user'); ?>
                                        </div>
                                    </div>
                                    <div class="ms-auto">
                                        <!-- remove member or message -->
                                        <form action="removeMember.php" method="post" style="display:inline-block">
                                            <input type="hidden" name="reg_id" value="<?= (int)$m['reg_id'] ?>">
                                            <input type="hidden" name="event_id" value="<?= $event_id ?>">
                                            <button class="btn btn-sm btn-outline-secondary"
                                                type="submit">Remove</button>
                                        </form>
                                    </div>
                                </div>
                                <?php endwhile; ?>
                                <?php else: ?>
                                <div class="text-muted">No members registered yet.</div>
                                <?php endif; ?>
                            </div>

                        </div>

                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <small class="text-muted">Created on
                                <?= date("d M Y", strtotime($row['created_at'] ?? $row['date'])); ?>
                            </small>
                            <div>
                                <a href="registrations.php?event=<?= $row['id'] ?>"
                                    class="btn btn-sm btn-outline-secondary">Registrations</a>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- END card column -->

                <?php
                    } // end while
                } else {
                    ?>

                <!-- EMPTY STATE -->
                <div class="text-center my-5 w-100">
                    <i class="bi bi-emoji-neutral" style="font-size:70px; color:#8540f5;"></i>
                    <h4>No events found</h4>
                    <p class="muted-custom">You have not created any events yet.</p>
                    <a href="createEvent.php" class="btn btn-outline-dark">Create Event</a>
                </div>

                <?php } ?>

                <!-- Buttons Row -->
            <div class="d-flex gap-2 mt-3">

                <!-- View Button -->
                <a href="view_event.php" class="btn btn-primary btn-sm">
                    👁 View
                </a>

                <!-- Member Requests -->
                <a href="member_requests.php" class="btn btn-warning btn-sm">
                    📨 Requests
                </a>

                <!-- Joined Members -->
                <a href="joined_members.php" class="btn btn-success btn-sm">
                    ✔ Joined
                </a>

            </div>
<<<<<<< HEAD

                

            </div>
            

        </div>
        <!-- END card column -->

        <?php
            }
        } else {
        ?>

        <!-- EMPTY STATE -->
        <div class="text-center my-5">
            <i class="bi bi-emoji-neutral" style="font-size:70px; color:#8540f5;"></i>
            <h4>No events found</h4>
            <p class="text-muted">You have not created any events yet.</p>
            <a href="createEvent.php" class="btn btn-outline-dark">Create Event</a>
=======
>>>>>>> 1bd40165bc9a0efac7cdd00ccd2beea2efa72653
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
