(function ($) {

  $(document).ready(function ($) {
    $('#back-to-home-page').click(function () {
      $('#drupal-modal').fadeOUt();
    });

    var fileInput = $('form.glico-submission-form input[name="files[video_file]"]');
    fileInput.after('<label for="' + fileInput.attr('id') + '" class="submit-video">Chọn video để tải lên</label>');

    $(document).ajaxComplete(function () {
      var fileInput = $('form.glico-submission-form input[name="files[video_file]"]');
      fileInput.after('<label for="' + fileInput.attr('id') + '" class="submit-video">Chọn video để tải lên</label>');
      $('form.glico-submission-form .select-video-real input[name="video_file_remove_button"]').attr('value', 'Chọn lại');
    });

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

  });
}(jQuery));