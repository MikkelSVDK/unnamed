<?php
// Include core functions and models
require("includes/functions/core.php");

// Function to get a list of genres
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
<?php
// Loops all genres and creates a button for each
foreach ($genreList as $genre) {
?>
      <div class="col-lg-3">
        <div class="d-grid">
          <a href="#<?= $genre->Slug ?>" class="btn btn-lg btn-primary"><?= $genre->Name ?></a>
        </div>
      </div>
<?php
} // End genre button loop
?>
      </div>

<?php
// Loops all genres and creates a category
foreach ($genreList as $genre) {
?>
      <a id="<?= $genre->Slug ?>" style="padding-top:72px;color:transparent;"><?= $genre->Slug ?></a>
      <h3 class="genre-title"><?= $genre->MovieCount ?> x <?= $genre->Name ?> film <span class="float-right"><a href="/genre/<?= $genre->Slug ?>" class="btn btn-primary btn-sm">Se alle</a></span></h3>
      <hr class="header-hr">
      <div class="row" id="row-<?= $genre->Slug ?>">
<?php
// Get 5 recommended movies from genre and displays them
$genreMovieRecommended = $genre->recommendedMovies();
foreach ($genreMovieRecommended as $movie) {
?>
        <div class="col-xl-2 col-md-4 col-sm-6 movie-poster">
          <a href="/movie/<?= $movie->Id ?>">
            <img src="<?= $movie->Thumbnail ?>" alt="movie poster" class="img-fluid" />
          </a>
          <p class="text-center"><?= $movie->Title ?></p>
        </div>
<?php
} // End of genre movie loop
?>
      </div>
      <div class="text-center">
        <button class="btn btn-primary load-more" data-genre="<?= $genre->Slug ?>">Indlæs flere</button>
      </div>
<?php
} // End genre category loop
?>
      
    </div>
<?php require("includes/footer.php") ?>
  </body>
  <script src="/js/jquery.min.js"></script>
  <script src="/js/custom.js"></script>
  <script>
    $('.load-more').each(function(i, val){
      let btn = $(val);
      btn.click(() => {
        if(btn.data('page') == null)
          btn.data('page', 2);
        else
          btn.data('page', btn.data('page') + 1);

        $.get(`/actions/recommended?genre=${btn.data('genre')}&page=${btn.data('page')}`, res => {
          res.data.forEach(movie => {
            $('#row-' + btn.data('genre'))
             .append($('<div>', { class: 'col-xl-2 col-md-4 col-sm-6 movie-poster' })
              .append($('<a>', { href: '/movie/' + movie.Id })
               .append($('<img>', { src: movie.Thumbnail, class: 'img-fluid' })))
              .append('<p>', { class: 'text-center', html: movie.Title }));
          });
        });
      })
    })
  </script>
</html>