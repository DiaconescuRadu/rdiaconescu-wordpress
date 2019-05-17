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

<?
    if(ICL_LANGUAGE_CODE == 'ro'){
        $followText = "Social stuff";
        $supportText = "Sustinut de";
    } else {
        $followText = "Follow using";
        $supportText = "Supported by";
    }
?>

		</div><!-- #main -->
		<footer id="colophon" class="site-footer" role="contentinfo">
            <!-- removing the sidebar for now -->
			<!--?php get_sidebar( 'main' ); ?-->
            <div class="footer-space">
                <div class="footer-container">
                    <div class="follow">
                        <!-- facebook page -->
                        <div class="facebook">
                              <!-- Load Facebook SDK for JavaScript -->
                                <div id="fb-root"></div>
                                <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.3&appId=1380479268860167&autoLogAppEvents=1"></script>
                                <div class="fb-like" data-href="https://www.facebook.com/Diaconescu-Radu-221072178016386/" data-width="180" data-layout="standard" data-action="recommend" data-size="large" data-show-faces="true" data-share="true"></div>
                        </div>
                </div><!-- footer container-->
                <!--div class="sponsors float-left">
                   <h4> <?php echo $supportText;?></h4>
                   <div class="real-sponsors">
                 </div><!--real-sponsors-->
                   <div class="media-partners">
                   </div><!-- media partners-->
               </div!-->
           </div>
           <!-- copyright section -->
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
