jQuery(window).load(function() {
	if(jaguza_JS.isHome == true){							 
	  /*---The Slider---*/
	  jQuery('#jaguza-home-slider').flexslider();
	}
	
	if(jaguza_JS.back2Top == 1){
  jQuery(window).scroll(function() {
		if(jQuery(this).scrollTop() != 0) {
			jQuery('#scroll-to-top').fadeIn();	
		} else {
			jQuery('#scroll-to-top').fadeOut();
		}
	});
 
	jQuery('#scroll-to-top').click(function() {
		jQuery('body,html').animate({scrollTop:0},800);
	});	
	   }

});