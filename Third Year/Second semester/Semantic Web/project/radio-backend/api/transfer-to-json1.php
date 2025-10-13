<?php
header("Content-Type: application/json");
ini_set('display_errors', 1);
error_reporting(E_ALL);

$input = json_decode(file_get_contents("php://input"), true);

if (!is_array($input)) {
    echo json_encode(["success" => false, "error" => "Date invalide"]);
    exit;
}

$shows = [];
$guests = [];
$showIds = [];
$showIdCounter = 1;
$guestId = 1;

foreach ($input as $item) {
    if (isset($item['title'], $item['time'])) {
        if (!isset($showIds[$item['title']])) {
            $showIds[$item['title']] = $showIdCounter++;
            $shows[] = [
                "id" => $showIds[$item['title']],
                "title" => $item['title'],
                "time" => $item['time']
            ];
        }

        if (isset($item['guestName'], $item['profession'])) {
            $guests[] = [
                "id" => $guestId++,
                "name" => $item['guestName'],
                "profession" => $item['profession'],
                "showId" => $showIds[$item['title']]
            ];
        }
    }
}

function postToJsonServer($url, $data) {
    return file_get_contents($url, false, stream_context_create([
        "http" => [
            "method" => "POST",
            "header" => "Content-Type: application/json",
            "content" => json_encode($data)
        ]
    ]));
}

foreach ($shows as $show) {
    postToJsonServer("http://localhost:4000/shows", $show);
}

foreach ($guests as $guest) {
    postToJsonServer("http://localhost:4000/guests", $guest);
}

echo json_encode([
    "success" => true,
    "count" => count($shows) . " shows / " . count($guests) . " guests"
]);
