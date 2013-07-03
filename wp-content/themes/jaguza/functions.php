<?php
/**
 * Jaguza functions and definitions.
 *
 * Sets up the theme options and does all the heavy-lifting
 * by piggy-backing onto action and filter hooks in
 * WordPress to change core functionality.
 */
 
 /**
 * Sets up theme defaults and registers the various WordPress features that
 * jaguza supports.
 * @since jaguza 1.0.0
 * @uses load_child_theme_textdomain()
 * @uses add_image_size()
 *
 */
function jaguza_setup() {
	/*
	 * Makes jaguza available for translation.
	 * Translations can be added to the /languages/ directory.
	 */
	load_child_theme_textdomain( 'jaguza', get_stylesheet_directory() . '/languages' );
	
    /**
 	  * Add custom thumbnail sizes for the sliders on the homepage.
 	  */
	 if ( function_exists( 'add_image_size' ) ) { 
		add_image_size( 'mainslider-thumb', 420, 280, true); /*Main slider in normal mode*/
		add_image_size( 'mainslider-thumbWideMode', 980, 380, true); /*Main slider in wide mode*/
		add_image_size( 'homepagepreview-thumb', 680, 320, true); /*Images used in post previews on homepage*/
	}
	
	/**
 	  * Remove custom header support. The design doesn't support them
 	  */
	
	remove_custom_image_header();
	 
 }
add_action( 'after_setup_theme', 'jaguza_setup',100 );
 
 /**
 * Add Javascript files used by jaguza
 * @since jaguza 1.0.0
 */
function jaguza_enqueue_scripts(){
	$isHome = false;/*Used to notify JS file whether we are on the homepage or not*/	
	
	/*The JS used only on the homepage*/
	if(is_home()):
	/*Flexslider is used on the homepage for the slideshow*/
	wp_enqueue_script('jquery-carousel', get_stylesheet_directory_uri() . '/js/jquery.flexslider-min.js',array('jquery'),'1.8',true);
	$isHome = true;
	endif;
	
	/*The JavaScript used all-over the site*/
	wp_register_script('jaguza-js', get_stylesheet_directory_uri() . '/js/jaguza.js',array('jquery'),'1.0.1',true);
	wp_localize_script('jaguza-js','jaguza_JS',array('isHome' => $isHome,'back2Top'=> jaguza_get_option('jaguza_show_back2Top')));
	wp_enqueue_script('jaguza-js');
}
add_action('wp_enqueue_scripts','jaguza_enqueue_scripts');
 
 /**
 * Add the CSS file that contains the user's customisation
 * @since Jaguza 1.0.0
 */
function jaguza_enqueue_css() {
/*We add multisite support. Options css file saved in different location for multisite*/
	if(is_multisite()):
		$uploads = wp_upload_dir();
		$jaguza_options_css_dir = trailingslashit($uploads['baseurl']);
	else:
		$jaguza_options_css_dir = get_stylesheet_directory_uri() . '/css/'; 
	endif;	
wp_register_style('jaguza-options', $jaguza_options_css_dir . 'jaguza.options.css', 'style');	
wp_enqueue_style( 'jaguza-options');

}
add_action('wp_print_styles', 'jaguza_enqueue_css');
 
 if ( ! function_exists( 'jaguza_get_option' ) ) {

/**
 * Helper function to return the theme option value.
 * If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 * @since jaguza 1.0.0
 */
	 
function jaguza_get_option( $name, $default = false ) {
		$config = get_option( 'jaguza_options' );

		if ( ! isset( $config[$name] ) ) {
			return $default;
		}

		return $config[$name];
	}
}


/**
 * Returns the post thumbnail. Used on homepage in the sliders.
 * Returns a different post thumbnail depending on the slider
 * If no thumbnail exists, picks the first image in the post uploaded using 
 * wp media uploader, resizes it and then returns it. If no image was uploaded using
 * wp media uploader, returns a default image
 * @since jaguza 1.0.0
 * @uses get_the_post_thumbnail()
 * @uses has_post_thumbnail() 
 * @uses aq_resize() from SyamilMJ, author of the Slightly Modded Options Framework
 */
function jaguza_get_post_thumbnail($width,$height,$fallbackImage='') {
  global $post, $posts;
  $first_img = '';
  $jaguza_fallbackImage = get_stylesheet_directory_uri()."/images/defaultFallbackImage.jpg";
  $alt_text = get_post_meta($post->ID, '_wp_attachment_image_alt', true);
  if ( has_post_thumbnail($post->ID) ) : 
	  switch($width): /*Return different thumbnails depending on slider*/
		case 420:/*Main slider in normal mode*/
				$jaguza_post_thumbnail = get_the_post_thumbnail( $post->ID, 'mainslider-thumb' ); 
		break;
		case 680:/*Images used in post previews on homepage*/
				$jaguza_post_thumbnail = get_the_post_thumbnail( $post->ID, 'homepagepreview-thumb' ); 
		break;
		case 980: /*Main slider thumbnail in wide mode*/
				$jaguza_post_thumbnail = get_the_post_thumbnail( $post->ID,'mainslider-thumbWideMode' ); 
		break;
	  endswitch;
  else: /*For posts without Featured image, we pick the first image in the post*/
	  ob_start();
	  ob_end_clean();
	  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	  if(isset($matches[1][0]))
	  	$first_img = $matches[1][0];
	
	  if(empty($first_img)){ /*If no image is retrieved from the post, return the default image defined above*/
		if(!empty($fallbackImage)):
			$first_img = $fallbackImage;
		else:	
			$first_img = $jaguza_fallbackImage;  
		endif;
	  }
	 /* Now to resize it...*/
	  require_once(get_stylesheet_directory().'/inc/aq_resizer.php');
	 $resized_img_url = jaguza_aq_resize($first_img,$width,$height,true);
	 $first_img = ($resized_img_url ? $resized_img_url : $jaguza_fallbackImage);/*If the resize worked, we return the re-sized image. Re-size works only for images uploaded using wp media uploader*/
	 $alt_text = ( $alt_text == "" ? "Jaguza" : $alt_text);
	 $jaguza_post_thumbnail="<img src='$first_img' width='$width' height='$height' alt='$alt_text' />";
 endif;
  return $jaguza_post_thumbnail;
}

 
/**
 * Make changes to the excerpt. Add a 'read more' link to it
 **/
 
function jaguza_new_excerpt_more($more) {
	if(!is_home())
		return; /*We only use this function on the homepage*/
     global $post;
	return '...  <span class="read-more"> <a href="'. get_permalink($post->ID) . '" >'.esc_textarea(jaguza_get_option('jaguza_slider_read_more')).'</a></span>';
}
add_filter('excerpt_more', 'jaguza_new_excerpt_more');

/**
 * Change the excerpt length
 * @since jaguza 1.0.0
 */
function jaguza_new_excerpt_length($length=40) {
	if(is_home() || is_category() ) /*The is_category() is needed for this to work when a user selects a particular category for the slider*/
	 $length = esc_attr(jaguza_get_option('jaguza_slider_excerpt_length'));
	
	return $length;

}
add_filter('excerpt_length', 'jaguza_new_excerpt_length');
 
 
 /**
 * Generate the floating social icons bar
 * @since jaguza 1.0.0
 */
function jaguza_generate_socialBar_icons(){
	if(!jaguza_get_option('jaguza_show_social_icons')) 
		return;
							   
		$social_floating_bar = '<span id="floating_social_sidebar"><ul class="floating_tabs">';	
		$social_floating_bar_icons = '';
		$social_icons = array("facebook","twitter","tumblr","googleplus","flickr","linkedin","rss","youtube","reddit");																		 		foreach($social_icons as $social_icon):
			if(jaguza_get_option('jaguza_'.$social_icon.'_link') != '#' && (jaguza_get_option('jaguza_'.$social_icon.'_link'))){
				$social_floating_bar_icons.='<li class="widget_button '.$social_icon.'_sidebar_icon"><a title="'.$social_icon.'" href="'.esc_url(jaguza_get_option('jaguza_'.$social_icon.'_link')).'" target="_blank" ></a></li>';
			}//eoif
	endforeach;
	if($social_floating_bar_icons == '')/*If no links have been defined by the user, the party ends here*/
	 return;
										
	$social_floating_bar.=$social_floating_bar_icons.'</ul></span>';
	return 	$social_floating_bar;																			  
}

/**
 *Add Breadcrumbs if the option is enabled
 *@since jaguza 1.0.0
 */
function jaguza_breadcrumbs($query) {
	if(!jaguza_get_option('jaguza_enable_breadcrumbs'))  /*Only show the breadcrumbs if the option is enabled*/
		return;
	 global $wp_the_query,$post;	
	  if ($query === $wp_the_query) :/* We check if this is the main query. We do this to eliminate breadcrumbs from Widgets, etc since they too call the loop*/
     if (!is_home() && !is_feed()) { /*We use this to display breadcrumbs on all pages but the homepage*/
		echo '<div id="jaguza_breadcrumbs">';
		echo 'You are here: <a href="';
		echo esc_html(home_url());
		echo '">';
		echo 'Home'; 
		echo "</a> / ";
		if (is_category() || is_single()) {
			the_category(', ','&title_li=');
			if (is_single()) {
				echo " / ";
				the_title();
			}
		} 
			else if (is_archive()) {
				echo " Archive";
			}
			elseif (is_page()) {
			if(!$post->post_parent):
				echo the_title(); /*If the page is not a child, the road ends here*/
			else:
				$ancestors = get_post_ancestors( $post->ID );
				$parentTrail = '';
					/*Faster Algorithm: We choose to iterate through the array 'backwards' rather than using 
					array_reverse+foreach. This eliminates the need to call array_reverse()*/
				for($i=(count($ancestors)-1);$i>=0;$i--):
						$parentTrail .= "<a href=".get_permalink($ancestors[$i]).">".get_the_title($ancestors[$i])."</a> / ";
				endfor;
				echo $parentTrail;
				echo the_title();
			endif;
}
		echo '</div>';
}	
	endif;
}
add_action('loop_start', 'jaguza_breadcrumbs');

/**
 * Add 'jaguza' class to all pages. This is very important. 
 * It allows the user's customization to override the default styling
 * @since jaguza 1.0.0
 */
add_filter('body_class','jaguza_add_body_class');
function jaguza_add_body_class($classes) {
	$classes[] = 'jaguza';
	return $classes;
}


/**
 * Custom pagination links for the theme
 * @since jaguza 1.0.0
 */
function jaguza_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}


/**
 * Picks the options set by the user in the 
 * options panel and makes changes to the header
 * @since jaguza 1.0.0
 */
function jaguza_modify_header(){ 
	/*Print the favicon if it was defined*/
	if((jaguza_get_option('jaguza_favicon')))
		printf( '<link rel="shortcut icon" href="%s" type="image/x-icon" />', esc_url(jaguza_get_option('jaguza_favicon')) );
	
	/*Add the Google Analytics code*/
	if((jaguza_get_option('jaguza_tracking_code'))):
		?>
		<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', '<?php echo esc_textarea(jaguza_get_option('jaguza_tracking_code')) ?>']);
		_gaq.push(['_trackPageview']);
		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
		</script>
		<?php
	endif;
} 
add_action('wp_head','jaguza_modify_header', 50);  


/**Create a widget to display the
 * latest items from jaguza help page. 
 * The jaguza support team regularly updates the 
 * suppport site with helpful information created based on 
 * the issues most-faced by users
 * @since jaguza 1.0.0
 */
function jaguza_RSS_widget(){  
	$widget = "";
	$maxitems = 0;

 	/* Get RSS Feed(s)*/
	include_once(ABSPATH . WPINC . '/feed.php');

	/* Get a SimplePie feed object from the specified feed source. We exclude the default category which holds dummy content*/
	$rss = fetch_feed('http://themes.blueboltlimited.com/jaguza/feed/?cat=-1');
	if (!is_wp_error( $rss ) ) : // Checks that the object is created correctly 
		/* Figure out how many total items there are, but limit it to 5. */ 
		$maxitems = $rss->get_item_quantity(5); 
	
		/* Build an array of all the items, starting with element 0 (first element).*/
		$rss_items = $rss->get_items(0, $maxitems); 
	endif;
	 

	$widget.="<ul>";
			if ($maxitems == 0):
	$widget.="<li>No Jaguza news.</li>";
			else:
		/* Loop through each feed item and display each item as a hyperlink.*/
		foreach ( $rss_items as $item ) : 
	 $widget.="<li><a href='".esc_url( $item->get_permalink() )."' title='Posted ".$item->get_date('j F Y | g:i a')."' target='blank'>".esc_html( $item->get_title() )."</a>    </li>";
		  endforeach; 
		  endif;
	$widget.="</ul>";

  return $widget;
}

/*=REGISTER FOOTER SIDEBAR
--------------------------------------------------------------*/

function jaguza_register_sidebars(){
   
   //Define Footer Widget parameters
   $footer_sidebar_args = array(
	'name'          => __( 'Jaguza Footer', 'jaguza' ),
	'id'            => 'jaguza_footer',
	'description'   =>  __( 'Appears below the content on all pages', 'jaguza' ),
     'class'         => '',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>' ); 
   
 /* Register Footer Sidebar*/
  register_sidebar( $footer_sidebar_args );
   
}

add_action('widgets_init','jaguza_register_sidebars');
/*=ADMIN FUNCTIONS
--------------------------------------------------------------*/
/**
 * Load the administrative functions  
 * @since jaguza 1.0.0
 */ 
if(is_admin() &&  is_file( get_stylesheet_directory() . '/admin/admin.functions.php' ) )  
	require_once (get_stylesheet_directory() . '/admin/admin.functions.php');   


 ?>