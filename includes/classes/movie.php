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
  public string $Description;
  public float $Runtime;
  public string $ReleaseDate;
  public string $Thumbnail;
  public string $Poster;
  public string $BackDrop;
  public string $YoutubeTrailer;
  public array $Genres;
  public array $Directors;
  public array $Actors;


  /** https://feed.entertainment.tv.theplatform.eu/f/jGxigC/all_movies_ml?form=json&byTags=genre:action&count=true&sort=:sortDate|desc&range=1-40&fields=id,guid,title,thumbnails,programType,:urlSlug,:youtubeTrailer,pubDate&lang=da
   * Constructer
   *
   * @param int $id  Id of the movie 
   * @return boolean
   */
  public function __construct(int $id = -1){
    if($id != -1){
      $movieRes = file_get_contents("https://feed.entertainment.tv.theplatform.eu/f/jGxigC/bb-all-pas/$id?form=json&lang=da");
      $movieData = json_decode($movieRes, true);

      $movieIdExploded = explode("/", $movieData["id"]);
      $movieId = end($movieIdExploded);

      $movieBackDrop = '';
      foreach ($movieData['plprogram$thumbnails'] as $key => $value) {
        if($value['plprogram$assetTypes'][0] == "Backdrop"){
          $movieBackDrop = $value['plprogram$url'];
          break;
        }
      }

      $this->Id = $movieId;
      $this->Title = $movieData['title'];
      $this->Description = $movieData['plprogram$longDescription'];
      $this->Runtime = $movieData['plprogram$runtime'];
      $this->ReleaseDate = $movieData['plprogram$pubDate'];
      $this->Poster = @$movieData['plprogram$thumbnails']['orig-396x272']['plprogram$url'] ?: '/img/poster/none.png';
      $this->YoutubeTrailer = @$movieData['tdc$youtubeTrailer'] ?: 'none';
      $this->BackDrop = $movieBackDrop;

      $this->Genres = array_filter(
        $movieData['plprogram$tags'], 
        function($c){ 
          return $c['plprogram$scheme'] == "genre"; 
        }
      );

      $this->Directors = array_filter(
        $movieData['plprogram$credits'], 
        function($c){ 
          return $c['plprogram$creditType'] == "director"; 
        }
      );

      $this->Actors = array_filter(
        $movieData['plprogram$credits'], 
        function($c){
          return $c['plprogram$creditType'] == "actor"; 
        }
      );
    }
  }
}