<?php
header('Content-Type: application/json');

// Include core functions and models
require("../../includes/functions/core.php");

// Defines resp array
$response = ["success"=>true,"errors"=>[],"data"=>[]];

// Check if movie is empty
if(empty($_GET["movie"])){
  $response["success"] = false;
  array_push($response["errors"], "Mangelende movie parameter");
}

// Check if movie allready is in favorites
if(in_array($_GET["movie"], $_SESSION["FavoriteMovies"])){
  $response["success"] = false;
  array_push($response["errors"], "Filmen er allerede tilføjet til dine favoritter");
}

// Check if the above checks was successful
if($response["success"] === true){
  
  // Add movie to favorites
  array_push($_SESSION["FavoriteMovies"], $_GET["movie"]);
}

// Returns data as JSON
echo json_encode($response, JSON_PRETTY_PRINT);
?>