(function ($) {

  $(document).ready(function ($) {

    $(".info-wrapper #btn-share").click(function() {
      FB.ui({
        method: 'share',
        href: window.location.href,
        hashtag: '#GlicoDance',
        quote: 'quote',
      }, function(response){});
    });

    $('.video-control .btn-play').click(function(){
      $('.field-video video').get(0).play();
    });
  });

}(jQuery));
