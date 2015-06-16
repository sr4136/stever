jQuery(function($) {

	/* Admin Menu Adjustment (TODO: media query-ish this)*/
	$( '#adminmenu > li' ).on( 'mouseover', function(){
		$( this ).removeClass( 'wp-menu-open' ).removeClass( 'wp-has-current-submenu' ).addClass( 'wp-not-current-submenu' );
	} );

	/* only on place entry pages */
	if( $( 'body' ).hasClass( 'wp-admin' ) && $( 'body' ).hasClass( 'post-type-place' ) ){
		$( '.field.field-address' ).append( '<button id="geocode">Geocode</button>' );
		$( '#geocode' ).on( 'click', function(e){
			e.preventDefault();

			var titleVal = $( '#title' ).val();
			var address = $( '.field.field-address input' ).val();

			/* If address isn't filled in, grab the title and use that */
			if( !address ){
				$( '.field.field-address input' ).val( titleVal );
				address = $( '.field.field-address input' ).val();
			}

			var key = 'Fmjtd%7Cluu8216ang%2C72%3Do5-947wga';
			var url = 'http://open.mapquestapi.com/geocoding/v1/address?key=' + key + '&location=' + address;
			$.getJSON( url, function( data ) {
				var result = data.results[0].locations[0].latLng;
				if( result ){
					$( '.field.field-latitude input' ).val( result.lat );
					$( '.field.field-longitude input' ).val( result.lng );
					//console.log( result.lat );
					//console.log( result.lng );
				}
			} );
		} );
	}
});