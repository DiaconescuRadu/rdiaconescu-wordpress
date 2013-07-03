<?php
/*
    custom posts
    custom taxonomy
    custom box
 
 */
function _mytheme_autoload_resources( $classname )
{
    my_resources::load( $classname );
}

class my_resources
{
    static $first_run = true;
    static $res = array( );

    function init()
    {
        $currDir = dirname( __FILE__ );
        $data = include $currDir . '/res.php';

        foreach( $data as $k ) {
            if( isset( acfg::$res[ $k ] ) && acfg::$res[ $k ] ){
                self::run( $k );
                self::$res[ "my_res_" . $k ] = $currDir . "/my_res_{$k}.php";
            }
        }
    }

    function load( $classname )
    {
        if( isset( self::$res[ $classname ] ) ) {
            include_once( self::$res[ $classname ] );
        }
    }

    function run( $tag )
    {
        if( self::$first_run ) {
            self::$first_run = false;

            spl_autoload_register( '_mytheme_autoload_resources' );
        }

        $classname = "my_res_$tag";
        if( $tag == 'box' )
            add_action( 'admin_init', array( $classname , "run" ) );
        else    
            add_action( 'init', array( $classname , "run" ) );
    }
}

my_resources::init();
?>