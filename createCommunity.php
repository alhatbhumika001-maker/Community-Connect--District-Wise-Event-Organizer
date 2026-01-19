<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sign Up — Community Connect</title>

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
    <!-- BRAND -->
    <header id="brand">
        <img src="lg.png" class="brand-logo" alt="logo" />
        <span class="brand-text">Community Connect</span>
    </header>

  <div class="main-card" id="main">
    <div class="row g-0">
        <!-- LEFT FORM SECTION -->
        <div class="col-lg-7 left-section">
            <h3 class="section-title">Create Your Community</h3>

            <form class="row g-3" method="post" action="community_insert.php" enctype="multipart/form-data">
                <div class="col-12">
                    <label>Community Name</label>
                    <input type="text" class="form-control" name="community_name" required />
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
                    <label>Community Privacy</label>
                    <div class="d-flex align-items-center mt-1">
                        <div class="form-check me-4">
                            <input class="form-check-input" type="radio" name="privacy" value="private" id="private" />
                            <label class="form-check-label" for="private">Private</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="privacy" value="public" id="public" checked />
                            <label class="form-check-label" for="public">Public</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Community Banner</label>
                    <input type="file" class="form-control" name="image" />
                    <span class="badge text-secondary mt-1">Skip to use default image</span>
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

                <div class="col-12">
                    <label>About Community</label>
                    <textarea class="form-control" rows="3" name="about"></textarea>
                </div>

                <!-- BUTTONS -->
                <div class="col-12 d-flex justify-content-end gap-2 mt-3 flex-wrap">
                    <button type="submit" class="btn btn-info text-white px-4">
                        Create Community
                    </button>

                    <a href="profile.php" class="btn btn-outline-indigo">
                        Back To Profile
                    </a>
                </div>
            </form>
        </div>

        <!-- RIGHT IMAGE SECTION -->
        <div class="col-lg-5 position-relative p-0">
            <div class="right-section" style="background-image: url('co2.jpg');"></div>
        </div>
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>