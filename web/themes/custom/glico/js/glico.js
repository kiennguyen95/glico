(function ($) {

  $(document).ready(function ($) {
    var ua = navigator.userAgent;
    var iPhone = ua.indexOf('iPhone') > 0;

    if (iPhone) {
      $('body').addClass('on-iphone');
    }

    // Hamburger menu control
    $("#btn-hamburger").click(function () {
      $(".header-menu-bg").show();
      $(".header-menu").slideDown();
    });

    $(".header-menu-bg, .header-menu li a").click(function () {
      if ($(window).width() <= 767) {
        $(".header-menu-bg").hide();
        $(".header-menu").slideUp();
      }
    });
  });

}(jQuery));
