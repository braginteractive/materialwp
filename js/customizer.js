/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );

	// Navigation Background color
	wp.customize( 'navigation_background_color', function( value ) {
		value.bind( function( to ) {
			$( '.navbar-inverse.navbar' ).css( {
				'background-color': to
			} );
		} );
	} );

	// Complimentary color
	wp.customize( 'complimentary_color', function( value ) {
		value.bind( function( to ) {
			$( '.panel-warning>.panel-heading' ).css( {
				'background-color': to
			} );
		} );
	} );

	// Link color
	wp.customize( 'link_color', function( value ) {
		value.bind( function( to ) {
			$( '.entry-content a' ).css( {
				'color': to
			} );
			$( '.panel a' ).css( {
				'color': to
			} );
		} );
	} );
} )( jQuery );
