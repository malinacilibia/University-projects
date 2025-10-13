<?php
include_once "includes/header.php";
include 'config/database.php';

$database = new Database(); // creeaza o instanta a clasei database pentru conectarea la baza de date
$conn = $database->getConnection(); // obtine conexiunea la baza de date

$sql = "SELECT * FROM events WHERE MONTH(date) = 12 AND YEAR(date) = 2024 ORDER BY date ASC";
// interogare sql care selecteaza toate evenimentele din luna decembrie 2024 din tabelul events, ordonate crescator dupa data
$stmt = $conn->prepare($sql); // pregateste interogarea pentru executie
$stmt->execute(); // executa interogarea pregatita
$events = $stmt->fetchAll(PDO::FETCH_ASSOC); // preia toate rezultatele sub forma de array asociativ

?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Calendar - Decembrie 2024</title>
    <link rel="stylesheet" href="css/style_events.css">
</head>
<body>
<div class="container">
    <h3 class='text-center'>Calendar - Decembrie 2024</h3>
    <div class="table-box">
        <table class='table table-calendar'>
            <thead>
            <tr>
                <th>Ziua</th>
                <th>Eveniment</th>
                <th>Tip</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($events as $event): ?>  <!-- parcurgem toate elementele din arrayul $events, $event reprezinta un rand -->
                <tr>
                    <td><?php echo date('d', strtotime($event['date'])); ?></td>
                    <!-- afiseaza doar ziua (format 'd') din data evenimentului folosind functia date() dupa convertirea datei in format timestamp cu strtotime()-->

                    <td><?php echo htmlspecialchars($event['name']); ?></td>
                    <!--afiseaza numele evenimentului si curata datele  folosind htmlspecialchars()-->

                    <td><?php echo htmlspecialchars($event['type']); ?></td>
                   <!--afiseaza tipul evenimentului (de exemplu, workshop, conferinta) si aplicam htmlspecialchars() pentru siguranta -->
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <a href="events.php" class="btn btn-secondary mt-3">Înapoi la pagina Events</a>
</div>
<?php include_once "includes/footer.php"; ?>
</body>
</html>
