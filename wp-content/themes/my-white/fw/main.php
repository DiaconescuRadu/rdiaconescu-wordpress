<?php
    define( 'DEV_LOGO', get_template_directory_uri() .'/media/admin/images/mythemes-logo.png' );
    define( 'DEV_ICON', get_template_directory_uri() .'/media/admin/images/icon.png' );
    define( 'SHORT_PATH' , true ); /* USED FOR DEBUG */
    
    $mainDir = dirname( __FILE__ );
	
    include $mainDir . '/deb.class.php';
    include $mainDir . '/tools.class.php';
    
    /* READ OPTIONS | META */
    include $mainDir . '/sett.class.php';
    include $mainDir . '/meta.class.php';

    include $mainDir . '/cfg.php';
    include $mainDir . '/mytheme.class.php';
    
    include $mainDir . '/layout.class.php';	
    include $mainDir . '/thumbnail.class.php';
		
    include $mainDir . '/libs.php';
	
    /* CUSTOM POSTS */
    include get_template_directory() . '/cfg/admin/resources/boxes.php';
    
    /* SET DEFAULT VALUES FOR SETTINGS FROM PAGES */
    include get_template_directory() . '/cfg/admin/default.php';
    
    /* LOAD THEME ADMIN DATA */
    if( is_admin() ){
        include $mainDir . '/admin/ahtml.class.php';
        
        /* REGISTER PAGES */
        include get_template_directory() . '/cfg/admin/pages.php'; 
        include $mainDir . '/admin/main.php';
    }
    
    /* load plugins */
    include $mainDir . '/plg.php';
	
    /* INIT ACTIONS, SHORTCODES, AJAX */
    myTheme::init_actions();
    myTheme::init_filters();
    
    /* REGISTER ( MENUS | SIDEBARS ) */
    myTheme::reg_menus();
    myTheme::reg_sidebars();
?>