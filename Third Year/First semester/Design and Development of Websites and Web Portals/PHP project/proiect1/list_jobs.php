<?php
include_once 'config/database.php';
include_once "includes/header.php";

$database = new Database(); // creeaza o instanta a clasei Database pentru conectarea la baza de date
$conn = $database->getConnection(); // obtine conexiunea la baza de date

if ($conn) { // verifica daca conexiunea la baza de date a fost realizata cu succes
    // interogare SQL pentru a selecta toate inregistrarile din tabelul jobs
    $sql = "SELECT * FROM jobs";
    $stmt = $conn->prepare($sql); // pregateste interogarea SQL
    $stmt->execute(); // executa interogarea

    $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC); // preia toate rezultatele sub forma de array asociativ
} else {
    // afiseaza un mesaj de eroare daca conexiunea la baza de date nu a fost realizata
    echo "<p style='color: red;'>Eroare: Nu s-a putut stabili conexiunea la baza de date.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Listare Job-uri</title>
    <link rel="stylesheet" href="css/style_jobs.css">
</head>
<body>
<div class="containers">
    <h1>Listare Job-uri</h1>
    <?php if (!empty($jobs)): ?> <!-- verifica daca variabila $jobs contine joburi (lista nu este goala) -->
        <ul class="job-list">
            <?php foreach ($jobs as $job): ?><!-- parcurge fiecare job din lista $jobs folosind o bucla foreach -->
                <li>
                    <strong><?php echo htmlspecialchars($job['title']); ?></strong> <!-- afiseaza titlul jobului-->
                    <p><em>Companie:</em> <?php echo htmlspecialchars($job['company']); ?></p>
                    <p><?php echo htmlspecialchars($job['description']); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?> <!-- daca nu exista joburi in lista, afiseaza un mesaj corespunzator -->
        <p>Nu sunt joburi disponibile.</p>
    <?php endif; ?> <!-- mesaj pentru cazul in care lista $jobs este goala -->
    <a href="jobs_board.php" class="btn-back">Înapoi la Jobs Board</a>
</div>
<?php $conn = null; ?> <!-- sfarsitul blocului if-else care verifica existenta joburilor -->
</body>
</html>
<?php
include_once "includes/footer.php";
?>
