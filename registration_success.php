<?php
session_start();

$userName = $_SESSION['login_user']['full_name'] ?? 'User';
?>


<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Registration Successful</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="card shadow-lg p-4 text-center" style="max-width:500px;">

    <div class="mb-3">
      <div class="rounded-circle bg-success text-white d-inline-flex
                  align-items-center justify-content-center"
           style="width:80px;height:80px;font-size:40px;">
        ✓
      </div>
    </div>

    <h3 class="text-success fw-bold">Congratulations 🎉</h3>

    <h5 class="mt-2 text-dark">
    Hello, <b><?php echo htmlspecialchars($userName); ?></b>

    </h5>

    <p class="mt-3 fs-5">
      Your <b>event registration</b> has been completed successfully.
    </p>

    <p class="text-muted">
      Please wait while the <b>event organizer reviews your request</b>.<br>
      Approval will be completed within <b>24 hours</b>.
    </p>

    <a href="event.php" class="btn btn-success mt-3">
      Go to Home
    </a>

  </div>
</div>

</body>
</html>
