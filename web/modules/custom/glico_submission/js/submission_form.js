(function ($, Drupal) {
  Drupal.behaviors.submissionForm = {
    attach: function (context, settings) {
      (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
      $('.fb-share-submission').click(function () {
        FB.ui({
          method: 'feed',
          link: settings.variables.link,
          caption: 'Test Caption',
          id: '748106385614500'
        }, function(response){
          if (typeof response === 'undefined') {
            $.ajax({
              type: "POST",
              url: "/glico_submission/delete",
              async: true,
            });
          }
        });
      });
    }
  }
})(jQuery, Drupal);
