<?php include_once "includes/header.php"; ?>
<?php
include 'config/database.php';

$database = new Database(); // creează o instanță a clasei Database pentru conectarea la baza de date
$conn = $database->getConnection(); // obține conexiunea activă la baza de date

if ($conn) { // verifică dacă conexiunea la baza de date a fost realizată
    $sql = "SELECT * FROM resources WHERE type = 'Video' ORDER BY date DESC";
    // interogare SQL pentru a selecta toate resursele de tip 'Video'
    // rezultatele sunt ordonate descrescător după dată (cele mai noi apar primele)

    $stmt = $conn->prepare($sql); // pregătește interogarea SQL
    $stmt->execute(); // execută interogarea SQL
    $videos = $stmt->fetchAll(PDO::FETCH_ASSOC); // preia toate rezultatele sub formă de array asociativ
} else {
    $videos = []; // inițializează lista videoclipurilor ca un array gol în cazul în care conexiunea eșuează
    echo "<p class='error'>Eroare: Nu s-a putut stabili conexiunea la baza de date.</p>";
    // afișează un mesaj de eroare dacă conexiunea la baza de date nu a fost realizată
}

?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Materiale Video</title>
    <link rel="stylesheet" href="css/style_resources.css">
</head>
<body>
<h1>Materiale Video</h1>
<div class="content-section">
    <p>Explorați materiale video informative care vă ajută să înțelegeți mai bine conceptele tehnologice.</p>
    <div class="videos-container">
        <?php foreach ($videos as $video): ?>
            <!-- Iterează prin fiecare video din lista $videos -->
            <div class="video-card">
                <img src="<?php echo htmlspecialchars($video['image_url']); ?>" alt="Imagine video" class="video-icon">
                <strong><?php echo htmlspecialchars($video['title']); ?></strong>
                <a href="<?php echo htmlspecialchars($video['url']); ?>" target="_blank">Vizualizează</a>
                <!-- Afișează imaginea videoului, titlul si linkul catre acesta; htmlspecialchars() este utilizat pentru curatare-->
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php $conn = null; ?>
<a href="resource_hub.php" class="btn-back">Înapoi la Resource Hub</a>

<?php include 'includes/footer.php'; ?>
</body>
</html>
