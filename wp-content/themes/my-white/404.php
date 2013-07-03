<?php get_header(); ?>

        <div class="content">
            <div class="line title">
                <h1><?php _e( 'Not found results' , 'myThemes' ); ?></h1>
            </div>
            <div class="line">
                <?php $myLayout = new layout( ); ?>
                
                <!-- <section class="template medium to-left list-view large-icons"> -->

                <section class="<?php echo $myLayout -> contentClass(); ?>">
                    <article>
                        <p><?php _e( 'We apologize but this page, post or resource does not exist or can not be found. Perhaps it is necessary to change the call method to this page, post or resource.' , 'myThemes' ) ?></p>
                    </article>
                </section><?php    
                    /* SIDEBAR */
                    $myLayout -> echoSidebar( );
                ?>
                <div class="clear"></div>

            </div>
        </div>

<?php get_footer(); ?>