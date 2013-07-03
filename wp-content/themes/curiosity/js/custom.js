jQuery(document).ready(function(){
	/*= main menu
	------------------------*/
	jQuery("#nav ul.menu").superfish({
		delay:         140,
		animation:   {opacity:'show',height:'show'},
		speed:       'normal',
		autoArrows:  true,  
		dropShadows: false  
	}); 		
	
	jQuery(".carousel-posts").jCarouselLite({
       		btnNext: ".carousel-next",
			btnPrev: ".carousel-prev",
			visible: 4,
			auto: 5000 
   	});	

	/*= slider settings
	------------------------*/
	
		var buttons = { 
			previous:jQuery('#jslidernews3 .button-previous') ,
			next:jQuery('#jslidernews3 .button-next') 
		};
		
		jQuery('#jslidernews3').lofJSidernews({ 
			interval:5000,
			easing:'easeOutBounce',
			duration:1200,
			auto:false,
			mainWidth:624,
			navigatorHeight : 74,
			navigatorWidth: 294,
			maxItemDisplay: 4,
			buttons:buttons
		});	
});

