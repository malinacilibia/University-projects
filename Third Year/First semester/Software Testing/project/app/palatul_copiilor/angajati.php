<?php
// Includem fișierul pentru controlul accesului
include 'includes/access_control.php';

// Verificăm dacă utilizatorul are acces ca profesor
check_access(['profesor']);

// Include localizarea
$lang = $_GET['lang'] ?? 'ro'; // Setăm limba implicită ca română
$messagesFile = "lang/$lang/messages.php";
if (!file_exists($messagesFile)) {
    $lang = 'ro'; // Dacă limba selectată nu există, revenim la română
    $messagesFile = "lang/$lang/messages.php";
}
$messages = include $messagesFile;

include 'config/Database.php';

// Cream o instanță a clasei Database
$db = new Database();
$conn = $db->getConnection();

$whereClause = ''; // Condiție pentru filtrare
$params = []; // Parametrii pentru query

// Verificăm dacă există un filtru pentru tipul de angajat
if (!empty($_GET['filter_type'])) {
    $whereClause = "WHERE tip_agt = ?";
    $params[] = $_GET['filter_type'];
}

// Construim query-ul SQL
$query = "SELECT * FROM angajati $whereClause";
$stmt = $conn->prepare($query);
$stmt->execute($params);
$angajati = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include 'includes/header.php'; ?>
<?php
include 'session.php';
?>


<link rel="stylesheet" href="css/style.css">

<div class="container mt-5">
    <h2 class="mb-4"><?= $messages['employees_list_title']; ?></h2>

    <!-- Formular pentru filtrarea angajaților -->
    <form method="GET" class="mb-4">
        <label for="filter_type" class="form-label"><?= $messages['filter_label']; ?></label>
        <select name="filter_type" id="filter_type" class="form-select w-50 d-inline-block">
            <option value=""><?= $messages['filter_all']; ?></option>
            <option value="M" <?= isset($_GET['filter_type']) && $_GET['filter_type'] === 'M' ? 'selected' : '' ?>><?= $messages['filter_music']; ?></option>
            <option value="S" <?= isset($_GET['filter_type']) && $_GET['filter_type'] === 'S' ? 'selected' : '' ?>><?= $messages['filter_sport']; ?></option>
            <option value="D" <?= isset($_GET['filter_type']) && $_GET['filter_type'] === 'D' ? 'selected' : '' ?>><?= $messages['filter_drawing']; ?></option>
        </select>
        <button type="submit" class="btn btn-primary ml-2"><?= $messages['filter_button']; ?></button>
        <a href="<?= strtok($_SERVER['REQUEST_URI'], '?') ?>" class="btn btn-secondary"><?= $messages['reset_button']; ?></a>
    </form>

    <a href="add_angajat.php?lang=<?= $lang ?>" class="btn btn-success mb-3"><?= $messages['add_employee_button']; ?></a>

    <!-- Tabel pentru afișarea angajaților -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th><?= $messages['table_code']; ?></th>
                <th><?= $messages['table_name']; ?></th>
                <th><?= $messages['table_surname']; ?></th>
                <th><?= $messages['table_salary']; ?></th>
                <th><?= $messages['table_phone']; ?></th>
                <th><?= $messages['table_experience']; ?></th>
                <th><?= $messages['table_type']; ?></th>
                <th><?= $messages['table_materials']; ?></th>
                <th><?= $messages['table_actions']; ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($angajati)): ?>
                <?php foreach ($angajati as $angajat): ?>
                    <tr>
                        <td><?= htmlspecialchars($angajat['cod']) ?></td>
                        <td><?= htmlspecialchars($angajat['nume']) ?></td>
                        <td><?= htmlspecialchars($angajat['prenume']) ?></td>
                        <td><?= htmlspecialchars($angajat['salariu']) ?> RON</td>
                        <td><?= htmlspecialchars($angajat['nr_telefon']) ?></td>
                        <td><?= htmlspecialchars($angajat['experienta']) ?> ani</td>
                        <td><?= $angajat['tip_agt'] === 'M' ? $messages['filter_music'] : ($angajat['tip_agt'] === 'S' ? $messages['filter_sport'] : $messages['filter_drawing']) ?></td>
                        <td><?= htmlspecialchars($angajat['instrument'] ?: $angajat['echipament'] ?: $angajat['materiale']) ?></td>
                        <td>
                            <a href="edit_angajat.php?id=<?= $angajat['cod'] ?>&lang=<?= $lang ?>" class="btn btn-warning btn-sm"><?= $messages['edit_button']; ?></a>
                            <a href="delete_angajat.php?id=<?= $angajat['cod'] ?>&lang=<?= $lang ?>" class="btn btn-danger btn-sm" onclick="return confirm('<?= $messages['delete_confirmation']; ?>');"><?= $messages['delete_button']; ?></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9"><?= $messages['no_results']; ?></td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
