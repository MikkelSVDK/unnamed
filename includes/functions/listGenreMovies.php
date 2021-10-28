<?php
/**
 * List Genres
 *
 * @param string $genre  Genre
 * @param int $page  Page number
 * @param int $per_page  The number of movies per page
 * @return array 
 */
function listGenreMovies(string $genre, int $page = 1, int $per_page = 60){
  // Define start and end index
  $firstIndex = (($page - 1) * $per_page) + 1;
  $lastIndex = (($page - 1) * $per_page) + $per_page;

  // Request movie data
  $res = file_get_contents("https://feed.entertainment.tv.theplatform.eu/f/jGxigC/bb-all-pas?form=json&byTags=genre:$genre&q=(estProductAvailability%3A\"available\"%20OR%20tvodProductAvailability%3A\"available\")&count=true&sort=:sortDate|desc&range=$firstIndex-$lastIndex&fields=id,title,thumbnails,programType,:urlSlug,:youtubeTrailer,pubDate&lang=da");
  $resData = json_decode($res, true);
  
  // Define genre
  $tempGenre = new Genre();
  $tempGenre->Slug = $genre;
  $tempGenre->Name = ucfirst($genre);

  // Array of data to return
  $returnArr = [
    "genre" => $tempGenre,
    "movies" => [],
    "meta" => [
      "currentCount" => $resData["entryCount"],
      "totalCount" => $resData["totalResults"],
      "currentPage" => $page,
      "totalPages" => ceil($resData["totalResults"] / $per_page)
    ]
  ];

  // Loop through movies returned from request and add then to return array
  foreach ($resData["entries"] as $movie){
    $movieIdExploded = explode("/", $movie["id"]);
    $movieId = end($movieIdExploded);

    $tempMovie = new Movie();

    $tempMovie->Id = $movieId;
    $tempMovie->Title = $movie['title'];
    $tempMovie->Thumbnail = @$movie['plprogram$thumbnails']['orig-396x272']['plprogram$url'] ?: '/img/poster/none.png';
    $tempMovie->Slug = @$movie['tdc$urlSlug'] ?: 'none';
    $tempMovie->YoutubeTrailer = @$movie['tdc$youtubeTrailer'] ?: 'none';

    array_push($returnArr["movies"], $tempMovie);
  }
    
  return $returnArr;
}