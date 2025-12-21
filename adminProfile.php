<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Community Connect</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="adminStyle.css">

    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    .profile-header {
        position: relative;
        width: 100%;
        margin-bottom: 60px;
    }

    .admin-wallpaper {
        width: 100%;
        height: 280px;
        object-fit: cover;
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }

    .admin-logo {
        position: absolute;
        bottom: -40px;
        left: 50%;
        transform: translateX(-50%);
        height: 120px;
        width: 120px;
        border-radius: 50%;
        border: 4px solid #bbb;
        background: #fff;
    }

    .admin-info {
        text-align: center;
        margin-top: -10px;
        margin-bottom: 20px;
    }

    .info-cards {
        width: 80%;
        background-color: white;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        border-radius: 15px;
        padding: 20px;
    }

    .info {
        margin-bottom: 8px;
        line-height: 1.5;
    }
    </style>
</head>

<body class="no-strip">
    <?php
    $active = 'adminProfile';
    include 'adminNav.php';
    ?>
    <div class="content">
        <div class="profile-header">
            <img src="adPro.jpg" alt="Admin Wallpaper" class="admin-wallpaper">
            <img src="user.png" alt="Admin logo" class="admin-logo">
        </div>
        <div class="admin-info">
            <h3>Admin_Name</h3>
            <h4>username</h4>
        </div>

        <div class="info-cards container mb-4">
            <h2 class="text-muted mb-3 ">Personal Information</h2>
            <h5 class="info">Email: xyz@gmail.com</h5>
            <h5 class="info">Account Created: dd-mm-yyyy</h5>
            <h5 class="info">Last Login: hr:min dd-mm-yyyy</h5>
            <button class="btn btn-outline-navy btn-sm" data-bs-toggle="collapse" data-bs-target="#editProfileForm">
                Edit Profile
            </button>
            <!-- Collapsible edit form -->
            <div class="collapse mt-3" id="editProfileForm">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">

                        <h6 class="mb-3">Edit Profile</h6>

                        <form>
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" value="Name">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" value="username">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="admin@email.com">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Profile Photo</label>
                                <input type="file" class="form-control" accept="image/*">
                            </div>

                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-navy btn-sm">Save Changes</button>
                                <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="collapse"
                                    data-bs-target="#editProfileForm" type="button">
                                    Cancel
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="info-cards container mb-4">
            <h2 class="text-muted mb-3 ">Actions History</h2>
            <h4 class="text-muted mb-3 ">Events Cancelled</h4>
            <!-- Loop this area for recent 3 events Cancelled -->
            <h5 class="info">Event Name - {{Description}}</h5>
            <h4 class="text-muted mb-3 ">Feedback given</h4>
            <h5 class="info"><strong>Name</strong> • <span class="text-muted small">username</span></h5>
        </div>

        <div class="info-cards container">
            <h2 class="text-muted mb-3 ">Security</h2>
            <h6 class="info">Change password to keep the account safe</h6>
            <button class="info btn btn-outline-navy btn-sm" data-bs-toggle="modal" data-bs-target="#passwordModal">
                Change Password
            </button>
        </div>
        <div class="modal fade" id="passwordModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <p class="text-muted small">
                            Enter your current password and choose a new one.
                        </p>

                        <div class="mb-3">
                            <label class="form-label">Current Password</label>
                            <input type="password" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button class="btn btn-outline-navy btn-sm">
                            Update Password
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap JS  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>