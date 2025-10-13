<?php
// genereaza un hash securizat pentru parola 'malinacilibia' folosind algoritmul implicit
$hashedPassword = password_hash('malinacilibia', PASSWORD_DEFAULT);
// afișează hash-ul generat pentru parola 'malinacilibia'
echo $hashedPassword . "<br>";

// genereaza un hash securizat pentru parola 'nicolarusu'
$hashedPassword = password_hash('nicolarusu', PASSWORD_DEFAULT);
// afișează hash-ul generat pentru parola 'nicolarusu'
echo $hashedPassword . "<br>";

// genereaza un hash securizat pentru parola 'andreeamarcu'
$hashedPassword = password_hash('andreeamarcu', PASSWORD_DEFAULT);
// afișează hash-ul generat pentru parola 'andreeamarcu'
echo $hashedPassword . "<br>";
?>
