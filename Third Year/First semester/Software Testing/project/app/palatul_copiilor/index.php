<?php
// Setăm limba implicită și încărcăm fișierul de localizare
$lang = $_GET['lang'] ?? 'ro'; // Limba implicită este româna
$messagesFile = "lang/$lang/messages.php";
if (!file_exists($messagesFile)) {
    $lang = 'ro'; // Dacă limba selectată nu există, revenim la română
    $messagesFile = "lang/$lang/messages.php";
}
$messages = include $messagesFile;

// Includem antetul paginii
include 'includes/header.php';
?>
<!-- includem fisierul CSS pentru stilizarea paginii -->
<link rel="stylesheet" href="css/style.css">
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.5/dist/cdn.min.js" defer></script>
<!-- includem Alpine.js pentru interactivitate -->

<div class="container mt-5" x-data="{ showDetails: false }">
    <div class="text-center">
        <!-- sectiune pentru mesajul de bun venit -->
        <h1><?php echo $messages['welcome'] ?? 'Bine ați venit la Palatul Copiilor Cluj-Napoca'; ?></h1>
        <p class="mt-4">
            <?php echo $messages['intro'] ?? 'Pentru o mai bună monitorizare a activităților Palatului Copiilor din Cluj-Napoca, am creat o bază de date
            care facilitează gestionarea activităților și serviciilor oferite copiilor.'; ?>
        </p>

        <!-- Adăugăm un buton pentru afișarea detaliilor suplimentare -->
        <button class="btn btn-primary mt-3" @click="showDetails = !showDetails">
            <span x-text="showDetails ? '<?php echo $messages['button_hide_details']; ?>' : '<?php echo $messages['button_show_details']; ?>'"></span>
        </button>


        <!-- Detalii suplimentare care apar/dispar la clic -->
        <div x-show="showDetails" x-transition.duration.500ms class="mt-4">
            <p>
                <?php echo $messages['details_1'] ?? 'Instituția noastră primește cu bucurie copii cu vârste între <strong>3 și 18 ani</strong>, oferindu-le oportunități de participare la diverse cursuri
                și activități educative și recreative.'; ?>
            </p>
            <p>
                <?php echo $messages['details_2'] ?? 'Gruparea copiilor pe categorii de vârstă este esențială pentru stabilirea tarifelor și personalizarea activităților.
                Copiii pot alege între două pachete de ședințe: unul de <strong>14 ședințe</strong> și altul de <strong>28 ședințe</strong>,
                fiecare ședință având o durată de <strong>2 ore</strong>.'; ?>
            </p>
            <p>
                <?php echo $messages['details_3'] ?? 'Domeniile noastre includ <strong>muzica, sportul și desenul</strong>, iar pentru fiecare activitate, avem profesori
                dedicați care asigură o experiență de cea mai înaltă calitate. Participarea la cursuri se face pe bază de
                programare, iar plățile pot fi efectuate cash sau cu cardul.'; ?>
            </p>
            <p>
                <?php echo $messages['details_4'] ?? 'Acest proiect include o bază de date bine structurate, normalizate și optimizate pentru a gestiona toate aceste
                aspecte. Structura bazei de date reflectă relațiile complexe dintre entitățile principale: participanți, programări,
                grupuri de vârstă, tarife, angajați, plăți și activități.'; ?>
            </p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
