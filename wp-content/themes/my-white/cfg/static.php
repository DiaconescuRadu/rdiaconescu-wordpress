<?php
    global $wpdb;
    $cfg = array(
        
        /* EDITOR */
        'editor' => array(
        ),
        
        /* MENUS */
        'menus' => array(
            'header' => __( 'Header base Menu' , 'myThemes' ),
            'footer' => __( 'Footer Menu' , 'myThemes' )
            
        ),
        
        /* SIDEBARS */
        'sidebars' => array(
            array(
                'name' => __( 'Main Sidebar' , 'myThemes' ),
                'id' => 'main-sidebar',
                'description' => __( 'Main Sidebar - is used by default for next templates: 404, Archive, Author, Category, Search and Tag.' , 'myThemes' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h4 class="sidebartitle mytheme-bkg"><span>',
                'after_title' => '</span></h4>',
            ),
            array(
                'name' => __( 'Front Page Sidebar' , 'myThemes' ),
                'id' => 'second-sidebar',
                'description' => __( 'Front Page Sidebar - is used by default on front page ( if not is set to show a page for front page ).' , 'myThemes' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h4><span>',
                'after_title' => '</span></h4>',
            ),
            array(
                'name' => __( 'Post Sidebar' , 'myThemes' ),
                'id' => 'third-sidebar',
                'description' => __( 'Post Sidebar - is used by default for single post.' , 'myThemes' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h4><span>',
                'after_title' => '</span></h4>',
            ),
            array(
                'name' => __( 'Additional Sidebar' , 'myThemes' ),
                'id' => 'fourth-sidebar',
                'description' => __( 'Additional Sidebar - is not used by default, but you can use it on different pages or posts, from individual page/post - myThemes settings.' , 'myThemes' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h4><span>',
                'after_title' => '</span></h4>',
            )
        )
    );
?>