<?php
/**
 * Twenty Thirteen functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

/**
 * Sets up the content width value based on the theme's design.
 * @see twentythirteen_content_width() for template-specific adjustments.
 */
if ( ! isset( $content_width ) )
	$content_width = 604;

/**
 * Adds support for a custom header image.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Twenty Thirteen only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6-alpha', '<' ) )
	require get_template_directory() . '/inc/back-compat.php';

/**
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Thirteen supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_setup() {
	/*
	 * Makes Twenty Thirteen available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Thirteen, use a find and
	 * replace to change 'twentythirteen' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'twentythirteen', get_template_directory() . '/languages' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'fonts/genericons.css', twentythirteen_fonts_url() ) );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Switches default core markup for search form, comment form, and comments
	// to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Navigation Menu', 'twentythirteen' ) );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	/*set_post_thumbnail_size( 1245, 800, true );*/

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'twentythirteen_setup' );

/**
 * Returns the Google font stylesheet URL, if available.
 *
 * The use of Source Sans Pro and Bitter by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function twentythirteen_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Source Sans Pro, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'twentythirteen' );

	/* Translators: If there are characters in your language that are not
	 * supported by Bitter, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$bitter = _x( 'on', 'Bitter font: on or off', 'twentythirteen' );

	if ( 'off' !== $source_sans_pro || 'off' !== $bitter ) {
		$font_families = array();

		if ( 'off' !== $source_sans_pro )
			$font_families[] = 'Source Sans Pro:300,400,700,300italic,400italic,700italic';

		if ( 'off' !== $bitter )
			$font_families[] = 'Bitter:400,700';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}

/**
 * Enqueues scripts and styles for front end.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_scripts_styles() {
	// Adds JavaScript to pages with the comment form to support sites with
	// threaded comments (when in use).
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Adds Masonry to handle vertical alignment of footer widgets.
	if ( is_active_sidebar( 'sidebar-1' ) )
		wp_enqueue_script( 'jquery-masonry' );

	// Loads JavaScript file with functionality specific to Twenty Thirteen.
	wp_enqueue_script( 'twentythirteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '2013-07-18', true );

	// Add Open Sans and Bitter fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentythirteen-fonts', twentythirteen_fonts_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/fonts/genericons.css', array(), '2.09' );

	// Loads our main stylesheet.
	wp_enqueue_style( 'twentythirteen-style', get_stylesheet_uri(), array(), '2019-05-15' );

	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentythirteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentythirteen-style' ), '2013-07-18' );
	wp_style_add_data( 'twentythirteen-ie', 'conditional', 'lt IE 9' );

    // Load my javascript stuff
    wp_enqueue_script('carouFredSel', get_template_directory_uri() . '/custom-js/jquery.carouFredSel-6.2.1.js', array('jquery'), '6.2.1', false);
}
add_action( 'wp_enqueue_scripts', 'twentythirteen_scripts_styles' );

/**
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function twentythirteen_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

    $title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentythirteen' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentythirteen_wp_title', 10, 2 );

/**
 * Registers two widget areas.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Widget Area', 'twentythirteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears in the footer section of the site.', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Secondary Widget Area', 'twentythirteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears on posts and pages in the sidebar.', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'twentythirteen_widgets_init' );

if ( ! function_exists( 'twentythirteen_paging_nav' ) ) :
/**
 * Displays navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'twentythirteen_post_nav' ) ) :
/**
 * Displays navigation to next/previous post when applicable.
*
* @since Twenty Thirteen 1.0
*
* @return void
*/
function twentythirteen_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links-wide">

		    <div class="nav-previous">
            <?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'twentythirteen' ) ); ?>
            </div>
		    <div class="nav-next">
			<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'twentythirteen' ) ); ?>
            </div>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'twentythirteen_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentythirteen_entry_meta() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . __( 'Sticky', 'twentythirteen' ) . '</span>';

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		twentythirteen_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'twentythirteen' ) );
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'twentythirteen' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'twentythirteen' ), get_the_author() ) ),
			get_the_author()
		);
	}
}
endif;

if ( ! function_exists( 'twentythirteen_entry_date' ) ) :
/**
 * Prints HTML with date information for current post.
 *
 * Create your own twentythirteen_entry_date() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param boolean $echo Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function twentythirteen_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'twentythirteen' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'twentythirteen' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

if ( ! function_exists( 'twentythirteen_the_attached_image' ) ) :
/**
 * Prints the attached image with a link to the next attached image.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_the_attached_image() {
	$post                = get_post();
	$attachment_size     = apply_filters( 'twentythirteen_attachment_size', array( 724, 724 ) );
	$next_attachment_url = wp_get_attachment_url();

	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

/**
 * Returns the URL from the post.
 *
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return string The Link format URL.
 */
function twentythirteen_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

/**
 * Extends the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Active widgets in the sidebar to change the layout and spacing.
 * 3. When avatars are disabled in discussion settings.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function twentythirteen_body_class( $classes ) {
	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	if ( is_active_sidebar( 'sidebar-2' ) && ! is_attachment() && ! is_404() )
		$classes[] = 'sidebar';

	if ( ! get_option( 'show_avatars' ) )
		$classes[] = 'no-avatars';

	return $classes;
}
add_filter( 'body_class', 'twentythirteen_body_class' );

/**
 * Adjusts content_width value for video post formats and attachment templates.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_content_width() {
	global $content_width;

	if ( is_attachment() )
		$content_width = 724;
	elseif ( has_post_format( 'audio' ) )
		$content_width = 484;
}
add_action( 'template_redirect', 'twentythirteen_content_width' );

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @return void
 */
function twentythirteen_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'twentythirteen_customize_register' );

/**
 * Binds JavaScript handlers to make Customizer preview reload changes
 * asynchronously.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_customize_preview_js() {
	wp_enqueue_script( 'twentythirteen-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130226', true );
}
add_action( 'customize_preview_init', 'twentythirteen_customize_preview_js' );

/**
* Creates unlinked list with categies inside the categories array
*/

function list_category_array($groupName, $categories, $new_url) {
        echo '<div class="cat_container">';
        echo '<i><h4 class="ul_heading">' . $groupName . '</h4></i>';
        echo '<ul class="no_style">';
            foreach($categories as $category) {
                if (strpos($new_url , $category->slug) !== false) {
                   echo '<a href=' . str_replace($category->slug, '', $new_url) . '><li class="checkbox checked">' . $category->name .  '(' . $category->count . ')' . '</li></a>';
                } else {
                   echo '<a href=' . $new_url . '/' . $category->slug . '><li class="checkbox empty">' . $category->name . '(' . $category->count . ')' . '</li></a>';
                };
            }
        echo '</ul>';
        echo '</div><!-- end of .col-940 -->';
}

/* function list posts */

function list_posts($blog_query, $wp_query) {
    /* localizare */
    if(ICL_LANGUAGE_CODE == 'en'){
        $prev_posts = ' Older posts';
        $next_posts = ' Newer posts';
    }
    if(ICL_LANGUAGE_CODE == 'ro'){
        $prev_posts = ' Postari mai vechi';
        $next_posts = ' Postari mai noi';
    }

   if ( $blog_query->have_posts() ) :

        echo '<div class="tile_cont site_content" id="img_container">';
            while ( $blog_query->have_posts() ) : $blog_query->the_post(); 
                ?>

            <?php
            echo '<div class="tile_img_container">';
            echo '<a href="' . get_permalink() . '" >';
            if (has_post_thumbnail()) {
                echo the_post_thumbnail('medium');
            }
            else {
                echo '<div class="placeholder">';
                echo '</div>';
            }
            echo '</a>';?>

            <?php
            echo '<a class="no_decoration" href="' . get_permalink() . '" >';
            echo '<h5 class="small_margin">' . get_the_title() . '</h5>';
            echo '</a>';?>
            <div class="entry-meta">
                <?php twentythirteen_entry_meta(); ?>
                <?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
            </div><!-- .entry-meta -->
            <div class="entry-summary">
                <?php the_excerpt(); ?>
            </div><!-- .entry-summary -->

            <?php
            echo '</div>';
            ?>

   <?php 
    endwhile;
    echo '</div><!-- end of .col-940 -->';

    if ( $blog_query->max_num_pages > 1 && $blog_query->get('posts_per_page') == 9) : 
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link('Previous posts', $blog_query->max_num_pages) ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> '. $prev_posts, 'twentythirteen' ), $blog_query->max_num_pages ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link('Next posts', $blog_query->max_num_pages) ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( $next_posts . ' <span class="meta-nav">&rarr;</span>', 'twentythirteen' ), $blog_query->max_num_pages ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
    <?php
    endif;

else : 

    get_template_part( 'loop-no-posts' ); 

endif; 
}

/*
 * Function used to transform category_name to category_and
 */

function get_category_and($cat_name) {
    $categories = get_categories();
    $slugCats = array();

    foreach($categories as $cat) {
        $slugCats[$cat->slug] = $cat;
    }

    $cat_name_array = explode(',' , $cat_name);
    $cat_id_array = array();

    foreach($cat_name_array as $cat) {
        $cat_id_array[] = $slugCats[$cat]->cat_ID; 
    }

    return $cat_id_array;
}

/**
* Adding my own variables to the query vars
*/

function add_query_vars($aVars) {
$aVars[] = "search"; // represents the name of the product category as shown in the URL
$aVars[] = "categories"; // represents the name of the product category as shown in the URL
$aVars[] = "mode"; // represents the name of the product category as shown in the URL
return $aVars;
}

// hook add_query_vars function into query_vars
add_filter('query_vars', 'add_query_vars');

/**
* New rewrite rule for wordpress
*/

function add_rewrite_rules($aRules) {
/*
* Custom rewrite rule sintax:
* explore/mode/search/[]/filter/[]/[]/[]
*
*/
$aNewRules = array('explore/mode/([^/]+)/search/([^/]+)/categories/(.+)?$' => 'explore.php?pagename=explore&mode=$matches[1]&search=$matches[2]&categories=$matches[3]',
        'explore/mode/([^/]+)/search/categories/(.+)?$' => 'explore.php?pagename=explore&mode=$matches[1]&categories=$matches[2]' ,
        'explore/mode/([^/]+)/search/categories/?$' => 'explore.php?pagename=explore&mode=$matches[1]',
        'explore/mode/([^/]+)/search/([^/]+)/categories/?$' => 'explore.php?pagename=explore&mode=$matches[1]&search=$matches[2]',
        'explore-en/mode/([^/]+)/search/([^/]+)/categories/(.+)?$' => 'explore.php?pagename=explore-en&mode=$matches[1]&search=$matches[2]&categories=$matches[3]',
        'explore-en/mode/([^/]+)/search/categories/(.+)?$' => 'explore.php?pagename=explore-en&mode=$matches[1]&categories=$matches[2]' ,
        'explore-en/mode/([^/]+)/search/categories/?$' => 'explore.php?pagename=explore-en&mode=$matches[1]',
        'explore-en/mode/([^/]+)/search/([^/]+)/categories/?$' => 'explore.php?pagename=explore-en&mode=$matches[1]&search=$matches[2]'
        );
#$aNewRules = array('explore/([^/]+)/([^/]+)/?$' => 'explore.php[2]');
$aRules = $aNewRules + $aRules;
return $aRules;
}
 
// hook add_rewrite_rules function into rewrite_rules_array
// this 
add_filter('rewrite_rules_array', 'add_rewrite_rules');

/**
* Redirect for the search string
*/

function fb_change_search_url_rewrite() {
    if ( isset( $_GET['search'] ) ) {
        wp_redirect( home_url( "/explore/mode/int/search/" ) . urlencode( get_query_var( 'search' ) ) . "/categories/" . urlencode (get_query_var( 'categories')));
        exit();
    }   
}
add_action( 'template_redirect', 'fb_change_search_url_rewrite' );

/*
 * Removing unwanted things from the posts this should all be replaced inside the posts
 */
// Replaces all <div> in the_content with <p>
/*function clear_replacedivopen($content){
    return str_replace("<div>","<p>", $content);
}
add_filter('the_content', 'clear_replacedivopen', 20);

// Replaces all </div> in the_content with </p>
function clear_replacedivclose($content){
    return str_replace("</div>","</p>", $content);
}
add_filter('the_content', 'clear_replacedivclose', 20);

// Clears all empty <p></p> in the_content()
function clear_emptyp($content){
    return str_replace("<p></p>","", $content);
}
add_filter('the_content', 'clear_emptyp', 20);

// Clears all empty <p></p> in the_content()
function replace_image_size($content){
    return str_replace("s640","s800", $content);
}
add_filter('the_content', 'replace_image_size', 20);

// Clears all empty <p></p> in the_content()
function replace_image_width($content){
    return ereg_replace("width=\"[0-9][0-9][0-9]\"","", $content);
}
add_filter('the_content', 'replace_image_width', 20);
*/

// Filter for replacing embedded widths from thumbnails, should be fixed from the database
function replace_image_width($content){
    return ereg_replace("width=\"[0-9][0-9][0-9][0-9]\"","", $content);
}
add_filter('post_thumbnail_html', 'replace_image_width');

// translate the title
function translate_title($title){
    if(ICL_LANGUAGE_CODE == 'en'){
        $title = str_replace("Jurnal de aventura si explorare", "Adventure journal", $title);
        $title = str_replace("Alpinism, Alergat, Escalada, Cicloturism, Ultramaratoane si alte lucruri aventuroase.", "Alpinism, Running, Climbing, Bike Touring, Ultramarathons and other outdoorsy things", $title);
    };
    return $title;
}

// Print the social icons in the navbar
function get_social_icons(){
    ?>
    <div class="social_header">
        <a class="social-media-icon facebook" target="_blank" href="https://www.facebook.com/diaconescu.radu.9">F</a>
        <a class="social-media-icon email" target="_blank" href="http://eepurl.com/btBGbf">Email</a>
        <a class="social-media-icon rss" target="_blank" href="http://www.diaconescuradu.com/feed">Rss</a>
    <?php
    $translation_list = icl_get_languages(); 
    echo '</div>';

   
    if(ICL_LANGUAGE_CODE == 'ro'){
        echo '<a class="language_switcher" href="' . $translation_list[en][url] . '">EN</a>';
    } else {
        echo '<a class="language_switcher" href="' . $translation_list[ro][url] . '">RO</a>';
    }?>
    <?php
}

// Print the social icons
function get_social_buttons(){
    ?>
    <div class="social_buttons"> <!-- Social buttons -->
        <!-- facebook like button -->
        <div class="fb-like" data-href="<?php the_permalink()?>" data-width="140" data-layout="button_count" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
    </div>
    <?php
}

// Print the social icons
function get_signup_form(){
    ?>
<!-- Begin MailChimp Signup Form -->
<div id="mc_embed_signup">
<form action="//diaconescuradu.us11.list-manage.com/subscribe/post?u=1e6b779ca548514417d6f6d3f&amp;id=2f0040a1cf" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
    <div id="mc_embed_signup_scroll">
    <h5>Pentru noutati din calatorii si pentru idei de aventuri mail-ul ramane cea mai sigura varianta.</h5>
<div class="mc-field-group">
    <input type="email" value="Scrie aici adresa ta de email" name="EMAIL" class="required email" id="mce-EMAIL" onblur="if (this.value == '') {this.value = 

'Scrie aici adresa ta de email';}" onfocus="if (this.value == 'Scrie aici adresa ta de email') {this.value = '';}">
</div>
    <div id="mce-responses" class="clear">
        <div class="response" id="mce-error-response" style="display:none"></div>
        <div class="response" id="mce-success-response" style="display:none"></div>
    </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;"><input type="text" name="b_1e6b779ca548514417d6f6d3f_2f0040a1cf" tabindex="-1" value=""></div>
        <div class="clear"><input type="submit" value="Aboneaza-te" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
    </div>
</form>
</div>

<!--End mc_embed_signup-->
   <?php
}
// Display the meta information
function front_page_meta(){
    if(ICL_LANGUAGE_CODE == 'ro'){
    ?>
        <meta name="description" content="Jurnal despre munte , calatorie, aventura si explorare intr-o lume  moderna si povestea unei calatorii de 9 luni pe bicicleta prin Asia Centrala, catre Khan Tengri."/>
        <meta name="google-site-verification" content="sew4rCyRwDMVb5HpH3QZXY5_SRX4bUOdPHXp_4dp9Io" />
        <meta name="keywords" content="alpinism, cicloturism, alergat, maratoane, ultramaratoane, germania"/>
    <?php
    } else {
    ?>
        <meta name="description" content="A journal about mountains, travel, adventure and exploration in a modern world, and the story of 9 month bike-touring trip through Central Asia, towards Khan Tengri."/>
        <meta name="keywords" content="alpinism, bike touring, running, marathons, ultramarathons, Germany"/>
    <?php
    }
}
