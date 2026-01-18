<?php
include 'userHead.php';
$conn = new mysqli("localhost", "root", "", "community_connect");
// LIST OF COMMUNITIES
$user_id = $_SESSION['user_id'] ?? 0;

// Fetch communities created by logged-in user
$community_query = "SELECT * FROM communities WHERE created_by = $user_id ORDER BY id DESC";
$community_result = mysqli_query($conn, $community_query);
$community_count = mysqli_num_rows($community_result);

// Fetch Members Joined 
$community_members = "SELECT * FROM community_members ";
$result = mysqli_query($conn, $community_members);
$res_count = mysqli_num_rows($result);
?>
<?php
// Reject a pending request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reject_request'])) {

    $request_id = intval($_POST['request_id']);

    $delete = $conn->query("DELETE FROM community_members WHERE id = $request_id");

    if ($delete) {
        echo "<script>
                alert('Request rejected successfully!');
                window.location = window.location.href;
              </script>";
        exit;
    } else {
        echo "Error rejecting request: " . $conn->error;
    }
}

// Approve a pending request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['approve_request'])) {

    $request_id = intval($_POST['request_id']); // FIXED HERE

    $update = $conn->query("UPDATE community_members 
                            SET status='approved' 
                            WHERE id=$request_id");

    if ($update) {
        echo "<script>
                alert('Request approved successfully!');
                window.location = window.location.href;
              </script>";
        exit;
    } else {
        echo "Error approving request: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Created Community - Community Connect</title>

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Outfit:wght@400;600&display=swap"
        rel="stylesheet" />

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="userStyle.css">

    <!-- BOOTSTRAP ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
    /* ---------- Base ---------- */
    body {
        font-family: 'Outfit', sans-serif;
        background: #f8f9fa;
        color: #111827;
        margin: 0;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    /* ---------- Metrics Card ---------- */
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

    /* ---------- Community card ---------- */
    .community {
        border-radius: 12px;
        padding: 20px;
        background-color: #ffffff;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
        margin-bottom: 20px;
    }

    /* Banner container to keep consistent cropping */
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
        display: block;
    }

    h3 {
        font-size: 20px;
        margin: 8px 0 4px;
        color: #111827;
    }

    h4 {
        font-size: 14px;
        margin: 0 0 12px 0;
        color: #6b7280;
        font-weight: 500;
    }

    .request-box {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
        flex-wrap: wrap;
        /* allow wrap on small screens */
    }

    .request-box img {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
        background: #efefef;
        flex-shrink: 0;
    }

    .request-box .meta {
        min-width: 0;
        /* allows text to truncate/wrap nicely */
    }

    .request-box .meta p {
        margin: 0;
    }

    .request-box .meta .username {
        color: #6b7280;
        font-size: 14px;
    }

    /* place action buttons to the right when there is space */
    .request-actions {
        margin-left: auto;
        display: flex;
        gap: 8px;
    }

    /* Member list */
    .member {
        border-bottom: 1px solid #f1f3f5;
        padding-bottom: 12px;
        margin-bottom: 12px;
    }

    .member .user-logo {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
        background: #efefef;
    }

    .username {
        font-weight: 600;
    }

    /* Buttons container */
    .buttons .btn {
        margin-right: 8px;
    }

    /* Make the single centered button more tap-friendly on mobile */
    .buttons {
        margin-top: 12px;
    }

    /* ---------- Responsive tweaks ---------- */
    @media (max-width: 767.98px) {
        .metric-card {
            padding: 14px;
            min-height: 120px;
        }

        .metric-icon-box {
            width: 60px;
            height: 60px;
        }

        .metric-count {
            font-size: 22px;
        }

        .com-banner {
            height: 300px;
        }

        .community {
            padding: 16px;
        }
    }

    /* Very small screens - make action button full width and stack actions */
    @media (max-width: 420px) {
        .metric-icon-box {
            width: 56px;
            height: 56px;
        }

        .metric-count {
            font-size: 20px;
        }

        /* make request actions wrap nicely and be full width */
        .request-actions {
            width: 100%;
            gap: 8px;
            justify-content: flex-end;
        }

        .request-actions .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .request-actions .btn {
            min-width: 70px;
            text-align: center;
        }



        /* center button but make it full width on very small devices */
        .buttons {
            display: flex;
            justify-content: center;
        }

        .buttons .btn {
            width: 100%;
            max-width: 200px;
        }

    }
    </style>
</head>

<body>


    <?php
    $active = 'exploreCommunity';
    include 'userNav.php';
    ?>


    <div class="container py-3">
        <div class="metric row g-4 mb-4">
            <!-- Total communities created by the user -->
            <div class="col-12 col-md-4">
                <div class="metric-card">
                    <div class="metric-top">
                        <div class="metric-icon-box">
                            <i class="bi bi-collection"></i>
                        </div>
                        <div class="metric-title">
                            Total Communities <br>
                            Created
                        </div>
                    </div>

                    <div class="metric-count">
                        Total Communities: <?= $community_count ?>
                    </div>
                </div>
            </div>

            <!-- Total no. of members in community -->
            <div class="col-12 col-md-4">
                <div class="metric-card">
                    <div class="metric-top">
                        <div class="metric-icon-box">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="metric-title">Total Member<br>in the Community</div>
                    </div>

                    <div class="metric-count">
                        Total Members: <?= $res_count ?>
                    </div>
                </div>
            </div>

            <!-- No. of members joined in last week -->
            <div class="col-12 col-md-4">
                <div class="metric-card">
                    <div class="metric-top">
                        <div class="metric-icon-box">
                            <i class="bi bi-person-fill-add"></i>
                        </div>
                        <div class="metric-title">New Members<br>Joined last week</div>
                    </div>

                    <div class="metric-count">
                        New Members Join : <?= $res_count ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- If more than one has been created, loop should be created. -->
        <?php if ($community_count > 0): ?>

        <?php while ($row = mysqli_fetch_assoc($community_result)): ?>

        <div class="col-12 col-md-6 col-lg-12">
            <!-- responsive card width -->

            <div class="community">

                <div class="com-banner" aria-hidden="true">
                    <img src="<?php echo $row['image'] ?>" alt="Community banner">
                </div>

                <h3><?php echo $row['community_name'] ?></h3>
                <h4><?php echo date("d M Y H:i:s", strtotime($row['created_at'])); ?></h4>

                <div>
                    <?php
                            // Fetch pending requests for THIS community
                            $community_id = $row['id'];

                            $stmt = $conn->prepare(
                                "SELECT cm.id, cm.user_id, cm.community_id, cm.joined_at, u.full_name, u.username
                    FROM community_members cm
                    JOIN users u ON u.user_id = cm.user_id
                    WHERE cm.community_id = ? AND cm.status='pending'"
                            );


                            if (!$stmt) {
                                die("Prepare failed: " . $conn->error);
                            }

                            $stmt->bind_param("i", $community_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $requests = $result->fetch_all(MYSQLI_ASSOC);
                            ?>

                    <h5>Manage</h5>
                    <h6>New requests:</h6>

                    <?php if (count($requests) > 0): ?>
                    <?php foreach ($requests as $req): ?>
                    <div class="request-box">
                        <img src="l.png" alt="Requester's avatar">
                        <div class="meta">
                            <p style="font-weight:600;margin:0;"><?= htmlspecialchars($req['full_name']) ?></p>
                            <p class="username" style="margin:0;color:#6b7280;">
                                @<?= htmlspecialchars($req['username']) ?> • <?= htmlspecialchars($req['joined_at']) ?>
                            </p>
                        </div>


                        <div class="request-actions">

                            <!-- VIEW BUTTON -->
                            <a href="com-Events.php?id=<?= $community_id ?>" class="btn btn-sm btn-outline-primary">
                                View
                            </a>

                            <!-- ACCEPT BUTTON -->
                            <form action="myCommunity.php" method="post">
                                <input type="hidden" name="request_id" value="<?= $req['id'] ?>">
                                <input type="hidden" name="approve_request" value="1">
                                <button type="submit" class="btn btn-sm btn-outline-success">Accept</button>
                            </form>

                            <!-- REJECT BUTTON -->
                            <form action="myCommunity.php" method="post">
                                <input type="hidden" name="request_id" value="<?= $req['id'] ?>">
                                <input type="hidden" name="reject_request" value="1">
                                <button type="submit" class="btn btn-sm btn-outline-danger">Reject</button>
                            </form>

                        </div>


                    </div>
                    <?php endforeach; ?>

                    <?php else: ?>
                    <p>No pending requests.</p>
                    <?php endif; ?>

                    <?php
                            // Assuming $community_id is correctly set inside communities loop
                            $sql_members = "
SELECT u.full_name, u.username, cm.joined_at
FROM community_members cm
JOIN users u ON cm.user_id = u.user_id
WHERE cm.community_id = $community_id
AND cm.status = 'approved'   -- Use exact enum value here
";

                            $result_members = $conn->query($sql_members);
                            if (!$result_members) {
                                die("SQL Error: " . $conn->error);
                            }
                            ?>

                    <h5>Members:</h5>
                    <?php if ($result_members->num_rows > 0): ?>
                    <?php while ($member = $result_members->fetch_assoc()): ?>
                    <div class="member">
                        <div class="d-flex align-items-center">
                            <img class="user-logo" src="lo.webp" alt="member avatar">
                            <div class="ms-3">
                                <div class="username"><?= htmlspecialchars($member['full_name']) ?>
                                    (@<?= htmlspecialchars($member['username']) ?>)</div>
                                <div style="color:#6b7280;font-size:13px;margin-top:4px; font-weight:600;">
                                    Joined at · <?= $member['joined_at'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php else: ?>
                    <p>No members joined yet.</p>
                    <?php endif; ?>


                </div> <!-- end requests & members section -->

                <div class="buttons mt-3 text-center">
                    <a href="com-Events.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-indigo">
                        View Community
                    </a>
                </div>

            </div> <!-- end community card -->

        </div> <!-- end col -->

        <?php endwhile; ?>

        <?php else: ?>

        <p>No communities created yet.</p>
        <div class="empty-card text-center mb-4">
            <div class="bi bi-emoji-neutral" style="font-size:80px;color:#8540f5;margin-bottom:12px"></div>
            <h4>No Communities found</h4>
            <p class="text-muted">You have not created any communities yet.</p>
            <div class="d-flex justify-content-center mt-4">
                <a href="createCommunity.php" class="btn btn-outline-indigo filter-pill">Create Community</a>
            </div>
        </div>

        <?php endif; ?>

        <div class="feedback-card text-center p-4 mt-5 mb-4 bg-white rounded-3 shadow-sm">
            <h5>Have Suggestions or any complaints?</h5>
            <p>
                Give us your feedback.
            </p>
            <button class="btn btn-outline-indigo btn-sm" data-bs-toggle="modal" data-bs-target="#feedbackModal">
                Feedback
            </button>
        </div>

        <div class="modal fade" id="feedbackModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- MODAL HEADER -->
                    <div class="modal-header">
                        <h5 class="modal-title">Community Feedback</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- FORM START -->
                    <form method="post" action="#">

                        <div class="modal-body">

                            <!-- COMMUNITY NAME -->
                            <div class="mb-3">
                                <label class="form-label">Community Name</label>
                                <input type="text" class="form-control" name="community_name"
                                    placeholder="Enter community name" required>
                            </div>

                            <!-- RADIO BUTTONS -->
                            <div class="mb-3">
                                <label class="form-label d-block">Feedback Type</label>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="feedback_type" value="suggestion"
                                        required>
                                    <label class="form-check-label">Suggestion</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="feedback_type" value="report">
                                    <label class="form-check-label">Report</label>
                                </div>
                            </div>

                            <!-- FEEDBACK TEXT -->
                            <div class="mb-3">
                                <label class="form-label">Your Feedback</label>
                                <textarea class="form-control" name="feedback" rows="4"
                                    placeholder="Write your feedback here..." required></textarea>
                            </div>

                        </div>

                        <!-- MODAL FOOTER -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>
                    <!-- FORM END -->

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>