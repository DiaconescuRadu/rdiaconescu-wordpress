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
        $(window).load(function(){ $('#img_container').masonry({
             columnWidth: 415,
             itemSelector: '.tile_img_container'
        }); });
    });
</script>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>
                <?php get_social_buttons() ?>
                <div class="horizontalRule site_content"></div>
                <?php twentythirteen_post_nav(); ?>
                <div class="horizontalRule site_content"></div>

                <i><h3 class="text-center">Postari similare</h3></i>
                <?php
                    //for use in the loop, list 5 post titles related to first tag on current post
                    $post_categories = wp_get_post_categories($post->ID);
                    if ($post_categories) {
                        $first_cat = $post_categories[0];
                        $args=array(
                            'category__in' => $post_categories,
                            'post__not_in' => array($post->ID),
                            'posts_per_page'=>3,
                            'caller_get_posts'=>1,
                            'orderby'=>'rand'
                        );
                        $my_query = new WP_Query($args);
                        list_posts($my_query);
                        wp_reset_query();
                    }?>
                <?php comments_template(); ?>

			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
