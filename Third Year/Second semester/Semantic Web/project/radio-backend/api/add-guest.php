<?php
header("Content-Type: application/json");
ini_set('display_errors', 1);
error_reporting(E_ALL);

$input = json_decode(file_get_contents("php://input"), true);


if (
    !isset($input['newGuest']) || !is_array($input['newGuest'])
) {
    echo json_encode(["success" => false, "error" => "Date lipsa"]);
    exit;
}

$guest = $input['newGuest'];


$query = <<<GQL
mutation {
  createGuest(
    name: "{$guest['name']}",
    profession: "{$guest['profession']}",
    showId: {$guest['showId']}
  ) {
    id
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
    echo json_encode(["success" => false, "error" => "Eroare GraphQL Server"]);
    exit;
}

$data = json_decode($response, true);

if (isset($data["data"]["createGuest"])) {
    echo json_encode(["success" => true, "message" => "Invitatul a fost adaugat cu succes."]);
} else {
    echo json_encode(["success" => false, "error" => "Mutatia nu a reusit."]);
}
