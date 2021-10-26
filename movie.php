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
        <div class="col-lg-4" style="margin-bottom:10px">
          <b class="movie-highlight"> 
            Længde: <?= gmdate("H\h i\m", $movie->Runtime) ?>
          </b> 
        </div>
        <div class="col-lg-4">
          <b class="movie-highlight"> 
            Genre: 
<?php
$i = 0;
foreach ($movie->Genres as $key => $genre) {
  if($i > 0)
    echo ", ";
  echo $genre['plprogram$title'];
  $i++;
}
?>
          </b> 
        </div>
        <div class="col-lg-4">
          <b class="movie-highlight">
            Udgivelse: <?= date("d. M Y", strtotime($movie->ReleaseDate)) ?>
          </b> 
        </div>
      </div>

      <div class="row">
        <div class="col-lg-3">
          <img class="img-fluid" src="<?= $movie->Poster ?>" alt="movie poster">
        </div>
        <div class="col-lg-9">
          <?php if($movie->YoutubeTrailer != 'none'): ?>
          <div class="youtube-box">
            <iframe class="youtube" width="100%" height="auto" src="https://www.youtube.com/embed/<?= $movie->YoutubeTrailer ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
          <br><br>
          <?php endif; ?>
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
            <b class="movie-highlight">
              Indstruktør:
<?php
$i = 0;
foreach ($movie->Directors as $director) {
  if($i > 0)
    echo ", ";
  echo $director['plprogram$personName'];
  $i++;
}
?>
            </b> 
          </b>
        </div>
        <div class="col-lg-8">
          <b>
            <b class="movie-highlight">
              Stjerner: 
<?php
$i = 0;
foreach ($movie->Actors as $key => $actor) {
  if($i > 0)
    echo ", ";
  echo $actor['plprogram$personName'];
  $i++;
}
?>
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