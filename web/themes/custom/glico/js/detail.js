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
      },500);
    }, false);

    setFullscreen();

    // vid.addEventListener('timeupdate', function() {
    //   currentPos = vid.currentTime; //get currentime
    //   maxduration = vid.duration; //get video duration
    //   percentage = (100 * currentPos / maxduration)+'%';
    //   if(percentage === 'NaN%') {
    //     percentage= '0%';
    //   }
    //   // current.text(currentPos);
    //   // time.css('width', percentage);
    //   // $('.trythis').text('im working');
    //
    //   console.log('currentPos: '+ currentPos);
    //   console.log('percentage: '+ percentage);
    // });
  });

  function videoControl() {
    var isPlay = 0;
    var isMute = 0;
    $('.video-control .btn-play').click(function(){
      if(isPlay == 0) {
        $('.field-video video').get(0).play();
        // Change pause image here
        $('.video-control .btn-play').css("background-image", "url(/modules/custom/glico_submission/upload/btn-pause.png)");
        isPlay = 1;
      } else {
        $('.field-video video').get(0).pause();
        $('.video-control .btn-play').css("background-image", "url(/modules/custom/glico_submission/upload/btn-play.png)");
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
  }

}(jQuery));
