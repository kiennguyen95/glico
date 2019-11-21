(function ($) {

  $(document).ready(function ($) {
    setBtnCommand();
  });

  function setBtnCommand() {
    $('#btn-myvideo').click(function () {
      $('select[name="uid_current"]').val("1");
      $(this).addClass('is-active');
      $('#btn-newvideo').removeClass('is-active');
      $('.views-exposed-form .form-actions .form-submit').click();
    });
    $('#btn-newvideo').click(function () {
      $('select[name="uid_current"]').val("All");
      $(this).addClass('is-active');
      $('#btn-myvideo').removeClass('is-active');
      $('.views-exposed-form .form-actions .form-submit').click();
    });
  }
}(jQuery));
