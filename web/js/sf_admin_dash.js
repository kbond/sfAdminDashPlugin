//sfAdminThemePlugin javascript

var image_dir = '../images/sf_admin/';

//adjust table to fit filters if they exist
jQuery(function() {
  if (jQuery('#sf_admin_bar').size()) {
    var filter_width = jQuery('#sf_admin_bar').width() + 25;

    jQuery('.sf_admin_list').css('padding-right', filter_width);

    //add filter header
    jQuery('#sf_admin_bar table tbody').before("<thead><tr><th colspan='2'>Filters</th></tr></thead>");
  }
});

//if new button exists, edit it
/*jQuery(function() {
  if (jQuery('.sf_admin_action_new').size()) {
    jQuery('.sf_admin_action_new a').prepend("<img src='" + image_dir + "new_f2.png" + "' alt='New' /><br />");
  }
});*/

//menu
jQuery(function(){
		jQuery('li.node').hover(
			function() {
        jQuery('ul', this).css('display', 'block');
        jQuery(this).addClass('nodehover');
      },
			function() {
        jQuery('ul', this).css('display', 'none');
        jQuery(this).removeClass('nodehover');
      });

    jQuery('li.node a[href=#]').click(function() {
      return false;
    });
	});
