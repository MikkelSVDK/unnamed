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
// Loop all movies from SESSION
foreach ($_SESSION["FavoriteMovies"] as $movieId) {

  // Get movie data
  $movie = new Movie($movieId);
?>
        <div class="col-xl-2 col-md-4 col-sm-6 movie-poster">
          <a href="/movie/<?= $movie->Id ?>">
            <img src="<?= $movie->Thumbnail ?>" alt="movie poster" class="img-fluid" />
          </a>
          <p class="text-center"><?= $movie->Title ?></p>
        </div>
<?php } ?>
      </div>
    </div>
<?php require("includes/footer.php") ?>
  </body>
  <script src="/js/jquery.min.js"></script>
  <script src="/js/custom.js"></script>
  <script>
  </script>
</html>