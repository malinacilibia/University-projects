<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs Board</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .btn-job {
            background-color: #ff66b3;
            color: #fff;
            border: none;
            padding: 15px 25px;
            font-size: 1.1rem;
            border-radius: 8px;
            margin: 10px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-job:hover {
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
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center" style="color: #ff66b3; margin-bottom: 30px;">Jobs Board</h2>
    <div class="container-white-box text-center">
        <p>Bine ai venit la sectiunea de job-uri! Explorează oportunități de carieră și accesează funcționalitățile disponibile pentru a găsi jobul potrivit pentru tine.</p>
        <div class="d-flex flex-wrap justify-content-center">
            <a href="list_jobs.php" class="btn btn-job">Listare Job-uri</a>
            <a href="apply_job.php" class="btn btn-job">Aplicare Directă</a>
            <a href="filter_jobs.php" class="btn btn-job">Filtrare Avansată</a>
            <a href="recommendations.php" class="btn btn-job">Sistem de Recomandări</a>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
</body>
</html>
