<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @file      category.php
 * @package   curiosity
 * @author    Sami Ch.
 * @link 	  http://gazpo.com
 * 
 **/
?>
<?php get_header(); ?>

	<div id="content" >	
		<h2 class="page-title">
			<?php	printf( __( 'Category Archives: %s', 'curiosity' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
		</h2>
		
		<?php
			$category_description = category_description();
				if ( ! empty( $category_description ) )
					echo apply_filters( 'category-archive-meta', '<div class="archive-meta">' . $category_description . '</div>' );
		?>
			
		
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