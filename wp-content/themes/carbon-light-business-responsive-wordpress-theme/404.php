<?php get_header(); ?>

<div class="otw-twentyfour otw-columns otw-content-secotion">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div id="error-404">
          <p><?php _e( 'oops!', 'otw-carbon-light' ); ?></p>
          <img alt="" src="<?php echo get_template_directory_uri(); ?>/images/404.png">
          <p><?php _e( 'error... page not found', 'otw-carbon-light' ); ?></p>
          <div><a class="return" href="<?php echo home_url(); ?>"><?php _e( 'return home', 'otw-carbon-light' ); ?></a></div>
        </div>
    </article>
</div>

<?php get_footer(); ?>