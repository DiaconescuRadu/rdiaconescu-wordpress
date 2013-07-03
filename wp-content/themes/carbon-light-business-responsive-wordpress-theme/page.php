<?php get_header(); ?>

    <div class="otw-eighteen otw-columns otw-content-secotion">

    <?php otw_breadcrumb(); ?>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
			<?php the_content(); ?>
			
			<?php comments_template( '', true ); // Remove if you don't want comments ?>

			<?php edit_post_link(); ?>
			
		</article>

	<?php endwhile; ?>
	
	<?php else: ?>
	
		<article>
			<h1><?php _e( 'Sorry, nothing to display.', 'otw-carbon-light' ); ?></h1>
		</article>
	
	<?php endif; ?>

    </div>
	
    <!-- sidebar -->
    <div class="otw-six otw-columns otw-first-sidebar-secotion">

        <?php get_sidebar(); ?>

    </div>
    <!-- END sidebar -->

<?php get_footer(); ?>