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
      $(".toggle-pick-frame").click(function () {
        $("div#pick-frame-wrapper-div").css("visibility", "visible");
      });
    }
  };

  Drupal.behaviors.pickFrame = {
    attach: function (context, settings) {
      $(".pick-frame-wrapper .pick-frame").click(function () {
        $(this).addClass("is-active");
        $(this).siblings(".pick-frame").removeClass("is-active");
        var frame = $(this).attr("data-frame-value");
        $('form.glico-submission-form input[name="frame"]').val(frame);
        $('#pick-frame-video').removeClass().addClass('field-video video-frame-' + frame);
      });
    }
  };

  Drupal.behaviors.submissionRedirect = {
    attach: function (context, settings) {
      console.log('2');
      $('button.submission-to-preview-btn').click(function () {
        // var nid = drupalSettings.variables.nid;
        console.log('asd');
        // window.location.href = url;
      });
    }
  }
})(jQuery, Drupal, drupalSettings);
