<?php
include 'includes/access_control.php';
check_access(['profesor']);

include 'config/Database.php';
$db = new Database();
$conn = $db->getConnection();

// Include localizarea
$lang = $_GET['lang'] ?? 'ro'; // Setăm limba implicită ca română
$messagesFile = "lang/$lang/messages.php";
if (!file_exists($messagesFile)) {
    $lang = 'ro'; // Dacă limba selectată nu există, revenim la română
    $messagesFile = "lang/$lang/messages.php";
}
$messages = include $messagesFile;

$error = '';
$success = '';
$angajat = null;

// Preluăm datele angajatului pentru editare
if (isset($_GET['id'])) {
    $query = "SELECT * FROM angajati WHERE cod = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
    $angajat = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Actualizăm datele angajatului
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cod = $_POST['cod'];
    $nume = htmlspecialchars($_POST['nume']);
    $prenume = htmlspecialchars($_POST['prenume']);
    $salariu = floatval($_POST['salariu']);
    $nr_telefon = htmlspecialchars($_POST['nr_telefon']);
    $experienta = intval($_POST['experienta']);
    $tip_agt = htmlspecialchars($_POST['tip_agt']);
    $detalii = htmlspecialchars($_POST['detalii']);

    try {
        $query = "UPDATE angajati 
                  SET nume = :nume, prenume = :prenume, salariu = :salariu, nr_telefon = :nr_telefon, 
                      experienta = :experienta, tip_agt = :tip_agt, 
                      instrument = IF(:tip_agt = 'M', :detalii, NULL),
                      echipament = IF(:tip_agt = 'S', :detalii, NULL),
                      materiale = IF(:tip_agt = 'D', :detalii, NULL)
                  WHERE cod = :cod";
        $stmt = $conn->prepare($query);
        $stmt->execute([
            ':nume' => $nume,
            ':prenume' => $prenume,
            ':salariu' => $salariu,
            ':nr_telefon' => $nr_telefon,
            ':experienta' => $experienta,
            ':tip_agt' => $tip_agt,
            ':detalii' => $detalii,
            ':cod' => $cod
        ]);
        $success = $messages['update_success'];
    } catch (PDOException $e) {
        $error = $messages['update_error'] . $e->getMessage();
    }
}
?>
<?php include 'includes/header.php'; ?>
<link rel="stylesheet" href="css/style.css">

<div class="container mt-5">
    <h2><?php echo $messages['edit_employee_title']; ?></h2>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>
    <?php if ($angajat): ?>
        <form method="POST">
            <input type="hidden" name="cod" value="<?= $angajat['cod'] ?>">
            <div class="mb-3">
                <label for="nume" class="form-label"><?php echo $messages['name_label']; ?></label>
                <input type="text" class="form-control" id="nume" name="nume" value="<?= $angajat['nume'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="prenume" class="form-label"><?php echo $messages['surname_label']; ?></label>
                <input type="text" class="form-control" id="prenume" name="prenume" value="<?= $angajat['prenume'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="salariu" class="form-label"><?php echo $messages['salary_label']; ?></label>
                <input type="number" class="form-control" id="salariu" name="salariu" value="<?= $angajat['salariu'] ?>" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="nr_telefon" class="form-label"><?php echo $messages['phone_label']; ?></label>
                <input type="text" class="form-control" id="nr_telefon" name="nr_telefon" value="<?= $angajat['nr_telefon'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="experienta" class="form-label"><?php echo $messages['experience_label']; ?></label>
                <input type="number" class="form-control" id="experienta" name="experienta" value="<?= $angajat['experienta'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="tip_agt" class="form-label"><?php echo $messages['employee_type_label']; ?></label>
                <select class="form-control" id="tip_agt" name="tip_agt" required>
                    <option value="M" <?= $angajat['tip_agt'] === 'M' ? 'selected' : '' ?>><?php echo $messages['music_option']; ?></option>
                    <option value="S" <?= $angajat['tip_agt'] === 'S' ? 'selected' : '' ?>><?php echo $messages['sports_option']; ?></option>
                    <option value="D" <?= $angajat['tip_agt'] === 'D' ? 'selected' : '' ?>><?php echo $messages['drawing_option']; ?></option>
                </select>
            </div>
            <div class="mb-3">
                <label for="detalii" class="form-label"><?php echo $messages['details_label']; ?></label>
                <input type="text" class="form-control" id="detalii" name="detalii"
                       value="<?= htmlspecialchars($angajat['instrument'] ?: $angajat['echipament'] ?: $angajat['materiale']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary"><?php echo $messages['update_button']; ?></button>
            <a href="angajati.php?lang=<?php echo $lang; ?>" class="btn btn-secondary"><?php echo $messages['back_button']; ?></a>
        </form>
    <?php else: ?>
        <div class="alert alert-danger"><?php echo $messages['not_found_error']; ?></div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
