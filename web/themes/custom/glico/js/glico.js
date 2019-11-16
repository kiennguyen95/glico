jQuery(document).ready(function($) {
  console.log('bb');
  $("#part-info ul.tabs li").click(function () {
    $(this).addClass("is-active");
    $(this).siblings("li").removeClass("is-active");
    $(this).closest("ul").siblings("div#" + $(this).attr("data-target")).show();
    $(this).closest("ul").siblings("div:not(#" + $(this).attr("data-target") + ")").hide();
  });
});