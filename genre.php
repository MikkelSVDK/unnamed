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
<?php
if($genreMovieList["meta"]["totalPages"] > 1):
  $startPage = max(1, $genreMovieList["meta"]["currentPage"] - 5);
  $endPage = min($genreMovieList["meta"]["currentPage"] + 6, $genreMovieList["meta"]["totalPages"]);
?>
      <ul class="pagination">
        <li class="page-item <?= $startPage == $genreMovieList["meta"]["currentPage"] ? 'disabled' : '' ?>">
          <a class="page-link" href="?page=<?= isset($_GET["page"]) ? $_GET["page"] - 1 : 1 ?>">&laquo;</a>
        </li>
<?php for($loopPage = $startPage; $loopPage <= $endPage; $loopPage++){ ?>
        <li class="page-item <?= $genreMovieList["meta"]["currentPage"] ==  $loopPage ? 'active' : '' ?>">
          <a class="page-link" href="?page=<?= $loopPage ?>"><?= $loopPage ?></a>
        </li>
<?php } ?>
        <li class="page-item <?= $endPage == $genreMovieList["meta"]["currentPage"] ? 'disabled' : '' ?>">
          <a class="page-link" href="?page=<?= isset($_GET["page"]) ? $_GET["page"] + 1 : 2 ?>">&raquo;</a>
        </li>
      </ul>
<?php endif; ?>
    </div>
<?php require("includes/footer.php") ?>
  </body>
  <script src="/js/jquery.min.js"></script>
  <script src="/js/custom.js"></script>
</html>