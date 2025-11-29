<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Community Connect</title>

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Outfit:wght@300;400;600;700&display=swap"
        rel="stylesheet">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: "Outfit", sans-serif;
            color: #333;
            padding-top: 90px;
        }

        /* WEBSITE BRAND NAME */
        .navbar-brand-text {
            font-family: "Handlee", cursive;
            font-size: 1.7rem;
            margin-left: 6px;
        }

        /* NAVBAR */
        .navbar {
            padding-top: .10rem !important;
            padding-bottom: .10rem !important;
        }

        .navbar .container {
            padding-left: .5rem !important;
            padding-right: .5rem !important;
            max-width: 100% !important;
        }

        .brand-logo {
            width: 80px;
            height: 80px;
            object-fit: cover;
        }

        /* Content styling */
        .feature-content {
            font-size: 1.1rem;
            line-height: 1.65;
            color: #444;
            max-width: 70ch;
        }

        .feature-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: .7rem;
        }

        .feature-img {
            width: 100%;
            max-height: 330px;
            object-fit: contain;
        }

        /* Team Section */
        .section-title {
            font-size: 1.7rem;
            font-weight: 700;
            margin-bottom: 2rem;
            margin-top: 2rem;
        }

        .card {
            border: 1px solid grey;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.07);
            transition: .2s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.12);
        }

        .card-img-top {
            height: 220px;
            object-fit: cover;
        }

        .card-name {
            font-size: 1.1rem;
            font-weight: 700;
        }

        .card-role {
            color: #00897B;
            font-weight: 600;
        }

        .card-subline {
            color: #555;
            margin-top: .5rem;
            font-size: .95rem;
        }

        @media (max-width: 576px) {
            .card-img-top {
                height: 180px;
            }

            .feature-content {
                font-size: 1rem;
            }

            .feature-title {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR (RESTORED TO YOUR ORIGINAL) -->
    <nav class="navbar navbar-expand-lg bg-light shadow-sm fixed-top">
        <div class="container">

            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="lg.png" class="brand-logo" alt="logo">
                <span class="navbar-brand-text">Community Connect</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="nav">

                <ul class="navbar-nav ms-3 me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Events</a></li>
                    <li class="nav-item"><a class="nav-link active" href="about.php">About</a></li>
                </ul>

                <div class="d-flex gap-2">
                    <a href="signup.php" class="btn btn-outline-info btn-sm">Sign Up</a>
                    <a href="login.php" class="btn btn-outline-info btn-sm">Login</a>
                </div>

            </div>
        </div>
    </nav>

    <main class="container">

        <!-- About -->
        <div class="row align-items-center my-5">
            <div class="col-md-7">
                <h3 class="feature-title">About Community Connect</h3>
                <p class="feature-content">
                    Community Connect is designed to bring people closer to the causes and communities around them. It
                    creates a simple,
                    inviting space where anyone can discover social service events happening in their district and take
                    part in meaningful
                    activities. The idea is to make involvement effortless — whether someone wants to volunteer, join a
                    local group, or
                    participate in initiatives that contribute to social well-being. By connecting people with what’s
                    happening nearby, we
                    turn the desire to help into real, impactful action.
                </p>
            </div>
            <div class="col-md-5 text-center">
                <img src="a1.jpg" class="feature-img" alt="illustration">
            </div>
        </div>

        <!-- Mission -->
        <div class="row align-items-center my-5 flex-md-row-reverse">
            <div class="col-md-7">
                <h3 class="feature-title">🌟 Our Mission</h3>
                <p class="feature-content">
                    We encourage community participation by making it simple to find opportunities that matter.
                    Community Connect
                    helps volunteers and organizers meet, collaborate, and act — with minimal friction and maximum
                    impact.
                </p>
            </div>
            <div class="col-md-5 text-center">
                <img src="a2.jpg" class="feature-img" alt="illustration">
            </div>
        </div>

        <!-- What We Do -->
        <div class="row align-items-center my-5">
            <div class="col-md-7">
                <h3 class="feature-title">💡 What We Do</h3>
                <p class="feature-content">
                    Community Connect bridges organizers and volunteers by helping people discover nearby events, join
                    district-based
                    groups, and stay updated. The platform is designed to feel warm, clear, and community-driven — where
                    participating
                    becomes enjoyable and straightforward.
                </p>
            </div>
            <div class="col-md-5 text-center">
                <img src="a3.jpg" class="feature-img" alt="illustration">
            </div>
        </div>

        <!-- Why It Matters -->
        <div class="row align-items-center my-5 flex-md-row-reverse">
            <div class="col-md-7">
                <h3 class="feature-title">🌈 Why It Matters</h3>
                <p class="feature-content">
                    Real change begins locally. When people know what’s happening in their area, they can support causes
                    that need
                    attention. Community Connect simplifies discovery and participation so more people can step forward
                    and
                    contribute to stronger communities.
                </p>
            </div>
            <div class="col-md-5 text-center">
                <img src="a4.jpg" class="feature-img" alt="illustration">
            </div>
        </div>

        <!-- Vision -->
        <div class="row align-items-center my-5">
            <div class="col-md-7">
                <h3 class="feature-title">🔭 Our Vision</h3>
                <p class="feature-content">
                    We imagine a future where community involvement is part of everyday life — where social events are
                    easy to find,
                    volunteers are always appreciated, and communities feel more connected than ever. Community Connect
                    aims to grow into a
                    larger ecosystem that inspires collaboration, supports good initiatives, and brings people together
                    in meaningful ways.
                </p>
            </div>
            <div class="col-md-5 text-center">
                <img src="a5.jpg" class="feature-img" alt="illustration">
            </div>
        </div>

        <!-- Team Section -->
        <h3 class="section-title">✨ Meet Our Team</h3>

        <div class="row row-cols-1 row-cols-md-3 g-4">

            <div class="col">
                <div class="card">
                    <img src="t1.jpg" class="card-img-top" alt="">
                    <div class="card-body">
                        <h3 class="card-name">Akanksha Sheet</h3>
                        <p class="card-role">Frontend Designer</p>
                        <p class="card-subline">
                            Crafts clean, aesthetic interfaces and smooth user experiences.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <img src="t2.jpg" class="card-img-top" alt="">
                    <div class="card-body">
                        <h3 class="card-name">Nikita Patil</h3>
                        <p class="card-role">Backend Developer</p>
                        <p class="card-subline">
                            Builds secure, efficient backend systems that power the platform.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <img src="t3.jpg" class="card-img-top" alt="">
                    <div class="card-body">
                        <h3 class="card-name">Bhumika Alhat</h3>
                        <p class="card-role">Database Designer</p>
                        <p class="card-subline">
                            Designs organized, scalable databases for reliable performance.
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </main>

    <!-- FOOTER -->
    <footer class="py-3 text-center">
        <div class="container">
            <p class="mb-1">© 2023-2025 Community-Connect, Inc.</p>
            <p class="mb-1">
                <a href="#" class="text-muted me-2">Privacy</a>
                <a href="#" class="text-muted">Terms</a>
            </p>
            <a href="#top" class="text-decoration-none">Back to top</a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>