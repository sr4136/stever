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
	
	if( $( '.imgwall' ).length > 0 ){
		$(window).load(function() {
			var wall = new freewall(".imgwall");
			wall.reset({
				selector: 'img',
				animate: true,
				cellW: 150,
				cellH: 84,
				delay: 0,
				onComplete: function() {
					var selector = wall.container.selector;
					$( selector ).find( 'img' ).show();
				}
			});
			wall.fitWidth();
		});
	}
	
	
	$(".rslides").responsiveSlides({
		auto: false,             // Boolean: Animate automatically, true or false
		speed: 500,            // Integer: Speed of the transition, in milliseconds
		timeout: 4000,          // Integer: Time between slide transitions, in milliseconds
		pager: true,           // Boolean: Show pager, true or false
		nav: true,             // Boolean: Show navigation, true or false
		random: false,          // Boolean: Randomize the order of the slides, true or false
		pause: false,           // Boolean: Pause on hover, true or false
		pauseControls: true,    // Boolean: Pause when hovering controls, true or false
		prevText: "Previous",   // String: Text for the "previous" button
		nextText: "Next",       // String: Text for the "next" button
		maxwidth: "",           // Integer: Max-width of the slideshow, in pixels
		navContainer: "",       // Selector: Where controls should be appended to, default is after the 'ul'
		manualControls: "",     // Selector: Declare custom pager navigation
		namespace: "rslides",   // String: Change the default namespace used
	});

	function openGallery( pair, index ) {
		$theGal = $( '.postGal[data-pair="' + pair + '"]');
		
		$theGal.find( '.rslides_tabs li:eq(' + index + ') a' ).click();
					
		if( $theGal.hasClass( 'hidden' ) ){
			$( '.postGal' ).not( $theGal ).addClass( 'hidden' );
			$theGal.stop( true, true ).fadeIn({ duration: 300, queue: false }).css( 'display', 'none' ).slideDown( 300, function(){
				$( this ).removeClass( 'hidden' ).addClass( 'open' );
			} );
		}
		$( 'html, body ').animate( {
			scrollTop: $theGal.offset().top
		}, 200 );
	}
	

	function closeGallery() {
		$( ".postGal:not('hidden')" ).slideUp({ duration: 300, queue: false }).fadeOut( 300, function(){
			$( this ).addClass( 'hidden' ).removeClass( 'open' );
		});
	}

	$( '.imgwall img' ).on( 'click', function() {
		var pair = $( this ).parents( '.imgwall' ).data( 'pair' );
		var index = $( this ).parent( 'li' ).index();
		
		openGallery( pair, index );
	});

	$( '.postGal .close' ).on( 'click', closeGallery );
	
	
} );