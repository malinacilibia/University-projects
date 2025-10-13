<?php include_once "includes/header.php"; ?>
<?php
include 'config/database.php';
$database = new Database(); // creează o instanță a clasei Database pentru conectarea la baza de date
$conn = $database->getConnection(); // obține conexiunea activă la baza de date

$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
// verifică dacă există un parametru 'filter' în URL; dacă există, îl preia, altfel inițializează cu un șir gol

if ($conn) { // verifică dacă conexiunea la baza de date este activă
    $sql = "SELECT * FROM resources WHERE title LIKE :filter OR description LIKE :filter OR type LIKE :filter";
    // interogare SQL pentru a selecta resursele care au titlul, descrierea sau tipul ce conțin textul filtrat

    $stmt = $conn->prepare($sql); // pregătește interogarea SQL
    $searchTerm = '%' . $filter . '%'; // adaugă wildcard-urile pentru căutarea parțială
    $stmt->bindParam(':filter', $searchTerm, PDO::PARAM_STR); // leagă parametrul :filter la valoarea $searchTerm
    $stmt->execute(); // execută interogarea SQL
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC); // preia toate rezultatele sub formă de array asociativ
} else {
    $results = []; // inițializează lista rezultatelor ca un array gol dacă conexiunea eșuează
    echo "<p class='error'>Eroare: Nu s-a putut stabili conexiunea la baza de date.</p>";
    // afișează un mesaj de eroare dacă conexiunea la baza de date nu a fost realizată
}

?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style_resources.css">
    <title>Sistem de Căutare și Filtrare</title>
</head>
<body>
<h1>Sistem de Căutare și Filtrare</h1>
<div class="content-section">
    <p>Folosiți acest sistem pentru a căuta și filtra resursele de care aveți nevoie.</p>
    <form method="GET" action="search.php">
        <label for="filter">Căutare:</label>
        <input type="text" name="filter" id="filter" value="<?php echo htmlspecialchars($filter); ?>">
        <button type="submit">Caută</button>
    </form>
    <div class="results-container">
        <?php if (!empty($results)): ?>
            <!-- Verifică dacă lista $results conține resurse (nu este goală) -->
            <?php foreach ($results as $resource): ?>
                <!-- Iterează prin fiecare resursă din lista $results -->
                <div class="result-card">
                    <strong><?php echo htmlspecialchars($resource['title']); ?></strong>
                    <p><?php echo htmlspecialchars($resource['description']); ?></p>
                    <p><small>Tip: <?php echo htmlspecialchars($resource['type']); ?></small></p>
                    <a href="<?php echo htmlspecialchars($resource['url']); ?>" target="_blank">Detalii</a>
                    <!-- Afisam titlul, descrierea si tipul resursei (articol,video sau podcast)
                    Apoi creeam un link către resursă folosind URL-ul din baza de date; target="_blank" deschide link-ul într-un tab nou -->
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nicio resursă găsită.</p>
        <?php endif; ?>
    </div>
</div>
<?php $conn = null; ?>
<a href="resource_hub.php" class="btn-back">Înapoi la Resource Hub</a>

<?php include 'includes/footer.php'; ?>
</body>
</html>
