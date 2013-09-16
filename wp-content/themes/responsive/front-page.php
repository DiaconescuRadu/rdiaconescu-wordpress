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
/*                $("#img_container").masonry ({  // options
                     columnWidth: 420,
                     itemSelector: '.tile_img_container'
                });*/
                $(window).load(function(){ $('#img_container').masonry({
                     columnWidth: 420,
                     itemSelector: '.tile_img_container'
                }); });
            });
        </script>
	
		<div class="grid col-940 tile_cont" id="img_container">
                <?php
                    $args = array( 'numberposts' => '20' );
                    $recent_posts = wp_get_recent_posts( $args );
                    foreach( $recent_posts as $recent ){
                        echo '<div class="tile_img_container">';
                        echo '<a href="' . get_permalink($recent["ID"]) . '" title="Look '.esc_attr($recent["post_title"]).'" >';
                        if (has_post_thumbnail($recent['ID'])) {
                            echo get_the_post_thumbnail($recent['ID'], 'large');
                        }
                        else {
                            echo '<div class="placeholder">';
                            echo '</div>';
                        }
                        echo '</a>';
                        echo '<h2>' . $recent["post_title"] . '</h2>';
                        echo '</div>';
                    }
                ?>
	</div><!-- end of .col-940 -->
	</div><!-- end of #featured -->
               
	<?php 
	get_sidebar('home');
	get_footer(); 
}
?>
