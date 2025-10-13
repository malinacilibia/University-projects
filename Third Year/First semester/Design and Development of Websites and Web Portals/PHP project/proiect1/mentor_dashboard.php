<?php
include 'includes/functions.php';
include_once "includes/header.php";
checkUserRole('mentor');
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentor Dashboard</title>
    <link rel="stylesheet" href="css/style_dasboards.css">

</head>
<body>
<h1>Bine ai venit, <?= $_SESSION['name']; ?>!</h1>
<p>Acesta este dashboard-ul pentru mentori.</p>
<form method="post" action="update_profile.php">
    <label for="experience">Experiență profesională:</label><br>
    <textarea name="experience" id="experience" rows="5" cols="50" placeholder="Descrie experiența ta profesională"></textarea><br>

    <label for="skills">Competențe:</label><br>
    <textarea name="skills" id="skills" rows="3" cols="50" placeholder="Listează competențele tale (ex: Python, SQL, management de proiect)"></textarea><br>

    <label for="availability">Disponibilitate pentru mentorat:</label><br>
    <textarea name="availability" id="availability" rows="3" cols="50" placeholder="Ex: număr de ore pe săptămână, program preferat"></textarea><br>

    <input type="submit" value="Actualizează profilul">
</form>
<a href="logout.php">Logout</a>
</body>
</html>
<?php
include_once "includes/footer.php";
?>
