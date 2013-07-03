<?php
/**
 * The main page *
 * @package WordPress
 * @subpackage jaguza
 * @since jaguza 1.0.0
 */

get_header(); ?>


<div id="jaguza_homepageblocks_strip">
<div class="strip_wrapper">
<section id="primary" class="site-content">
		<div id="content" role="main">

		<?php 	$noOfhomepageItems = (jaguza_get_option('jaguza_number_of_homepagePost_items') ? esc_textarea(jaguza_get_option('jaguza_number_of_homepagePost_items')) : 10);
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array('posts_per_page' => $noOfhomepageItems, 'paged' => $paged );
				query_posts($args);
					if ( have_posts() ) : ?>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/* Include the post format-specific template for the content.*/
				get_template_part('content','home');	

			endwhile;

			jaguza_pagination();
			?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>

</div><!--.strip_wrapper-->
</div><!--#jaguza_homepageblocks_strip-->
<?php get_footer(); ?>