<?php
/**
 * Travelify defining constants, adding files and WordPress core functionality.
 *
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 700;


if ( ! function_exists( 'travelify_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 */
function travelify_setup() {
	/** 
	 * travelify_add_files hook
	 *
	 * Adding other addtional files if needed.
	 */
	do_action( 'travelify_add_files' );

	/** Load functions */
	require( get_template_directory() . '/library/functions/custom-header.php' );
	require( get_template_directory() . '/library/functions/functions.php' );
	
	/** Load WP backend related functions */
	require( get_template_directory() . '/library/panel/themeoptions-defaults.php' );
	require( get_template_directory() . '/library/panel/theme-options.php' );
	require( get_template_directory() . '/library/panel/metaboxes.php' );
	require( get_template_directory() . '/library/panel/show-post-id.php' );

	/** Load Shortcodes */
	require( get_template_directory() . '/library/functions/shortcodes.php' );

	/** Load Structure */
	require( get_template_directory() . '/library/structure/header-extensions.php' );
	require( get_template_directory() . '/library/structure/sidebar-extensions.php' );
	require( get_template_directory() . '/library/structure/footer-extensions.php' );
	require( get_template_directory() . '/library/structure/content-extensions.php' );

	/** 
	 * travelify_add_functionality hook
	 *
	 * Adding other addtional functionality if needed.
	 */
	do_action( 'travelify_add_functionality' );

	/* Travelify is now available for translation.
	 * Add your files into /languages/ directory.
	 * @see http://codex.wordpress.org/Function_Reference/load_theme_textdomain
	 */
	load_theme_textdomain( 'travelify', get_template_directory() . '/languages' );
	
	$locale = get_locale();
    $locale_file = get_template_directory().'/languages/$locale.php';
    if (is_readable( $locale_file))
		require_once( $locale_file);	

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page.
	add_theme_support( 'post-thumbnails' ); 
 
	// This theme uses wp_nav_menu() in header menu location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'travelify' ) );

	// Add Travelify custom image sizes
	add_image_size( 'featured', 670, 300, true );
	add_image_size( 'featured-medium', 230, 230, true );
	add_image_size( 'slider', 1018, 460, true ); 		// used on Featured Slider on Homepage Header
	add_image_size( 'gallery', 474, 342, true ); 				// used to show gallery all images

	/**
	 * This theme supports custom background color and image
	 */
	$args = array(
		'default-color' => '#d3d3d3',
		'default-image' => get_template_directory_uri() . '/images/background.png',
	);
	add_theme_support( 'custom-background', $args );
	
	/**
	 * This theme supports add_editor_style 
	 */
	add_editor_style();
}	
endif; // travelify_setup
add_action( 'after_setup_theme', 'travelify_setup' );


/**
 * Function to register the widget areas(sidebar) and widgets.
 */
function travelify_widgets_init() {

	// Registering main left sidebar
	register_sidebar( array(
		'name' 				=> __( 'Left Sidebar', 'travelify' ),
		'id' 					=> 'travelify_left_sidebar',
		'description'   	=> __( 'Shows widgets at Left side.', 'travelify' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title">',
		'after_title'   	=> '</h3>'
	) );

	// Registering main right sidebar
	register_sidebar( array(
		'name' 				=> __( 'Right Sidebar', 'travelify' ),
		'id' 					=> 'travelify_right_sidebar',
		'description'   	=> __( 'Shows widgets at Right side.', 'travelify' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title">',
		'after_title'   	=> '</h3>'
	) );

	// Registering footer widgets
	register_sidebar( array(
		'name' 				=> __( 'Footer', 'travelify' ),
		'id' 					=> 'travelify_footer_widget',
		'description'   	=> __( 'Shows widgets at footer.', 'travelify' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title">',
		'after_title'   	=> '</h3>'
		) 
	);	
}
add_action( 'widgets_init', 'travelify_widgets_init' );

?>