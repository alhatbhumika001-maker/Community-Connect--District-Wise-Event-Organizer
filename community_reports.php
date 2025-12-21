<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Communities - Community Connect</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="adminStyle.css">

    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    .report-card {
        padding: 20px;
        background-color: white;
        border-radius: 20px;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
    }

    .feedback {
        border: 0.5px solid grey;
        padding: 10px;
        border-radius: 10px;
    }

    .report {
        border: 0.5px solid grey;
        padding: 10px;
        border-radius: 10px;
    }
    </style>
</head>

<body>
    <?php
    $active = 'communities';
    $topbar = 'communities';
    $sub = 'community_reports';
    include 'adminNav.php';
    ?>
    <div class="content">
        <h2 class="text-muted mb-3">Reports and Feedback</h2>
        <div class="report-card container mb-4">
            <h2 class="text-muted mb-3">Feedback</h2>
            <!-- Loop from here for Feedback -->
            <div class="feedback">
                <h5 class="mb-2">From : <strong>Organizer Name</strong></h5>
                <h6 class="text-muted mb-2">Community Name</h6>
                <h6 class="text-muted mb-2">Type : Suggestion</h6>
                <p class="mb-2">Feedback Content</p>
                <div class="text-end me-2 mt-2">
                    <button class="btn btn-outline-navy btn-sm" data-bs-toggle="modal" data-bs-target="#replyModal">
                        Reply
                    </button>
                </div>
            </div>
        </div>

        <div class="report-card container">
            <h2 class="text-muted mb-3">Reports</h2>
            <!-- Loop from here for Report -->
            <div class="report">
                <h5 class="mb-2">From : <strong>Organizer Name</strong></h5>
                <h6 class="text-muted mb-2">Community Name</h6>
                <h6 class="text-muted mb-2">Type : Complaint</h6>
                <p class="mb-2">Report Content</p>
                <div class="text-end me-2 mt-2">
                    <button type="submit" class="btn btn-outline-danger btn-sm me-2"
                        onclick="return confirm('Are you sure you want to delete the report here?')">
                        Delete
                    </button>
                    <button class="btn btn-outline-navy btn-sm" data-bs-toggle="modal" data-bs-target="#replyModal">
                        Reply
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal for replying the feedback or report -->
        <div class="modal fade" id="replyModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <form method="POST" action="">

                        <div class="modal-header">
                            <h5 class="modal-title">Reply</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <p class="small">
                                To: <strong>Name</strong>
                            </p>
                            <input type="text" name="reason_title" class="form-control mb-2"
                                placeholder="Reason title (e.g. Replying to the report: Report title)" required>
                            <p class="small text-muted">
                                Write Your Reply here.
                            </p>
                            <textarea name="reason_detail" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-outline-warning"
                                onclick="return confirm('Confirm Reply?')">
                                Send
                            </button>

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>