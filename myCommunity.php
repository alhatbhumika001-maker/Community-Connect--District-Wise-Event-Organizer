<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Created Community - Community Connect</title>

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Outfit:wght@400;600&display=swap"
        rel="stylesheet" />

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="userStyle.css">

    <!-- BOOTSTRAP ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
    /* ---------- Base ---------- */
    body {
        font-family: 'Outfit', sans-serif;
        background: #f8f9fa;
        color: #111827;
        margin: 0;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    /* ---------- Metrics Card ---------- */
    .metric {
        padding: 10px;
    }

    .metric-card {
        border-radius: 20px;
        padding: 18px;
        background: #ffffff;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
        transition: 0.25s ease;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 150px;
    }

    .metric-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.16);
    }

    .metric-top {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .metric-icon-box {
        width: 72px;
        height: 72px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 6px 14px rgba(123, 47, 247, 0.12);
        flex-shrink: 0;
        background: #fff;
    }

    .bi {
        font-size: 2rem;
        color: #8540f5;
    }

    .metric-title {
        font-size: 18px;
        font-weight: 700;
        color: #333;
        line-height: 1.05;
    }

    .metric-count {
        margin-top: 14px;
        font-size: 28px;
        font-weight: 800;
        color: #111827;
    }

    /* ---------- Community card ---------- */
    .community {
        width: 100%;
        border-radius: 12px;
        padding: 20px;
        background-color: #ffffff;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
        margin-bottom: 20px;
    }

    /* Banner container to keep consistent cropping */
    .com-banner {
        width: 100%;
        height: 160px;
        overflow: hidden;
        border-radius: 8px;
        margin-bottom: 12px;
        background: #efefef;
    }

    .com-banner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    h3 {
        font-size: 20px;
        margin: 8px 0 4px;
        color: #111827;
    }

    h4 {
        font-size: 14px;
        margin: 0 0 12px 0;
        color: #6b7280;
        font-weight: 500;
    }

    .request-box {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
        flex-wrap: wrap;
        /* allow wrap on small screens */
    }

    .request-box img {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
        background: #efefef;
        flex-shrink: 0;
    }

    .request-box .meta {
        min-width: 0;
        /* allows text to truncate/wrap nicely */
    }

    .request-box .meta p {
        margin: 0;
    }

    .request-box .meta .username {
        color: #6b7280;
        font-size: 14px;
    }

    /* place action buttons to the right when there is space */
    .request-actions {
        margin-left: auto;
        display: flex;
        gap: 8px;
    }

    /* Member list */
    .member {
        border-bottom: 1px solid #f1f3f5;
        padding-bottom: 12px;
        margin-bottom: 12px;
    }

    .member .user-logo {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
        background: #efefef;
    }

    .username {
        font-weight: 600;
    }

    /* Buttons container */
    .buttons .btn {
        margin-right: 8px;
    }

    /* Make the single centered button more tap-friendly on mobile */
    .buttons {
        margin-top: 12px;
    }

    /* ---------- Responsive tweaks ---------- */
    @media (max-width: 767.98px) {
        .metric-card {
            padding: 14px;
            min-height: 120px;
        }

        .metric-icon-box {
            width: 60px;
            height: 60px;
        }

        .metric-count {
            font-size: 22px;
        }

        .com-banner {
            height: 140px;
        }

        .community {
            padding: 16px;
        }
    }

    /* Very small screens - make action button full width and stack actions */
    @media (max-width: 420px) {
        .metric-icon-box {
            width: 56px;
            height: 56px;
        }

        .metric-count {
            font-size: 20px;
        }

        /* make request actions wrap nicely and be full width */
        .request-actions {
            width: 100%;
            gap: 8px;
            justify-content: flex-end;
        }

        .request-actions .btn {
            flex: 1 1 auto;
            /* allows them to share line width */
            min-width: 0;
        }

        /* center button but make it full width on very small devices */
        .buttons {
            display: flex;
            justify-content: center;
        }

        .buttons .btn {
            width: 100%;
            max-width: 320px;
        }
    }
    </style>
</head>

<body>

    <?php 
    include 'userHead.php'
    ?>

    <?php
    $active = 'exploreCommunity';
    include 'userNav.php';
    ?>


    <div class="container py-3">
        <div class="metric row g-4 mb-4">
            <!-- Total communities created by the user -->
            <div class="col-12 col-md-4">
                <div class="metric-card">
                    <div class="metric-top">
                        <div class="metric-icon-box">
                            <i class="bi bi-collection"></i>
                        </div>
                        <div class="metric-title">
                            Total Communities <br>
                            Created
                        </div>
                    </div>

                    <div class="metric-count">
                        {{Total_communities_created-by_user}}
                    </div>
                </div>
            </div>

            <!-- Total no. of members in community -->
            <div class="col-12 col-md-4">
                <div class="metric-card">
                    <div class="metric-top">
                        <div class="metric-icon-box">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="metric-title">Total Member<br>in the Community</div>
                    </div>

                    <div class="metric-count">
                        {{Total_communities_member}}
                    </div>
                </div>
            </div>

            <!-- No. of members joined in last week -->
            <div class="col-12 col-md-4">
                <div class="metric-card">
                    <div class="metric-top">
                        <div class="metric-icon-box">
                            <i class="bi bi-person-fill-add"></i>
                        </div>
                        <div class="metric-title">New Members<br>Joined last week</div>
                    </div>

                    <div class="metric-count">
                        {{Members_joined_in_last_week}}
                    </div>
                </div>
            </div>
        </div>

        <!-- If more than one has been created, loop should be created. -->
        <div class="community">
            <div class="com-banner" aria-hidden="true">
                <img src="com-banner.png" alt="Community banner">
            </div>

            <h3>
                Community name
            </h3>
            <h4>
                Date of creation
            </h4>

            <div>
                <h5>Manage</h5>
                <!-- The request section should only be visible for the private community. -->
                <h6>New requests:</h6>

                <!-- Loop this section for listing the request sent for joining the community -->
                <div class="request-box">
                    <img src="#" alt="Requester's avatar">
                    <div class="meta">
                        <p style="font-weight:600;margin:0;">Name</p>
                        <p class="username" style="margin:0;color:#6b7280;">@username</p>
                    </div>

                    <div class="request-actions">
                        <button class="btn btn-sm btn-outline-indigo">View Profile</button>
                        <button class="btn btn-sm btn-outline-indigo">Accept</button>
                    </div>
                </div>

                <h6>Members:</h6>
                <!-- Loop to get the members list -->
                <div class="member">
                    <div class="d-flex align-items-center">
                        <img class="user-logo" src="#" alt="member avatar">
                        <div class="ms-3">
                            <div class="username">
                                Member Name
                            </div>
                            <div style="color:#6b7280;font-size:13px;margin-top:4px;">Last active · 2d ago</div>
                        </div>
                    </div>
                </div>

                <div class="member">
                    <div class="d-flex align-items-center">
                        <img class="user-logo" src="#" alt="member avatar">
                        <div class="ms-3">
                            <div class="username">
                                Another Member
                            </div>
                            <div style="color:#6b7280;font-size:13px;margin-top:4px;">Last active · 5d ago</div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="buttons d-flex justify-content-center mt-3">
                <button class="btn btn-sm btn-outline-indigo">View Community</button>
            </div>
        </div>
    </div>
</body>

</html>