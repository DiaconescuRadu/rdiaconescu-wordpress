<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 * * @package WordPress
 * @subpackage jaguza
 * @since jaguza 1.0.0
 */
?>
	 </div><!-- #main .wrapper -->
</div> <!--#page -->	
<footer class="jaguza_footer">
<div id="jaguza_footer_strip">
<div class="strip_wrapper">
<ul class="footer_widgets">
<?php /* Widgetized Footer */  if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('jaguza_footer') ) : ?><?php endif;  ?> 
</ul><!--footer_widgets-->
</div><!--.strip_wrapper-->
</div><!--#jaguza_footer_strip-->
<div id="jaguza_bottom_strip">
<div class="strip_wrapper copyright">
<div id="scroll-to-top"></div>
   &#169; <?php echo date('Y');?> <?php bloginfo('name');?><span class="url fn org"><?php _e(' Powered by','jaguza') ?> <a href="http://wordpress.org/" target="_blank" title="Semantic Personal Publishing Platform">WordPress</a> :: <?php _e(' Built by ','jaguza') ?><a href="http://themes.blueboltlimited.com" target="_blank" title="Making the web dance">Blue Bolt Themes</a></span> 
  </div><!--#strip_wrapper-->
 </div><!--#jaguza_bottom_strip-->
<?php  if(jaguza_get_option('jaguza_show_social_icons')):?>
 <?php echo jaguza_generate_socialBar_icons();?>
<?php  endif;?>
</footer>
<?php wp_footer(); ?>
</body>
</html>