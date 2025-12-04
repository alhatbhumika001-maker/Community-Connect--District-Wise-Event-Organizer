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
    <link rel="stylesheet" href="volStyle.css">

    <!-- BOOTSTRAP ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        /* ========== Minimal, readable CSS (only what was needed) ========== */
        body {
            background: #f7f9fb;
            font-family: "Outfit", sans-serif;
            color: #111827;
        }

        /* Metric cards */
        .card {
            background: #fff;
            border: 0;
            border-radius: 20px;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.08);
            transition: transform .2s;
        }

        .card:hover {
            transform: translateY(-6px);
        }

        /* Community card (responsive) - small clean rules */
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

        /* ========== SEARCH: full-width on large screens, responsive on small ========== */
        .search-full {
            width: 100%;
            margin-bottom: 1rem;
            display: flex !important;
        }

        .search-full .input-group {
            width: 100%;
            align-items: center;
        }

        .search-full .form-control {
            flex: 1 1 auto;
            min-width: 220px;
            border-radius: 0;
        }

        .search-full .form-select {
            flex: 0 0 170px;
            max-width: 220px;
            margin-left: 10px;
        }

        .search-full .btn {
            flex: 0 0 auto;
            margin-left: 10px;
        }

        /* Input group */
        .input-group .input-group-text {
            background: #fff;
            border-right: 0;
            color: #8540f5;
            padding: .35rem .6rem;
            border-radius: .5rem 0 0 .5rem;
        }

        .input-group .form-control {
            border-left: 0;
            border-radius: 0 .5rem .5rem 0;
        }

        .input-group .form-select {
            border-left: 0;
        }

        /* remove any leftover rule that made the icon giant */
        .bi-search {
            font-size: 12px;
        }

        /* Small screens: wrap & stack controls */
        @media (max-width:767.98px) {
            .search-full .input-group {
                flex-wrap: wrap;
                gap: 8px;
            }

            .search-full .form-select,
            .search-full .btn {
                width: 100%;
                flex-basis: 100%;
                max-width: 100%;
            }

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

        /* small visual helpers kept very small */
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

        /* focus outline for accessibility */
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

    <?php include 'volHead.php'; ?>
    <?php 
        $active = 'community';
        include 'volNav.php';
    ?>

    <!-- ========== MAIN CONTENT (kept your structure) ========== -->
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

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="text-muted">Total Communities that Joined Us</h6>
                        <div class="h5 mb-0">{{Total_communities_in_website}}</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="text-muted">Total Communities in your District</h6>
                        <div class="h5 mb-0">{{Total_communities_in_district}}</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="text-muted">My Joined Communities</h6>
                        <div class="h5 mb-0">{{Joined_communities_by_user}}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========== SEARCH (FULL WIDTH on large screens) ========== -->
        <div class="search-full">
            <form method="GET" action="#" class="w-100">
                <div class="input-group input-group-sm">
                    <span class="input-group-text" aria-hidden="true"><i class="bi bi-search"></i></span>
                    <input name="q" type="text" class="form-control" placeholder="Search communities, tags..."
                        aria-label="Search">
                    <select name="sort" class="form-select ms-3">
                        <option value="active">Most Active</option>
                        <option value="new">Newest</option>
                    </select>
                    <button class="btn btn-outline-indigo ms-3" type="submit">Apply</button>
                </div>
            </form>
        </div>

        <!-- ========== ONE COMMUNITY CARD (server will loop this part) ========== -->
        <div class="community-card mb-4">
            <div class="community-img">
                <!-- server-side image e.g. <img src="banner.jpg" alt="banner"> -->
            </div>
            <div class="community-info">
                <div>
                    <h3 class="mb-1"><b>{{community_name}}</b></h3>
                    <div class="text-muted mb-2">{{community_district}}</div>
                    <p class="text-muted mb-2">{{community_description}}</p>
                    <div class="d-flex gap-2 small text-muted mb-2">
                        <div>Members: {{member_count}}</div>
                        <div>|</div>
                        <div>{{public/private}}</div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="#" class="btn btn-outline-indigo btn-sm">View</a>
                    <form method="POST" action="/communities/{{id}}/join" style="display:inline;">
                        <button class="btn btn-outline-indigo btn-sm" type="submit">Join</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- empty state -->
        <div class="empty-card text-center mb-4">
            <div class="bi bi-emoji-frown" style="font-size:48px;color:#8540f5;margin-bottom:12px"></div>
            <h4>No communities found in your area</h4>
            <p class="text-muted">Try exploring other districts</p>
        </div>

    </main>
</body>

</html>