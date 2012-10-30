(function ($) { 

	load = { 
		
		image_load : function ( num, input, url, extra ) { 
			var prev = input.prev();
			switch ( num ) {
				case 'single' : 
					if ( prev.is('img') ) {  prev.empty().remove(); }
					input.before('<img src="'+ url +'" class="lf-admin-post-meta-td-image" title="lightbox image" />');
				break;
				
				case 'gallery' :
					input.before('<span class="lf-admin-post-meta-td-image-removeable" ><input type="hidden" id="lf-post-meta-' + extra[0] + '" name="' + extra[1] + '[' + extra[0] + ']['+ extra[2] +']" value="' + url +'" /><img src="'+ url +'" title="remove gallery image" /></span>');
				break;
			}
		},	

		upload : function( id, input ) { 
			var theid = '';
			var	sender = '';
			var	button = $( id );
				input = $( input );
					
				button.bind( 
					'click', 
					function () { 
						
						theid = input.attr('id');
						
						tb_show( '', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true' );
							
						dsend = window.send_to_editor;
							
						$( '#TB_closeWindowButton' ).bind( 'click', function () { window.send_to_editor = dsend; });
							
						sender = function (html) { 	
							imgurl = $( 'img', html ).attr('src');
							$('#' + theid ).val(imgurl);
							tb_remove();  
							load.image_load( 'single', button, imgurl );
							window.send_to_editor = dsend;
						};
							
						window.send_to_editor = sender;
								
					});
				},	

		gallery : function( id, name, opt ) { 
			var sender;
			var	button = $( id );
			var	td = button.parent();
			
                td.bind( 'click',
                    function( e ) {
                        var target = e.target,
                        img = $( target ).parent();
                             
                        if ( target.nodeName === 'IMG' ) {  
                            img.empty().remove();
                        }
					});
					
				button.bind( 
					'click', 
					function () { 
						tb_show( '', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true' );
						
						dsend = window.send_to_editor;
						
						$( '#TB_closeWindowButton' ).bind( 'click', function () { window.send_to_editor = dsend; });
						
						sender = function (html) { 	
							imgurl = $( 'img', html ).attr('src');	
							math = Math.random().toString( 36 ).substring( 4 );
							count = imgurl + math;
							load.image_load( 'gallery', button, imgurl, [ name, opt, count ] );	
							tb_remove();  
							window.send_to_editor = dsend; 
						};
					
						window.send_to_editor = sender; 			
					});			
				}
	};

	tab = { 

		tab : function (nav, content) {

			$(nav).bind('click',
				function () {
					var dhis = $(this); 
					var trigger = dhis.attr('href');
						$(content).hide();
						$(trigger + '-page').show();
						$(nav).removeClass('open-page');
						dhis.addClass('open-page');
				});
			},

		init : function (nav, content) {

			this.tab(nav, content);
			$(nav).eq(0).click();
		}
	};

	reveal = { 

		reveal : function ( id, tohide, map ) {

			var selector = $( id );
			selector.bind(
				'change', 
				function () {
				var find = $( map ).map( 
							function ( index ) { 
							var theval =  map[index]; 	
								return selector.attr( "value" ) == theval; 
							}).get();
			
				checker = $.inArray( true, find );
					
				if 	( checker > -1 ) { 
					if ( $( tohide ).css('display') == 'none' ) {
						$( tohide ).show(); 
					} 
				} 										
				else {	
					$( tohide ).hide();
				} 
			}); 
			selector.change(); 		
		},

		hider : function ( values, elements, input ) { 
			$( values ).map( function( index ) {
				var v = values[index];
				var e = elements[index];
				if ( input == v ) { $( e ).show(); } else { $( e ).hide(); }
			});
		},

		radio_reveal : function ( wrap, radval, meta ) { 
			var id = $( wrap );
			var r = id.find('input[type=radio]');	
				id.bind('click',
					function( e ) { 
						var target = e.target;
						var	click = $( target );
						var	val = click.attr('value');
						var ch  = click.attr('checked');
						if ( ch == 'checked' ) { reveal.hider( radval, meta, val ); }		
					});	
				r.each( 
					function() { 
						var t = $( this );
						var val = t.attr('value');
						var ch  = t.attr('checked');
						if ( ch == 'checked' ) { reveal.hider( radval, meta, val ); }
					});
				}
	};

})(jQuery);