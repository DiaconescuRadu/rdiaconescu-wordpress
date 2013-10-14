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
                    width       : 1245,
                    scroll      : {
                        fx          : "crossfade",
                        easing      : "linear",
                        duration    : 1000
                    },
                    auto      : {
                        timeoutDuration  : 5000,
                    },
                    items       : {
                        width       : 1245,
                        height      : 415,
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
                        <img src="<?php echo content_url()?>/uploads/header_slider_images/cover_photo_1.jpg" alt="carousel 1"/>
                        <div class="slider_title">
                            <a href=""><h5>Turingia pe bicicleta</h5></a>
                        </div>
                    </div>
                    <div class="slide">
                        <img src="<?php echo content_url()?>/uploads/header_slider_images/cover_photo_2.jpg" alt="carousel 2"/>
                        <div class="slider_title">
                            <a href=""><h5>Turingia pe bicicleta</h5></a>
                        </div>
                   </div>
                   <div class="slide">
                        <img src="<?php echo content_url()?>/uploads/header_slider_images/cover_photo_3.jpg" alt="carousel 2"/>
                        <div class="slider_title">
                            <a href=""><h5>Turingia pe bicicleta</h5></a>
                        </div>
                   </div>
                   <div class="slide">
                        <img src="<?php echo content_url()?>/uploads/header_slider_images/cover_photo_4.jpg" alt="carousel 2"/>
                        <div class="slider_title">
                            <a href=""><h5>Turingia pe bicicleta</h5></a>
                        </div>
                   </div>
                   <div class="slide">
                        <img src="<?php echo content_url()?>/uploads/header_slider_images/cover_photo_5.jpg" alt="carousel 2"/>
                        <div class="slider_title">
                            <a href=""><h5>Turingia pe bicicleta</h5></a>
                        </div>
                   </div>
                   <div class="slide">
                        <img src="<?php echo content_url()?>/uploads/header_slider_images/cover_photo_6.jpg" alt="carousel 2"/>
                        <div class="slider_title">
                            <a href=""><h5>Turingia pe bicicleta</h5></a>
                        </div>
                   </div>
                   <div class="slide">
                        <img src="<?php echo content_url()?>/uploads/header_slider_images/cover_photo_7.jpg" alt="carousel 2"/>
                        <div class="slider_title">
                            <a href=""><h5>Turingia pe bicicleta</h5></a>
                        </div>
                   </div>
                   <div class="slide">
                        <img src="<?php echo content_url()?>/uploads/header_slider_images/cover_photo_8.jpg" alt="carousel 2"/>
                        <div class="slider_title">
                            <a href=""><h5>Turingia pe bicicleta</h5></a>
                        </div>
                   </div>
                   <div class="slide">
                        <img src="<?php echo content_url()?>/uploads/header_slider_images/cover_photo_9.jpg" alt="carousel 2"/>
                        <div class="slider_title">
                            <a href=""><h5>Turingia pe bicicleta</h5></a>
                        </div>
                   </div>
                   <div class="slide">
                        <img src="<?php echo content_url()?>/uploads/header_slider_images/cover_photo_10.jpg" alt="carousel 2"/>
                        <div class="slider_title">
                            <a href=""><h5>Turingia pe bicicleta</h5></a>
                        </div>
                   </div>
                   <div class="slide">
                        <img src="<?php echo content_url()?>/uploads/header_slider_images/cover_photo_11.jpg" alt="carousel 2"/>
                        <div class="slider_title">
                            <a href=""><h5>Turingia pe bicicleta</h5></a>
                        </div>
                   </div>
                   <div class="slide">
                        <img src="<?php echo content_url()?>/uploads/header_slider_images/cover_photo_12.jpg" alt="carousel 2"/>
                        <div class="slider_title">
                            <a href=""><h5>Turingia pe bicicleta</h5></a>
                        </div>
                   </div>
                   <div class="slide">
                        <img src="<?php echo content_url()?>/uploads/header_slider_images/cover_photo_13.jpg" alt="carousel 2"/>
                        <div class="slider_title">
                            <a href=""><h5>Turingia pe bicicleta</h5></a>
                        </div>
                   </div>

                </div>
                <a class="slider_buttons prev" id="foo2_prev" href="#"><span>prev</span></a>
                <a class="slider_buttons next" id="foo2_next" href="#"><span>next</span></a>
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
