<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .btn {
            padding: 15px 25px;
            font-size: 1.1rem;
            border-radius: 8px;
            font-weight: bold;
            border: none;
            color: #fff !important;
            transition: background-color 0.3s, transform 0.2s;
            background-color: #ff66b3 !important;
        }

        .btn:hover {
            background-color: #ff99cc !important;
            transform: translateY(-2px);
            opacity: 0.9;
        }

        .text-box {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
            text-align: center;
        }

        .text-box p {
            font-size: 1.1rem;
            color: #4a4a4a;
            line-height: 1.6;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<?php include 'includes/header.php'; ?>
<div class="container mt-5">
    <h2 class="text-center" style="color: #ff66b3; margin-bottom: 20px;">Events</h2>
    <div class="text-box">
        <p>
            Bine ai venit la secțiunea de evenimente! În această pagină poți accesa calendarul de evenimente, oferi feedback pentru evenimentele la care ai participat și te poți înscrie la evenimente viitoare apăsând pe butoanele de mai jos.
        </p>
        <div class="d-flex justify-content-center mt-4">
            <a href="calendar.php" class="btn m-2">Calendar</a>
            <a href="feedback.php" class="btn m-2">Feedback</a>
            <a href="register.php" class="btn m-2">Register</a>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
</body>
</html>
