<?php
require("includes/functions/core.php");

if(empty($_GET["q"])){
  header("Location: /");
  die();
}

$genreMovieList = listGenreMovies($_GET["q"], @$_GET["page"] ?: 1);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Action Film & Serier - Unnamed</title>
<?php require("includes/head.php"); ?>
  </head>
  <body>
<?php require("includes/navbar.php") ?>
    <div class="container main">

      <h1>Action Film & Serier <span class="float-right"><?= $genreMovieList["meta"]["totalCount"] ?> titler</span></h1>
      <hr class="header-hr">
      <div class="row">
<?php foreach ($genreMovieList["movies"] as $movie) { ?>
        <div class="col-xl-2 col-md-3 col-sm-6 movie-poster">
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
</html>