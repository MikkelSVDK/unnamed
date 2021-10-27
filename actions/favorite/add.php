<?php
header('Content-Type: application/json');
require("../../includes/functions/core.php");

$response = ["success"=>true,"errors"=>[],"data"=>[]];

if(empty($_GET["movie"])){
  $response["success"] = false;
  array_push($response["errors"], "Mangelende movie parameter");
}

if(in_array($_GET["movie"], $_SESSION["FavoriteMovies"])){
  $response["success"] = false;
  array_push($response["errors"], "Filmen er allerede tilføjet til dine favoritter");
}

if($response["success"] === true){
  array_push($_SESSION["FavoriteMovies"], $_GET["movie"]);
}

echo json_encode($response, JSON_PRETTY_PRINT);
?>