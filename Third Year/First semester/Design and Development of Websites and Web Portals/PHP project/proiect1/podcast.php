<?php include_once "includes/header.php"; ?>
<?php
include 'config/database.php';

$database = new Database(); // creează o instanță a clasei Database pentru conectarea la baza de date
$conn = $database->getConnection(); // obține conexiunea activă la baza de date

if ($conn) { // verifică dacă conexiunea la baza de date a fost realizată
    $sql = "SELECT * FROM resources WHERE type = 'Podcast' ORDER BY date DESC";
    // interogare SQL pentru a selecta toate resursele de tip 'Podcast'
    // rezultatele sunt ordonate descrescător după dată (cele mai noi apar primele)

    $stmt = $conn->prepare($sql); // pregătește interogarea SQL
    $stmt->execute(); // execută interogarea SQL
    $podcasts = $stmt->fetchAll(PDO::FETCH_ASSOC); // preia toate rezultatele sub formă de array asociativ
} else {
    $podcasts = []; // inițializează lista podcasturilor ca un array gol în cazul în care conexiunea eșuează
    echo "<p class='error'>Eroare: Nu s-a putut stabili conexiunea la baza de date.</p>";
    // afișează un mesaj de eroare dacă conexiunea la baza de date nu a fost realizată
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Podcast-uri</title>
    <link rel="stylesheet" href="css/style_resources.css">
</head>
<body>
<h1>Podcast-uri</h1>
<div class="content-section">
    <p>Ascultați podcast-uri inspiraționale despre tehnologie și povești motivaționale din industrie.</p>
    <div class="podcasts-container">
        <?php foreach ($podcasts as $podcast): ?>
            <!-- Iterează prin fiecare podcast din lista $podcasts -->
            <div class="podcast-card">
                <strong><?php echo htmlspecialchars($podcast['title']); ?></strong>
                <p><?php echo htmlspecialchars($podcast['description']); ?></p>
                <a href="<?php echo htmlspecialchars($podcast['url']); ?>" target="_blank">Ascultă</a>
                <!-- Afișează titlul podcastului, descrierea si linkul catre acesta; htmlspecialchars() este utilizat pentru curatare-->
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php $conn = null; ?>
<a href="resource_hub.php" class="btn-back">Înapoi la Resource Hub</a>

<?php include 'includes/footer.php'; ?>
</body>
</html>
