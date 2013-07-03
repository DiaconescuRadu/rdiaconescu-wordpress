<?php

/* //////////////////////////////////////////////////////////////////////////////
 * Description of my_files : Init uploader and media library.
 *
 * @author myTheme
 * /////////////////////////////////////////////////////////////////////////////
 */

function _mytheme_autoload_my_files( $classname ) {
    my_files::load($classname);
}

class my_files {

    static $first_run = true;
    static $fl = array();
    
    static function init() {
        $currDir = dirname( __FILE__ );
        $data = include $currDir . '/fl.php';
        
        foreach( $data as $k => $v ){
            $_k = $k;
            $_v = $v;
            if( !is_string( $k ) ) {
                    $_k = $_v;
            }
            self::$fl[ "my_fl_" . $_k ] = $currDir . "/my_fl_{$_v}.php";
        }
        
        self::run();
    }

    static function load( $classname ) {
        if (isset( self::$fl[ $classname ] ) ) {
            include_once( self::$fl[ $classname ] );
        }
    }

    static function run() {
        if (self::$first_run) {
            self::$first_run = false;

            /* set autoload function */
            spl_autoload_register('_mytheme_autoload_my_files');
            
            function include_script(){ 
                wp_register_script( 'mytheme-upload',
                    get_template_directory_uri( ) . '/fw/plg/my_files/my_fl_upload.js'
                );
                wp_enqueue_script( 'mytheme-upload' );
            }

            add_action( "admin_init" , 'include_script' );
        
            add_action( 'wp_ajax_my_fl_upload' , array( 'my_fl_upload' , 'uploadPanel' ) );
        }
    }

}

my_files::init();
?>