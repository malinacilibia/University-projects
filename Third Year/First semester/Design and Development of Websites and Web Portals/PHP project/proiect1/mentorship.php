<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentorship</title>
    <style>
        .btn-mentorship {
            background-color: #ff66b3;
            color: #fff;
            border: none;
            padding: 15px 25px;
            font-size: 1.1rem;
            border-radius: 8px;
            margin: 10px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-mentorship:hover {
            background-color: #ff99cc;
            transform: translateY(-2px);
        }

        .container-white-box {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        .mentorship-text {
            font-size: 1.1rem;
            color: #4a4a4a;
            margin-bottom: 20px;
            line-height: 1.6;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center" style="color: #ff66b3; margin-bottom: 30px;">Mentorship</h2>
    <div class="container-white-box text-center">
        <p class="mentorship-text">
            Bine ai venit la secțiunea de mentorat! Aici poți explora un sistem complet care include:
        <ul style="text-align: left; display: inline-block; margin: auto;">
            <li>Sistem de matching mentor-mentee pentru o potrivire ideală.</li>
            <li>Programare rapidă și eficientă a sesiunilor.</li>
            <li>Urmărirea progresului pentru îmbunătățiri constante.</li>
            <li>Oferirea de feedback constructiv pentru creșterea calității interacțiunii.</li>
        </ul>
        </p>
        <div class="d-flex flex-wrap justify-content-center">
            <a href="schedule_session.php" class="btn btn-mentorship">Schedule Session</a>
            <a href="submit_feedback.php" class="btn btn-mentorship">Submit Feedback</a>
            <a href="track_progress.php" class="btn btn-mentorship">Track Progress</a>
            <a href="match.php" class="btn btn-mentorship">Match</a>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
</body>
</html>
