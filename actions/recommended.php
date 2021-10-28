<?php
header('Content-Type: application/json');

// Include core functions and models
require("../includes/functions/core.php");

// Defines resp array
$response = ["success"=>true,"errors"=>[],"data"=>[]];

// Check if genre is empty
if(empty($_GET["genre"])){
  $response["success"] = false;
  array_push($response["errors"], "Mangelende query parameter genre");
}

// Check if page is empty
if(empty($_GET["page"])){
  $response["success"] = false;
  array_push($response["errors"], "Mangelende query parameter page");
}

// Check if the above checks was successful
if($response["success"] === true){

  // Define genre
  $genre = new Genre();
  $genre->Slug = @$_GET["genre"];

  // Array of 6 movies from $_GET["page"] page
  $response["data"] = $genre->recommendedMovies($_GET["page"]);
}

// Returns data as JSON
echo json_encode($response, JSON_PRETTY_PRINT);
?>