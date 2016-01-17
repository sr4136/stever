jQuery( function( $ ) {
	
	$scroll_pos = 0;
	
	$( '.portfolio-meta img' ).on( 'click', function(){
		$scroll_pos = $( document ).scrollTop();
		
		$( '.hidden-gallery' ).slideDown();
		$( 'html, body' ).animate( {
			scrollTop: $( '.hidden-gallery' ).offset().top
		}, 500 );
	} );
	$( '.close-gallery' ).on( 'click', function(){
		$( '.hidden-gallery' ).slideUp();
		$( 'html, body' ).animate( {
			scrollTop: $scroll_pos
		}, 500 );
	} );
} );