<?php
/**
 * Full Content Template
 *
   Template Name:  Page with gallery, full width
 *
 * @file           full-width-page.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2011 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/full-width-page.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
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

					<div class="entry-content gallery-width-full">
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
