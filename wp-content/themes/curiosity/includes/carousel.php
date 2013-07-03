<?php
/**
 * The template for displaying the carousel posts.
 * Gets the category for the posts from the theme options. 
 * If no category is selected, displays the latest posts.
 *
 *
 * @file      carousel.php
 * @package   curiosity
 * @author    Sami Ch.
 * @link 	  http://gazpo.com
 *
 */
?>
<?php
	$carousel_cat_id = curiosity_get_option('carousel_category');
	//if no category is selected for carousel, show latest posts
	if ( $carousel_cat_id == 0 ) {
		$post_query = 'posts_per_page=10';
	} else {
		$post_query = 'cat='.$carousel_cat_id.'&posts_per_page=10';
	}
?>

<div id="carousel">
		
	<div  class="carousel-prev">Previous</div>
	<div class="carousel-posts">				
		<ul>
			<?php query_posts( $post_query ); if( have_posts() ) : while( have_posts() ) : the_post(); ?>
			<li>
				<?php if ( has_post_thumbnail()) { ?>				 
					<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'large-thumb' ); ?></a>
				<?php } ?>				
				<div class="post-wrap">				
				<h4> 
					<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'curiosity'), the_title_attribute('echo=0')); ?>">
						<?php 
							// display only first 22 characters in the title.	
							$short_title = mb_substr(the_title('','',FALSE),0,22);
							echo $short_title; 
							if (strlen($short_title) >21){ 
								echo '...'; 
							} 
						?>	
					</a>
				</h4>
				
				
				<div class="post-meta">
					<span class="date"><?php the_time('F j'); ?></span> 
					<span class="sep">-</span> 
					<span class="comments"><?php comments_popup_link( __('no comments', 'curiosity'), __( '1 comment', 'curiosity'), __('% comments', 'curiosity')); ?></span>
				</div>
				
				<div class="post-excerpt">
						<?php 
							// display only first 100 characters in the description.								
							$excerpt = get_the_excerpt();																
							echo mb_substr($excerpt,0, 100);									
							if (strlen($excerpt) > 99){ 
								echo '...'; 
							} 
						?>			
				</div>	
			</div><!-- /post-wrap -->				
			</li>
					
			<?php endwhile; endif;?>
			<?php wp_reset_query();?>
		</ul>				
	</div>
	<div  class="carousel-next">Next</div>
</div><!-- /carousel -->