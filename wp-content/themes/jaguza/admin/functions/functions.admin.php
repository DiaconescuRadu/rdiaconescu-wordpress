<?php
/**
 * SMOF Admin
 *
 * @package     WordPress
 * @subpackage  SMOF
 * @since       1.4.0
 * @author      Syamil MJ
 */
 

/**
 * Head Hook
 *
 * @since 1.0.0
 */
function jaguza_of_head() { do_action( 'jaguza_of_head' ); }

/**
 * Add default options upon activation else DB does not exist
 *
 * @since 1.0.0
 */
function jaguza_of_option_setup()	
{
	global $jaguza_of_options, $jaguza_options_machine;
	$jaguza_options_machine = new jaguza_Options_Machine($jaguza_of_options);
		
	if (!get_option(Jaguza_OPTIONS))
	{
		update_option(Jaguza_OPTIONS,$jaguza_options_machine->Defaults);
	}
	
	/*Re-direct to Jaguza options page on theme activation*/
	wp_redirect('admin.php?page='.Jaguza_ADMIN_OPTIONS_MENU_SLUG.'&activated=true&themeaction=activated');
}

/**
 * Change activation message
 *
 * @since 1.0.0
 */
function jaguza_optionsframework_admin_message() { 
	
	//Tweaked the message on theme activate
	?>
    <script type="text/javascript">
    jQuery(function(){
    	
        var message = '<p>This theme comes with an <a href="<?php echo admin_url('admin.php?page='.Jaguza_ADMIN_OPTIONS_MENU_SLUG); ?>">options panel</a> to configure settings. This theme also supports widgets, please visit the <a href="<?php echo admin_url('widgets.php'); ?>">widgets settings page</a> to configure them.</p>';
    	jQuery('.themes-php #message2').html(message);
    
    });
    </script>
    <?php
	
}

/**
 * Get header classes
 *
 * @since 1.0.0
 */
function jaguza_of_get_header_classes_array()  
{
	global $jaguza_of_options;
	
	foreach ($jaguza_of_options as $value) 
	{
		if ($value['type'] == 'heading')
			$hooks[] = str_replace(' ','',strtolower($value['name']));	
	}
	
	return $hooks;
}


/**
 * For use in themes
 *
 * @since forever
 */
$jaguza_data = get_option(Jaguza_OPTIONS);