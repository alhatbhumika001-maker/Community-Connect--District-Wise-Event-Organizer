<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Created Event - Community Connect</title>
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Outfit:wght@400;600&display=swap"
        rel="stylesheet">

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="userStyle.css" />

    <!-- BOOTSTRAP ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
    body {
        font-family: 'Outfit', sans-serif;
        background-color: #f8f9fa;
    }

    .metric-card {
        background: #ffffff;
        border-radius: 10px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
        transition: transform 0.15s ease;
    }

    .metric-card:hover {
        transform: translateY(-3px);
    }

    .metric-title {
        font-size: 25px;
        font-weight: 600;
        color: #374151;
    }

    .metric-value {
        font-size: 30px;
        font-weight: 700;
        color: #111827;
    }

    .metric-desc {
        font-size: 15px;
        color: #6b7280;
    }

    .metric-icon {
        font-size: 30px;
        color: #8540f5;
        /* Indigo tone */
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

    .bi-emoji-neutral {
        color: #8540f5;
        font-size: 80px;
        margin-bottom: 20px;
    }
    </style>
</head>

<body>
    <?php include 'userHead.php'; ?>
    <?php $active = 'myEvent';
    include 'userNav.html'; ?>
    <div class="container-fluid mt-5 d-flex flex-column align-items-center">
        <div class="container mt-4 mb-2">
            <h2 class="fw-bold mb-3">My Created Events Dashboard</h2>
        </div>

        <!-- show this if the user has created events -->
        <!-- METRIC CARDS SECTION -->
        <div class="container mb-4">
            <div class="row g-3 justify-content-center mb-3">

                <!-- CARD 1 -->
                <div class="col-12 col-md-4">
                    <div class="metric-card p-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-calendar-event metric-icon"></i>
                            <span class="metric-title">Total Events</span>
                        </div>
                        <div class="metric-value">
                            <?= $total_events ?? 0 ?>
                        </div>
                        <div class="metric-desc">Events you have organized</div>
                    </div>
                </div>

                <!-- CARD 2 -->
                <div class="col-12 col-md-4">
                    <div class="metric-card p-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-people metric-icon"></i>
                            <span class="metric-title">Registrations</span>
                        </div>
                        <div class="metric-value">
                            <?= $total_registrations ?? 0 ?>
                        </div>
                        <div class="metric-desc">Total participant registrations</div>
                    </div>
                </div>

                <!-- CARD 3 -->
                <div class="col-12 col-md-4">
                    <div class="metric-card p-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-clock-history metric-icon"></i>
                            <span class="metric-title">Upcoming</span>
                        </div>
                        <div class="metric-value">
                            <?= $upcoming_events ?? 0 ?>
                        </div>
                        <div class="metric-desc">Happening soon</div>
                    </div>
                </div>

            </div>
        </div>

        <div class="event-card mt-3 mb-4">
            <div class="date-box ">
                {{ DATE }}<br>
                <small>{{ TIME }}</small>
            </div>
            <div class="photo-box mt-3 mb-3">
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
        </div>

        <!-- === EMPTY STATE: agar koi event nahi mila to yeh execute hoga WHEN events.length == 0  -->
        <div class="empty-card text-center mb-4">
            <div><i class="bi bi-emoji-neutral"></i></div>
            <h4>No events found</h4>
            <!-- if the user has not created any community yet, First make them create a community. Then only allow them to create events. -->
            <p class="text-muted">Create Your First Event here.</p>
            <div class="d-flex justify-content-center mt-4">
                <a href="createEvent.php" class="btn btn-outline-indigo filter-pill">Create Event</a>
            </div>
        </div>
        <!-- === END EMPTY === -->

        <!-- LOAD MORE BUTTON -->
        <div class="text-center mt-4">
            <a href="#" class="btn btn-outline-indigo filter-pill">Load more</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>