<?php include 'includes/header.php'; ?>
<?php
include_once 'config/database.php';

$database = new Database(); // creeaza o instanta a clasei database pentru conexiunea la baza de date
$conn = $database->getConnection(); // obtine conexiunea la baza de date

$show_form = true; // variabila pentru a controla afisarea formularului

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // verifica daca metoda utilizata este POST
    $mentor_name = $_POST['mentor_name']; // preia numele mentorului din formular
    $mentee_name = $_POST['mentee_name']; // preia numele mentee-ului din formular
    $date = $_POST['date']; // preia data sesiunii din formular
    $time = $_POST['time']; // preia ora sesiunii din formular
    $subject = $_POST['subject']; // preia subiectul discutiei din formular

    if ($conn) { // verifica daca conexiunea la baza de date a fost realizata cu succes
        // interogare sql pentru a insera o noua sesiune in tabelul sessions
        $sql = "INSERT INTO sessions (mentor_name, mentee_name, date, time, subject) VALUES (:mentor_name, :mentee_name, :date, :time, :subject)";
        $stmt = $conn->prepare($sql); // pregateste interogarea sql
        $stmt->bindParam(':mentor_name', $mentor_name); // leaga parametrul :mentor_name de variabila $mentor_name
        $stmt->bindParam(':mentee_name', $mentee_name); // leaga parametrul :mentee_name de variabila $mentee_name
        $stmt->bindParam(':date', $date); // leaga parametrul :date de variabila $date
        $stmt->bindParam(':time', $time); // leaga parametrul :time de variabila $time
        $stmt->bindParam(':subject', $subject); // leaga parametrul :subject de variabila $subject

        if ($stmt->execute()) { // verifica daca interogarea a fost executata cu succes
            // afiseaza un mesaj de succes si detaliile sesiunii programate
            echo "<div class='containers'>";
            echo "<h2 style='color: deeppink; background-color: #fff; padding: 20px; border-radius: 10px;'>Vă mulțumim! Sesiunea a fost programată cu succes.</h2>";
            echo "<p><strong>Mentor:</strong> $mentor_name</p>";
            echo "<p><strong>Mentee:</strong> $mentee_name</p>";
            echo "<p><strong>Data:</strong> $date</p>";
            echo "<p><strong>Ora:</strong> $time</p>";
            echo "<p><strong>Subiect:</strong> $subject</p>";
            echo "<a href='mentorship.php' class='btn btn-mentorship'>Înapoi la Mentorship</a>";
            echo "</div>";
            $show_form = false; // seteaza variabila la false pentru a ascunde formularul
        } else {
            // afiseaza un mesaj de eroare daca interogarea a esuat
            echo "<h2 style='color: #d9534f;'>Eroare la salvarea datelor.</h2>";
        }
    } else {
        // afiseaza un mesaj de eroare daca conexiunea la baza de date nu a fost stabilita
        echo "<h2 style='color: #d9534f;'>Eroare: Nu s-a putut stabili conexiunea la baza de date.</h2>";
    }

    $conn = null; // inchide conexiunea la baza de date
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Programare Sesiuni</title>
    <link rel="stylesheet" href="css/style_mentorship.css">
</head>
<body>
<div class="containers">
    <?php if ($show_form): ?>
    <!--afișează un formular de programare a unei sesiuni doar dacă $show_form este true.
        dacă formularul este completat și sesiunea este programată cu succes, $show_form devine false, iar formularul nu mai este afișat.-->
        <h1>Programare Sesiuni</h1>
        <form method="POST" action="schedule_session.php">
            <label for="mentor_name">Nume Mentor:</label>
            <input type="text" name="mentor_name" id="mentor_name" required>
            <label for="mentee_name">Nume Mentee:</label>
            <input type="text" name="mentee_name" id="mentee_name" required>
            <label for="date">Data:</label>
            <input type="date" name="date" id="date" required>
            <label for="time">Ora:</label>
            <input type="time" name="time" id="time" required>
            <label for="subject">Subiect:</label>
            <input type="text" name="subject" id="subject" required>
            <button type="submit">Programează Sesiunea</button>
        </form>
        <a href='mentorship.php' class='btn btn-mentorship'>Înapoi la Mentorship</a>
    <?php endif; ?>
</div>
<?php include 'includes/footer.php'; ?>
</body>
</html>
