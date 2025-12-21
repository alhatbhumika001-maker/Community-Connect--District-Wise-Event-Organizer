<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Communities - Community Connect</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="adminStyle.css">

    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    .community-metric-card {
        background: #ffffff;
        border-radius: 10px;
        padding: 14px 16px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        height: 100%;
        max-width: 340px;
        /* prevents over-stretching */
        margin: auto;
    }

    .community-metric-top {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .community-metric-icon {
        width: 44px;
        height: 44px;
        background: #eef2ff;
        color: #8540f5;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
        flex-shrink: 0;
    }

    .community-metric-title {
        font-size: 20px;
        font-weight: 500;
        line-height: 1.3;
        color: #6b7280;
    }

    .community-metric-value {
        margin-top: 10px;
        font-size: 24px;
        font-weight: 600;
    }

    .graph {
        background-color: white;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.15);
        padding: 20px;
        border-radius: 16px;
        margin-top: 24px;
        width: 100%;
        overflow-x: hidden;
    }

    .graph canvas {
        width: 100% !important;
        height: 320px !important;
    }
    </style>
</head>

<body>
    <?php
    $active = 'communities';
    $topbar = 'communities';
    $sub = 'communityInsights';
    include 'adminNav.php';
    ?>
    <div class="content">
        <h2 class="text-muted mb-3">Overview On Communities</h2>
        <div class="row g-3">

            <!-- Total Communities -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="community-metric-card">
                    <div class="community-metric-top">
                        <div class="community-metric-icon">
                            <i class="bi bi-collection"></i>
                        </div>
                        <div class="community-metric-title">
                            Total<br>Communities
                        </div>
                    </div>
                    <div class="community-metric-value">124</div>
                </div>
            </div>

            <!-- Active Communities -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="community-metric-card">
                    <div class="community-metric-top">
                        <div class="community-metric-icon">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="community-metric-title">
                            Active<br>Communities
                        </div>
                    </div>
                    <div class="community-metric-value">96</div>
                </div>
            </div>

            <!-- Total Organizers -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="community-metric-card">
                    <div class="community-metric-top">
                        <div class="community-metric-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="community-metric-title">
                            Total<br>Organizers
                        </div>
                    </div>
                    <div class="community-metric-value">58</div>
                </div>
            </div>
        </div>

        <div class="graphs">
            <div class="graph">
                <h3 class="section-title">
                    Communities by District
                </h3>
                <canvas id="districtChart"></canvas>
            </div>
            <div class="graph mb-4">
                <h3 class="section-title">
                    Communtiy Growth over Time
                </h3>
                <canvas id="growthChart"></canvas>
            </div>
        </div>

        <h2 class="text-muted mb-3">Showing top Organizers</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <!-- Organizer ka naam -->
                    <th>Organizer Name</th>

                    <!-- Kitni communities manage kar rahe -->
                    <th class="count-col">Communities</th>
                </tr>
            </thead>
            <tbody>

                <!-- Dummy rows (baad me PHP loop lagega) -->
                <tr>
                    <td>Rahul Patil</td>
                    <td class="count-col">5</td>
                </tr>

                <tr>
                    <td>Sneha Desai</td>
                    <td class="count-col">4</td>
                </tr>

                <tr>
                    <td>Amit Kulkarni</td>
                    <td class="count-col">3</td>
                </tr>

                <tr>
                    <td>Priya Joshi</td>
                    <td class="count-col">3</td>
                </tr>

            </tbody>
        </table>
    </div>
    <!-- Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    /*
        NOTE:
        - Abhi dummy data use kar rahe hai
        - Future me yeh data PHP se aayega
        */

    // District names (Top districts only)
    const districtLabels = ['Pune', 'Mumbai', 'Nashik', 'Jalgaon', 'Nagpur', 'Others'];

    // Community count per district
    const districtData = [25, 18, 14, 12, 9, 7];

    // Canvas element fetch kar rahe hai
    const districtCtx = document.getElementById('districtChart');

    // Bar chart create kar rahe hai
    new Chart(districtCtx, {
        type: 'bar',
        data: {
            labels: districtLabels,
            datasets: [{
                label: 'Number of Communities',
                data: districtData,
                backgroundColor: '#6366f1' // Simple single color
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true // Count zero se start ho
                }
            }
        }
    });

    /*
    NOTE:
    - Last 6 months ka data show kar rahe hai
    - PHP future me months + counts calculate karega
    */

    // Last 6 months labels
    const growthLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];

    // Total communities (cumulative growth)
    const growthData = [10, 15, 22, 30, 38, 45];

    // Canvas element fetch
    const growthCtx = document.getElementById('growthChart');

    // Line chart create
    new Chart(growthCtx, {
        type: 'line',
        data: {
            labels: growthLabels,
            datasets: [{
                label: 'Total Communities',
                data: growthData,
                borderColor: '#6366f1',
                backgroundColor: 'rgba(99, 102, 241, 0.15)',
                fill: true, // Line ke niche light fill
                tension: 0.3 // Line smooth banane ke liye
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>


    <!-- Bootstrap JS  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>