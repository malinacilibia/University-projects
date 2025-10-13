<?php
// Includem fișierul pentru controlul accesului
include 'includes/access_control.php';
// Verificăm accesul utilizatorului pentru rolurile 'profesor' și 'elev'
check_access(['profesor', 'elev']);

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

$whereClauses = []; // Array pentru condițiile de filtrare
$params = []; // Array pentru parametrii interogării

// Filtrare după nume
if (!empty($_GET['search_name'])) {
    $whereClauses[] = "nume LIKE ?";
    $params[] = "%" . $_GET['search_name'] . "%";
}

// Filtrare după nivel de dificultate
if (!empty($_GET['search_level'])) {
    $whereClauses[] = "nivel_dificultate = ?";
    $params[] = $_GET['search_level'];
}

// Construim query-ul SQL
$query = "SELECT * FROM activitati";
if (!empty($whereClauses)) {
    $query .= " WHERE " . implode(" AND ", $whereClauses);
}

// Pregătim și executăm interogarea
$stmt = $conn->prepare($query);
$stmt->execute($params);
$activitati = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include 'includes/header.php'; ?>
<link rel="stylesheet" href="css/style.css">

<div class="container mt-5">
    <h2><?php echo $messages['activities_list_title']; ?></h2>

    <!-- Formular pentru filtrarea activităților -->
    <form method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <label for="search_name" class="form-label"><?php echo $messages['search_name_label']; ?></label>
                <input type="text" name="search_name" id="search_name" class="form-control" value="<?= isset($_GET['search_name']) ? htmlspecialchars($_GET['search_name']) : '' ?>">
            </div>
            <div class="col-md-4">
                <label for="search_level" class="form-label"><?php echo $messages['search_level_label']; ?></label>
                <select name="search_level" id="search_level" class="form-select">
                    <option value=""><?php echo $messages['reset_button']; ?></option>
                    <option value="incepator" <?= isset($_GET['search_level']) && $_GET['search_level'] === 'incepator' ? 'selected' : '' ?>>Începător</option>
                    <option value="mediu" <?= isset($_GET['search_level']) && $_GET['search_level'] === 'mediu' ? 'selected' : '' ?>>Mediu</option>
                    <option value="avansat" <?= isset($_GET['search_level']) && $_GET['search_level'] === 'avansat' ? 'selected' : '' ?>>Avansat</option>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary"><?php echo $messages['search_button']; ?></button>
                <a href="<?= strtok($_SERVER['REQUEST_URI'], '?') ?>" class="btn btn-secondary"><?php echo $messages['reset_button']; ?></a>
            </div>
        </div>
    </form>

    <!-- Buton pentru adăugarea unei activități noi -->
    <a href="add_activitate.php?lang=<?php echo $lang; ?>" class="btn btn-success mb-3"><?php echo $messages['add_activity_button']; ?></a>

    <!-- Tabel pentru afișarea activităților -->
    <table class="table table-striped">
        <thead>
        <tr>
            <th><?php echo $messages['table_code']; ?></th>
            <th><?php echo $messages['table_name']; ?></th>
            <th><?php echo $messages['table_level']; ?></th>
            <th><?php echo $messages['table_duration']; ?></th>
            <th><?php echo $messages['table_actions']; ?></th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($activitati)): ?>
            <?php foreach ($activitati as $activitate): ?>
                <tr>
                    <td><?= htmlspecialchars($activitate['cod']) ?></td>
                    <td><?= htmlspecialchars($activitate['nume']) ?></td>
                    <td><?= htmlspecialchars($activitate['nivel_dificultate']) ?></td>
                    <td><?= htmlspecialchars($activitate['durata']) ?></td>
                    <td>
                        <a href="edit_activitate2.php?id=<?= $activitate['cod'] ?>&lang=<?= $lang; ?>" class="btn btn-warning btn-sm"><?php echo $messages['edit_button']; ?></a>
                        <a href="delete_activitate.php?id=<?= $activitate['cod'] ?>&lang=<?= $lang; ?>" class="btn btn-danger btn-sm" onclick="return confirm('<?php echo $messages['delete_confirmation']; ?>');"><?php echo $messages['delete_button']; ?></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5"><?php echo $messages['no_results']; ?></td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<?php include 'includes/footer.php'; ?>
