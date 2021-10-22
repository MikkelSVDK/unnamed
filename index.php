<?php
require("includes/functions/core.php");

$genreList = listGenres();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Unnamed - Find din næste film her</title>
<?php require("includes/head.php"); ?>
  </head>
  <body>
<?php require("includes/navbar.php") ?>
    <div class="container main">

      <h1>Alle Genrerne</h1>
      <div class="row genre-selector">
<?php foreach ($genreList as $genre) { ?>
      <div class="col-lg-3">
        <div class="d-grid">
          <a href="#<?= $genre->Slug ?>" class="btn btn-lg btn-primary"><?= $genre->Name ?></a>
        </div>
      </div>
<?php } ?>
      </div>

<?php foreach ($genreList as $genre) { ?>
      <a id="<?= $genre->Slug ?>" style="padding-top:72px;color:transparent;"><?= $genre->Slug ?></a>
      <h3 class="genre-title"><?= $genre->MovieCount ?> x <?= $genre->Name ?> film <span class="float-right"><a href="/genre/<?= $genre->Slug ?>" class="btn btn-primary btn-sm">Se alle</a></span></h3>
      <hr class="header-hr">
      <div class="row">
<?php
$genreMovieRecommended = $genre->recommendedMovies();
foreach ($genreMovieRecommended as $movie) {
?>
        <div class="col-xl-2 col-md-3 col-sm-6 movie-poster">
          <a href="/movie/<?= $movie->Id ?>">
            <img src="<?= $movie->Thumbnail ?>" alt="movie poster" class="img-fluid" />
          </a>
          <p class="text-center"><?= $movie->Title ?></p>
        </div>
<?php } ?>
      </div>
<?php } ?>
      
    </div>
<?php require("includes/footer.php") ?>
  </body>
  <script src="/js/jquery.min.js"></script>
  <script src="/js/custom.js"></script>
</html>