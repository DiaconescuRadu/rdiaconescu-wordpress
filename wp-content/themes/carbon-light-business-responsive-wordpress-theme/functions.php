<?php

/*
 *  Author: OneTwoWeb Ltd.
 *  URL: onetwoweb.bg/en
 *  Custom functions, support, custom post types and more.
 */


/*-----------------------------------------------------------------------------------------------------------*\
	Theme Support - menus, post-thumbnails, additional image sizes, automatic-feed-links, Localisation Support
\*-----------------------------------------------------------------------------------------------------------*/

if (!isset($content_width)) { $content_width = 900; }

if (function_exists('add_theme_support')) {
    add_theme_support('menus');
    add_theme_support('post-thumbnails');
    add_image_size('blog-medium', 220, 170, true); // Archives, author, category, tag - 220x170
    add_image_size('blog-large', 700, 330, true); // Single Blog Post - 700x330
    add_image_size('portfolio-medium', 303, 210, true); // Portfolio 3 Columns
    add_image_size('porfolio-large', 700, 400, true); // Single Portdolio Post - 700x330
    add_theme_support('automatic-feed-links');
    load_theme_textdomain('otw-carbon-light', get_template_directory() . '/languages');
}


/*-----------------------------------------------------------------------------------------------------------*\
    OTW Scripts and Styles
\*-----------------------------------------------------------------------------------------------------------*/

// Load Styles - frondend
add_action('wp_enqueue_scripts', 'otw_head_styles'); // Add Theme Stylesheets
function otw_head_styles() {
    if (! is_admin() ) {
        /* Included Google Fonts */
        wp_register_style('googleFont-OpenSans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,700');
        wp_enqueue_style( 'googleFont-OpenSans');
        wp_register_style('googleFont-OpenSansCond', 'http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700');
        wp_enqueue_style( 'googleFont-OpenSansCond');

        /* Includ Icon Font CSS Styles */
        wp_register_style('general_foundicons', get_template_directory_uri() . '/stylesheets/general_foundicons.css', array(), '1.0', 'screen' );
        wp_enqueue_style( 'general_foundicons');
        wp_register_style('social_foundicons', get_template_directory_uri() . '/stylesheets/social_foundicons.css', array(), '1.0', 'screen' );
        wp_enqueue_style( 'social_foundicons');

        /* Includ CSS Files */
        wp_register_style('jquery-ui', get_template_directory_uri() . '/stylesheets/jquery-ui-1.9.1.css', array(), '1.9.1', 'all' );
        wp_enqueue_style( 'jquery-ui');
        wp_register_style('footable', get_template_directory_uri() . '/stylesheets/footable-0.1.css', array(), '0.1', 'all' );
        wp_enqueue_style( 'footable');
        wp_register_style('footable-sortable', get_template_directory_uri() . '/stylesheets/footable.sortable-0.1.css', array(), '0.1', 'all' );
        wp_enqueue_style( 'footable-sortable');
        wp_register_style('carbon-all', get_template_directory_uri() . '/stylesheets/carbon-all.css', array(), '1.0', 'all' );
        wp_enqueue_style( 'carbon-all');

//        wp_register_style('carbon', get_template_directory_uri() . '/stylesheets/carbon.css', array(), '1.0', 'all' );
//        wp_enqueue_style( 'carbon');

        /* FlexSlider And Carbon Cusom Styles */
        wp_register_style('flexslider', get_template_directory_uri() . '/sliders/flexslider/flexslider.css', array(), '2.0', 'all' );
        wp_enqueue_style( 'flexslider');
        wp_register_style('flexslider-custom', get_template_directory_uri() . '/sliders/flexslider-custom/flexslider.css', array(), '2.0', 'all' );
        wp_enqueue_style( 'flexslider-custom');

        /* Cusom Styles for users */
        wp_register_style('custom', get_template_directory_uri() . '/custom.css', array(), '1.0', 'all' );
        wp_enqueue_style( 'custom');

        /* Enable Threaded Comments */
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}


// Load Scripts - frontend
function otw_footer_scripts() {
   if ( !is_admin() ) {
        /* Allow HTML5 elements to be styled in IE8 */
        wp_register_script('html5shiv-printshiv', get_template_directory_uri() . '/javascripts/html5shiv-printshiv.js');
        wp_enqueue_script('html5shiv-printshiv');

        /* Replace jQuery with jQuery.min - in Frontend */
        wp_deregister_script('jquery');
        wp_register_script( 'jquery', get_template_directory_uri().'/javascripts/jquery-1.8.3.min.js', false, '1.8.3' );
        wp_enqueue_script('jquery');

        /* jQuery and jQuery UI */
        wp_register_script('jquery-ui', get_template_directory_uri() . '/javascripts/jquery-ui-1.9.1.min.js', array(), '1.9.1', true);
        wp_enqueue_script('jquery-ui');

        /* Responsive Tables */
        wp_register_script('footable', get_template_directory_uri() . '/javascripts/footable-0.1.js', array(), '0.1', true);
        wp_enqueue_script('footable');
        wp_register_script('footable-sortable', get_template_directory_uri() . '/javascripts/footable.sortable.js', array(), false, true);
        wp_enqueue_script('footable-sortable');

        /* Responsive Navigation Menu */
        wp_register_script('tinynav', get_template_directory_uri() . '/javascripts/tinynav.js', array(), false, true);
        wp_enqueue_script('tinynav');

        /* Shadow Animation Plugin */
        wp_register_script('animate-shadow-min', get_template_directory_uri() . '/javascripts/jquery.animate-shadow-min.js', array(), false, true);
        wp_enqueue_script('animate-shadow-min');

        /* Filterable Portfolio Items */
        wp_register_script('jquery-quicksand', get_template_directory_uri() . '/javascripts/jquery.quicksand.js', array(), false, true);
        wp_enqueue_script('jquery-quicksand');

        /* FlexSlider */
        wp_register_script('flexslider-min', get_template_directory_uri() . '/sliders/flexslider/jquery.flexslider-min.js', array(), false, true);
        wp_enqueue_script('flexslider-min');

        /* Custom Theme JS */
        wp_register_script('carbon', get_template_directory_uri() . '/javascripts/carbon.js', array(), false, true);
        wp_enqueue_script('carbon');
    }
}
add_action('wp_enqueue_scripts', 'otw_footer_scripts');



/*-----------------------------------------------------------------------------------*/
/* Register Navigation - Primary Menu */
/*-----------------------------------------------------------------------------------*/

function register_otw_carbon_menu() {
    register_nav_menus(array( // Using array to specify more menus if needed
        'primary' => __('Primary Menu', 'otw-carbon-light'), // Main Navigation
        'secondary' => __('Footer Menu', 'otw-carbon-light') // Second Navigation
    ));
}
add_action('init', 'register_otw_carbon_menu');


// Allow Menu Descrptions and fix sublevel class
class Menu_With_Description extends Walker_Nav_Menu {

    function start_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        //$output .= "\n$indent<ul class=\"sub-menu\">\n";
        // Change sub-menu to dropdown menu
        $output .= "\n$indent<ul class=\"dropdown\">\n";
    }

	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
   		$item_output .= '<br /><span class="subtitle">' . $item->description . '</span>';
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

// Replace "current_page_" with class "active"
function current_to_active($text){
	$replace = array(
		// List of classes to replace with "active"
		'current_page_item' => 'active',
		'current_page_parent' => 'active',
		'current_page_ancestor' => 'active',
	);
	$text = str_replace(array_keys($replace), $replace, $text);
		return $text;
	}
add_filter ('nav_menu_css_class','current_to_active');




/*-----------------------------------------------------------------------------------*/
/* Register Sidebars - Sidebar, Footer */
/*-----------------------------------------------------------------------------------*/

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar')) {

    // Define Sidebar Widget Area
    register_sidebar(array(
        'name' => __('Sidebar Widgets', 'otw-carbon-light'),
        'description' => __('Sidebar Widget Area...', 'otw-carbon-light'),
        'id' => 'sidebar-widget-area',
        'before_widget' => '<div id="%1$s" class="%2$s otw-widget-list otw-list">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Footer Widget Area 2
    register_sidebar(array(
        'name' => __('Footer Widgets', 'otw-carbon-light'),
        'description' => __('Footer Widget Area...', 'otw-carbon-light'),
        'id' => 'footer-widget-area',
        'before_widget' => '<div id="%1$s" class="%2$s otw-six otw-columns otw-widget-list otw-list">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

}


/*-----------------------------------------------------------------------------------*/
/* Last widget classes - add class end */
/*-----------------------------------------------------------------------------------*/

function slug_widget_order_class() {
  global $wp_registered_sidebars, $wp_registered_widgets;
  $sidebars = wp_get_sidebars_widgets();
  if ( empty( $sidebars ) ) return;
  foreach ( $sidebars as $sidebar_id => $widgets ) {
    if ( empty( $widgets ) )
    continue;
    $number_of_widgets = count( $widgets );
    foreach ( $widgets as $i => $widget_id ) {
    $wp_registered_widgets[$widget_id]['classname'] .= ' widget-order-' . $i;
      if ( $number_of_widgets == ( $i + 1 ) ) {
      $wp_registered_widgets[$widget_id]['classname'] .= ' end';
      }
    }
  }
}
add_action( 'init', 'slug_widget_order_class' );



/*-----------------------------------------------------------------------------------*/
/* Add meta custom box to the administrative interface.  */
/*-----------------------------------------------------------------------------------*/

add_action( 'add_meta_boxes', 'otw_add_custom_box' );

/* Do something with the data entered */
add_action( 'save_post', 'otw_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function otw_add_custom_box() {
    $screens = array( 'post', 'page', 'portfolio' );
    foreach ($screens as $screen) {
        add_meta_box(
            'otw_sectionid',
            __( 'Page title setting', 'otw-carbon-light' ),
            'otw_inner_custom_box',
            $screen,
            'side'
        );
    }
}

/* Prints the box content */
function otw_inner_custom_box( $post ) {

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'otw_noncename' );

	global $post;
    $custom = get_post_custom($post->ID);

    if( isset($custom["otw_head_title_setting"][0]) ) {
        $otw_head_title_setting = $custom["otw_head_title_setting"][0];
    } else {
        $otw_head_title_setting = '';
    }

    $checked = '';
    if( $otw_head_title_setting != '' ) { $checked = 'checked="checked"'; }

  echo '<p><input type="checkbox" id="otw_head_title_setting" name="otw_head_title_setting" value="1" '.$checked.' />';
  echo '<label for="otw_head_title_setting">';
       _e("Hide page title area", 'otw-carbon-light' );
  echo '</label></p>';

  $value = get_post_meta( $post->ID, '_otw_meta_value_key', true );
  echo '<label for="otw_page_sub_title">';
       _e("Sub-title", 'otw-carbon-light' );
  echo '</label><br />';
  echo '<input style="width:100%;" type="text" id="otw_page_sub_title" name="otw_page_sub_title" value="'.esc_attr($value).'" />';

}


/* When the post is saved, saves our custom data */
function otw_save_postdata( $post_id ) {

  // First we need to check if the current user is authorised to do this action.
  if ( isset($_REQUEST['post_type']) && $_REQUEST['post_type'] != 'page') {
    if ( ! current_user_can( 'edit_page', $post_id ) )
        return;
  } else {
    if ( ! current_user_can( 'edit_post', $post_id ) )
        return;
  }


	global $post;
      if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
      };


  // Secondly we need to check if the user intended to change this value.
  if ( ! isset( $_POST['otw_noncename'] ) || ! wp_verify_nonce( $_POST['otw_noncename'], plugin_basename( __FILE__ ) ) )
      return;

    update_post_meta($post->ID, "otw_head_title_setting", $_POST["otw_head_title_setting"]);

  // Thirdly we can save the value to the database

  //if saving in a custom table, get post_ID
  $post_ID = $_POST['post_ID'];
  //sanitize user input
  $mydata = sanitize_text_field( $_POST['otw_page_sub_title'] );

  // Do something with $mydata
  // either using
  add_post_meta($post_ID, '_otw_meta_value_key', $mydata, true) or
    update_post_meta($post_ID, '_otw_meta_value_key', $mydata);
  // or a custom table (see Further Reading section below)


}



/*-----------------------------------------------------------------------------------*/
/* Custom Post Type - Portfolio Pages */
/*-----------------------------------------------------------------------------------*/

add_action( 'init', 'register_otw_portfolio' );

function register_otw_portfolio() {

    $labels = array(
        'name' => __( 'Portfolio', 'otw-carbon-light' ),
        'singular_name' => __( 'Portfolio Item', 'otw-carbon-light' ),
        'add_new' => __( 'Add New', 'otw-carbon-light' ),
        'add_new_item' => __( 'Add New Portfolio Item', 'otw-carbon-light' ),
        'edit_item' => __( 'Edit Portfolio Item', 'otw-carbon-light' ),
        'new_item' => __( 'New Portfolio Item', 'otw-carbon-light' ),
        'view_item' => __( 'View Portfolio Item', 'otw-carbon-light' ),
        'search_items' => __( 'Search Portfolio Items', 'otw-carbon-light' ),
        'not_found' =>  __( 'No portfolio items found', 'otw-carbon-light' ),
        'not_found_in_trash' => __( 'No portfolio items found in Trash', 'otw-carbon-light' ),
        'parent_item_colon' => __( 'Parent Portfolio:', 'otw-carbon-light' ),
        'menu_name' => __( 'Portfolio', 'otw-carbon-light' )
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => __( 'Custom Post Type - Portfolio Pages', 'otw-carbon-light' ),
        'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
        'taxonomies' => array( 'portfolio-category' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        'menu_icon' => get_template_directory_uri() .'/includes/portfolio.png',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'portfolio', $args );

    // "Portfolio Categories" Custom Taxonomy
    $labels = array(
    	'name' => __( 'Portfolio Categories', 'otw-carbon-light' ),
    	'singular_name' => __( 'Portfolio Category', 'otw-carbon-light' ),
    	'search_items' =>  __( 'Search Portfolio Categories', 'otw-carbon-light' ),
    	'all_items' => __( 'All Portfolio Categories', 'otw-carbon-light' ),
    	'parent_item' => __( 'Parent Portfolio Category', 'otw-carbon-light' ),
    	'parent_item_colon' => __( 'Parent Portfolio Category:', 'otw-carbon-light' ),
    	'edit_item' => __( 'Edit Portfolio Category', 'otw-carbon-light' ),
    	'update_item' => __( 'Update Portfolio Category', 'otw-carbon-light' ),
    	'add_new_item' => __( 'Add New Portfolio Category', 'otw-carbon-light' ),
    	'new_item_name' => __( 'New Portfolio Category Name', 'otw-carbon-light' ),
    	'menu_name' => __( 'Portfolio Categories', 'otw-carbon-light' )
    );

    $args = array(
    	'hierarchical' => true,
    	'labels' => $labels,
    	'show_ui' => true,
    	'query_var' => true,
    	'rewrite' => array( 'slug' => 'portfolio-category' )
    );

    register_taxonomy( 'portfolio-category', array( 'portfolio' ), $args );

}




/*-----------------------------------------------------------------------------------*/
/* Add the Meta Box in Portfolio admin - url, quote, portfolio images for slider  */
/*-----------------------------------------------------------------------------------*/

function add_custom_meta_box() {
    add_meta_box(
		'otw_portfolio_meta_box', // $id
         __( 'Portfolio Settings', 'otw-carbon-light' ), // $title
		'show_custom_meta_box', // $callback
		'portfolio', // $page
		'normal', // $context
		'high'); // $priority
}
add_action('add_meta_boxes', 'add_custom_meta_box');

// Field Array
$prefix = 'custom_';
$custom_meta_fields = array(
	array(
		'label'	=> __( 'URL', 'otw-carbon-light' ),
		'desc'	=> __( 'Enter URL of your clients site e.g. www.google.com (optional)', 'otw-carbon-light' ),
		'id'	=> $prefix.'otw-portfolio-url',
		'type'	=> 'text'
	),
	array(
		'label'	=> __( 'Testimonial', 'otw-carbon-light' ),
		'desc'	=> __( 'Enter a testimonial from your client to be displayed on the single portfolio page (optional)', 'otw-carbon-light' ),
		'id'	=> $prefix.'otw-portfolio-quote',
		'type'	=> 'textarea'
	),
	array(
		'label'	=> __( 'Portfolio Images', 'otw-carbon-light' ),
		'desc'	=> __( 'Upload an image or enter an URL to your portfolio image (optional)', 'otw-carbon-light' ),
		'id'	=> $prefix.'otw-portfolio-repeatable-image',
		'type'	=> 'repeatable'
	)
);

// Enqueue scripts and styles, but only if is_admin and portfolio pages
add_action( 'admin_init', 'scripts_admin' );
function scripts_admin($hook){
    global $typenow;
    if (empty($typenow) && !empty($_GET['post'])) {
         $post = get_post($_GET['post']);
             $typenow = $post->post_type;
     }
     if( 'post.php' != $hook && 'portfolio' != $typenow)
        return;
	wp_enqueue_script('custom-js', get_template_directory_uri().'/includes/custom-js.js');
	wp_enqueue_style('jquery-ui-custom', get_template_directory_uri().'/includes/jquery-ui-custom.css');
}


// The Callback Meta Boxes
function show_custom_meta_box() {
	global $custom_meta_fields, $post;
	// Use nonce for verification
	echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';

	// Begin the field table and loop
	echo '<table class="form-table">';
	foreach ($custom_meta_fields as $field) {
		// get value of this field if it exists for this post
		$meta = get_post_meta($post->ID, $field['id'], true);
		// begin a table row with
		echo '<tr>
				<th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
				<td>';
				switch($field['type']) {
					// text
					case 'text':
						echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
								<br /><span class="description">'.$field['desc'].'</span>';
					break;
					// textarea
					case 'textarea':
						echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
								<br /><span class="description">'.$field['desc'].'</span>';
					break;

					// repeatable image
                    case 'repeatable':
							echo '<span class="description">'.$field['desc'].'</span><ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
						$i = 0;
					if ($meta) {
					foreach($meta as $row) {
					    $image = wp_get_attachment_image_src($row, 'thumbnail');
                        $image = $image[0];
						echo '<li><span class="sort hndle">|||</span>
                        <input name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$row.'" />
						<img name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" src="'.$image.'" class="custom_preview_image" alt="" style="width:30px;height:30px;" />
						<input name="'.$field['id'].'['.$i.']" class="custom_upload_image_button button" type="button" value="Choose Image" />
						<a class="repeatable-remove button" href="#">' . __('Remove', 'otw-carbon-light') . '</a></li>';
					$i++;
					}} else {
					    $row = '';
						$image = wp_get_attachment_image_src($row, 'thumbnail');
						$image = $image[0];
						echo '<li><span class="sort hndle">|||</span>
						<input name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$row.'" />
						<img name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" src="'.$image.'" class="custom_preview_image" alt="" style="width:30px;height:30px;" />
						<input name="'.$field['id'].'['.$i.']" class="custom_upload_image_button button" type="button" value="' . __('Choose Image', 'otw-carbon-light') . '" />
						<a class="repeatable-remove button" href="#">' . __('Remove', 'otw-carbon-light') . '</a></li>';
					}
					echo '</ul><a class="repeatable-add button" href="#" style="margin-left:250px;">' . __('Add New Image', 'otw-carbon-light') . '</a>';
					break;
				} //end switch
		echo '</td></tr>';
	} // end foreach
	echo '</table>'; // end table
}

// Save the Data - Metaboxes
function save_custom_meta($post_id) {
    global $custom_meta_fields;

    // verify nonce
	// if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))

    if ( !isset($_POST['custom_meta_box_nonce']) || !wp_verify_nonce( $_POST['custom_meta_box_nonce'], basename(__FILE__) ))
		return $post_id;
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return $post_id;
	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id))
			return $post_id;
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
	}

	// loop through fields and save the data
	foreach ($custom_meta_fields as $field) {
		if($field['type'] == 'tax_select') continue;
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	} // enf foreach


}
add_action('save_post', 'save_custom_meta');




/*-----------------------------------------------------------------------------------*/
/* Related Posts */
/*-----------------------------------------------------------------------------------*/
function otw_related_posts($postID) {
    $tags = wp_get_post_tags($postID);
    if ($tags) {
    	$tag_ids = array();
    	foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
    	$args=array(
    		'tag__in' => $tag_ids,
    		'post__not_in' => array($postID),
    		'showposts'=>5, // Number of related posts that will be shown.
    		'ignore_sticky_posts'=>1
    	);
    	$my_query = new wp_query($args);
    	if( $my_query->have_posts() ) {
    		echo '<h3 class="widget-title">'.__('Related Posts', 'otw-carbon-light').'</h3><ul class="otw-list">';
    		while ($my_query->have_posts()) {
    			$my_query->the_post();
    		?>
    			<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
    		<?php
    		}
    		echo '</ul>';
    	}
        wp_reset_query();
    }
}


/*-----------------------------------------------------------------------------------*/
/* Pagination */
/*-----------------------------------------------------------------------------------*/
function otw_pagination() {
    if (function_exists('otw_pagination')) {
        global $wp_query;
        $big = 999999999;
        echo paginate_links(array(
            'type' => 'list',
            'current' => 0,
            'base' => str_replace($big, '%#%', get_pagenum_link($big)),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages
        ));
    } else {
        wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'otw-carbon-light' ), 'after' => '</div>' ) );
    }
}



/*-----------------------------------------------------------------------------------*/
/* OTW Title */
/*-----------------------------------------------------------------------------------*/
function otw_page_title() {

    if (is_category()) {
        printf( __( 'Category: %s', 'otw-carbon-light' ), single_cat_title( '', false ) );

    } elseif (is_tag()) {
        printf( __( 'Tag: %s', 'otw-carbon-light' ), single_tag_title( '', false ) );

    } elseif (is_tax('portfolio-category')) {
        printf( __( 'Portfolio', 'otw-carbon-light' ), single_tag_title( '', false ) );

    } elseif (is_tax()) {
        printf( __( 'Archive for: %s', 'otw-carbon-light' ), single_tag_title( '', false ) );

    } elseif (is_archive()) {

    	if ( is_day() ) :
    		printf( __( 'Daily Archives: %s', 'otw-carbon-light' ), get_the_date() );

    	elseif ( is_month() ) :
    		printf( __( 'Monthly Archives: %s', 'otw-carbon-light' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'otw-carbon-light' ) ) );

    	elseif ( is_year() ) :
    		printf( __( 'Yearly Archives: %s', 'otw-carbon-light' ), get_the_date( _x( 'Y', 'yearly archives date format', 'otw-carbon-light' ) ) );

        elseif ( is_author() ) :
           _e( 'Author: ', 'otw-carbon-light' ); echo get_the_author_meta( 'display_name', get_query_var( 'author' ) );

    	else :
    		_e( 'Archives', 'otw-carbon-light' );

    	endif;

    } elseif( is_home() && get_option('page_for_posts') ) {
        echo get_page( get_option('page_for_posts') )->post_title; // Posts Page setted

    } elseif( 'page' == get_option('show_on_front') ) {
        the_title(); // Front Page setted

    } elseif (is_home() || is_front_page() ) {
        _e( 'Recent Blog Posts', 'otw-carbon-light' ); // Front Page not setted

    } elseif (is_page() || is_single()) {
        the_title();

    } elseif (is_search()) {
        printf( __( 'Search Results for: %s', 'otw-carbon-light' ), get_search_query() );

    } elseif (!(is_404()) && (is_single()) || (is_page())) {
    	wp_title(''); echo ' - ';

    } elseif (is_404()) {
        _e( '404 Page not found', 'otw-carbon-light' );

    }

}



/*-----------------------------------------------------------------------------------*/
/* Wordpress Breadcrumbs - http://dimox.net/wordpress-breadcrumbs-without-a-plugin/ */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('otw_breadcrumb')) :

function otw_breadcrumb() {

	/* === OPTIONS === */
	$text['home']     = __('Home','otw-carbon-light'); // text for the 'Home' link
	$text['category'] = __('Archive for %s','otw-carbon-light'); // text for a category page
	$text['search']   = __('Search results for: %s','otw-carbon-light'); // text for a search results page
	$text['tag']      = __('Posts tagged %s','otw-carbon-light'); // text for a tag page
	$text['author']   = __('View all posts by %s','otw-carbon-light'); // text for an author page
	$text['404']      = __('Error 404','otw-carbon-light'); // text for the 404 page

	$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	$showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$delimiter   = ' &raquo; '; // delimiter between crumbs
	$before      = '<span class="current">'; // tag before the current crumb
	$after       = '</span>'; // tag after the current crumb
	/* === END OF OPTIONS === */

	global $post;
	$homeLink = get_home_url('url') . '/';
	$linkBefore = '<span typeof="v:Breadcrumb">';
	$linkAfter = '</span>';
	$linkAttr = ' rel="v:url" property="v:title"';
	$link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;

	if (is_home() || is_front_page()) {

		if ($showOnHome == 1) echo '<div id="breadcrumb"><a href="' . $homeLink . '">' . $text['home'] . '</a></div>';

	} else {

		echo '<div id="breadcrumb">' . sprintf($link, $homeLink, $text['home']) . $delimiter;

		if ( is_category() ) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) {
				$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo $cats;
			}
			echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

		} elseif ( is_search() ) {
			echo $before . sprintf($text['search'], get_search_query()) . $after;

		} elseif ( is_day() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
			echo $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
		        // printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
                    echo get_the_term_list( $post->ID, 'portfolio-category', '', ', ', '' ) ; // taxonomy fix to display all

				if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo $cats;
				if ($showCurrent == 1) echo $before . get_the_title() . $after;
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			$cats = get_category_parents($cat, TRUE, $delimiter);
			$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
			$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
			echo $cats;
			printf($link, get_permalink($parent), $parent->post_title);
			if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

		} elseif ( is_page() && !$post->post_parent ) {
			if ($showCurrent == 1) echo $before . get_the_title() . $after;

		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				echo $breadcrumbs[$i];
				if ($i != count($breadcrumbs)-1) echo $delimiter;
			}
			if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

		} elseif ( is_tag() ) {
			echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

		} elseif ( is_author() ) {
	 		global $author;
			$userdata = get_userdata($author);
			echo $before . sprintf($text['author'], $userdata->display_name) . $after;

		} elseif ( is_404() ) {
			echo $before . $text['404'] . $after;
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo __('Page', 'otw-carbon-light') . ' ' . get_query_var('paged');

			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}

		echo '</div>';

	}
} // end dimox_breadcrumbs()

endif;





/*-----------------------------------------------------------*/
/* Custom Comments Callback */
/*---------------------------------------------------------*/

function otw_comments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-wrapper animate-on-hover">
	<?php endif; ?>
    <a class="image" href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, 60 ); ?></a>
        <div class="comment-body">
          <span class="comment-meta"><?php echo get_comment_author( $comment->comment_ID ); ?></span> <span class="post-date"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php printf( __('%1$s at %2$s', 'otw-carbon-light'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)', 'otw-carbon-light'),'  ','' ); ?></span>

            <div class="comment-body-text">

                <?php if ($comment->comment_approved == '0') : ?>
                	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'otw-carbon-light') ?></em>
                	<br />
                <?php endif; ?>

                <?php comment_text() ?>
            </div>
            <div class="comment-reply"><?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
      </div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }






/*-----------------------------------------------------------*/
/* External Modules/Plugins/Files - Load includes */
/*---------------------------------------------------------*/


/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/includes/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme
		array(
			'name'     				=> 'WooSlider', // The plugin name
			'slug'     				=> 'wooslider', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/includes/plugins/wooslider.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'otw-carbon-light';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> 'otw-carbon-light',         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', 'otw-carbon-light' ),
			'menu_title'                       			=> __( 'Install Plugins', 'otw-carbon-light' ),
			'installing'                       			=> __( 'Installing Plugin: %s', 'otw-carbon-light' ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'otw-carbon-light' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', 'otw-carbon-light' ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'otw-carbon-light' ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'otw-carbon-light' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}


?>