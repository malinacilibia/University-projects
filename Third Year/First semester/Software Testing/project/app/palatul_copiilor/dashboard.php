<?php
// Pornim sesiunea pentru a accesa variabilele de sesiune
session_start();

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

// Preluăm rolul și numele utilizatorului din sesiune
$role = $_SESSION['role'];
$username = $_SESSION['username'];
?>
<?php include 'includes/header.php'; ?>
<link rel="stylesheet" href="css/style.css">
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.5/dist/cdn.min.js" defer></script>

<div class="container mt-5">
    <div class="text-center mb-4">
        <h2 class="display-4 text-warning"><?= $messages['welcome_message'] ?> <span class="text-dark"><?= htmlspecialchars($username) ?>!</span></h2>
        <p class="lead text-muted">
            <strong><?= $messages['role_label'] ?></strong> <?= htmlspecialchars($role === 'profesor' ? 'Profesor' : 'Elev') ?>
        </p>
        <p class="mt-4">
            <?= $messages['dashboard_intro'] ?>
        </p>
    </div>

    <div class="mt-5">
        <h3 class="mb-4 text-warning"><?= $messages['actions_header'] ?></h3>
        <div class="row">
            <?php if ($role == 'profesor'): ?>
                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm border-warning">
                        <div class="card-body">
                            <h5 class="card-title text-warning"><?= $messages['card_participants_title'] ?></h5>
                            <p class="card-text"><?= $messages['card_participants_text'] ?></p>
                            <a href="participanti.php?lang=<?= $lang ?>" class="btn btn-outline-warning"><?= $messages['button_access'] ?></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm border-warning">
                        <div class="card-body">
                            <h5 class="card-title text-warning"><?= $messages['card_employees_title'] ?></h5>
                            <p class="card-text"><?= $messages['card_employees_text'] ?></p>
                            <a href="angajati.php?lang=<?= $lang ?>" class="btn btn-outline-warning"><?= $messages['button_access'] ?></a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm border-warning">
                    <div class="card-body">
                        <h5 class="card-title text-warning"><?= $messages['card_schedules_title'] ?></h5>
                        <p class="card-text"><?= $messages['card_schedules_text'] ?></p>
                        <a href="<?= $role == 'profesor' ? 'programari.php' : 'programari_elevi.php' ?>?lang=<?= $lang ?>" class="btn btn-outline-warning"><?= $messages['button_access'] ?></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm border-warning">
                    <div class="card-body">
                        <h5 class="card-title text-warning"><?= $messages['card_payments_title'] ?></h5>
                        <p class="card-text"><?= $messages['card_payments_text'] ?></p>
                        <a href="plati.php?lang=<?= $lang ?>" class="btn btn-outline-warning"><?= $messages['button_access'] ?></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm border-warning">
                    <div class="card-body">
                        <h5 class="card-title text-warning"><?= $messages['card_activities_title'] ?></h5>
                        <p class="card-text"><?= $messages['card_activities_text'] ?></p>
                        <a href="activitati.php?lang=<?= $lang ?>" class="btn btn-outline-warning"><?= $messages['button_access'] ?></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm border-warning">
                    <div class="card-body">
                        <h5 class="card-title text-warning"><?= $messages['card_profile_title'] ?></h5>
                        <p class="card-text"><?= $messages['card_profile_text'] ?></p>
                        <a href="profil_utilizator.php?lang=<?= $lang ?>" class="btn btn-outline-warning"><?= $messages['button_access'] ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <p class="text-muted"><?= $messages['help_text'] ?></p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
