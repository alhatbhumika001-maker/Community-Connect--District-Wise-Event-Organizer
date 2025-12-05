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

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Inter, sans-serif;
            background: #f7f9fa;
            padding-top: 100px;
            margin: 0;
        }

        /* Brand Name */
        #brand {
            position: fixed;
            top: 16px;
            left: 16px;
        }

        #brand .brand-text {
            font-family: "Handlee", cursive;
            font-size: 1.45rem;
            margin-left: 8px;
        }

        #brand .brand-logo {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 8px;
        }

        /* Card */
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
    </style>
</head>

<body>

    <header id="brand" class="d-flex align-items-center">
        <img src="lg.png" class="brand-logo" alt="logo">
        <span class="brand-text">Community Connect</span>
    </header>


    <!-- SIGNUP CARD -->
    <div class="signup-card">
        <h3 class="text-center mb-3" style="font-family: Handlee, cursive; color:#00897B;">Create Your Community</h3>

        <form method="post" action="#" class="row g-3">

            <div class="col-md-12">
                <label>Community Name</label>
                <input type="text" name="com-name" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label>Category</label>
                <select name="role" class="form-select" required>
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
            <!-- if category is other, then enable this input field -->
            <div class="col-md-6">
                <label>If Other - What Category?</label>
                <input type="email" name="category" class="form-control">
            </div>

            <div class="col-md-6">
                <label>Is your Community Private / Public?</label>
                <div class="d-flex align-items-center">
                    <div class="form-check me-4">
                        <input class="form-check-input" type="radio" name="radioDefault" id="radioDefault1">
                        <label class="form-check-label" for="radioDefault1">
                            Private
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radioDefault" id="radioDefault2" checked>
                        <label class="form-check-label" for="radioDefault2">
                            Public
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <label>Community Banner</label>
                <input type="file" name="banner" class="form-control" accept="image/*" required>
                <span class="badge text-secondary">Skip to use default image</span>
            </div>

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

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">About community</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>

            <div class="col-12 text-end">
                <button class="btn btn-info text-white px-4">Create Community</button>
            </div>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>