<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Site Front Page
 *
 * Note: You can overwrite front-page.php as well as any other Template in Child Theme.
 * Create the same file (name) include in /responsive-child-theme/ and you're all set to go!
 * @see            http://codex.wordpress.org/Child_Themes and
 *                 http://themeid.com/forum/topic/505/child-theme-example/
 *
 * @file           front-page.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2013 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/front-page.php
 * @link           http://codex.wordpress.org/Template_Hierarchy
 * @since          available since Release 1.0
 */

/**
 * Globalize Theme Options
 */
$responsive_options = responsive_get_options();
/**
 * If front page is set to display the
 * blog posts index, include home.php;
 * otherwise, display static front page
 * content
 */
if ( 'posts' == get_option( 'show_on_front' ) && $responsive_options['front_page'] != 1 ) {
	get_template_part( 'home' );
} elseif ( 'page' == get_option( 'show_on_front' ) && $responsive_options['front_page'] != 1 ) {
	$template = get_post_meta( get_option( 'page_on_front' ), '_wp_page_template', true );
	$template = ( $template == 'default' ) ? 'index.php' : $template;
	locate_template( $template, true );
} else { 

	get_header();
	
	//test for first install no database
	$db = get_option( 'responsive_theme_options' );
    //test if all options are empty so we can display default text if they are
    $empty = ( empty( $responsive_options['home_headline'] ) && empty( $responsive_options['home_subheadline'] ) && empty( $responsive_options['home_content_area'] ) ) ? false : true;
	?>

	<div id="featured" class="grid col-940">

        <div class="html_carousel">
            <div id="foo2">
                <div class="slide">
                    <img src="<?php echo content_url()?>/uploads/header_slider_images/DSC_5482.jpg" alt="carousel 1"/>
                    <div>
                        <h4>Text epic 1</h4>
                        <p>Descriere text epic 1</p>
                    </div>
                </div>
                <div class="slide">
                    <img src="<?php echo content_url()?>/uploads/header_slider_images/DSC_5522.jpg" alt="carousel 2"/>
                    <div>
                        <h4>Text epic 2</h4>
                        <p>Descriere text epic 2</p>
                    </div>
                </div>
            </div>
            <a class="prev" id="foo2_prev" href="#"><span>prev</span></a>
            <a class="next" id="foo2_next" href="#"><span>next</span></a>
            <div class="clearfix"></div>
        </div>
        
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $("#foo2").carouFredSel({
                    responsive  : true,
                    scroll      : {
                        fx          : "crossfade",
                        easing      : "linear",
                        duration    : 750
                    },
                    items       : {
                        width       : 1400,
                        height      : 467,
                        visible     : 1
                    },
                    prev : "#foo2_prev",
                    next : "#foo2_next"

                });
               
            });
        </script>
	
		<div class="grid col-460">

			<!--h1 class="featured-title">
				<?php
				if ( isset( $responsive_options['home_headline'] ) && $db && $empty )
					echo $responsive_options['home_headline'];
				else
					_e( 'Hello, World!', 'responsive' );
				?>
			</h1-->
			
			<h2 class="featured-subtitle">
				<?php
				if ( isset( $responsive_options['home_subheadline'] ) && $db && $empty )
					echo $responsive_options['home_subheadline'];
				else
					_e( 'Your H2 subheadline here', 'responsive' );
				?>
			</h2>
			
			<p>
				<?php
				if ( isset( $responsive_options['home_content_area'] ) && $db && $empty )
					echo do_shortcode( $responsive_options['home_content_area'] );
				else
					_e( 'Your title, subtitle and this very content is editable from Theme Option. Call to Action button and its destination link as well. Image on your right can be an image or even YouTube video if you like.','responsive' );
				?>
			</p>
			
			<?php if ($responsive_options['cta_button'] == 0): ?>  
   
				<div class="call-to-action">

					<a href="<?php echo $responsive_options['cta_url']; ?>" class="blue button">
						<?php 
						if( isset( $responsive_options['cta_text'] ) && $db && $empty )
							echo $responsive_options['cta_text']; 
						else
							_e('Call to Action','responsive');
						?>
					</a>
				
				</div><!-- end of .call-to-action -->

			<?php endif; ?>         
			
		</div><!-- end of .col-460 -->

		<div id="featured-image" class="grid col-460 fit">
		  
		  <?php $featured_content = ( !empty( $responsive_options['featured_content'] ) ) ? $responsive_options['featured_content'] : '<img class="aligncenter" src="' . get_template_directory_uri() . '/core/images/featured-image.png" width="440" height="300" alt="" />'; ?>
							
			<?php echo do_shortcode( $featured_content ); ?>
									
		</div><!-- end of #featured-image --> 
	
	</div><!-- end of #featured -->
               
	<?php 
	get_sidebar('home');
	get_footer(); 
}
?>
