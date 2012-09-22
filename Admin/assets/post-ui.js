(function ($) { 

	parts = { 
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
		supload : function( id, input ) { 
			var theid = '',
				sender = '',
				button = $( id );
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
							parts.image_load( 'single', button, imgurl );
							window.send_to_editor = dsend;
						};
							
						window.send_to_editor = sender;
								
					});
				},	
		gallery : function( id, name, opt ) { 
			var sender,
				button = $( id );
				td = button.parent();
			
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
							parts.image_load( 'gallery', button, imgurl, [ name, opt, count ] );	
							tb_remove();  
							window.send_to_editor = dsend; 
						};
					
						window.send_to_editor = sender; 			
					});			
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
						if ( ch == 'checked' ) { parts.hider( radval, meta, val ); }		
					});	
				r.each( 
					function() { 
						var t = $( this );
						var val = t.attr('value');
						var ch  = t.attr('checked');
						if ( ch == 'checked' ) { parts.hider( radval, meta, val ); }
					});
				}
	};

})(jQuery);