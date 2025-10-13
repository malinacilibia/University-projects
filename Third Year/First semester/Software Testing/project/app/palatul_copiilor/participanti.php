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

// Verificăm dacă utilizatorul este autentificat
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Verificăm dacă utilizatorul are rolul de profesor
if ($_SESSION['role'] !== 'profesor') {
    header("Location: acces_denied.php");
    exit;
}

// Inițializăm mesajele de succes sau eroare primite prin query string
$message = $_GET['message'] ?? '';
$error = $_GET['error'] ?? '';

// Cream o instanță a clasei Database
$db = new Database();
$conn = $db->getConnection();

// Inițializăm filtrele pentru căutare
$whereClauses = [];
$params = [];

// Filtrare după nume sau prenume
if (!empty($_GET['search_name'])) {
    $whereClauses[] = "(nume LIKE ? OR prenume LIKE ?)";
    $params[] = "%" . $_GET['search_name'] . "%";
    $params[] = "%" . $_GET['search_name'] . "%";
}

// Filtrare după grupă
if (!empty($_GET['search_group'])) {
    $whereClauses[] = "grupa_gvd = ?";
    $params[] = $_GET['search_group'];
}

// Construim query-ul SQL cu filtre
$query = "SELECT * FROM participanti";
if (!empty($whereClauses)) {
    $query .= " WHERE " . implode(" AND ", $whereClauses);
}

$stmt = $conn->prepare($query);
$stmt->execute($params);
$participanti = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'includes/header.php'; ?>
<link rel="stylesheet" href="css/style.css">

<div class="container mt-5">
    <h2><?php echo $messages['participants_title']; ?></h2>

    <!-- Afișăm mesajele de succes sau eroare -->
    <?php if ($message): ?>
        <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="search-bar mb-3">
        <form action="participanti.php" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <label for="search_name"><?php echo $messages['search_name_label']; ?></label>
                    <input type="text" class="form-control" name="search_name" id="search_name" value="<?= isset($_GET['search_name']) ? htmlspecialchars($_GET['search_name']) : '' ?>">
                </div>
                <div class="col-md-4">
                    <label for="search_group"><?php echo $messages['search_group_label']; ?></label>
                    <select class="form-control" name="search_group" id="search_group">
                        <option value=""><?php echo $messages['reset_button']; ?></option>
                        <option value="1" <?= isset($_GET['search_group']) && $_GET['search_group'] == '1' ? 'selected' : '' ?>>Grupa 1</option>
                        <option value="2" <?= isset($_GET['search_group']) && $_GET['search_group'] == '2' ? 'selected' : '' ?>>Grupa 2</option>
                        <option value="3" <?= isset($_GET['search_group']) && $_GET['search_group'] == '3' ? 'selected' : '' ?>>Grupa 3</option>
                        <option value="4" <?= isset($_GET['search_group']) && $_GET['search_group'] == '4' ? 'selected' : '' ?>>Grupa 4</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary"><?php echo $messages['search_button']; ?></button>
                    <a href="<?= strtok($_SERVER['REQUEST_URI'], '?') ?>" class="btn btn-secondary"><?php echo $messages['reset_button']; ?></a>
                </div>
            </div>
        </form>
    </div>

    <a href="add_participant.php" class="btn btn-success mb-3"><?php echo $messages['add_participant_button']; ?></a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th><?php echo $messages['table_code']; ?></th>
            <th><?php echo $messages['table_name']; ?></th>
            <th><?php echo $messages['table_surname']; ?></th>
            <th><?php echo $messages['table_birth_date']; ?></th>
            <th><?php echo $messages['table_address']; ?></th>
            <th><?php echo $messages['table_phone']; ?></th>
            <th><?php echo $messages['table_group']; ?></th>
            <th><?php echo $messages['table_actions']; ?></th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($participanti)): ?>
            <?php foreach ($participanti as $participant): ?>
                <tr>
                    <td><?= htmlspecialchars($participant['cod']) ?></td>
                    <td><?= htmlspecialchars($participant['nume']) ?></td>
                    <td><?= htmlspecialchars($participant['prenume']) ?></td>
                    <td><?= htmlspecialchars($participant['data_nast']) ?></td>
                    <td><?= htmlspecialchars($participant['strada']) . ' ' . htmlspecialchars($participant['nr']) ?></td>
                    <td><?= htmlspecialchars($participant['nr_tel']) ?></td>
                    <td><?= htmlspecialchars($participant['grupa_gvd']) ?></td>
                    <td>
                        <a href="edit_participant.php?id=<?= htmlspecialchars($participant['cod']) ?>&lang=<?= $lang ?>" class="btn btn-warning btn-sm"><?php echo $messages['edit_button']; ?></a>
                        <a href="delete_participant.php?id=<?= htmlspecialchars($participant['cod']) ?>&lang=<?= $lang ?>" class="btn btn-danger btn-sm" onclick="return confirm('<?php echo $messages['delete_confirmation']; ?>');"><?php echo $messages['delete_button']; ?></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8"><?php echo $messages['no_results']; ?></td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
