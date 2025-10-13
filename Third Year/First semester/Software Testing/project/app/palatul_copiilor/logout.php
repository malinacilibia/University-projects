<?php
session_start();

// Include localizarea
$lang = $_GET['lang'] ?? 'ro'; // Setăm limba implicită ca română
$messagesFile = "lang/$lang/messages.php";
if (!file_exists($messagesFile)) {
    $lang = 'ro'; // Dacă limba selectată nu există, revenim la română
    $messagesFile = "lang/$lang/messages.php";
}
$messages = include $messagesFile;

// Distruge sesiunea
session_destroy();
header("Location: login.php");
exit;

?>


<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        // Redirecționare automată după 3 secunde
        setTimeout(() => {
            window.location.href = "login.php?lang=<?php echo $lang; ?>";
        }, 3000);
    </script>
</head>
<body>
<div class="container mt-5 text-center">
    <h2><?php echo $messages['logout_message']; ?></h2>
    <p><?php echo $messages['redirect_message']; ?></p>
</div>
</body>
</html>
