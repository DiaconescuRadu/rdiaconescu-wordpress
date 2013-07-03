        <?php
            global $myLayout;
            $myLayout = new layout();
            $myLayout -> width = 800;
        ?>
        <div class="position-center">
            <div class="under-construction">
                <div class="wrapper">
                    <header>
                        <div>
                            <div class="template custom logo">
                                <hgroup>
                                    <?php if( myTheme::get( 'logo' ) ) { ?>
                                        <a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); echo ' '; bloginfo( 'description' ); ?>">
                                            <img src="<?php echo myTheme::get( 'logo' ); ?>" alt="<?php bloginfo( 'name' ); echo ' '; bloginfo( 'description' ); ?>"/>
                                        </a>
                                    <?php }else { ?>

                                        <?php if( is_home() || is_front_page() ) { ?>
                                            <h1><a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); echo ' '; bloginfo( 'description' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
                                        <?php }else{ ?>
                                            <h2><a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); echo ' '; bloginfo( 'description' ); ?>"><?php bloginfo( 'name' ); ?></a></h2>
                                        <?php } ?>
                                        <p><a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); echo ' '; bloginfo( 'description' ); ?>"><?php bloginfo( 'description' ); ?></a></p>

                                    <?php } ?>
                                </hgroup>
                            </div>    
                            <div class="template custom social">
                                <?php if( myTheme::get( 'rss' ) ) { ?>
                                    <a href="<?php bloginfo('rss2_url'); ?>" class="rss" target="_blank"></a>
                                <?php } ?>
                                <?php if( esc_url( myTheme::get( 'google-plus' ) ) ) { ?>
                                    <a href="<?php echo myTheme::get( 'google-plus' ); ?>" class="youtube" target="_blank"></a>
                                <?php } ?>
                                <?php if( esc_url( myTheme::get( 'google-plus' ) ) ) { ?>
                                    <a href="<?php echo myTheme::get( 'google-plus' ); ?>" class="google-plus" target="_blank"></a>
                                <?php } ?>
                                <?php if( esc_url( myTheme::get( 'facebook' ) ) ) { ?>
                                    <a href="<?php echo myTheme::get( 'facebook' ); ?>" class="facebook" target="_blank"></a>
                                <?php } ?>
                                <?php if( esc_url( myTheme::get( 'twitter' ) ) ) { ?>
                                    <a href="<?php echo myTheme::get( 'twitter' ); ?>" class="twitter" target="_blank"></a>
                                <?php } ?>
                                <?php if( esc_url( myTheme::get( 'vimeo' ) ) ) { ?>
                                    <a href="<?php echo myTheme::get( 'vimeo' ); ?>" class="vimeo" target="_blank"></a>
                                <?php } ?>
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </header>    
                    
                    <div class="content">
                        
                        <div>
                            <section class="template custom text">
                                <?php 
                                    $args = array(
                                        'p' => (int)myTheme::get( 'under-construction-page' ),
                                        'post_type' => 'page',
                                        'post_status' => 'publish'
                                    );
                                    
                                    $wp_query = new WP_Query( $args );
                                    
                                    if( count( $wp_query -> posts ) ){
                                        foreach( $wp_query -> posts as $post ){
                                            echo '<article>';
                                            
                                            $wp_query -> the_post();
                                            
                                            $show = meta::get( 'post-title' , $post -> ID );
                                            $show = meta::get( $post -> ID , 'post-title' );
                                            
                                            if( strlen( $show ) == 0 ){
                                                $show = 1;
                                            }
                                            
                                            if( $show ){
                                                echo '<h1 class="aligncenter">' . $post -> post_title . '</h1>';
                                            }
                                            the_content();
                                            echo '</article>';
                                        }
                                    }
                                ?>
                                <?php if( esc_attr( myTheme::get( 'feedburner' ) ) ) { ?>

                                    <form class="subscribe" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="javascript:utils.feedburner( '<?php echo esc_attr( myTheme::get( 'feedburner' ) ); ?>' );">
                                        <p>
                                            <input type="text" class="text" name="email" value="<?php esc_attr_e( 'Place your email adress here...' , "myThemes" ); ?>" onfocus="if (this.value == '<?php esc_attr_e( 'Place your email adress here...' , "myThemes" ); ?>') {this.value = '';}" onblur="if (this.value == '' ) { this.value = '<?php esc_attr_e( 'Place your email adress here...' , "myThemes" ); ?>';}"><span class="email"></span>
                                            <input type="hidden" value="<?php echo esc_attr( myTheme::get( 'feedburner' ) ); ?>" name="uri">
                                            <input type="hidden" name="loc" value="en_US">
                                            <input type="submit" class="submit button large" value="<?php _e( 'Subscribe' , 'myThemes' ); ?>">
                                        </p>
                                    </form>

                                <?php } ?>
                            </section>
                        </div>    
                    </div>
                    
                </div>
                
                <footer>
                    <p class="to-left"><?php echo myTheme::get( 'footer-text', true ); ?></p>
                    <nav class="inline to-right my-menu">
                    <?php
                        $location = get_nav_menu_locations();
                        if( $location[ 'footer' ] > 0 )
                            wp_nav_menu( array( 'theme_location' => 'footer' ) );
                    ?>
                    </nav>
                    <div class="clear"></div>
                    <?php echo stripslashes( myTheme::get( 'footer-script' , true )  ); ?>
                    <div class="clear"></div>
                </footer>
                <?php wp_footer(); ?>
                
            </div>
        </div>
    </body>
</html>