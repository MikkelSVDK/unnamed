<?php
// Include core functions and models
require("includes/functions/core.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Favoritter - Unnamed</title>
<?php require("includes/head.php"); ?>
  </head>
  <body>
<?php require("includes/navbar.php") ?>
    <div class="container main">

      <h1>Dine favoritter</h1>
      <div class="row">
<?php
//
if(count($_SESSION["FavoriteMovies"]) > 0){

  // Loop all movies from SESSION
  foreach ($_SESSION["FavoriteMovies"] as $movieId) {

    // Get movie data
    $movie = new Movie($movieId);
?>
        <div class="col-xl-2 col-md-4 col-sm-6 movie-poster">
          <button data-movie-id="<?= $movie->Id ?>" class="remove-favorite">✕</button>
          <a href="/movie/<?= $movie->Id ?>">
            <img src="<?= $movie->Thumbnail ?>" alt="movie poster" class="img-fluid" />
          </a>
          <p class="text-center"><?= $movie->Title ?></p>
        </div>
<?php
  } // End movie loop
}else{ // Display info message
?>
        <div class="col-12" style="margin:10vh 0">
          <h2 class="text-center">Du har ikke tilføjet nogle film til dine favoritter</h2>
        </div>
<?php
}
?>
      </div>
    </div>
<?php require("includes/footer.php") ?>
  </body>
  <script src="/js/jquery.min.js"></script>
  <script src="/js/custom.js"></script>
  <script>
    $('.remove-favorite').click(e => {
      let removeBtn = $(e.target)

      let rowDiv = removeBtn.parent().parent();
      if(rowDiv.children().length == 1)
        rowDiv.append($('<div>', { class: 'col-12', style: 'margin:10vh 0' })
         .append($('<h2>', { class: 'text-center', html: 'Du har ikke tilføjet nogle film til dine favoritter' })))

      $.get(`/actions/favorite/remove?movie=${removeBtn.data("movieId")}`);
      removeBtn.parent().remove()
    });
  </script>
</html>