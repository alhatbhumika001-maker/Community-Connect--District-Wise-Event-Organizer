<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events - Community Connect</title>

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Outfit:wght@300;400;600;700&display=swap"
        rel="stylesheet">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- BOOTSTRAP ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        /* WEBSITE BRAND NAME */
        .navbar-brand-text {
            font-family: "Handlee", cursive;
            font-size: 1.7rem;
            margin-left: 6px;
        }

        /* NAVBAR PADDING  */
        .navbar {
            padding-top: .10rem !important;
            padding-bottom: .10rem !important;
        }

        /* Reduce container padding ONLY inside navbar */
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

        body {
            font-family: "Outfit", sans-serif;
            background: #f6fbfb;
        }

        .event-page {
            max-width: 1100px;
            margin: 120px auto 40px;
            padding: 0 15px;
        }

        .event-card {
            width: 100%;
            max-width: 960px;
            display: grid;
            grid-template-columns: 120px 1fr;
            grid-template-rows: auto 220px auto;
            /* (date, content), photo, button */
            border-radius: 8px;
            padding: 10px;
            box-sizing: border-box;
            background: #fff;
        }

        /* Date box (top-left) */
        .date-box {
            grid-column: 1 / 2;
            grid-row: 1 / 2;
            border: var(--border);
            border-radius: 6px;
            padding: 8px;
            text-align: center;
        }

        /* Content (top-right) */
        .content-box {
            grid-column: 2 / 3;
            grid-row: 2 / 3;
            border-radius: 6px;
            padding: 8px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        /* Photo spanning full width under top row */
        .photo-box {
            grid-column: 2 / 3;
            grid-row: 1 / 2;
            border-radius: 6px;
            overflow: hidden;
            min-height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f2f2f2;
        }

        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* Button*/
        .button-box {
            grid-column: 2 / 3;
            grid-row: 3 / 4;
            padding: 6px;
            display: flex;
            justify-content: flex-end;
            align-items: end;
        }

        /* Responsive: stack to one column on small screens */
        @media (max-width: 720px) {
            .event-card {
                grid-template-columns: 1fr;
                /* one column */
                grid-template-rows: auto auto auto auto;
                /* date, content, photo, button */
            }

            .date-box {
                grid-column: 1 / 2;
                grid-row: 1 / 2;
                text-align: left;
            }

            .content-box {
                grid-column: 1 / 2;
                grid-row: 2 / 3;
            }

            .photo-box {
                grid-column: 1 / 2;
                grid-row: 3 / 4;
                min-height: 220px;
            }

            .button-box {
                grid-column: 1 / 2;
                grid-row: 4 / 5;
                justify-content: flex-end;
                padding-right: 8px;
            }
        }

        .title-lg {
            font-size: 34px;
            font-weight: 700;
        }

        .search-box {
            background: #fff;
            border: 1px solid grey;
            border-radius: 40px;
            padding: 8px 14px;
            display: flex;
            align-items: center;
            box-shadow: 0 8px 24px rgba(3, 39, 51, 0.05);
        }

        .search-box input {
            border: none;
            outline: none;
            flex: 1;
            background: transparent;
        }

        .filter-pill {
            background: #fff;
            border-radius: 20px;
            padding: 8px 14px;
            border: 1px solid #e5e7eb;
            cursor: pointer;
        }

        .event-card {
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 8px 28px rgba(3, 39, 51, 0.08);
            overflow: hidden;
        }

        .event-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .tag {
            background: #E0F2F1;
            color: #00897B;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            display: inline-block;
            margin-right: 6px;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-light shadow-sm fixed-top">
        <div class="container">

            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="lg.png" style="width:80px;height:80px;object-fit:cover" alt="">
                <span style="font-family:Handlee, cursive; font-size:1.7rem; margin-left:6px">Community Connect</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="nav">

                <ul class="navbar-nav ms-3 me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="event.php">Events</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                </ul>

                <div class="d-flex gap-2">
                    <a href="signup.php" class="btn btn-outline-info btn-sm">Sign Up</a>
                    <a href="login.php" class="btn btn-outline-info btn-sm">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="event-page">

        <!-- HEADING + DISTRICT -->
        <div class="d-flex justify-content-between align-items-start mb-4">
            <div>
                <div class="title-lg">EVENTS</div>
                <p class="text-muted">Discover upcoming events near you</p>
            </div>

            <!-- DISTRICT DROPDOWN -->
            <form method="GET" action="event.php">
                <label class="small text-muted">District</label><br>
                <select name="district" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                    <option>Jalgaon</option>
                    <option>Pune</option>
                    <option selected>Mumbai</option>
                    <option>Nagpur</option>
                    <option>Thane</option>
                    <option>Nashik</option>
                    <option>Satara</option>
                    <option>Kolhapur</option>
                </select>
            </form>
        </div>

        <!-- SEARCH BAR -->
        <form class="mb-4 d-flex gap-2" method="GET" action="event.php">
            <input type="hidden" name="district" value="Mumbai">

            <div class="search-box flex-grow-1">
                <i class="bi bi-search text-muted"></i>
                <input type="search" name="q" placeholder="Search events...">
            </div>

            <button class="btn btn-outline-info filter-pill">Search</button>
        </form>

        <!-- FILTERS -->
        <div class="d-flex gap-2 mb-4 flex-wrap">
            <button type="submit" name="date" value="today" class="btn btn-outline-info filter-pill">Today</button>

            <button type="submit" name="category" value="education"
                class="btn btn-outline-info filter-pill">Education</button>

            <button type="submit" name="free" value="1" class="btn btn-outline-info filter-pill">Free</button>

            <button type="submit" name="nearby" value="1" class="btn btn-outline-info filter-pill">Nearby</button>
        </div>

        <!-- EVENT CARD -->
        <!-- EVENTS fetch karne ke liye php idhar likhna  -->
        <!--
          Server-side must do:
          if (events.length > 0) {
            for each event in events -> render ONE event card block (HTML below)
          } else {
            render the EMPTY-STATE block (HTML shown below)
          }
        -->

        <!-- === Event card TEMPLATE (repeat this block for each event on the server) === -->
        <div class="event-card mb-5">
            <div class="date-box ">
                {{ DATE }}<br>
                <small>{{ TIME }}</small>
            </div>
            <div class="photo-box mt-3 mb-3 pe-4">
                <!-- server: either render <img src="..."> or leave as empty placeholder -->
                <!-- Example: <img src="{{ IMAGE_URL }}" alt="{{ EVENT_NAME }}"> -->
                <!-- If you prefer no image, leave this empty and it will show neutral background -->
            </div>
            <div class="content-box">
                <div class="mb-2" style="font-weight:700">{{ EVENT_NAME }}</div>
                <div class="mb-2">{{ COMMUNITY_NAME }}</div>
                <div class="mb-2 text-muted" style="font: size 14px;">{{ EVENT_DISTRICT }}</div>
                <div class="text-muted mb-2" style="font-size:13px;">{{ EVENT_DESCRIPTION }}</div>
            </div>
            <div class="button-box">
                <button class="btn-outline-info filter-pill">Register</button>
            </div>
        </div>

        <!-- === EMPTY STATE: agar koi event nahi mila to yeh execute hoga WHEN events.length == 0 === -->
        <div class="empty-card text-center mb-4">
            <div style="font-size:48px;margin-bottom:12px;">📅</div>
            <h4>No events found in <strong><!-- insert selected district here --></strong></h4>
            <p class="text-muted">Try clearing filters or explore nearby districts.</p>
            <div class="d-flex justify-content-center mt-4">
                <a href="event.php" class="btn btn-outline-info filter-pill">Clear filters</a>
            </div>
        </div>

        <!-- LOAD MORE BUTTON -->
        <div class="text-center mt-4">
            <a href="#" class="btn btn-outline-info filter-pill">Load more</a>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="py-3 text-center">
        <div class="container">
            <p class="mb-1">© 2023-2025 Community-Connect, Inc.</p>
            <p class="mb-1">
                <a href="#" class="text-muted me-2">Privacy</a>
                <a href="#" class="text-muted">Terms</a>
            </p>
            <a href="#top" class="text-decoration-none">Back to top</a>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>