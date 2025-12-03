<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sign Up — Community Connect</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Inter:wght@300;400;600;700&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        .error-text {
            color: #d32f2f;
            font-size: 13px;
            font-weight: 600;
            margin-top: 3px;
        }
    </style>
</head>

<body class="bg-light">

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
            <input type="text" name="username" class="form-control" required>
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
            <input type="email" name="email" class="form-control" required>
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
            <input type="password" name="password" class="form-control" required>
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
            <input type="password" name="confirm_password" class="form-control" required>
            <?php if(isset($_GET['error'])) { ?>
                <div class="error-text">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <?php echo $_GET['error']; ?>
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

</body>
</html>
