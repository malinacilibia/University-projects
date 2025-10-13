<?php
// Includem fișierul pentru controlul accesului
include 'includes/access_control.php';
// Verificăm dacă utilizatorul are acces ca profesor
check_access(['profesor']);

// Includem fișierul de configurare pentru baza de date
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

// Verificăm dacă avem un ID pentru activitatea de editat
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM activitati WHERE cod = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);
    $activitate = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Dacă formularul a fost trimis, actualizăm activitatea
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nume = $_POST['nume'];
    $nivel_dificultate = $_POST['nivel_dificultate'];
    $durata = $_POST['durata'];

    $query = "UPDATE activitati SET nume = ?, nivel_dificultate = ?, durata = ? WHERE cod = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$nume, $nivel_dificultate, $durata, $id]);

    // Redirecționăm la lista de activități după salvarea modificărilor
    header("Location: activitati.php?lang=$lang");
    exit;
}
?>
<?php include 'includes/header.php'; ?>
<link rel="stylesheet" href="css/style.css">

<div class="container mt-5">
    <h2><?php echo $messages['edit_activity_title']; ?></h2>

    <?php if (!empty($activitate)): ?>
        <!-- Formular pentru editarea activității -->
        <form method="POST" action="edit_activitate.php?lang=<?php echo $lang; ?>">
            <input type="hidden" name="id" value="<?= htmlspecialchars($activitate['cod']) ?>">

            <div class="mb-3">
                <label for="nume" class="form-label"><?php echo $messages['name_label']; ?></label>
                <input type="text" name="nume" id="nume" class="form-control" value="<?= htmlspecialchars($activitate['nume']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="nivel_dificultate" class="form-label"><?php echo $messages['difficulty_level_label']; ?></label>
                <select name="nivel_dificultate" id="nivel_dificultate" class="form-select" required>
                    <option value="incepator" <?= $activitate['nivel_dificultate'] === 'incepator' ? 'selected' : '' ?>><?php echo $messages['beginner_option']; ?></option>
                    <option value="mediu" <?= $activitate['nivel_dificultate'] === 'mediu' ? 'selected' : '' ?>><?php echo $messages['intermediate_option']; ?></option>
                    <option value="avansat" <?= $activitate['nivel_dificultate'] === 'avansat' ? 'selected' : '' ?>><?php echo $messages['advanced_option']; ?></option>
                </select>
            </div>

            <div class="mb-3">
                <label for="durata" class="form-label"><?php echo $messages['duration_label']; ?></label>
                <input type="text" name="durata" id="durata" class="form-control" value="<?= htmlspecialchars($activitate['durata']) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary"><?php echo $messages['save_button']; ?></button>
            <a href="activitati.php?lang=<?php echo $lang; ?>" class="btn btn-secondary"><?php echo $messages['back_button']; ?></a>
        </form>
    <?php else: ?>
        <!-- Mesaj dacă activitatea nu a fost găsită -->
        <p><?php echo $messages['not_found_error']; ?></p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
