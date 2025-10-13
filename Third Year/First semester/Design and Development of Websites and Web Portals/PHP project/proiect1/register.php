<?php
include_once "includes/header.php";
include 'config/database.php';

$database = new Database(); // creeaza o instanta a clasei database pentru conectarea la baza de date
$conn = $database->getConnection(); // obtine conexiunea la baza de date

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // verifica daca formularul a fost trimis folosind metoda POST
    $name = htmlspecialchars($_POST['name']); // preia numele utilizatorului si curata datele pentru a preveni atacurile xss
    $email = htmlspecialchars($_POST['email']); // preia adresa de email si o curata pentru a preveni atacurile xss
    $event_id = (int)$_POST['event_id']; // preia id-ul evenimentului si il converteste intr-un numar intreg

    // interogare sql pentru a insera o inregistrare in tabelul registrations
    $sql = "INSERT INTO registrations (name, email, event_id) VALUES (:name, :email, :event_id)";
    $stmt = $conn->prepare($sql); // pregateste interogarea sql
    $stmt->bindParam(':name', $name); // leaga parametrul :name de variabila $name
    $stmt->bindParam(':email', $email); // leaga parametrul :email de variabila $email
    $stmt->bindParam(':event_id', $event_id); // leaga parametrul :event_id de variabila $event_id
    $stmt->execute(); // executa interogarea sql pentru a adauga inregistrarea

    // afiseaza un mesaj de confirmare utilizatorului
    echo "<h3 class='text-center'>Mulțumim, $name!</h3>";
    echo "<p class='text-center'>Te-ai înregistrat cu succes pentru evenimentul $event_id!</p>";
    echo "<a href='events.php' class='btn btn-secondary mt-3'>Înapoi la pagina Events</a>";
    exit(); // opreste executia scriptului dupa ce inregistrarea a fost adaugata
}

// interogare sql pentru a prelua toate evenimentele din tabelul events
$sql = "SELECT * FROM events";
$stmt = $conn->prepare($sql); // pregateste interogarea sql
$stmt->execute(); // executa interogarea
$events = $stmt->fetchAll(PDO::FETCH_ASSOC); // preia toate evenimentele sub forma de array asociativ

?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Înregistrare Eveniment</title>
    <link rel="stylesheet" href="css/style_events.css">
</head>
<body>
<div class="container">
    <h3 class="text-center">Înregistrează-te pentru un eveniment</h3>
    <form method="POST" action="register.php" class="registration-form">
        <label for="name">Numele tău:</label>
        <input type="text" id="name" name="name" placeholder="Introdu numele tău" required><br><br>

        <label for="email">Emailul tău:</label>
        <input type="email" id="email" name="email" placeholder="Introdu emailul tău" required><br><br>

        <label for="event">Alege un eveniment:</label>
        <select id="event" name="event_id" required>
            <?php foreach ($events as $event): ?> <!-- parcurgem toate elementele din arrayul $events, $event reprezinta un rand -->
                <option value="<?php echo $event['id']; ?>"><?php echo htmlspecialchars($event['name']);// afiseaza numele evenimentului curatand eventualele caractere speciale ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit" class="btn btn-success">Înregistrează-te</button>
    </form>
    <a href="events.php" class="btn btn-secondary mt-3">Înapoi la pagina Events</a>
</div>
<?php include_once "includes/footer.php"; ?>
</body>
</html>
