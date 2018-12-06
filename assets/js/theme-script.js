(function($){
	"use strict";

	CherryJsCore.utilites.namespace('theme_script');
	CherryJsCore.theme_script = {
		init: function () {
			// Document ready event check
			if( CherryJsCore.status.is_ready ){
				this.document_ready_render();
			}else{
				CherryJsCore.variable.$document.on( 'ready', this.document_ready_render.bind( this ) );
			}
		},

		document_ready_render: function () {
			this.responsiveMenuInit( this );
			this.stickyFooter( this );
			this.cherrySearchInputIconHide( this );
			this.to_top_init( this );
			this.elementorAccordeonClosedDefault( this );
			//this.wapuStickySidebar( this );

		},

		elementorAccordeonClosedDefault: function( self ) {
			var delay = 100;
			setTimeout(function() {
				$('.quick_links .elementor-tab-title').removeClass('elementor-active');
				$('.quick_links .elementor-tab-content').css('display', 'none');
			}, delay);
		},

		/*
		wapuStickySidebar: function( self ) {

			var $sticky = $('.primary-sidebar-area');
			var $stickyrStopper = $('.footer-area-wrap');

			if ( !!$sticky.offset() ) {

				var generalSidebarHeight = $sticky.outerHeight();
				var stickyTop = $sticky.offset().top;
				var stickOffset = 0;
				var stickyStopperPosition = $stickyrStopper.offset().top;
				var stopPoint = stickyStopperPosition - generalSidebarHeight - stickOffset;
				var diff = stopPoint + stickOffset;

				console.log(generalSidebarHeight);

				$( window ).scroll( function() { //
				var windowTop = $(window).scrollTop();
				console.log($(window).scrollTop());

				if ( stopPoint < windowTop ) {
					$sticky.css( { position: 'relative', top: diff });

					} else if ( stickyTop < windowTop+stickOffset ) {
						$('.primary-sidebar-area').css({ position: 'fixed', top: 0, marginTop: 0 });
					} else {
						$sticky.css('position','relative').css({ marginTop: '4.375em' });
					}
				});
			}

		},*/

		cherrySearchInputIconHide: function( self ) {
			var targetField = $(".cherry-search__form .search-form__field");
			var targetIcon = $(".cherry-search__form .input-search-icon");

			targetField.on( {
				blur: function() {
					if( !$(this).val() ) {
						targetIcon.animate({opacity: "1"}, 200);
					}
				},
				focus: function() {
					targetIcon.animate({opacity: "0"}, 200);
				}
			} );
		},

		stickyFooter: function( self ) {
			var bodyHeight = $("body").height();
			var vwptHeight = $(window).height();
			var footerHeight = $("footer#colophon").outerHeight();
			if (vwptHeight > bodyHeight) {
				$("footer#colophon").css("position","fixed").css("bottom",0).css("width", '100%');
				$(".site-content_wrap").css( 'margin-bottom', '425px');
				$(".footer-area-wrap").css("position","fixed").css("bottom", footerHeight).css("width", '100%');

			}
		},

		responsiveMenuInit: function( self ) {
			var moreMenuContent = '&middot;&middot;&middot;',
			imgurl,
			srcset,
			clotting = true;

			if ( window.__tm && window.__tm.more_button_options && window.__tm.more_button_options.more_button_type ) {
				switch ( window.__tm.more_button_options.more_button_type ) {
					case 'image':
					imgurl = window.__tm.more_button_options.more_button_image_url;

					if ( window.__tm.more_button_options.retina_more_button_image_url ) {
						srcset = ' srcset="' + window.__tm.more_button_options.retina_more_button_image_url + ' 2x"';
					}
					moreMenuContent = '<img src="' + imgurl + '"' + srcset + ' alt="' + moreMenuContent + '">';
					break;
					case 'icon':
					moreMenuContent = '<i class="fa ' + window.__tm.more_button_options.more_button_icon + '"></i>';
					break;
					case 'text':
					default:
					moreMenuContent = window.__tm.more_button_options.more_button_text || moreMenuContent;
					break;
				}

				clotting = window.__tm.more_button_options.menu_clotting;
			}

			$( '.main-navigation' ).cherryResponsiveMenu({
				moreMenuContent: moreMenuContent,
				clotting:        false
			});

		},
		to_top_init: function ( self ) {
			/*if ( $.isFunction( jQuery.fn.UItoTop ) ) {
				$().UItoTop({
					scrollSpeed: 600
				});
			}*/
		},

	}
	CherryJsCore.theme_script.init();
}(jQuery));