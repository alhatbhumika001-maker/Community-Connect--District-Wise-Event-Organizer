<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sign Up — Community Connect</title>

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Inter:wght@300;400;600;700&display=swap"
        rel="stylesheet">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Inter, sans-serif;
            background: #f7f9fa;
            padding-top: 100px;
        }

        .navbar-brand-text {
            font-family: "Handlee", cursive;
            font-size: 1.7rem;
            margin-left: 6px;
        }

        .navbar {
            padding-top: .10rem !important;
            padding-bottom: .10rem !important;
        }

        .navbar .container {
            padding-left: .5rem !important;
            padding-right: .5rem !important;
            max-width: 100% !important;
        }

        .brand-logo {
            width: 80px;
            height: 80px;
            object-fit: cover;
        }

        .signup-card {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }

        label {
            font-size: 14px;
            font-weight: 500;
        }

        input,
        select {
            font-size: 14px !important;
        }

        .error-text {
            color: #d32f2f;
            font-size: 13px;
            font-weight: 600;
            margin-top: 3px;
        }

        .is-invalid {
            border: 2px solid #d32f2f !important;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-light shadow-sm fixed-top">
        <div class="container">

            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="lg.png" class="brand-logo" alt="">
                <span class="navbar-brand-text">Community Connect</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="nav">

                <ul class="navbar-nav ms-3 me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="event.php">Events</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                </ul>

                <div class="d-flex gap-2">
                    <a href="signup.php" class="btn btn-outline-info btn-sm">Sign Up</a>
                    <a href="login.php" class="btn btn-outline-info btn-sm">Login</a>
                </div>

            </div>
        </div>
    </nav>

    <!-- SIGNUP CARD -->
    <div class="signup-card">
        <h3 class="text-center mb-3" style="font-family: Handlee, cursive; color:#00897B;">Create Your Account</h3>

        <form method="post" action="sign_up_insert.php" class="row g-3">

            <!-- Full Name -->
            <div class="col-md-12">
                <label>Full Name</label>
                <input type="text" name="full_name" class="form-control" required>
            </div>

            <!-- Username -->
            <div class="col-md-6">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php if(isset($_GET['username_error'])) echo 'is-invalid'; ?>" required>
                <?php if(isset($_GET['username_error'])) { ?>
                    <div class="error-text">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <?php echo $_GET['username_error']; ?>
                    </div>
                <?php } ?>
            </div>

            <!-- Email -->
            <div class="col-md-6">
                <label>Email</label>
                <input type="email" name="email" class="form-control <?php if(isset($_GET['email_error'])) echo 'is-invalid'; ?>" required>
                <?php if(isset($_GET['email_error'])) { ?>
                    <div class="error-text">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <?php echo $_GET['email_error']; ?>
                    </div>
                <?php } ?>
            </div>

            <!-- Password -->
            <div class="col-md-6">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php if(isset($_GET['password_error'])) echo 'is-invalid'; ?>" required>
                <?php if(isset($_GET['password_error'])) { ?>
                    <div class="error-text">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <?php echo $_GET['password_error']; ?>
                    </div>
                <?php } ?>
            </div>

            <!-- Confirm Password -->
            <div class="col-md-6">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php if(isset($_GET['confirm_error'])) echo 'is-invalid'; ?>" required>
                <?php if(isset($_GET['confirm_error'])) { ?>
                    <div class="error-text">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <?php echo $_GET['confirm_error']; ?>
                    </div>
                <?php } ?>
            </div>

            <!-- Role -->
            <div class="col-md-6">
                <label>Role</label>
                <select name="role" class="form-select" required>
                    <option value="">Select</option>
                    <option value="admin">Admin</option>
                    <option value="volunteer">Volunteer</option>
                    <option value="organizer">Organizer</option>
                </select>
            </div>

            <!-- District -->
            <div class="col-md-6">
                <label>District</label>
                <select name="district" class="form-select" required>
                    <option value="">Select District</option>
                    <option value="jalgaon">Jalgaon</option>
                    <option value="pune">Pune</option>
                    <option value="mumbai">Mumbai</option>
                    <option value="nagpur">Nagpur</option>
                    <option value="thane">Thane</option>
                    <option value="nashik">Nashik</option>
                    <option value="satara">Satara</option>
                    <option value="kolhapur">Kolhapur</option>
                </select>
            </div>

            <div class="col-12 text-end">
                <button class="btn btn-info text-white px-4">Create Account</button>
            </div>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
