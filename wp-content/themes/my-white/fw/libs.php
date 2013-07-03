<?php

/// ////////////////////////////////////////////////////////////////////////////
/// temporary stuff

class myW {
	public static $black 	= 'mytheme_sc_black ';
	public static $blue 	= 'mytheme_sc_blue ';
	public static $red      = 'mytheme_sc_red ';
	public static $green 	= 'mytheme_sc_green ';
};

function solve_br( $_content, $_arr ) {
	$doc = new DOMDocument( );
	
	echo "\n\n\n\n";
	
	//deb::e( $_content, 1 );
	
	$doc->loadHTML( $_content );
	
	$dom = $doc->documentElement->firstChild;
	$domRm = array( );
	
	foreach( $dom->childNodes as $ch ) {
		if( !in_array( $ch->nodeName, $_arr ) ) {
			$domRm[] = $ch;
		}
		//echo $ch->nodeName . "<br/>";
	}
	
	foreach( $domRm as $el ) {
		$el->parentNode->removeChild( $el );
	}
	
	$rett = $doc->saveHTML( );
	$rett = substr( $rett, strpos( $rett, "<html><body>" ) + 12 );
	$rett = substr( $rett, 0, strpos( $rett, "</body></html>" ) );
	
	return $rett; 
}

function colorFamily( $hex , $lum = 0 ){
    // validate hex string
    if( $hex[ 0 ] == '#' ){
        $hex = substr( $hex , 1 );
    }
    
    if( strlen( $hex ) < 6 ){
        $hex = $hex[ 0 ] . $hex[ 0 ] . $hex[ 1 ] . $hex[ 1 ] . $hex[ 2 ] . $hex[ 2 ];
    }
    
    // convert to decimal and change luminosity
    $rgb = "#"; $c = 0;
    for ( $i = 0; $i < 3; $i++) {
            $c = hexdec( substr( $hex , $i*2 , 2 ) );
            $c = dechex( round( min( max( 0, $c + ( $c * $lum ) ) , 255 ) ) );
            $rgb .= substr ( "00" . $c , strlen( $c ) );
    }
    return $rgb;
}

/// ////////////////////////////////////////////////////////////////////////////

class lib {
	function call( ) {
		echo "do something";
	}
};

?>