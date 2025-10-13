<?php
include 'includes/access_control.php';
check_access(['profesor']); // Doar profesorii pot adăuga angajați

// Include localizarea
$lang = $_GET['lang'] ?? 'ro'; // Setăm limba implicită ca română
$messagesFile = "lang/$lang/messages.php";
if (!file_exists($messagesFile)) {
    $lang = 'ro'; // Dacă limba selectată nu există, revenim la română
    $messagesFile = "lang/$lang/messages.php";
}
$messages = include $messagesFile;

include 'includes/header.php';

include 'config/Database.php';
$db = new Database();
$conn = $db->getConnection();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nume = htmlspecialchars($_POST['nume']);
    $prenume = htmlspecialchars($_POST['prenume']);
    $salariu = floatval($_POST['salariu']);
    $nr_telefon = htmlspecialchars($_POST['nr_telefon']);
    $experienta = intval($_POST['experienta']);
    $tip_agt = htmlspecialchars($_POST['tip_agt']);
    $detalii = htmlspecialchars($_POST['detalii']);

    try {
        $query = "INSERT INTO angajati (nume, prenume, salariu, nr_telefon, experienta, tip_agt, instrument, echipament, materiale)
                  VALUES (:nume, :prenume, :salariu, :nr_telefon, :experienta, :tip_agt, 
                          IF(:tip_agt = 'M', :detalii, NULL), 
                          IF(:tip_agt = 'S', :detalii, NULL), 
                          IF(:tip_agt = 'D', :detalii, NULL))";
        $stmt = $conn->prepare($query);
        $stmt->execute([
            ':nume' => $nume,
            ':prenume' => $prenume,
            ':salariu' => $salariu,
            ':nr_telefon' => $nr_telefon,
            ':experienta' => $experienta,
            ':tip_agt' => $tip_agt,
            ':detalii' => $detalii
        ]);
        $success = $messages['employee_add_success'];
    } catch (PDOException $e) {
        $error = $messages['employee_add_error'] . $e->getMessage();
    }
}
?>
<link rel="stylesheet" href="css/style.css">

<div class="container mt-5">
    <h2><?= $messages['add_employee_title']; ?></h2>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label for="nume" class="form-label"><?= $messages['name_label']; ?></label>
            <input type="text" class="form-control" id="nume" name="nume" required>
        </div>
        <div class="mb-3">
            <label for="prenume" class="form-label"><?= $messages['surname_label']; ?></label>
            <input type="text" class="form-control" id="prenume" name="prenume" required>
        </div>
        <div class="mb-3">
            <label for="salariu" class="form-label"><?= $messages['salary_label']; ?></label>
            <input type="number" class="form-control" id="salariu" name="salariu" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="nr_telefon" class="form-label"><?= $messages['phone_label']; ?></label>
            <input type="text" class="form-control" id="nr_telefon" name="nr_telefon" required>
        </div>
        <div class="mb-3">
            <label for="experienta" class="form-label"><?= $messages['experience_label']; ?></label>
            <input type="number" class="form-control" id="experienta" name="experienta" required>
        </div>
        <div class="mb-3">
            <label for="tip_agt" class="form-label"><?= $messages['employee_type_label']; ?></label>
            <select class="form-control" id="tip_agt" name="tip_agt" required>
                <option value="M"><?= $messages['type_music']; ?></option>
                <option value="S"><?= $messages['type_sport']; ?></option>
                <option value="D"><?= $messages['type_art']; ?></option>
            </select>
        </div>
        <div class="mb-3">
            <label for="detalii" class="form-label"><?= $messages['details_label']; ?></label>
            <input type="text" class="form-control" id="detalii" name="detalii" required>
        </div>
        <button type="submit" class="btn btn-primary"><?= $messages['add_button']; ?></button>
        <a href="angajati.php" class="btn btn-secondary"><?= $messages['back_button']; ?></a>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
