<?php 
/**
 * SMOF Interface
 *
 * @package     WordPress
 * @subpackage  SMOF
 * @since       1.4.0
 * @author      Syamil MJ
 */
 
 
/**
 * Admin Init
 *
 * @uses wp_verify_nonce()
 * @uses header()
 * @uses update_option()
 *
 * @since 1.0.0
 */
function jaguza_optionsframework_admin_init() 
{
	// Rev up the Options Machine
	global $jaguza_of_options, $jaguza_options_machine;
	$jaguza_options_machine = new jaguza_Options_Machine($jaguza_of_options);
}

/**
 * Create Options page
 *
 * @uses add_theme_page()
 * @uses add_action()
 *
 * @since 1.0.0
 */
function jaguza_optionsframework_add_admin() {
	
   $jaguza_page = add_theme_page( Jaguza_THEMENAME, Jaguza_THEMENAME.' Options', 'edit_theme_options', Jaguza_ADMIN_OPTIONS_MENU_SLUG, 'jaguza_optionsframework_options_page');

	// Add framework functionaily to the head individually
	add_action("admin_print_scripts-$jaguza_page", 'jaguza_of_load_only');
	add_action("admin_print_styles-$jaguza_page",'jaguza_of_style_only');
	add_action( "admin_print_styles-$jaguza_page", 'jaguza_optionsframework_mlu_css', 0 );
	add_action( "admin_print_scripts-$jaguza_page", 'jaguza_optionsframework_mlu_js', 0 );	
	
}


/**
 * Build Options page
 *
 * @since 1.0.0
 */
function jaguza_optionsframework_options_page(){
	
	global $jaguza_options_machine;
	/*
	//for debugging
	$jaguza_data = get_option(Jaguza_OPTIONS);
	print_r($jaguza_data);
	*/	
	
	include_once( Jaguza_ADMIN_PATH . 'front-end/options.php' );

}

/**
 * Create Options page
 *
 * @uses wp_enqueue_style()
 *
 * @since 1.0.0
 */
function jaguza_of_style_only(){
	wp_enqueue_style('admin-style', Jaguza_ADMIN_DIR . 'assets/css/admin-style.css');
	wp_enqueue_style('color-picker', Jaguza_ADMIN_DIR . 'assets/css/colorpicker.css');
}	

/**
 * Create Options page
 *
 * @uses add_action()
 * @uses wp_enqueue_script()
 *
 * @since 1.0.0
 */
function jaguza_of_load_only() 
{
	add_action('admin_head', 'jaguza_of_admin_head');
	
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-input-mask', Jaguza_ADMIN_DIR .'assets/js/jquery.maskedinput-1.2.2.js', array( 'jquery' ));
	wp_enqueue_script('tipsy', Jaguza_ADMIN_DIR .'assets/js/jquery.tipsy.js', array( 'jquery' ));
	wp_enqueue_script('color-picker', Jaguza_ADMIN_DIR .'assets/js/colorpicker.js', array('jquery'));
	wp_enqueue_script('ajaxupload', Jaguza_ADMIN_DIR .'assets/js/ajaxupload.js', array('jquery'));
	wp_enqueue_script('cookie', Jaguza_ADMIN_DIR . 'assets/js/cookie.js', 'jquery');
	wp_enqueue_script('smof', Jaguza_ADMIN_DIR .'assets/js/smof.js', array( 'jquery' ));
}

/**
 * Front end inline jquery scripts
 *
 * @since 1.0.0
 */
function jaguza_of_admin_head() { ?>
		
	<script type="text/javascript" language="javascript">

	jQuery.noConflict();
	jQuery(document).ready(function($){
	
		// COLOR Picker			
		$('.colorSelector').each(function(){
			var Othis = this; //cache a copy of the this variable for use inside nested function
				
			$(this).ColorPicker({
					color: '<?php if(isset($color)) echo $color; ?>',
					onShow: function (colpkr) {
						$(colpkr).fadeIn(500);
						return false;
					},
					onHide: function (colpkr) {
						$(colpkr).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						$(Othis).children('div').css('backgroundColor', '#' + hex);
						$(Othis).next('input').attr('value','#' + hex);
						
					}
			});
				  
		}); //end color picker

	}); //end doc ready
	
	</script>
	
<?php }

/**
 * Ajax Save Options
 *
 * @uses get_option()
 * @uses update_option()
 *
 * @since 1.0.0
 */
function jaguza_of_ajax_callback() 
{
	global $jaguza_options_machine, $jaguza_of_options;

	$nonce=$_POST['security'];
	
	if (! wp_verify_nonce($nonce, 'of_ajax_nonce') ) die('-1'); 
			
	//get options array from db
	$all = get_option(Jaguza_OPTIONS);
	
	$save_type = $_POST['type'];
	
	//echo $_POST['data'];
	
	//Uploads
	if($save_type == 'upload')
	{
		
		$clickedID = $_POST['data']; // Acts as the name
		$filename = $_FILES[$clickedID];
       	$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']); 
		
		$override['test_form'] = false;
		$override['action'] = 'wp_handle_upload';    
		$uploaded_file = wp_handle_upload($filename,$override);
		 
			$upload_tracking[] = $clickedID;
				
			//update $options array w/ image URL			  
			$upload_image = $all; //preserve current data
			
			$upload_image[$clickedID] = $uploaded_file['url'];
			
			update_option(Jaguza_OPTIONS, $upload_image ) ;
		
				
		 if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; }	
		 else { echo $uploaded_file['url']; } // Is the Response
		 
	}
	elseif($save_type == 'image_reset')
	{
			
			$id = $_POST['data']; // Acts as the name
			
			$delete_image = $all; //preserve rest of data
			$delete_image[$id] = ''; //update array key with empty value	 
			update_option(Jaguza_OPTIONS, $delete_image ) ;
	
	}
	elseif($save_type == 'backup_options')
	{
			
		$backup = $all;
		$backup['backup_log'] = date('r');
		
		update_option(Jaguza_BACKUPS, $backup ) ;
			
		die('1'); 
	}
	elseif($save_type == 'restore_options')
	{
			
		$jaguza_data = get_option(Jaguza_BACKUPS);
		
		update_option(Jaguza_OPTIONS, $jaguza_data);
		
		die('1'); 
	}
	elseif($save_type == 'import_options'){ 
			
		$jaguza_data = $_POST['data'];
		$jaguza_data = unserialize(base64_decode($jaguza_data)); //100% safe - ignore theme check nag
		update_option(Jaguza_OPTIONS, $jaguza_data); 
		
		die('1'); 
	}
	elseif ($save_type == 'save')
	{
		wp_parse_str(stripslashes($_POST['data']), $jaguza_data);
		unset($jaguza_data['security']);
		unset($jaguza_data['of_save']);
		update_option(Jaguza_OPTIONS, $jaguza_data);  
		jaguza_generate_options_css($jaguza_data,$jaguza_options_machine->Defaults);/*Generate static css file*/
		die('1');
	}
	elseif ($save_type == 'reset')
	{
		update_option(Jaguza_OPTIONS,$jaguza_options_machine->Defaults);
		jaguza_generate_options_css(Jaguza_OPTIONS,$jaguza_options_machine->Defaults,true);/*Clean out the static css file*/
        die('1'); //options reset
	}

  	die();
}