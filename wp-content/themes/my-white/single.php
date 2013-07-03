<?php get_header(); ?>

        <div class="content">
            <?php
                $myLayout = new layout( 'single' , $post -> ID );
                
                if( have_posts() ){
                    while( have_posts() ){
                        the_post();
                        ?>
                            <div class="line title">
                                <h1><?php the_title(); ?></h1>
                                <?php if( !empty( $post -> post_excerpt ) ){ ?>
                                    <p><?php echo $post -> post_excerpt; ?></p>
                                <?php } ?>
                            </div>
                            <div class="line">
                                <section  class="<?php echo $myLayout -> contentClass(); ?> large-icons">
                                    <article <?php post_class(); ?>>
                                        <?php if( has_post_thumbnail() ){ ?>
                                            <div class="thumbnail">
                                                <?php echo get_the_post_thumbnail( $post -> ID , array( $myLayout -> width , 999 ) , esc_attr( $post -> post_title ) ); ?>
                                                <?php $caption = get_post( get_post_thumbnail_id() ) -> post_excerpt; ?>
                                                <?php if( !empty( $caption ) ) { ?>
                                                    <footer><?php echo $caption; ?></footer>
                                                <?php } ?>
                                            </div>
                                        <?php
                                            }
                                            
                                            the_content();
                                            
                                            wp_link_pages( array( 'before' => '<div><p style="color: #000000;">' . __( 'Pages', "myThemes" ) . ':', 'after' => '</p></div>' ) );
                                        ?>
                                        <div class="clear"></div>
                                        <div class="social-share">
                                            <a href="https://twitter.com/share" class="twitter-share-button"  data-url="<?php echo get_permalink( $post -> ID  ) ?>" data-text="<?php the_title(); - the_excerpt(); ?>" data-lang="en">Tweet</a>
                                            <g:plusone size="medium"  href="<?php echo get_permalink( $post -> ID  ); ?>"></g:plusone>
                                            <iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode( get_permalink( $post -> ID  ) ); ?>&amp;layout=button_count&amp;show_faces=false&amp;&amp;action=like&amp;colorscheme=light" scrolling="no" frameborder="0" height="20" width="109"></iframe>
                                            <a class="fb-share" target="_blank" href="http://www.facebook.com/share.php?u=<?php echo urlencode( get_permalink( $post -> ID ) ); ?>&t=<?php echo urlencode( esc_attr( $post -> post_title ) ) ?>" title="<?php _e( 'Share on Facebook' , 'myThemes' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/media/images/fb.share.png"/></a>
                                        </div>
                                    </article>
                                    
                                    <?php comments_template(); ?>
                                    
                                </section><?php    
                                    /* SIDEBAR */
                                    $myLayout -> echoSidebar( );
                                ?>
                                <div class="clear"></div>
                            </div>
                        <?php
                    }
                }
                else{
                    ?>
                        <div class="line title">
                            <?php _e( 'Not found results' , 'myThemes' ); ?>
                        </div>
                        <div class="line">
                            <section  class="<?php echo $myLayout -> contentClass(); ?> list-view large-icons">
                                <p><?php _e( 'We apologize but this page, post or resource does not exist or can not be found. Perhaps it is necessary to change the call method to this page, post or resource.' , 'myThemes' ); ?></p>
                            </section><?php    
                                /* SIDEBAR */
                                $myLayout -> echoSidebar( );
                            ?>
                            <div class="clear"></div>
                        </div>
                    <?php
                }
            ?>
        </div>

<?php get_footer(); ?>