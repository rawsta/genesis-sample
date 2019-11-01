/**
 * Raw Child entry point.
 *
 * @package Raw Child
 * @author  rawsta
 * @license GPL-2.0+
 */

var rawChildStart = ( function( $ ) {
	'use strict';

	/**
	 * Adjust site inner margin top to compensate for sticky header height.
	 *
	 * @since 2.6.0
	 */
	var moveContentBelowFixedHeader = function() {
		var siteInnerMarginTop = 0;

		if ( 'fixed' === $( '.site-header' ).css( 'position' ) ) {
			siteInnerMarginTop = $( '.site-header' ).outerHeight();
		}

		$( '.site-inner' ).css( 'margin-top', siteInnerMarginTop / 2 );
	},

	/**
	 * Initialize Raw Child Starter.
	 * Internal functions to execute on document load can be called here.
	 *
	 * @since 2.6.0
	 */
	init = function() {

		// Run on first load.
		moveContentBelowFixedHeader();

		// Run after window resize.
		$( window ).resize( function() {
			moveContentBelowFixedHeader();
		});

		// Run after the Customizer updates.
		// 1.5s delay is to allow logo area reflow.
		if ( 'undefined' != typeof wp.customize ) {
			wp.customize.bind( 'change', function( setting ) {
				setTimeout( function() {
					moveContentBelowFixedHeader();
				}, 1500 );
			});
		}
	};

	// Header .shrink Klasse hinzufügen um Header kleiner zu machen.
	$( window ).scroll( function() {
		if ( 40 < $( document ).scrollTop() ) {
			$( '.site-header' ).addClass( 'shrink' );
		} else {
			$( '.site-header' ).removeClass( 'shrink' );
		}
	});


    /**
	 * Smooth Scroll.
	 *
	 * @since 2.7.2
	 */

    // Smooth scrolling anchor links
    function rawChildScroll( hash ) {
        var target = $( hash );
        var topOffset = 0;
        target = target.length ? target : $( '[name=' + this.hash.slice( 1 ) + ']' );
        if ( target.length ) {
            if ( 'fixed' == $( '.site-header' ).css( 'position' ) ) {
                topOffset = $( '.site-header' ).height();
            }
            if ( $( 'body' ).hasClass( 'admin-bar' ) ) {
                topOffset = topOffset + $( '#wpadminbar' ).height();
            }
            $( 'html,body' ).animate({
                scrollTop: target.offset().top - topOffset
            }, 1000 );
            return false;
        }
    }

    // -- Smooth scroll on pageload
    if ( window.location.hash ) {
        rawChildScroll( window.location.hash );
    }

    // -- Smooth scroll on click
    $( 'a[href*="#"]:not([href="#"]):not(.no-scroll)' ).click( function() {
        if ( location.pathname.replace( /^\//, '' ) == this.pathname.replace( /^\//, '' ) || location.hostname == this.hostname ) {
            rawChildScroll( this.hash );
        }
    });


	// Expose the init function only.
	return {
		init: init
	};

}( jQuery ) );

jQuery( window ).on( 'load', rawChildStart.init );
