<?php
session_start(); // porneste sesiunea pentru a putea folosi variabila $_SESSION
include_once "includes/header.php";
include 'config/database.php';

$db = new Database(); // creeaza o instanta a clasei Database
$conn = $db->getConnection(); // obtine conexiunea activa la baza de date
if ($_SERVER['REQUEST_METHOD'] === 'POST') { // verifica daca formularul a fost trimis folosind metoda POST
    $email = $_POST['email']; // preia email-ul introdus de utilizator in formular
    $password = $_POST['password']; // preia parola introdusa de utilizator in formular

    $query = "SELECT * FROM users WHERE email = :email"; // interogare SQL pentru a cauta utilizatorul dupa email
    $stmt = $conn->prepare($query); // pregateste interogarea SQL pentru executie
    $stmt->bindParam(':email', $email); // leaga variabila $email de parametrul :email din query
    $stmt->execute(); // executa interogarea SQL
    $user = $stmt->fetch(PDO::FETCH_ASSOC); // preia rezultatul ca un array asociativ

    if ($user && password_verify($password, $user['password'])) { // verifica daca utilizatorul exista si parola introdusa corespunde celei din baza de date
        $_SESSION['user_id'] = $user['id']; // stocheaza id-ul utilizatorului in sesiune
        $_SESSION['role'] = $user['role']; // stocheaza rolul utilizatorului in sesiune
        $_SESSION['name'] = $user['name']; // stocheaza numele utilizatorului in sesiune

        // redirectioneaza utilizatorul in functie de rolul sau
        switch ($user['role']) {
            case 'admin': // daca rolul este admin
                header("Location: admin_dashboard.php"); // redirectioneaza la pagina dashboard-ului de admin
                break;
            case 'mentor': // daca rolul este mentor
                header("Location: mentor_dashboard.php"); // redirectioneaza la pagina dashboard-ului de mentor
                break;
            case 'member': // daca rolul este member
                header("Location: member_dashboard.php"); // redirectioneaza la pagina dashboard-ului de membru
                break;
            default: // daca rolul nu este recunoscut
                header("Location: login.php"); // redirectioneaza inapoi la pagina de login
        }
        exit(); // opreste executia scriptului dupa redirectionare
    } else {
        $error = "Email sau parola incorecta!"; // mesaj de eroare daca email-ul sau parola sunt gresite
    }
}
?>


<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style_login.css">
</head>
<body>
<div class="login-container">
    <h2 class="text-center">Autentificare</h2>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST" action="login.php">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Parolă:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
</div>
</body>
</html>
<?php
include_once "includes/footer.php";
?>
