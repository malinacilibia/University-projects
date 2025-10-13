<?php

$message = ''; // Mesaj implicit gol
$error = '';   // Eroare implicită goală

// Includem fișierul de configurare pentru baza de date
require 'config/Database.php';


// Include localizarea
$lang = $_GET['lang'] ?? 'ro'; // Setăm limba implicită ca română
$messagesFile = "lang/$lang/messages.php";
if (!file_exists($messagesFile)) {
    $lang = 'ro'; // Dacă limba selectată nu există, revenim la română
    $messagesFile = "lang/$lang/messages.php";
}
$messages = include $messagesFile;


// Cream o instanță a clasei Database
$db = new Database();
$conn = $db->getConnection();


// Verificăm dacă a fost primit un ID pentru participantul de șters
if (isset($_GET['id'])) {
    $cod = $_GET['id']; // Preluăm ID-ul participantului din query string


        // Construim query-ul SQL pentru ștergerea participantului
        $query = "DELETE FROM participanti WHERE cod = ?";
        $stmt = $conn->prepare($query); // Pregătim interogarea
        $stmt->execute([$cod]); // Executăm interogarea cu ID-ul primit


    // Redirecționăm la pagina participantilor cu mesajul corespunzător
    header("Location: participanti.php?lang=$lang&message=" . urlencode($message) . "&error=" . urlencode($error));
    exit; // Oprim execuția scriptului
}
?>
