<?php
header("Content-Type: application/json");

$query = <<<GQL
{
  allShows(filter: { time_gt: "15:00" }) {
    id
    title
    time
  }
  allGuests {
    name
    profession
    showId
  }
}
GQL;


$graphqlQueryJson = json_encode(["query" => $query]);

$options = [
    "http" => [
        "method" => "POST",
        "header" => "Content-Type: application/json",
        "content" => $graphqlQueryJson

    ]
];

$response = file_get_contents("http://localhost:3000/graphql", false, stream_context_create($options));

if (!$response) {
    echo json_encode(["error" => "Eroare GraphQL"]);
    exit;
}

$data = json_decode($response, true);

if (!isset($data["data"]["allShows"]) || !isset($data["data"]["allGuests"])) {
    echo json_encode(["error" => "Datele nu au fost returnate corect din GraphQL"]);
    exit;
}

$shows = $data["data"]["allShows"];
$guests = $data["data"]["allGuests"];

foreach ($shows as &$show) {
    $show["guests"] = [];
    foreach ($guests as $guest) {
        if ($guest["showId"] == $show["id"]) {
            $show["guests"][] = $guest;
        }
    }
}

echo json_encode(["shows" => $shows], JSON_PRETTY_PRINT);
