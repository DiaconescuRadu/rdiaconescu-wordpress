<?php
/**
 * The default template for displaying content.
 *
 * @file      content.php
 * @package   curiosity
 * @author    Sami Ch.
 * @link 	  http://gazpo.com
 */
?>
 
<div class="post stdbox">	
	<?php if ( is_sticky() ) : ?>
			<div class="sticky"><?php _e( 'Important', 'curiosity' ); ?></div>
	<?php endif; ?>
				
	<h2> <a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'curiosity'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	<div class="post-meta">
		<span class="date"><?php the_time('F j, Y'); ?></span> 
		<span class="sep"> - </span>						
		<span class="category"><?php the_category(', '); ?></span>
		<?php the_tags( '<span class="sep"> - </span><span class="tags">' . __('Tagged: ', 'curiosity' ) . ' ', ", ", "</span>" ) ?>
		<?php if ( comments_open() ) : ?>
				<span class="sep"> - </span>
				<span class="comments"><?php comments_popup_link( __('no comments', 'curiosity'), __( '1 comment', 'curiosity'), __('% comments', 'curiosity')); ?></span>			
		<?php endif; ?>		
	</div>
	
	<?php if ( has_post_thumbnail()) { ?>			
		<div class="post-image">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'large-thumb', array('title' => "") ); ?></a>
		</div>
	<?php } ?>
					
	<div class="post-right">
		
		<div class="exceprt">
			<?php 
				/**
				* the_excerpt() returns first 50 words in the post.
				* length is defined in functions.php.
				*/
				the_excerpt();
			?>
	    </div> 
					
		<div class="post-footer">
			<div class="more">
				<a href="<?php the_permalink(); ?>"><?php _e('Read Post &rarr;', 'curiosity'); ?></a>
			</div>
						
			<?php if ( curiosity_get_option( 'show_social_buttons' ) == 1 ) { ?>
				<div class="post-social">
					<span class="twitter">
						<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
					</span>
					<span class="fb">
						<div id="fb-root"></div>								
						<div class="fb-like" data-send="false" data-layout="button_count" data-width="80" data-show-faces="false"></div>
					</span>
				</div>
			<?php } ?>
		</div>
	</div>	
</div><!-- /post -->