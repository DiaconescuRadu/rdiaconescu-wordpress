<?php
    {
        $sett = & acfg::$pages[ 'mythemes-contact' ][ 'content' ];
        
        $sett[ 'message' ] = array(
            'type' => array( 
                'template' => 'code',
            ),
            'content' => ahtml::myThemesContact()
        );
    }
?>