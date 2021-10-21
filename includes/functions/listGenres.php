<?php
/**
 * List Genres
 *
 * @return array 
 */
function listGenres(){
  // CALL API if i find it

  $genreArr = [
    [
      "id" => 1,
      "slug" => "action",
      "name" => "Action",
      "totalEntries" => 8421
    ],
    [
      "id" => 2,
      "slug" => "thriller",
      "name" => "Thriller",
      "totalEntries" => 1249
    ]
  ];

  $returnArr = [];
  foreach ($genreArr as $genre){
    $tempGenre = new Genre();
    $tempGenre->Id = $genre["id"];
    $tempGenre->Slug = $genre["slug"];
    $tempGenre->Name = $genre["name"];
    $tempGenre->MovieCount = $genre["totalEntries"];

    array_push($returnArr, $tempGenre);
  }
    

  return $returnArr;
}