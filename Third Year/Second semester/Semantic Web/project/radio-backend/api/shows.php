<?php
header("Content-Type: application/json");

$showsJson = file_get_contents("http://localhost:4000/shows");
$guestsJson = file_get_contents("http://localhost:4000/guests");

if (!$showsJson || !$guestsJson) {
    echo json_encode(["error" => "Eroare JSON Server"]);
    exit;
}

$shows = json_decode($showsJson, true);
$guests = json_decode($guestsJson, true);
$filtered = [];


foreach ($shows as $show) {
    if (isset($show['time']) && $show['time'] > "13:00") {
        $show['guests'] = [];

        foreach ($guests as $guest) {
            if ($guest['showId'] == $show['id']) {
                $show['guests'][] = $guest;
            }
        }

        $filtered[] = $show;
    }
}

echo json_encode($filtered, JSON_PRETTY_PRINT);

