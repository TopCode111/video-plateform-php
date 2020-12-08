/**
 * File customizer.js.
 *
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
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );
// header_bg_color
    wp.customize( 'header_bg_color', function( value ) {
        value.bind( function( to ) {
            $( '.header-section' ).css( 'background-color', to );
        } );
    });
// custom_menu_color	
	wp.customize( 'custom_menu_color', function( value ) {
        value.bind( function( to ) {
            $( 'ul.primary-menu>li>a' ).css( 'color', to );
        } );
    });
	
// Bread Crumb  Color	
	wp.customize( 'bread_title_color', function( value ) {
        value.bind( function( to ) {
            $( '.page-title h3' ).css( 'color', to );
        } );
    });	
	
// Bread Crumb BG Color	
	wp.customize( 'bread_bg_color', function( value ) {
        value.bind( function( to ) {
            $( '.page-title' ).css( 'color', to );
        } );
    });

// copyright_txt
    wp.customize( 'copyright_txt', function( value ) {
        value.bind( function( newvalue ) {
            $( '#copyright-txt' ).html( newvalue);
        } );
    });


} )( jQuery );
