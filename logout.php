<!DOCTYPE html>
<html>
<head>
    <title>Logout Confirmation</title>
    <style>
        body {
            font-family: "Poppins", Arial, sans-serif;
            background: linear-gradient(135deg, #83ead7ff, #b2bce7ff,  #f2b9f3ff);
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        .box {
            background: #ffffffdd;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            text-align: center;
            width: 350px;
            backdrop-filter: blur(5px);
            animation: popup 0.7s ease;
        }

        @keyframes popup {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        h2 {
            letter-spacing: 1px;
            color: #333;
            margin-bottom: 20px;
        }

        button {
            padding: 12px 25px;
            margin: 12px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 50px;
            transition: 0.3s ease;
        }

        .yes {
            background: #ff6a5f;
            color: white;
            box-shadow: 0 5px 15px rgba(255, 106, 95, 0.4);
        }
        .yes:hover {
            background: #ff4a3f;
            transform: scale(1.05);
        }

        .no {
            background: #3fa9f5;
            color: white;
            box-shadow: 0 5px 15px rgba(63, 169, 245, 0.4);
        }
        .no:hover {
            background: #1f91e8;
            transform: scale(1.05);
        }

    </style>
</head>
<body>

<div class="box">
    <h2>Are you sure you want to logout?</h2>
    <form method="post">
        <button type="submit" name="confirm" value="yes" class="yes">Yes, Logout</button>
        <button type="submit" name="confirm" value="no" class="no">No</button>
    </form>
</div>

</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["confirm"] === "yes") {
        session_start();
        session_unset();
        session_destroy();
        header("Location: logout_success.php");
        exit();
    } else {
        header("Location: volunteerDashboard.php");
        exit();
    }
}
?>
