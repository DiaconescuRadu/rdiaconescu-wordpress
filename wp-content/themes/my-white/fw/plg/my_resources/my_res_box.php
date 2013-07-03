<?php
class my_res_box
{
    function run( )
    {
        if( empty( acfg::$res[ 'box' ] ) || 
            !is_array( acfg::$res[ 'box' ] ) )
        {
            return null;
        }
        
        foreach( acfg::$res[ 'box' ] as $postSlug => & $boxes ) {
            foreach( $boxes as $boxSlug => $box ) {
                add_meta_box( $boxSlug
                                , $box[ 'title' ] 
                                , $box[ 'callback' ] 
                                , $postSlug 
				, $box[ 'context' ] 
				, $box[ 'priority' ] 
				, $box[ 'args' ] 
		);
				
                if( isset( $box[ 'onSave' ] ) ) {
                    add_action( 'save_post', $box[ 'onSave' ], 10, 1 );
                }
            }
        }
    }
}
?>