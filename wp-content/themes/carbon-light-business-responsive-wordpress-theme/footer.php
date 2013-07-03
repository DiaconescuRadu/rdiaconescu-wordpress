    </div> <!-- otw-row main-content -->

    <div class="otw-row">
      <div class="otw-twentyfour otw-columns">
        <div class="otw-sc-divider scroll-top">
          <a class="dot center" href="#top"><?php _e( 'top', 'otw-carbon-light' ); ?></a>
        </div>
      </div>
    </div>

    <footer id="page-footer">
      <div class="otw-row footer-blocks">
        <?php if ( is_active_sidebar( 'footer-widget-area' ) ) : ?>
            <?php dynamic_sidebar( 'footer-widget-area' ); ?>
        <?php endif; ?>
      </div>
      <div class="otw-row copyright">
        <div id="footer-menu" class="otw-twelve otw-columns">
            <?php wp_nav_menu( array( 'theme_location' => 'secondary', 'container' => '', 'menu_class' => '', 'menu_id' => '', 'depth' => 1 ) ); ?>
        </div>
        <div class="otw-twelve otw-columns text-right">
          &copy; <?php echo date("Y"); ?> <?php _e('Carbon light free WordPress theme. Created by ', 'otw'); ?> <a href="http://onetwoweb.bg/en">OneTwoWeb</a>.
        </div>
      </div>
    </footer>
  </div>
</div>

		<?php wp_footer(); ?>

        <!-- Activate Portfolio Carousel Slider  -->
        <script type="text/javascript">
        	// Portfolio Single Item Gallery
          $(document).ready(function(){
            $('#portfolio-carousel').flexslider({
              animation: "slide",
              controlNav: false,
              animationLoop: false,
              slideshow: false,
              itemWidth: 210,
              itemMargin: 5,
              asNavFor: '#portfolio-gallery'
            });

            $('#portfolio-gallery').flexslider({
              animation: "slide",
              controlNav: false,
              animationLoop: false,
              slideshow: false,
              sync: "#portfolio-carousel"
            });
          });
        </script>

	</body>
</html>