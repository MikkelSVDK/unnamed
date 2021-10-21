$(() => {
  updateNavbarColor = () => {
    var height = $(document).scrollTop();
    if(height > 0)
      $(".navbar").addClass('navbar-scroll');
    else
      $(".navbar").removeClass('navbar-scroll');
  }

  updateNavbarColor();
  $(document).scroll(updateNavbarColor);
});