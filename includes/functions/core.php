<?php
session_start();

if(!isset($_SESSION["FavoriteMovies"]))
  $_SESSION["FavoriteMovies"] = [];

// Including classes
require(__DIR__ . "/../classes/movie.php");
require(__DIR__ . "/../classes/genre.php");

// Including functions
require(__DIR__ . "/../functions/listGenres.php");
require(__DIR__ . "/../functions/listgenreMovies.php");