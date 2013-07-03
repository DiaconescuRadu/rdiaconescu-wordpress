<?php
    include dirname( __FILE__ ) . '/fw/main.php';
        add_filter( 'user_contactmethods', array( 'myTheme' , 'my_user_contactmethods' ) );  
    
    add_filter( 'the_excerpt_rss', array( 'myTheme' , 'insertThumbnailRSS' ) );
    add_filter( 'the_content_feed', array( 'myTheme' , 'insertThumbnailRSS' ) );
    
    add_filter( 'show_admin_bar', '__return_false' );
    
    add_action( 'pre_get_posts',  array( 'myTheme' , 'auth_template' ) );
    add_action( 'after_setup_theme', array( 'myTheme' , 'setup' ) );
    add_action( 'switch_theme', array( 'myTheme' , 'uninstall_theme' ) );
?>