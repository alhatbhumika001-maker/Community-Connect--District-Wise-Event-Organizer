<<<<<<< HEAD
<?php
    include 'mainNav.php';
?>
=======
>>>>>>> a0bdff5f9621b9583a1aa426c1a15b08dd868518
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>FAQs - Community Connect</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        font-family: 'Outfit', sans-serif;
        background: #eef4ff;
    }

    .faq-wrapper {
        max-width: 800px;
        margin: auto;
    }

    .faq-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
        padding: 30px;
    }

    .accordion-button {
        font-weight: 600;
    }

    .accordion-button:not(.collapsed) {
        background-color: #f2f6ff;
        color: #000;
    }

    .accordion-body {
        color: #555;
        line-height: 1.6;
    }
    </style>
</head>

<body>

    <div class="container py-5">
        <div class="faq-wrapper">

            <!-- Page Heading -->
            <div class="text-center mb-4">
<<<<<<< HEAD
                <h2 class="fw-semibold" style="margin-top:60px;">Frequently Asked Questions</h2>
=======
                <h2 class="fw-semibold">Frequently Asked Questions</h2>
>>>>>>> a0bdff5f9621b9583a1aa426c1a15b08dd868518
                <p class="text-muted">
                    Everything you need to know about Community Connect
                </p>
            </div>

            <!-- FAQ Card -->
            <div class="faq-card">
                <div class="accordion" id="faqAccordion">

                    <!-- FAQ 1 -->
                    <div class="accordion-item border-0 mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq1">
                                What is Community Connect?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Community Connect is a district-based platform where people can
                                join communities, discover local events, and participate in social
                                service activities near them.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="accordion-item border-0 mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq2">
                                Who can create events?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Authorized community organizers can create and manage events
                                for their respective districts after logging into the system.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="accordion-item border-0 mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq3">
                                Is registration required to join events?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes, users need to register and log in to join events, follow
                                communities, and receive event updates.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 4 -->
                    <div class="accordion-item border-0 mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq4">
                                How are communities suggested?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Communities are suggested based on the district selected by the
                                user, ensuring relevant local events and activities are shown.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 5 -->
                    <div class="accordion-item border-0">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq5">
                                Is Community Connect free to use?
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes, Community Connect is completely free for users and volunteers
                                to explore communities and participate in events.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 6 -->
                    <div class="accordion-item border-0 mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq6">
                                Can I join multiple communities?
                            </button>
                        </h2>
                        <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes, users can join multiple communities from different categories
                                within their district based on their interests.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 7 -->
                    <div class="accordion-item border-0 mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq7">
                                How will I get updates about events?
                            </button>
                        </h2>
                        <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Registered users receive updates through the platform whenever
                                a new event is created or updated in their joined communities.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 8 -->
                    <div class="accordion-item border-0 mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq8">
                                Can events be canceled or updated?
                            </button>
                        </h2>
                        <div id="faq8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes, event organizers can update or cancel events if required.
                                Users will be informed about such changes.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 9 -->
                    <div class="accordion-item border-0 mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq9">
                                Is my personal information secure?
                            </button>
                        </h2>
                        <div id="faq9" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes, Community Connect securely manages user data using
                                authentication and database security practices.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 10 -->
                    <div class="accordion-item border-0">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq10">
                                What should I do if I face any issue on the platform?
                            </button>
                        </h2>
                        <div id="faq10" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                If you face any issues, you can contact the admin by writing the feedback form. We will
                                be getting back to you as soon as possible.
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>