    
    <?php
 include 'userHead.php';
$conn = mysqli_connect("localhost", "root", "", "community_connect");

// Get community ID
$id = $_GET['id'] ?? $_POST['id'] ?? 0;
$id = intval($id);

if ($id <= 0) {
    die("Invalid community!");
}

// Fetch community info
$com_query = "SELECT * FROM communities WHERE id = $id";
$com_res = mysqli_query($conn, $com_query);

if (!$com_res) {
    die("SQL Error: " . mysqli_error($conn));
}

$community = mysqli_fetch_assoc($com_res);

if (!$community) {
    die("Community not found!");
}

// Logged-in user's ID
$user_id = $_SESSION['user_id'] ?? 0;

/* --------------------- INSERT NOTICE --------------------- */

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'])) {

    $title = mysqli_real_escape_string($conn, trim($_POST['title']));
    $content = mysqli_real_escape_string($conn, trim($_POST['not-content']));

    if (empty($title)) {
        echo "<script>alert('Notice Title cannot be empty!');</script>";
    } else {

        $insert_query = "
            INSERT INTO notices (community_id, user_id, title, content)
            VALUES ('$id', '$user_id', '$title', '$content')
        ";

        if (mysqli_query($conn, $insert_query)) {
            echo "<script>
                    alert('Notice created successfully!');
                    window.location='com-Notice.php?id=$id';
                  </script>";
            exit;
        } else {
            echo "Insert Error: " . mysqli_error($conn);
        }
    }
}

/* --------------------- FETCH ALL NOTICES --------------------- */

$notice_query = "
    SELECT notices.*, users.username 
    FROM notices
    LEFT JOIN users ON notices.user_id = users.user_id
    WHERE notices.community_id = $id
    ORDER BY notices.id DESC
";

$notice_res = mysqli_query($conn, $notice_query);

if (!$notice_res) {
    die("Notice SQL Error: " . mysqli_error($conn));
}



    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{Community-Name}} - Community Connect</title>

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Outfit:wght@400;600&display=swap"
        rel="stylesheet">

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="userStyle.css">
    <link rel="stylesheet" href="comStyle.css">

    <!-- BOOTSTRAP ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
    body {
        font-family: 'Outfit', sans-serif;
        background: #f8f9fa;
        color: #111827;
        margin: 0;
    }

    /* Create button */
    .create-notice-wrap {
        text-align: center;
        margin-top: 12px;
        margin-bottom: 12px;
    }

    .create-notice-btn {
        background: #8540f5;
        color: #fff;
        padding: .40rem .9rem;
        font-weight: 600;
        border: none;
        border-radius: 8px;
        font-size: .92rem;
        transition: .15s;
    }

    .create-notice-btn:hover {
        opacity: .92;
    }

    /* Page container */
    .page-inner {
        max-width: 1150px;
        margin: 0 auto;
        padding-left: .75rem;
        padding-right: .75rem;
    }

    /* NOTICE CARD */
    .notice {
        background: #fff;
        border-radius: 10px;
        padding: 1rem;
        box-shadow: 0 6px 18px rgba(31, 41, 55, 0.06);
        border: none;
        margin-bottom: 1rem;
    }

    .noticeHead h5 {
        margin: 0;
        font-weight: 600;
        color: #8540f5;
    }

    .noticeHead h6 {
        margin-top: 4px;
        color: #6b7280;
        font-weight: 500;
        font-size: .95rem;
    }

    .not-content {
        margin-top: .75rem;
        color: #1f2937;
        line-height: 1.5;
    }

    /* EMPTY STATE */
    .empty-card {
        background: #fff;
        border-radius: 10px;
        padding: 1.8rem 1rem;
        box-shadow: 0 6px 18px rgba(31, 41, 55, 0.06);
        margin-top: 1rem;
        text-align: center;
    }

    .empty-card .bi {
        font-size: 60px;
        color: #8540f5;
    }

    /* RIGHT COLUMN MEMBER CARD */
    .col-lg-4 .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 6px 18px rgba(31, 41, 55, 0.06);
    }

    .col-lg-4 .card-body {
        padding: 1rem 1.2rem;
    }

    .user-logo {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: #efefef;
        object-fit: cover;
    }

    /* STICKY RIGHT COLUMN (CSS ONLY) */
    @media (min-width: 992px) {
        .col-lg-4>.card {
            position: sticky;
            top: 20px;
            z-index: 20;
        }
    }

    /* MOBILE ADJUSTMENTS */
    @media (max-width: 768px) {
        .col-lg-4 {
            margin-top: 1.2rem;
        }

        .notice {
            padding: .85rem;
        }
    }
    </style>
</head>

<body>

  
    <div class="container-fluid">
        <?php
        $active = 'com-Notice';
        include 'comHead.php';
        ?>

        <!-- Create button -->
        <?php if ($community['created_by'] == $user_id): ?>
            <div class="create-notice-wrap">
                <button class="create-notice-btn" data-bs-toggle="modal" data-bs-target="#createNoticeModal">
                    + Create Notice
                </button>
            </div>
        <?php endif; ?>



        <!-- Main layout -->
        <div class="container page-inner mt-3">
            <div class="row gx-4">

                <!-- LEFT COLUMN -->
                <div class="col-lg-8 col-12">

                    <?php if (mysqli_num_rows($notice_res) > 0): ?>

    <?php while ($row = mysqli_fetch_assoc($notice_res)): ?>
        <div class="notice">
            <div class="noticeHead">

                <h5 class="not-head"><?php echo $row['title']?></h5>

                <h6 class="not-time">
                    Posted by <? echo $row['username'] ?? 'Unknown' ?> |
                    <?= date("d M, Y h:i A", strtotime($row['created_at'])) ?>
                </h6>
            </div>

            <hr>

            <div class="not-content">
                <p><?= nl2br(htmlspecialchars($row['content'])) ?></p>
            </div>
        </div>
    <?php endwhile; ?>

<?php else: ?>

    <div class="empty-card text-center mb-4">
        <div class="bi bi-emoji-frown"></div>
        <h4 class="mt-2">No notices yet</h4>
    </div>

<?php endif; ?>

                </div>

                <!-- RIGHT COLUMN (STICKY) -->
                <div class="col-lg-4 col-12">
                    <div class="card p-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img class="user-logo" src="#" alt="user-logo">
                                <div class="ms-3">
                                    <div class="username" style="font-weight:600;">Member Name</div>
                                </div>
                            </div>

                            <hr>

                            <!-- Empty members state -->
                            <div class="empty-card text-center mb-0">
                                <div class="bi bi-emoji-frown"></div>
                                <h6 class="mt-2 mb-0">No members yet..</h6>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Notice Modal -->
        <div class="modal fade" id="createNoticeModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title">Create Notice</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">

                            <div class="mb-3">
                                <label class="form-label">Notice Title *</label>
                                <input name="title" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Notice Content</label>
                                <textarea name="not-content" class="form-control" rows="4"></textarea>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn" style="background:#8540f5;color:#fff;">Create
                                Notice</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>