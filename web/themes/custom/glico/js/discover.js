(function ($) {

  $(document).ready(function ($) {
    setBtnCommand();
  });

  function setBtnCommand() {
    $('#btn-myvideo').click(function () {
      $('select[name="uid-current"] option:selected').removeAttr('selected');
      $('select[name="uid-current"] option:nth-child(2)').attr('selected','selected');
      // $('.views-exposed-form .form-actions .form-submit').click();
    });
    $('#btn-newvideo').click(function () {
      $('select[name="uid-current"] option:selected').removeAttr('selected');
      $('select[name="uid-current"] option:nth-child(1)').attr('selected','selected');
      // $('.views-exposed-form .form-actions .form-submit').click();
    });
  };
}(jQuery));
