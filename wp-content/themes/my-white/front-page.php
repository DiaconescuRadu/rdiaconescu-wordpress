<?php get_header(); ?>

        <div class="content">

            <?php 
                if( get_option( 'show_on_front' ) == 'page' ){
                    if( (int)get_option( 'page_on_front' ) )
                        $myLayout = new layout( 'page' , get_option( 'page_on_front' ) );
                    else
                        $myLayout = new layout( 'front-page' );

                    $wp_query = new WP_Query( array( 'p' => get_option( 'page_on_front' ) , 'post_type' => 'page' ) );
                    
                    if( count( $wp_query -> posts ) ){
                        foreach( $wp_query -> posts as $post ){
                            
                            $wp_query -> the_post();
                            $show = meta::get( $post -> ID , 'post-title' );
                            if( strlen( $show ) == 0 ){
                                $show = 1;
                            }
                            
                            if(  $show ){ ?>
            
                                <div class="line title">
                                    <h1><?php the_title() ?></h1>
                                    <?php if( !empty( $post -> post_excerpt ) ){ ?>
                                        <p><?php echo $post -> post_excerpt; ?></p>
                                    <?php } ?>
                                </div>
                        
                            <?php } ?>
            
                            <div class="line">
                                <section class="<?php echo $myLayout -> contentClass(); ?> list-view large-icons">
                                    <article <?php post_class(); ?>>
                                        <?php if( has_post_thumbnail() ){ ?>
                                            <div class="thumbnail">
                                                <?php echo get_the_post_thumbnail( $post -> ID , array( $myLayout -> width , 999 ) , esc_attr( $post -> post_title ) ); ?>
                                                <?php $caption = get_post( get_post_thumbnail_id() ) -> post_excerpt; ?>
                                                <?php if( !empty( $caption ) ) { ?>
                                                    <footer><?php echo $caption; ?></footer>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                        <?php the_content(); ?>
                                        <?php wp_link_pages( array( 'before' => '<div><p style="color: #000000;">' . __( 'Pages', "myThemes" ) . ':', 'after' => '</p></div>' ) ); ?>
                                    </article>
                                </section><?php

                                    /* SIDEBAR */
                                    $myLayout -> echoSidebar( );
                                ?>
                            </div>
            
                        <?php } ?>
                    <?php } ?>
            
                <?php } else { ?>
            
                    <?php $myLayout = new layout( 'front-page' ); ?>
            
                    <div class="line title">
                        <h1><?php _e( 'Blog Page' , 'myThemes' ); ?></h1>
                    </div>
                    <div class="line">
                        
                        <section class="<?php echo $myLayout -> contentClass(); ?> list-view large-icons">
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
                    </div><?php
                } 
            ?>
            <div class="clear"></div>            
        </div>

<?php get_footer(); ?>