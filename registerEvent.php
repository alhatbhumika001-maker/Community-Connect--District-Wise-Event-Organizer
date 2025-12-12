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

    /* Register Card */
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
    </style>
</head>

<body>

    <header id="brand">
        <img src="lg.png" class="brand-logo" alt="logo" />
        <span class="brand-text">Community Connect</span>
    </header>


    <!-- LOGIN CARD -->
    <div class="login-card">
        <div class="text-center mb-3">
            <div class="brand-title">Community Connect</div>
            <div class="muted">Register for the event here</div>
        </div>

        <form method="post" action="#" class="g-3">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input id="name" name="name" type="text" class="form-control" required autocomplete="name" />
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input id="email" name="email" type="email" class="form-control" required />
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone No.</label>
                <input id="phone" name="phone" type="tel" class="form-control" required />
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
                <label for="email" class="form-label">Event Name</label>
                <input type="text" id="eventName" name="eventName" value="{{Event_name}}" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label for="eventDate">Event Date</label>
                <input type="date" id="eventDate" name="eventDate" class="form-control" value="{{Event_date}}" readonly>
            </div>

            <div class="mb-3">
                <label for="startTime">Start Time</label>
                <input type="time" id="startTime" name="startTime" class="form-control" value="{{Starting_time}}"
                    readonly>
            </div>

            <div class="mb-3">
                <label for="eventLocation">Event Location</label>
                <input type="text" id="eventLocation" name="eventLocation" class="form-control"
                    value="{{Event_Address}}" readonly>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" value="" id="shareDetails" required>
                <label class="form-check-label muted" for="shareDetails">
                    I agree to share my contact details with the event organizers.
                </label>
            </div>

            <div class="col-12 text-end">
                <button class="btn btn-info text-white px-4">Register</button>
            </div>

            <!-- User should be redirected to the community home page and should be shown request sent for private events. -->

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>