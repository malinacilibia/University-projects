<?php
include '../includes/header.php';

// Include localizarea
$lang = $_GET['lang'] ?? 'ro';
$messages = include "../lang/$lang/messages.php";

// Include fișierul de configurare pentru baza de date
include '../config/Database.php';

// Cream o instanță a clasei Database
$db = new Database();
$conn = $db->getConnection();

// Definim interogarea pentru activități
$query = "SELECT * FROM activitati";
$stmt = $conn->prepare($query);
$stmt->execute();
$activitati = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <h2><?= $messages['activities_list_title']; ?></h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th><?= $messages['table_code']; ?></th>
            <th><?= $messages['table_name']; ?></th>
            <th><?= $messages['table_difficulty']; ?></th>
            <th><?= $messages['table_duration']; ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($activitati as $activitate): ?>
            <tr>
                <td><?= htmlspecialchars($activitate['cod']); ?></td>
                <td><?= htmlspecialchars($activitate['nume']); ?></td>
                <td><?= htmlspecialchars($activitate['nivel_dificultate']); ?></td>
                <td><?= htmlspecialchars($activitate['durata']); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
