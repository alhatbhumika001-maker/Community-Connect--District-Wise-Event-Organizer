<?php
    include 'userHead.php';
    $conn = new mysqli("localhost", "root", "", "community_connect");
    $q = 'select * from communities ORDER BY community_id DESC';
    $result=mysqli_query($conn,$q);
    $row= mysqli_num_rows($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Explore Community - Community Connect</title>

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Outfit:wght@400;600&display=swap"
        rel="stylesheet">

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="userStyle.css">

    <!-- BOOTSTRAP ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
    /* ========== Minimal, readable CSS (only what was needed) ========== */
    body {
        background: #f7f9fb;
        font-family: "Outfit", sans-serif;
        color: #111827;
    }

    /* ---------- METRIC CARD STYLES ---------- */
    .metric-card {
        border-radius: 20px;
        padding: 18px;
        background: #ffffff;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
        transition: 0.3s ease;
        display: flex;
        flex-direction: column;
        /* top row then count below */
        justify-content: space-between;
        min-height: 150px;
    }

    .metric-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.18);
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
        background: linear-gradient(135deg, #b388ff, #7b2ff7);
        box-shadow: 0 6px 14px rgba(123, 47, 247, 0.18);
        flex-shrink: 0;
    }

    .metric-icon {
        width: 44px;
        height: 44px;
        filter: brightness(0) invert(1);
        display: block;
    }

    .metric-title {
        font-size: 22px;
        font-weight: 700;
        color: #333;
        line-height: 1.05;
    }

    .metric-count {
        margin-top: 14px;
        font-size: 24px;
        font-weight: 800;
        color: #111827;
    }

    /* responsiveness for metrics */
    @media (max-width: 767.98px) {
        .metric-card {
            padding: 14px;
            min-height: 120px;
        }

        .metric-icon-box {
            width: 60px;
            height: 60px;
        }

        .metric-icon {
            width: 38px;
            height: 38px;
        }

        .metric-title {
            font-size: 16px;
        }

        .metric-count {
            font-size: 22px;
        }
    }

    /* Community card */
    .community-card {
        display: flex;
        gap: 0;
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        max-width: 1100px;
        width: 100%;
        box-shadow: 2px 4px 12px rgba(0, 0, 0, 0.2);
        margin-top: 35px;
    }

    .community-img {
        width: 33%;
        min-width: 220px;
        background: rgba(0, 0, 0, 0.06);
    }

    .community-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .community-info {
        padding: 20px;
        width: 67%;
        box-sizing: border-box;
    }

    /* Small screens: community card */
    @media (max-width: 767.98px) {
        .community-card {
            flex-direction: column;
        }

        .community-img {
            width: 100%;
            min-width: 0;
            height: 180px;
            border-radius: 20px 20px 0 0;
        }

        .community-info {
            width: 100%;
            padding: 14px;
        }
    }

    .page-title {
        font-size: 2.0rem;
        margin: 0 0 .25rem;
        font-weight: 600;
    }

    .page-sub {
        color: #6c757d;
        margin-bottom: .5rem;
    }

    .bi-emoji-frown {
        font-size: 48px;
        color: #8540f5;
        margin-bottom: 12px;
    }

    .form-control:focus,
    .form-select:focus,
    .btn:focus {
        outline: 3px solid rgba(133, 64, 245, 0.12);
        outline-offset: 2px;
        box-shadow: none;
    }
    </style>
</head>

<body>

    <?php
        $active = 'exploreCommunity';
        include 'userNav.php';
    ?>
    <main class="container py-4">

        <div class="d-flex justify-content-between align-items-start mb-4">
            <div class="page-heading">
                <h1 class="page-title">Explore Communities</h1>
                <div class="page-sub">Discover & join local groups — district-based suggestions shown below.</div>
            </div>

            <div class="d-flex align-items-center gap-2">
                <form method="GET" action="">
                    <label class="small text-muted mb-1 d-block">District</label>
                    <select name="district" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                        <?php
                        $districts = ["Jalgaon", "Pune", "Mumbai", "Nagpur", "Thane", "Nashik", "Satara", "Kolhapur"];
                        $selectedDistrict = $_SESSION['district'] ?? "";
                        foreach ($districts as $d) {
                            $sel = ($selectedDistrict == $d) ? 'selected' : '';
                            echo "<option value=\"{$d}\" {$sel}>{$d}</option>";
                        }
                        ?>
                    </select>
                </form>
            </div>
        </div>
        <!-- Metric Cards -->
        <div class="row g-4 mb-4">
            <!-- TOTAL COMMUNITIES -->
            <?php
            // Get total communities in website
            $totalCommunitiesQuery = "SELECT COUNT(*) AS total FROM communities";
            $totalResult = mysqli_query($conn, $totalCommunitiesQuery);
            $totalRow = mysqli_fetch_assoc($totalResult);
            $totalCommunities = $totalRow['total'];
        ?>

            <div class="col-12 col-md-4">
                <div class="metric-card">
                    <div class="metric-top">
                        <div class="metric-icon-box">
                            <img src="https://cdn-icons-png.flaticon.com/512/1250/1250678.png" class="metric-icon"
                                alt="communities icon">
                        </div>
                        <div class="metric-title">Total Communities<br>Joined Us</div>
                    </div>

                    <div class="metric-count">
                        Total Communities : <?php echo $totalCommunities; ?>
                    </div>
                </div>
            </div>

            <!-- COMMUNITIES IN DISTRICT -->
            <div class="col-12 col-md-4">
                <div class="metric-card">
                    <div class="metric-top">
                        <div class="metric-icon-box">
                            <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png" class="metric-icon"
                                alt="district icon">
                        </div>
                        <div class="metric-title">Total Communities<br>in Your District</div>
                    </div>

                    <div class="metric-count">
                        {{Total_communities_in_district}}
                    </div>
                </div>
            </div>

            <!-- JOINED COMMUNITIES -->
            <div class="col-12 col-md-4">
                <div class="metric-card">
                    <div class="metric-top">
                        <div class="metric-icon-box">
                            <img src="https://cdn-icons-png.flaticon.com/512/845/845646.png" class="metric-icon"
                                alt="joined icon">
                        </div>
                        <div class="metric-title">My Joined<br>Communities</div>
                    </div>

                    <div class="metric-count">
                        {{Joined_communities_by_user}}
                    </div>
                </div>
            </div>
        </div>

        <!-- Community card -->
        <?php
                    while($row= mysqli_fetch_assoc($result))
                    {
            ?>
        <div class="community-card mb-4">

            <div class="community-img">
                <!-- server-side image e.g. <img src="banner.jpg" alt="banner"> -->
                <img src="<?php echo $row['image']; ?>" alt="Community Image">



            </div>
            <div class="community-info">

                <div>

                    <h3 class="mb-1"><b>
                            <?php echo $row['community_name']; ?>
                    </h3>
                    <div class="text-muted mb-2">
                        Category: <?php echo $row['category']; ?>
                    </div>
                    <p class="text-muted mb-2">
                        <?php echo $row['privacy']; ?>
                    </p>
                    <div class="d-flex gap-2 small text-muted mb-2">
                        <div>Members:
                            <?php echo htmlspecialchars($example_members ?? '{{member_count}}'); ?>
                        </div>
                        <div>|</div>
                        <div>
                            <?php echo $row['district']; ?>
                        </div>
                    </div>
                    <div class="d-flex gap-2 small text-muted mb-2">
                        Date & Time: <?php echo $row['created_at']; ?>
                    </div>


                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="#" class="btn btn-outline-indigo btn-sm">View</a>
                    <form method="POST"
                        action="/communities/<?php echo htmlspecialchars($example_id ?? '{{id}}'); ?>/join"
                        style="display:inline;">
                        <button class="btn btn-outline-indigo btn-sm" type="submit">Join</button>
                    </form>
                </div>
            </div>
        </div>

        <?php
        
        
             }

        ?>

        <!-- empty state -->
        <div class="empty-card text-center mb-4">
            <div class="bi bi-emoji-frown" style="font-size:48px;color:#8540f5;margin-bottom:12px"></div>
            <h4>No communities found in your area</h4>
            <p class="text-muted">Try exploring other districts</p>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>