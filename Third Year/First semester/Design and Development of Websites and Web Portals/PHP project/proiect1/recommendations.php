<?php
include_once 'config/database.php';
include_once "includes/header.php";

$database = new Database(); // creează o instanță a clasei Database pentru conectarea la baza de date
$conn = $database->getConnection(); // obține conexiunea activă la baza de date

if ($conn) { // verifică dacă conexiunea la baza de date a fost realizată
    $sql = "SELECT jobs.title, jobs.company, jobs.description, COUNT(applications.id) AS num_applications 
            FROM jobs
            LEFT JOIN applications ON jobs.id = applications.job_id
            GROUP BY jobs.id, jobs.title, jobs.company, jobs.description
            ORDER BY num_applications DESC
            LIMIT 5";
    // interogare SQL care:
    // - selectează titlul, compania, descrierea joburilor și numărul de aplicații asociate fiecărui job
    // - face un LEFT JOIN între tabelul jobs și tabelul applications pentru a lega joburile de aplicații
    // - grupează rezultatele pe baza coloanelor jobs.id, jobs.title, jobs.company, jobs.description
    // - ordonează rezultatele descrescător după numărul de aplicații (num_applications)
    // - limitează rezultatele la primele 5 joburi

    $stmt = $conn->prepare($sql); // pregătește interogarea SQL
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
    <title>Recomandări Job-uri</title>
    <link rel="stylesheet" href="css/style_jobs.css">

</head>
<body>
<div class="containers">
    <h1>Recomandări Job-uri</h1>
    <?php if (!empty($jobs)): ?> <!-- Verifică dacă lista $jobs nu este goală; dacă sunt joburi disponibile, continuă cu afișarea acestora -->
        <ul>
            <?php foreach ($jobs as $job): ?> <!-- Iterează prin fiecare job din lista $jobs -->
                <li>
                    <strong><?php echo htmlspecialchars($job['title']); ?></strong> - <?php echo htmlspecialchars($job['company']); ?>
                    <p><?php echo htmlspecialchars($job['description']); ?></p>
                    <!--afsiseaza titlul jobului, numele companiei, descrierea jobului; htmlspecialchars() curăță datele-->
                    <p><em>Număr de aplicări:</em> <?php echo $job['num_applications']; ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Nu există recomandări disponibile momentan.</p>
    <?php endif; ?>
    <a href="jobs_board.php" class="btn-back">Înapoi la Jobs Board</a>

</div>
<?php $conn = null; ?>
</body>
</html>
<?php
include_once "includes/footer.php";
?>
