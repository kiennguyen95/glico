(function ($) {

  $(document).ready(function ($) {
    // Hide page loader
    $(".loader").fadeOut("slow");
    $(".loader-bg").delay(500).fadeOut("slow");

    var getUrlParameter = function getUrlParameter(sParam) {
      var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

      for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
          return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
      }
    };

    if (getUrlParameter('redirect') === 'fb') {
      if ($(window).width() < 768) {
        $(".btn-join-sp").click();
      }
      else {
        $(".btn-join").click();
      }
    }

    // Play video in modal
    $(".js-video-button").click(function (e) {
      e.preventDefault();

      var theModal = $('#video-modal'),
          videoSRC = $(this).attr('data-video-url'),
          videoSRCauto = videoSRC + "";

      $('#video-modal source').attr('src', videoSRCauto);
      var video = $('#video-modal video').get(0);
      video.load();
      video.play();

      $(theModal).fadeIn('fast');
      $(theModal).click(function(){
        video.pause();
        $(this).fadeOut('fast');
      }).children().click(function(e) {
        return false;
      });
    });

    setTimeout(function () {
      $("#fb-messenger").fadeIn();
    }, 2000);

    // Tabs control
    $("#part-info ul.tabs li").click(function () {
      $(this).addClass("is-active");
      $(this).siblings("li").removeClass("is-active");
      $(this).closest("ul").siblings("div#" + $(this).attr("data-target")).show();
      $(this).closest("ul").siblings("div:not(#" + $(this).attr("data-target") + ")").hide();
    });

    // Pager control
    $("#section-winning-list .users .pager span").click(function () {
      $(this).addClass("is-active");
      $(this).siblings("span").removeClass("is-active");
      if ($(this).hasClass("pager-page-1")) {
        $("#section-winning-list .users table tr:nth-child(-n + 10)").show();
        $("#section-winning-list .users table tr:nth-child(n + 11)").hide();
      }
      else {
        $("#section-winning-list .users table tr:nth-child(-n + 10)").hide();
        $("#section-winning-list .users table tr:nth-child(n + 11)").show();
      }
    });

    $.fn.isInViewport = function() {
      var elementTop = $(this).offset().top;
      var elementBottom = elementTop + $(this).outerHeight();

      var viewportTop = $(window).scrollTop();
      var viewportBottom = viewportTop + $(window).height();

      return elementTop < viewportBottom;
    };


    $(".music-stream-1, .music-stream-2").css("width", $("#part-stage").width() + "px");
    setTimeout(function(){
      $(".music-stream-1-wrapper").css("width", "100%")
      ;}, 500);

    $(window).on('resize scroll', function() {
      if ($("#content-prizes .prize-2nd .details").isInViewport()) {
        $(".music-stream-2-wrapper").css("width", "100%");
      }

      if ($("#section-winning-list .view-frontpage-wrapper").isInViewport()) {
        $(".music-stream-3-wrapper").css("height", $(window).width() > 1770 ? "2600px" : "147vw");
      }
    });

    //disco light sparkle
    setInterval(sparkle, 100);
    var imageToggle = 1;

    function sparkle() {
      if (imageToggle === 1) {
        $('.disco-light-sparkle').hide();
        imageToggle = 0;
      } else {
        $('.disco-light-sparkle').show();
        imageToggle = 1;
      }
    };

    // confetti
    //canvas init
    var canvas = document.getElementById("canvas");
    var ctx = canvas.getContext("2d");

    //canvas dimensions
    var W = $('#part-stage').width();
    var H = W * 0.33;
    var thick = W/100;

    if (W < 500) {
      thick = W/200;
    }

    canvas.width = W;
    canvas.height = H;
    $( window ).resize(function() {
      W = $('#part-stage').width();
      H = W * 0.33;
      canvas.width = W;
      canvas.height = H;

      $(".music-stream-1, .music-stream-2").css("width", W + "px");
    });

    //snowflake particles
    var mp = 150; //max particles
    var particles = [];
    for (var i = 0; i < mp; i++) {
      particles.push({
        x: Math.random() * W, //x-coordinate
        y: Math.random() * H, //y-coordinate
        r: Math.random() * thick + 1, //radius
        d: Math.random() * mp, //density
        color: "rgba(" + Math.floor((Math.random() * 255)) + ", " + Math.floor((Math.random() * 255)) + ", " + Math.floor((Math.random() * 255)) + ", 0.8)",
        tilt: Math.floor(Math.random() * 5) - 5
      });
    }

    //Lets draw the flakes
    function draw() {
      ctx.clearRect(0, 0, W, H);

      for (var i = 0; i < mp; i++) {
        var p = particles[i];
        ctx.beginPath();
        ctx.lineWidth = p.r;
        ctx.strokeStyle = p.color; // Green path
        ctx.moveTo(p.x, p.y);
        ctx.lineTo(p.x + p.tilt + p.r / 2, p.y + p.tilt);
        ctx.stroke(); // Draw it
      }
      update();
    }

    //Function to move the snowflakes
    //angle will be an ongoing incremental flag. Sin and Cos functions will be applied to it to create vertical and horizontal movements of the flakes
    var angle = 0;

    function update() {
      angle += 0.01;
      for (var i = 0; i < mp; i++) {
        var p = particles[i];
        //Updating X and Y coordinates
        //We will add 1 to the cos function to prevent negative values which will lead flakes to move upwards
        //Every particle has its own density which can be used to make the downward movement different for each flake
        //Lets make it more random by adding in the radius
        p.y += Math.cos(angle + p.d) + 1 + p.r / 2;
        p.x += Math.sin(angle) * 2;

        //Sending flakes back from the top when it exits
        //Lets make it a bit more organic and let flakes enter from the left and right also.
        if (p.x > W + 5 || p.x < -5 || p.y > H) {
          if (i % 3 > 0) //66.67% of the flakes
          {
            particles[i] = {
              x: Math.random() * W,
              y: -10,
              r: p.r,
              d: p.d,
              color: p.color,
              tilt: p.tilt
            };
          }
        }
      }
    };
    //animation loop
    setInterval(draw, 33);
    $('#part-stage #dancing-bear-1').addClass('add-dancing-bear-1');
    $('#part-stage #dancing-bear-2').addClass('add-dancing-bear-2');
    $('#part-stage .guitar-bear').addClass('add-dancing-guitar-bear');
    $('#part-stage #drum-bear').addClass('add-drum-bear');
    // $('#part-stage .music-stream-1').show();
    // $('#part-stage .music-stream-1').addClass('add-music-stream-1');
    $('#prize-jackpot-img, #prize-1st-img, #prize-2nd-img, #prize-3rd-img, #prize-weekly-img').hover(function () {
      $(this).addClass('add-prize-animate');
    });
    $('#prize-jackpot-img, #prize-1st-img, #prize-2nd-img, #prize-3rd-img, #prize-weekly-img').mouseout(function () {
      $(this).removeClass('add-prize-animate');
    });
    $('#content-prizes .prize-details').hover(function () {
      $(this).addClass('add-zoomin-animate');
    })
    $('#content-prizes .prize-details').mouseout(function () {
      $(this).removeClass('add-zoomin-animate');
    });
  });

}(jQuery));
