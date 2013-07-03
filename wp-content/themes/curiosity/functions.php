<?php
/**
 * Max Magazine Theme functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * @file      functions.php
 * @package   curiosity
 * @author    Sami Ch.
 * @link 	  http://gazpo.com
 */


/**
 * Tell WordPress to run curiosity_setup() when the 'after_setup_theme' hook is run.
 */
 
add_action( 'after_setup_theme', 'curiosity_setup' );
 
if ( ! function_exists( 'curiosity_setup' ) ):
 
function curiosity_setup() {
	
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	if ( ! isset( $content_width ) )
		$content_width = 600;
	
	/**
	 * This theme styles the visual editor with editor-style.css to match the theme style.
	 */
	add_editor_style();
	
	/**
	 * Load up our theme options page and related code.
	 */
	require ( get_template_directory() . '/settings/theme-options.php' );
	
	/**
	 * Load our theme widgets
	 */
	require( get_template_directory() . '/widgets/widget_facebook.php' );
	require( get_template_directory() . '/widgets/widget_twitter.php' );
	require( get_template_directory() . '/widgets/widget_ad125.php' );
	
	/** 
	 * Add default posts and comments RSS feed links to <head>.
	 */
	add_theme_support( 'automatic-feed-links' );
	
	/**
	 * This theme uses wp_nav_menu() in one location.	
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'curiosity' ),
	) );
	
	/**
	 * Add support for custom backgrounds.
	 */
	add_theme_support( 'custom-background', array(
		// Let WordPress know what our default background color is.
		// This is dependent on our current color scheme.
		'default-image' => get_template_directory_uri() . '/images/default_bg.png'		
	) );
	
	/**
	 * Add custom image size for slider	posts
	 */
	if ( function_exists( 'add_theme_support' ) ) { 
		add_theme_support( 'post-thumbnails' );
	}
	
	/**
	 * Add custom image size for slider and featured category thumbnails.	
	 */
	add_image_size( 'slider-image', 624, 300, true );
	
	/**
	 * Add custom image size for carousel posts	
	 */
	add_image_size( 'large-thumb', 222, 140, true );	
	
	/**
	 * Add custom image size for slider thumbnails.	
	 */
	add_image_size( 'small-thumb', 80, 60, true );
	
		
}
endif; // curiosity_setup


/**
 * Set the custom excerpt length to return first 50 words.
 */
function curiosity_custom_excerpt_length( $length ) {
	return 50;
}
add_filter( 'excerpt_length', 'curiosity_custom_excerpt_length', 999 );

/**
 * Set the format for the more in excerpt, return ... instead of [...]
 */ 
function curiosity_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'curiosity_excerpt_more');

	
/**
 * Register our sidebars and widgetized areas.
 *
 */
if ( function_exists('register_sidebar') ) {
			
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'curiosity' ),
		'id' => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Area', 'curiosity' ),
		'id' => 'sidebar-2',
		'description' => __( 'An optional widget area for your site footer', 'curiosity' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );	
}

/**
 * Function for the custom template for comments and pingbacks.
 *
 */
 
if ( ! function_exists( 'curiosity_comments' ) ) {

	function curiosity_comments( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
			<li class="pingback">
				<span class="title" ><?php _e('Pingback:', 'curiosity') ?></span> <?php comment_author_link(); ?>
			<?php
			
			break;
		
			default :
		?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<div id="comment-<?php comment_ID(); ?>" class="comment">
					<div class="comment-meta">
			
						<div class="comment-author vcard">
							<?php
								$avatar_size = 39;
								if ( '0' != $comment->comment_parent )
									$avatar_size = 39;

								echo get_avatar( $comment, $avatar_size );

								/* translators: 1: comment author, 2: date and time */
								printf(  '%1$s <span class="date-and-time">%2$s</span>',
									sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
									sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
										esc_url( get_comment_link( $comment->comment_ID ) ),
										get_comment_time( 'c' ),
										/* translators: 1: date, 2: time */
										sprintf( __( '%1$s at %2$s', 'curiosity' ), get_comment_date(), get_comment_time() )
									)
								);
							?>					
						</div><!-- /comment-author /vcard -->

						<?php if ( $comment->comment_approved == '0' ) : ?>
							<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'curiosity' ); ?></em>
							<br />
						<?php endif; ?>

					</div>

					<div class="comment-content"><?php comment_text(); ?></div>

					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'curiosity' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div><!-- ./reply -->
				</div><!-- /comment -->
			<?php
			break;
		endswitch;
	}
}


/**
 * Pagination for archive, taxonomy, category, tag and search results pages
 *
 * @global $wp_query http://codex.wordpress.org/Class_Reference/WP_Query
 * @return Prints the HTML for the pagination if a template is $paged
 */
function curiosity_pagination() {
	global $wp_query;
 
	$big = 999999999; // This needs to be an unlikely integer
 
	// For more options and info view the docs for paginate_links()
	// http://codex.wordpress.org/Function_Reference/paginate_links
	$paginate_links = paginate_links( array(
		'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
		'mid_size' => 5
	) );
 
	// Display the pagination if more than one page is found
	if ( $paginate_links ) {
		echo '<div class="pagination">';
		echo $paginate_links;
		echo '</div><!--// end .pagination -->';
	}
}

/**
 * A safe way of adding JavaScripts to a WordPress generated page.
 */
    
if (!is_admin()){
    add_action('wp_enqueue_scripts', 'curiosity_js');
	add_action('wp_print_styles', 'curiosity_styles_loader');
}

if (!function_exists('curiosity_js')) {

    function curiosity_js() {
		wp_enqueue_script('superfish', get_template_directory_uri() . '/js/superfish.js', array('jquery')); 			
		wp_enqueue_script('jq_easing', get_template_directory_uri() . '/js/jquery.easing_1.3.js', array('jquery')); 
		wp_enqueue_script('lofslider', get_template_directory_uri() . '/js/lofslider.js', array('jquery')); 
		wp_enqueue_script('jcarousellite', get_template_directory_uri() . '/js/jcarousellite_1.0.1.min.js', array('jquery'));  		
		wp_enqueue_script('curiosity_custom', get_template_directory_uri() . '/js/custom.js', array('jquery'));
		wp_enqueue_script('curiosity_social', get_template_directory_uri() . '/js/social.js'); 		
    }
	
}
	
if (!function_exists('curiosity_styles_loader')) {
    function curiosity_styles_loader() {
		wp_enqueue_style( 'style', get_stylesheet_uri() );
		wp_enqueue_style( 'google_fonts', 'http://fonts.googleapis.com/css?family=PT+Sans:700' );			
    }
}

function curiosity_menu_fallback() { ?>
		<ul class="menu">
			<?php
				wp_list_pages(array(
					'number' => 5,
					'exclude' => '',
					'title_li' => '',
					'sort_column' => 'post_title',
					'sort_order' => 'ASC',
				));
			?>  
		</ul>
    <?php
}
?>