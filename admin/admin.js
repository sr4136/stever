jQuery(function($) {
	// only on place entry pages
	if( $( 'body' ).hasClass( 'wp-admin' ) && $( 'body' ).hasClass( 'post-type-place' ) ){
		$( '.field.field-address' ).append( '<button id="geocode">Geocode</button>' );
		$( '#geocode' ).on( 'click', function(e){
			e.preventDefault();
			var key = 'Fmjtd%7Cluu8216ang%2C72%3Do5-947wga';
			var address = $( '.field.field-address input' ).val();
			var url = 'http://www.mapquestapi.com/geocoding/v1/address?key=' + key + '&location=' + address;
			$.getJSON( url, function( data ) {
				var result = data.results[0].locations[0].latLng;
				if( result ){
					$( '.field.field-latitude input' ).val( result.lat );
					$( '.field.field-longitude input' ).val( result.lng );
					console.log( result.lat );
					console.log( result.lng );
				}
			} );
		} );
	}
});