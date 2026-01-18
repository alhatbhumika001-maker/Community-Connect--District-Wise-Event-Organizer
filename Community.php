<?php
$conn = new mysqli("localhost", "root", "", "community_connect");

// LIST OF COMMUNITIES
$user_id = $_SESSION['user_id'] ?? 0;

// Fetch communities
$community_query = "SELECT * FROM communities ORDER BY id DESC";
$community_result = mysqli_query($conn, $community_query);
$community_count = mysqli_num_rows($community_result);

// Fetch membership status for logged-in user
$membership_query = mysqli_query($conn, "SELECT community_id, status FROM community_members WHERE user_id = $user_id");
$membership_status = [];
while ($m = mysqli_fetch_assoc($membership_query)) {
    $membership_status[$m['community_id']] = $m['status']; // pending / approved
}

// JOIN COMMUNITY LOGIC
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['join_request'])) {
    $community_id = intval($_POST['id']);
    $user_id = $_SESSION['user_id'] ?? 0;

    $check = mysqli_query($conn, "SELECT * FROM community_members WHERE community_id=$community_id AND user_id=$user_id");

    if ($check && mysqli_num_rows($check) > 0) {
        echo "<script>alert('You are already a member of this community!');</script>";
    } else {
        $insert = mysqli_query($conn, "INSERT INTO community_members (community_id, user_id, status) VALUES ($community_id, $user_id, 'pending')");
        if ($insert) {
            echo "<script>alert('Joined community successfully!');window.location = window.location.href;</script>";
            exit;
        } else {
            echo "Join Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Explore Communities - Community Connect</title>

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Outfit:wght@400;600&display=swap"
        rel="stylesheet">

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- BOOTSTRAP ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="style.css">

    <style>
    body {
        background: #f7f9fb;
        font-family: "Outfit", sans-serif;
        color: #111827;
        padding-top: 80px;
        /* space for fixed navbar */
    }

    /* Community card */
    .community-card {
        display: flex;
        gap: 0;
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        max-width: 1100px;
        width: 100%;
        box-shadow: 2px 4px 12px rgba(0, 0, 0, 0.2);
        margin-top: 35px;
    }

    .community-img {
        width: 33%;
        min-width: 220px;
        background: rgba(0, 0, 0, 0.06);
    }

    .community-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .community-info {
        padding: 20px;
        width: 67%;
        box-sizing: border-box;
    }

    /* Small screens: community card */
    @media (max-width: 767.98px) {
        .community-card {
            flex-direction: column;
        }

        .community-img {
            width: 100%;
            min-width: 0;
            height: 180px;
            border-radius: 20px 20px 0 0;
        }

        .community-info {
            width: 100%;
            padding: 14px;
        }
    }

    .page-title {
        font-size: 2.0rem;
        margin: 0 0 .25rem;
        font-weight: 600;
    }

    .page-sub {
        color: #6c757d;
        margin-bottom: .5rem;
    }

    .bi-emoji-frown {
        font-size: 48px;
        color: #8540f5;
        margin-bottom: 12px;
    }

    .form-control:focus,
    .form-select:focus,
    .btn:focus {
        outline: 3px solid rgba(133, 64, 245, 0.12);
        outline-offset: 2px;
        box-shadow: none;
    }
    </style>
</head>

<body>

    <?php include 'mainNav.php'; ?>

    <div class="container my-4">

        <?php if ($community_count > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($community_result)): ?>
        <?php $cid = $row['id']; ?>
        <div class="community-card">

            <div class="community-img">
                <img src="<?= htmlspecialchars($row['image']) ?>" alt="Community Image">
            </div>

            <div class="community-info">
                <div>
                    <h3><?= htmlspecialchars($row['community_name']) ?></h3>
                    <div class="text-muted mb-1">Category: <?= htmlspecialchars($row['category']) ?></div>
                    <div class="text-muted mb-1">Privacy: <?= htmlspecialchars($row['privacy']) ?></div>

                    <div class="d-flex gap-2 small text-muted mb-1">
                        <div>Members: <?= htmlspecialchars($row['member_count'] ?? 0) ?></div>
                        <div>|</div>
                        <div><?= htmlspecialchars($row['district']) ?></div>
                    </div>

                    <div class="d-flex gap-2 small text-muted mb-1">
                        Date & Time: <?= htmlspecialchars($row['created_at']) ?>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-3">
                    <a href="com-Events.php?id=<?= $cid ?>" class="btn btn-outline-indigo btn-sm">View</a>

                    <?php if (isset($membership_status[$cid])): ?>
                    <?php if ($membership_status[$cid] === 'pending'): ?>
                    <span class="badge bg-warning text-dark px-3 py-2">Request Pending</span>
                    <?php elseif ($membership_status[$cid] === 'approved'): ?>
                    <span class="badge bg-success px-3 py-2">Joined</span>
                    <?php endif; ?>
                    <?php else: ?>
                    <button class="btn btn-outline-indigo btn-sm" data-bs-toggle="modal"
                        data-bs-target="#joinModal<?= $cid ?>">Join</button>

                    <!-- Join Modal -->
                    <div class="modal fade" id="joinModal<?= $cid ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form action="" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Join Community</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Do you want to join this community?</p>
                                        <input type="hidden" name="id" value="<?= $cid ?>">
                                        <input type="hidden" name="join_request" value="1">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">No</button>
                                        <button type="submit" class="btn btn-success">Yes, Join</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endwhile; ?>

        <?php else: ?>
        <div class="empty-card">
            <div class="bi bi-emoji-neutral" style="font-size:80px;color:#8540f5;margin-bottom:12px"></div>
            <h4>No Communities Found</h4>
            <p class="text-muted">You have not created any communities yet.</p>
            <a href="createCommunity.php" class="btn btn-outline-indigo mt-3">Create Community</a>
        </div>
        <?php endif; ?>

    </div>

    <?php include 'sidebar.php'; ?>
    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>