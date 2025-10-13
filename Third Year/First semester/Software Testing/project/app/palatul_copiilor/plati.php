<?php
// includem fișierul pentru controlul accesului
include 'includes/access_control.php';
// verificăm dacă utilizatorul are acces ca profesor
check_access(['profesor']);

$lang = $_GET['lang'] ?? 'ro'; // Setăm limba implicită ca română
$messagesFile = "lang/$lang/messages.php";
if (!file_exists($messagesFile)) {
    $lang = 'ro'; // Dacă limba selectată nu există, revenim la română
    $messagesFile = "lang/$lang/messages.php";
}
$messages = include $messagesFile;


?>

<?php include 'includes/header.php'; ?>
<!-- includem fisierul pentru antet (header) -->

<?php

// includem fișierul de configurare pentru baza de date
include 'config/Database.php';

// Cream o instanță a clasei Database
$db = new Database();
// Obținem conexiunea la baza de date
$conn = $db->getConnection();

$whereClause = ''; // condiție pentru filtrare
$params = []; // parametrii pentru query

// verificăm dacă există un filtru pentru tipul de plată
if (!empty($_GET['filter_type'])) {
    $whereClause = "WHERE tip_pta = ?"; // adăugăm condiția de filtrare
    $params[] = $_GET['filter_type']; // adăugăm tipul de plată la parametrii interogării
}

// construim query-ul SQL
$query = "SELECT * FROM plati $whereClause"; // query-ul pentru selectarea plăților
$stmt = $conn->prepare($query); // pregătim interogarea
$stmt->execute($params); // executăm interogarea cu parametrii
$plati = $stmt->fetchAll(PDO::FETCH_ASSOC); // preluăm rezultatele
?>

<link rel="stylesheet" href="css/style.css">
<!-- includem fișierul CSS pentru stilizarea paginii -->

<div class="container mt-5">
    <h2 class="mb-4"><?php echo $messages['payments_title']; ?></h2>

    <!-- formular pentru filtrarea plăților după tip -->
    <form method="GET" class="mb-4">
        <label for="filter_type" class="form-label"><?php echo $messages['filter_label']; ?></label>
        <select name="filter_type" id="filter_type" class="form-select w-50 d-inline-block">
            <option value=""><?php echo $messages['filter_all']; ?></option>
            <!-- opțiuni pentru tipurile de plăți -->
            <option value="C" <?= isset($_GET['filter_type']) && $_GET['filter_type'] === 'C' ? 'selected' : '' ?>>
                <?php echo $messages['filter_card']; ?>
            </option>
            <option value="N" <?= isset($_GET['filter_type']) && $_GET['filter_type'] === 'N' ? 'selected' : '' ?>>
                <?php echo $messages['filter_cash']; ?>
            </option>
        </select>
        <button type="submit" class="btn btn-primary ml-2"><?php echo $messages['filter_button']; ?></button>
        <a href="<?= strtok($_SERVER['REQUEST_URI'], '?') ?>" class="btn btn-secondary"><?php echo $messages['reset_button']; ?></a>
    </form>

    <!-- tabel pentru afișarea plăților -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th><?php echo $messages['table_number']; ?></th>
                <th><?php echo $messages['table_payment_date']; ?></th>
                <th><?php echo $messages['table_amount']; ?></th>
                <th><?php echo $messages['table_bank']; ?></th>
                <th><?php echo $messages['table_payment_type']; ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($plati)): ?>
                <?php foreach ($plati as $plata): ?>
                    <tr>
                        <td><?= htmlspecialchars($plata['numar']) ?></td>
                        <td><?= htmlspecialchars($plata['data_plata']) ?></td>
                        <td><?= htmlspecialchars($plata['suma']) ?> <?php echo $messages['currency']; ?></td>
                        <td><?= htmlspecialchars($plata['banca'] ?? 'N/A') ?></td>
                        <td><?= $plata['tip_pta'] === 'C' ? $messages['filter_card'] : $messages['filter_cash']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6"><?php echo $messages['no_results']; ?></td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<!-- includem fișierul pentru footer -->
