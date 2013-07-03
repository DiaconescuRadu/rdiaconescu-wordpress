<?php get_header(); ?>

        <div class="content">
            <div class="line title">
                <?php
                    if ( is_day() ) {
                        echo '<h1>' . __( 'Daily archives' , 'myThemes' ) . ' "' . get_the_date() . '"</h1>';
                    }else if ( is_month() ) {
                        echo '<h1>' . __( 'Monthly archives' , 'myThemes' ) . ' "' . get_the_date( 'F Y' ) . '"</h1>';
                    }else if ( is_year() ) {
                        echo '<h1>' . __( 'Yearly archives' , 'myThemes' ) . ' "' . get_the_date( 'Y' ) . '"</h1>';
                    }else {
                        echo '<h1>' . __( 'Blog archives' , 'myThemes' ) . '</h1>';
                    }
                ?>
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