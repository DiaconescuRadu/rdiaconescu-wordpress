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
            <?php
            $blog_query = new WP_Query( array( 'post_type' => 'post', 'paged' => $paged , 'posts_per_page' => 12));
            $temp_query = $wp_query;
            $wp_query = null;
            $wp_query = $blog_query;
            if ( $blog_query->have_posts() ) :

                echo '<div class="tile_cont" id="img_container">';
                    while ( $blog_query->have_posts() ) : $blog_query->the_post(); 
                        ?>

                    <?php
                    echo '<div class="tile_img_container">';
                    echo '<a href="' . get_permalink() . '" >';
                    if (has_post_thumbnail()) {
                        echo the_post_thumbnail('large');
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

                if (  $wp_query->max_num_pages > 1 ) : 
                    ?>
                    <div class="navigation html_carousel">
                        <div class="previous older_posts"><?php next_posts_link( __( '&#8249; Older posts', 'responsive' ), $wp_query->max_num_pages ); ?></div>
                        <div class="next newer_posts"><?php previous_posts_link( __( 'Newer posts &#8250;', 'responsive' ), $wp_query->max_num_pages ); ?></div>
                    </div><!-- end of .navigation -->
                    <?php 
                endif;

            else : 

                get_template_part( 'loop-no-posts' ); 

            endif; 
            $wp_query = $temp_query;
            wp_reset_postdata();
            ?>  


        </div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
