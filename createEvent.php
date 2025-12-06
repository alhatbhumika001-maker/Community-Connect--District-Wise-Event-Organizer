<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Create Event — Community Connect</title>

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Inter:wght@300;400;600;700&display=swap"
        rel="stylesheet" />

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
    body {
        font-family: Inter, sans-serif;
        background: #f3f5f7;
        margin: 0;
    }

    #brand {
        position: static;
        height: 64px;
        background: #ffffff;
        display: flex;
        align-items: center;
        padding: 10px 20px;
        box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2);
    }

    #brand .brand-logo {
        width: 48px;
        height: 48px;
        object-fit: cover;
        border-radius: 8px;
        flex-shrink: 0;
    }

    #brand .brand-text {
        font-family: "Handlee", cursive;
        font-size: 1.45rem;
        margin-left: 10px;
        color: #000;
        line-height: 1;
    }

    /* --- Main card --- */
    .main-card {
        max-width: 1100px;
        margin: 20px auto 50px;
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
        position: relative;
        z-index: 1;
    }

    /* --- Left-side form --- */
    .left-section {
        padding: 40px 45px;
    }

    .section-title {
        font-family: Handlee, cursive;
        color: #00897B;
        text-align: center;
        margin-bottom: 25px;
        font-size: 28px;
    }

    label {
        font-weight: 500;
        font-size: 14px;
    }

    input,
    select {
        font-size: 14px !important;
    }

    .form-check-input {
        width: 18px;
        height: 18px;
        border: 2px solid #00897B !important;
    }

    .form-check-input:checked {
        background-color: #00897B !important;
    }

    .right-section {
        background-size: cover;
        background-position: center;
        height: 100%;
        min-height: 550px;
        width: 100%;
    }

    /* small-screen adjustments */
    @media (max-width: 991px) {
        #brand {
            padding: 8px 12px;
            height: 56px;
        }

        .brand-logo {
            width: 40px;
            height: 40px;
        }

        .main-card {
            margin: 10px;
            border-radius: 12px;
        }
    }

    .right-section {
        background-image: url('createEvent.png');
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;

    }
    </style>
</head>

<body>
    <!-- BRAND -->
    <header id="brand">
        <img src="lg.png" class="brand-logo" alt="logo" />
        <span class="brand-text">Community Connect</span>
    </header>

    <!-- MAIN SPLIT CARD -->
    <div class="main-card mt-5" id="main">
        <div class="row g-0">
            <!-- LEFT FORM SECTION -->
            <div class="col-lg-7 left-section">
                <h3 class="section-title">Create Event</h3>

                <form class="row g-3" method="post" action="community_insert.php" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <label>Event Name</label>
                        <input type="text" class="form-control" name="event_name" required />
                    </div>

                    <div class="col-md-6">
                        <label>Category</label>
                        <select class="form-select" required name="category">
                            <option value="">Select</option>
                            <option value="college-level">College Level</option>
                            <option value="cultural">Cultural</option>
                            <option value="festive">Festive</option>
                            <option value="sports">Sports</option>
                            <option value="social">Social</option>
                            <option value="governmental">Governmental</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>If Other - What Category?</label>
                        <input type="text" class="form-control" name="other_category" />
                    </div>

                    <div class="col-md-6">
                        <label>District</label>
                        <select class="form-select" required name="district">
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
                        <label>Start Time:</label>
                        <input type="time" class="form-control" name="start_time">
                    </div>
                    <div class="col-md-6">
                        <label>End Time:</label>
                        <input type="time" class="form-control" name="end_time">
                    </div>

                    <div class="col-md-6">
                        <label>Date</label>
                        <input type="date" class="form-control" name="date" />
                    </div>

                    <div class="col-md-6">
                        <label>Event Banner</label>
                        <input type="file" class="form-control" name="image" />
                        <span class="badge text-secondary mt-1">Skip to use default image</span>
                    </div>

                    <div class="col-12">
                        <label>Event Description</label>
                        <textarea class="form-control" rows="3" name="about"></textarea>
                    </div>

                    <div class="col-12 text-end mt-3">
                        <button class="btn btn-info text-white px-4">Create Event</button>
                    </div>
                    <!-- Should be redirected to Created Event page after creation to view -->
                </form>
            </div>

            <!-- RIGHT IMAGE SECTION -->
            <div class="col-lg-5 position-relative p-0">
                <div class="right-section"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>