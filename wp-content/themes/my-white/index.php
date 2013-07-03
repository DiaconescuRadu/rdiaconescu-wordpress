<?php get_header(); ?>

        <?php
            global $myLayout;        
            if( (int)get_option( 'page_for_posts' ) ){
                $myLayout = new layout( 'page' , get_option( 'page_for_posts' ) );
                $p = get_post( get_option( 'page_for_posts' ) );
            }
            else{
                $myLayout = new layout( );
            }
        ?>

        <div class="content">
            <div class="line title">
                <h1><?php _e( 'Blog Page' , 'myThemes' ); ?></h1>
                <?php if( isset( $p ) && isset( $p -> post_content ) && !empty( $p -> post_content ) ) { ?>
                    <p><?php echo $p -> post_content; ?></p>
                <?php } ?>
            </div>
            <div class="line">

                <section  class="<?php echo $myLayout -> contentClass(); ?> list-view large-icons">
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