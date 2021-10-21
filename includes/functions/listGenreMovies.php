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
  $firstIndex = (($page - 1) * $per_page) + 1;
  $lastIndex = (($page - 1) * $per_page) + $per_page;

  $res = file_get_contents("https://feed.entertainment.tv.theplatform.eu/f/jGxigC/bb-all-pas?form=json&byTags=genre:$genre&count=true&sort=:sortDate|desc&range=$firstIndex-$lastIndex&fields=id,title,thumbnails,programType,:urlSlug,:youtubeTrailer,pubDate&lang=da");
  $resData = json_decode($res, true);
  // $movie['plprogram$programType'];

  $returnArr = [
    "movies" => [],
    "meta" => [
      "currentCount" => $resData["entryCount"],
      "totalCount" => $resData["totalResults"],
      "currentPage" => $page,
      "totalPages" => ceil($resData["totalResults"] / $per_page)
    ]
  ];

  foreach ($resData["entries"] as $movie){
    $movieIdExploded = explode("/", $movie["id"]);
    $movieId = end($movieIdExploded);

    $tempMovie = new Movie();

    $tempMovie->Id = $movieId;
    $tempMovie->Title = $movie['title'];
    $tempMovie->Thumbnail = $movie['plprogram$thumbnails']['orig-396x272']['plprogram$url'];
    $tempMovie->Slug = $movie['tdc$urlSlug'];
    $tempMovie->YoutubeTrailer = $movie['tdc$youtubeTrailer'];

    array_push($returnArr["movies"], $tempMovie);
  }
    

  return $returnArr;
}