<?php
// includem fisierul pentru controlul accesului
include 'includes/access_control.php';
// verificam daca utilizatorul are acces ca profesor
check_access(['profesor']);

// includem fisierul pentru localizare
$lang = $_GET['lang'] ?? 'ro'; // Setăm limba implicită ca română
$messagesFile = "lang/$lang/messages.php";
if (!file_exists($messagesFile)) {
    $lang = 'ro'; // Dacă limba selectată nu există, revenim la română
    $messagesFile = "lang/$lang/messages.php";
}
$messages = include $messagesFile;


include 'includes/header.php'; ?>
<!-- includem fisierul pentru antet (header) -->

<?php
// includem fisierul pentru configurarea bazei de date
include 'config/Database.php';

// cream o instanta a clasei Database
$db = new Database();
// obtinem conexiunea la baza de date
$conn = $db->getConnection();

// verificam daca formularul a fost trimis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // preluam datele din formular
    $nume = $_POST['nume']; // numele activitatii
    $nivel_dificultate = $_POST['nivel_dificultate']; // nivelul de dificultate
    $durata = $_POST['durata']; // durata activitatii

    // construim query-ul pentru inserarea datelor in baza de date
    $query = "INSERT INTO activitati (nume, nivel_dificultate, durata) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query); // pregatim interogarea
    $stmt->execute([$nume, $nivel_dificultate, $durata]); // executam interogarea cu parametrii

    // redirectionam utilizatorul catre pagina activitatilor dupa adaugare
    header("Location: activitati.php?lang=" . htmlspecialchars($lang));
    exit; // oprim executia scriptului
}
?>
<link rel="stylesheet" href="css/style.css">
<!-- includem fisierul CSS pentru stilizarea paginii -->

<!-- formular pentru adaugarea unei noi activitati -->
<div class="container mt-5">
    <h2><?= $messages['add_activity_title'] ?></h2>

    <form method="POST" class="mt-4">
        <div class="mb-3">
            <label for="nume" class="form-label"><?= $messages['activity_name_label'] ?></label>
            <!-- camp pentru introducerea numelui activitatii -->
            <input type="text" name="nume" id="nume" class="form-control" placeholder="<?= $messages['activity_name_placeholder'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="nivel_dificultate" class="form-label"><?= $messages['difficulty_level_label'] ?></label>
            <!-- dropdown pentru selectarea nivelului de dificultate -->
            <select name="nivel_dificultate" id="nivel_dificultate" class="form-select" required>
                <option value="incepator"><?= $messages['level_beginner'] ?></option>
                <option value="mediu"><?= $messages['level_intermediate'] ?></option>
                <option value="avansat"><?= $messages['level_advanced'] ?></option>
            </select>
        </div>

        <div class="mb-3">
            <label for="durata" class="form-label"><?= $messages['duration_label'] ?></label>
            <!-- camp pentru introducerea duratei activitatii -->
            <input type="text" name="durata" id="durata" class="form-control" placeholder="<?= $messages['duration_placeholder'] ?>" required>
        </div>

        <!-- butoane pentru a adauga activitatea sau a anula -->
        <button type="submit" class="btn btn-primary"><?= $messages['submit_button'] ?></button>
        <a href="activitati.php?lang=<?= htmlspecialchars($lang) ?>" class="btn btn-primary"><?= $messages['back_button'] ?></a>

    </form>
</div>

<?php include 'includes/footer.php'; ?>
<!-- includem fisierul pentru footer -->
