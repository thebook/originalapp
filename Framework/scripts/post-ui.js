(function ($) { 

	load = { 
		
		image_load : function ( num, input, url, extra ) { 
			var prev = input.prev();
			switch ( num ) {
				case 'single' : 
					if ( prev.is('img') ) {  prev.empty().remove(); }
					input.before('<img src="'+ url +'" class="lf-uploaded-image" title="lightbox image" />');
				break;
				
				case 'gallery' :
					input.before('<span class="lf-removable-image" ><input type="hidden" id="lf-post-meta-' + extra[0] + '" name="' + extra[1] + '[' + extra[0] + ']['+ extra[2] +']" value="' + url +'" /><img src="'+ url +'" title="remove gallery image" /></span>');
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

		slider = {

			slider : function ( opt ) {

				var input = $('#' + opt.input);
				var display = input.prev();
				var inputvalue = input.val();

					$('#' + opt.slider ).slider({
						range: "min",
						value: [ inputvalue ],
						min: opt.min,
						max: opt.max,
						step: 2,
						create: function ( event, slider ) {
							slider.value = inputvalue;
							display.text(slider.value + opt.value);
						},
						slide: function ( event, slider ) {
							var value = slider.value;
							input.val(value);
							display.text(value + opt.value);
						}
				});
			}
		};

	color = {

		color : function (opt) {
			var input = $( opt.id );
			var color = $( opt.handle );
			var def   = opt.color.replace('#', '') || 'ffffff';
			
			color.ColorPicker({
				color: def,
				onSubmit: function (hsb_value, hex_value, rgb_value, element ) {
					input.val( hex_value );
					$(element).css('background-color', '#' + hex_value );
				},
				onShow: function (colorpicker_html) {
					var self = $(colorpicker_html);
					self.fadeIn('400');
					return false;
				},
				onHide: function (colorpicker_html) {
					var self = $(colorpicker_html);
					self.fadeOut('400');
					return false
				}
			});
		}
	};

	type = { 

		font : function (opt) { 
			
			var select     = $('#' + opt.select);
			var font_array = ["arial", "georgia"];

			select.on('change', 
				function () { 

					var font = $(this).val();
					var box  = $('#' + opt.box);

						if ( $.inArray(font, font_array ) === -1 ) {
							$.getScript("http://use.edgefonts.net/" + font + ".js");							
							font_array.push(font);
						}

						box.css({
							'font-family' :  font
						});
				}).change();
		}
	};

	ajax = { 

		reset : function (opt) { 

			$('#' + opt.reset ).on( 'click', 
				function () { 
					if (confirm("Are you sure you want to reset, reseting your options will strip them completely?")) {
						
						var button = $(this);
						var button_value = button.val();
						var	data = {};
							data.action = opt.action;
							data[opt.nonce_name] = opt.nonce;
							
							button.val('Reseting...');

							$.post(
								ajaxurl, 
								data,
								function (response) { 
									$.jGrowl(response.message, { speed: 400, sticky: true, header: response.header});
									button.val(button_value);
								},
								'json');
							}
						});
					},

		loadmore : function (opt) { 

				$('#' + opt.button ).on('click',
					function () { 

						var button = $(this);
						var button_old_text = button.text();
							button.text('Loading...');

						$.ajax({
				 			data     : { data : opt.data },
				 			url      : opt.link,
				 			dataType : "html",
				 			error    : function () { 	
								$.jGrowl( "There seems to have been an issue loading, please try again", { header: "Could not load", sticky: true });				 				
								button.val(button_old_text);
				 			},
				 			success  : function ( response, status ) {

								button.before( response );

				 				$.jGrowl(opt.message.text, { header: opt.message.header, life: 5000 });

				 				( opt.hide ? button.remove() : button.text(button_old_text) );
				 			}
				 		});
					});

		},

		save : function (opt) { 
			
			$('#' + opt.form).submit(
				function () { 
					var form = $(this);
					var button = $('#' + opt.save);
					var button_value = button.val();
					button.val('Saving...');

					$.post(
						ajaxurl,
						form.serialize(),
						function (response) {
							$.jGrowl(response.message, { speed: 400, sticky: true, header: response.header});
							button.val(button_value);
						},
						'json' );

					return false;
				});
		}
	};

})(jQuery);