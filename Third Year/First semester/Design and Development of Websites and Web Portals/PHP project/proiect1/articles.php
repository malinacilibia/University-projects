<?php include_once "includes/header.php"; ?>
<?php
include 'config/database.php'; // include fișierul pentru conectarea la baza de date

$database = new Database(); // creează o instanță a clasei Database pentru conectarea la baza de date
$conn = $database->getConnection(); // obține conexiunea activă la baza de date

if ($conn) { // verifică dacă conexiunea la baza de date a fost realizată
    $sql = "SELECT * FROM resources WHERE type = 'Articol' ORDER BY date DESC";
    // interogare SQL pentru a selecta toate resursele de tip 'Articol'
    // rezultatele sunt ordonate descrescător după dată

    $stmt = $conn->prepare($sql); // pregătește interogarea SQL
    $stmt->execute(); // execută interogarea SQL
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC); // preia toate rezultatele sub formă de array asociativ
} else {
    $articles = []; // inițializează lista articolelor ca un array gol în cazul în care conexiunea eșuează
    echo "<p class='error'>Eroare: Nu s-a putut stabili conexiunea la baza de date.</p>";
    // afișează un mesaj de eroare dacă conexiunea la baza de date nu a fost realizată
}

?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Articole și Tutoriale</title>
    <link rel="stylesheet" href="css/style_resources.css">
</head>
<body>
<h1>Articole și Tutoriale</h1>
<div class="content-section">
    <p>Această secțiune conține articole și tutoriale despre cele mai noi tehnologii și bune practici din industrie.</p>
    <div class="articles-container">
        <?php foreach ($articles as $article): ?>
            <!-- Iterează prin fiecare articol din lista $articles -->
            <div class="article-card">
                <strong><?php echo htmlspecialchars($article['title']); ?></strong>
                <p><?php echo htmlspecialchars($article['description']); ?></p>
                <a href="<?php echo htmlspecialchars($article['url']); ?>" target="_blank">Citește mai mult</a>
                <!-- Afișează titlul articolului, descrierea acestuia si un link catre el pe baza URL-ului din baza de date; htmlspecialchars() este utilizat pentru curatare-->
            </div>
        <?php endforeach; ?>
    </div>
</div>
<a href="resource_hub.php" class="btn-back">Înapoi la Resource Hub</a>

<?php $conn = null; ?>
<?php include 'includes/footer.php'; ?>
</body>
</html>
