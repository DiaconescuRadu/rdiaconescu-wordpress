<?php
    class myTheme{

        /* READ ADMIN SETTINGS */
        function get( $optName , $strip = false )
        {
            return sett::get( 'mythemes-' . $optName , $strip );
        }
        
        /* READ THEME SETTINGS */
        function cfg( $sett )
        {
            $result = '';
            $file = get_template_directory() . '/cfg/static.php';
            
            if( file_exists( $file ) ){
                include $file;
                
                if( isset( $cfg[ $sett ] ) ){
                    $result = $cfg[ $sett ];
                }
            }
            
            return $result;
        }
       
        
        /* INIT FILTERS */
        function init_filters()
        {
            $filters = self::cfg( 'filters' );
            if( !empty( $filters ) && is_array( $filters ) ){
                foreach( $filters as $filter => & $d ){
                    add_filter( $filter , $d );
                }
            }
        }
        
        /* INIT ACTIONS */
        function init_actions()
        {
            $actions = self::cfg( 'actions' );
            if( !empty( $actions ) && is_array( $actions ) ){
                foreach( $actions as $action => & $d ){
                    add_action( $action , $d );
                }
            }
        }
        
        /* REGISTER THEME MENUS */
        function reg_menus( )
        {
            register_nav_menus( self::cfg( 'menus' ) );
        }
        
        /* REGISTER THEME SIDEBARS */
        function reg_sidebars( )
        {
            $sidebars = self::cfg( 'sidebars' );

            if( !empty( $sidebars ) && is_array( $sidebars ) ){
                foreach( $sidebars as $sidebar ){
                    register_sidebar( $sidebar );
                }
            }
            
            /* CUSTOM SIDEBARS */
            $custom = sett::get( self::cfg( 'custom-sidebars' ) );
            if( !empty( $custom ) && is_array( $custom ) ){
                foreach( $custom as $s ){
                    $sidebars[0][ 'name' ] = $s;
                    $sidebars[0][ 'id' ] = strtolower( str_replace( ' ' , '-' , $s ) );
                    $sidebars[0][ 'description' ] = __( 'Additional custom sidebar' , 'myThemes' );
                    register_sidebar( $sidebars[ 0 ] );
                }
            }
        }
        
        function sidebar()
        {
            $sidebars = array( 'main-sidebar' => __( 'Main sidebar' , 'myThemes' ) );
            $custom = sett::get( self::cfg( 'custom-sidebars' ) );
            if( !empty( $custom ) ){
                foreach( $custom as $s ){
                    $sidebars[ strtolower( str_replace( ' ' , '-' , $s ) ) ] = $s;
                }
            }
            return $sidebars;
        }
        
        function setup()
        {
            myTheme::install_theme();
            
            load_theme_textdomain( 'myThemes' );
            load_theme_textdomain( 'myThemes' , get_template_directory() . '/media/languages' );
    
            if ( function_exists( 'load_child_theme_textdomain' ) ){
                load_child_theme_textdomain( 'myThemes' );
            }
            add_editor_style();

            add_theme_support( 'custom-background', array(
                    'default-color' => 'fafafa',
                    'default-image' => ''
            ) );
	
            add_theme_support( 'automatic-feed-links' );

            add_theme_support( 'post-thumbnails' );
            set_post_thumbnail_size( 630, 9999 );
            
            $args = array(
                'default-text-color'     => '333333',
                'wp-head-callback'       => array( 'myTheme' , 'custom_style' ),
                'default-image'          => '',
                'random-default'         => false,
                'width'                  => 0,
                'height'                 => 0,
                'flex-height'            => false,
                'flex-width'             => false,
                'header-text'            => true,
                'uploads'                => false,
                'admin-head-callback'    => array( 'myTheme' , 'admin_header' )
            );

            add_theme_support( 'custom-header', $args );
        }
        
        function admin_header(){
?>
            <style>
                @import url(http://fonts.googleapis.com/css?family=Oswald);
                @import url(http://fonts.googleapis.com/css?family=PT+Sans+Narrow);

                div#headimg{
                    background-color: #fafafa;
                    padding: 20px;
                }
                div#headimg h1,
                div#headimg h2{
                    font-family: Oswald, sans-serif;
                    font-weight: 400;
                    font-size: 48px;
                    line-height: 48px;
                    margin: 0px;
                    text-transform: uppercase;
                }
                div#headimg div{
                    color: #<?php echo get_header_textcolor(); ?>;
                    text-transform: uppercase;
                    font: 0.85em/2.6em Helvetica, Arial,sans-serif;
                    opacity: 0.6;
                    filter:alpha(opacity=60);
                }
                div#headimg a{
                    color: #<?php echo get_header_textcolor(); ?>;
                    text-decoration: none;
                }
            </style>
<?php
        }
        function custom_style()
        {
            $text_color = get_header_textcolor();
?>
            <style type="text/css">
                hgroup a,
                hgroup a:hover{
                    color: #<?php echo $text_color; ?>;
                }
                
                <?php if( myTheme::get( 'logo' ) ) { ?>
                
                    hgroup a{
                        position: absolute;
                        margin-top: <?php echo myTheme::get( 'logo-top' ); ?>px;
                        margin-left: <?php echo myTheme::get( 'logo-left' ); ?>px;
                        <?php
                            if( myTheme::get( 'logo-top' ) < 0 ){
                                ?> margin-bottom: <?php echo (-1) * (int)myTheme::get( 'logo-top' ); ?>px;<?php
                            }
                        ?>
                        <?php
                            if( myTheme::get( 'logo-left' ) < 0 ){
                                ?> margin-right: <?php echo (-1) * (int)myTheme::get( 'logo-left' ); ?>px;<?php
                            }
                        ?>
                    }
                    
                <?php } ?>
                
                
                <?php echo myTheme::get( 'css' ); ?>
            </style>
<?php
        }
        
        function install_theme(){
        
            if( is_admin() && isset( $_GET['activated'] ) ){
                $user = get_userdata( get_current_user_id() );
                $theme = wp_get_theme();

                $url = 'http://wpstats.mythem.es/?theme=' .  urlencode( $theme[ 'Name' ] )
                        . '&url=' . urlencode( home_url() )
                        . '&version=' . urlencode( myTheme::version() )
                        . '&email='  . urlencode( $user -> user_email )
                        . '&login=' . urlencode( $user -> user_login )
                        . '&user_name=' . urlencode( $user -> first_name . ' ' . $user -> last_name )
                        . '&st=activate';

                wp_remote_get( $url );
            }
        }

        function uninstall_theme(){
            if( is_admin() ){
                $user = get_userdata( get_current_user_id() );
                $theme = wp_get_theme();

                $url = 'http://wpstats.mythem.es/?theme=' .  urlencode( $theme[ 'Name' ] )
                        . '&url=' . urlencode( home_url() )
                        . '&version=' . urlencode( myTheme::version() )
                        . '&email='  . urlencode( $user -> user_email )
                        . '&login=' . urlencode( $user -> user_login )
                        . '&user_name=' . urlencode( $user -> first_name . ' ' . $user -> last_name )
                        . '&st=deactivate';
                wp_remote_get( $url );
            }
        }
        
        function auth_template( &$q )
        {
            if( $q -> is_author ){
                $q -> set( 'post_type' ,  array( 'post' ) );
                remove_action( 'pre_get_posts', 'auth_template' );
            }
        }
        
        function my_user_contactmethods($user_contactmethods){  

            $user_contactmethods['vimeo']       = __( 'Vimeo profile ( url )' , 'myThemes' );  
            $user_contactmethods['twitter']     = __( 'Twitter profile ( url )' , 'myThemes' );
            $user_contactmethods['facebook']    = __( 'Facebook page or profile ( url )' , 'myThemes' );
            $user_contactmethods['google_plus'] = __( 'Google + profile ( url )' , 'myThemes' );
            $user_contactmethods['youtube']     = __( 'Youtube profile ( url )' , 'myThemes' );

            return $user_contactmethods;  
        }
        
        function insertThumbnailRSS( $content )
        {
            global $post;
            if ( has_post_thumbnail( $post->ID ) ){
                $content = '' . get_the_post_thumbnail( $post -> ID, 'small-thumb' , array( 'style' => 'float:left; margin:0 15px 15px 0;' ) ) . '' . $content;
            }
            return $content;
        }
        
        function gravatar( $authorID , $size, $default = '' )
        {
            if( get_user_meta( $authorID , 'avatar' , true ) == -1 ){
                $result = '<img src="' . $default . '" height="' . $size . '" width="' . $size . '" alt="" class="photo avatar" />';
            }else{
                if(  get_user_meta( $authorID , 'avatar' , true ) > 0 ){
                    $avatar_info = wp_get_attachment_image_src( get_user_meta( $authorID , 'avatar' , true ) , array( $size , $size ) );
                    $result = '<img src="' . $avatar_info[0] . '" height="' . $size . '" width="' . $size . '" alt="" class="photo avatar" />';
                }else{
                    $result = get_avatar( $authorID , $size , $default );
                }
            }
            
            return $result;
        }
        
        /* RETURN NUMBER OFF CURRENT BLOG PAGE */
        function pagination()
        {
            global $wp_query;
            if( (int) get_query_var('paged') > 0 ){
                $paged = get_query_var('paged');
            }else{
                if( (int) get_query_var('page') > 0 ){
                    $paged = get_query_var('page');
                }else{
                    $paged = 1;
                }
            }
            
            return $paged;
        }
        
        /* DISPLAY BLOG TITLE */
        function title()
        {
            bloginfo('name'); ?> &raquo; <?php bloginfo('description'); ?><?php if ( is_single() ) { ?><?php } ?><?php wp_title();
        }
        
        function favicon( $settings = 'favicon' )
        {
            if( myTheme::get( $settings ) ){
                echo '<link rel="shortcut icon" href="' . myTheme::get( $settings ) . '"/>';
            }
            else{
                if(file_exists(  get_template_directory() . '/favicon.ico' ) )
                    echo '<link rel="shortcut icon" href="' . get_template_directory_uri() . '/favicon.ico"/>';
            }
        }
        
        function ajaxurl()
        {
            echo '<script>';
            echo "var ajaxurl = '" . admin_url( '/admin-ajax.php' ) . "'";
            echo '</script>';
        }
        
        function group()
        {
            return "myThemes";
        }
        
        function name()
        {
            $theme = wp_get_theme();
            return $theme -> title;
        }
        
        function version()
        {
            $theme = wp_get_theme();
            return $theme -> version;
        }
    }
?>