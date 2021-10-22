<?php
require("includes/functions/core.php");

if(empty($_GET["q"])){
  header("Location: /");
  die();
}

$movie = new Movie($_GET["q"]);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Unnamed - Find din næste film her</title>
<?php require("includes/head.php"); ?>
  </head>
  <body>
<?php require("includes/navbar.php") ?>

    <div class="backdrop-image" data-backdrop="<?= $movie->BackDrop ?>"></div>

    <div class="container main">

      <div class="row movie-preview">
        <div class="col-lg-12">
          <h1><?= $movie->Title ?></h1>
        </div>
        <div class="col-lg-3" style="margin-bottom:10px">
          <b>
            <b style="color:#ff527f">
              IMDb Vurdering: 1
            </b>
          </b>
        </div>
        <div class="col-lg-3">
          <b>
            <b style="color:#ff527f"> 
              Længde: 1
            </b> 
          </b>
        </div>
        <div class="col-lg-3">
          <b>
            <b style="color:#ff527f"> 
              Genre: 1
            </b> 
          </b>
        </div>
        <div class="col-lg-3">
          <b>
            <b style="color:#ff527f">
              Udgivelse: 1
            </b> 
          </b>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-3">
          <img class="img-fluid" src="<?= $movie->Poster ?>" alt="movie poster">
        </div>
        <div class="col-lg-9">
          <?= $movie->YoutubeTrailer ?>
          <br><br>
          <h3>
            <b>Beskrivelse</b>
          </h3>
          <p>
            <?= $movie->Description ?>
          </p>
        </div>
      </div>

      <div class="row" style="margin-top: 10px">
        <div class="col-lg-4">
          <b>
            <b style="color:#ff527f">
              Indstruktør: 0
            </b> 
          </b>
        </div>
        <div class="col-lg-4">
          <b>
            <b style="color:#ff527f">
              Sriver: 0
            </b> 
          </b>
        </div>
        <div class="col-lg-4">
          <b>
            <b style="color:#ff527f">
              Stjerner: 0
            </b> 
          </b>
        </div>
      </div>
    
    </div>
<?php require("includes/footer.php") ?>
  </body>
  <script src="/js/jquery.min.js"></script>
  <script src="/js/custom.js"></script>
</html>