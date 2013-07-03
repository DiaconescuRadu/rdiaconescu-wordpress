<?php
/* THEME OPTIONS */
    
$sett = & acfg::$pages[ 'mythemes-general' ][ 'content' ];

{   /* GENERAL SETTINGS */

    $sett[ 'title-general' ] = array(
        'type' => array(
            'template' => 'code'
        ),
        'title' => __( 'Branding' , 'myThemes' )
    );

    $icon = pathinfo( myTheme::get( 'favicon' ) );
    if( strlen( myTheme::get( 'favicon' ) ) && $icon[ 'extension' ] != 'ico' ){
        $icon_hint = '<span style="color:#cc0000;">' . __( 'Error, please select "ico" type media file' , 'myThemes' ) . '</span>';
    }else{
        $icon_hint = __( "Please select 'ico' type media file. Make sure you allow uploading 'ico' type in General Settings -> Upload file types." , 'myThemes' );
    }

    $sett[ 'favicon' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'upload'
        ),
        'label' => __( 'Upload your custom favicon' , 'myThemes' ),
        'hint' => $icon_hint
    );

    $sett[ 'logo' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'upload'
        ),
        'label' => __( 'Upload your custom logo' , 'myThemes' )
    );

    $sett[ 'logo-top' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'text',
            'validator' => 'int'
        ),
        'label' => __( 'Logo top margin ( px )' , 'myThemes' )
    );

    $sett[ 'logo-left' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'text',
            'validator' => 'int',
        ),
        'label' => __( 'Logo left margin ( px )' , 'myThemes' )
    );
}

{   /* LAYOUT SETTINGS */ 

    $sett[ 'title-layout' ] = array(
        'type' => array(
            'template' => 'code'
        ),
        'title' => __( 'Layout' , 'myThemes' )
    );

    $sett[ 'layout' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'imageSelect'
        ),
        'values' => array(
            'right'  => get_template_directory_uri() . '/media/images/left.layout.png',
            'left' => get_template_directory_uri() . '/media/images/right.layout.png',
            'full'  => get_template_directory_uri() . '/media/images/full.layout.png'
        ),
        'coll' => 3,
        'label' => __( 'Default layout' , 'myThemes' ),
        'hint' => __( 'If not is set custom layout, will be used default layout.' , 'myThemes' ),
        'action' => "[ 'hs' , { 'full' : '.sidebar' } ]"
    );

    $values = array_merge( array(
        'main-sidebar' => __( 'Main Sidebar' , 'myThemes' ),
        'second-sidebar' => __( 'Front Page Sidebar' , 'myThemes' ),
        'third-sidebar' => __( 'Post Sidebar' , 'myThemes' ),
        'fourth-sidebar' => __( 'Additional Sidebar' , 'myThemes' ),
    ) );

    if( myTheme::get( 'layout' ) == 'full' ){
        $sidebarClass = 'sidebar hidden';
    }else{
        $sidebarClass = 'sidebar';
    }

    $sett[ 'sidebar' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'select'
        ),
        'templateClass' => $sidebarClass,
        'values' => $values,
        'label' => __( 'Default sidebar' , 'myThemes' ),
    );
    
    $sett[ 'front-page-layout' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'imageSelect'
        ),
        'values' => array(
            'right'  => get_template_directory_uri() . '/media/images/left.layout.png',
            'left' => get_template_directory_uri() . '/media/images/right.layout.png',
            'full'  => get_template_directory_uri() . '/media/images/full.layout.png'
        ),
        'coll' => 3,
        'label' => __( 'Front page layout' , 'myThemes' ),
        'hint' => __( 'If not is set front page layout, will be used default layout.' , 'myThemes' ),
        'action' => "[ 'hs' , { 'full' : '.front-page-sidebar' } ]"
    );

    if( myTheme::get( 'front-page-layout' ) == 'full' ){
        $sidebarClass = 'front-page-sidebar hidden';
    }else{
        $sidebarClass = 'front-page-sidebar';
    }

    $sett[ 'front-page-sidebar' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'select'
        ),
        'templateClass' => $sidebarClass,
        'values' => $values,
        'label' => __( 'Front page sidebar' , 'myThemes' ),
    );
    
    $sett[ 'single-layout' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'imageSelect'
        ),
        'values' => array(
            'right'  => get_template_directory_uri() . '/media/images/left.layout.png',
            'left' => get_template_directory_uri() . '/media/images/right.layout.png',
            'full'  => get_template_directory_uri() . '/media/images/full.layout.png'
        ),
        'coll' => 3,
        'label' => __( 'Single post layout' , 'myThemes' ),
        'hint' => __( 'If not is set single post layout, will be used default layout.' , 'myThemes' ),
        'action' => "[ 'hs' , { 'full' : '.single-sidebar' } ]"
    );

    if( myTheme::get( 'single-layout' ) == 'full' ){
        $sidebarClass = 'single-sidebar hidden';
    }else{
        $sidebarClass = 'single-sidebar';
    }

    $sett[ 'single-sidebar' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'select'
        ),
        'templateClass' => $sidebarClass,
        'values' => $values,
        'label' => __( 'Single post sidebar' , 'myThemes' ),
    );
    
    $sett[ 'page-layout' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'imageSelect'
        ),
        'values' => array(
            'right'  => get_template_directory_uri() . '/media/images/left.layout.png',
            'left' => get_template_directory_uri() . '/media/images/right.layout.png',
            'full'  => get_template_directory_uri() . '/media/images/full.layout.png'
        ),
        'coll' => 3,
        'label' => __( 'Single page layout' , 'myThemes' ),
        'hint' => __( 'If not is set single page layout, will be used default layout.' , 'myThemes' ),
        'action' => "[ 'hs' , { 'full' : '.page-sidebar' } ]"
    );

    if( myTheme::get( 'page-layout' ) == 'full' ){
        $sidebarClass = 'page-sidebar hidden';
    }else{
        $sidebarClass = 'page-sidebar';
    }

    $sett[ 'page-sidebar' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'select'
        ),
        'templateClass' => $sidebarClass,
        'values' => $values,
        'label' => __( 'Single page sidebar' , 'myThemes' ),
    );
}
{   /* SOCIAL SETTINGS */
    $sett[ 'title-social' ] = array(
        'type' => array(
            'template' => 'code'
        ),
        'title' => __( 'Social' , 'myThemes' )
    );
    
    $sett[ 'vimeo' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'text',
            'validator' => 'url'
        ),
        'label' => __( 'Set <strong>Vimeo</strong> profile page <strong>URL</strong>' , 'myThemes' )
    );
    $sett[ 'twitter' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'text',
            'validator' => 'url'
        ),
        'label' => __( 'Set <strong>Twitter</strong> profile page <strong>URL</strong>' , 'myThemes' )
    );
    $sett[ 'facebook' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'text',
            'validator' => 'url'
        ),
        'label' => __( 'Set <strong>Facebook</strong> profile page <strong>URL</strong>' , 'myThemes' )
    );
    $sett[ 'google-plus' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'text',
            'validator' => 'url'
        ),
        'label' => __( 'Set <strong>Google +</strong> profile page <strong>URL</strong>' , 'myThemes' )
    );
    $sett[ 'youtube' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'text',
            'validator' => 'url'
        ),
        'label' => __( 'Set <strong>Youtube</strong> profile page <strong>URL</strong>' , 'myThemes' )
    );
    $sett[ 'rss' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'logic'
        ),
        'label' => __( 'Show RSS icon in header' , 'myThemes' )
    );
}

{   /* OTHERS SETTINGS */
    
    $sett[ 'title-others' ] = array(
        'type' => array(
            'template' => 'code'
        ),
        'title' => __( 'Others' , 'myThemes' )
    );

    $sett[ 'css' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'textarea',
            'validator' => 'noesc'
        ),
        'label' => __( 'Add custom css' , 'myThemes' )
    );

    $sett[ 'js' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'textarea',
            'validator' => 'noesc'
        ),
        'label' => __( 'Tracking code' , 'myThemes' ),
        'hint' => __( 'Add additional HTML + JS code ( ex: google analytic code )' , 'myThemes' )
    );
}
?>