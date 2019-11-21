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

    videoControl();

  });

  function videoControl() {
    var isPlay = 0;
    var isMute = 0;
    $('.video-control .btn-play').click(function(){
      if(isPlay == 0) {
        $('.field-video video').get(0).play();
        // Change pause image here
        // $('.video-control .btn-play').css("background-image", "url(/modules/custom/glico_submission/upload/btn-play-control.png)");
        isPlay = 1;
      } else {
        $('.field-video video').get(0).pause();
        // $('.video-control .btn-play').css("background-image", "url(/modules/custom/glico_submission/upload/btn-play-control.png)");
        isPlay = 0;
      }
    });

    $('.video-control .btn-mute').click(function(){
      if(isMute == 0) {
        $('.field-video video').get(0).muted=true;
        // Change mute image here
        // $('.video-control .btn-play').css("background-image", "url(/modules/custom/glico_submission/upload/btn-play-control.png)");
        isMute = 1;
      } else {
        $('.field-video video').get(0).muted=false;
        // $('.video-control .btn-play').css("background-image", "url(/modules/custom/glico_submission/upload/btn-mute-control.png)");
        isMute = 0;
      }
    });

  }

}(jQuery));
