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
                     columnWidth: 415,
                     itemSelector: '.tile_img_container',
                     isFitWidth: true
                }); });
            });
        </script>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
            <div class="html_carousel site_content">
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
            <div class="horizontalRule site_content"></div>
            <i><h3 class="text-center">Recent adventures</h3></i>
            <?php
            $blog_query = new WP_Query( array( 'post_type' => 'post', 'paged' => $paged , 'posts_per_page' => 9, 'category_name' => $cat_name, 'search' => $search));
            list_posts($blog_query);
            wp_reset_postdata();
            ?>  
        </div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
