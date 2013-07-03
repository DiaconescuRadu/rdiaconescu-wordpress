<?php
    $pages = & acfg::$pages;
    
    $pages = array(
        /* MAIN PAGE */
        'mythemes-general' => array(
            'menu' => array(
                'settings' => 'myThemes',
                'label' => __( 'Theme Options' , 'myThemes' ) ,
                'ico'	=> DEV_ICON
            ),
            'title' => __( 'General Settings' , 'myThemes' ),
            'description' => '',
            'content' => array(),
        ),
        
        'mythemes-contact' => array(
            'menu' => array(
                'label' => __( 'Contact' , 'myThemes' ) . ' <span class="not-upper">myThemes</span>',
            ),
            'title' => __( 'Contact' , 'myThemes' ) . ' <img class="contact-developer" src="' . DEV_LOGO . '"/>',
            'description' => '',
            'content' => array(),
            'update' => false
        ),
    );
?>