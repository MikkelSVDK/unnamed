<?php
/**
 * List Genres
 *
 * @return array 
 */
function listGenres(){
  // Array of genres 
  $genreArr = [
    [
      "slug" => "action",
      "name" => "Action"
    ],
    [
      "slug" => "comedy",
      "name" => "Komedie"
    ],
    [
      "slug" => "thriller",
      "name" => "Thriller"
    ],
    [
      "slug" => "war",
      "name" => "Krig"
    ],
    [
      "slug" => "romance",
      "name" => "Romantik"
    ],
    [
      "slug" => "drama",
      "name" => "Drama"
    ],
    [
      "slug" => "crime",
      "name" => "Krimi"
    ],
    [
      "slug" => "documentary",
      "name" => "Dokumentar"
    ],
    [
      "slug" => "horror",
      "name" => "Horror"
    ]
  ];

  // Define return array and loop through genre array
  $returnArr = [];
  foreach ($genreArr as $genre){
    // Request genre entry count
    $res = file_get_contents("https://feed.entertainment.tv.theplatform.eu/f/jGxigC/bb-all-pas?entries=false&count=true&byTags=genre:$genre[slug]&range=1-1&q=(estProductAvailability%3A%22available%22%20OR%20tvodProductAvailability%3A%22available%22)&form=json&lang=da");
    $resData = json_decode($res, true);
    
    // Define genre
    $tempGenre = new Genre();
    $tempGenre->Slug = $genre["slug"];
    $tempGenre->Name = $genre["name"];
    $tempGenre->MovieCount = $resData["totalResults"];

    array_push($returnArr, $tempGenre);
  }
    

  return $returnArr;
}