<?php
include 'userHead.php';
?>
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

    <!-- Custom CSS -->
    <link rel="stylesheet" href="userStyle.css">

    <!-- BOOTSTRAP ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    /* Smooth Scroll */
    html {
        scroll-behavior: smooth;
    }

    body {
        font-family: "Outfit", sans-serif;
        background: #f6fbfb;
    }

    .event-page {
        max-width: 1100px;
        margin: 90px auto 40px;
        padding: 0 15px;
    }

    /* event card using flex */
    .event-card {
        display: flex;
        gap: 18px;
        align-items: stretch;
        padding: 18px;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 8px 28px rgba(3, 39, 51, 0.08);
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.03);
    }

    .event-left {
        flex: 0 0 120px;
        max-width: 140px;
        text-align: center;
        border-right: 1px dashed rgba(0, 0, 0, 0.04);
        padding-right: 12px;
    }

    .event-left .date {
        font-weight: 700;
        font-size: 18px;
    }

    .event-left small {
        color: #6b7280;
        display: block;
    }

    .event-right {
        flex: 1 1 0;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .photo-box {
        width: 100%;
        height: 200px;
        border-radius: 8px;
        overflow: hidden;
        background: #f2f2f2;
    }

    .photo-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .event-title {
        font-size: 20px;
        font-weight: 700;
    }

    .event-meta {
        color: #6b7280;
        font-size: 14px;
    }

    .event-desc {
        font-size: 14px;
        color: #374151;
    }

    .event-actions {
        display: flex;
        gap: 8px;
        justify-content: flex-end;
        margin-top: auto;
    }

    .filter-pill {
        background: #fff;
        border-radius: 20px;
        padding: 8px 14px;
        border: 1px solid #e5e7eb;
        cursor: pointer;
    }

    .btn-outline-indigo {
        color: #6c4ce0;
        border-color: rgba(108, 76, 224, 0.18);
        background: transparent;
    }

    .btn-outline-indigo:hover {
        background: rgba(108, 76, 224, 0.06);
        color: #4b2fc9;
    }

    /* SEARCH BAR */
    .input-group .form-control {
        border-radius: 999px;
        padding: 10px 16px;
        min-height: 44px;
        box-shadow: none;
    }

    .input-group .input-group-text {
        border-radius: 999px 0 0 999px;
        border: none;
        padding-left: 12px;
        padding-right: 8px;
        background: transparent;
    }

    .btn.rounded-pill {
        min-height: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        padding-left: 18px;
        padding-right: 18px;
    }

    /* Mobile: stack input and button */
    @media (max-width: 520px) {
        .input-group {
            flex-direction: column;
            gap: 8px;
        }

        .input-group .input-group-text {
            border-radius: 12px;
        }

        .input-group .form-control {
            border-radius: 12px;
        }

        .btn.rounded-pill {
            border-radius: 12px;
            width: 100%;
        }
    }

    @media (max-width: 900px) {
        .event-card {
            flex-direction: column;
            padding: 14px;
        }

        .event-left {
            border-right: none;
            border-bottom: 1px dashed rgba(0, 0, 0, 0.04);
            padding-bottom: 12px;
            text-align: left;
        }

        .photo-box {
            height: 180px;
        }
    }

    @media (max-width: 480px) {
        .photo-box {
            height: 140px;
        }
    }
    </style>
</head>

<body>

    <?php
    $active = 'exploreEvents';
    include 'userNav.php';
    ?>

    <!-- MAIN CONTENT -->
    <div class="event-page">

        <!-- HEADING + DISTRICT -->
        <div class="d-flex justify-content-between align-items-start mb-4">
            <div>
                <div class="title-lg">EVENTS</div>
                <p class="text-muted">Discover upcoming events near you</p>
            </div>

            <!-- DISTRICT DROPDOWN -->
            <form method="GET" action="volEvent.php">
                <label class="small text-muted mb-1">District</label><br>

                <select name="district" class="form-select form-select-sm w-auto" onchange="this.form.submit()">

                    <?php
                    $districts = ["Jalgaon", "Pune", "Mumbai", "Nagpur", "Thane", "Nashik", "Satara", "Kolhapur"];
                    $selectedDistrict = $_SESSION['district'] ?? "";
                    ?>

                    <?php foreach ($districts as $d): ?>
                    <option value="<?= $d ?>" <?= ($selectedDistrict == $d) ? "selected" : "" ?>>
                        <?= $d ?>
                    </option>
                    <?php endforeach; ?>

                </select>
            </form>

        </div>

        <!-- SEARCH BAR -->
        <form class="mb-4" method="GET" action="event.php">
            <input type="hidden" name="district" value="Mumbai">

            <div class="d-flex gap-2">
                <div class="input-group flex-grow-1" style="min-width:220px; max-width:900px;">
                    <span class="input-group-text bg-white" id="search-icon">
                        <i class="bi bi-search text-muted"></i>
                    </span>

                    <input class="form-control shadow-none" type="search" name="q" placeholder="Search events..."
                        aria-label="Search events" aria-describedby="search-icon" />

                    <button class="btn btn-sm btn-outline-indigo ms-2 rounded-pill" type="submit">Search</button>
                </div>
            </div>
        </form>

        <!-- FILTERS -->
        <div class="d-flex gap-2 mb-4 flex-wrap">
            <button type="submit" name="date" value="today" class="btn btn-outline-indigo filter-pill">Today</button>

            <button type="submit" name="category" value="education"
                class="btn btn-outline-indigo filter-pill">Education</button>

            <button type="submit" name="free" value="1" class="btn btn-outline-indigo filter-pill">Free</button>

            <button type="submit" name="nearby" value="1" class="btn btn-outline-indigo filter-pill">Nearby</button>
        </div>

        <!-- EVENT CARD (repeat this block for each event) -->
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
            <div class="event-left">
                <div class="date">20 Dec</div>
                <small>09:30 AM</small>
            </div>
            <div class="event-right">
                <div class="photo-box mt-3 mb-3">
                    <!-- server: either render <img src="..."> or leave as empty placeholder -->
                    <!-- Example: <img src="{{ IMAGE_URL }}" alt="{{ EVENT_NAME }}"> -->
                    <!-- If you prefer no image, leave this empty and it will show neutral background -->
                    <div class="d-flex align-items-center justify-content-center h-100"><i class="bi bi-calendar-event"
                            style="font-size:48px;color:#d1d5db"></i></div>
                </div>
                <div>
                    <div class="event-title">{{ EVENT_NAME }}</div>
                    <div class="event-meta">{{ COMMUNITY_NAME }} • {{ EVENT_DISTRICT }}</div>
                    <div class="event-desc mt-2">{{ EVENT_DESCRIPTION }}</div>
                </div>

                <div class="event-actions">
                    <a href="viewEvent.php?id={{ ID }}" class="btn btn-sm btn-outline-indigo">View Event</a>
                    <a href="registerEvent.php?id={{ ID }}" class="btn btn-sm btn-primary text-white">Register</a>
                </div>
            </div>
        </div>

        <!-- === END template === -->

        <!-- === EMPTY STATE: agar koi event nahi mila to yeh execute hoga WHEN events.length == 0 === -->
        <div class="empty-card text-center mb-4">
            <div style="font-size:48px;margin-bottom:12px;">📅</div>
            <h4>No events found in <strong>
                    <!-- insert selected district here -->
                </strong></h4>
            <p class="text-muted">Try clearing filters or explore nearby districts.</p>
            <div class="d-flex justify-content-center mt-4">
                <a href="volEvent.php" class="btn btn-outline-indigo filter-pill">Clear filters</a>
            </div>
        </div>
        <!-- === END EMPTY === -->

        <!-- LOAD MORE BUTTON -->
        <div class="text-center mt-4">
            <a href="#" class="btn btn-outline-indigo filter-pill">Load more</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>