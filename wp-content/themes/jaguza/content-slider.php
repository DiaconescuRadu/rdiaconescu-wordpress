<?php
/**
 * The template for displaying the slider on the homepage
 *
 * @package WordPress
 * @subpackage jaguza
 * @since jaguza 1.0.0
 */
?>
<article>
 <div id="jaguza_slider_strip">
	<div class="strip_wrapper">        
	  <div id="jaguza-home-slider"  class="flexslider">
 	 	<ul class="slides">
  			<?php 
	$noOfSliderItems = (esc_textarea(jaguza_get_option('jaguza_number_of_slider_items')) ? esc_textarea(jaguza_get_option('jaguza_number_of_slider_items')) : 10);
	$slider_query = 'showposts='.$noOfSliderItems;
	if(esc_textarea(jaguza_get_option('jaguza_slider_category'))) /*If a particular category was chosen, filter by it*/
			$slider_query .= '&cat='.get_cat_ID(esc_textarea(jaguza_get_option('jaguza_slider_category')));			   
	$slider_query_results = new WP_Query($slider_query);	
	while ($slider_query_results->have_posts()) : $slider_query_results->the_post();?>
    <li>
    <div class="item append-clear main-slider-image">
    <a class="image append-mask" href="<?php the_permalink(); ?>" title="Permanent Link to <?php the_title_attribute(); ?>">
     <?php  
					$fallbackImage = (jaguza_get_option('jaguza_slider_fallback_image') ? esc_url(jaguza_get_option('jaguza_slider_fallback_image')): "");
					if(jaguza_get_option('jaguza_slider_item_img_FullWidth')):
						echo jaguza_get_post_thumbnail('980','380',$fallbackImage ); /*If the full width option is enabled, images cover the entire width*/
					else:
						echo jaguza_get_post_thumbnail('420','280',$fallbackImage );
					endif;	
	?>				
    </a>
    </div><!--.main-slider-image-->
			<div class="meta main-slider-text">
				<h3><a href="<?php the_permalink(); ?>" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				<?php the_excerpt(); ?>
			</div><!--.main-slider-text-->
    </li>     
     <?php endwhile; ?>
    
      	</ul><!--.slides-->
	</div><!--.flexslider-->
</div><!--.strip_wrapper-->
</div><!--#jaguza_slider_strip--> 
</article>