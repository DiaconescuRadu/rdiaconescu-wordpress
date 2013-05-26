jQuery(document).ready( function($) {

	$('#widgets-right').ajaxComplete( function(event, XMLHttpRequest, ajaxOptions) {

	$( '#widgets-right .widget-sortable' ).sortable({
		connectWith: '.connected',
		update: function( event, ui ){ updateData(event, ui) }
	});
	
	$("#widgets-right .widget-checkbox").change(function(){
		if (this.checked) {
			$(this).parent().addClass('tab-selected');			
		}
		else {
			$(this).parent().removeClass('tab-selected');			
		}
	});
	
	});

	$( '#widgets-right .widget-sortable' ).sortable({
		connectWith: '.connected',
		update: function( event, ui ){ updateData(event, ui) }
	});
	
	function updateData(event, ui) {
		var $target = $(event.target);
		
		var $data = $target.sortable('serialize');
		
		if ( $target.is('#sl-active') || $target.is('#widget-nav-tabs') ) {
			$target.parent().children('.voyagedata').val( $data );
		}
	}
	
	$("#widgets-right .widget-checkbox").change(function(){
		if (this.checked) {
			$(this).parent().addClass('tab-selected');			
		}
		else {
			$(this).parent().removeClass('tab-selected');			
		}
	});
});

