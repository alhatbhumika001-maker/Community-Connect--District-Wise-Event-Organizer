<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Community - Community Connect</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="adminStyle.css">

    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    .events-list {
        max-width: 900px;
        margin-left: auto;
        margin-right: auto;
        background-color: white;
        box-shadow: 4px 4px 12px rgba(0, 0, 0, 0.1);
        padding: 15px;
        border-radius: 15px;
        line-height: 1.5;
    }

    .eve-img {
        background-color: rgb(221, 218, 218);
        display: block;
        height: 200px;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .buttons {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        margin-top: 10px;
        gap: 10px;
    }

    .no-event {
        display: flex;
        flex-direction: column;
        text-align: center;
    }

    .bi-calendar {
        color: #8540f5;
        font-size: 50px;
    }

    .user-logo {
        height: 60px;
        width: 60px;
        border-radius: 50%;
    }
    </style>
</head>

<body>
    <?php
    $active = 'communities';
    $topbar = 'communities';
    $sub = 'communities_list';
    include 'adminNav.php';
    ?>
    <div class="content">
        <h2 class="text-muted mb-1">All Communities</h2>
        <div class="d-flex flex-wrap gap-4 mb-3 align-items-center">

            <!-- Search box -->
            <form method="GET" action="">
                <div class="input-group input-group-sm" style="max-width: 420px;">
                    <span class="input-group-text bg-light">
                        <i class="bi bi-search text-muted"></i>
                    </span>

                    <input type="text" name="q" class="form-control" placeholder="Search events">

                    <button type="submit" class="btn btn-outline-navy">
                        Search
                    </button>
                </div>
            </form>


            <!-- District filter -->
            <form method="GET" action="">
                <label class="small text-muted">District</label>
                <select name="district" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                    <option>Jalgaon</option>
                    <option selected>Pune</option>
                    <option>Mumbai</option>
                    <option>Nagpur</option>
                    <option>Thane</option>
                    <option>Nashik</option>
                    <option>Satara</option>
                    <option>Kolhapur</option>
                </select>
            </form>
        </div>

        <h2 class="text-muted mb-3">Showing the Communities of district_name</h2>
        <!-- Loop from here for showing events-->
        <div class="events-list mb-3 container">
            <img src="community_image.png" alt="Community Banner" class="eve-img mb-2">
            <h4 class="mb-2">Community Name</h4>
            <h5 class="mb-2">Creator Name</h5>
            <h5 class="mb-2">Creation Date • Privacy</h5>
            <h6 class="text-muted mb-3">Description</h6>
            <button class="btn btn-outline-navy btn-sm" data-bs-toggle="collapse" data-bs-target="#viewMembers">
                View Members
            </button>
            <!-- Collapsible member list-->
            <div class="collapse mt-3" id="viewMembers">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">

                        <h6 class="mb-3">Members</h6>

                        <div class="member d-flex align-items-center justify-content-start">
                            <img src="user.png" alt="User Logo" class="user-logo me-3">
                            <div class="names">
                                <h5 class="mb-2">Name</h5>
                                <h6 class="text-muted mb-2">Username</h6>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
            <div class="buttons">
                <button class="btn btn-outline-navy btn-sm">View</button>
                <button class="btn btn-outline-navy btn-sm" data-bs-toggle="modal"
                    data-bs-target="#deleteCommunityModal">
                    Delete Community
                </button>
            </div>
        </div>
        <!-- If no communities then display this -->
        <div class="no-event mb-3">
            <i class="bi bi-calendar"></i>
            <h4>No communities in this district</h4>
            <h5 class="text-muted">Try clearing the filters</h5>
        </div>

        <!-- Modal for delete the communities -->
        <div class="modal fade" id="deleteCommunityModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <form method="POST" action="">

                        <div class="modal-header">
                            <h5 class="modal-title">Delete Community</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <p class="small">
                                Community: <strong>Name</strong>
                            </p>
                            <input type="text" name="reason_title" class="form-control mb-2"
                                placeholder="Reason title (e.g. Inappropriate content)" required>
                            <p class="small text-muted">
                                Please provide a detailed explaination about the deletion.
                            </p>
                            <textarea name="reason_detail" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-outline-danger"
                                onclick="return confirm('Are you sure you want to delete this community?')">
                                Delete Community
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