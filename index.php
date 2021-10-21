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
      <h3 class="genre-title"><?= $genre->MovieCount ?> x <?= $genre->Name ?> film <span class="float-right"><a href="/genre.php?q=<?= $genre->Slug ?>" class="btn btn-primary btn-sm">Se alle</a></span></h3>
      <hr class="header-hr">
      <div class="row">
<?php
$genreMovieRecommended = $genre->recommendedMovies();
foreach ($genreMovieRecommended as $movie) {
?>
        <div class="col-xl-2 col-md-3 col-sm-6 movie-poster">
          <a href="#">
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAL0AAAELCAMAAAC77XfeAAAAeFBMVEX///8AAAD5+fkKAAASCw1kYmPQ0NBAPT6ysbFgXl50c3QNBAciHh/h4eHz8/MXERPp6el+fX3AwMAgGx0VDxCioaGBf4CHhYYpJSZVU1Q1MjMcFxjV1dWPjo8vLC05NjdLSEnIx8enpqZramqVlJRHRUa6ubmamZknV3S1AAACsElEQVR4nO3W646qMBSG4S5OIpWjKDiMB9TB+7/D3RYYnT3J/ofJTt4nUWrpkI+y2kEpAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMD/yvNeD0VV9dnLOWv+EVVVOrXTqoqeA9yYX613hI9EGhtHxITO1mId55Ot+9nubDvWtr2y+bODbZ4iVcgsi+eWUoexce7fkX4jhU0fZMr7COSQnLSU08lV1wVacrkqdZVgm6wl12bwQQe3pMulKEQH240dk8X+NtCGSR/mpkdLZ6+7fPo6nNLfRex8NVo+p/T+3RTCIf9QmeRmlErzIDQzHthcm/EZhb6711hO8yVDPzHfn1o/3pD+9CHRmP6kG9c3H036owvWmY+45XD1xUultvWT9m4VrF3W3+nVl39USzPpezm79J6IW4qq1JfX9GXQqkbWrsesj08VdHLYTY/nmb4tjaQy6fXNrNxKy/KFH8lWrSU21ZCZNTjuKQ9/NaXPL/tyrXWibuIyKs8WVyXiiwTHH+n9rVurd1v3uW3lu8XDu/SpbOzcZzLVe+N/Tem3tds9MlVK6HoK93y8oWyllv1remkrK3Wr1vxRkDfvSW/rojN1H/jjdF10MqWvwyGO7S3t/I3rMdNeKLeVF0kuP9L/VfcP/ZY9x6T3dLcx6ZNgk40Jhyn998JLZbyzVb1Sg7g76eWf6dP5SS6e3uzmNn0heburGqmnsn9JrxKRZIjPuSn7TOpLPOzaMfazcvZWkr43vZvBs9sRo/G/5Gp+VzjJs3bD8Vys3MN5DjvIbUw/6aeebBy7rGyo7MG8uNhqzq5l2VTfJ/vqZfr6piwfYynbYfthHhNNF3CGQkVjj3ljWjw9AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAGAhfwBsRCAyp/C2ZwAAAABJRU5ErkJggg==" alt="movie poster" class="img-fluid" />
          </a>
          <p class="text-center">Hello, World</p>
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