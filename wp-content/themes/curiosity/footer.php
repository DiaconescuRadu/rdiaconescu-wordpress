<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content-container and the #container div.
 * Also contains the footer widget area.
 *
 * @file      footer.php
 * @package   curiosity
 * @author    Sami Ch.
 * @link 	  http://gazpo.com
 */
 ?>
 
</div> <!-- /content-container -->
</div> <!-- /container -->
<div id="footer">
	<div class="inner-wrap">
        <div class="footer-widgets">
            
			<?php if ( ! dynamic_sidebar( 'sidebar-2' ) ) : ?>				
				
				<div class="widget widget_text" id="text-4">
					<h4><?php _e( 'Curiosity Wordpress Theme', 'curiosity' ); ?></h4>
					<div class="textwidget"><?php _e( 'Thank you for using this free theme. If you have questions, feel free contact.', 'curiosity' ); ?></div>
				</div>
				
				<div class="widget">
					<h4><?php _e( 'Popular Categories', 'curiosity' ); ?></h4>
					<ul><?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'title_li' => '', 'number' => 5 ) ); ?></ul>
				</div>
				<?php the_widget('WP_Widget_Recent_Comments', 'number=5', 'before_title=<h4>&after_title=</h4>'); ?> 
				<?php the_widget('WP_Widget_Meta', 'number=5', 'before_title=<h4>&after_title=</h4>'); ?> 
			
			<?php endif; // end footer widget area ?>		
			
		</div>
		<div class="footer-info">
			<a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo ('name');?>">
			<?php bloginfo ('name');?></a> 
			<?php _e('Powered by','gazpo'); ?> <a href="http://www.wordpress.org"><?php _e('WordPress','gazpo'); ?></a> <?php _e('and theme by','gazpo'); ?>	 <a href="http://gazpo.com/" title="gazpo.com"><?php _e('gazpo.com','gazpo'); ?></a>.		
		</div>		
		  
	</div> 	<!-- /inner-wrap -->	
</div><!-- /footer -->
<?php wp_footer(); ?>
</body>
</html>