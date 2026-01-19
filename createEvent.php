<?php
session_start();
$conn = new mysqli("localhost", "root", "", "community_connect");

// Check login
if (!isset($_SESSION['user_id'])) {
    die("<script>alert('Please login first!'); window.location='login.php';</script>");
}

$user_id = $_SESSION['user_id'];

// Check if user has created any community
$community_query = "SELECT id, community_name FROM communities WHERE created_by = $user_id";
$community_result = mysqli_query($conn, $community_query);

if (mysqli_num_rows($community_result) == 0) {
    die("
        <script>
            alert('You must create a community before creating an event.');
            window.location = 'createCommunity.php';
        </script>
    ");
}
$privacy = $_POST['privacy'] ?? '';

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Create Event — Community Connect</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Inter:wght@300;400;600;700&display=swap"
        rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
    body {
        font-family: Inter, sans-serif;
        background: #f3f5f7;
        margin: 0;
    }

    #brand {
        height: 64px;
        background: #fff;
        display: flex;
        align-items: center;
        padding: 10px 20px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
    }

    .brand-logo {
        width: 48px;
        height: 48px;
        border-radius: 8px;
    }

    .brand-text {
        font-family: "Handlee";
        font-size: 1.45rem;
        margin-left: 10px;
    }

    .main-card {
        max-width: 1100px;
        margin: 24px auto 48px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .left-section {
        padding: 32px 36px;
    }

    .section-title {
        font-family: Handlee;
        color: #00897B;
        text-align: center;
        margin-bottom: 18px;
        font-size: 26px;
    }

    .right-section {
        background-image: url('createEvent.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100%;
        height: 380px;
    }

    .main-card>.row {
        align-items: stretch;
    }

    /* readonly styling */
    input[readonly],
    textarea[readonly] {
        background-color: #f7f7f7;
        cursor: not-allowed;
    }

    /* tighten spacing on small screens */
    @media (max-width: 767px) {
        .left-section {
            padding: 18px;
        }
    }

      .btn-outline-indigo {
    border: 1px solid #7e57c2; /* Purple border */
    color: #7e57c2;             /* Text color same as border */
    background-color: transparent; /* Transparent background */
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-outline-indigo:hover {
    background-color: #7e57c2; /* Filled on hover */
    color: #fff;                /* White text on hover */
    text-decoration: none;
}
    </style>
</head>

<body>

    <header id="brand">
        <img src="lg.png" class="brand-logo" alt="logo" />
        <span class="brand-text">Community Connect</span>
    </header>

    <div class="main-card">
        <div class="row g-0">
            <!-- Left: Form -->
            <div class="col-lg-7 left-section">
                <h3 class="section-title">Create Event</h3>

                <form class="row g-3" method="post" action="event_insert.php" enctype="multipart/form-data" novalidate>

                    <!-- COMMUNITY -->
                    <div class="col-12">
                        <label for="community" class="form-label"><strong>Select Community</strong></label>
                        <select id="community" name="community" class="form-select" required>
                            <option value="">-- Select Community --</option>
                            <?php while ($c = mysqli_fetch_assoc($community_result)) { ?>
                            <option value="<?= $c['id']; ?>">
                                <?= htmlspecialchars($c['community_name']); ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- EVENT NAME -->
                    <div class="col-12">
                        <label for="event_name" class="form-label">Event Name</label>
                        <input id="event_name" type="text" class="form-control" name="event_name" required />
                    </div>

                    <!-- CATEGORY + OTHER -->
                    <div class="col-md-6">
                        <label for="category" class="form-label">Category</label>
                        <select id="category" class="form-select" required name="category" required>
                            <option value="">Select</option>
                            <option value="college-level">College Level</option>
                            <option value="college-level">Free for Public</option>
                            <option value="cultural">Cultural</option>
                            <option value="festive">Festive</option>
                            <option value="sports">Sports</option>
                            <option value="social">Social</option>
                            <option value="governmental">Governmental</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="other_category" class="form-label">If Other - What Category?</label>
                        <input id="other_category" type="text" class="form-control" name="other_category" />
                    </div>

                    <!-- DISTRICT + ADDRESS -->
                    <div class="col-md-6">
                        <label for="district" class="form-label">District</label>
                        <select id="district" class="form-select" required name="district">
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

                    <div class="col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <input id="address" type="text" name="location" class="form-control" required />
                    </div>

                    <!-- SCHEDULE: readonly display -->
                    <div class="col-md-6">
                        <label for="event_date" class="form-label">Event Schedule (Date)</label>
                        <input id="event_date" type="date" class="form-control" name="date" required
                        >
                    </div>

                    <div class="col-md-6">
                        <label for="event_time" class="form-label">Event Schedule (Start_Time)</label>
                        <input id="event_time" type="time" class="form-control" name="start_time" required
                        >
                    </div>

                    <div class="col-md-6">
                        <label for="event_time" class="form-label">Event Schedule (End_Time)</label>
                        <input id="event_time" type="time" class="form-control" name="end_time" required
                        >
                    </div>

                    <!-- EVENT BANNER -->
                    <div class="col-md-6">
                        <label for="image" class="form-label">Event Banner</label>
                        <input id="image" type="file" class="form-control" name="image" accept="image/*" required />
                    </div>

                    <!-- EVENT TYPE -->
                    <div class="col-md-6">
                        <label for="event_type" class="form-label">Event Type</label>
                        <select id="event_type" name="event_type" class="form-select" required>
                            <option value="" disabled selected>Select Event Type</option>
                            <option value="Seminar">Seminar</option>
                            <option value="Webinar">Webinar</option>
                            <option value="Workshop">Workshop</option>
                            <option value="Community Service">Community Service</option>
                            <option value="Fundraising Event">Fundraising Event</option>
                            <option value="Donation Drive">Donation Drive</option>
                            <option value="Cleanliness Drive">Cleanliness Drive</option>
                            <option value="Blood Donation Camp">Blood Donation Camp</option>
                            <option value="Sports Event">Sports Event</option>
                            <option value="Cultural Program">Cultural Program</option>
                            <option value="Tech Event">Tech Event</option>
                            <option value="Job Fair">Job Fair</option>
                            <option value="Hackathon">Hackathon</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Event Mode</label>
                        <select class="form-select" name="event_mode" required>
                            <option value="">Select</option>
                            <option value="online">Online</option>
                            <option value="offline">Offline</option>
                        </select>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="reg_deadline" class="form-label">Event Deadline</label>
                        <input type="date" id="reg_deadline" name="registration_deadline" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="reg_deadline" class="form-label">Event Type (paid/Free)</label>
                        <select class="form-select" name="event_ty" required>
                            <option value="">Select</option>
                            <option value="online">Paid</option>
                            <option value="offline">Free</option>
                        </select>
                    </div>


                    <!-- PRIVACY (RADIO) -->
                    <div class="col-12">
                        <label class="form-label">Event Privacy</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="privacy" id="privacy_public"
                                    value="public" checked required>
                                <label class="form-check-label" for="privacy_public">Public</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="privacy" id="privacy_private"
                                    value="private" required>
                                <label class="form-check-label" for="privacy_private">Private</label>
                            </div>
                        </div>
                    </div>

                    

                    <!-- EVENT CODE (Visible only if private) -->
                    <div class="col-12" 
                        id="eventCodeWrapper" 
                        style="<?= ($privacy === 'private') ? 'display:block;' : 'display:none;' ?>">

                        <label for="event_code" class="form-label">Event Code (for private events)</label>
                        <input type="text" id="event_code" name="event_code" 
                            class="form-control"
                            placeholder="Enter a secret event code"
                            <?= ($privacy === 'private') ? 'required' : '' ?>>
                    </div>

                    



                    <!-- DESCRIPTION + DETAILS -->
                    <div class="col-12">
                        <label for="short_desc" class="form-label">Event Description (short)</label>
                        <textarea id="short_desc" name="about" class="form-control" rows="2" required></textarea>
                    </div>

                    <div class="col-12">
                        <label for="details" class="form-label">Event Details (please be detailed; include meeting link
                            if webinar)</label>
                        <textarea id="details" name="details" class="form-control" rows="4" required></textarea>
                    </div>

                    <!-- CONSENT CHECKBOXES (Bootstrap format) -->
                    <div class="col-12">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="agreeRules" name="agreeRules" required>
                            <label class="form-check-label" for="agreeRules">
                                I agree to follow all event rules &amp; guidelines.
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="shareDetails" name="shareDetails"
                                required>
                            <label class="form-check-label" for="shareDetails">
                                I agree to share my contact details with the event organizers.
                            </label>
                        </div>
                    </div>

                    <!-- SUBMIT -->
                  

                    <div class="col-12 text-end mt-3 d-flex justify-content-end gap-2 flex-wrap">
                        <!-- Create Community Button -->
                         <button type="submit" class="btn btn-info text-white px-4">Create Event</button>

                        <!-- Back to Profile Button -->
                        <a href="profile.php" class="btn btn-outline-indigo">
                            Back To Profile
                        </a>
                    </div>

                </form>
            </div>

            <!-- Right: Illustration -->
            <div class="col-lg-5 p-0">
                <div class="right-section d-none d-lg-block"></div>
            </div>
        </div>
    </div>

    <script>
document.getElementById("privacy_public").addEventListener("change", function() {
    document.getElementById("eventCodeWrapper").style.display = "none";
    document.getElementById("event_code").required = false;
});

document.getElementById("privacy_private").addEventListener("change", function() {
    document.getElementById("eventCodeWrapper").style.display = "block";
    document.getElementById("event_code").required = true;
});
</script>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>