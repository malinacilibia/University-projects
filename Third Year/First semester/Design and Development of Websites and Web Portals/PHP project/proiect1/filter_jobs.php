<?php
include_once 'config/database.php';
include_once "includes/header.php";

$database = new Database(); // creează o instanță a clasei Database pentru conectarea la baza de date
$conn = $database->getConnection(); // obține conexiunea activă la baza de date

$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
// verifică dacă există un parametru 'filter' în URL și îl preia, altfel inițializează cu un șir gol

if ($conn) { // verifică dacă conexiunea la baza de date este activă
    // interogare SQL pentru a selecta joburi care conțin textul filtrat în titlu sau companie
    $sql = "SELECT * FROM jobs WHERE title LIKE :filter OR company LIKE :filter";
    $stmt = $conn->prepare($sql); // pregătește interogarea SQL
    $filter_param = "%$filter%"; // adaugă caractere wildcard pentru căutarea parțială
    $stmt->bindParam(':filter', $filter_param, PDO::PARAM_STR); // leagă parametrul :filter de valoarea $filter_param
    $stmt->execute(); // execută interogarea SQL

    $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC); // preia toate rezultatele sub formă de array asociativ
} else {
    // afișează un mesaj de eroare dacă conexiunea la baza de date nu a fost realizată
    echo "<p style='color: red;'>Eroare: Nu s-a putut stabili conexiunea la baza de date.</p>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Filtrare Job-uri</title>
    <link rel="stylesheet" href="css/style_jobs.css">
</head>
<body>
<div class="containers">
    <h1>Filtrare Job-uri</h1>
    <form method="GET" action="filter_jobs.php">
        <label for="filter">Caută job:</label>
        <input type="text" name="filter" id="filter" value="<?php echo htmlspecialchars($filter); ?>">
        <button type="submit">Caută</button>
    </form>
    <ul class="job-list">
        <?php if (!empty($jobs)): ?> <!-- Verifică dacă lista $jobs nu este goală; dacă sunt joburi disponibile, continuă cu afișarea acestora -->
            <?php foreach ($jobs as $job): ?> <!-- Iterează prin fiecare job din lista $jobs -->
                <li>
                    <strong><?php echo htmlspecialchars($job['title']); ?></strong> - <?php echo htmlspecialchars($job['company']); ?>
                    <p><?php echo htmlspecialchars($job['description']); ?></p>
                    <!--afsiseaza titlul jobului, numele companiei, descrierea jobului; htmlspecialchars() curăță datele-->
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Niciun job găsit.</li>
        <?php endif; ?>
    </ul>
    <a href="jobs_board.php" class="btn-back">Înapoi la Jobs Board</a>
</div>
<?php $conn = null; ?>
</body>
</html>
<?php
include_once "includes/footer.php";
?>
