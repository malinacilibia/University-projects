<?php
session_start();
include 'config/Database.php';

// Include localizarea
$lang = $_GET['lang'] ?? 'ro'; // Setăm limba implicită ca română
$messagesFile = "lang/$lang/messages.php";
if (!file_exists($messagesFile)) {
    $lang = 'ro'; // Dacă limba selectată nu există, revenim la română
    $messagesFile = "lang/$lang/messages.php";
}
$messages = include $messagesFile;

// Inițializează mesajul de eroare
$error = '';
$success = '';

// Verifică dacă formularul a fost trimis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $role = $_POST['role'];
    $email = htmlspecialchars($_POST['email']);

    try {
        $db = new Database();
        $conn = $db->getConnection();
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $insertQuery = "INSERT INTO users (username, password, role, email) VALUES (:username, :password, :role, :email)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bindParam(':username', $username);
        $insertStmt->bindParam(':password', $hashedPassword);
        $insertStmt->bindParam(':role', $role);
        $insertStmt->bindParam(':email', $email);

        if ($insertStmt->execute()) {
            $success = $messages['account_created_successfully'];
        } else {
            $error = $messages['account_creation_error'];
        }
    } catch (PDOException $e) {
        $error = $messages['db_connection_error'] . $e->getMessage();
    }
}
?>
<?php include 'includes/header.php'; ?>
<!-- Formularul de înregistrare -->
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $messages['register_title'] ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container mt-5">
    <h2><?= $messages['register_title'] ?></h2>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>
    <form method="POST" action="register.php?lang=<?= htmlspecialchars($lang) ?>">
        <div class="mb-3">
            <label for="username" class="form-label"><?= $messages['username_label'] ?></label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label"><?= $messages['password_label'] ?></label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label"><?= $messages['email_label'] ?></label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label"><?= $messages['role_label'] ?></label>
            <select class="form-control" id="role" name="role" required>
                <option value="elev">Elev</option>
                <option value="profesor">Profesor</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary"><?= $messages['register_title'] ?></button>
    </form>
</div>
</body>
</html>
<?php include 'includes/footer.php'; ?>
