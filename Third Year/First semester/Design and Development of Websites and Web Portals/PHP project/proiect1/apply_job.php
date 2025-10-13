<?php
include_once 'config/database.php';
include_once "includes/header.php";

// Inițializează conexiunea la baza de date
$database = new Database(); // creează o instanță a clasei Database pentru conectarea la baza de date
$conn = $database->getConnection(); // obține conexiunea activă

// Obține lista joburilor din baza de date
$jobs = []; // inițializează lista joburilor ca un array gol
if ($conn) { // verifică dacă conexiunea la baza de date a fost realizată
    $sql = "SELECT id, title FROM jobs ORDER BY title ASC"; // interogare SQL pentru a obține joburile ordonate alfabetic
    $stmt = $conn->prepare($sql); // pregătește interogarea SQL
    $stmt->execute(); // execută interogarea
    $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC); // preia rezultatele sub formă de array asociativ
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // verifică dacă metoda HTTP utilizată este POST
    // Preia datele din formular
    $job_id = $_POST['job_id']; // ID-ul jobului pentru care se aplică
    $applicant_first_name = $_POST['applicant_first_name']; // prenumele aplicantului
    $applicant_last_name = $_POST['applicant_last_name']; // numele de familie al aplicantului
    $applicant_email = $_POST['applicant_email']; // adresa de email a aplicantului
    $previous_experience = $_POST['previous_experience']; // experiența anterioară
    $recommendation = $_POST['recommendation']; // recomandarea

    if ($conn) { // verifică dacă conexiunea la baza de date a fost realizată
        // Pregătirea declarației SQL pentru inserare
        $sql = "INSERT INTO applications (job_id, applicant_first_name, applicant_last_name, applicant_email, previous_experience, recommendation) 
                VALUES (:job_id, :applicant_first_name, :applicant_last_name, :applicant_email, :previous_experience, :recommendation)";
        $stmt = $conn->prepare($sql); // pregătește interogarea SQL

        // Legarea parametrilor pentru a preveni SQL injection
        $stmt->bindParam(':job_id', $job_id); // leagă ID-ul jobului la parametrul :job_id
        $stmt->bindParam(':applicant_first_name', $applicant_first_name); // leagă prenumele aplicantului
        $stmt->bindParam(':applicant_last_name', $applicant_last_name); // leagă numele aplicantului
        $stmt->bindParam(':applicant_email', $applicant_email); // leagă emailul aplicantului
        $stmt->bindParam(':previous_experience', $previous_experience); // leagă experiența anterioară
        $stmt->bindParam(':recommendation', $recommendation); // leagă recomandarea

        if ($stmt->execute()) { // execută interogarea și verifică succesul
            header("Location: apply_success.php"); // redirecționează către o pagină de succes
            exit(); // oprește execuția scriptului după redirecționare
        } else { // afișează un mesaj de eroare dacă interogarea a eșuat
            $errorInfo = $stmt->errorInfo(); // preia informațiile despre eroare
            echo "<p style='color: red;'>Eroare la aplicare: " . $errorInfo[2] . "</p>"; // afișează detaliile erorii
        }
    } else { // afișează un mesaj dacă conexiunea la baza de date nu a fost realizată
        echo "<p style='color: red;'>Eroare: Nu s-a putut stabili conexiunea la baza de date.</p>";
    }

    $conn = null; // închide conexiunea la baza de date
}

?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style_jobs.css">
    <title>Aplicare Job</title>
</head>
<body>
<div class="containers">
    <h1>Aplicare pentru un Job</h1>
    <form method="POST" action="apply_job.php">
        <label for="job_id">Selectează Jobul:</label>
        <select name="job_id" id="job_id" required>
            <option value="">-- Alege un job --</option>
            <?php foreach ($jobs as $job): ?>  <!-- parcurgem toate elementele din arrayul $jobs, &job reprezinta un rand -->
                <option value="<?php echo htmlspecialchars($job['id']); ?>"><?php echo htmlspecialchars($job['title']);// afiseaza numele jobului curatand eventualele caractere speciale ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="applicant_first_name">Prenume:</label>
        <input type="text" name="applicant_first_name" id="applicant_first_name" placeholder="Introdu prenumele tău" required><br><br>

        <label for="applicant_last_name">Nume:</label>
        <input type="text" name="applicant_last_name" id="applicant_last_name" placeholder="Introdu numele tău" required><br><br>

        <label for="applicant_email">Email:</label>
        <input type="email" name="applicant_email" id="applicant_email" placeholder="Introdu email-ul tău" required><br><br>

        <label for="previous_experience">Experiență anterioară:</label>
        <textarea name="previous_experience" id="previous_experience" placeholder="Descrie experiența ta anterioară" required></textarea><br><br>

        <label for="recommendation">Ce te recomandă:</label>
        <textarea name="recommendation" id="recommendation" placeholder="Descrie ce te face potrivit pentru acest job" required></textarea><br><br>

        <button type="submit" class="btn btn-primary">Trimite Aplicarea</button>
    </form>
    <a href="jobs_board.php" class="btn-back">Înapoi la Jobs Board</a>
</div>
<?php include_once "includes/footer.php"; ?>
</body>
</html>
