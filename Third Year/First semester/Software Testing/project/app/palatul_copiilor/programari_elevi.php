<?php
// includem fișierul pentru controlul accesului
include 'includes/access_control.php';
// verificăm accesul utilizatorului pentru rolul 'elev'
check_access(['elev']);

// Include localizarea
$lang = $_GET['lang'] ?? 'ro'; // Setăm limba implicită ca română
$messagesFile = "lang/$lang/messages.php";
if (!file_exists($messagesFile)) {
    $lang = 'ro';
    $messagesFile = "lang/$lang/messages.php";
}
$messages = include $messagesFile; // Asigurăm că includerea fișierului este atribuită variabilei $messages


include 'includes/header.php'; ?>
<?php
// includem fișierul de configurare pentru baza de date
include 'config/Database.php';

// Cream o instanță a clasei Database
$db = new Database();
$conn = $db->getConnection();

$user_id = $_SESSION['user_id'];

// Query pentru programările elevului conectat
$query = "SELECT p.data_programare, p.ora_start, p.ora_final, a.nume AS activitate 
          FROM programari p 
          JOIN activitati a ON p.cod_ate = a.cod 
          WHERE p.user_id = :user_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$programari = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" href="css/style.css">

<div class="container mt-5">
    <h2><?= $messages['appointments_title'] ?></h2>

    <table class="table table-striped">
        <thead>
        <tr>
            <th><?php echo $messages['table_date']; ?></th>
            <th><?php echo $messages['table_start_time']; ?></th>
            <th><?php echo $messages['table_end_time']; ?></th>
            <th><?php echo $messages['table_activity']; ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($programari as $programare): ?>
            <tr>
                <td><?= htmlspecialchars($programare['data_programare']) ?></td>
                <td><?= htmlspecialchars($programare['ora_start']) ?></td>
                <td><?= htmlspecialchars($programare['ora_final']) ?></td>
                <td><?= htmlspecialchars($programare['activitate']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Buton pentru redirecționare la adăugare programare -->
    <div class="mt-3">
        <a href="add_programare.php?lang=<?php echo $lang; ?>" class="btn btn-primary"><?php echo $messages['add_appointment_button']; ?></a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
