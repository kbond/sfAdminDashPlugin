(function($) {
  
  $(document).ready(function() {
    
    if ($('#sf_admin_bar').size()) {
      $('.sf_admin_list').css('margin-right', $('#sf_admin_bar').width() + 25);
      
      //add filter header
      $('#sf_admin_bar table tbody').before("<thead><tr><th colspan='2'>" + $('#sf_admin_dash_hidden_filters_translation').html() + "</th></tr></thead>");
    }
    
    $('#sf_admin_menu li.node').hover(
      function() {
        $('ul', this).css('display', 'block');
        $(this).addClass('nodehover');
      },
      function() {
        $('ul', this).css('display', 'none');
        $(this).removeClass('nodehover');
      }
    );

    $('li.node a[href=#]').live('click', function(e) {
      e.preventDefault();
    });
    
  });
})(jQuery)