<?php get_header(); ?>

    <div class="otw-eighteen otw-columns otw-content-secotion">

    <?php otw_breadcrumb(); ?>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('otw-single-portfolio-item'); ?>>

        <?php if(get_post_meta($post->ID, 'custom_otw-portfolio-repeatable-image', true)){ ?>
          <div class="portfolio-gallery-wrapper">
            <div class="flexslider" id="portfolio-gallery">

            <div class="flex-viewport" style="overflow: hidden; position: relative;"><ul class="slides" style="width: 1600%; transition-duration: 0s; transform: translate3d(0px, 0px, 0px);">
                <?php
                  $post_meta_data = get_post_custom($post->ID);
                  $custom_repeatable = unserialize($post_meta_data['custom_otw-portfolio-repeatable-image'][0]);
                   foreach ($custom_repeatable as $custom_image) {
                        $url = wp_get_attachment_image_src($custom_image, 'porfolio-large');
                        echo '<li data-thumb="'.$url[0].'" style="width: 700px; float: left; display: block;"><img alt="" src="'.$url[0].'"></li>';
                   }
                ?>
              </ul></div><ul class="flex-direction-nav"><li><a href="#" class="flex-prev flex-disabled">Previous</a></li><li><a href="#" class="flex-next">Next</a></li></ul></div>
            <div class="flexslider" id="portfolio-carousel">

            <div class="flex-viewport" style="overflow: hidden; position: relative;"><ul class="slides" style="width: 1600%; transition-duration: 0s; transform: translate3d(0px, 0px, 0px);">
                <?php
                  $post_meta_data = get_post_custom($post->ID);
                  $custom_repeatable = unserialize($post_meta_data['custom_otw-portfolio-repeatable-image'][0]);
                   foreach ($custom_repeatable as $custom_image) {
                        $url = wp_get_attachment_image_src($custom_image, 'porfolio-large');
                        echo '<li data-thumb="'.$url[0].'" style="width: 210px; float: left; display: block;"><img alt="" src="'.$url[0].'"></li>';
                   }
                ?>

              </ul></div><ul class="flex-direction-nav"><li><a href="#" class="flex-prev flex-disabled">Previous</a></li><li><a href="#" class="flex-next">Next</a></li></ul></div>
          </div>
          <?php } ?>

          <div class="post-meta">
            <span class="categories">
                <?php the_taxonomies(); ?>
            </span>
            <?php edit_post_link(__('Edit This', 'otw-carbon-light'), '<span class="post-edit"> | ', '</span>'); ?>
          </div>
          <div class="post-content">

            <?php the_content(); ?>

            <?php if(get_post_meta($post->ID, 'custom_otw-portfolio-url', true) ) { ?>
                <div class="visit-site"><a href="http://<?php echo get_post_meta($post->ID, 'custom_otw-portfolio-url', true); ?>"><?php _e( 'Visit site', 'otw-carbon-light' ); ?></a></div>
            <?php } ?>

            <?php if(get_post_meta($post->ID, 'custom_otw-portfolio-quote', true) ) { ?>
                <blockquote class="otw-sc-quote bordered">
                  <p><?php echo get_post_meta($post->ID, 'custom_otw-portfolio-quote', true); ?></p>
                </blockquote>
            <?php } ?>

          </div>
        </article>

	<?php endwhile; else: ?>

		<article>
			<h1><?php _e( 'Sorry, nothing to display.', 'otw-carbon-light' ); ?></h1>
		</article>

	<?php endif; ?>

      </div>

    <!-- sidebar -->
    <div class="otw-six otw-columns otw-first-sidebar-secotion">
        <?php get_sidebar(); ?>
    </div>
    <!-- END sidebar -->

<?php get_footer(); ?>