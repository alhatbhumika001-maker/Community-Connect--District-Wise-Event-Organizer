<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Terms & Conditions | Community Connect</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
:root{
    --primary:#6366f1;
    --secondary:#06b6d4;
    --text:#1f2937;
    --muted:#6b7280;
    --glass:rgba(255,255,255,.9);
}

/* RESET */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins',sans-serif;
    color:var(--text);
    background:linear-gradient(135deg,#f8fafc,#eef2ff,#ecfeff);
    overflow-x:hidden;
}

/* BACKGROUND SHAPES */
.bg-shape{
    position:fixed;
    width:420px;
    height:420px;
    border-radius:50%;
    filter:blur(100px);
    opacity:.45;
    z-index:-1;
}
.shape1{background:#c7d2fe;top:5%;left:5%}
.shape2{background:#99f6e4;bottom:5%;right:5%}

/* HERO */
.hero{
    padding:100px 20px 80px;
    text-align:center;
}
.hero h1{
    font-size:50px;
    font-weight:700;
    background:linear-gradient(90deg,var(--primary),var(--secondary));
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}
.hero p{
    margin-top:14px;
    font-size:18px;
    color:var(--muted);
}

/* WRAPPER */
.wrapper{
    max-width:1150px;
    margin:-50px auto 70px;
    padding:20px;
}

/* GLASS CARD */
.card{
    background:var(--glass);
    backdrop-filter:blur(18px);
    border-radius:30px;
    padding:50px;
    box-shadow:0 40px 80px rgba(0,0,0,.12);
    animation:fadeUp .9s ease;
}

@keyframes fadeUp{
    from{opacity:0;transform:translateY(30px)}
    to{opacity:1;transform:translateY(0)}
}

/* SECTION */
.section{
    margin-bottom:45px;
}
.section h2{
    font-size:26px;
    font-weight:600;
    margin-bottom:14px;
    position:relative;
    background:linear-gradient(90deg,var(--primary),var(--secondary));
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}
.section h2::after{
    content:"";
    width:50px;
    height:3px;
    background:linear-gradient(90deg,var(--primary),var(--secondary));
    position:absolute;
    left:0;
    bottom:-6px;
    border-radius:10px;
}

.section p,
.section li{
    font-size:16px;
    line-height:1.9;
    color:#374151;
}

.section ul{
    padding-left:22px;
    margin-top:10px;
}
.section li{
    margin:10px 0;
}

/* HIGHLIGHT BOX */
.highlight{
    background:linear-gradient(135deg,#eef2ff,#ecfeff);
    border-left:6px solid var(--primary);
    border-radius:20px;
    padding:24px;
    font-weight:500;
}

/* FOOTER */
footer{
    text-align:center;
    padding:35px;
    font-size:14px;
    color:#6b7280;
}

/* RESPONSIVE */
@media(max-width:768px){
    .hero h1{font-size:36px}
    .card{padding:30px}
}
</style>
</head>

<body>

<!-- BACKGROUND -->
<div class="bg-shape shape1"></div>
<div class="bg-shape shape2"></div>

<!-- HERO -->
<section class="hero">
    <h1>Terms & Conditions</h1>
    <p>Know your rights and responsibilities at Community Connect</p>
</section>

<!-- CONTENT -->
<div class="wrapper">
    <div class="card">

        <div class="section">
            <p>
                Welcome to <strong>Community Connect</strong>. By accessing or using our platform,
                you agree to follow these Terms & Conditions. Please read them carefully.
            </p>
        </div>

        <div class="section">
            <h2>1. Acceptance of Terms</h2>
            <p>
                By using Community Connect, you confirm that you understand and agree to these terms.
            </p>
        </div>

        <div class="section">
            <h2>2. User Eligibility</h2>
            <p>
                Users must be at least 13 years old to access the platform.
            </p>
        </div>

        <div class="section">
            <h2>3. User Accounts</h2>
            <ul>
                <li>Provide accurate and current information</li>
                <li>Maintain confidentiality of login credentials</li>
                <li>All activities under your account are your responsibility</li>
            </ul>
        </div>

        <div class="section">
            <h2>4. User Content</h2>
            <ul>
                <li>You retain ownership of content you post</li>
                <li>Content must not violate laws or community standards</li>
                <li>We may remove content that breaches these terms</li>
            </ul>
        </div>

        <div class="section">
            <h2>5. Prohibited Activities</h2>
            <ul>
                <li>Harassment, abuse, or hate speech</li>
                <li>Spamming or misleading information</li>
                <li>Unauthorized access or hacking attempts</li>
            </ul>
        </div>

        <div class="section">
            <h2>6. Intellectual Property</h2>
            <p>
                All content, logos, and features belong to Community Connect and may not be reused
                without permission.
            </p>
        </div>

        <div class="section">
            <h2>7. Account Termination</h2>
            <div class="highlight">
                Community Connect reserves the right to suspend or terminate accounts that violate
                these Terms & Conditions.
            </div>
        </div>

        <div class="section">
            <h2>8. Limitation of Liability</h2>
            <p>
                We are not responsible for damages resulting from use of the platform.
            </p>
        </div>

        <div class="section">
            <h2>9. Changes to Terms</h2>
            <p>
                These terms may be updated periodically. Continued usage means acceptance.
            </p>
        </div>

        <div class="section">
            <h2>10. Governing Law</h2>
            <p>
                These terms are governed by the laws of India.
            </p>
        </div>

        <div class="section">
            <h2>11. Contact Us</h2>
            <p>
                For any questions, please contact the Community Connect support team.
            </p>
        </div>

    </div>
</div>

<footer>
    © 2025 Community Connect · Built with Trust
</footer>

</body>
</html>
