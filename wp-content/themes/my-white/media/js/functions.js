jQuery(function(){
    var winHeight = parseInt( jQuery(window).height() );
    var height = parseInt( jQuery('div.under-construction').height() );
    if( winHeight > height + 40 ){
        var margin = -1 * parseInt( height / 2 );
        jQuery('div.under-construction').css({ 'margin-top' : margin + 'px' });
    }
    else{
        jQuery('div.position-center').css({ 'width' : '100%' , 'display' : 'block' , 'position' : 'relative' , 'top' : '0px' , 'left' : '0px' });
        jQuery('div.under-construction').css({ 'margin' : '20px auto' , 'position' : 'relative' });
    }
});