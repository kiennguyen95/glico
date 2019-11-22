(function ($, Drupal) {
  Drupal.behaviors.submissionForm = {
    attach: function (context, settings) {
      (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
      $('.fb-share-submission').click(function () {
        FB.ui({
          method: 'feed',
          link: settings.variables.link,
          caption: 'Test Caption',
          id: '748106385614500'
        }, function(response){
          if (typeof response === 'undefined') {
            $.ajax({
              type: "POST",
              url: "/glico_submission/delete",
              async: true,
            });
          }
        });
      });

      $("form.glico-submission-form #submit-video-submission").click(function () {
        $('form.glico-submission-form input[name="files[video_file]"]').click();
      });

      if($("form.glico-submission-form video").length) {
        $("form.glico-submission-form .submit-video").hide();
      }

      // Select frame
      $(".pick-frame-wrapper .pick-frame").click(function () {
        $(this).addClass("is-active");
        $(this).siblings(".pick-frame").removeClass("is-active");
        $('form.glico-submission-form input[name="frame"]').val($(this).attr("data-frame-value"));
      });
      console.log('checkmate');
      $(".btn-send-submission").click(function () {
        console.log("submit");
        $("button.submission-to-submit-btn.button").click();
      });

    }
  }
})(jQuery, Drupal);

(function ($) {

  $(document).ready(function ($) {

    $('.video-control .btn-play').click(function(){
      console.log("clicked");
      console.log($('.field-video video').get(0));
      $('.field-video video').get(0).play();
    });

    videoControl();

    var vid = $('.field-video video').get(0);
    vid.addEventListener('loadedmetadata', function() {
      // Set video current time/ duration time
      var durmins = Math.floor(vid.duration / 60);
      var dursecs = Math.floor(vid.duration - durmins * 60);
      if(dursecs < 10){ dursecs = "0"+dursecs; };
      if(durmins < 10){ durmins = "0"+durmins; };
      setInterval(function () {
        var curmins = Math.floor(vid.currentTime / 60);
        var cursecs = Math.floor(vid.currentTime - curmins * 60);
        if(cursecs < 10){ cursecs = "0"+cursecs; };
        if(curmins < 10){ curmins = "0"+curmins; };
        $('.video-control .text-time').text(curmins+":"+cursecs+" / "+durmins+":"+dursecs);
      },500);
    }, false);

    setFullscreen();

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
  };

  function setFullscreen() {
    $('.video-control .btn-fullscreen').click(function () {
      var vid = $('.field-video video').get(0);
      if (vid.requestFullscreen) {
        vid.requestFullscreen();
      } else if (vid.mozRequestFullScreen) { /* Firefox */
        vid.mozRequestFullScreen();
      } else if (vid.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
        vid.webkitRequestFullscreen();
      } else if (vid.msRequestFullscreen) { /* IE/Edge */
        vid.msRequestFullscreen();
      }
    });
  };

}(jQuery));
