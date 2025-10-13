<?php
include 'config/database.php'; // include fisierul pentru conectarea la baza de date
include 'includes/header.php'; // include header-ul comun al paginii

session_start(); // porneste sesiunea pentru accesarea variabilelor $_SESSION
$database = new Database(); // creeaza o instanta a clasei Database
$conn = $database->getConnection(); // obtine conexiunea la baza de date
$user_id = $_SESSION['user_id']; // preia id-ul utilizatorului din sesiune
$user_role = $_SESSION['role']; // preia rolul utilizatorului din sesiune

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // verifica daca metoda HTTP folosita este POST
    $profile_details = []; // initializeaza un array gol pentru detalii de profil

    // colecteaza datele din formular in functie de rolul utilizatorului
    if ($user_role == 'member') {
        $profile_details['education'] = $_POST['education'];
        $profile_details['interests'] = $_POST['interests'];
        $profile_details['projects'] = $_POST['projects'];
    } elseif ($user_role == 'mentor') {
        $profile_details['experience'] = $_POST['experience'];
        $profile_details['skills'] = $_POST['skills'];
        $profile_details['availability'] = $_POST['availability'];
    } elseif ($user_role == 'admin') {
        $profile_details['role_description'] = $_POST['role_description'];
        $profile_details['managed_projects'] = $_POST['managed_projects'];
        $profile_details['community_contributions'] = $_POST['community_contributions'];
    }

    $profile_details_json = json_encode($profile_details); // transforma array-ul detaliilor in format JSON

    try {
        // pregateste interogarea SQL pentru actualizarea profilului in baza de date
        $query = "UPDATE users SET profile_details = :profile_details WHERE id = :id";
        $stmt = $conn->prepare($query); // pregateste interogarea
        $stmt->bindParam(':profile_details', $profile_details_json); // leaga detaliile de profil in format JSON
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT); // leaga id-ul utilizatorului

        if ($stmt->execute()) { // verifica daca actualizarea a fost executata cu succes
            echo "<div style='text-align: center; margin-top: 20px;'>
                    <h3>Profil actualizat cu succes!</h3>
                    <button onclick=\"window.location.href='{$user_role}_dashboard.php'\" style='padding: 10px 20px; font-size: 16px; margin-top: 15px;'>Înapoi la dashboard</button>
                  </div>";
        } else { // afiseaza mesaj de eroare daca actualizarea esueaza
            echo "<div style='text-align: center; margin-top: 20px; color: red;'>
                    <h3>Eroare la actualizarea profilului.</h3>
                    <button onclick=\"window.location.href='{$user_role}_dashboard.php'\" style='padding: 10px 20px; font-size: 16px; margin-top: 15px;'>Înapoi la dashboard</button>
                  </div>";
        }
    } catch (PDOException $e) { // gestioneaza erorile SQL
        echo "<div style='text-align: center; margin-top: 20px; color: red;'>
                <h3>Eroare: " . $e->getMessage() . "</h3>
                <button onclick=\"window.location.href='{$user_role}_dashboard.php'\" style='padding: 10px 20px; font-size: 16px; margin-top: 15px;'>Înapoi la dashboard</button>
              </div>";
    }
}
include 'includes/footer.php'; // include footer-ul comun al paginii
?>
