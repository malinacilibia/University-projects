<?php
include_once "includes/header.php";
include 'config/database.php';

$database = new Database(); // creeaza o instanta a clasei database pentru conectarea la baza de date
$conn = $database->getConnection(); // obtine conexiunea la baza de date

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // verifica daca formularul a fost trimis folosind metoda POST
    $event_id = (int)$_POST['event_id']; // preia si converteste id-ul evenimentului intr-un numar intreg
    $rating = (int)$_POST['rating']; // preia si converteste rating-ul intr-un numar intreg
    $comments = htmlspecialchars($_POST['comments']); // preia comentariile si le curata pentru a preveni atacurile xss

    // interogare sql pentru a insera un nou feedback in tabelul eventsfeedback
    $sql = "INSERT INTO eventsfeedback (event_id, rating, comments) VALUES (:event_id, :rating, :comments)";
    $stmt = $conn->prepare($sql); // pregateste interogarea sql
    $stmt->bindParam(':event_id', $event_id); // leaga parametrul :event_id de variabila $event_id
    $stmt->bindParam(':rating', $rating); // leaga parametrul :rating de variabila $rating
    $stmt->bindParam(':comments', $comments); // leaga parametrul :comments de variabila $comments
    $stmt->execute(); // executa interogarea sql pentru a adauga feedback-ul

    echo "<h3 class='text-center'>Mulțumim pentru feedback!</h3>"; // mesaj de confirmare pentru utilizator
    echo "<a href='events.php' class='btn btn-secondary mt-3'>Înapoi la pagina Events</a>"; // link pentru revenirea la pagina evenimentelor
    exit(); // opreste executia scriptului dupa ce feedback-ul a fost trimis
}

// interogare sql pentru a prelua toate evenimentele din tabelul events
$sql = "SELECT * FROM events";
$stmt = $conn->prepare($sql); // pregateste interogarea sql
$stmt->execute(); // executa interogarea
$events = $stmt->fetchAll(PDO::FETCH_ASSOC); // preia toate evenimentele sub forma de array asociativ

?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Feedback Eveniment</title>
    <link rel="stylesheet" href="css/style_events.css">
</head>
<body>
<div class="container">
    <h3 class="text-center">Feedback pentru eveniment</h3>
    <form method="POST" action="feedback.php" class="feedback-form">
        <label for="event">Eveniment:</label>
        <select id="event" name="event_id" required>
            <?php foreach ($events as $event): ?> <!-- parcurgem toate elementele din arrayul $events, $event reprezinta un rand -->
                <option value="<?php echo $event['id']; ?>"><?php echo htmlspecialchars($event['name']); // afiseaza numele evenimentului curatand eventualele caractere speciale ?> </option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="rating">Rating (1-5):</label>
        <input type="number" id="rating" name="rating" min="1" max="5" required><br><br>

        <label for="comments">Comentarii:</label><br>
        <textarea id="comments" name="comments" placeholder="Adaugă comentariile tale aici"></textarea><br><br>

        <button type="submit" class="btn btn-primary">Trimite Feedback</button>

    </form>
    <a href="events.php" class="btn btn-secondary mt-3">Înapoi la pagina Events</a>
    <a href="events_feedback.php" class="btn btn-secondary mt-3">Vizualizeaza feedback-ul</a>

</div>
<?php include_once "includes/footer.php"; ?>
</body>
</html>
