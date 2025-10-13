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

$message = ''; // Mesaj de succes
$error = '';

// Verifică dacă utilizatorul este autentificat
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirecționează utilizatorii neautentificați la pagina de login
    exit;
}

$db = new Database();
$conn = $db->getConnection();


// Obține lista utilizatorilor
$query = "SELECT username, email, avatar, role FROM users";
$stmt = $conn->prepare($query);
$stmt->execute();
$utilizatori = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include 'includes/header.php'; ?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $messages['users_list_title']; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container mt-5">
    <!-- Afișăm mesajele de succes sau eroare -->
    <?php if ($message): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <h2 class="text-center text-secondary"><?php echo $messages['users_list_title']; ?></h2>
    <table class="table table-bordered table-hover shadow-sm">
        <thead class="table-warning">
        <tr>
            <th><?php echo $messages['table_avatar']; ?></th>
            <th><?php echo $messages['table_username']; ?></th>
            <th><?php echo $messages['table_email']; ?></th>
            <th><?php echo $messages['table_role']; ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($utilizatori as $utilizator): ?>
            <tr>
                <td>
                    <img src="<?= htmlspecialchars($utilizator['avatar']) ?>" alt="Avatar" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                </td>
                <td><?= htmlspecialchars($utilizator['username']) ?></td>
                <td><?= htmlspecialchars($utilizator['email']) ?></td>
                <td><?= htmlspecialchars($utilizator['role']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
<?php include 'includes/footer.php'; ?>
