<?php
include 'includes/access_control.php';
check_access(['profesor']);
include 'config/Database.php';

// Include localizarea
$lang = $_GET['lang'] ?? 'ro'; // Setăm limba implicită ca română
$messagesFile = "lang/$lang/messages.php";
if (!file_exists($messagesFile)) {
    $lang = 'ro'; // Dacă limba selectată nu există, revenim la română
    $messagesFile = "lang/$lang/messages.php";
}
$messages = include $messagesFile;

if (isset($_GET['id'])) {
    $db = new Database();
    $conn = $db->getConnection();

    $query = "DELETE FROM angajati WHERE cod = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $_GET['id']);

    try {
        if ($stmt->execute()) {
            $message = $messages['delete_success']; // Mesaj de succes
        } else {
            $message = $messages['delete_error']; // Mesaj de eroare
        }
    } catch (PDOException $e) {
        $message = $messages['delete_error'] . ': ' . $e->getMessage(); // Mesaj de eroare detaliat
    }

    // Redirecționăm la lista de angajați cu mesaj
    header("Location: list_angajati.php?lang=$lang&message=" . urlencode($message));
    exit;
}
?>
