<!DOCTYPE html>
<html>
<head>
    <title>Logged Out Successfully</title>
    <style>
        body {
            margin: 0;
            font-family: "Poppins", Arial, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            overflow: hidden;
            animation: fadeBG 1.2s ease-in-out;

            background: linear-gradient(135deg, #e4a6f7ff, #6be884ff, #95e8eeff);
            background-size: 400% 400%;
            animation: gradientFlow 15s ease infinite;

           
        }

         @keyframes gradientFlow {
            20% { background-position: 20% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 20% 50%; }
         }

        @keyframes fadeBG {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .msg {
            background: rgba(255, 255, 255, 0.15);
            padding: 50px 60px;
            border-radius: 18px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.25);
            backdrop-filter: blur(10px);
            text-align: center;
            animation: popIn 0.9s ease;
        }

        @keyframes popIn {
            from { transform: translateY(40px) scale(0.9); opacity: 0; }
            to   { transform: translateY(0) scale(1); opacity: 1; }
        }

        .check-icon {
            font-size: 70px;
            margin-bottom: 20px;
            animation: bounce 1.5s ease infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        h1 {
            font-size: 32px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        p {
            font-size: 18px;
            opacity: 0.9;
        }

        a {
            margin-top: 25px;
            display: inline-block;
            background: #0abf61;
            color: #fff;
            padding: 14px 30px;
            font-size: 17px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 500;
            transition: 0.4s ease;
            box-shadow: 0 8px 18px rgba(10, 191, 97, 0.4);
            border:solid 1px white;
        }

        a:hover {
            background: #089a4f;
            transform: translateY(-3px);
            box-shadow: 0 12px 22px rgba(10, 191, 97, 0.55);
        }
    </style>
</head>
<body>

<div class="msg">
    <div class="check-icon">✔️</div>
    <h1>You have logged out successfully!</h1>
    <p>Thank you for using our system. Have a great day ahead!</p>
    <a href="login.php">Go to Login</a>
</div>

</body>
</html>
