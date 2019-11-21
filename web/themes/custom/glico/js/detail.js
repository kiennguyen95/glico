(function ($) {

  $(document).ready(function ($) {

    $(".info-wrapper #btn-share").click(function() {
      FB.ui({
        method: 'share',
        href: window.location.href,
        hashtag: '#GlicoDance',
        quote: 'quote',
      }, function(response) {
        // if(response && response.post_id){
        //
        // }
        // else{}
        // if (typeof response !== 'undefined') {
        //   alert('Thanks for sharing');
        // }
      });
    });
  });

}(jQuery));
