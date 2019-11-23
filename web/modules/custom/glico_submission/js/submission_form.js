(function ($, Drupal) {
  Drupal.behaviors.submissionForm = {
    attach: function (context, settings) {
      FB.init({
        appId: '748106385614500',
        xfbml: true,
        version: 'v2.3'
      });
      (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
          return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/vi_VN/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
      $('.fb-share-submission').click(function () {
        FB.ui({
          method: 'feed',
          link: 'https://developers.facebook.com/docs/plugins/', //settings.variables.link
          hashtag: '#GlicoDance',
          id: '748106385614500',
          version: 'v2.3'
        }, function (response) {
          console.log(response);
          if (typeof response === 'undefined') {
            $.ajax({
              type: "POST",
              url: "/glico_submission/not-shared/submission",
              async: true,
            });
          } else {
            $.ajax({
              type: "POST",
              url: "/glico_submission/shared/submission",
              async: true,
              success: function (ajx_response) {
                var url = ajx_response[0].url;
                if (url !== null) {
                  window.location.href = url;
                }
              }
            });
          }
          $('#drupal-modal').remove();
        });
      });

      $('#back-to-home-page').click(function () {
        $('#drupal-modal').remove();
      });

      $("form.glico-submission-form #submit-video-submission").click(function () {
        $('form.glico-submission-form input[name="files[video_file]"]').click();
      });

      if ($("form.glico-submission-form video").length) {
        $("form.glico-submission-form .submit-video").hide();
      } else {
        $("form.glico-submission-form .submit-video").show();
      }

      // $('form.glico-submission-form .select-video-real input[value="Remove"]').click(function () {
      //   $("form.glico-submission-form .select-video-real").replaceWith('<div class="remove-ajax-loading">Loading</div>');
      // });

      // if($("form.glico-submission-form .select-video-real").length) {
      //   $("form.glico-submission-form .remove-ajax-loading").remove();
      // }


      // Select frame
      $(".pick-frame-wrapper .pick-frame").click(function () {
        $(this).addClass("is-active");
        $(this).siblings(".pick-frame").removeClass("is-active");
        var frame = $(this).attr("data-frame-value");
        $('form.glico-submission-form input[name="frame"]').val(frame);
        $('#pick-frame-video').removeClass().addClass('field-video video-frame-' + frame);
      });

      $(".toggle-pick-frame").click(function () {
        $("div#pick-frame-wrapper-div").css("visibility", "visible");
      });

      $(".btn-send-submission").click(function () {
        $(this).replaceWith('<div class="send-ajax-loading"></div>');
        $("button.submission-to-submit-btn.button").click();
      });

      $(".btn-share-fake").click(function () {
        $("button.fb-share-submission").click();
      });
    }
  }
})(jQuery, Drupal);
