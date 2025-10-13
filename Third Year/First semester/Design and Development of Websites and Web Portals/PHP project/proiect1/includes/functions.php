<?php
function checkUserRole($requiredRole) {
    session_start();
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $requiredRole) { //Verifică dacă variabila de sesiune $_SESSION['role'] nu este setată si daca rolul utilizatorului nu corespunde cu rolul cerut
        header("Location: login.php"); //daca una dintre conditii este adevarata utilizatorul nu are acces la aceasta pagina
        exit();
    }
}