<?php
$conn = mysqli_connect("localhost", "root", "", "community_connect");
if (!$conn) {
    die("Database connection failed");
}

/* LIKE POST */
if (isset($_POST['like_id'])) {
    $id = (int)$_POST['like_id'];
    mysqli_query($conn, "UPDATE posts SET likes = likes + 1 WHERE id = $id");

    $res = mysqli_query($conn, "SELECT likes FROM posts WHERE id = $id");
    $row = mysqli_fetch_assoc($res);
    echo $row['likes'];
    exit;
}

/* ADD COMMENT */
/* ADD COMMENT */
if (isset($_POST['comment_text'], $_POST['post_id'])) {

    $post_id = (int)$_POST['post_id'];
    $comment = mysqli_real_escape_string($conn, $_POST['comment_text']);

    // temporary user_id & community_id (until login system)
    $user_id = 1;
    $community_id = 1;

    mysqli_query(
        $conn,
        "INSERT INTO comments (post_id, user_id, community_id, content)
         VALUES ($post_id, $user_id, $community_id, '$comment')"
    );

    mysqli_query(
        $conn,
        "UPDATE posts SET comments = comments + 1 WHERE id = $post_id"
    );

    echo "ok";
    exit;
}

// SQL Query: fetch all events with community name
$event_query = "
    SELECT community_events.*, communities.community_name 
    FROM community_events 
    JOIN communities ON community_events.community = communities.id
    ORDER BY community_events.id DESC limit 3
";

$event_result = mysqli_query($conn, $event_query);

?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Community Connect - Home</title>

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Huninn&family=Outfit:wght@100..900&display=swap"
        rel="stylesheet">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom CSS  -->
    <link rel="stylesheet" href="style.css">

    <style>
    html {
        scroll-behavior: smooth;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: "Outfit", sans-serif;
    }

    .hero {
        margin-top: 1px;
    }

    .hero-img {
        width: 100%;
        height: 80vh;
        object-fit: cover;
    }


    /* HERO CONTENT */
    .hero-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: #fff;
        z-index: 2;
        width: 90%;
        max-width: 900px;
    }

    .hero-content h1 {
        font-size: 1.9rem;
        font-weight: 700;
        text-shadow: 0 5px 15px rgba(0, 0, 0, 0.45);
    }

    .hero-content p {
        font-size: 1rem;
        margin-bottom: 1rem;
    }

    @media(max-width:768px) {
        .hero-content h1 {
            font-size: 1.4rem;
        }

        .hero-content p {
            font-size: .9rem;
        }
    }

    /* SECTION TITLE */
    .section-title {
        font-size: 30px;
        font-weight: 700;
        text-align: center;
        margin: 3rem 0 2rem;
    }

    .feature-content {
        font-size: 1.1rem;
        line-height: 1.65;
        color: #444;
    }

    .feature-title {
        font-size: 1.4rem;
        font-weight: 600;
    }

    /* SOCIAL MEDIA POST CARD */
    .social-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: 0.3s ease;
        height: 100%;
    }

    .social-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 45px rgba(0, 0, 0, 0.15);
    }

    /* HEADER */
    .social-header {
        display: flex;
        gap: 12px;
        align-items: center;
        padding: 15px;
    }

    .social-header small {
        color: #777;
    }

    .avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
    }

    /* IMAGE */
    .social-img {
        width: 100%;
        height: 230px;
        background: #f1f3f5;
        object-fit: cover;
    }

    .social-img span {
        font-size: 1rem;
        letter-spacing: 0.5px;
    }

    /* BODY */
    .social-body {
        padding: 15px;
        font-size: 20px;
        color: #333;

    }

    /* ACTIONS */
    .social-actions {
        display: flex;
        justify-content: space-between;
        padding: 10px 15px;
        border-top: 1px solid #eee;
    }

    .social-actions button {
        border: none;
        background: none;
        font-size: 0.95rem;
        cursor: pointer;
        color: #555;
    }

    .social-actions button:hover {
        color: #0d6efd;
    }

    /* COMMENTS */
    .social-comments {
        padding: 10px 15px;
        background: #f9f9f9;
    }

    .social-comments .comment {
        font-size: 0.85rem;
        margin-bottom: 6px;
    }

    .social-comments input {
        width: 100%;
        padding: 6px 10px;
        border-radius: 20px;
        border: 1px solid #ddd;
        font-size: 0.85rem;
    }

    /* FEEDBACK SECTION */
    .feedback-card {
        background: #fff;
        border-radius: 18px;
        padding: 20px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
        transition: 0.3s ease;
        height: 100%;
    }

    .feedback-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 45px rgba(0, 0, 0, 0.15);
    }

    .feedback-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }

    .feedback-header img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }

    .feedback-header h6 {
        margin: 0;
        font-weight: 600;
    }

    .feedback-header small {
        color: #777;
    }

    .feedback-card p {
        font-size: 0.95rem;
        color: #444;
        line-height: 1.6;
    }

    .stars {
        margin-top: 10px;
        font-size: 1.1rem;
        color: #ffc107;
    }

    /* PREMIUM FEEDBACK SECTION */
    .feedback-section {
        background: linear-gradient(135deg, #0d6efd, #0dcaf0);
        position: relative;
        overflow: hidden;
    }

    .feedback-glass {
        position: relative;
        height: 100%;
        padding: 25px;
        border-radius: 22px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(12px);
        color: #fff;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
        transition: all 0.4s ease;
    }

    .feedback-glass::before {
        content: "";
        position: absolute;
        inset: 0;
        border-radius: 22px;
        padding: 2px;
        background: linear-gradient(135deg, #ffffff66, #ffffff10);
        -webkit-mask:
            linear-gradient(#fff 0 0) content-box,
            linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
    }

    .feedback-glass:hover {
        transform: translateY(-15px) scale(1.05);
        box-shadow: 0 35px 60px rgba(0, 0, 0, 0.45);
    }

    .feedback-glass.active {
        transform: scale(1.08);
    }

    /* QUOTE ICON */
    .quote {
        position: absolute;
        top: -20px;
        right: 20px;
        font-size: 6rem;
        opacity: 0.15;
        font-family: serif;
    }

    /* USER INFO */
    .user-info {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 15px;
    }

    .user-info img {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        border: 3px solid rgba(255, 255, 255, 0.6);
    }

    .user-info h6 {
        margin: 0;
        font-weight: 700;
    }

    .user-info small {
        opacity: 0.85;
    }

    /* TEXT */
    .feedback-glass p {
        font-size: 0.95rem;
        line-height: 1.7;
        opacity: 0.95;
    }

    /* STARS */
    .stars {
        margin-top: 15px;
        font-size: 1.2rem;
        color: #ffd43b;
        letter-spacing: 2px;
    }

    /* MOBILE */
    @media(max-width:768px) {
        .feedback-glass.active {
            transform: none;
        }
    }

    /* Glass Card Design */
    .glass-card {
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        backdrop-filter: blur(8px) saturate(180%);
        background-color: rgba(255, 255, 255, 0.1);
        transition: transform 0.4s ease, box-shadow 0.4s ease;
    }

    .glass-card:hover {
        transform: translateY(-15px) scale(1.05);
        box-shadow: 0 30px 50px rgba(0, 0, 0, 0.3);
    }

    .card-img-wrapper {
        position: relative;
    }

    .card-img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .glass-card:hover .card-img {
        transform: scale(1.15) rotate(1deg);
    }



    .card-body {
        position: relative;
        top: -60px;
        z-index: 2;
    }

    .card-title {
        font-size: 1.45rem;
        text-shadow: 1px 2px 8px rgba(0, 0, 0, 0.5);
    }

    .card-text {
        font-size: 1rem;
        color: #f1f1f1;
    }

    .btn-outline-light {
        border-width: 2px;
        transition: all 0.3s ease;
    }

    .btn-outline-light:hover {
        background-color: rgba(255, 255, 255, 0.25);
        color: #fff;
    }

    @media(max-width:768px) {
        .card-img {
            height: 200px;
        }

        .card-body {
            top: -50px;
        }
    }

    .card {
        transition: 0.3s ease;
    }

    .card:hover {
        transform: translateY(-8px);
    }

    /* LIGHT FEEDBACK SECTION */
    .feedback-light {
        background: #f8f9fc;
    }

    /* CARD */
    .feedback-soft {
        position: relative;
        height: 100%;
        padding: 25px;
        border-radius: 20px;
        background: #ffffff;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.35s ease;
    }

    .feedback-soft:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 45px rgba(0, 0, 0, 0.12);
    }

    /* Highlight middle card */
    .feedback-soft.highlight {
        border: 2px solid #e9f0ff;
    }

    /* QUOTE */
    .quote-soft {
        position: absolute;
        top: -20px;
        right: 20px;
        font-size: 5rem;
        color: #e9ecef;
        font-family: serif;
    }

    /* USER */
    .user-info {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 15px;
    }

    .user-info img {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: #eee;
    }

    .user-info h6 {
        margin: 0;
        font-weight: 600;
        color: #333;
    }

    /* TEXT */
    .feedback-soft p {
        font-size: 0.95rem;
        color: #555;
        line-height: 1.7;
    }

    /* STARS */
    .stars-soft {
        margin-top: 15px;
        font-size: 1.1rem;
        color: #f4c430;
        letter-spacing: 2px;
    }

    .about-text {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        /* kitni lines dikhani hain */
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* UPCOMING EVENTS FIX */
    .event-card {
        overflow: hidden;
        border-radius: 12px;
    }

    .event-img {
        height: 210px;
        object-fit: cover;
    }

    .event-card .card-body {
        position: static !important;
        /* glass-card bug fix */
        top: 0 !important;
        background: #fff;
    }

    .event-about {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        /* same height text */
        -webkit-box-orient: vertical;
        overflow: hidden;
        font-weight: 500;
    }

    #e_name {
        font-size: 20px;
    }

    .impact-icon {
        font-size: 2.6rem;
        display: inline-block;
    }

    .post-text {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        /* yahan 2 ya 3 set kar sakte ho */
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <?php
    $active = 'home';
    include 'mainNav.php';
    ?>

    <!-- HERO CAROUSEL -->
    <header>
        <div id="heroCarousel" class="carousel slide carousel-fade hero" data-bs-ride="carousel">

            <div class="carousel-inner">

                <!-- Slide 1 -->
                <div class="carousel-item active position-relative">
                    <img src="image/sl1.png" class="hero-img">
                    <div class="hero-overlay"></div>
                    <div class="hero-content">
                        <h1 style="color:black; margin-top:0px; ">Welcome To Community Connect</h1>
                        <p style="color:black; margin-bottom:30px">Building stronger districts through collective
                            action.</p>
                        <a href="event.php" class="btn btn-info btn-sm px-4  " style="margin-bottom:150px">Find
                            Events</a>
                    </div>
                </div>


                <!-- Slide 2 -->
                <div class="carousel-item position-relative">
                    <img src="image/sl2.png" class="hero-img">
                    <div class="hero-overlay"></div>
                    <div class="hero-content">
                        <h1 style="color:black; margin-top:0px;">Join Local Social Service Events</h1>
                        <p style="color:black; margin-bottom:30px">Volunteer, contribute, and make an impact in your
                            district.</p>
                        <a href="event.php" class="btn btn-info btn-sm px-4  " style="margin-bottom:150px">Find
                            Events</a>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item position-relative">
                    <img src="image/slider.png" class="hero-img">
                    <div class="hero-overlay"></div>
                    <div class="hero-content">



                        <h1 style="color:black; margin-top:0px;">Together We Make a Difference</h1>
                        <p style="color:black; margin-bottom:30px">Empowering communities through shared action.</p>
                        <a href="create-event.php" class="btn btn-info btn-sm px-4" style=" margin-bottom:130px">Create
                            Event</a>
                    </div>
                </div>

            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>

        </div>
    </header>

    <!-- HOW IT WORKS SECTION -->
    <main class="py-5">
        <div class="container">
            <h2 class="section-title">How It Works</h2>

            <div class="row g-4 mt-4">
                <!-- Card 1 -->
                <div class="col-md-4">
                    <div class="card glass-card h-100 border-0 text-white">
                        <div class="card-img-wrapper">
                            <img src="h1.jpg" class="card-img rounded" alt="Connect">
                            <div class="card-overlay"></div>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold" style="color:black; margin-top:60px">Connect</h5>
                            <p class="card-text" style="color:black; margin-top:30px">
                                Discover meaningful events and causes happening in your district.
                            </p>
                            <a href="#" class="btn btn-success btn-lg"
                                style="background-color:#0d6efd; border:none; color:#fff;">
                                Learn More
                            </a>
                        </div>

                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-4">
                    <div class="card glass-card h-100 border-0 text-white">
                        <div class="card-img-wrapper">
                            <img src="h2.jpg" class="card-img rounded" alt="Participate">
                            <div class="card-overlay"></div>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold" style="color:black; margin-top:60px">Participate</h5>
                            <p class="card-text" style="color:black; margin-top:30px">
                                Join volunteering activities and social service initiatives.
                            </p>
                            <a href="#" class="btn btn-success btn-lg">Join Now</a>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-md-4">
                    <div class="card glass-card h-100 border-0 text-white">
                        <div class="card-img-wrapper">
                            <img src="h3.jpg" class="card-img rounded" alt="Organize">
                            <div class="card-overlay"></div>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold" style="color:black; margin-top:60px">Organize</h5>
                            <p class="card-text" style="color:black; margin-top:30px">
                                Create and manage events easily within your community.
                            </p>
                            <a href="#" class="btn btn-success btn-lg">Create Event</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- COMMUNITY POSTS -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title">Community Feed</h2>

            <div class="row g-4">


                <?php
                $posts = mysqli_query(
                    $conn,
                    "SELECT * FROM posts ORDER BY created_at DESC LIMIT 3"
                );

                while ($post = mysqli_fetch_assoc($posts)) {
                ?>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="social-card">

                        <!-- HEADER -->
                        <div class="social-header">
                            <img src="https://ui-avatars.com/api/?name=User&background=0d6efd&color=fff" class="avatar">
                            <div>
                                <strong>Community Member</strong><br>
                                <small><?php echo date('d M Y', strtotime($post['created_at'])); ?></small>
                            </div>
                        </div>

                        <!-- IMAGE -->
                        <?php if (!empty($post['post'])) { ?>
                        <img src="<?php echo $post['post']; ?>" class="social-img">
                        <?php } else { ?>
                        <div class="social-img d-flex align-items-center justify-content-center">
                            <span class="text-muted fw-semibold">Community Connect</span>
                        </div>
                        <?php } ?>


                        <!-- BODY -->
                        <div class="social-body">
                            <p class="post-text"><?php echo $post['content']; ?></p>
                        </div>

                        <!-- ACTIONS -->
                        <div class="social-actions">
                            <button onclick="likePost(<?php echo $post['id']; ?>)">
                                ❤️ <span id="like-<?php echo $post['id']; ?>">
                                    <?php echo $post['likes']; ?>
                                </span>
                            </button>

                            <button onclick="toggleComments(<?php echo $post['id']; ?>)">
                                💬 <?php echo $post['comments']; ?>
                            </button>
                        </div>

                        <!-- COMMENTS -->
                        <div id="comments-<?php echo $post['id']; ?>" class="social-comments" style="display:none">
                            <?php
                                $comments = mysqli_query(
                                    $conn,
                                    "SELECT * FROM comments WHERE post_id = {$post['id']} ORDER BY created_at DESC"
                                );
                                while ($c = mysqli_fetch_assoc($comments)) {
                                ?>
                            <div class="comment">
                                <strong>User:</strong> <?php echo htmlspecialchars($c['content']); ?>
                            </div>
                            <?php } ?>

                            <form onsubmit="return addComment(event, <?php echo $post['id']; ?>)">
                                <input type="text" placeholder="Write a comment..." required>
                            </form>
                        </div>

                    </div>
                </div>

                <?php } ?>

            </div>
        </div>
        </div>
    </section>




    <!-- Optional: Bootstrap Icons CDN for icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- COMMUNITY STATS SECTION -->
    <section class="py-5 bg-light">
        <div class="container" style="margin-bottom:-60px;">
            <h2 class="section-title" style="margin-bottom:20px;">Our Community Impact</h2>

            <div class="row text-center mt-4">

                <div class="col-md-3 col-6 mb-4">
                    <i class="bi bi-calendar-event-fill impact-icon text-primary"></i>
                    <h1 class="fw-bold text-primary mt-2">120+</h1>
                    <p class="text-muted">Events Organized</p>
                </div>

                <div class="col-md-3 col-6 mb-4">
                    <i class="bi bi-people-fill impact-icon text-success"></i>
                    <h1 class="fw-bold text-success mt-2">500+</h1>
                    <p class="text-muted">Volunteers</p>
                </div>

                <div class="col-md-3 col-6 mb-4">
                    <i class="bi bi-buildings-fill impact-icon text-warning"></i>
                    <h1 class="fw-bold text-warning mt-2">50+</h1>
                    <p class="text-muted">Communities</p>
                </div>

                <div class="col-md-3 col-6 mb-4">
                    <i class="bi bi-heart-fill impact-icon text-danger"></i>
                    <h1 class="fw-bold text-danger mt-2">10K+</h1>
                    <p class="text-muted">Lives Impacted</p>
                </div>

            </div>
        </div>
    </section>


    <!-- TESTIMONIAL SECTION -->
    <section class="py-5 feedback-light">
        <div class="container">
            <h2 class="section-title">What Our Community Members Says</h2>
            <p class="text-center text-muted mb-5" style="font-size:17px; margin-top:-17px;">
                Real experiences from people who make a difference.
            </p>

            <div class="row g-4">

                <!-- Feedback Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="feedback-soft">
                        <span class="quote-soft">“</span>

                        <div class="user-info">
                            <img src="https://ui-avatars.com/api/?name=Rahul+Patil&background=e9f0ff&color=0d6efd">
                            <div>
                                <h6>Rahul Patil</h6>
                                <small class="text-muted">Volunteer</small>
                            </div>
                        </div>

                        <p>
                            Community Connect helped me take part in meaningful social
                            activities. It feels positive and inspiring.
                        </p>

                        <div class="stars-soft">★★★★★</div>
                    </div>
                </div>

                <!-- Feedback Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="feedback-soft highlight">
                        <span class="quote-soft">“</span>

                        <div class="user-info">
                            <img src="https://ui-avatars.com/api/?name=Pooja+Deshmukh&background=e6fff5&color=198754">
                            <div>
                                <h6>Pooja Deshmukh</h6>
                                <small class="text-muted">Event Organizer</small>
                            </div>
                        </div>

                        <p>
                            Organizing events is so smooth now. The interface is clean,
                            friendly, and easy to use.
                        </p>

                        <div class="stars-soft">★★★★★</div>
                    </div>
                </div>

                <!-- Feedback Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="feedback-soft">
                        <span class="quote-soft">“</span>

                        <div class="user-info">
                            <img src="https://ui-avatars.com/api/?name=Amit+Kulkarni&background=fff4e6&color=fd7e14">
                            <div>
                                <h6>Amit Kulkarni</h6>
                                <small class="text-muted">Community Member</small>
                            </div>
                        </div>

                        <p>
                            A great platform that truly connects people for social
                            causes. Everything feels professional.
                        </p>

                        <div class="stars-soft">★★★★☆</div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- UPCOMING EVENTS PREVIEW -->
    <section class="py-5">
        <div class="container">
            <h2 class="section-title">Upcoming Events</h2>

            <div class="row g-4 mt-4">
                <?php while ($row = mysqli_fetch_assoc($event_result)) { ?>

                <div class="col-md-4">
                    <div class="card event-card h-100 shadow-sm border-0">

                        <img src="<?php echo !empty($row['image']) ? $row['image'] : 'https://via.placeholder.com/300x210?text=No+Image'; ?>"
                            class="card-img-top event-img" alt="<?php echo $row['event_name']; ?>">

                        <div class="card-body d-flex flex-column">
                            <h6 class="fw-bold mb-2" id="e_name">
                                <?php echo $row['event_name']; ?>
                            </h6>

                            <p class="text-muted small event-about">
                                <?php echo $row['about']; ?>
                            </p>

                            <a href="event.php?id=<?php echo $row['id']; ?>"
                                class="btn btn-outline-primary btn-sm mt-auto align-self-start">
                                View Details
                            </a>
                        </div>

                    </div>
                </div>

                <?php } ?>
            </div>


    </section>

    <!-- FINAL CTA SECTION -->
    <section class="py-5 text-center text-white" style="background: linear-gradient(135deg, #0d6efd, #0dcaf0);">
        <div class="container">
            <h2 class="fw-bold mb-3">Be a Part of Positive Change</h2>
            <p class="mb-4">
                Connect, contribute, and create impact in your community today.
            </p>
            <a href="register.php" class="btn btn-light btn-lg px-4">
                Join Community
            </a>
        </div>
    </section>

    <!-- FOOTER -->
    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function likePost(id) {
        fetch("", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "like_id=" + id
            })
            .then(res => res.text())
            .then(data => {
                document.getElementById("like-" + id).innerText = data;
            });
    }

    function addComment(e, postId) {
        e.preventDefault();
        let input = e.target.querySelector("input");

        fetch("", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "post_id=" + postId + "&comment_text=" + encodeURIComponent(input.value)
            })
            .then(() => location.reload());

        return false;
    }
    </script>

    <script>
    function toggleComments(postId) {
        let box = document.getElementById("comments-" + postId);
        box.style.display = box.style.display === "none" ? "block" : "none";
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>