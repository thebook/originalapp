(function($) { 

	use = { 
		slider : function( type, gallery ) { 
		var id, img, number, width, height, length, subwrap, arrows, position, mover, taller, dusk, dawn, decider, dot, fade, page;
			id 		= $( gallery );
			img		= id.find('img');
			number 	= img.length;
			width 	= id.width();
			height 	= img.height();
			length 	= number * width;
			subwrap = '<div style="width: '+ length +'px; height: ' + height + 'px; position: relative;" class="lf-post-format-gallery-wrap"></div>';
			arrows 	= '<span class="post-format-left-arrow"></span><span class="post-format-right-arrow"></span>';
			position = 0;
			
			mover = function ( p, w ) { subwrap.stop().animate({ 'margin-left' : -( p * w ) }, 700, "easeOutCirc" ); };
			taller = function ( h ) { id.stop().animate({'height' : h }, 700, "easeOutCirc" ); subwrap.stop().animate({'height' : h }, 700, "easeOutCirc" ); };
			dusk = function( p, h, w ) { id.stop().animate({'height' : h }, 700, "easeOutCirc" ); subwrap.stop().animate({'height' : h }, 700, "easeOutCirc", function() { subwrap.stop().animate({ 'margin-left' : -( p * w ) }, 700, "easeOutCirc" ); } ); };	
			dawn = function ( p, h, w ) { subwrap.stop().animate({ 'margin-left' : -( p * w ) }, 700, "easeOutCirc", function () { taller( h ); } );  };
			
			decider = function ( p, w ) { var nh = img.eq( p ).css('height'); var oh = img.eq( p - 1 ).css('height'); if ( oh > nh ) { dawn( p, nh, w ); } else { dusk( p, nh, w ); } };
			
			fade = function ( p ) { var h = img.eq( p ).css('height'); img.animate({ 'opacity' : '0' }, 450, "easeOutCirc" ).eq( p ).animate({ 'opacity' : '1' }, 450, "easeOutCirc", function () { taller( h ); } ); };
			
			// main append, css 
			id.css({ 'display' : 'block', 'overflow' : 'hidden', 'height' : height });
			img.wrapAll( subwrap ).css({'width' : width, 'display' : 'inline' }  );
			subwrap = img.parent();
			if ( type == 'fade' ) { img.css({ 'display' : 'block', 'position' : 'absolute', 'z-index' : '0', 'cursor' : 'pointer' } ); }
			
			// paging
			id.append('<div class="lf-post-format-gallery-dot"></div>');
			dot = $('.lf-post-format-gallery-dot');
			page = function ( p ) { var d = dot.find('span'); d.css('opacity', '0.40' ).eq( p ).css('opacity', '1' ); };
			for( var i = number; i--; ) { dot.append('<span class="post-format-gallery-dot"></span>'); };
			page( position );
		
			// arrows
			if ( type == 'slide' && number != 1 ) {
			id.prepend( arrows );
			aleft = id.children( '.post-format-left-arrow' );
			aright = id.children( '.post-format-right-arrow' );
			acheck = function ( p, al, ar, l ) { ( p === 0 ) ? ( al.css('display', 'none' ), ar.css('display', 'inline' ) ) : p == ( l - 1 )  ? ( ar.css( 'display', 'none' ), al.css('display', 'inline') ) : ( al.css('display', 'inline'), ar.css( 'display', 'inline' ) ) };
			acheck( position, aleft, aright, number );
			img.css('display', 'inline' );
			}
			
			// events
			id.bind( 'click', 
				function ( e ) { 
					var target = e.target,
						click = $( target );						
						if ( click.attr('class') == 'post-format-right-arrow' ) { 
							position = position + 1;
							decider( position, width );
							acheck( position, aleft, aright, number );
							page( position );
						}
						else if ( click.attr('class') == 'post-format-left-arrow' ) { 
							position = position - 1;
							decider( position, width );
							acheck( position, aleft, aright, number );
							page( position );
						}
						
						if ( click.is('img') && type == 'fade' ) { 
							position = ( position == number - 1 ) ? 0 : position + 1; 
							fade( position );
							page( position );
						}
						
						if ( click.attr('class') == 'post-format-gallery-dot' ) {
							position = click.index();
							page( position );
							( type == 'slide' ) ? ( decider( position, width ), acheck( position, aleft, aright, number ) ) : fade( position, width );		
						}
					});
			
		},	
	},

	toggle = {

		/**
		 * Handles the toggle animation and defaults
		 * @param  {object}     o  The paragraph "object" ( the text element )
		 * @param  {object}     c  The "character"(icon) holding element ( for up and down arrow switch )
		 * @param  {paramaters} oo "Options" for the animation, if not supplied the defaults kick in
		 * Animates the top and bottom pads as well as height, after which it changes the 'data-icon' to specified
		 */
		animate : function ( o, c, oo ) {

			var oo    = oo    || {};
			    oo.pt = oo.pt || '0px';
			    oo.pb = oo.pb || '0px';
			    oo.h  = oo.h  || '0px';
			    oo.s  = oo.s  || '0px';
			    oo.i  = oo.i  || 'f';

			o.stop().animate({
						'padding-top' : oo.pt,
						'padding-bottom' : oo.pb,
						'height' : oo.h 
					}, oo.s );

			c.attr('data-icon', oo.i );
		},
		/**
		 * "Toggles" bettwen open and closed state, handles the click and calls toggle.animate()
		 * @param  {object} o The element which wraps the toggle 
		 * @param  {string} s The value of the data-id attribute ( used to tell if closed )
		 * Binds the toggle and checks if the toggle is to be closed 
		 */
		t : function ( o, s ) { 
		
			var i  = $( o );
			var h  = i.children('.tog-lf-ti');
			var p  = i.children('.lf-tog-p');
			var c  = h.children('.tog-lf-c');
			var hi = p.height();
			var pt = p.css( 'padding-top' );
			var pb = p.css( 'padding-bottom' );
			var sp = 400;
			
			// Binds toggle
			h.toggle(	
				// Only passes the "paragraph" element and the "character"(icon) element ( the defaults kick in )
				function() {
					toggle.animate( p, c );
				},
				// Passes paragraph & character element, top and bottom padding(pb,pt), "height", (animation)"speed", and "icon" type("g") 
				function () {					
					toggle.animate( p, c, { pt : pt, pb : pb, h  : hi, s  : sp, i  : 'g' } );
				} 
			);
			// If "State" is close then we triger the first toggle, and display the text as block
			if( s == 'close' ) { 
				h.trigger('click'); 
				p.css('display', 'block') 
			}
		},

		/**
		 * Calls toggle.t for every element with the given class and inits the toggle box
		 * @param  {string} o The element class
		 * Gets the atrribute 'data-id' value and passes it to .t() for "if closed" reference
		 */
		tog : function ( o ) { 

			$( o ).each( 
				function() { 
					var id = $(this).attr('data-id');
					toggle.t( this, id );
				});
			}
	},

	tab = {

		/**
		 * Fades out tabs and fades in selected tab
		 * @param  {int}    i The "index" of the selected tab
		 * @param  {object} o The element("object") on which to do animation
		 * @param  {object} l The "li"s which hold the tab links
		 * @param  {object} s The "selected" tab 'li'
		 */
		fader : function( i, o, l, s ) { 

			// Fade all tabs out
			o.stop().animate({
				'opacity' : '0' 
				}, 200, "easeOutCirc",
				function() {
					o.addClass('tab-close-lf');
				});
			// Fade tab in
			o.eq( i ).stop().animate({
				'opacity' : '1',
				'display' : 'block'
			}, 200, 
			function() {
				o.eq( i ).removeClass('tab-close-lf');
			});

			// Removes all "tab-chosen-li-lf" ( unselects )
			l.removeClass('tab-chosen-li-lf');
			// Adds "tab-chosen-li-lf" to the selected tab
			s.addClass('tab-chosen-li-lf');
		},

		/**
		 * Switches tabs
		 * @param  {object} o The element which holds the tabs ( tab wrap )
		 * Handles click event and passes the li index to tab.fader() & inits
		 */
		tab : function( o ) { 
			var id    = $( o );
			var tabs  = id.children('.tab-head-lf').find('li');
			var boxes = id.children('.tab-box-lf');

			id.bind( 'click', 
				function ( e ) { 
					var t  = e.target;
					var	cp = $( t ).parent();
						
						if ( cp.attr('class') == 'tab-li-lf' ) {
							var index = cp.index();
							tab.fader( index, boxes, tabs, cp );				
						}
					});

			tab.fader( 0, boxes, tabs, tabs.eq(0) );
		},

		/**
		 * Calls tab.tab for every element of the given class, this inits all the tabs
		 * @param  {string} o The tab class name
		 */
		tabs : function( o ) { 			

			$( o ).each(
				function() { 
					tab.tab( this );		
				});
		}
	};
})(jQuery);

/**
 * Inits the toggles and tabs
 */
$(document).ready( 
	function() {
		toggle.tog('.tog-lf');
		tab.tabs('.tab-wrap-lf');
});