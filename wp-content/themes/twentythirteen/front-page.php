<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $(window).load(function(){ $('#foo2').carouFredSel({
                    responsive  : true,
                    width       : 1200,
                    scroll      : {
                        fx          : "crossfade",
                        easing      : "linear",
                        duration    : 1500
                    },
                    items       : {
                        width       : 1300,
                        height      : 431,
                        visible     : 1
                    },
                    prev : "#foo2_prev",
                    next : "#foo2_next"
                }); });
                $(window).load(function(){ $('#img_container').masonry({
                     columnWidth: 420,
                     itemSelector: '.tile_img_container',
                     isFitWidth: true
                }); });
            });
        </script>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
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
            <br>
            <div class="masonry" id="img_container">
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
                        echo '<h4 class="h_img_container">' . $recent["post_title"] . '</h4>';
                        echo '</div>';
                    }
                ?>
            </div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
