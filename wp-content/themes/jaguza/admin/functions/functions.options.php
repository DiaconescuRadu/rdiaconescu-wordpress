<?php

add_action('init','jaguza_of_options');
if (!function_exists('jaguza_of_options'))
{
	function jaguza_of_options()
	{
		
		/*Jaguza Defaults*/
	
	// Typography Defaults
	$typography_defaults = array(
		"size" => "15px",
		"face" => "georgia",
		"style" => "bold",
		"color" => "#bada55" );
	
		//Headings defaults
	$heading_options  = array(
		"face" => "georgia",
		"style" => "bold",
		"color" => "#bada55" );
	
	//Sidebar position array
		$sidebar_position_array = array(
		'right' => __('Right','jaguza'),
		'left' => __('Left','jaguza'),
		'none' => __('None','jaguza')
	);
		//Theme color array
	$theme_color_array = array(
		'blue' => __('Blue','jaguza'),
		'orange' => __('Orange','jaguza'),		
		'green' => __('Green','jaguza'),
		'red' => __('Red','jaguza'),
		'brown' => __('Brown','jaguza'),
		'pink' => __('Pink','jaguza'),
		'cyan' => __('Cyan','jaguza'),
		'goldenrod' => __('GoldenRod','jaguza'),
		'lightblue' => __('Light Blue','jaguza'),
		'lightgreen' => __('Light Green','jaguza'),
		'purple' => __('Purple','jaguza'),
		'royalblue' => __('Royal Blue','jaguza')
		);
	
	//Social icons position array
		$social_icons_position_array = array(
		'left' => __('Left','jaguza'),
		'right' => __('Right','jaguza')		
		);
		
	//Heading Font Size Options
	$heading_font_size_options = array(
		"size" => "9px"
	);
		
	// Typography Options
	$typography_options = array(
		"sizes" => array( "6","12","14","16","20" ),
		"faces" => array( "Helvetica Neue" => "Helvetica Neue","Arial" => "Arial" ),
		"styles" => array( "normal" => "Normal","bold" => "Bold" ),
		"color" => false
	);
	
		/*END Jaguza Defaults*/
		
		//Access the WordPress Categories via an Array
		$jaguza_categories = array();  
		$jaguza_categories_obj = get_categories('hide_empty=0');
		foreach ($jaguza_categories_obj as $jaguza_cat) {
		    $jaguza_categories[$jaguza_cat->cat_ID] = $jaguza_cat->cat_name;}
		$categories_tmp = array_unshift($jaguza_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$jaguza_pages = array();
		$jaguza_pages_obj = get_pages('sort_column=post_parent,menu_order');    
		foreach ($jaguza_pages_obj as $jaguza_page) {
		    $jaguza_pages[$jaguza_page->ID] = $jaguza_page->post_name; }
		$jaguza_pages_tmp = array_unshift($jaguza_pages, "Select a page:");       
	
		//Testing 
		$jaguza_of_options_select = array("one","two","three","four","five"); 
		$jaguza_of_options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$jaguza_of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" => "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = Jaguza_LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}


		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads = get_option('of_uploads');
		$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$jaguza_of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$jaguza_of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $jaguza_of_options;
$jaguza_of_options = array();

/*Heading one: General*/
$jaguza_of_options[] = array( "name" =>  __("General","jaguza"),
					"type" => "heading");
					
	//The favicon
	$jaguza_of_options[] = array(
		"name" =>  "Custom Favicon",
		"desc" => "Upload or enter a URL of a 16px X 16 px ico/png/gif image that will represent your website's favicon",
		"id" => "jaguza_favicon",
		"type" => "upload");
	
	//sidebar position
	$jaguza_of_options[] = array(
		"name" =>  "Sidebar Position",
		"desc" => "Sidebar position on inner pages",
		"id" => "jaguza_sidebar_position",
		"std" => "right",
		"type" => "select",
		//"class" => "mini", //mini, tiny, small
		"options" => $sidebar_position_array);
	
	//Show 'Back to Top' button
		$jaguza_of_options[] = array(
		"name" =>  "Show 'Back To Top' Button",
		"desc" => "Show/Hide 'Back To Top' Button on all pages",
		"id" => "jaguza_show_back2Top",
		"std" => "1",
		"type" => "checkbox");
	
	//Number of posts per page on homepage
		$jaguza_of_options[] = array(
		"name" =>  "Number of posts per page",
		"desc" => "The number of posts to show on the homepage",
		"id" => "jaguza_number_of_homepagePost_items",
		"std" => "10",
		"class" => "mini",
		"type" => "text");
	
	
	//Google Analytics tracking code
	$jaguza_of_options[] = array(
		"name" =>  "Google Analytics Tracking ID",
		"desc" => "Paste your Google Analytics tracking ID (e.g. \"UA-XXXXXX-X\") here",
		"id" => "jaguza_tracking_code",
		"std" => "",
		"type" => "text");
	                                                       
    
/*Heading three: Header*/
$jaguza_of_options[] = array( "name" =>  __("Header","jaguza"),
                    "type" => "heading");

	//Show logo
		$jaguza_of_options[] = array(
		"name" =>  "Show Logo",
		"desc" => "Show/Hide Logo. If logo isn't shown, the blog name will be shown instead",
		"id" => "jaguza_show_logo",
		"std" => "0",
		"folds" => 1,
		"type" => "checkbox");
		
		//The Logo
	$jaguza_of_options[] = array(
		"name" =>  __("Logo","jaguza"),
		"desc" => "Upload or enter a URL of an image that will represent your website's logo",
		"id" => "jaguza_logo",
		"std" => "",
		"fold" => "jaguza_show_logo",
		"type" => "upload");
		
		//Logo left margin			
	$jaguza_of_options[] = array(
		"name" =>  "Logo Left Margin",
		"desc" => "(in px)",
		"id" => "jaguza_logo_left_margin",
		"std" => "3px",
		"fold" => "jaguza_show_logo",
		"class" => "mini",
		"type" => "text");
	
		//Logo top margin	
		$jaguza_of_options[] = array(
		"name" =>  "Logo Top Margin",
		"desc" => "(in pixels)",
		"id" => "jaguza_logo_top_margin",
		"std" => "3px",
		"fold" => "jaguza_show_logo",
		"class" => "mini",
		"type" => "text");
	
		//Logo bottom margin		
		$jaguza_of_options[] = array(
		"name" =>  "Logo Bottom Margin",
		"desc" => "(in pixels)",
		"id" => "jaguza_logo_bottom_margin",
		"std" => "5px",
		"fold" => "jaguza_show_logo",
		"class" => "mini",
		"type" => "text");
	
		//Enable breadcrumbs
		$jaguza_of_options[] = array(
		"name" =>  "Enable Breadcrumbs",
		"desc" => "Turn breadcrumbs on/off",
		"id" => "jaguza_enable_breadcrumbs",
		"std" => 1,
		"type" => "checkbox");
					
                                                    
/*Heading four: Slider*/
	$jaguza_of_options[] = array(
		"name" =>  __("Slider","jaguza"),
		"type" => "heading" );
	
	//Slider category
	$jaguza_of_options[] = array(
		"name" =>  "Select Slider Category",
		"desc" => "The slider on the homepage will be populated by items from this category. If left blank, the latest posts on your site will be shown",
		"id" => "jaguza_slider_category",
		"fold" => "jaguza_enable_slider",
		"type" => "select",
		"options" => $jaguza_categories);
	
	//Number of slider items	
		$jaguza_of_options[] = array(
		"name" =>  "Number of Slider items",
		"desc" => "The number of items to show in the homepage slider",
		"id" => "jaguza_number_of_slider_items",
		"std" => "10",
		"fold" => "jaguza_enable_slider",
		"class" => "mini",
		"type" => "text");
		
		
		//Slider fallback image
		$jaguza_of_options[] = array(
		"name" =>  "Slider fallback image",
		"desc" => "Image to use for a post in the slider in case the post does not contain an image uploaded using wp media uploader. This will only work if your WordPress version is >= 3.5",
		"id" => "jaguza_slider_fallback_image",
		"fold" => "jaguza_enable_slider",
		"type" => "upload");	
		
		//Slider item image Full Width  
		$jaguza_of_options[] = array(
		"name" =>  "Enable slider item image Full width mode",
		"desc" => "If enabled, slider item images fill the entire background of the slider. Use if all slider item images are large (width >= 980px, height >= 380px)",
		"id" => "jaguza_slider_item_img_FullWidth",
		"fold" => "jaguza_enable_slider",
		"std" => "0",
		"type" => "checkbox");
	
		//Excerpt length
	$jaguza_of_options[] = array(
		"name" =>  "Excerpt length",
		"desc" => "Number of words to use in the slider excerpt",
		"id" => "jaguza_slider_excerpt_length",
		"fold" => "jaguza_enable_slider",
		"std" => "25",
		"class" => "mini",
		"type" => "text");
	
	//Read more text		
	$jaguza_of_options[] = array(
		"name" =>  "Read more text",
		"desc" => "Text to use for the \"Read More\" link",
		"id" => "jaguza_slider_read_more",
		"fold" => "jaguza_enable_slider",
		"std" => "Read More +",
		"type" => "text");
	

	//Enable Slider
		$jaguza_of_options[] = array(
		"name" =>  "Enable Slider",
		"desc" => "Enable/Disable the Slider",
		"id" => "jaguza_enable_slider",
		"std" => "1",
		"folds" => 1,
		"type" => "checkbox");
	
		/*Heading five: Typography*/
	$jaguza_of_options[] = array(
		"name" =>  __("Typography","jaguza"),
		"type" => "heading" );
	
	//Body typography
	$jaguza_of_options[] = array( "name" =>  "Body Typography",
		"desc" => "",
		"id" => "jaguza_body_typography",
		"std" => $typography_defaults,
		"type" => "typography" );
	
	//Menu typography
	$jaguza_of_options[] = array( "name" =>  "Menu Typography",
		"desc" => "",
		"id" => "jaguza_menu_typography",
		"std" => $typography_defaults,
		"type" => "typography" );
	
	//Breadcrumbs typography
	$jaguza_of_options[] = array( "name" =>  "Breadcrumbs Typography",
		"desc" => "",
		"id" => "jaguza_breadcrumbs_typography",
		"std" => $typography_defaults,
		"type" => "typography" );
	
	//Footer typography
	$jaguza_of_options[] = array( "name" =>  "Footer Typography",
		"desc" => "",
		"id" => "jaguza_footer_typography",
		"std" => $typography_defaults,
		"type" => "typography" );
	
	//Link Color		
		$jaguza_of_options[] = array(
		"name" =>  "Link Color",
		"desc" => "",
		"id" => "jaguza_link_color",
		"std" => "",
		"type" => "color" );
	
	//Headings Typography		
	$jaguza_of_options[] = array(
		"name" =>  "Headings Typography",
		"desc" => "",
		"id" => "jaguza_headings_typography",
		"std" => $heading_options,
		"type" => "typography"
		);
	
	//Headings font size H1(px)
		$jaguza_of_options[] = array(
		"name" =>  "Headings font size H1(px)",
		"desc" => "",
		"id" => "jaguza_headings_font_size_h1",
		"std" => $heading_font_size_options,
		"type" => "typography"
		 );
		
		//Headings font size H2(px)
		$jaguza_of_options[] = array(
		"name" =>  "Headings font size H2(px)",
		"desc" => "",
		"id" => "jaguza_headings_font_size_h2",
		"std" => $heading_font_size_options,
		"type" => "typography"
		 );
			
			//Headings font size H3(px)
		$jaguza_of_options[] = array(
		"name" =>  "Headings font size H3(px)",
		"desc" => "",
		"id" => "jaguza_headings_font_size_h3",
		"std" => $heading_font_size_options,
		"type" => "typography"
		 );
		
			//Headings font size H4(px)
		$jaguza_of_options[] = array(
		"name" =>  "Headings font size H4(px)",
		"desc" => "",
		"id" => "jaguza_headings_font_size_h4",
		"std" => $heading_font_size_options,
		"type" => "typography"
		 );
		
			//Headings font size H5(px)
		$jaguza_of_options[] = array(
		"name" =>  "Headings font size H5(px)",
		"desc" => "",
		"id" => "jaguza_headings_font_size_h5",
		"std" => $heading_font_size_options,
		"type" => "typography"
		 );
		
			//Headings font size H6(px)
		$jaguza_of_options[] = array(
		"name" =>  "Headings font size H6(px)",
		"desc" => "",
		"id" => "jaguza_headings_font_size_h6",
		"std" => $heading_font_size_options,
		"type" => "typography"
		 );
 
 /*Heading six: Styling*/
$jaguza_of_options[] = array( "name" =>  __("Styling","jaguza"),
					"type" => "heading");



	
	 
	
	//Theme color: orange,green,blue
	$jaguza_of_options[] = array(
		"name" =>  "Theme Color",
		"desc" => "",
		"id" => "jaguza_theme_color",
		"type" => "select",
		"std" => "Blue",
		"options" => $theme_color_array);
	
	//Custom theme color
	$jaguza_of_options[] = array(
		"name" =>  "Custom Theme Color",
		"desc" => "<strong>Note:</strong> This overrides the above 'Theme Color' option. Leave blank to use 'Theme Color'",
		"id" => "jaguza_theme_color_custom",
		"std" => "",
		"type" => "color" );
	
	//Custom CSS
	$jaguza_of_options[] = array( "name" => "Custom CSS",
                    "desc" => "Paste your CSS Code. Do not include HTML tags.",
                    "id" => "jaguza_custom_css",
                    "std" => "",
                    "type" => "textarea");

					



	/*Heading seven: Social*/
	$jaguza_of_options[] = array(
		"name" =>  "Social icons",
		"type" => "heading" );
	
	//Show social icons
		$jaguza_of_options[] = array(
		"name" =>  "Show Social Icons",
		"desc" => "Show/Hide Social Icons",
		"id" => "jaguza_show_social_icons",
		"std" => "1",
		"folds" => "1",
		"type" => "checkbox");
		
	//Social icons position
	$jaguza_of_options[] = array(
		"name" =>  "Social Icons Position",
		"desc" => "",
		"id" => "jaguza_social_icons_position",
		"std" => "Left",
		"fold" => "jaguza_show_social_icons",
		"type" => "select",
		"options" => $social_icons_position_array);
	
	//Social icons help info
	$jaguza_of_options[] = array( "name" =>  __("Help","jaguza"),
					"desc" => "",
					"id" => "social_icons_help",
					"std" => "For any of the sites below, enter a link to use it or leave it blank to remove it. Start all links with http://",
					"fold" => "jaguza_show_social_icons",
					"icon" => true,
					"type" => "info");
	
	//Facebook		
	$jaguza_of_options[] = array(
		"name" =>  __("Facebook","jaguza"),
		"desc" => "",
		"id" => "jaguza_facebook_link",
		"std" => "#",
		"fold" => "jaguza_show_social_icons",
		"type" => "text");
	
	//Twitter		
	$jaguza_of_options[] = array(
		"name" =>  __("Twitter","jaguza"),
		"desc" => "",
		"id" => "jaguza_twitter_link",
		"std" => "#",
		"fold" => "jaguza_show_social_icons",
		"type" => "text");
	
	//Google+		
	$jaguza_of_options[] = array(
		"name" =>  "Google+",
		"desc" => "",
		"id" => "jaguza_googleplus_link",
		"std" => "#",
		"fold" => "jaguza_show_social_icons",
		"type" => "text");
	
	//Reddit		
	$jaguza_of_options[] = array(
		"name" =>  __("Reddit","jaguza"),
		"desc" => "",
		"id" => "jaguza_reddit_link",
		"std" => "#",
		"fold" => "jaguza_show_social_icons",
		"type" => "text");
	
	//LinkedIn		
	$jaguza_of_options[] = array(
		"name" =>  __("LinkedIn","jaguza"),
		"desc" => "",
		"id" => "jaguza_linkedin_link",
		"std" => "#",
		"fold" => "jaguza_show_social_icons",
		"type" => "text");
	
	//Tumblr		
	$jaguza_of_options[] = array(
		"name" =>  __("Tumblr","jaguza"),
		"desc" => "",
		"id" => "jaguza_tumblr_link",
		"std" => "#",
		"fold" => "jaguza_show_social_icons",
		"type" => "text");
	
	//Youtube		
	$jaguza_of_options[] = array(
		"name" =>  __("YouTube","jaguza"),
		"desc" => "",
		"id" => "jaguza_youtube_link",
		"std" => "#",	
		"fold" => "jaguza_show_social_icons",
		"type" => "text");
	
	//Flickr		
	$jaguza_of_options[] = array(
		"name" =>  __("Flickr","jaguza"),
		"desc" => "",
		"id" => "jaguza_flickr_link",
		"std" => "#",	
		"fold" => "jaguza_show_social_icons",
		"type" => "text");
	
	//RSS		
	$jaguza_of_options[] = array(
		"name" =>  __("RSS","jaguza"),
		"desc" => "",
		"id" => "jaguza_rss_link",
		"std" => "#",
		"fold" => "jaguza_show_social_icons",
		"type" => "text");
	
			
// Backup Options
$jaguza_of_options[] = array( "name" => "Backup Options",
					"type" => "heading");
					
$jaguza_of_options[] = array( "name" => "Backup and Restore Options",
                    "id" => "of_backup",
                    "std" => "",
                    "type" => "backup",
					"desc" => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
					);
					
$jaguza_of_options[] = array( "name" => "Transfer Theme Options Data",
                    "id" => "of_transfer",
                    "std" => "",
                    "type" => "transfer",
					"desc" => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".
						',
					);

/*Heading eleven: Help*/
//Help
$jaguza_of_options[] = array( "name" =>  __("Help","jaguza"),
					"type" => "heading");

$jaguza_of_options[] = array( "name" => "Jaguza Help",
					"desc" => "",
					"id" => "jaguza_help",
					"std" => "",
					"icon" => true,
					"type" => "rss");
					
	}
}
?>
