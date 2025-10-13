<?php include_once "includes/header.php"; ?>
<?php
include 'config/database.php';

$database = new Database(); // creează o instanță a clasei Database pentru conectarea la baza de date
$conn = $database->getConnection(); // obține conexiunea activă la baza de date

if ($conn) { // verifică dacă conexiunea la baza de date a fost realizată
    $sql = "SELECT * FROM resources WHERE type = 'Downloadable' ORDER BY date DESC";
    // interogare SQL pentru a selecta toate resursele de tip 'Downloadable'
    // rezultatele sunt ordonate descrescător după dată (cele mai recente apar primele)

    $stmt = $conn->prepare($sql); // pregătește interogarea SQL pentru a evita atacurile SQL injection
    $stmt->execute(); // execută interogarea SQL
    $downloads = $stmt->fetchAll(PDO::FETCH_ASSOC); // preia toate rezultatele sub formă de array asociativ
} else {
    $downloads = []; // inițializează lista resurselor ca un array gol în cazul în care conexiunea eșuează
    echo "<p class='error'>Eroare: Nu s-a putut stabili conexiunea la baza de date.</p>";
    // afișează un mesaj de eroare dacă conexiunea la baza de date nu a fost realizată
}

?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Resurse Downloadabile</title>
    <link rel="stylesheet" href="css/style_resources.css">
</head>
<body>
<h1>Resurse Downloadabile</h1>
<div class="content-section">
    <p>Descoperiți resurse valoroase pe care le puteți descărca, precum cărți electronice, prezentări și alte materiale utile.</p>
    <div class="downloads-container">
        <?php foreach ($downloads as $download): ?>
            <!-- Iterează prin fiecare resursa downloadabila din lista &downloads -->
            <div class="download-card">
                <strong><?php echo htmlspecialchars($download['title']); ?></strong>
                <p><?php echo htmlspecialchars($download['description']); ?></p>
                <a href="<?php echo htmlspecialchars($download['url']); ?>" target="_blank">Descarcă</a>
                <!-- Afișează titlul resursei downloadabila, descrierea si linkul catre acesta; htmlspecialchars() este utilizat pentru curatare-->
            </div>
        <?php endforeach; ?>
    </div>
</div>
<a href="resource_hub.php" class="btn-back">Înapoi la Resource Hub</a>

<?php $conn = null; ?>
<?php include 'includes/footer.php'; ?>
</body>
</html>
