<?php
include 'config/database.php';
include 'includes/header.php';

?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profiles</title>
    <link rel="stylesheet" href="css/style_statistici.css">
</head>
<body>
<?php
$database = new Database(); // creeaza o instanta a clasei database
$conn = $database->getConnection(); // obtine conexiunea la baza de date

try {
    $query = "SELECT name, role, profile_details FROM users"; // interogare sql pentru a prelua utilizatorii si detaliile lor
    $stmt = $conn->prepare($query); // pregateste interogarea
    $stmt->execute(); // executa interogarea

    echo "<h2 class='section-title'>Detalii despre utilizatori</h2>"; // afiseaza titlul sectiunii
    echo "<div class='user-details-container'>"; // container pentru toate cardurile utilizatorilor

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // parcurge rezultatele interogarii
        $name = htmlspecialchars($row['name']); // curata numele utilizatorului
        $role = htmlspecialchars($row['role']); // curata rolul utilizatorului
        $profile_details = json_decode($row['profile_details'], true); // decodeaza detaliile profilului din json

        echo "<div class='user-card'>"; // incepe cardul unui utilizator
        echo "<h3 class='user-name'>Nume: $name</h3>"; // afiseaza numele utilizatorului
        echo "<p class='user-role'>Rol: $role</p>"; // afiseaza rolul utilizatorului

        if ($profile_details) { // verifica daca utilizatorul are detalii de profil
            echo "<h4 class='details-header'>Detalii:</h4>"; // afiseaza subtitlul pentru detalii
            echo "<ul class='details-list'>"; // incepe o lista de detalii
            foreach ($profile_details as $key => $value) { // parcurge fiecare detaliu din profil
                $key_formatted = ucfirst(str_replace('_', ' ', $key)); // formateaza cheia pentru a fi lizibila
                echo "<li class='details-item'><strong>$key_formatted:</strong> " . htmlspecialchars($value) . "</li>"; // afiseaza fiecare detaliu
            }
            echo "</ul>"; // inchide lista
        } else {
            echo "<p class='no-details'><em>nu sunt detalii disponibile.</em></p>"; // mesaj pentru lipsa detaliilor
        }

        echo "</div>"; // inchide cardul utilizatorului
    }
    echo "</div>"; // inchide containerul pentru detaliile utilizatorilor
} catch (PDOException $e) { // gestioneaza erorile sql
    echo "<p class='error-message'>eroare la obtinerea detaliilor: " . $e->getMessage() . "</p>"; // afiseaza mesajul de eroare
}
?>

</body>
</html>

<?php
include 'includes/footer.php';
?>
