<div class="otw-eighteen otw-columns otw-content-secotion">

    <?php otw_breadcrumb(); ?>

          <?php if (have_posts()): while (have_posts()) : the_post(); ?>

                  <article id="post-<?php the_ID(); ?>" <?php post_class('otw-post-archive'); ?>>
                    <?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
                        <a class="animate-on-hover" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <div class="image">
                                <?php the_post_thumbnail('blog-medium'); ?>
                            <span style="box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0.7) inset;" class="shadow-overlay hide-for-small"></span><span class="shadow-overlay hide-for-small" style="box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0.337) inset;"></span></div>
                        </a>
                    <?php endif; ?>
                    <div class="post-body<?php if ( !has_post_thumbnail()) { echo ' no-thumb'; } ?>">
                      <h3 class="post-title">
                        <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                      </h3>
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
                      </div>
                      <div class="text">
                        <?php the_excerpt(); ?>
                    	</div>
                    	<div class="post-more">
                      	<span class="read-more"><a title="<?php _e( 'Read more', 'otw-carbon-light' ); ?>" href="<?php the_permalink(); ?>"><?php _e( 'Read more', 'otw-carbon-light' ); ?></a></span>
                    	</div>
                    </div>
                  </article>

          <?php endwhile; ?>

          <?php else: ?>

              <?php get_404_template(); ?>

          <?php endif; ?>

        <?php otw_pagination(); ?>


</div>

<!-- sidebar -->
<div class="otw-six otw-columns otw-first-sidebar-secotion">
    <?php get_sidebar(); ?>
</div>
<!-- END sidebar -->