<?php
header("Content-Type: application/json");

$query = <<<SPARQL
PREFIX schema: <http://schema.org/>
SELECT ?title ?time ?guestName ?profession WHERE {
  ?show a schema:Event ;
        schema:name ?title ;
        schema:startTime ?time .

  OPTIONAL {
    ?guest a schema:Person ;
           schema:name ?guestName ;
           schema:jobTitle ?profession ;
           schema:performerIn ?show .
  }

  FILTER(?time > "09:00")
}
SPARQL;

$url = "http://localhost:8080/rdf4j-server/repositories/grafexamen";

$options = [
    "http" => [
        "method" => "POST",
        "header" => "Content-Type: application/sparql-query\r\nAccept: application/sparql-results+json",
        "content" => $query
    ]
];

$response = file_get_contents($url, false, stream_context_create($options));

if (!$response) {
    echo json_encode(["error" => "Eroare RDF4J"]);
    exit;
}

echo $response;
