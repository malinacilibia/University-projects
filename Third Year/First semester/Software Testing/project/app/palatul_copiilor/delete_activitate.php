<?php
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

// Verificăm dacă există un ID pentru activitatea de șters
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id']; // Preluăm ID-ul activității din query string

    // Verificăm dacă activitatea există în baza de date
    $query = "SELECT * FROM activitati WHERE cod = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);
    $activitate = $stmt->fetch(PDO::FETCH_ASSOC);

    // Dacă activitatea există, procedăm la ștergere
    if ($activitate) {
        $deleteQuery = "DELETE FROM activitati WHERE cod = ?";
        $deleteStmt = $conn->prepare($deleteQuery);
        try {
            $deleteStmt->execute([$id]);
            $message = $messages['delete_activity_success'];
            header("Location: activitati.php?lang=$lang&message=" . urlencode($message));
            exit;
        } catch (PDOException $e) {
            $error = $messages['delete_activity_error'] . ': ' . $e->getMessage();
            header("Location: activitati.php?lang=$lang&error=" . urlencode($error));
            exit;
        }
    } else {
        $error = $messages['activity_not_found'];
        header("Location: activitati.php?lang=$lang&error=" . urlencode($error));
        exit;
    }
}
?>
<?php include 'includes/header.php'; ?>

<div class="container mt-5">
    <h2><?php echo $messages['delete_confirmation']; ?></h2>

    <?php if (!empty($activitate)): ?>
        <p><?php echo $messages['delete_confirmation'] . ' <strong>' . htmlspecialchars($activitate['nume']) . '</strong>?'; ?></p>
        <form method="GET">
            <input type="hidden" name="id" value="<?= htmlspecialchars($activitate['cod']) ?>">
            <button type="submit" class="btn btn-danger"><?php echo $messages['delete_button']; ?></button>
            <a href="activitati.php?lang=<?php echo $lang; ?>" class="btn btn-secondary"><?php echo $messages['cancel_button']; ?></a>
        </form>
    <?php else: ?>
        <p><?php echo $messages['activity_not_found']; ?></p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
