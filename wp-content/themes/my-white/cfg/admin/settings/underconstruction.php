<?php
$sett = & acfg::$pages[ 'mythemes-underconstruction' ][ 'content' ];
{   /* UNDER CONSTRUCTION SETTINGS */

    $sett[ 'title-under-construction' ] = array(
        'type' => array(
            'template' => 'code'
        ),
        'title' => __( 'Under Construction Settings' , 'myThemes' )
    );
    
    $sett[ 'under-construction' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'logic'
        ),
        'label' => __( 'Use under construction template' , "myThemes" ),
        'action' => "{'t' : '.mythemes-under-construction' , 'f' : '-' }"
    );
    
    if( isset( $_POST[ 'mythemes-under-construction' ] ) && $_POST[ 'mythemes-under-construction' ] == 1 ){
            $use = true;
    }
    else if( isset( $_POST[ 'mythemes-under-construction' ] ) && $_POST[ 'mythemes-under-construction' ] == 0 ){
        $use = false;
    }
    else {
        $use = (boolean)myTheme::get( 'under-construction' );
    }
    
    if( $use ){
        $classes = 'mythemes-under-construction';
    }
    else{
        $classes = 'mythemes-under-construction hidden';
    }
    
    $sett[ 'under-construction-page' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'search'
        ),
        'query' => array( 'post_type' => 'page' , 'post_status' => 'publish' ),
        'templateClass' => $classes,
        'label' => __( 'Under construction page' , "myThemes" ),
        'hint' => __( 'Select page to show on under construction template'  , "myThemes" )
    );
    
    $sett[ 'feedburner' ] = array(
        'type' => array(
            'template' => 'inline',
            'input' => 'text'
        ),
        'templateClass' => $classes,
        'label' => __( 'Email feed Subscription'  , "myThemes" ),
        'hint' => __( 'Fill with Google FeedBurner account ex : ' , "myThemes" ) . 'http://feeds.feedburner.com/<strong>mythem_es</strong>'
    );
}
?>
