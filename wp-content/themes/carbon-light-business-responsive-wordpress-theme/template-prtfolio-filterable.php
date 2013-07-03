<?php

/* Template Name: Portfolio Filterable */

get_header(); ?>

  <div class="otw-twentyfour otw-columns otw-content-secotion">

    <?php otw_breadcrumb(); ?>

        <div class="otw-row">
          <div class="otw-twentyfour otw-columns">
            <div class="otw-row otw-sc-portfolio">

              <div class="otw-twentyfour otw-columns">
                <ul class="otw-portfolio-filter">
                    <li class="all"><a href="#">All</a></li>
                    <?php
                      foreach ( get_object_taxonomies( 'portfolio' ) as $tax_name ) {
                        $categories = get_categories('taxonomy='.$tax_name);
                        foreach ($categories as $category) {
                    	    echo '<li class="'.$category->category_nicename.'"><span class="separator">/</span><a href="#">'.$category->cat_name.'</a></li>';
                        }
                      }
                    ?>
                </ul>

                  <ul class="otw-portfolio block-grid three-up mobile">
                  <?php query_posts('post_type=portfolio&posts_per_page=-1&paged='.$paged); ?>
                  <?php if (have_posts()): while (have_posts()) : the_post(); ?>

                      <li data-type="<?php foreach(get_the_terms($post->ID, 'portfolio-category') as $term) echo $term->slug.' ' ?>" data-id="id-<?php echo($post->post_name) ?>">
                          <article id="post-<?php the_ID(); ?>" <?php post_class('otw-portfolio-item'); ?>>
                            	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="otw-portfolio-item-link">
                            		<div class="image">
                                		<?php if ( has_post_thumbnail()) { ?>
                                		    <?php the_post_thumbnail('portfolio-medium'); ?>
                                		<?php } else { ?>
                                            <img style="width:303px;height:210px;" src="<?php echo get_template_directory_uri(); ?>/images/pattern-1.png" title="No Image" alt="No Image" />
                                        <?php } ?>
                            		</div>
                            		<div class="title">
                            			<h3><?php the_title(); ?></h3>
                            		</div>
                            		<div class="text">
                            			<?php the_excerpt(); ?>
                            		</div>
                            	<span class="shadow-overlay hide-for-small"></span></a>
                          </article>
                      </li>

                  <?php endwhile; ?>
                  </ul>
            </div>
          </div>
        </div>
      </div>

<?php else: ?>

    <?php get_404_template(); ?>

<?php endif; ?>

    <?php otw_pagination(); ?>

</div>

<?php get_footer(); ?>