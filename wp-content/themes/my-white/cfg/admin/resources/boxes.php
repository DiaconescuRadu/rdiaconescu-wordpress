<?php

if( isset( acfg::$res[ 'box' ] ) ) {
    acfg::$res[ 'box' ] = array();
}

$box = & acfg::$res[ 'box' ];

/// ////////////////////////////////////////////////////////////////////////
/* PAGE LAYOUT */
$box[ 'page' ][ 'settings' ] = array(
	'title' => __( 'myThemes Settings' , 'myThemes' ),
	'context' => 'normal',
	'priority' => 'high',
	'callback' => 'my_box_post_layout',
	'args' => null,
	'onSave' => 'my_box_post_layout_save'
);

$box[ 'post' ][ 'settings' ] = array(
	'title' => __( 'myThemes Settings' , 'myThemes' ),
	'context' => 'normal',
	'priority' => 'high',
	'callback' => 'my_box_post_layout',
	'args' => null,
	'onSave' => 'my_box_post_layout_save'
);
/// ////////////////////////////////////////////////////////////////////////
/* PAGE LAYOUT */
/// ////////////////////////////////////////////////////////////////////////

/* SAVE METHOD */
function my_box_post_layout_save( $post_id )
{
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        return;
	
    if( isset( $_POST[ 'mythemes-post-title' ] ) )
        meta::set( $post_id , 'post-title' , esc_attr( $_POST[ 'mythemes-post-title' ] ) );
    
    if( isset( $_POST[ 'mythemes-post-layout' ] ) && isset( $_POST[ 'mythemes-use-post-layout' ] ) && (int)$_POST[ 'mythemes-use-post-layout' ] == 1 ) {
	meta::set( $post_id , 'post-layout' , esc_attr( $_POST[ 'mythemes-post-layout' ] ) );
        meta::set( $post_id , 'use-post-layout' , esc_attr( $_POST[ 'mythemes-use-post-layout' ] ) );
		
        switch( $_POST[ 'mythemes-post-layout' ] ) {
            case 'left':
            case 'right': {
                if( isset( $_POST[ 'mythemes-post-sidebar' ] ) ) {
                    meta::set( $post_id , 'post-sidebar' , esc_attr( $_POST[ 'mythemes-post-sidebar' ] ) );
                }
                break;
            }
            default:
                break;
        }
    }
    else{
        if( isset( $_POST[ 'mythemes-use-post-layout' ] ) )
            meta::set( $post_id , 'mythemes-use-post-layout' , esc_attr( $_POST[ 'mythemes-use-post-layout' ] ) );
        
        meta::set( $post_id , 'post-layout' , null );
        meta::set( $post_id , 'post-sidebar' , null );
    }
}

/* DISPLAY BOX */
function my_box_post_layout( $post )
{
    /* TITLE */
    $title = meta::get( $post -> ID, 'post-title' );
    if( strlen( $title ) == 0 ){
        $title = 1;
    }
    
    echo ahtml::template( array(
        'type' => array(
            'template' => 'inline',
            'input' => 'logic'
        ),
        'label' => __( 'Show title' , 'myThemes' ),
        'fieldName' => 'post-title',
        'value' => $title
    ) );
    
    /* LAYOUT */
    echo ahtml::template( array(
        'type' => array(
            'template' => 'inline',
            'input' => 'logic'
        ),
        'label' => __( 'Use custom layout' , 'myThemes' ),
        'fieldName' => 'use-post-layout',
        'action' => "{'t' : '.mythemes-post-layout' , 'f' : '-' }",
        'value' => meta::get( $post -> ID , 'use-post-layout' )
    ) );
    
    $use_post_layout = meta::get( $post -> ID, 'use-post-layout' );
    if( strlen( $use_post_layout ) == 0 || $use_post_layout === "0" ){
        $classes = 'mythemes-post-layout hidden';
    }else{
        $classes = 'mythemes-post-layout';
    }
    
    $rett = ahtml::template( array(
        'type' => array(
            'template' => 'inline',
            'input' => 'imageSelect'
        ),
        'values' => array(
            'right'  => get_template_directory_uri() . '/media/images/left.layout.png',
            'left' => get_template_directory_uri() . '/media/images/right.layout.png',
            'full'  => get_template_directory_uri() . '/media/images/full.layout.png'
        ),
        'coll' => 2,
        'label' => __( 'Select Layout' , 'myThemes' ),
        'fieldName' => 'post-layout',
        'value' => meta::get( $post -> ID , 'post-layout' ),
        'action' => "[ 'hs' , { 'full' : '.mythemes-layout-sidebar' } ]"
    ) );
	
    if( meta::get( $post -> ID , 'post-layout' ) == '1+content' ){
        $sidebarClass = 'mythemes-layout-sidebar hidden';
    }else{
        $sidebarClass = 'mythemes-layout-sidebar';
    }

    $values = array_merge( array(
        'main-sidebar' => __( 'Main Sidebar' , 'myThemes' ),
        'second-sidebar' => __( 'Second Sidebar' , 'myThemes' ),
        'third-sidebar' => __( 'Third Sidebar' , 'myThemes' ),
        'fourth-sidebar' => __( 'Fourth Sidebar' , 'myThemes' ),
    ) );
    
    $rett .= ahtml::template( array(
        'type' => array(
            'template' => 'inline',
            'input' => 'select'
	),
	'values' => $values,
	'label' => __( 'Select sidebar' , 'myThemes' ),
	'fieldName' => 'post-sidebar',
        'templateClass' => $sidebarClass,
        'value' => meta::get( $post -> ID , 'post-sidebar' )
    ) );
    
    echo ahtml::template( array(
        'type' => array(
            'template' => 'code'
        ),
        'content' => $rett,
        'templateClass' => $classes
    ) );
}
?>