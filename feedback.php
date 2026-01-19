<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Feedback | Community Connect</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">


    <style>
    body {
        background: #f4f7fb;
        font-family: 'Outfit', sans-serif;
    }

    .feedback-card {
        max-width: 500px;
        margin: 0px auto;
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }

    /* STAR RATING */
    .stars {
        display: flex;
        gap: 8px;
        font-size: 28px;
        cursor: pointer;
    }

    .star {
        color: #cbd5e1;
        /* empty */
    }

    .star.active {
        color: #fbbf24;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
    }

    .btn-outline-indigo {
        color: #8540f5;
        border-color: #8540f5;
    }

    .btn-outline-indigo:hover {
        background-color: #8540f5;
        color: white;
    }
    </style>
</head>

<body>
    <div class="back-btn mt-3 ms-3">
        <button class="btn btn-secondary btn-sm mb-3" onclick="history.back()">
            ←
        </button>
    </div>

    <div class="feedback-card mb-4">

        <h4 class="fw-bold text-center mb-3">Feedback</h4>

        <form method="post" action="#">

            <!-- NAME -->
            <div class="mb-3">
                <label class="form-label">Your Name</label>
                <input type="text" class="form-control" name="name" required>
            </div>

            <!-- FEEDBACK -->
            <div class="mb-3">
                <label class="form-label">Your Feedback</label>
                <textarea class="form-control" name="feedback" rows="4" required></textarea>
            </div>

            <!-- STAR RATING -->
            <div class="mb-3">
                <label class="form-label d-block">Rating</label>

                <div class="stars" id="starRating">
                    <span class="star" data-value="1">★</span>
                    <span class="star" data-value="2">★</span>
                    <span class="star" data-value="3">★</span>
                    <span class="star" data-value="4">★</span>
                    <span class="star" data-value="5">★</span>
                </div>

                <!-- Hidden input to store rating -->
                <input type="hidden" name="rating" id="ratingValue" required>
            </div>

            <button type="submit" class="btn btn-outline-indigo w-100">
                Submit Feedback
            </button>

        </form>
    </div>



    <script>
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('ratingValue');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const value = star.getAttribute('data-value');
            ratingInput.value = value;

            stars.forEach(s => {
                s.classList.toggle('active', s.getAttribute('data-value') <= value);
            });
        });
    });
    </script>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>