(function ($) { 
	
	behave_funcs = {
	
		toggle_animate : function ( obj, type, height ) {
			if ( type == 'hide' ) {
				$(obj).stop().animate({
				'height' : '0px',
				'opacity' : '0' 
				}, 400 );
				$(obj).parent().find('.lf-action-opt-square-small'
					).css({ 
						'height' : '6px',
						'width' : '6px',
						'margin' : '6px' } );
			}
			else if ( type == 'show' ) {
				$(obj).stop().animate({
				'height' : height,
				'opacity' : '1' 
				}, 400 );
				$(obj).parent().find('.lf-action-opt-square-small'
					).css({ 
						'height' : '12px',
						'width' : '12px',
						'margin' : '3px' } );
				}
			
		},
	
		toggle : function( id, closed ) {
		
			var wrap = $( id ).find('.lf-toggle-box-inner-wrap');
				
			wrap.each( function ( index ) {
				var curwrap = $(this);
				var thecontent = curwrap.find('.lf-toggle-box-content');
				var height = thecontent.height();
	
				curwrap.find(
					'.lf-toggle-box-head'
					).toggle( 
						function () {
							behave_funcs.toggle_animate( thecontent, 'hide' );
						},
						function () {
							behave_funcs.toggle_animate( thecontent, 'show', height );
						});		
					});	
			if ( closed == 'close' ) {
				
				wrap.find('.lf-toggle-box-head').trigger('click');
			
			}
			
			
		}
	
	},
	
	portfolio_funcs = {
	
		filter : function( button, text, post ) { 
			
			$( button ).bind( 'click', 
				function () { 
				var filter_value = $(this).find(
										text
										).text();
				
				$( '.' + filter_value )
					.css({
					'display' : 'block',
					'width' : '100%',
					'height' : 'auto',
					}).animate({
					'opacity' : '1'
					}, 700 );
					
				$( post ).not(
					'.' + filter_value 
					).each( 
					function () {
					
						var height = $(this).height();
							width = $(this).width();
							
						$(this).animate({
							'width' : '0px',
							'height' : '0px',
							'margin-top' : height / 2 +'px',
							'margin-bottom' : height / 2 +'px',
							'margin-left' : width / 2 + 'px',
							'opacity' : '0'
							}, 700,
							'swing',
							function () { 
								$(this).css({
								'display' : 'none',
								'margin' : '0px'
								});
							});
					});	
				});	
		},

		lightbox : function () {
		
			$('.lf-featured-image-opt').each( function () {
				var mes = parseInt( $( this ).prev().css( 'height' ), 10 ) - 68,
					height = mes,
					opt = $(this),
					parent = opt.parent(),
					img = parent.find('img').attr('src');
			
				$( this ).children().toggle(
					function() { 
					
						opt.wrapAll('<div class="lf-featured-image-lightboxed"></div>');
						opt.before('<img src="' + img + '" />');
						$('.lf-featured-image-lightboxed'
							).css({
							'opacity' : '0',
							'height' : '0px',
							'width' : '0px'
							}).animate({
							'height' : '85%',
							'width' : '85%',
							'opacity' : '1'
							}, 400 );
						
						height = 24;
					},
					function () { 
					
						$('.lf-featured-image-lightboxed'
							).animate({
							'height' : '0px',
							'width' : '0px',
							'opacity' : '0'
							}, 400, 
							function() {
								opt.parent().find('img').remove();
						
								contents = opt.parent().contents();
						
								opt.parent().replaceWith( contents );
						
								opt.css( {
									'display' : 'none',
									'top' : '0px',
									'opacity' : '0'
									});
							});
						
						height = mes; 
						
							
						});
						
					$(this).parent().hover( 
						function () { 
							opt.css( 
								'display', 'block' 
								).stop().animate({ 
								'top' : '-' + ( height / 2 ) + 'px',
								'opacity' : '1' 
								}, 400 );	
						},
						function () {
							opt.stop().animate({ 
								'top' : '0',
								'opacity' : '0'
								}, 400,
								function () {
									$(this).css('display', 'none' );
									});
						}); 
					});
		}
		
	}
	
})(jQuery);

$(document).ready( 
	function () {
		portfolio_funcs.filter(	
			'.lf-portfolio-filter-bar-hook .lf-portfolio-filter-text',
			'.lf-portfolio-filter-hidden',
			'.lf-portfolio-filter-piece' 
			);
	if ( $(window).width() > 900 ) { 	
		portfolio_funcs.lightbox();
	}
		
});	

( function ($) {
	var isunbound = 'bound';
	$(window).resize(
	function() {
		
		if ( $(window).width() < 900 && isunbound == 'bound' ) {
			$('.lf-featured-image-opt').each( function () {
				$(this).children().unbind('click');
				$(this).parent().unbind('hover');
				$(this).css({ 
				'display' : 'none',
				'top' : '0px',
				'opacity' : '0'
				});
			});
			isunbound = 'unbound';
		}
		
		if ( $(window).width() > 900 && isunbound == 'unbound' ) {
			portfolio_funcs.lightbox();
			isunbound = 'bound';
		}
	});
})(jQuery);