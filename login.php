    <?php
        session_start(); 
    ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login — Community Connect</title>

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Inter:wght@300;400;600;700&display=swap"
        rel="stylesheet">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />

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

        .login-card {
            max-width: 520px;
            margin: 32px auto;
            background: #fff;
            padding: 28px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }

        .brand-title {
            font-family: Handlee, cursive;
            color: #00897B;
            font-size: 1.5rem;
            margin-bottom: 6px;
        }

        label {
            font-weight: 500;
            font-size: 14px;
        }

        .btn-primary {
            background: #00897B;
            border: none;
        }

        .muted {
            color: #6b7280;
            font-size: 13px;
        }

        /* Alert styling */
        .alert {
            max-width: 520px;
            margin: 0 auto 20px auto; /* centers alert and adds bottom spacing */
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

    <!-- LOGIN CARD -->
    <div class="login-card">
        <div class="text-center mb-3">
            <div class="brand-title">Community Connect</div>
            <div class="muted">Login to your account</div>
        </div>

        <!-- PHP alert code: place here, above the form -->
                <?php
            if (isset($_GET['error']) && $_GET['error'] == 1) {
            ?>
                <div style="
                    text-align:center;
                    color: #d32f2f;
                    font-size: 15px;
                    font-weight: 600;
                    padding-left: 10px;
                    margin-bottom: 15px;
                ">
                    <i class="bi bi-exclamation-circle-fill me-1"></i>
                    Incorrect username or password. Please try again.
                </div>
            <?php
            }
            ?>


        <form method="post" action="login_validation.php" class="g-3">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input id="username" name="username" type="text" class="form-control" required
                    autocomplete="username" />
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" name="password" type="password" class="form-control" required
                    autocomplete="current-password" />
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="muted">Don't have an account? <a href="signup.php">Sign up</a></div>
                <button type="submit" class="btn btn-primary">Log in</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
