<?php
// Include core functions and models
require("includes/functions/core.php");

// Check if movie ID is included
if(empty($_GET["q"])){
  header("Location: /");
  die();
}

// Create movie class from ID
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
          <h1>
            <button id="fav-button" class="favorite-button <?= in_array($_GET["q"], $_SESSION["FavoriteMovies"]) ? 'fav' : 'not-fav' ?>"><i class="fas fa-heart"></i></button>
            <?= $movie->Title ?>
          </h1>
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
// Loops movies genres and displays them as a string
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
          <?php if($movie->YoutubeTrailer != 'none'): // Check if movie has a youtube video ?>
          <div class="youtube-box">
            <iframe class="youtube" width="100%" height="auto" src="https://www.youtube.com/embed/<?= $movie->YoutubeTrailer ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
          <br><br>
          <?php endif; // End of youtube check ?>
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
// Loops movies directors and displays them as a string
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
// Loops movies actors and displays them as a string
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
  <script src="/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/5cf283aa4d.js" crossorigin="anonymous"></script>
  <script src="/js/custom.js"></script>
  <script>
    const hoverEvent = e => {
      if(e.type == 'mouseenter')
        $('#fav-button').html('<i class="fas fa-heart-broken"></i>')
      else
        $('#fav-button').html('<i class="fas fa-heart"></i>')
    }

    let favBtn = $('#fav-button');
    $('#fav-button.fav').hover(hoverEvent);
    
    favBtn.click(() => {
      if(favBtn.hasClass("not-fav")){
        favBtn.removeClass("not-fav").addClass("fav")
        favBtn.hover(hoverEvent);

        $.get(`/actions/favorite/add?movie=<?= $_GET["q"] ?>`);
      }else{
        favBtn.removeClass("fav").addClass("not-fav")
        favBtn.off('mouseenter mouseleave');

        favBtn.hover(e => {
          if(e.type == 'mouseenter')
            $('#fav-button').html('<i class="fas fa-heart"></i>')
          else
            $('#fav-button').html('<i class="fas fa-heart-broken"></i>')
        });

        $.get(`/actions/favorite/remove?movie=<?= $_GET["q"] ?>`);
      }
    });
  </script>
</html>