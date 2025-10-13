<?php
include 'session.php';

// Verificăm limba selectată
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
    setcookie('lang', $_GET['lang'], time() + (3600 * 24 * 30)); // Salvăm limba în cookie pentru 30 de zile
} elseif (isset($_COOKIE['lang'])) {
    $_SESSION['lang'] = $_COOKIE['lang'];
} else {
    $_SESSION['lang'] = 'ro'; // Limba implicită
}

$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem de Gestiune Programări</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Header auriu */
        nav.navbar {
            background-color: #B8860B; /* Auriu închis */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Link-urile din navbar */
        nav.navbar .nav-link {
            color: white; /* Alb pentru text */
            font-weight: bold;
            margin-left: 10px; /* Spațiu între link-uri */
            transition: color 0.3s ease;
        }

        nav.navbar .nav-link:hover {
            color: #D4AF37; /* Aurie deschisă */
        }

        /* Textul brandului */
        nav.navbar .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: white; /* Alb pentru text */
        }

        nav.navbar .navbar-brand:hover {
            color: #D4AF37; /* Aurie deschisă */
        }

        /* Elementele din dreapta */
        .navbar-right {
            margin-left: auto;
        }

        /* Butoane */
        .btn {
            font-weight: bold;
            border-radius: 5px;
        }

        .btn-login, .btn-register {
            background-color: #D4AF37; /* Aurie deschisă */
            color: #4A3F35; /* Maro închis */
            border: none;
            padding: 5px 15px;
            margin-left: 5px;
        }

        .btn-login:hover, .btn-register:hover {
            background-color: #B8860B; /* Auriu închis */
            color: white; /* Alb */
        }

        /* Selector limbă */
        .language-selector {
            margin-left: 10px;
        }

        .language-selector select {
            padding: 5px;
            border-radius: 5px;
            font-size: 14px;
        }
        .language-selector select {
            background-color: #D4AF37; /* Aurie deschisă */
            color: #4A3F35; /* Maro închis */
            font-weight: bold;
            border: 2px solid #B8860B; /* Auriu închis */
            border-radius: 5px;
            padding: 5px 10px;
            font-size: 14px;
            outline: none;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .language-selector select:hover {
            background-color: #B8860B; /* Auriu închis */
            color: white; /* Alb */
        }

        .language-selector select:focus {
            border-color: #D4AF37; /* Aurie deschisă */
            box-shadow: 0 0 5px rgba(212, 175, 55, 0.5);
        }

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="containers">
        <a class="navbar-brand" href="index.php">Palatul Copiilor Cluj</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php if ($role === 'profesor'): ?>
                    <!-- Linkuri pentru profesori -->
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="participanti.php">Participanți</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="angajati.php">Angajați</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="activitati.php">Activități</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="programari.php">Programări</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="plati.php">Plăți</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="lista_utilizatori.php">Utilizatori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profil_utilizator.php">Profilul Meu</a>
                    </li>
                <?php elseif ($role === 'elev'): ?>
                    <!-- Linkuri pentru elevi -->
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="activitati.php">Activități</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="programari_elevi.php">Programările Mele</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="lista_utilizatori.php">Utilizatori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profil_utilizator.php">Profilul Meu</a>
                    </li>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav navbar-right">
                <!-- Selector de limbă -->
                <li class="nav-item language-selector">
                    <form action="" method="get">
                        <select name="lang" id="language" onchange="this.form.submit()">
                            <option value="ro" <?= $_SESSION['lang'] === 'ro' ? 'selected' : '' ?>>Română</option>
                            <option value="en" <?= $_SESSION['lang'] === 'en' ? 'selected' : '' ?>>English</option>
                        </select>
                    </form>
                </li>
                <!-- Butoane din dreapta -->
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="help.php">Ajutor</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
</body>
</html>
