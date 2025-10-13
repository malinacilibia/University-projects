<?php
// Include fișierul de configurare pentru baza de date
require 'config/Database.php';

// Include localizarea
$lang = $_GET['lang'] ?? 'ro'; // Setăm limba implicită ca română
$messagesFile = "lang/$lang/messages.php";
if (!file_exists($messagesFile)) {
    $lang = 'ro'; // Dacă limba selectată nu există, revenim la română
    $messagesFile = "lang/$lang/messages.php";
}
$messages = include $messagesFile;

// Cream o instanță a clasei Database
$db = new Database();
$conn = $db->getConnection();

// Verificăm dacă avem un ID pentru participantul de editat
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $cod = $_GET['id'];
    $query = "SELECT * FROM participanti WHERE cod = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$cod]);
    $participant = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$participant) {
        echo "<div class='alert alert-danger'>Participant not found.</div>";
        exit;
    }
}

$participant = $participant ?? [
    'cod' => '',
    'nume' => '',
    'prenume' => '',
    'nr_tel' => '',
    'strada' => '',
    'data_nast' => '',
    'grupa_gvd' => '',
];

// Verificăm dacă formularul a fost trimis pentru actualizare
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cod = $_POST['cod'];
    $nume = $_POST['nume'];
    $prenume = $_POST['prenume'];
    $nr_tel = $_POST['nr_tel'];
    $strada = $_POST['strada'];
    $data_nast = $_POST['data_nast'];
    $grupa_gvd = $_POST['grupa_gvd'];

    $query = "UPDATE participanti 
              SET nume = ?, prenume = ?, nr_tel = ?, strada = ?, data_nast = ?, grupa_gvd = ? 
              WHERE cod = ?";
    $stmt = $conn->prepare($query);
    if ($stmt->execute([$nume, $prenume, $nr_tel, $strada, $data_nast, $grupa_gvd, $cod])) {
        header("Location: participanti.php?lang=$lang");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error updating participant.</div>";
    }
}
?>

<?php include 'includes/header.php'; ?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $messages['edit_participant_title']; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container mt-5">
    <h1><?php echo $messages['edit_participant_title']; ?></h1>
    <form action="edit_participant.php?lang=<?php echo $lang; ?>" method="POST">
        <input type="hidden" name="cod" value="<?= htmlspecialchars($participant['cod']) ?>">

        <div class="mb-3">
            <label for="nume" class="form-label"><?php echo $messages['name_label']; ?></label>
            <input type="text" name="nume" class="form-control" value="<?= htmlspecialchars($participant['nume']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="prenume" class="form-label"><?php echo $messages['surname_label']; ?></label>
            <input type="text" name="prenume" class="form-control" value="<?= htmlspecialchars($participant['prenume']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="nr_tel" class="form-label"><?php echo $messages['phone_label']; ?></label>
            <input type="text" name="nr_tel" class="form-control" value="<?= htmlspecialchars($participant['nr_tel']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="strada" class="form-label"><?php echo $messages['street_label']; ?></label>
            <input type="text" name="strada" class="form-control" value="<?= htmlspecialchars($participant['strada']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="data_nast" class="form-label"><?php echo $messages['birthdate_label']; ?></label>
            <input type="date" name="data_nast" class="form-control" value="<?= htmlspecialchars($participant['data_nast']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="grupa_gvd" class="form-label"><?php echo $messages['group_label']; ?></label>
            <select name="grupa_gvd" class="form-control" required>
                <option value="1" <?= $participant['grupa_gvd'] == '1' ? 'selected' : '' ?>><?php echo $messages['group_1']; ?></option>
                <option value="2" <?= $participant['grupa_gvd'] == '2' ? 'selected' : '' ?>><?php echo $messages['group_2']; ?></option>
                <option value="3" <?= $participant['grupa_gvd'] == '3' ? 'selected' : '' ?>><?php echo $messages['group_3']; ?></option>
                <option value="4" <?= $participant['grupa_gvd'] == '4' ? 'selected' : '' ?>><?php echo $messages['group_4']; ?></option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary"><?php echo $messages['save_button']; ?></button>
        <a href="participanti.php?lang=<?php echo $lang; ?>" class="btn btn-secondary"><?php echo $messages['back_button']; ?></a>
    </form>
</div>
</body>
</html>

<?php include 'includes/footer.php'; ?>
