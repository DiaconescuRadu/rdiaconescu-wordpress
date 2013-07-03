<?php
/**
 * The template for displaying image attachments.
 *
 * @file      image.php
 * @package   curiosity
 * @author    Sami Ch.
 * @link 	  http://gazpo.com
 **/ 
?>
<?php get_header(); ?>
	<div id="content">
		<?php the_post(); ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
                <h2><?php the_title(); ?></h2>
				
				<div class="post-meta">						
						<?php if ( curiosity_get_option( 'show_media_comments' ) == 1 ) { ?>	
								<span class="sep"> - </span>
								<span class="comments"><?php comments_popup_link( __('no comments', 'curiosity'), __( '1 comment', 'curiosity'), __('% comments', 'curiosity')); ?></span>
						<?php } ?>				
					</div><!-- /post-meta -->
				
				<div class="entry">						
					<?php the_attachment_link($post->ID, true) ?>
				</div> <!-- entry -->   

				<div class="image-nav">
					<span class="previous"><?php previous_image_link( false, __( '&larr; Previous' , 'curiosity' ) ); ?></span>
					<span class="next"><?php next_image_link( false, __( 'Next &rarr;' , 'curiosity' ) ); ?></span>
				</div><!-- /image-navigation -->
				
				<div class="parent-post-link">
					<a href="<?php echo get_permalink($post->post_parent) ?>" title="<?php printf( __( 'Return to %s', 'curiosity' ), esc_html( get_the_title($post->post_parent), 1 ) ) ?>" rev="attachment"><span class="meta-nav">&laquo; </span><?php echo get_the_title($post->post_parent) ?></a>
				</div>
		
            </div><!-- /post --> 
			
			<?php if ( curiosity_get_option( 'show_media_comments' ) == 1 ) { ?>
				<?php comments_template(); ?>
			<?php } ?>
			
	</div>	<!-- /content -->
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>