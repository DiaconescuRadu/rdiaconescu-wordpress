<?php
/**
 * The Theme Options page
 *
 * This page is implemented using the Settings API
 * http://codex.wordpress.org/Settings_API
 * Big thanks to Chip Bennett for the great article on how to implement the Settings API
 * http://www.chipbennett.net/2011/02/17/incorporating-the-settings-api-in-wordpress-themes/
 * 
 * @file      theme-options.php
 * @package   curiosity
 * @author    Sami Ch.
 * @link 	  http://gazpo.com
 */

 /**
 * Properly enqueue styles and scripts for our theme options page.
 * This function is attached to the admin_enqueue_scripts action hook.
 * @since Twenty Eleven 1.0
 *
 */
 
function curiosity_admin_enqueue_scripts( $hook_suffix ) {
	wp_enqueue_style( 'curiosity_theme_options', get_template_directory_uri() . '/settings/theme-options.css', false, '1.0' );
	wp_enqueue_script( 'curiosity_theme_options', get_template_directory_uri() . '/settings/theme-options.js', array( 'jquery' ), '1.0' );
}
add_action( 'admin_print_styles-appearance_page_theme_options', 'curiosity_admin_enqueue_scripts' );


global $pagenow;
if( ( 'themes.php' == $pagenow ) && ( isset( $_GET['activated'] ) && ( $_GET['activated'] == 'true' ) ) ) :


/**
 * Set default options on activation
 */
function curiosity_init_options() {
	$options = get_option( 'curiosity_options' );
	if ( false === $options ) {
		$options = curiosity_default_options();
	}
	update_option( 'curiosity_options', $options );
}

add_action( 'after_setup_theme', 'curiosity_init_options', 9 );
endif;

/**
 * Register the theme options setting
 */
function curiosity_register_settings() {
	register_setting( 'curiosity_options', 'curiosity_options', 'curiosity_validate_options' );	
}
add_action( 'admin_init', 'curiosity_register_settings' );

/**
 * Register the options page
 */
function curiosity_theme_add_page() {
	add_theme_page( __( 'Theme Options', 'curiosity' ), __( 'Theme Options', 'curiosity' ), 'edit_theme_options', 'theme_options', 'curiosity_theme_options_page' );
}
add_action( 'admin_menu', 'curiosity_theme_add_page');

/**
 * Set custom RSS feed links.
 *
 */
function curiosity_custom_feed( $output, $feed ) {
	$options = get_option('curiosity_options');
	$url = $options['rss_url'];	
	if ( $url ) {
		$outputarray = array( 'rss' => $url, 'rss2' => $url, 'atom' => $url, 'rdf' => $url, 'comments_rss2' => '' );
		$outputarray[$feed] = $url;
		$output = $outputarray[$feed];
	}
	return $output;
}
add_filter( 'feed_link', 'curiosity_custom_feed', 1, 2 );

/**
 * Set custom Favicon.
 *
 */
function curiosity_custom_favicon() {
	$options = get_option('curiosity_options');
	$favicon_url = $options['favicon_url'];	
	
    if (!empty($favicon_url)) {
		echo '<link rel="shortcut icon" href="'. $favicon_url. '" />	'. "\n";
	}
}

add_action('wp_head', 'curiosity_custom_favicon');

/**
 * Set custom CSS.
 *
 */
function curiosity_inline_css() {
    $options = get_option('curiosity_options');
	$inline_css = $options['inline_css'];
    if (!empty($inline_css)) {
		echo '<!-- Custom CSS Styles -->' . "\n";
        echo '<style type="text/css" media="screen">' . "\n";
		echo $inline_css . "\n";
		echo '</style>' . "\n";
	}
}
add_action('wp_head', 'curiosity_inline_css');


/**
 * Add tracking code in the footer.
 *
 */
function curiosity_stats_tracker() {
    $options = get_option('curiosity_options');
	$stats_tracker = $options['stats_tracker'];
    if (!empty($stats_tracker)) {
        echo $stats_tracker;
	}
}
add_action('wp_footer', 'curiosity_stats_tracker');

/**
 * Set meta description.
 *
 */
function curiosity_meta_desc() {
    $options = get_option('curiosity_options');
	$meta_desc = $options['meta_desc'];
    
	if (!empty($meta_desc)) {
		echo '<meta name="description" content=" '. $meta_desc .'"  />' . "\n";
	}
}
add_action('wp_head', 'curiosity_meta_desc');


/**
 * Set Google site verfication code
 *
 */
function curiosity_google_verification() {
    $options = get_option('curiosity_options');
	$google_verification = $options['google_verification'];
   
   if (!empty($google_verification)) {
		echo '<meta name="google-site-verification" content="' . $google_verification . '" />' . "\n";
	}
}
add_action('wp_head', 'curiosity_google_verification');


/**
 * Set Bing site verfication code
 *
 */
function curiosity_bing_verification() {	
    $options = get_option('curiosity_options');
	$bing_verification = $options['bing_verification'];	
	
    if (!empty($bing_verification)) {
        echo '<meta name="msvalidate.01" content="' . $bing_verification . '" />' . "\n";
	}
}
add_action('wp_head', 'curiosity_bing_verification');


/**
 * Output the options page
 */
function curiosity_theme_options_page() { ?>
	
	<div id="gazpo-admin" class="wrap"> 		
			<div class="header">	
				<div class="gazpo-logo">
					<a href="<?php echo esc_url(__('http://gazpo.com/', 'curiosity')); ?>" title="<?php _e('Visit gazpo.com', 'curiosity'); ?>" target="_blank">
						<img src="<?php echo get_template_directory_uri(); ?>/settings/images/logo.png" alt="gazpo.com" />
					</a>
				</div>	
				
				<div class="theme-info">		
					<h3>Curiosity Theme</h3>			
					<ul>
						<li class="docs">
							<a href="<?php echo esc_url(__('http://gazpo.com/2012/12/curiosity/', 'curiosity')); ?>" title="<?php _e('Theme Support', 'curiosity'); ?>" target="_blank"><?php printf(__('Theme Home', 'curiosity')); ?></a>
						</li>
						
						<li class="support">
							<a href="<?php echo esc_url(__('http://forums.gazpo.com/', 'curiosity')); ?>" title="<?php _e('Contact', 'curiosity'); ?>" target="_blank"><?php printf(__('Support', 'curiosity')); ?></a>
						</li>				
					</ul>
				</div>
			</div><!-- /header -->
			
			<div class="options-form">
			
				<?php $theme_name = function_exists('wp_get_theme') ? wp_get_theme() : ''; ?>
				<?php screen_icon(); echo "<h2>" . $theme_name ." ". __('Theme Options', 'curiosity') . "</h2>"; ?>
					
					<?php if ( isset( $_GET['settings-updated'] ) ) : ?>
						<div class="updated fade"><p><?php _e('Theme settings updated successfully', 'curiosity'); ?></p></div>
					<?php endif; ?>
				
					<form action="options.php" method="post">
						
						<?php settings_fields( 'curiosity_options' ); ?>
						<?php $options = get_option('curiosity_options'); ?>		
			
						<div class="options_blocks">
					
					<h3 class="block_title"><a href="#"><?php _e('Homepage Settings', 'curiosity'); ?></a></h3>
					<div class="block">
											 
						<div class="field">
							<label for="curiosity_options[logo_url]"><?php _e('Logo URL:', 'curiosity'); ?></label>
							<input id="curiosity_options[logo_url]" name="curiosity_options[logo_url]" type="text" value="<?php echo esc_attr($options['logo_url']); ?>" />
							
							<span><?php _e( 'Enter full URL of logo image starting with <strong>http:// </strong>.', 'curiosity' ); ?></span>
						</div>
						
						<div class="field">
							<label for="curiosity_options[favicon_url]"><?php _e('Favicon URL', 'curiosity'); ?></label>
							<input id="curiosity_options[favicon_url]" name="curiosity_options[favicon_url]" type="text" value="<?php echo esc_attr($options['favicon_url']); ?>" />
							
							<span><?php _e( 'Enter full URL of favicon image starting with <strong>http:// </strong>.', 'curiosity' ); ?></span>
						</div>
						
						<div class="field">
							<label for="curiosity_options[rss_url]"><?php _e('Custom RSS URL', 'curiosity'); ?></label>
							<input id="curiosity_options[rss_url]" name="curiosity_options[rss_url]" type="text" value="<?php echo esc_attr($options['rss_url']); ?>" />
							<span><?php _e( 'Enter full URL of RSS Feeds link starting with <strong>http:// </strong>. Leave blank to use default RSS Feeds.', 'curiosity' ); ?></span>
						</div>
						
						<div class="field">
							<label for="curiosity_options[show_slider]"><?php _e('Enable Slider', 'curiosity'); ?></label>
							<input id="curiosity_options[show_slider]" name="curiosity_options[show_slider]" type="checkbox" value="1" <?php isset($options['show_slider']) ? checked( '1', $options['show_slider'] ) : checked('0', '1'); ?> />							
							<span><?php _e( 'Check to enable the slider on homepage.', 'curiosity' ); ?></span>
						</div>
						
						<div class="field">														
							<label for="curiosity_options[slider_category]"><?php _e('Slider Category', 'curiosity'); ?></label>
							<?php 
							$categories = get_categories( array( 'hide_empty' => 1, 'hierarchical' => 0 ) );  ?>
							<select id="slider_category" name="curiosity_options[slider_category]">
								<option <?php selected( 0 == $options['slider_category'] ); ?> value="0"><?php _e( '--none--', 'curiosity' ); ?></option>
								<?php foreach( $categories as $category ) : ?>
								<option <?php selected( $category->term_id == $options['slider_category'] ); ?> value="<?php echo $category->term_id; ?>"><?php echo $category->cat_name; ?></option>
								<?php endforeach; ?>
							</select>						
							 <span><?php _e( 'Select the category for the slider. Select <strong>none</strong> to show latest posts.', 'curiosity' ); ?></span>					
						</div>
						
						<div class="field">
							<label for="curiosity_options[show_carousel]"><?php _e('Enable Carousel', 'curiosity'); ?></label>
							<input id="curiosity_options[show_carousel]" name="curiosity_options[show_carousel]" type="checkbox" value="1" <?php isset($options['show_carousel']) ? checked( '1', $options['show_carousel'] ) : checked('0', '1'); ?> />
							<span><?php _e( 'Check to enable the carousel on homepage.', 'curiosity' ); ?></span>					
						</div>
	
						<div class="field">														
							<label for="curiosity_options[carousel_category]"><?php _e('Carousel Category', 'curiosity'); ?></label>
							<?php 
							$categories = get_categories( array( 'hide_empty' => 1, 'hierarchical' => 0 ) );  ?>
							<select id="carousel_category" name="curiosity_options[carousel_category]">
								<option <?php selected( 0 == $options['carousel_category'] ); ?> value="0"><?php _e( '--none--', 'curiosity' ); ?></option>
								<?php foreach( $categories as $category ) : ?>
								<option <?php selected( $category->term_id == $options['carousel_category'] ); ?> value="<?php echo $category->term_id; ?>"><?php echo $category->cat_name; ?></option>
								<?php endforeach; ?>
							</select>						
							 <span><?php _e( 'Select the category for the carousel. Select <strong>none</strong> to show latest posts.', 'curiosity' ); ?></span>				
						</div>						
						
						<div class="field">
							<label for="curiosity_options[show_social_buttons]"><?php _e('Social Media', 'curiosity'); ?></label>
							<input id="curiosity_options[show_social_buttons]" name="curiosity_options[show_social_buttons]" type="checkbox" value="1" <?php isset($options['show_social_buttons']) ? checked( '1', $options['show_social_buttons'] ) : checked('0', '1'); ?> />
							<span><?php _e( 'Check to enable Twitter and Facebook button in posts.', 'curiosity' ); ?></span>
						</div>
						
						<div class="submit">
							<input type="submit" name="curiosity_options[submit]" class="button-primary" value="<?php _e( 'Save Settings', 'curiosity' ); ?>" />
                        </div>
						
					</div><!-- /block -->
					
					<h3 class="block_title"><a href="#"><?php _e('Post and Page Settings', 'curiosity'); ?></a></h3>
					<div class="block">
						
						<div class="field">
							<label for="curiosity_options[show_author]"><?php _e('Display Author Info', 'curiosity'); ?></label>
							 <input id="curiosity_options[show_author]" name="curiosity_options[show_author]" type="checkbox" value="1" <?php isset($options['show_author']) ? checked( '1', $options['show_author'] ) : checked('0', '1'); ?> />
							<span><?php _e( 'Check to display the author information in the post.', 'curiosity' ); ?></span>
						</div>
						
						<div class="field">
							<label for="curiosity_options[show_page_comments]"><?php _e('Enable comments on pages', 'curiosity'); ?></label>
							 <input id="curiosity_options[show_page_comments]" name="curiosity_options[show_page_comments]" type="checkbox" value="1" <?php isset($options['show_page_comments']) ? checked( '1', $options['show_page_comments'] ) : checked('0', '1'); ?> />
							<span><?php _e( 'Check to enable the comments on pages.', 'curiosity' ); ?></span>
						</div>
						
						<div class="field">
							<label for="curiosity_options[show_media_comments]"><?php _e('Enable comments on media', 'curiosity'); ?></label>
							 <input id="curiosity_options[show_media_comments]" name="curiosity_options[show_media_comments]" type="checkbox" value="1" <?php isset($options['show_media_comments']) ? checked( '1', $options['show_media_comments'] ) : checked('0', '1'); ?> />
							<span><?php _e( 'Check to enable the comments on media posts.', 'curiosity' ); ?></span>
						</div>									
						
						<div class="submit">
							<input type="submit" name="curiosity_options[submit]" class="button-primary" value="<?php _e( 'Save Settings', 'curiosity' ); ?>" />
                        </div>
					
					</div><!-- /block -->
					
					<h3 class="block_title"><a href="#"><?php _e('Ads and Custom Styles', 'curiosity'); ?></a></h3>
					<div class="block">
						
						<div class="field">
							<label for="curiosity_options[ad468]"><?php _e('Header ad code.', 'curiosity'); ?></label>
							 <textarea id="curiosity_options[ad468]" class="textarea" cols="50" rows="30" name="curiosity_options[ad468]"><?php echo esc_attr($options['ad468']); ?></textarea>
							  <span><?php _e( 'Enter complete code for header ad.', 'curiosity' ); ?></span>							
						</div>
						
						<div class="field">
							<label for="curiosity_options[inline_css]"><?php _e('Enter your custom CSS styles.', 'curiosity'); ?></label>
							 <textarea id="curiosity_options[inline_css]" class="textarea" cols="50" rows="30" name="curiosity_options[inline_css]"><?php echo esc_attr($options['inline_css']); ?></textarea>
							 <span><?php _e( 'You can enter custom CSS styles. It will overwrite the default style.', 'curiosity' ); ?></span>
						</div>
						
						<div class="submit">
							<input type="submit" name="curiosity_options[submit]" class="button-primary" value="<?php _e( 'Save Settings', 'curiosity' ); ?>" />
                        </div>
					
					</div><!-- /block -->
					
					<h3 class="block_title"><a href="#"><?php _e('Webmaster Tools', 'curiosity'); ?></a></h3>
					<div class="block">
						
						<div class="field">
							<label for="curiosity_options[meta_desc]"><?php _e('Meta Description', 'curiosity'); ?></label>
							<textarea id="curiosity_options[meta_desc]" class="textarea" cols="50" rows="10" name="curiosity_options[meta_desc]"><?php echo esc_attr($options['meta_desc']); ?></textarea>
							<span><?php _e( 'A short description of your site for the META Description tag. Keep it less than 149 characters.', 'curiosity' ); ?></span>
						</div>
						
						<div class="field">
							<label for="curiosity_options[stats_tracker]"><?php _e('Statistics Tracking Code', 'curiosity'); ?></label>
							<textarea id="curiosity_options[stats_tracker]" class="textarea" cols="50" rows="10" name="curiosity_options[stats_tracker]"><?php echo esc_attr($options['stats_tracker']); ?></textarea>
							<span><?php _e( 'If you want to add any tracking code (eg. Google Analytics). It will appear in the header of the theme.', 'curiosity' ); ?></span>
						</div>
						
						<div class="field">
							<label for="curiosity_options[google_verification]"><?php _e('Google Site Verification', 'curiosity'); ?></label>
							<input id="curiosity_options[google_verification]" type="text" name="curiosity_options[google_verification]" value="<?php echo esc_attr($options['google_verification']); ?>" />
							<span><?php _e( 'Enter your ID only.', 'curiosity' ); ?></span>
						</div>
						
						<div class="field">
							<label for="curiosity_options[bing_verification]"><?php _e('Bing Site Verification', 'curiosity'); ?></label>
							<input id="curiosity_options[bing_verification]" type="text" name="curiosity_options[bing_verification]" value="<?php echo esc_attr($options['bing_verification']); ?>" />
							<span><?php _e( 'Enter the ID only. <strong>Yahoo</strong> search is powered by Bing, so it will be automatically verified by Yahoo as well.', 'curiosity' ); ?></span>
						</div>
						
						<div class="submit">
							<input type="submit" name="curiosity_options[submit]" class="button-primary" value="<?php _e( 'Save Settings', 'curiosity' ); ?>" />
                        </div>						
						
					</div><!-- /block -->
					
					<h3 class="support_title"><?php _e('Buy our Premium Theme', 'curiosity'); ?></h3>
					<div class="support-block">
						<div class="field">
							<p><strong><?php _e('Did you like this theme?', 'curiosity') ?></strong></p>
							<p><strong><?php _e('Try even more powerful premium theme.', 'curiosity') ?></strong></p>
							<div class="innerwrap">
								<div class="premiumtheme-thumb"><img src=<?php echo get_template_directory_uri().'/settings/images/theme-thumb.png'; ?>></div>
								<div class="premiumtheme-info">
									<p><?php _e( 'Eris is a professional WordPress theme with clean, flexible and fully responsive design. It is ideal for the magazine, news and personal blog sites.', 'curiosity' ); ?></p>
									<p>
										<a href="<?php echo esc_url(__('http://themeforest.net/item/eris-responsive-wordpress-magazine-theme/3278817?ref=wellthemes', 'curiosity')); ?>" target="_blank">
										<?php _e( 'Demo and Purchase link', 'curiosity' ); ?>
										</a>								
									</p>
								</div>
							</div>
						</div>
					</div><!-- /block -->
					
				</div> <!-- /option_blocks -->			
						
						<input type="submit" name="curiosity_options[submit]" class="button-primary" value="<?php _e( 'Save Settings', 'curiosity' ); ?>" />
						<input type="submit" name="curiosity_options[reset]" class="button-secondary" value="<?php _e( 'Reset Defaults', 'curiosity' ); ?>" />
					</form>
		
			</div> <!-- /options-form -->
	</div> <!-- /gazpo-admin -->
	<?php
}

/**
 * Return default array of options
 */
 
function curiosity_default_options() {
	$options = array(
		'logo_url' => get_template_directory_uri().'/images/logo.png',
		'favicon_url' => '',
		'rss_url' => '',
		'show_slider' => 1,
		'slider_category' => 0,
		'show_carousel' => 1,
		'carousel_category'=> 0,
		'show_social_buttons' => 1,
		'show_author' => 1,
		'show_page_comments' => 1,
		'show_media_comments' => 1,
		'ad468' => '<a href='.get_site_url().'><img src='.get_template_directory_uri().'/images/ad468.png /></a>',
		'inline_css' => '',
		'meta_desc' => '',
		'stats_tracker' => '',
		'google_verification' => '',
		'bing_verification' => '',
	);
	return $options;
}

/**
 * Sanitize and validate options
 */
function curiosity_validate_options( $input ) {
	$submit = ( ! empty( $input['submit'] ) ? true : false );
	$reset = ( ! empty( $input['reset'] ) ? true : false );
	if( $submit ) :
	
		$input['logo_url'] = esc_url_raw($input['logo_url']);
		$input['favicon_url'] = esc_url_raw($input['favicon_url']);
		$input['rss_url'] = esc_url_raw($input['rss_url']);
		
		if ( ! isset( $input['show_slider'] ) )
			$input['show_slider'] = null;
			$input['show_slider'] = ( $input['show_slider'] == 1 ? 1 : 0 );
	
		if ( ! isset( $input['show_carousel'] ) )
			$input['show_carousel'] = null;
			$input['show_carousel'] = ( $input['show_carousel'] == 1 ? 1 : 0 );
			
		if ( ! isset( $input['show_author'] ) )
			$input['show_author'] = null;
			$input['show_author'] = ( $input['show_author'] == 1 ? 1 : 0 );
		
		if ( ! isset( $input['show_page_comments'] ) )
			$input['show_page_comments'] = null;
			$input['show_page_comments'] = ( $input['show_page_comments'] == 1 ? 1 : 0 );
		
		if ( ! isset( $input['show_media_comments'] ) )
			$input['show_media_comments'] = null;
			$input['show_media_comments'] = ( $input['show_media_comments'] == 1 ? 1 : 0 );
		
		if ( ! isset( $input['show_social_buttons'] ) )
			$input['show_social_buttons'] = null;
			$input['show_social_buttons'] = ( $input['show_social_buttons'] == 1 ? 1 : 0 );
		
		$input['ad468'] = wp_kses_stripslashes($input['ad468']);
		$input['inline_css'] = wp_kses_stripslashes($input['inline_css']);
		$input['meta_desc'] = wp_kses_stripslashes($input['meta_desc']);
	
		$input['google_verification'] = wp_filter_post_kses($input['google_verification']);
		$input['bing_verification'] = wp_filter_post_kses($input['bing_verification']);
	
		$input['stats_tracker'] = wp_kses_stripslashes($input['stats_tracker']);
	
		$categories = get_categories( array( 'hide_empty' => 0, 'hierarchical' => 0 ) );
		$cat_ids = array();
		foreach( $categories as $category )
			$cat_ids[] = $category->term_id;
			
		if( !in_array( $input['slider_category'], $cat_ids ) && ( $input['slider_category'] != 0 ) )
			$input['slider_category'] = $options['slider_category'];
			
		if( !in_array( $input['carousel_category'], $cat_ids ) && ( $input['carousel_category'] != 0 ) )
			$input['carousel_category'] = $options['carousel_category'];

		return $input;
		
	elseif( $reset ) :
	
		$input = curiosity_default_options();
		return $input;
		
	endif;
}

if ( ! function_exists( 'curiosity_get_option' ) ) :
/**
 * Used to output theme options is an elegant way
 * @uses get_option() To retrieve the options array
 */
function curiosity_get_option( $option ) {
	$options = get_option( 'curiosity_options', curiosity_default_options() );
	return $options[ $option ];
}
endif;