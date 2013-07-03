<?php
/**
 * The template for displaying date-based Archive pages.
 *
 * @file      archive.php
 * @package   curiosity
 * @author    Sami Ch.
 * @link 	  http://gazpo.com
 * 
 **/
?> 
<?php get_header(); ?>
	<div id="content" >	
		<h2 class="page-title">
			<?php if ( is_day() ) : ?>
				<?php printf( __( 'Daily Archives: %s', 'curiosity' ), '<span>' . get_the_date() . '</span>' ); ?>
			<?php elseif ( is_month() ) : ?>
				<?php printf( __( 'Monthly Archives: %s', 'curiosity' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'curiosity' ) ) . '</span>' ); ?>
			<?php elseif ( is_year() ) : ?>
				<?php printf( __( 'Yearly Archives: %s', 'curiosity' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'curiosity' ) ) . '</span>' ); ?>
			<?php else : ?>
				<?php _e( 'Blog Archives', 'curiosity' ); ?>
			<?php endif; ?>
		</h2>	
		
		<?php
			while ( have_posts() ) : the_post();
			/* Include the Post-Format-specific template for the content.
			* If you want to overload this in a child theme then include a file
			* called content-___.php (where ___ is the Post Format name) and that will be used instead.
			*/
				get_template_part( 'content' );
			endwhile;
		
			//include pagination
			if ( function_exists('curiosity_pagination') ) { 
				curiosity_pagination(); 
			} 
		?>
				
	</div>
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>