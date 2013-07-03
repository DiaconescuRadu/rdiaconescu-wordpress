<?php
/*
Title		: SMOF
Description	: Slightly Modified Options Framework
Version		: 1.4.0
Author		: Syamil MJ
Author URI	: http://aquagraphite.com
License		: GPLv3 - http://www.gnu.org/copyleft/gpl.html
Credits		: Thematic Options Panel - http://wptheming.com/2010/11/thematic-options-panel-v2/
		 	  KIA Thematic Options Panel - https://github.com/helgatheviking/thematic-options-KIA
		 	  Woo Themes - http://woothemes.com/
		 	  Option Tree - http://wordpress.org/extend/plugins/option-tree/
*/

/**
 * Definitions
 *
 * @since 1.4.0
 */
$theme_version = '1.0.1';
$theme_name = 'Jaguza';
$theme_uri = 'http://themes.blueboltlimited.com/jaguza';
$author_uri = 'http://kakoma.ug/';


define( 'Jaguza_SMOF_VERSION', '1.4.0' );
define( 'Jaguza_ADMIN_PATH', get_stylesheet_directory() . '/admin/' );
define( 'Jaguza_ADMIN_DIR', get_stylesheet_directory_uri() . '/admin/' );
define( 'Jaguza_LAYOUT_PATH', Jaguza_ADMIN_PATH . '/layouts/' );
define( 'Jaguza_THEMENAME', $theme_name );
/* Theme version, uri, and the author uri are not completely necessary, but may be helpful in adding functionality */
define( 'Jaguza_THEMEVERSION', $theme_version );
define( 'Jaguza_THEMEURI', $theme_uri );
define( 'Jaguza_THEMEAUTHORURI', $author_uri );

define( 'Jaguza_OPTIONS', $theme_name.'_options' );
define( 'Jaguza_BACKUPS',$theme_name.'_backups' );

/**
 * Required action filters
 *
 * @uses add_action()
 *
 * @since 1.0.0
 */
if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) add_action('admin_head','jaguza_of_option_setup');
add_action('admin_head', 'jaguza_optionsframework_admin_message');
add_action('admin_init','jaguza_optionsframework_admin_init');
add_action('admin_menu', 'jaguza_optionsframework_add_admin');
add_action( 'init', 'jaguza_optionsframework_mlu_init');

/**
 * Required Files
 *
 * @since 1.0.0
 */ 
require_once ( Jaguza_ADMIN_PATH . 'functions/functions.load.php' );
require_once ( Jaguza_ADMIN_PATH . 'classes/class.options_machine.php' );

/**
 * AJAX Saving Options
 *
 * @since 1.0.0
 */
add_action('wp_ajax_of_ajax_post_action', 'jaguza_of_ajax_callback');

?>