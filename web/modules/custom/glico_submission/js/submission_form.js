(function ($) {

  $(document).ready(function ($) {

    var fileInput = $('form.glico-submission-form input[name="files[video_file]"]');
    fileInput.after('<label for="' + fileInput.attr('id') + '" class="submit-video">Chọn video để tải lên</label>');

    $(document).ajaxComplete(function () {
      var fileInput = $('form.glico-submission-form input[name="files[video_file]"]');
      fileInput.after('<label for="' + fileInput.attr('id') + '" class="submit-video">Chọn video để tải lên</label>');
      $('form.glico-submission-form .select-video-real input[name="video_file_remove_button"]').attr('value', 'Chọn lại');
    });

  });
}(jQuery));

(function ($, Drupal, drupalSettings) {
  Drupal.behaviors.backHome = {
    attach: function (context, settings) {
      $('#back-to-home-page').click(function () {
        $('#drupal-modal').remove();
      });
    }
  };

  Drupal.behaviors.toggleFrames = {
    attach: function (context, settings) {
      $(".toggle-pick-frame", context).once('toggleFrames').click(function () {
        if ($(window).width() < 768) {
          $("body .ui-dialog.ui-widget.ui-widget-content").css("height", "535px");
          $("body .ui-dialog.ui-widget.ui-widget-content").css("top", "100px");
        }
        else {
          var curTop = $("body .ui-dialog.ui-widget.ui-widget-content").css("top").match(/(\d+)/)[0];
          curTop = curTop - 100;
          $("body .ui-dialog.ui-widget.ui-widget-content").css("height", "650px");
          $("body .ui-dialog.ui-widget.ui-widget-content").css("top", curTop + "px");
        }
        $("div#pick-frame-wrapper-div").css("visibility", "visible");
      });
    }
  };

  Drupal.behaviors.pickFrame = {
    attach: function (context, settings) {
      $(".pick-frame-wrapper .pick-frame").click(function () {
        if (!$(this).children(".pick-frame-text").hasClass("pick-frame-text-4")) {
          $(this).children(".pick-frame-text").html("đã chọn");
        }
        $(this).siblings(".pick-frame").children(".pick-frame-text:not(.pick-frame-text-4)").html("chọn");
        var frame = $(this).attr("data-frame-value");
        $('form.glico-submission-form input[name="frame"]').val(frame);
        $('#pick-frame-video').removeClass().addClass('field-video video-frame-' + frame);
      });
    }
  };

  Drupal.behaviors.submissionRedirect = {
    attach: function (context, settings) {
      // console.log('2');
      $('button.submission-to-preview-btn').click(function () {
        // var nid = drupalSettings.variables.nid;
        console.log('asd');
        // window.location.href = url;
      });
    }
  }
})(jQuery, Drupal, drupalSettings);
