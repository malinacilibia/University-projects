<?php
session_start();
include 'config/Database.php';

// Include localizarea
$lang = $_GET['lang'] ?? 'ro'; // Setăm limba implicită ca română
$messagesFile = "lang/$lang/messages.php";
if (!file_exists($messagesFile)) {
    $lang = 'ro'; // Dacă limba selectată nu există, revenim la română
    $messagesFile = "lang/$lang/messages.php";
}
$messages = include $messagesFile;

// Verificare rol utilizator
if ($_SESSION['role'] !== 'elev' && $_SESSION['role'] !== 'profesor') {
    header("Location: acces_denied.php?lang=$lang");
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    $conn = $db->getConnection();

    $data_programare = htmlspecialchars($_POST['data_programare']);
    $ora_start = htmlspecialchars($_POST['ora_start']);
    $ora_final = htmlspecialchars($_POST['ora_final']);
    $cod_ate = htmlspecialchars($_POST['cod_ate']);
    $user_id = $_SESSION['user_id'];

    if (!empty($data_programare) && !empty($ora_start) && !empty($ora_final) && !empty($cod_ate)) {
        $query = "INSERT INTO programari (data_programare, ora_start, ora_final, cod_ate, user_id) 
                  VALUES (:data_programare, :ora_start, :ora_final, :cod_ate, :user_id)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':data_programare', $data_programare);
        $stmt->bindParam(':ora_start', $ora_start);
        $stmt->bindParam(':ora_final', $ora_final);
        $stmt->bindParam(':cod_ate', $cod_ate);
        $stmt->bindParam(':user_id', $user_id);

        if ($stmt->execute()) {
            $success = $messages['success_insert'];
        } else {
            $error = $messages['error_insert_failed'];
        }
    } else {
        $error = $messages['error_empty_fields'];
    }
}

// Obține activitățile disponibile
$db = new Database();
$conn = $db->getConnection();
$query_activitati = "SELECT cod, nume FROM activitati";
$stmt_activitati = $conn->prepare($query_activitati);
$stmt_activitati->execute();
$activitati = $stmt_activitati->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include 'includes/header.php'; ?>

<!DOCTYPE html>
<html lang="<?= $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $messages['add_appointment_title']; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container mt-5">
    <h2><?= $messages['add_appointment_title']; ?></h2>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <form method="POST" action="add_programare.php?lang=<?= $lang; ?>">
        <div class="mb-3">
            <label for="data_programare" class="form-label"><?= $messages['date_label']; ?></label>
            <input type="date" class="form-control" id="data_programare" name="data_programare" required>
        </div>
        <div class="mb-3">
            <label for="ora_start" class="form-label"><?= $messages['start_time_label']; ?></label>
            <input type="time" class="form-control" id="ora_start" name="ora_start" required>
        </div>
        <div class="mb-3">
            <label for="ora_final" class="form-label"><?= $messages['end_time_label']; ?></label>
            <input type="time" class="form-control" id="ora_final" name="ora_final" required>
        </div>
        <div class="mb-3">
            <label for="cod_ate" class="form-label"><?= $messages['activity_label']; ?></label>
            <select class="form-control" id="cod_ate" name="cod_ate" required>
                <?php foreach ($activitati as $activitate): ?>
                    <option value="<?= htmlspecialchars($activitate['cod']) ?>">
                        <?= htmlspecialchars($activitate['nume']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary"><?= $messages['submit_button']; ?></button>
        <a href="programari_elevi.php?lang=<?= $lang; ?>" class="btn btn-primary"><?= $messages['back_button']; ?></a>
    </form>
</div>
</body>
</html>
<?php include 'includes/footer.php'; ?>
