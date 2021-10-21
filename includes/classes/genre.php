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
  public function recommendedMovies(int $page = 1){
    // List 5 newest movies
    return [new Movie(1)];
  }
}