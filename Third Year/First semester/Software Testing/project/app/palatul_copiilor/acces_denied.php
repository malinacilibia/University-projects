<?php
// Include localizarea
$lang = $_GET['lang'] ?? 'ro'; // Limba implicită este româna
$messagesFile = "lang/$lang/messages.php";
if (!file_exists($messagesFile)) {
    $lang = 'ro'; // Dacă fișierul nu există, revenim la română
    $messagesFile = "lang/$lang/messages.php";
}
$messages = include $messagesFile;
?>

<?php include 'includes/header.php'; ?>
<!-- includem fisierul pentru antet (header) -->
<link rel="stylesheet" href="css/style.css">
<!-- legam fisierul CSS pentru stilizarea paginii -->

<div class="container mt-5 text-center">
    <!-- continutul principal al paginii, aliniat la centru -->
    <h1 class="text-danger"><?= $messages['access_denied_title'] ?></h1>
    <!-- mesaj de eroare vizibil pentru utilizator -->
    <p><?= $messages['access_denied_message'] ?></p>
    <!-- un mesaj suplimentar pentru utilizator -->
    <p><?= $messages['access_denied_return'] ?> <a href="dashboard.php?lang=<?= htmlspecialchars($lang) ?>"><?= $messages['access_denied_dashboard_link'] ?></a>.</p>
    <!-- un link catre pagina principala -->
    <a href="dashboard.php?lang=<?= htmlspecialchars($lang) ?>" class="btn btn-primary mt-3"><?= $messages['access_denied_back_button'] ?></a>
    <!-- un buton pentru a reveni la pagina principala -->
</div>

<?php include 'includes/footer.php'; ?>
<!-- includem fisierul pentru footer -->
