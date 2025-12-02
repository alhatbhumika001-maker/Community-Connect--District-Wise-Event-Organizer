<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Community Connect - Home</title>

    <link rel="stylesheet" href="style.css">

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Handlee&family=Huninn&family=Outfit:wght@100..900&family=Playwrite+NZ+Guides&display=swap"
        rel="stylesheet">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        /* FULL-SCREEN CAROUSEL */
        .hero-img {
            width: 100%;
            height: 100vh;
            object-fit: cover;
            display: block;
            align-items: center;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.35);
        }

        /* REDUCED CAROUSEL TEXT SIZE BY ~20% */
        .hero-content h1 {
            font-size: 1.9rem;
            font-weight: 700;
            text-shadow: 0 5px 15px rgba(0, 0, 0, 0.45);
        }

        .hero-content p {
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .hero-content {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #fff;
            width: 90%;
            max-width: 900px;
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
            font-size: 1.7rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 2rem;
            margin-top: 2rem;
        }

        /* clean font for content in C / P / O */
        .feature-content {
            font-size: 1.1rem;
            line-height: 1.65;
            color: #444;
            font-family: "Outfit", sans-serif;
        }

        /* HEADINGS NORMAL */
        .feature-title {
            font-size: 1.4rem;
            font-weight: 600;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <?php
        $active = 'home';
        include 'mainNav.php';
    ?>

    <!-- Carousel -->
    <header>
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">

            <div class="carousel-inner">

                <!-- Slide 1 -->
                <div class="carousel-item active position-relative">
                    <img src="c1.jpg" class="hero-img">
                    <div class="hero-overlay"></div>
                    <div class="hero-content">
                        <h1>Connecting Communities Together</h1>
                        <p>Building stronger districts through collective action.</p>
                        <a href="event.php" class="btn btn-info btn-sm">Find Events</a>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item position-relative">
                    <img src="c2.png" class="hero-img">
                    <div class="hero-overlay"></div>
                    <div class="hero-content">
                        <h1>Join Local Social Service Events</h1>
                        <p>Volunteer, contribute, and make an impact in your district.</p>
                        <a href="events.php" class="btn btn-info btn-sm">Explore</a>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item position-relative">
                    <img src="c3.png" class="hero-img">
                    <div class="hero-overlay"></div>
                    <div class="hero-content">
                        <h1>Together We Make a Difference</h1>
                        <p>Empowering communities through shared action.</p>
                        <a href="create-event.php" class="btn btn-info btn-sm">Create Event</a>
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

    <main class="py-5 mt-3">
        <div class="container">

            <h2 class="section-title">How It Works</h2>

            <!-- CONNECT -->
            <div class="row align-items-center my-5">
                <div class="col-md-7">
                    <h3 class="feature-title">Connect</h3>
                    <p class="feature-content">
                        Your community is closer than you think. Our platform brings together people from every
                        district,
                        helping them discover meaningful events, social drives, and causes happening right around them.
                        Whether you're new to a place or deeply rooted in your neighborhood, Community Connect helps you
                        become part of something bigger.
                    </p>
                </div>
                <div class="col-md-5 text-center">
                    <img src="h1.jpg" class="img-fluid rounded">
                </div>
            </div>

            <!-- PARTICIPATE -->
            <div class="row align-items-center my-5 flex-md-row-reverse">
                <div class="col-md-7">
                    <h3 class="feature-title">Participate</h3>
                    <p class="feature-content">
                        Take the first step toward making an impact. Join local social service activities, volunteer for
                        community projects, or support initiatives that matter to you. With district-wise suggestions,
                        the website ensures you always find the right event at the right time — no searching, no
                        confusion,
                        just simple participation.
                    </p>
                </div>
                <div class="col-md-5 text-center">
                    <img src="h2.jpg" class="img-fluid rounded">
                </div>
            </div>

            <!-- ORGANIZE -->
            <div class="row align-items-center my-5">
                <div class="col-md-7">
                    <h3 class="feature-title">Organize</h3>
                    <p class="feature-content">
                        Have an idea for change? Turn it into action. Organizers can effortlessly create, manage, and
                        promote their own events to reach the right people within their district. From registrations
                        to volunteer updates, everything is streamlined so your focus stays on making a difference —
                        not managing paperwork.
                    </p>
                </div>
                <div class="col-md-5 text-center">
                    <img src="h3.jpg" class="img-fluid rounded">
                </div>
            </div>

        </div>
    </main>

    <!-- FOOTER -->
    <?php include 'footer.php'; ?>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
