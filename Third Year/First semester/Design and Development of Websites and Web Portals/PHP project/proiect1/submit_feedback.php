<?php include 'includes/header.php'; ?>
<?php
include_once 'config/database.php';

$database = new Database(); // creeaza o instanta a clasei database pentru conectarea la baza de date
$conn = $database->getConnection(); // obtine conexiunea la baza de date
$show_form = true; // variabila pentru a controla afisarea formularului

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // verifica daca metoda HTTP utilizata este POST
    $mentor_name = $_POST['mentor_name']; // preia numele mentorului din formular
    $mentee_name = $_POST['mentee_name']; // preia numele mentee-ului din formular
    $rating = $_POST['rating']; // preia rating-ul acordat din formular
    $comments = $_POST['comments']; // preia comentariile din formular

    // interogare SQL pentru a insera feedback-ul in tabelul feedback
    $sql = "INSERT INTO feedback (mentor_name, mentee_name, rating, comments) VALUES (:mentor_name, :mentee_name, :rating, :comments)";
    $stmt = $conn->prepare($sql); // pregateste interogarea SQL
    $stmt->bindParam(':mentor_name', $mentor_name); // leaga parametrul :mentor_name de variabila $mentor_name
    $stmt->bindParam(':mentee_name', $mentee_name); // leaga parametrul :mentee_name de variabila $mentee_name
    $stmt->bindParam(':rating', $rating, PDO::PARAM_INT); // leaga parametrul :rating de variabila $rating si specifica tipul intreg
    $stmt->bindParam(':comments', $comments); // leaga parametrul :comments de variabila $comments

    if ($stmt->execute()) { // verifica daca interogarea SQL a fost executata cu succes
        // afiseaza un mesaj de confirmare si detaliile feedback-ului
        echo "<div class='containers'>";
        echo "<h2 style='color: deeppink; background-color: #fff; padding: 20px; border-radius: 10px;'>Feedback-ul a fost salvat cu succes în baza de date.</h2>";
        echo "<p><strong>Mentor:</strong> $mentor_name</p>";
        echo "<p><strong>Mentee:</strong> $mentee_name</p>";
        echo "<p><strong>Rating:</strong> $rating</p>";
        echo "<p><strong>Comentarii:</strong> $comments</p>";
        echo "<a href='mentorship.php' class='btn btn-mentorship'>Înapoi la Mentorship</a>";
        echo "</div>";
        $show_form = false; // seteaza $show_form la false pentru a ascunde formularul dupa salvarea feedback-ului
    } else {
        // afiseaza un mesaj de eroare daca interogarea SQL a esuat
        echo "<h2 style='color: #d9534f;'>Eroare la salvarea feedback-ului.</h2>";
    }

    $conn = null; // inchide conexiunea la baza de date
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback</title>
    <link rel="stylesheet" href="css/style_mentorship.css">
</head>
<body>
<?php if ($show_form): ?>
    <!--afișează un formular de programare a unei sesiuni doar dacă $show_form este true.
        dacă formularul este completat și sesiunea este programată cu succes, $show_form devine false, iar formularul nu mai este afișat.-->
    <div class="containers">
        <h1>Submit Feedback</h1>
        <form method="POST" action="submit_feedback.php">
            <label for="mentor_name">Nume Mentor:</label>
            <input type="text" name="mentor_name" id="mentor_name" required>
            <label for="mentee_name">Nume Mentee:</label>
            <input type="text" name="mentee_name" id="mentee_name" required>
            <label for="rating">Rating:</label>
            <input type="number" name="rating" id="rating" min="1" max="5" required>
            <label for="comments">Comentarii:</label>
            <textarea name="comments" id="comments" required></textarea>
            <button type="submit">Trimite Feedback</button>
        </form>
        <a href='mentorship.php' class='btn btn-mentorship'>Înapoi la Mentorship</a>
    </div>
<?php endif; ?>
<?php include_once "includes/footer.php"; ?>
</body>
</html>
