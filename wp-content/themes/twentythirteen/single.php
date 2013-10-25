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
                <div class="social_buttons"> <!-- Social buttons -->
                    <!-- facebook like button -->
                    <div id="fb-root"></div>
                    <script>(function(d, s, id) {
                      var js, fjs = d.getElementsByTagName(s)[0];
                      if (d.getElementById(id)) return;
                      js = d.createElement(s); js.id = id;
                      js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
                      fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>

                    <!-- Facebook -->
                    <div class="fb-like" data-href="<?php the_permalink()?>" data-width="The pixel width of the plugin" data-height="The pixel height of the plugin" data-colorscheme="light" data-layout="button_count" data-action="like" data-show-faces="true" data-send="false"></div>
                    <!-- Google plus button -->

                    <!-- Place this tag where you want the +1 button to render. -->
                    <div class="g-plusone" data-size="medium"></div>

                    <!-- Place this tag after the last +1 button tag. -->
                    <script type="text/javascript">
                      (function() {
                        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                        po.src = 'https://apis.google.com/js/plusone.js';
                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                      })();
                    </script>
                    
                    <!-- Twitter -->

                    <a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                </div>
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
