<?php 
/**
 * Jaguza admin functions and definitions.
 *
 * Sets up the theme admin functions and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.




/**
 * Jaguza Definitions
 */
define( 'Jaguza_ADMIN_OPTIONS_MENU_SLUG', "Jaguza-theme-options");/*Used to refer to the Jaguza options page*/
define('Jaguza_THEME_SLUG',"jaguza");

/** 
 * Loads the Admin Options Panel
 */
require_once get_stylesheet_directory() . '/admin/index.php';


/**
 * Dynamically generate new CSS file on user submission of data.
 * This eliminates resource-intensive DB queries at the front-end
 * as users access the site
 */

function jaguza_generate_options_css($newdata,$defaults,$reset=false) {

if(!$reset):
	/** Define some vars **/
	$jaguza_data = $newdata; 
	/*Clean up the $newdata to leave only the values the user has changed. We compare the CSS-affecting values against the defaults*/
	$cssAffectingIDsArray = array("jaguza_sidebar_position","jaguza_logo_left_margin","jaguza_logo_top_margin","jaguza_logo_bottom_margin","jaguza_social_icons_position","jaguza_link_color","jaguza_theme_color","jaguza_theme_color_custom","jaguza_slider_item_img_FullWidth"); 
	foreach($cssAffectingIDsArray as $cssItem):
		if($jaguza_data[$cssItem] == $defaults[$cssItem])
		unset($jaguza_data[$cssItem]);
	endforeach;
	/*Clean up the font arrays to leave only the ones the user has made changes to*/
	$fontIDs = array("jaguza_body_typography","jaguza_menu_typography","jaguza_breadcrumbs_typography","jaguza_footer_typography","jaguza_headings_typography","jaguza_headings_font_size_h1","jaguza_headings_font_size_h2","jaguza_headings_font_size_h3","jaguza_headings_font_size_h4","jaguza_headings_font_size_h5","jaguza_headings_font_size_h6");
	foreach($fontIDs as $fontID):
		$fontProperties = array("size","face","style","color");
		foreach($fontProperties as $fontProperty):
		if(isset($jaguza_data[$fontID][$fontProperty]) && ($jaguza_data[$fontID][$fontProperty] == $defaults[$fontID][$fontProperty]))
		unset($jaguza_data[$fontID][$fontProperty]);		
		endforeach;
	endforeach;
endif;
	$uploads = wp_upload_dir();
	$css_dir = get_stylesheet_directory() . '/css/'; /*Shorten code, save 1 call*/
	
	/** Save in different directory if on multisite **/
	if(is_multisite()) {
		$aq_uploads_dir = trailingslashit($uploads['basedir']);
	} else {
		$aq_uploads_dir = $css_dir;
	}
	
	/** Capture CSS output **/
	ob_start();
	require($css_dir . 'styles.php');
	$css = ob_get_clean();
	if($reset) /*If it is a reset, clean out the file*/
		$css = "";
	
	/** Write to options.css file **/
	WP_Filesystem();
	global $wp_filesystem;
	if ( ! $wp_filesystem->put_contents( $aq_uploads_dir . 'jaguza.options.css', $css, 0644) ) {
	    return true;
	}
	
}
?>