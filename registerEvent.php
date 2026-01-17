<?php
/* Simple Captcha */
session_start();
$captcha_code = rand(10000, 99999);
$_SESSION['captcha'] = $captcha_code;

$conn = mysqli_connect("localhost", "root", "", "community_connect");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_GET['id'])) {
    die("Event ID not specified.");
}

$event_id = intval($_GET['id']);

$event_query = "SELECT * FROM community_events WHERE id = $event_id";
$event_result = mysqli_query($conn, $event_query);

if (mysqli_num_rows($event_result) == 0) {
    die("Event not found.");
}

$row = mysqli_fetch_assoc($event_result);
$isPrivate = ($row['privacy'] === 'private');

/* Simple Captcha */
$captcha_code = rand(1000, 9999);

$_SESSION['captcha'] = $captcha_code;
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Register Event</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body class="bg-light">

<div class="container mt-4">
<div class="card p-4 shadow">

<h4 class="text-center mb-3">Register for Event</h4>

<form method="post" action="register_Event_Insert.php" enctype="multipart/form-data">

<input type="hidden" name="event_id" value="<?php echo $row['id']; ?>">

<div class="mb-3">
<label>Name</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" id="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Phone</label>
<input type="tel" name="phone" class="form-control" required>
</div>

<div class="mb-3">
<label>ID Card</label>
<input type="file" name="image" class="form-control" <?php echo $isPrivate ? 'required' : ''; ?>>
</div>

<?php if ($isPrivate): ?>
<div class="alert alert-warning">
<b>Private Event</b> – Event code required
</div>

<div class="mb-3">
<button type="button" class="btn btn-secondary" onclick="showEventCode()">
Get Event Code
</button>
</div>

<div class="mb-3">
<label>Event Code</label>
<input type="text" name="event_code" class="form-control" required>
</div>
<?php endif; ?>

<div class="mb-3">
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

<div class="mb-3">
<label>Event Name</label>
<input type="text" class="form-control" value="<?php echo $row['event_name']; ?>" readonly>
</div>

<div class="mb-3">
<label>Event Date</label>
<input type="date" class="form-control" value="<?php echo $row['date']; ?>" readonly>
</div>

<div class="mb-3">
<label>Start Time</label>
<input type="time" class="form-control" value="<?php echo $row['start_time']; ?>" readonly>
</div>

<div class="mb-3">
<label>Location</label>
<input type="text" class="form-control" value="<?php echo $row['location']; ?>" readonly>
</div>

<!-- CAPTCHA -->
<!-- CAPTCHA -->
<div class="mb-4">
  <label class="form-label fw-bold">Security Check</label>

  <div class="d-flex align-items-center gap-3">
    <div class="px-4 py-2 rounded text-white fw-bold fs-4 text-center"
         style="letter-spacing:4px;
                background:linear-gradient(135deg,#fd7e14,#c62828,#ff5722);">
      <?php echo $captcha_code; ?>
    </div>

    <button type="button" class="btn btn-outline-secondary btn-sm"
            onclick="location.reload();">
      🔄 Refresh
    </button>
  </div>

  <input type="text"
         name="captcha"
         class="form-control mt-2"
         placeholder="Enter captcha code"
         required>
</div>

<div class="form-check mb-3">
<input class="form-check-input" type="checkbox" required>
<label class="form-check-label">
I agree to share my contact details
</label>
</div>

<button class="btn btn-success w-100">Register</button>

</form>
</div>
</div>

<div class="toast-container position-fixed top-0 end-0 p-4">
  <div id="eventCodeToast" class="toast border-0 shadow-lg" role="alert">
    
    <div class="toast-header bg-white border-0">
      <i class="bi bi-shield-lock-fill text-success me-2"></i>
      <strong class="me-auto">Private Event Access</strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
    </div>

    <div class="toast-body text-center">
      <div class="text-muted small mb-2">Your Event Code</div>

      <div class="px-4 py-2 rounded bg-success bg-opacity-10">
        <span class="fs-2 fw-bold text-success" id="eventCodeText"></span>
      </div>

      <div class="small text-muted mt-2">
        <b>Valid for private registration only</b>
      </div>
    </div>

  </div>
</div>


<script>
function showEventCode() {
    var code = "<?php echo $row['event_code']; ?>";

    if (code === "" || code === "NULL") {
        alert("Event code not available");
        return;
    }

    document.getElementById("eventCodeText").innerText = code;

    var toastEl = document.getElementById('eventCodeToast');
    var toast = new bootstrap.Toast(toastEl, {
        delay: 5000   // 5 seconds
    });

    toast.show();
}
</script>



</body>
</html>
