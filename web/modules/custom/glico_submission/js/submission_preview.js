(function ($) {

  $(document).ready(function ($) {

    function br2nl(str, replaceMode) {
      var replaceStr = (replaceMode) ? "\n" : '';
      // Includes <br>, <BR>, <br />, </br>
      if (typeof str != 'undefined') {
        return str.replace(/<\s*\/?br\s*[\/]?>/gi, replaceStr);
      }
      else {
        return str;
      }
    }

    window.fbAsyncInit = function() {
      FB.init({
        appId      : '748106385614500',
        xfbml      : true,
        version    : 'v2.3'
      });
    };

    (function(d, s, id){
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) {return;}
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/vi_VN/sdk.js";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    $('#btn-share-fb').click(function () {
      FB.ui({
        method: 'feed',
        link: $(this).attr("data-share-url"),
        // caption: 'Test Caption',
        hashtag: '#Glicodance_vudieutoandien',
        quote: br2nl($('.info-wrapper .caption > div').html(), true),
        id: '748106385614500'
      }, function (response) {
        if (typeof response !== 'undefined') {
          button = $("#btn-share-fb");
          button.siblings(".message-share").html("Gửi bài dự thi thành công!");
          button.replaceWith('<a href="/" class="btn-back">VỀ TRANG CHỦ</a>');

          $.ajax({
            type: "POST",
            url: "/submission/complete",
            async: true,
          });
        }
      });
    });

    $(".btn-send-submission span").click(function () {
      $(".share-modal-bg").fadeIn();
    });

    var isPlay = 0;
    var isMute = 0;

    function videoPlayToggle() {
      if(isPlay == 0) {
        $('.field-video .detail-field-thumbnail').fadeOut('fast');
        $('.field-video video').get(0).play();
        // Change pause image here
        $('.video-control .btn-play').css("background-image", "url(/modules/custom/glico_submission/upload/btn-pause.png)");
        isPlay = 1;
      } else {
        $('.field-video video').get(0).pause();
        $('.video-control .btn-play').css("background-image", "url(/modules/custom/glico_submission/upload/btn-play.png)");
        isPlay = 0;
      }
    }

    $('.field-video video, .video-control .btn-play, .field-video .detail-field-thumbnail').click(function(){
      videoPlayToggle();
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

    var durmins, dursecs, curmins, cursecs;
    var seekslider = $('#seekslider');
    var vid = $('.field-video video').get(0);

    seekslider.change(function () {
      var seekto = vid.duration * (seekslider.val()/ 100);
      vid.currentTime = seekto;
    });

    vid.addEventListener('loadedmetadata', function() {
      // Set video current time/ duration time
       durmins = Math.floor(vid.duration / 60);
       dursecs = Math.floor(vid.duration - durmins * 60);
      if(dursecs < 10){ dursecs = "0"+dursecs; };
      if(durmins < 10){ durmins = "0"+durmins; };
      setInterval(function () {
         curmins = Math.floor(vid.currentTime / 60);
         cursecs = Math.floor(vid.currentTime - curmins * 60);
        if(cursecs < 10){ cursecs = "0"+cursecs; };
        if(curmins < 10){ curmins = "0"+curmins; };
        $('.video-control .text-time').text(curmins+":"+cursecs+" / "+durmins+":"+dursecs);
        var nt = vid.currentTime * (100 / vid.duration);
        seekslider.val(nt);
      },100);
    }, false);

    setFullscreen();
  });

  function setFullscreen() {
    $('.video-control .btn-fullscreen').click(function () {
      var vid = $('.field-video video').get(0);
      // if (vid.requestFullscreen) {
      //   vid.requestFullscreen();
      // } else if (vid.mozRequestFullScreen) { /* Firefox */
      //   vid.mozRequestFullScreen();
      // } else if (vid.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
      //   vid.webkitRequestFullscreen();
      // } else if (vid.msRequestFullscreen) { /* IE/Edge */
      //   vid.msRequestFullscreen();
      // }
      if (vid.mozRequestFullScreen) { /* Firefox */
        vid.mozRequestFullScreen();
        document.addEventListener('fullscreenchange', (event) => {
          if (document.fullscreenElement) {
            $('.field-video video').attr('controls', true).addClass('no-border-radius');
          } else {
            $('.field-video video').attr('controls', false).removeClass('no-border-radius');
          }
        });
      }
      vid.webkitEnterFullscreen();
      vid.enterFullscreen();
    });
  }

}(jQuery));
