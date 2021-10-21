<?php
/**
 * Genre
 * 
 * @package    Movie
 * @author     Mikkel <msv@mcskripts.net>
 */
class Movie {
  public int $Id;
  public string $Slug;
  public string $Title;
  public string $Thumbnail;
  public string $YoutubeTrailer;


  /** https://feed.entertainment.tv.theplatform.eu/f/jGxigC/all_movies_ml?form=json&byTags=genre:action&count=true&sort=:sortDate|desc&range=1-40&fields=id,guid,title,thumbnails,programType,:urlSlug,:youtubeTrailer,pubDate&lang=da
   * Constructer
   *
   * @param int $id  Id of the movie 
   * @return boolean
   */
  public function __construct(int $id = -1){
    if($id != -1){
      $movieRes = file_get_contents("https://feed.entertainment.tv.theplatform.eu/f/jGxigC/bb-all-pas/$id?form=json");
      $movieData = json_decode($movieRes, true);
    }
  }
}