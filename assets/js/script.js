(function($) {

    // Scroll to top

    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 600) {
            $('.scroll-top').fadeIn(600);
        } else {
            $('.scroll-top').fadeOut(600);
        }
    });
    $('.scroll-top').on("click", function () {
        $("html,body").animate({
            scrollTop: 0
        }, 500);
        return false;
    });


    // Add Arrow
    $(".main-navigation").find('ul').siblings('a').append('<span class="arrow"></span>');
    $(".arrow").on('click',function(){
        $(this).closest('.menu-item-has-children').find('.sub-menu').toggleClass("show");
    });

    // Stop Scrolling
    $.fn.stopScrolling = function() {
        $('body').on('wheel.modal mousewheel.modal', function () {return false;});
        return this;
    };

    // Restore Scrolling
    $.fn.restoreScrolling = function() {
        $('body').off('wheel.modal mousewheel.modal');
        return this;
    };

    // Toggle Menu
    $( '.hamburger-menu' ).on( 'click', function() {
        $('.body-overlay').addClass('is-active');
        $('.main-navigation').toggleClass('is-active');
        $(this).toggleClass('cross');
        $.fn.stopScrolling();
    });

    $( '.hamburger-menu.cross, .close-navigation' ).on( 'click', function() {
        $('.hamburger-menu').removeClass('cross');
        $('.body-overlay').removeClass('is-active');
        $('.main-navigation').removeClass('is-active');
        $.fn.restoreScrolling();
    });

    // Keyboard Esc
    $(document).keyup(function(e) {
        if (e.keyCode === 27) {
            $('.hamburger-menu').removeClass('cross');
            $('.body-overlay').removeClass('is-active');
            $('.main-navigation').removeClass('is-active');
            $.fn.restoreScrolling();
        }
    });

    $(document).on( 'click', function (e) {
        if ( $( e.target).closest( '.hamburger-menu,.main-navigation' ).length === 0 ) {
            $('.body-overlay').removeClass('is-active');
            $('.main-navigation').removeClass('is-active');
            $('.hamburger-menu').removeClass('cross');
            $.fn.restoreScrolling();
        }
    });

    // Widget add children class
    $(".widget .children").parent().addClass('haschildren');
	
	
		//Update Header Style and Scroll to Top
	function headerStyle() {
		if($('.main-header').length){
			var windowpos = $(window).scrollTop();
			var siteHeader = $('.main-header');
			var sticky_header = $('.fixed-header .main-box');
			var scrollLink = $('.scroll-to-top');
			if (windowpos > 70) {
				siteHeader.addClass('fixed-header');
				scrollLink.fadeIn(300);
			} else {
				siteHeader.removeClass('fixed-header');
				scrollLink.fadeOut(300);
			}
		}
	}
	
	headerStyle();
	
	//Submenu Dropdown Toggle
	if($('.main-header li.dropdown ul').length){
		$('.main-header li.dropdown').append('<div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>');
		
		//Dropdown Button
		$('.main-header li.dropdown .dropdown-btn').on('click', function() {
			$(this).prev('ul').slideToggle(500);
		});
		
		//Disable dropdown parent link
		$('.main-header .navigation li.dropdown > a,.hidden-bar .side-menu li.dropdown > a').on('click', function(e) {
			e.preventDefault();
		});
	}


})(jQuery);

( function() {
	var container, button, menu, links, i, len;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	( function( container ) {
		var touchStartFn, i,
			parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

		if ( 'ontouchstart' in window ) {
			touchStartFn = function( e ) {
				var menuItem = this.parentNode, i;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
				} else {
					menuItem.classList.remove( 'focus' );
				}
			};

			for ( i = 0; i < parentLink.length; ++i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( container ) );
} )();
( function() {
	var isIe = /(trident|msie)/i.test( navigator.userAgent );

	if ( isIe && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
} )();

