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
			
		}
	};
})(jQuery);