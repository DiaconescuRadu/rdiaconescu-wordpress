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
        $followText = "Urmareste pe";
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
                    <div class="follow float-left">
                        <h4> <?php echo $followText;?></h4>
                        <!-- facebook page -->
                        <div class="facebook-twitter float-left">
                            <script>(function(d, s, id) {
                              var js, fjs = d.getElementsByTagName(s)[0];
                              if (d.getElementById(id)) return;
                              js = d.createElement(s); js.id = id;
                              js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
                              fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));</script>

                            <div class="fb-like-box" data-href="https://www.facebook.com/pages/Diaconescu-Radu-Blog/221072178016386" data-width="280" data-colorscheme="dark" data-show-faces="false" data-header="false" data-stream="false" data-show-border="false"></div>
                            
                            <!-- Place this tag where you want the widget to render. -->
                            <div class="g-page" data-width="280" data-href="//plus.google.com/112005024431275689015" data-theme="dark" data-layout="landscape" data-rel="publisher"></div>

                            <!-- Place this tag after the last widget tag. -->
                            <script type="text/javascript">
                              (function() {
                                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                po.src = 'https://apis.google.com/js/platform.js';
                                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                              })();
                            </script>

                            <div class="twitter-follow">
                                <!-- twitter follow -->
                                <a href="https://twitter.com/diaconescu_radu" class="twitter-follow-button" data-show-count="false" data-lang="en" data-size="large">Follow @twitterapi</a>
                                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

                            </div>


                        </div>
                </div><!-- footer container-->
                <div class="sponsors float-left">
                   <h4> <?php echo $supportText;?></h4>
                   <div class="real-sponsors">
                       <div class="site_content inline_block">
                            <div class="sponsor polartec-logo">
                                <a href="http://polartec.com/">
                                    <img src="<?php echo content_url()?>/uploads/sponsors/Polartec_Logo_Black.jpg">
                                </a>
                            </div>
                        </div>
                        <div class="site_content inline_block">
                            <div class="sponsor decathlon-logo">
                                <a href="http://www.decathlon.ro/">
                                    <img src="<?php echo content_url()?>/uploads/sponsors/decathlon.jpg">
                                </a>
                            </div>
                        </div>
                  </div><!--real-sponsors-->
                   <div class="media-partners">
                       <div class="inline_block">
                            <div class="sponsor rra-logo">
                                <a href="http://www.romania-actualitati.ro/">
                                    <img src="<?php echo content_url()?>/uploads/sponsors/radio-romania-actualitati.jpg">
                                </a>
                            </div>
                        </div>
                       <div class="inline_block">
                            <div class="sponsor rfi-logo">
                                <a href="http://www.rfi.ro/">
                                    <img src="<?php echo content_url()?>/uploads/sponsors/Logo_RFI.jpg">
                                </a>
                            </div>
                        </div>
                        <div class="inline_block">
                            <div class="sponsor gsp-logo">
                                <a href="http://www.gsp.ro/">
                                    <img src="<?php echo content_url()?>/uploads/sponsors/gazeta-sporturilor.jpg">
                                </a>
                            </div>
                        </div>
                        <div class="inline_block">
                            <div class="sponsor discovery-logo">
                                <a href="http://www.discovery.ro/">
                                    <img src="<?php echo content_url()?>/uploads/sponsors/Discovery+Channel-33874_500x200.png">
                                </a>
                            </div>
                        </div>
                        <div class="inline_block">
                            <div class="sponsor poza-mike-logo">
                                <a href="http://amintiridinmunti.blogspot.de/">
                                    <img src="<?php echo content_url()?>/uploads/sponsors/poza_mike.jpg">
                                </a>
                            </div>
                        </div>
                    </div><!-- media partners-->
               </div>
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
