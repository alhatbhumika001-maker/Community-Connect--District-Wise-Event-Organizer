<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{Event-name}} - Community Connect</title>

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600&display=swap" rel="stylesheet">

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="userStyle.css">

    <!-- BOOTSTRAP ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
    body {
        font-family: 'Outfit', sans-serif;
        background: #f8f9f0;
        margin: 0;
    }

    /* Card container */
    .view-event {
        width: 100%;
        max-width: 650px;
        /* prevents too wide layouts on desktop */
        margin: 20px auto;
        padding: 20px;
        background-color: white;
        border-radius: 20px;
        box-shadow: 2px 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Poster box */
    .event-photo {
        width: 100%;
        height: 220px;
        border-radius: 10px;
        overflow: hidden;
        background-color: rgba(128, 128, 128, 0.3);
    }

    .event-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* Mobile Responsive Tweaks */
    @media (max-width: 576px) {
        .view-event {
            padding: 16px;
        }

        h3.event-name {
            font-size: 1.3rem;
        }

        h5.event-dateTime {
            font-size: 1.1rem;
        }

        .event-button button {
            width: 100%;
        }

        .back-to-explore button {
            width: 100%;
            margin-top: 10px;
        }
    }
    </style>

</head>

<body>

    <?php
    include 'userHead.php';
    ?>

    <?php
    include 'userNav.php';
    ?>

    <div class="view-event container-fluid mt-3 mb-3">
        <h3 class="event-name">
            {{Event Name}}
        </h3>

        <h5 class="event-dateTime">
            Date & Time
        </h5>

        <h6 class="event-district">
            Community Name • District
        </h6>

        <hr>

        <div class="event-photo mb-3">
            <img src="eventPoster.png" alt="Event Poster">
        </div>

        <p class="eve-description">
            {{Event Description (Detailed Information about Event)}}
        </p>

        <p class="eve-address">
            {{Event Address}}
        </p>

        <div class="event-button d-flex justify-content-end">
            <button class="btn btn-sm btn-outline-indigo px-4" type="button">
                Register
            </button>
        </div>
    </div>

    <div class="back-to-explore d-flex justify-content-end mb-4" style="max-width:650px; margin:auto;">
        <button class="btn btn-sm btn-outline-indigo px-4" type="button">
            Back to Explore Page
        </button>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>