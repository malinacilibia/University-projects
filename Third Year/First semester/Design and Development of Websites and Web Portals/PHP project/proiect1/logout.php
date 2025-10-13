<?php
session_start(); // porneste sesiunea pentru a avea acces la variabilele de sesiune
session_unset(); // sterge toate variabilele din sesiunea curenta
session_destroy(); // distruge sesiunea curenta si invalideaza datele de pe server
header("Location: login.php"); // redirectioneaza utilizatorul la pagina de login
exit(); // opreste executia scriptului
?>
