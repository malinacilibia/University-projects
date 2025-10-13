<?php include 'includes/header.php'; ?>
<?php
include_once 'config/database.php';

$database = new Database(); // creeaza o instanta a clasei database pentru conectarea la baza de date
$conn = $database->getConnection(); // obtine conexiunea la baza de date

$show_form = true; // variabila pentru a controla afisarea formularului

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // verifica daca metoda HTTP utilizata este POST
    $description = $_POST['description']; // preia descrierea progresului din formular
    $status = $_POST['status']; // preia statusul progresului din formular
    $objectivesMet = $_POST['objectivesMet']; // preia obiectivele indeplinite din formular

    // interogare SQL pentru a insera progresul in tabelul progress
    $sql = "INSERT INTO progress (description, status, objectives_met) VALUES (:description, :status, :objectivesMet)";
    $stmt = $conn->prepare($sql); // pregateste interogarea SQL
    $stmt->bindParam(':description', $description); // leaga parametrul :description de variabila $description
    $stmt->bindParam(':status', $status); // leaga parametrul :status de variabila $status
    $stmt->bindParam(':objectivesMet', $objectivesMet); // leaga parametrul :objectivesMet de variabila $objectivesMet

    if ($stmt->execute()) { // verifica daca interogarea SQL a fost executata cu succes
        // afiseaza un mesaj de confirmare si detaliile progresului inregistrat
        echo "<div class='containers'>";
        echo "<h2 style='color: deeppink; background-color: #fff; padding: 20px; border-radius: 10px;'>Vă mulțumim! Progresul a fost înregistrat cu succes.</h2>";
        echo "<h2>Progres înregistrat:</h2>";
        echo "<p><strong>Descriere:</strong> $description</p>";
        echo "<p><strong>Status:</strong> $status</p>";
        echo "<p><strong>Obiective Îndeplinite:</strong> $objectivesMet</p>";
        echo "<a href='mentorship.php' class='btn btn-mentorship'>Înapoi la Mentorship</a>";
        echo "</div>";
        $show_form = false; // seteaza $show_form la false pentru a ascunde formularul dupa inregistrare
    } else {
        // afiseaza un mesaj de eroare daca interogarea SQL a esuat
        echo "<h2 style='color: #d9534f;'>Eroare la salvarea progresului.</h2>";
    }

    $conn = null; // inchide conexiunea la baza de date
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tracking Progres</title>
    <link rel="stylesheet" href="css/style_mentorship.css">
</head>
<body>
<div class="containers">
    <?php if ($show_form): ?>
        <!--afișează un formular de programare a unei sesiuni doar dacă $show_form este true.
           dacă formularul este completat și sesiunea este programată cu succes, $show_form devine false, iar formularul nu mai este afișat.-->
        <h1>Tracking Progres</h1>
        <form method="POST" action="track_progress.php">
            <label for="description">Descriere:</label>
            <input type="text" name="description" id="description" required>
            <label for="status">Status:</label>
            <input type="text" name="status" id="status" required>
            <label for="objectivesMet">Obiective Îndeplinite:</label>
            <input type="text" name="objectivesMet" id="objectivesMet" required>
            <button type="submit">Înregistrează Progresul</button>
        </form>
        <a href='mentorship.php' class='btn btn-mentorship'>Înapoi la Mentorship</a>
    <?php endif; ?>
</div>
<?php include_once "includes/footer.php"; ?>
</body>
</html>
