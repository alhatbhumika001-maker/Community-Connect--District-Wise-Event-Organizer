


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Privacy Policy | Community Connect</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="style.css">
<style>
:root{
    --primary:#4f46e5;
    --secondary:#06b6d4;
    --text:#1f2937;
    --muted:#6b7280;
    --card:rgba(255,255,255,.85);
}

*{margin:0;padding:0;box-sizing:border-box}

body{
    font-family:'Poppins',sans-serif;
    background:linear-gradient(135deg,#f8fafc,#eef2ff,#ecfeff);
    color:var(--text);
    overflow-x:hidden;
}

/* SOFT BACKGROUND SHAPES */
.bg{
    position:fixed;
    inset:0;
    z-index:-1;
}
.shape{
    position:absolute;
    width:420px;
    height:420px;
    border-radius:50%;
    filter:blur(100px);
    opacity:.5;
}
.shape.one{background:#c7d2fe;top:5%;left:5%}
.shape.two{background:#99f6e4;bottom:5%;right:5%}

/* HERO */
.hero{
    padding:90px 20px 80px;
    text-align:center;
}
.hero h1{
    font-size:48px;
    font-weight:700;
    background:linear-gradient(90deg,var(--primary),var(--secondary));
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}
.hero p{
    margin-top:12px;
    font-size:18px;
    color:var(--muted);
}

/* MAIN */
.wrapper{
    max-width:1100px;
    margin:-40px auto 60px;
    padding:20px;
}

/* GLASS CARD */
.card{
    background:var(--card);
    backdrop-filter:blur(14px);
    border-radius:26px;
    padding:45px;
    box-shadow:0 30px 70px rgba(0,0,0,.12);
}

/* SECTIONS */
.section{
    margin-bottom:42px;
    animation:fadeUp .8s ease both;
}
.section:nth-child(even){animation-delay:.1s}
.section:nth-child(odd){animation-delay:.2s}

@keyframes fadeUp{
    from{opacity:0;transform:translateY(25px)}
    to{opacity:1;transform:translateY(0)}
}

.section h2{
    font-size:26px;
    font-weight:600;
    margin-bottom:14px;
    background:linear-gradient(90deg,var(--primary),var(--secondary));
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}

.section p{
    font-size:16px;
    line-height:1.9;
    color:#374151;
}

.section ul{
    margin-top:12px;
    padding-left:22px;
}
.section li{
    margin:10px 0;
    color:#374151;
}

/* HIGHLIGHT */
.highlight{
    background:linear-gradient(135deg,#eef2ff,#ecfeff);
    border-left:6px solid var(--primary);
    border-radius:18px;
    padding:22px;
    font-weight:500;
}

/* FOOTER */
footer{
    text-align:center;
    color:#6b7280;
    font-size:14px;
    padding:30px;
}

/* RESPONSIVE */
@media(max-width:768px){
    .hero h1{font-size:34px}
    .card{padding:28px}
}
</style>
</head>

<body>

<div class="bg">
    <div class="shape one"></div>
    <div class="shape two"></div>
</div>


<!-- HERO -->
<section class="hero">
    <h1>Privacy Policy</h1>
    <p>Clear, transparent & respectful of your privacy</p>
</section>

<!-- CONTENT -->
<div class="wrapper">
    <div class="card">

        <div class="section">
            <p>
                Welcome to <strong>Community Connect</strong>. We respect your privacy and are
                committed to protecting the personal data you share with us.
            </p>
        </div>

        <div class="section">
            <h2>1. Information We Collect</h2>
            <ul>
                <li>Name, email address, and contact details</li>
                <li>User account and profile information</li>
                <li>Posts, comments, and messages</li>
                <li>Technical and usage data</li>
            </ul>
        </div>

        <div class="section">
            <h2>2. How We Use Your Information</h2>
            <ul>
                <li>To deliver and improve platform services</li>
                <li>To enable community interaction</li>
                <li>To maintain security and prevent misuse</li>
                <li>To send service-related notifications</li>
            </ul>
        </div>

        <div class="section">
            <h2>3. Data Protection</h2>
            <div class="highlight">
                We apply industry-standard security practices, though no online platform can be
                completely secure.
            </div>
        </div>

        <div class="section">
            <h2>4. Sharing of Information</h2>
            <ul>
                <li>Only when required by law</li>
                <li>To protect Community Connect and users</li>
                <li>With trusted partners under confidentiality agreements</li>
            </ul>
        </div>

        <div class="section">
            <h2>5. Cookies</h2>
            <p>
                Cookies enhance user experience. You can manage cookies in your browser settings.
            </p>
        </div>

        <div class="section">
            <h2>6. Your Rights</h2>
            <ul>
                <li>Access and update your personal data</li>
                <li>Request account deletion</li>
                <li>Withdraw consent at any time</li>
            </ul>
        </div>

        <div class="section">
            <h2>7. Policy Updates</h2>
            <p>
                This Privacy Policy may change over time. Updates will be posted on this page.
            </p>
        </div>

        <div class="section">
            <h2>8. Contact Us</h2>
            <p>
                For questions about privacy, please contact the Community Connect support team.
            </p>
        </div>

    </div>
</div>



</body>
</html>
