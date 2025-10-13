<?php
// includem fișierul pentru controlul accesului
include 'includes/access_control.php';
// verificăm accesul utilizatorului pentru rolul 'profesor'
check_access(['profesor']);

// Include localizarea
$lang = $_GET['lang'] ?? 'ro'; // Setăm limba implicită ca română
$messagesFile = "lang/$lang/messages.php";
if (!file_exists($messagesFile)) {
    $lang = 'ro'; // Dacă limba selectată nu există, revenim la română
    $messagesFile = "lang/$lang/messages.php";
}
$messages = include $messagesFile;

include 'includes/header.php'; ?>
<?php

// includem fișierul de configurare pentru baza de date
include 'config/Database.php';

// Cream o instanță a clasei Database
$db = new Database();
$conn = $db->getConnection();

// Query pentru toate programările
$query = "SELECT p.data_programare, p.ora_start, p.ora_final, a.nume AS activitate, u.username AS utilizator 
          FROM programari p 
          JOIN activitati a ON p.cod_ate = a.cod 
          JOIN users u ON p.user_id = u.id";
$stmt = $conn->prepare($query);
$stmt->execute();
$programari = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" href="css/style.css">

<div class="container mt-5">
    <h2><?php echo $messages['appointments_title']; ?></h2>

    <table class="table table-striped">
        <thead>
        <tr>
            <th><?php echo $messages['table_user']; ?></th>
            <th><?php echo $messages['table_date']; ?></th>
            <th><?php echo $messages['table_start_time']; ?></th>
            <th><?php echo $messages['table_end_time']; ?></th>
            <th><?php echo $messages['table_activity']; ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($programari as $programare): ?>
            <tr>
                <td><?= htmlspecialchars($programare['utilizator']) ?></td>
                <td><?= htmlspecialchars($programare['data_programare']) ?></td>
                <td><?= htmlspecialchars($programare['ora_start']) ?></td>
                <td><?= htmlspecialchars($programare['ora_final']) ?></td>
                <td><?= htmlspecialchars($programare['activitate']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
