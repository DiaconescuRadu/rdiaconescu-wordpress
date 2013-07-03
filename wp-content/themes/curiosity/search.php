<?php
/**
 * The template for displaying Search Results pages.
 *
 * @file      search.php
 * @package   curiosity
 * @author    Sami Ch.
 * @link 	  http://gazpo.com
 */
?>
<?php get_header(); ?>

<div id="content">

	<?php if (have_posts()) : ?>
				<h2><?php _e('Search Results For ', 'curiosity'); ?>&ldquo;<?php echo $s; ?>&rdquo;</h2>
				
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

				<?php 
							
			else : ?>	
				<div id="post-0" class="post">
				<h2><?php _e( 'Nothing Found', 'curiosity' ); ?></h2>
				<p><?php _e('Sorry, but nothing matched your search criteria. Please try searching with different keywords.', 'curiosity'); ?></p>			
				<?php get_search_form(); ?>	
			</div>
		<?php 
			endif; 
		?>		
	</div><!-- /content -->
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>
