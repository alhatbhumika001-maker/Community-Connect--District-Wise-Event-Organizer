 <?php
$conn = mysqli_connect("localhost", "root", "", "community_connect");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL Query: fetch all events with community name
$event_query = "
    SELECT community_events.*, communities.community_name
    FROM community_events
    JOIN communities ON community_events.category = communities.id
    ORDER BY community_events.id DESC
";


$event_result = mysqli_query($conn, $event_query);

if (!$event_result) {
    die("SQL Error: " . mysqli_error($conn));
}

$event_count = mysqli_num_rows($event_result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events - Community Connect</title>
    <link rel="stylesheet" href="style.css"> 

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
            min-height: 120px;   /* smaller image */
            max-height: 120px;
        }
        .photo-box img {
            height: 120px;      /* fixed small height */
            object-fit: cover;
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

        /* GRID LAYOUT FOR SQUARE CARDS */
.event-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 25px;
    margin-top: 30px;
}

/* FULL SQUARE CARD */
.event-card-square {
    background: #ffffff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    transition: 0.3s;
}

.event-card-square:hover {
    transform: translateY(-4px);
}

/* IMAGE FIXED SQUARE STYLE */
.event-card-square img {
    width: 100%;
    height: 210px;
    object-fit: cover;
}

/* CONTENT AREA */
.event-content {
    padding: 10px;
}

.event-title {
    font-size: 20px;
    font-weight: 700;
}

.event-meta {
    font-size: 14px;
    color: #443e3eff;
}

.event-description {
    font-size: 14px;
    color: #392c2cff;
    margin-bottom: 10px;
}

.event-btn {
    text-align: right;
}
 span{

    font-size:15px;
    color:black;

 }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <?php
        $active = 'events';
        include 'mainNav.php';
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
            <form method="GET" action="event.php">
                <label class="small text-muted">District</label><br>
                <select name="district" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
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
        
<div class="event-grid">
    <?php while ($row = mysqli_fetch_assoc($event_result)) { ?>
        <div class="event-card-square" style="position: relative; display: flex; flex-direction: column;">

            <img src="<?php echo !empty($row['image']) ? $row['image'] : 'https://via.placeholder.com/300x210?text=No+Image'; ?>" alt="<?php echo $row['event_name']; ?>">

            <div class="event-content" style="flex: 1; padding-bottom: 50px;"> <!-- space for buttons -->

                <div class="event-title">
                    <?php echo $row['event_name']; ?>
                </div>

                <div class="event-meta">
                    <span>Community: </span> <?php echo $row['community_name']; ?>
                </div>

                <div class="event-meta">
                     <span>Date:</span> <?php echo date("d M Y", strtotime($row['date'])); ?><br>
                     <span>Time: </span><?php echo date("h:i A", strtotime($row['start_time'])); ?> | <?php echo $row['district']; ?>
                </div>

                <div class="event-description">
                    <?php 
                        $desc = strip_tags($row['about']);
                        if(strlen($desc) > 50) {
                            echo substr($desc, 0, 50) . "...";
                        } else {
                            echo str_pad($desc, 50, " ");
                        }
                    ?>
                </div>
            </div>

          
             <!-- BUTTONS FIXED AT BOTTOM RIGHT -->
            <div class="event-btn" style="position: absolute; bottom: 10px; left: 10px; display: flex; gap: 10px;">
                <a href="registerEvent.php?id=<?php echo $row['id'];?>" class="btn btn-outline-info">Register</a>
                <a href="viewEvent.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-secondary">View</a>
            </div>

           

        </div>
    <?php } ?>
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
    <?php include 'footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
