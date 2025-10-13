<?php
include_once "includes/header.php";
include 'config/database.php';

$database = new Database(); // creeaza o instanta a clasei database pentru conexiunea la baza de date
$conn = $database->getConnection(); // obtine conexiunea la baza de date

$sql = "SELECT ef.rating, ef.comments, e.name AS event_name
        FROM eventsfeedback ef
        JOIN events e ON ef.event_id = e.id
        ORDER BY ef.id DESC";
// interogare sql pentru a prelua ratingul, comentariile si numele evenimentelor
// face o legatura intre tabelele eventsfeedback si events prin event_id si id
// datele sunt ordonate descrescator dupa id-ul din tabelul eventsfeedback

$stmt = $conn->prepare($sql); // pregateste interogarea sql pentru executie
$stmt->execute(); // executa interogarea sql pregatita
$feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC); // preia toate rezultatele sub forma de array

?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Evenimente</title>
    <link rel="stylesheet" href="css/style_events.css">
</head>
<body>
<div class="container">
    <div class="feedback-section">
        <h3 class="text-center">Feedback-uri primite</h3>
        <?php if (!empty($feedbacks)): ?>
            <ul>
                <?php foreach ($feedbacks as $feedback): ?>
                    <li>
                        <strong>Eveniment:</strong> <?php echo htmlspecialchars($feedback['event_name']); ?><br>
                        <strong>Rating:</strong> <?php echo htmlspecialchars($feedback['rating']); ?><br>
                        <strong>Comentarii:</strong> <?php echo htmlspecialchars($feedback['comments']); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="text-center">Nu există feedback-uri disponibile.</p>
        <?php endif; ?>
    </div>
</div>
<a href="events.php" class="btn btn-secondary mt-3">Înapoi la pagina Events</a>

<?php include_once "includes/footer.php"; ?>
</body>
</html>
