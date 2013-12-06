<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

		</div><!-- #main -->
		<footer id="colophon" class="site-footer" role="contentinfo">
            <!-- removing the sidebar for now -->
			<!--?php get_sidebar( 'main' ); ?-->
            <div class="sponsors">
                <h4> Sustinut de </h4>
                <div class="site_content inline_block">
                    <div class="sponsor">
                        <a href="http://amintiridinmunti.blogspot.de/">
                            <img src="<?php echo content_url()?>/uploads/sponsors/poza_mike.jpg">
                        </a>
                    </div>
                </div>
                <!-- copyright section -->
           </div>
           <div class="copyright">
               <p> © Copyright 2008-2013 Diaconescu Radu.</p>
           </div>
 		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
<!-- google analytics script -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44934617-1', 'diaconescuradu.com');
  ga('send', 'pageview');

</script>
</body>
</html>
