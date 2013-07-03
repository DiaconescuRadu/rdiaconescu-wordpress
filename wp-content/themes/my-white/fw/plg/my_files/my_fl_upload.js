
function mytheme_fl_upload( selector , box ){
    tools.popBox2( box );
    jQuery('#my-fl-upload-box').load( function(){
        if( jQuery( this ).contents().find('div.my-file-uploaded').length ){
            var $container = jQuery( this ).contents().find('div.my-file-uploaded');
            $container.find('input[type="button"]').unbind('click');
            $container.find('input[type="button"]').click(function(){
                jQuery( selector ).val(  $container.find('input#my-file-src').val() );
                tools.popBox2Hide( box );
                jQuery( '#my-fl-upload-box' ).attr( "src" , jQuery( '#my-fl-upload-box' ).attr( "src" ) );
            });
        }
    });
}

var lg = console.log;

function mytheme_fl_upload_2( tthis, box_id ){
    
    tools.popBox2( box_id );
    
	var parent = jQuery( tthis ).parent( );
    
	jQuery( '#my-fl-upload-box' ).load( function( ) {
		var framedata = jQuery( this ).contents( ).find( 'div.my-file-uploaded' );
		if( framedata.length ) {
			var $btn = jQuery( 'input[type="button"]', framedata );
			$btn.unbind( 'click' );
			$btn.click( function( ) {
                jQuery( "input[type=text]", parent ).val( framedata.find( 'input#my-file-src' ).val( ) );
                jQuery( '#my-fl-upload-box' ).attr( "src" , jQuery( '#my-fl-upload-box' ).attr( "src" ) );
				tools.popBox2Hide( box_id );
            } );
        }
    } );
}


function mytheme_fl_uploadImg( input , img , box ){
    
    tools.popBox2( box );
    
    jQuery('#my-fl-upload-box').load( function( ) {
        if( jQuery( this ).contents().find('div.my-file-uploaded').length ){
            var $container = jQuery( this ).contents().find('div.my-file-uploaded');
            $container.find('input[type="button"]').click(function(){
                jQuery( input ).val(  $container.find('input#my-file-src').val() );
                jQuery( img ).attr( 'src' , $container.find('input#my-file-src').val() );
                tools.popBox2Hide( box );
                jQuery( '#my-fl-upload-box' ).attr( "src" , jQuery( '#my-fl-upload-box' ).attr( "src" ) );
            });
        }
    });
}

function mytheme_fl_uploadID( selector , box ){
    
    tools.popBox2( box );
    
    jQuery('#my-fl-upload-box').load( function( ) {
        if( jQuery( this ).contents().find('div.my-file-uploaded').length ){
            var $container = jQuery( this ).contents().find('div.my-file-uploaded');
            $container.find('input[type="button"]').click(function(){
                jQuery( selector ).val(  $container.find('input#my-file-src').val() );
                jQuery( selector + '-ID' ).val(  $container.find('input#my-file-id').val() );
                tools.popBox2Hide( box );
                jQuery( '#my-fl-upload-box' ).attr( "src" , jQuery( '#my-fl-upload-box' ).attr( "src" ) );
            })
        }
    });
}