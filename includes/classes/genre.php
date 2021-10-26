<?php
/**
 * Genre
 * 
 * @package    Movie
 * @subpackage Genre
 * @author     Mikkel <msv@mcskripts.net>
 */
class Genre extends Movie {
  public int $Id;
  public string $Slug;
  public string $Name;
  public int $MovieCount;

  /**
   * Constructer
   *
   * @param int $id  Id of the genre
   * @return boolean
   */
  public function __construct(int $id = -1){
    if($id != -1){
      $this->Id = $id;
      $this->Slug = 'genre-' . strval($id);
      $this->Name = "Genre " . strval($id);
      $this->MovieCount = 0;
    }
  }

  /**
   * Recommended Movies
   *
   * @param int $page  Page number if you wish to load more movies
   * @return array 
   */
  public function recommendedMovies(int $page = 1, int $per_page = 6){
    $firstIndex = (($page - 1) * $per_page) + 1;
    $lastIndex = (($page - 1) * $per_page) + $per_page;

    $res = file_get_contents("https://feed.entertainment.tv.theplatform.eu/f/jGxigC/bb-all-pas?form=json&byTags=genre:" . $this->Slug . "&q=(estProductAvailability%3A\"available\"%20OR%20tvodProductAvailability%3A\"available\")&count=true&sort=:sortDate|desc&range=$firstIndex-$lastIndex&fields=id,title,thumbnails,programType,:urlSlug,:youtubeTrailer,pubDate&lang=da");
    $resData = json_decode($res, true);
    // $movie['plprogram$programType'];

    $returnArr = [];

    foreach ($resData["entries"] as $movie){
      $movieIdExploded = explode("/", $movie["id"]);
      $movieId = end($movieIdExploded);

      $tempMovie = new Movie();

      $tempMovie->Id = $movieId;
      $tempMovie->Slug = @$movie['tdc$urlSlug'] ?: 'none';
      $tempMovie->Title = $movie['title'];
      $tempMovie->Thumbnail = count($movie['plprogram$thumbnails']) > 0 ? $movie['plprogram$thumbnails']['orig-396x272']['plprogram$url'] : '/img/poster/none.png';
      $tempMovie->YoutubeTrailer = $movie['tdc$youtubeTrailer'];

      array_push($returnArr, $tempMovie);
    }

    return $returnArr;
  }
}