<?php include 'includes/header.php'; ?>
<?php
include_once 'config/database.php';
$database = new Database(); // creează o instanță a clasei Database pentru conectarea la baza de date
$conn = $database->getConnection(); // obține conexiunea la baza de date

$show_form = true; // variabilă pentru a controla afișarea formularului

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // verifică dacă metoda HTTP utilizată este POST
    $mentee_name = $_POST['mentee_name']; // preia numele mentee-ului din formular

    // interogare SQL pentru a insera numele mentee-ului în tabelul `match`
    $sql = "INSERT INTO `match` (mentee_name) VALUES (:mentee_name)";
    $stmt = $conn->prepare($sql); // pregătește interogarea SQL
    $stmt->bindParam(':mentee_name', $mentee_name); // leagă parametrul :mentee_name de variabila $mentee_name

    if ($stmt->execute()) { // verifică dacă inserarea datelor în baza de date a fost realizată cu succes
        // interogare pentru a selecta un mentor aleatoriu din tabelul mentors
        $mentor_query = "SELECT name FROM mentors ORDER BY RAND() LIMIT 1";
        $mentor_stmt = $conn->prepare($mentor_query); // pregătește interogarea SQL pentru mentor
        $mentor_stmt->execute(); // execută interogarea
        $mentor = $mentor_stmt->fetch(PDO::FETCH_ASSOC); // preia rezultatul sub formă de array asociativ

        // afișează un mesaj de succes și rezultatul căutării
        echo "<div class='containers'>";
        echo "<h2 style='color: deeppink; background-color: #fff; padding: 20px; border-radius: 10px;'>Data a fost salvată cu succes în baza de date.</h2>";
        echo "<h2>Rezultatul căutării:</h2>";
        echo "<p><strong>Nume Mentee:</strong> $mentee_name</p>";

        if ($mentor) { // verifică dacă un mentor a fost găsit
            echo "<p><strong>Mentorul găsit pentru $mentee_name este:</strong> " . htmlspecialchars($mentor['name']) . "</p>";
        } else { // afișează un mesaj dacă nu a fost găsit niciun mentor
            echo "<p><strong>Nu a fost găsit niciun mentor disponibil pentru $mentee_name.</strong></p>";
        }

        echo "<a href='mentorship.php' class='btn btn-mentorship'>Înapoi la Mentorship</a>";
        echo "</div>";
        $show_form = false; // setează $show_form la false pentru a ascunde formularul după salvarea datelor
    } else { // afișează un mesaj de eroare dacă inserarea în baza de date a eșuat
        $errorInfo = $stmt->errorInfo(); // preia detalii despre eroare
        echo "<h2 style='color: #d9534f;'>Eroare la salvarea datelor: " . $errorInfo[2] . "</h2>"; // afișează mesajul de eroare
    }

    $conn = null; // închide conexiunea la baza de date
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Matching Mentor-Mentee</title>
    <link rel="stylesheet" href="css/style_mentorship.css">
</head>
<body>
<div class="containers">
    <?php if ($show_form): ?>
        <!--afișează un formular de programare a unei sesiuni doar dacă $show_form este true.
            dacă formularul este completat și sesiunea este programată cu succes, $show_form devine false, iar formularul nu mai este afișat.-->
        <h1>Matching Mentor-Mentee</h1>
        <form method="POST" action="match.php">
            <label for="mentee_name">Nume Mentee:</label>
            <input type="text" name="mentee_name" id="mentee_name" required>
            <button type="submit">Caută Mentor</button>
        </form>
        <a href='mentorship.php' class='btn btn-mentorship'>Înapoi la Mentorship</a>
    <?php endif; ?>
</div>
<?php include_once "includes/footer.php"; ?>
</body>
</html>
