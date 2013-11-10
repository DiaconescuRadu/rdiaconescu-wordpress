<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(window).load(function(){ $('#gallery1').masonry({
             columnWidth: 10,
             itemSelector: '.gallery_image',
             isFitWidth: true
        }); });
        $(window).load(function(){ $('#gallery2').masonry({
             columnWidth: 10,
             itemSelector: '.gallery_image',
             isFitWidth: true
        }); });
        $(window).load(function(){ $('#gallery3').masonry({
             columnWidth: 10,
             itemSelector: '.gallery_image',
             isFitWidth: true
        }); });
        $(window).load(function(){ $('#gallery4').masonry({
             columnWidth: 10,
             itemSelector: '.gallery_image',
             isFitWidth: true
        }); });
    });
</script>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<div class="entry-thumbnail">
							<?php the_post_thumbnail(); ?>
						</div>
						<?php endif; ?>

						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</div><!-- .entry-content -->

                    <?php get_social_buttons() ?>

					<footer class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->
				</article><!-- #post -->

				<?php comments_template(); ?>
			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
