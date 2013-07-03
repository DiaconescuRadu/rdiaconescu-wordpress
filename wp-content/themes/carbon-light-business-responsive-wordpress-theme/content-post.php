<?php get_header(); ?>
    <div class="otw-eighteen otw-columns otw-content-secotion">

    <?php otw_breadcrumb(); ?>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('otw-single-blog-post'); ?>>

          <div class="post-meta">
            <span class="date">
              <?php _e( 'Posted on', 'otw-carbon-light' ); ?> <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('d/m/Y'); ?></time>
            </span>
            <span class="author">
                <?php _e( 'By', 'otw-carbon-light' ); ?> <?php the_author_posts_link(); ?>
            </span>
            <span class="categories">
              <?php printf(__('Categories: %s', 'otw-carbon-light'), get_the_category_list(', ')); ?>
            </span>
            <span class="tags">
              <?php the_tags(__('Tags:', 'otw-carbon-light') . ' ', ', ', ''); ?>
            </span>

            <?php edit_post_link(__('Edit This', 'otw-carbon-light'), '<span class="post-edit"> | ', '</span>'); ?>

            <?php if ( comments_open() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
                <div class="comments">
                    <?php comments_popup_link( '0', __( '1', 'otw-carbon-light' ), __( '%', 'otw-carbon-light' )); ?>
                </div>
            <?php endif; ?>

          </div>

      	  <?php if ( has_post_thumbnail()) : ?>
          <div class="post-image">
            <?php the_post_thumbnail('blog-large'); ?>
          </div>
      	  <?php endif; ?>

          <div class="post-content">
            <?php the_content(); ?>
          </div>

          <div class="related-posts">
             <?php $postID = $post->ID; echo otw_related_posts($postID); ?>

          </div>


           <?php
          	// If a user has filled out their description, show a bio on their entries.
          	if ( get_the_author_meta( 'description' ) ) : ?>
              <div class="otw-widget-blogauthorinfo animate-on-hover">
                <a class="image" href="#"><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentytwelve_author_bio_avatar_size', 80 ) ); ?><span class="shadow-overlay hide-for-small"></span></a>
                <div class="author-contents">
                  <h3 class="widget-title"><span><?php _e('About', 'otw-carbon-light'); ?></span> <?php echo get_the_author(); ?></h3>
                  <p><?php the_author_meta( 'description' ); ?></p>
                </div>
              </div>
    	   <?php endif; ?>

          <?php comments_template(); ?>

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