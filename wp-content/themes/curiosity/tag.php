<?php
/**
 * The Tag page
 *
 * This page is used to display Tag Archive pages
 * 
 * @file      tag.php
 * @package   curiosity
 * @author    Sami Ch.
 * @link 	  http://gazpo.com
 */
 ?> 
<?php get_header(); ?>

	<div id="content" >	
		<h2 class="page-title"><?php printf( __( 'Tag Archives: %s', 'curiosity' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h2>

		<?php
			$tag_description = tag_description();
				if ( ! empty( $tag_description ) )
						echo apply_filters( 'tag_archive_meta', '<div class="archive-meta">' . $tag_description . '</div>' );
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