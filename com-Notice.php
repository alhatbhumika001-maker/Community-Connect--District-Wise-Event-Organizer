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

    <?php
    include 'userHead.php';
    ?>

    <?php
    include 'userHead.php';
    ?>

    <div class="container-fluid">
        <?php
        $active = 'com-Notice';
        include 'comHead.php';
        ?>

        <!-- Create button -->
        <div class="create-notice-wrap">
            <button class="create-notice-btn" data-bs-toggle="modal" data-bs-target="#createNoticeModal">
                + Create Notice
            </button>
        </div>


        <!-- Main layout -->
        <div class="container page-inner mt-3">
            <div class="row gx-4">

                <!-- LEFT COLUMN -->
                <div class="col-lg-8 col-12">

                    <div class="notice">
                        <div class="noticeHead">
                            <h5 class="not-head">Title For Notice</h5>
                            <h6 class="not-time">Date & Time of posting</h6>
                        </div>
                        <hr>
                        <div class="not-content">
                            <p>
                                Content for the notice. For example, instructions for event, change of time or date
                                or
                                something the attendee should know.
                            </p>
                        </div>
                    </div>

                    <!-- Empty State Example (hidden by default) -->
                    <div class="empty-card text-center mb-4">
                        <div class="bi bi-emoji-frown"></div>
                        <h4 class="mt-2">No notices yet</h4>
                    </div>

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