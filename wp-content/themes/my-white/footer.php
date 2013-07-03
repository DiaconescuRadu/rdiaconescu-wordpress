        </div><!-- end wrapper -->
        <footer>
            <div class="line">
                <p class="to-left"><?php echo myTheme::get( 'footer-text', true ); ?></p>

                <nav class="inline to-right my-menu">
                    <?php
                        $location = get_nav_menu_locations();
                        if( $location[ 'footer' ] > 0 )
                            wp_nav_menu( array( 'theme_location' => 'footer' ) );
                    ?>
                </nav>
                <div class="clear"></div>
                
                <?php if( is_single() ){ ?>
                    <!-- ONLY FOR SOCIAL SHARING BUTTONS -->
                    <!-- GOOGLE + -->
                    <script type="text/javascript">
                        (function() {
                            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                            po.src = 'https://apis.google.com/js/plusone.js';
                            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                        })();
                    </script>

                    <!-- TWITTER -->
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                <?php } ?>
                <?php echo stripslashes( myTheme::get( 'footer-script' , true )  ); ?>
            </div>
        </footer>

        <?php wp_footer(); ?>
		
	</body>
</html>