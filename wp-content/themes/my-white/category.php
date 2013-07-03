<?php get_header(); ?>

        <div class="content">
            <div class="line title">
                <h1><?php _e( 'Results for category' , 'myThemes' ); ?> "<?php echo get_cat_name( get_query_var( 'cat' ) ); ?>"</h1>
                <?php $desc = category_description( get_query_var( 'cat' ) ); ?>
                <?php if( !empty( $desc ) ) { ?>
                    <p><?php echo $desc; ?></p>
                <?php } ?>
            </div>    
            <div class="line">

                <?php $myLayout = new layout( ); ?>

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