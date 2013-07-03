<?php
	class deb{
		static function bt( $_bt )
		{
			$rett = '';
			
			$f = array( );
			$op = array( );
			
			for( $i = 0; $i < count( $_bt ); $i++ ) {
				$d = $_bt[ $i ];
				$f[]  = self::short( $d[ 'file' ] ) . ":{$d[ 'line' ]}";
				$op[] = "{$d[ 'function' ]}( " . $d[ 'args' ][ 0 ] . " )";
			}
			
			$fmax = 0;
			$opmax = 0;
			for( $i = 0; $i < count( $_bt ); $i++ ) {
				if( strlen( $f[ $i ] ) > $fmax )
					$fmax = strlen( $f[ $i ] );
				if( strlen( $op[ $i ] ) > $opmax )
					$opmax = strlen( $op[ $i ] );
			}
			
			for( $i = 0; $i < count( $_bt ); $i++ ) {
				$f[ $i ] .= str_repeat( ' ', $fmax - strlen( $f[ $i ] ) );
				$op[ $i ] .= str_repeat( ' ', $opmax - strlen( $op[ $i ] ) );
			}
			
			for( $i = 0; $i < count( $_bt ); $i++ ) {
				$rett .= $f[ $i ] . ' => ' . $op[ $i ] . "\n";
			}
			
			return $rett;
		}
		
		
		
		function e( $data, $backtrace = 0 )
        {
			print '<pre style="margin:10px; border:1px dashed #999999; padding:10px; color:#333; background:#ffffff;">';
            $bt = debug_backtrace();
            $caller = $bt[ 0 ];
            print "[ File : " . self::short( $caller[ 'file' ] ) . " ][ Line : " . $caller[ 'line' ] . " ]\n";
            print "--------------------------------------------------------------\n";
			if( $backtrace ) {
				print self::bt( $bt );
				print "--------------------------------------------------------------\n";
			}
			print_r( $data );
			print "</pre>";
		}
		
		function dump( $data )
        {
			print '<pre style="margin:10px; border:1px dashed #999999; padding:10px; color:#333; background:#ffffff;">';
            $bt = debug_backtrace();
            $caller = array_shift($bt);
            print "[ File : " . self::short( $caller[ 'file' ] ) . " ][ Line : " . $caller[ 'line' ] . " ]\n";
            print "--------------------------------------------------------------\n";
			var_dump( $data );
			print "</pre>";
		}
		
		function html( $data )
        {
			print '<pre style="margin:10px; border:1px dashed #999999; padding:10px; color:#333; background:#ffffff;">';
            $bt = debug_backtrace();
            $caller = array_shift($bt);
            print "[ File : " . self::short( $caller[ 'file' ] ) . " ][ Line : " . $caller[ 'line' ] . " ]\n";
            print "--------------------------------------------------------------\n";
			print htmlspecialchars( $data );
			print "</pre>";
		}
		
		function post()
        {
			print '<pre style="margin:10px; border:1px dashed #999999; padding:10px; color:#333; background:#ffffff;">';
            $bt = debug_backtrace();
            $caller = array_shift($bt);
            print "[ File : " . self::short( $caller[ 'file' ] ) . " ][ Line : " . $caller[ 'line' ] . " ]\n";
            print "--------------------------------------------------------------\n";
			print_r( $_POST ) ;
			print "</pre>";
		}
		
		function get()
        {
			print '<pre style="margin:10px; border:1px dashed #999999; padding:10px; color:#333; background:#ffffff;">';
            $bt = debug_backtrace();
            $caller = array_shift($bt);
            print "[ File : " . self::short( $caller[ 'file' ] ) . " ][ Line : " . $caller[ 'line' ] . " ]\n";
            print "--------------------------------------------------------------\n";
			print_r( $_GET ) ;
			print "</pre>";
		}
		
		function request()
        {
			print '<pre style="margin:10px; border:1px dashed #999999; padding:10px; color:#333; background:#ffffff;">';
            $bt = debug_backtrace();
            $caller = array_shift($bt);
            print "[ File : " . self::short( $caller[ 'file' ] ) . " ][ Line : " . $caller[ 'line' ] . " ]\n";
            print "--------------------------------------------------------------\n";
			print_r( $_REQUEST ) ;
			print "</pre>";
		}
		
		function server()
        {
			print '<pre style="margin:10px; border:1px dashed #999999; padding:10px; color:#333; background:#ffffff;">';
            $bt = debug_backtrace();
            $caller = array_shift($bt);
            print "[ File : " . self::short( $caller[ 'file' ] ) . " ][ Line : " . $caller[ 'line' ] . " ]\n";
            print "--------------------------------------------------------------\n";
			print_r( $_SERVER ) ;
			print "</pre>";
		}

        function short( $str )
        {
            if( SHORT_PATH ){
                $theme = wp_get_theme();
                $str = $theme[ 'Name' ] . ':' . str_replace( str_replace( '/' , '\\' , get_template_directory() ) , '' , $str );
            }
            return $str;
        }
		
	}
?>
