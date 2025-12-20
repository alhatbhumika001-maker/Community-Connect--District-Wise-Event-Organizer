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
        <!-- Show canceled events here for record for admin -->
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
                    <!-- Loop this for fields -->
                    <tr>
                        <td class="small text-muted">
                            12 Oct 2025
                        </td>

                        <td>
                            <strong>Blood Donation Camp</strong>
                        </td>

                        <td class="text-muted">
                            Helping Hands
                        </td>

                        <td>
                            <span class="badge bg-danger">
                                Cancelled
                            </span>
                        </td>

                        <td class="text-muted">
                            Organizer did not respond to multiple warnings.
                            <button class="btn btn-link btn-sm p-0 ms-1" data-bs-toggle="modal"
                                data-bs-target="#reasonModal">
                                View
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="reasonModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Reason_Title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <p class="text-muted mb-0">
                            detailed_description about cancellation
                        </p>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>