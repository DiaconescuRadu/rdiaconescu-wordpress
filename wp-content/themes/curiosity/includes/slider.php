<?php
/**
 * The template for displaying the carousel posts.
 * Gets the category for the posts from the theme options. 
 * If no category is selected, displays the latest posts.
 *
 *
 * @file      slider.php
 * @package   curiosity
 * @author    Sami Ch.
 * @link 	  http://gazpo.com
 *
 */
?>

<?php
	$cat_id = curiosity_get_option('slider_category');
	
	$args = array(
			'cat' => $cat_id,
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 5
		);
?>
<div id="jslidernews3" class="lof-slidecontent">
	<div class="preload"><div></div></div>
	<div  class="button-previous">Previous</div>
    <div class="main-slider-content">
        <ul class="sliders-wrap-inner">
			<?php
				$query = new WP_Query( $args );
				if ( $query->have_posts() ) :							
					while ( $query->have_posts() ) : $query->the_post();?>
						<li>
							<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'slider-image' ); ?></a>                                     
							<div class="slider-description">
								<div class="slider-meta"><?php the_time('F j, Y'); ?></div>
								<h4>
									<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'curiosity'), the_title_attribute('echo=0')); ?>">
									<?php 
										// display only first 40 characters in the title.	
										$short_title = mb_substr(the_title('','',FALSE),0,40);
										echo $short_title; 
										if (strlen($short_title) > 39){ 
											echo '...'; 
										} 
									?>	
									</a>								
								</h4>
								<p>
								<?php 
									// display only first 110 characters in the description.								
									$excerpt = get_the_excerpt();																
									echo mb_substr($excerpt,0, 110);									
									if (strlen($excerpt) > 109){ 
										echo '...'; 
									} 
								?>
								</p>
							</div>
						</li> 
					<?php endwhile; ?>
				<?php endif; ?>	
        </ul>  	
    </div><!-- /main-slider-content -->
 	<div class="navigator-content">
        <div class="navigator-wrapper">
            <ul class="navigator-wrap-inner">
				<?php
					while ( $query->have_posts() ) : $query->the_post();?>
						<li>
                            <div class="post-item">
                                <a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'small-thumb' ); ?></a>
								<div class="post-right">
									<h5>
										<?php 
											// display only first 60 characters in the title.	
											$short_title = mb_substr(the_title('','',FALSE),0,60);
											echo $short_title; 
											if (strlen($short_title) > 59){ 
												echo '...'; 
											} 
										?>																
									</h5>
									
									<div class="post-meta">
										<span class="date"><?php the_time('F j'); ?></span>												
										<?php if ( comments_open() ) : ?>
											<span class="sep"> - </span>
											<span class="comments">											
											 <?php comments_number( __('no comments', 'curiosity'), __( '1 comment', 'curiosity'), __('% comments', 'curiosity')); ?>.
											</span>			
										<?php endif; ?>		
									</div>
								</div>
                            </div>    
                        </li>
				<?php endwhile; ?>
			</ul>
        </div>
   </div> <!-- /navigator-content -->
	<div class="button-next">Next</div>
 </div>
 <?php wp_reset_query();	//reset the query ?>