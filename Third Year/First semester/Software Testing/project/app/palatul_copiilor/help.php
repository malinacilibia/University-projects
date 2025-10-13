<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help - Palatul Copiilor</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.5/dist/cdn.min.js" defer></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff8e1;
            color: #5d4037;
            margin: 0;
            padding: 0;
        }

        header, footer {
            background-color: #a1887f;
            color: white;
            text-align: center;
            padding: 10px 0;
        }

        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background: #fff3e0;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        h1 {
            color: #000;
        }

        h2 {
            color: #f57c00;
            font-size: 1.8rem;
            margin-bottom: 15px;
        }

        h3 {
            color: #5d4037;
            font-size: 1.2rem;
            margin-top: 10px;
            font-weight: bold;
        }

        p, ul {
            font-size: 1rem;
            line-height: 1.6;
            color: #5d4037;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        ul li {
            margin-bottom: 10px;
            position: relative;
            padding-left: 20px;
        }

        ul li:before {
            content: "•";
            position: absolute;
            left: 0;
            color: #f57c00;
            font-size: 1.2rem;
            line-height: 1.5;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            background: white;
            border: 2px solid #fdd835;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #f9a825;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 1rem;
            margin-bottom: 15px;
            color: #5d4037;
        }

        .btn {
            background-color: #fdd835;
            border: none;
            color: #5d4037;
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #fbc02d;
        }

        .text-muted {
            color: #757575;
        }

        [x-show="false"] {
            display: none !important;
        }
    </style>
</head>
<body>
<?php include 'includes/header.php'; ?>

<div class="container mt-5" x-data="{ showFAQ: false, showContact: false }">
    <div class="text-center mb-4">
        <h1 class="display-4">Ajutor și Suport</h1>
        <p class="lead text-muted">Descoperă cum să folosești aplicația noastră pentru a-ți gestiona activitățile.</p>
    </div>

    <div class="row">
        <div class="card">
            <h3 class="card-title">Gestionarea activităților</h3>
            <p class="card-text">Adaugă, editează și șterge activități pentru utilizatori.</p>
            <a href="activitati.php" class="btn">Accesează</a>
        </div>
        <div class="card">
            <h3 class="card-title">Programări</h3>
            <p class="card-text">Permite programarea la diverse activități.</p>
            <a href="programari.php" class="btn">Accesează</a>
        </div>
        <div class="card">
            <h3 class="card-title">Participanți</h3>
            <p class="card-text">Adaugă, editează sau șterge informațiile participanților.(doar profesorii)</p>
            <a href="participanti.php" class="btn">Accesează</a>
        </div>
        <div class="card">
            <h3 class="card-title">Plăți</h3>
            <p class="card-text">Urmărește și administrează plățile efectuate.</p>
            <a href="plati.php" class="btn">Accesează</a>
        </div>

        <div class="card">
            <h3 class="card-title">Întrebări frecvente</h3>
            <p class="card-text">Răspunsuri rapide la cele mai comune întrebări.</p>
            <button class="btn" @click="showFAQ = !showFAQ; showContact = false">Vezi Detalii</button>
        </div>
        <div class="card">
            <h3 class="card-title">Contact</h3>
            <p class="card-text">Ai nevoie de ajutor suplimentar? Contactează-ne!</p>
            <button class="btn" @click="showContact = !showContact; showFAQ = false">Vezi Detalii</button>
        </div>
    </div>

    <div x-show="showFAQ" class="text mb-4">
        <h2>Întrebări frecvente (FAQ)</h2>
        <div>
            <h3>1. Cum mă pot autentifica?</h3>
            <p>Accesează pagina de <a href="login.php">Login</a> și introdu datele de utilizator și parola.</p>

            <h3>2. Ce fac dacă am uitat parola?</h3>
            <p>Contactează administratorul sistemului pentru a reseta parola.</p>

            <h3>3. Cum adaug o activitate?</h3>
            <p>Mergi la secțiunea <a href="activitati.php">Activități</a> și apasă pe butonul "Adaugă activitate".</p>
        </div>
    </div>

    <div x-show="showContact" class="text mb-4">

        <h2>Contact</h2>
        <p>Dacă ai nevoie de ajutor suplimentar, ne poți contacta la:</p>
        <ul>
            <li>Email: suport@palatulcopiilor.ro</li>
            <li>Telefon: +40 123 456 789</li>
        </ul>
    </div>

    <div class="text-center mt-5">
        <p class="text-muted">Dacă ai nevoie de ajutor suplimentar, te rugăm să contactezi un administrator.</p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
