(function ($) {

  $(document).ready(function ($) {
    $(".info-wrapper .btn-share").click(function () {
      console.log("aa");
      console.log($(".fb-share-button"));
      $(".fb-share-button").click();
    });
  });

}(jQuery));