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

  let $backDrop = $('.backdrop-image').data("backdrop");
  if($backDrop != null){
    $('.backdrop-image')
     .css('background-image', 'linear-gradient(to bottom, rgba(255,255,255,0) -400%, var(--bs-body-bg)), url("' + $backDrop + '")');
  }
});