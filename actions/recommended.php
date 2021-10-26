<?php
header('Content-Type: application/json');
require("../includes/functions/core.php");

$response = ["success"=>true,"errors"=>[],"data"=>[]];

if(empty($_GET["genre"])){
  $response["success"] = false;
  array_push($response["errors"], "Mangelende query parameter genre");
}

if(empty($_GET["page"])){
  $response["success"] = false;
  array_push($response["errors"], "Mangelende query parameter page");
}

if($response["success"] === true){
  $genre = new Genre();
  $genre->Slug = @$_GET["genre"];

  $response["data"] = $genre->recommendedMovies($_GET["page"]);
}

echo json_encode($response, JSON_PRETTY_PRINT);
?>