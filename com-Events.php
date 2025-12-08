<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{Community-Name}} - Community Connect</title>

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Outfit:wght@400;600&display=swap"
        rel="stylesheet">

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="userStyle.css">
    <link rel="stylesheet" href="comStyle.css">

    <!-- BOOTSTRAP ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Your custom CSS (kept) -->
    <link rel="stylesheet" href="comStyle.css" />

    <style>
    body {
        font-family: 'Outfit', sans-serif;
        background: #f8f9fa;
        color: #111827;
        margin: 0;
    }

    /* Small create button area (centered, small) */
    .create-event-wrap {
        text-align: center;
        margin-top: 12px;
        margin-bottom: 12px;
    }

    .create-event-btn {
        background: #8540f5;
        color: #fff;
        border-radius: 8px;
        padding: .35rem .8rem;
        font-weight: 600;
        font-size: .92rem;
        border: none;
    }

    /* Cards + event photo */
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 6px 18px rgba(31, 41, 55, 0.06);
        margin-bottom: 1rem;
        overflow: hidden;
    }

    .card-header {
        background: rgba(133, 64, 245, 0.06);
        padding: .9rem 1rem;
    }

    .card-header h5 {
        color: #8540f5;
        margin: 0;
        font-weight: 600;
        font-size: 1.05rem;
    }

    .card-header small {
        display: block;
        color: #6b7280;
        margin-top: .25rem;
    }

    .card-body {
        padding: 1rem;
    }

    .event-photo {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 6px;
        background: #efefef;
    }

    .bi-emoji-frown {
        font-size: 60px;
        color: #8540f5;
    }

    /* responsive */
    @media (max-width:768px) {
        .com-banner {
            height: 180px;
        }

        .event-photo {
            height: 140px;
        }

        .com-nav-ul {
            gap: .6rem;
            padding: 0 .5rem;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
    }

    /* small modal tweaks */
    .modal .form-label {
        font-weight: 600;
    }
    </style>
</head>

<body>

    <?php
    include 'userHead.php';
    ?>

    <?php
    include 'userHead.php';
    ?>

    <div class="container-fluid">

        <?php
        $active = 'com-Events';
        include 'comHead.php';
        ?>


        <div class="create-event-wrap">
            <!-- Show this button only to organizers — server should render conditionally.
           To hide by default, server can omit or output style="display:none". -->
            <button class="create-event-btn" data-bs-toggle="modal" data-bs-target="#createEventModal">
                + Create Post
            </button>
        </div>

        <!-- main inner container (keeps content centered) -->
        <div class="container page-inner mt-3">

            <div class="row gx-4">

                <!-- LEFT: Events column -->
                <div class="col-lg-8 col-12">
                    <!-- Simple event card with carousel -->
                    <div class="card">
                        <div class="card-header">
                            <h5>Sample Event Title</h5>
                            <small>June 10, 2025 — 6:00 PM</small>
                        </div>

                        <div class="card-body">
                            <!-- Bootstrap Carousel: keep only one .carousel-item in template.
                   Server/PHP will loop and output multiple .carousel-item blocks as needed. -->
                            <div id="eventCarousel123" class="carousel slide mb-3" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <!-- Repeat this block server-side for each image; first one must have 'active' -->
                                    <div class="carousel-item active">
                                        <img src="https://via.placeholder.com/1200x500?text=Event+Image+1"
                                            class="d-block w-100 event-photo" alt="event image">
                                    </div>
                                    <!-- Add Other photos through loop, if needed -->
                                </div>

                                <!-- controls for photos-->
                                <button class="carousel-control-prev" type="button" data-bs-target="#eventCarousel123"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#eventCarousel123"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>
                            </div>

                            <p class="card-text">Short description about the event. Location, quick highlights and what
                                to expect.</p>
                        </div>
                    </div>

                    <!-- divider -->
                    <hr class="dropdown-divider">

                    <!-- empty state example -->
                    <div class="empty-card text-center mb-4">
                        <div class="bi bi-emoji-frown"></div>
                        <h4 class="mt-2">No event conducted yet..</h4>
                    </div>
                </div>

                <!-- RIGHT: Members column -->
                <div class="col-lg-4 col-12">
                    <div class="card p-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img class="user-logo" src="#" alt="user-logo" width="48" height="48"
                                    style="border-radius:50%;background:#efefef;">
                                <div class="ms-3">
                                    <div class="username" style="font-weight:600;">Member Name</div>
                                </div>
                            </div>

                            <hr>

                            <div class="empty-card text-center mb-0">
                                <div class="bi bi-emoji-frown"></div>
                                <h6 class="mt-2 mb-0">No members yet..</h6>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ===== Create Event Modal (FRONTEND only) ===== -->
    <div class="modal fade" id="createEventModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <!-- NOTE: action="" so front-end only. Replace action and method to post to your backend later. -->
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Create Post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Event Title <span class="text-danger">*</span></label>
                            <input name="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Event Date & Time</label>
                            <input name="event_date" type="datetime-local" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Event Images (optional)</label>
                            <input name="images[]" type="file" class="form-control" accept="image/*" multiple>
                            <small class="text-muted">Choose multiple images. Server must handle uploads; this is
                                frontend-only.</small>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn" style="background:#8540f5;color:#fff;">Create Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- BOOTSTRAP JS BUNDLE -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>