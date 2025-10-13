<?php
// pornim sesiunea pentru a gestiona autentificarea utilizatorului
session_start();

// functie pentru verificarea accesului utilizatorului
function check_access($allowed_roles) {
    // verificam daca utilizatorul este autentificat
    if (!isset($_SESSION['user_id'])) {
        // daca utilizatorul nu este autentificat, il redirectionam catre pagina de login
        header("Location: login.php");
        exit; // oprim executia scriptului
    }
    // verificam daca utilizatorul are unul dintre rolurile permise
    if (!in_array($_SESSION['role'], $allowed_roles)) {
        // daca utilizatorul nu are permisiune, il redirectionam catre pagina "Acces interzis"
        header("Location: acces_denied.php");
        exit; // oprim executia scriptului
    }
}