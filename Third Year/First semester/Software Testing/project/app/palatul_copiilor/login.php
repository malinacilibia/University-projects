<?php
// Pornim sesiunea pentru gestionarea autentificării utilizatorului
session_start();

// Include localizarea
$lang = $_GET['lang'] ?? 'ro'; // Setăm limba implicită ca română
$messagesFile = "lang/$lang/messages.php";
if (!file_exists($messagesFile)) {
    $lang = 'ro'; // Dacă limba selectată nu există, revenim la română
    $messagesFile = "lang/$lang/messages.php";
}
$messages = include $messagesFile;

// Includem fișierul de configurare pentru baza de date
include 'config/Database.php';

$error = ''; // mesaj de eroare inițial gol

// Verificăm dacă formularul a fost trimis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Cream o instanță a clasei Database
    $db = new Database();
    $conn = $db->getConnection();

    // Preluăm datele introduse în formular și le sanitizăm
    $username = htmlspecialchars($_POST['username']); // prevenim XSS
    $password = $_POST['password']; // preluăm parola fără a o hash-ui înca

    // Construim query-ul pentru verificarea datelor de login
    $query = "SELECT * FROM users WHERE username = :username";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username); // Legăm parametrul pentru username
    $stmt->execute(); // Executăm interogarea

    $user = $stmt->fetch(PDO::FETCH_ASSOC); // Preluăm utilizatorul, dacă există

    if ($user && password_verify($password, $user['password'])) {
        // Dacă utilizatorul există și parola este corectă, salvăm datele în sesiune și redirecționăm la dashboard
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: dashboard.php");
        exit; // Oprim execuția scriptului
    } else {
        // Dacă datele nu sunt corecte, setăm mesajul de eroare
        $error = $messages['login_error'];
    }
}
?>
<?php include 'includes/header.php'; ?>
<!-- includem fisierul pentru antet (header) -->
<link rel="stylesheet" href="css/style.css">
<!-- includem fisierul CSS pentru stilizarea paginii -->


<div class="container mt-5">
    <h2><?php echo $messages['login_title']; ?></h2>
    <!-- Afișăm mesajul de eroare, dacă există -->
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <!-- Formular pentru autentificare -->
    <form method="POST" action="login.php?lang=<?php echo $lang; ?>">
        <div class="mb-3">
            <label for="username" class="form-label"><?php echo $messages['username_label']; ?></label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label"><?php echo $messages['password_label']; ?></label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary"><?php echo $messages['login_button']; ?></button>
    </form>
    <div class="text-center mt-3">
        <p class="text-muted">
            <?php echo $messages['no_account_text']; ?>
            <a href="register.php?lang=<?php echo $lang; ?>" class="text-decoration-none"><?php echo $messages['register_link_text']; ?></a>
        </p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
