( function ($) {

	lf_ui_parts = { 
		adminreveal : function ( slectorid, choseninput, topmap ) {
			$( slectorid ).bind(
				'change', 
				function () {
					var mapio = $( topmap ).map( function ( index ) {
						var theval =  topmap[index];
						return $( slectorid ).attr( "value") == theval;
						} ).get();
						mapudos = $.inArray( true, mapio );
					if 	(  mapudos > -1 ) { 
							if ( $(choseninput).closest('.lf_admin_core_option_wrap').css('display') == 'none' ) {
									$(choseninput).closest('.lf_admin_core_option_wrap').show(); 
									} 
								} 										
							else {	
									$(choseninput).closest('.lf_admin_core_option_wrap').hide();
								}	
						});
						$( slectorid ).change();				
					},
		slider_control : function ( theid, min, max, value ) {	
			$(theid).slider({
				range: "min",
				value: [ jQuery(theid).next('.slider-scaling-input').val() ],
				min: min ,
				max: max,
				slide: function ( event, ui ) { 
					$(theid).next('.slider-scaling-input').val( ui.value ); 
					$(theid).parent().next('.slider-scaling-desc-part').text( ui.value + value ); 
					}
				});
			},
		slides_generate : function () { 
			var count = $('.lf-option-table tr').size() - 1;
			$('.lf-slider-ui-add-button').click( 
				'bind', 
				function () {
					count = count + 1;
					$( '<tr class="lf_slider_main_meta_tr' + count + '"><th>Slide ' + count + '</th><td><div id="lf_slider_main_meta_upload_id' + count + '" class="lf_admin_core_upload_wrap"><input type="text" name="main_meta[slider_image_upload' + count + ']" id="lf_slider_main_meta_upload_input_id' + count +'" class="lf_admin_core_upload_input" value="" /><input type="button" id="_button" class="lf_admin_core_upload_button" value="Upload" /></div></td></tr>'
						).appendTo('.lf-option-table tbody');
					$('.lf_admin_core_upload_wrap').each( function () { 
						$(this).children(
							'.lf_admin_core_upload_button'
							).unbind( 'click' ); 
						});
					$('<img style="display:none" src="" />'
						).appendTo('.lf_slider_main_meta_image_preview');	
					lf_ui_parts.media_upload_slider_meta();	
				});	
				
			$('.lf-slider-ui-remove-button').click( 
				'bind', 
				function () {
					if ( count!== 0 ) {
						count = count - 1;
						$('.lf-option-table tbody tr:last-child')
							.remove();
						$('.lf_slider_main_meta_image_preview img:last-child')
							.remove();
						}
					});
		},
		media_upload_slider_meta : function() {
			var theid = "stuff",
				indexo = '';
				$('.lf_admin_core_upload_wrap').each( function ( index ) { 
					$(this).children('.lf_admin_core_upload_button').bind( 'click', function () { 
						indexo = $(this).parents('tr').index();	
						formfield = $(this).parent()
							.children(
								'.lf_admin_core_upload_input'
								).attr('name'),
						theid = $(this).parent()
							.children(
								'.lf_admin_core_upload_input'
								).attr('id');
						
						tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true' );		
						return false;		
					});	
					window.send_to_editor = function (html) { 	
						imgurl = $( 'img', html ).attr('src');
						$('#' + theid ).val(imgurl);
						tb_remove();
						
						$('.lf_slider_main_meta_image_preview img')
							.eq( indexo - 1 ).before('<img src=' + imgurl + ' />');
							
						$('.lf_slider_main_meta_image_preview img')
							.eq( indexo ).remove();	
					}
				});	
		},
		media_upload_init : function() { 
			var theid = "stuff";
				$('.lf_admin_core_upload_wrap').each( function () { 
					$(this).children('.lf_admin_core_upload_button').bind( 'click', function () { 
						formfield = $(this).parent()
							.children(
								'.lf_admin_core_upload_input'
								).attr('name'),
						theid = $(this).parent()
							.children(
								'.lf_admin_core_upload_input'
								).attr('id');
						
						tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true' );		
						return false;		
					});	
					window.send_to_editor = function (html) { 	
						imgurl = $( 'img', html ).attr('src');
						$('#' + theid ).val(imgurl);
						tb_remove();
					}
				});
			},
		presets : function( id ) { 
			var arr = {"header_state":"leftad","slider_state":"noslider","content_state":"nosidebar","footer_state":"fourwidget","header_advert_type":"leaderboard","header_leaderboard_ad_code":"","header_banner_ad_code":"","header_title_state":"title","header_title_font":"\"Georgia\", serif","header_text_style":"normal","header_title_font_size":"43","header_title_color":"","header_title_position":"center","logo_upload":"http:\/\/localhost:36792\/wp-content\/uploads\/2012\/06\/Whitewhalelogo.png","logo_sizeus":"68","logo_orentation":"after","header_background_state":"none","header_height":"142","header_background_image":"http:\/\/localhost:36792\/wp-content\/uploads\/2012\/07\/goldfish.jpg","header_background_color":"","header_show_topbar":"no","header_topbar_text":"","header_show_bottombar":"no","header_bottombar_text":"custom text sucka chu","header_bars_color":"","header_bars_text_color":"","navigation_state":"fullnav","nav_breadcrumbs_state":"hidden","navigation_background_color":"","navigation_text_color":"","navigation_text_hover_color":"","navigation_text_align":"left","navigation_remove_dropshadow":"yes","slider_height":"","slider_auto_play":"noautoplay","slider_duration":"","slider_text_font":"\"Georgia\", serif","slider_text_size":"","slider_text_color":"","slider_text_highlight_color":"","slider_shading_state":"fullshading","slider_background_color":"","slider_shorttag_display":"show","slider_shorttag_text":"","posttitle_font_choice":"\"Georgia\", serif","posttitle_text_size":"","posttitle_text_style":"normal","posttitle_text_color":"","meta_text_size":"","meta_text_style":"normal","meta_text_color":"","meta_text_highlight_color":"","body_font_choice":"\"Georgia\", serif","body_text_size":"","body_text_style":"normal","body_header_font_choice":"\"Georgia\", serif","body_text_headers_style":"normal","body_text_color":"","more_button_state":"styled","more_button_back_color":"","more_button_text_color":"","more_button_read_more_text":"","widget_header_text_size":"","widget_header_style":"normal","widget_header_text_color":"","article_border_color":"","body_border_color":"","body_background_texture":"notexture","body_texture_upload":"","body_background_color":"","footer_height_state":"auto","footer_height":"","footer_hide_shadow":"no","footer_text_color":"","footer_background_color":"","portfolio_title_size":"","portfolio_title_style":"normal","portfolio_post_title_size":"","portfolio_post_title_style":"normal","portfolio_post_body_size":"","portfolio_post_body_style":"normal","portfolio_filter_text":"","portfolio_filter_background":"","portfolio_text_color":"","not_found_title_state":"show","not_found_title_text":"sadwqdsadqwdasd","not_found_text_state":"show","not_found_desc_text":"","not_found_image_state":"hide","not_found_image":"","not_found_search_form_state":"show","not_found_categories_state":"none","input_envanto_user_name":"","input_envanto_key":""};	
				$( id ).bind( 'click', 
					function() {
						for ( var index in arr ) {
							var id = $('#' + index + '_opt');
								if ( id.is('select') ) {	
									id.find( 'option' ).removeAttr( 'selected' );
									id.find( 'option[value="' + arr[index] + '"]' ).attr( 'selected', 'selected' );	
								}
								else {
									id.attr('value', arr[index] );
								} 
							
							} 
						});	
					},
		layouts_saver : function( id, toseril, nameinput, append, theoption, savebutton, cancelbutton, infotext, removehook ) { 
		
		var pop = '<div class="main-options-pop-box-wrap"><div class="main-options-pop-box"><p>Please Name Your Layout:</p><input id="save_layouts_test_opt" class="lf_admin_core_input" type="text" value="" name="main_options[save_layouts_test]"/><span class="main-options-pop-box-button lf_admin_save_layout_popup_button">Save</span><span class="main-options-pop-box-button lf_admin_cancel_save_layout_button">Cancel</span></div></div>';
			
			$( id ).bind('click', 
				function () {
					$('body').prepend( pop );
					
					$( cancelbutton ).bind( 'click', 
						function() {
							$(this).unbind('click');
							$('.main-options-pop-box')
								.parent()
								.empty()
								.remove();
							});		
					$( savebutton ).bind('click', 
						function() {	
						var	tname 	= $( nameinput ).val();
							sname 	= tname.replace(/\s/g, '').toLowerCase();
							opt 	= $( toseril ).serialize();
							input 	= '<div><span class="lf_admin_core_list_memeber">' + tname + '</span><span title="Remove Layout" class="lf_admin_core_list_removal lf_layout_remove_hook">-</span><input type="hidden" name="' + theoption + '[value][' + sname + ']" value="' + opt + '" /><input type="hidden" name="' + theoption + '[name][' + sname + ']" value="' + tname + '" /></div>';
							
							if ( sname.match( /^\s*$/ ) ) {
								$( nameinput )
									.prev()
									.css('color', '#ff1300' );	
							}
							else {
								alert( opt );
								$( append )
									.append( input );
								$(this)
									.unbind('click');	
								$('.main-options-pop-box')
									.parent()
									.empty()
									.remove();	
								$( removehook ).each( 
									function() {
									$(this).unbind(
										'click'
										).bind(
										'click', 
										function() {
										$(this).parent().empty().remove();
										});
									});	
								if ( $( infotext ).length ) {
									$( infotext )
										.empty()
										.remove();
									}
								}			
							});  
					});
				$( removehook ).each( 
					function() {
					$(this).bind('click', 
						function() {
						$(this).parent().empty().remove();
						});
					});	
			} 
	},
	
	lf_ajax = {
		save_main_options_ajax : function() {
               $('.main-options-form').submit( function () {
                    var b =  $(this).serialize();
                    $.post( 'options.php', b ).error( 
						function() {
							alert('error');
						}).success( function() {
							alert('success');	
						});
						return false;    
                    });
				}
	}
})(jQuery);

jQuery(document).ready(function($){
	
	//	Navigation Arrow Setup 
	$('<ul />').appendTo(
		'.main-options-tab-nav-hook');											
	
	$('.LF-main-options-wrapper').find('h3').each(
		function(index) { 
			$( '<li><div class="lf-ui-nav-arrow-wrapper"><div class="LF-ui-tab-nav-arrow-back"></div><a href="#main-options-tab-'+ index + '" class="LF-tab-nav-default">'+$(this).text()+'</a><div class="LF-ui-tab-nav-arrow-front"></div></div></li>'
			).appendTo('.main-options-tab-nav-hook ul');																							
		});		
					
	$('.LF-main-options-wrapper')
		.find('h3')
		.hide();
	
	$('.LF-main-options-wrapper')
		.find('.form-table').each(
			function (index) { 
				$(this).wrapAll("<div id='main-options-tab-"+ index + "'></div>"); 
				} );
				
	$('.main-form-tabs').tabs();
	
	//	Keypress Setup 
	function keypressfuncone() { 					
		$('.main-options-info-box').text(
			'Hover over the option you wish to know about'
			).fadeIn('slow');
							
		$('.LF-option-inv-desc').parent().each( 
			function () { 
				$(this).hover(	
					function () { 
						$('.main-options-info-box').empty().append( $(this).find('.LF-option-inv-desc').html() ); 
						},
					function () { 
						$('.main-options-info-box').empty().text('press the "=" key to turn off help'); 
						} ); 
					});
				}			
						
	function keypressfunctwo() { 
		$('.LF-option-inv-desc')
			.parent()
			.unbind('hover');
								
		$('.main-options-info-box')
			.empty()
			.text(
				'bye bye :)'
				).fadeOut('slow'); 
			}
	
	$(this).keypress( 
		function (event) { 
			var LFhelp = "Off"; 
										
			if ( event.which == 43 ) {  
				var LFhelp = "On"; 
				}	
			else if ( event.which == 61 ) {  
				var LFhelp = "Off"; 
				}	
			else { 
				return; 
				}
			if ( LFhelp == "On" ) {
				keypressfuncone();
				}
			if ( LFhelp == "Off" ) { 
				keypressfunctwo(); 
				}
			});	
			
	lf_ajax.save_main_options_ajax();
	
	//lf_ui_parts.presets('#preset_chosen_opt');
	
	lf_ui_parts.layouts_saver(
		'.lf_admin_save_layout_button', 
		'.inputs,#header-state-multisort,#slider-state-multisort,#content-state-multisort,#footer-state-multisort',
		'#save_layouts_test_opt',
		'.lf_admin_saved_layouts_list',
		'main_options[test_saved_layouts]',
		'.lf_admin_save_layout_popup_button',
		'.lf_admin_cancel_save_layout_button',
		'.lf_no_saved_layouts_text_hook',
		'.lf_layout_remove_hook' );
				
	$('.main-options-tiny-info-box').css('display', 'inline-block');
	
	lf_ui_parts.slider_control( 
		"#header_title_font_size_opt", 
		16, 
		120, 
		" pixels" );
	
	lf_ui_parts.slider_control( 
		"#header_height_opt", 
		24, 
		2000, 
		" pixels" );
		
	lf_ui_parts.slider_control( 
		"#logo_sizeus_opt", 
		16, 
		280, 
		" pixels" );
		
	lf_ui_parts.slider_control( 
		"#posttitle_text_size_opt", 
		12, 
		72, 
		" pixels" );
		
	lf_ui_parts.slider_control( 
		"#meta_text_size_opt", 
		6, 
		48, 
		" pixels" );
		
	lf_ui_parts.slider_control( 
		"#body_text_size_opt", 
		6, 
		36, 
		" pixels" );
		
	lf_ui_parts.slider_control( 
		"#widget_header_text_size_opt", 
		6, 
		72, 
		" pixels" );
		
	lf_ui_parts.slider_control( 
		"#footer_height_opt", 
		48, 
		1000, 
		" pixels" );
		
	lf_ui_parts.slider_control( 
		"#slider_text_size_opt", 
		12, 
		54, 
		" pixels" );
		
	lf_ui_parts.slider_control( 
		"#slider_duration_opt", 
		100, 
		5000, 
		" mili-seconds" );
		
	lf_ui_parts.slider_control( 
		"#slider_height_opt", 
		200, 
		960, 
		" pixels" );
		
	lf_ui_parts.slider_control( 
		"#portfolio_title_size_opt", 
		12, 
		140, 
		" pixels" );
		
	lf_ui_parts.slider_control( 
		"#portfolio_post_title_size_opt", 
		12, 
		140, 
		" pixels" );
		
	lf_ui_parts.slider_control( 
		"#portfolio_post_body_size_opt", 
		8, 
		48, 
		" pixels" );	
		
	lf_ui_parts.slider_control( 
		"#header_bars_thickness_opt", 
		24, 
		125, 
		" pixels" );
		
});

