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

// Cream o instanță a clasei Database
$db = new Database();
$conn = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nume = $_POST['nume'];
    $prenume = $_POST['prenume'];
    $nr_tel = $_POST['nr_tel'];
    $strada = $_POST['strada'];
    $data_nast = $_POST['data_nast'];
    $grupa_gvd = $_POST['grupa_gvd'];

    $query = "INSERT INTO participanti (nume, prenume, nr_tel, strada, data_nast, grupa_gvd) 
              VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->execute([$nume, $prenume, $nr_tel, $strada, $data_nast, $grupa_gvd]);

    header("Location: participanti.php");
    exit;
}
?>
<?php include 'includes/header.php'; ?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $messages['add_participant_title']; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container mt-5">
    <h1><?= $messages['add_participant_header']; ?></h1>
    <form action="add_participant.php" method="POST" class="form-container">
        <div class="mb-3">
            <label for="nume" class="form-label"><?= $messages['name_label']; ?></label>
            <input type="text" name="nume" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="prenume" class="form-label"><?= $messages['surname_label']; ?></label>
            <input type="text" name="prenume" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="nr_tel" class="form-label"><?= $messages['phone_label']; ?></label>
            <input type="text" name="nr_tel" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="strada" class="form-label"><?= $messages['address_label']; ?></label>
            <input type="text" name="strada" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="data_nast" class="form-label"><?= $messages['birth_date_label']; ?></label>
            <input type="date" name="data_nast" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="grupa_gvd" class="form-label"><?= $messages['group_label']; ?></label>
            <select name="grupa_gvd" class="form-control" required>
                <option value="1"><?= $messages['group_1']; ?></option>
                <option value="2"><?= $messages['group_2']; ?></option>
                <option value="3"><?= $messages['group_3']; ?></option>
                <option value="4"><?= $messages['group_4']; ?></option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary"><?= $messages['add_button']; ?></button>
        <a href="participanti.php" class="btn btn-secondary"><?= $messages['back_button']; ?></a>
    </form>
</div>
</body>
</html>
<?php include 'includes/footer.php'; ?>
