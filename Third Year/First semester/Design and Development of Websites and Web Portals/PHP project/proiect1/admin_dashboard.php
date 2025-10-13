<?php
include 'includes/functions.php';
include_once "includes/header.php";
checkUserRole('admin');
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style_dasboards.css">
</head>
<body>
<h1>Bine ai venit, <?= $_SESSION['name']; ?>!</h1>
<p>Acesta este dashboard-ul pentru administratori.</p>
<form method="post" action="update_profile.php">
    <label for="role_description">Descrierea rolului:</label><br>
    <textarea name="role_description" id="role_description" rows="3" cols="50" placeholder="Descrie responsabilitățile tale ca admin"></textarea><br>

    <label for="managed_projects">Proiecte gestionate:</label><br>
    <textarea name="managed_projects" id="managed_projects" rows="5" cols="50" placeholder="Listează proiectele pe care le-ai coordonat"></textarea><br>

    <label for="community_contributions">Contribuții la comunitate:</label><br>
    <textarea name="community_contributions" id="community_contributions" rows="3" cols="50" placeholder="Descrie acțiunile tale de sprijin pentru comunitatea tech"></textarea><br>

    <input type="submit" value="Actualizează profilul">
</form>
<a href="logout.php">Logout</a>
</body>
</html>
<?php
include_once "includes/footer.php";
?>
