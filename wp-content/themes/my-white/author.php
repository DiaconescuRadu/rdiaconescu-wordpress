<?php get_header(); ?>

        <div class="content">
            <div class="line title">
                <?php
                    $firstName  = get_the_author_meta( 'first_name' , $post-> post_author );
                    $lastName   = get_the_author_meta( 'last_name' , $post-> post_author );
                    $printName  = get_the_author_meta( 'display_name' , $post-> post_author );
                    
                    if( strlen( $firstName . $lastName ) )
                        $name = $firstName . ' ' . $lastName;
                    else
                        $name = $printName
                ?>
                
                <h1><?php echo $name; ?></h1>
            </div>    
            <div class="line">

                <?php 
                    $myLayout = new layout( );
                    global $wp_query;
                ?>

                <section  class="<?php echo $myLayout -> contentClass(); ?> list-view large-icons">
                    
                    <?php
                        $bio        = get_the_author_meta( 'description' , $post-> post_author );
        
                        $vimeo      = get_the_author_meta( 'vimeo' , $post-> post_author );
                        $twitter    = get_the_author_meta( 'twitter' , $post-> post_author );
                        $facebook   = get_the_author_meta( 'facebook' , $post-> post_author );
        
                        $google     = get_the_author_meta( 'google_plus' , $post-> post_author );
                        $youtube    = get_the_author_meta( 'youtube' , $post-> post_author );
                        $rss        = get_author_posts_url( $post-> post_author ) . 'feed/';
                    ?>
                        <div class="author-box">
                            <?php echo get_avatar( $post -> post_author , 100 ); ?>
                            <p><?php echo $bio; ?></p>
                            <div class="clear"></div>
                            <div class="details">
                                <div class="author-social">
                                    <?php if( strlen( esc_url( $vimeo ) ) ) { ?>
                                        <a href="<?php echo esc_url( $vimeo ) ?>" class="vimeo" target="_blank"></a>
                                    <?php } ?>
                                    <?php if( strlen( esc_url( $twitter ) ) ) { ?>
                                        <a href="<?php echo esc_attr( $twitter ) ?>" class="twitter" target="_blank"></a>
                                    <?php } ?>
                                    <?php if( strlen( esc_url( $facebook ) ) ) { ?>
                                        <a href="<?php echo esc_url( $facebook ) ?>" class="facebook" target="_blank"></a>
                                    <?php } ?>
                                    <?php if( strlen( esc_url( $google ) ) ) { ?>
                                        <a href="<?php echo esc_url( $google ) ?>" class="google-plus" target="_blank"></a>
                                    <?php } ?>
                                    <?php if( strlen( esc_url( $youtube ) ) ) { ?>
                                        <a href="<?php echo esc_url( $youtube ) ?>" class="youtube" target="_blank"></a>
                                    <?php } ?>
                                        <a href="<?php echo $rss; ?>" class="rss" target="_blank"></a>
                                </div>
                                <h4><?php _e( 'Published' , 'myThemes' ); ?>: <strong><?php echo $wp_query -> found_posts ?></strong> <?php _e( 'articles' , 'myThemes' ); ?></h4>
                                <div class="clear"></div>
                            </div>
                        </div>
                    <?php
                        if( have_posts() ){
                            while( have_posts() ){
                                the_post();
                                get_template_part( 'cfg/templates/view/list-view' );
                            }
                        }
                        else{
                            echo '<h2>' . __( 'Not found results' , 'myThemes' ) . '</h2>';
                            echo '<p>' . __( 'We apologize but this page, post or resource does not exist or can not be found. Perhaps it is necessary to change the call method to this page, post or resource.' , 'myThemes' ) . '</p>';
                        }

                        get_template_part( 'cfg/templates/pagination' );
                    ?>
                </section><?php    
                    /* SIDEBAR */
                    $myLayout -> echoSidebar( );
                ?>
                <div class="clear"></div>
            </div>
        </div>

<?php get_footer(); ?>