<?php
include 'includes/functions.php';
include_once "includes/header.php";
checkUserRole('member');
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Dashboard</title>
    <link rel="stylesheet" href="css/style_dasboards.css">

</head>
<body>
<h1>Bine ai venit, <?= $_SESSION['name']; ?>!</h1>
<p>Acesta este dashboard-ul pentru membri.</p>
<form method="post" action="update_profile.php">
    <label for="education">Educație:</label><br>
    <textarea name="education" id="education" rows="3" cols="50" placeholder="Descrie nivelul de educație (ex: universitate, cursuri etc.)"></textarea><br>

    <label for="interests">Interese:</label><br>
    <textarea name="interests" id="interests" rows="3" cols="50" placeholder="Ex: dezvoltare web, AI, securitate cibernetică"></textarea><br>

    <label for="projects">Proiecte personale:</label><br>
    <textarea name="projects" id="projects" rows="5" cols="50" placeholder="Descrie proiectele tale personale"></textarea><br>

    <input type="submit" value="Actualizează profilul">
</form>
<a href="logout.php">Logout</a>
</body>
</html>
<?php
include_once "includes/footer.php";
?>
