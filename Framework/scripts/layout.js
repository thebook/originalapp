!function ($) { 

	layout_builder = {

		leaf : { 

			templates : function (passed) { 

				var iframe = iframe_writer.get_iframe(passed.id_of_iframe_to_append_to); 

				iframe
				.on(
					'mousedown', 
					'.drag',
				function (down_event) { 						
					
					layout_builder
					.branch
					.drag
					._start_dragging_template({
						move         : this,							
						iframe       : iframe,
						down_event   : down_event
					});																	
				})
				.on(
					'click',
					'.layoutbuilder_template_close_button',
				function () { 
					
					$(this)
					.parent()
					.fadeOut(400, function () {

						$(this).empty().remove();
					});
				})
				.on(
					'click',
					'.layoutbuilder_edit',
				function () {

					layout_builder
					.branch
					.option_box
					._bind_editing_for_inserted_templates({
						button   : this,
						ajax_url : passed.ajax_url
					});

				});

			}
		},
		
		branch : { 

			builder_interactions : { 

				init : function (passed) { 

					var builder = $( passed.builder_get ),
						klass   = this;
					
					builder.on(
						'click',
					function (click_event) { 
						
						var click_target, click_target_id;

							click_target 	= $( click_event.target );
							click_target_id = click_target.attr('id');
							
						switch ( click_target_id ) {

							case 'layout-builder-layout-close' : klass._close_builder_completely(this); break;

							case 'layout-builder-colapse' : klass._colapse_insertion_sidebar(click_target); break;
						}
					});
				},

				_colapse_insertion_sidebar : function (clicked_button) { 

					var canvas_to_expand = $('.layout_builder_body');											

					if ( !clicked_button.data("colapsed") ) { 

						canvas_to_expand.animate({'margin-left'   : '0'}, 200);
						clicked_button.css({'background-position' : '0 -108px'});
						
						clicked_button.data('colapsed', true );
					}
					else { 
						
						canvas_to_expand.animate({'margin-left'   : '20%'}, 200);
						clicked_button.css({'background-position' : '0 -72px'});
						
						clicked_button.data('colapsed', false);
					}
				},

				_close_builder_completely : function (clicked_button) { 

					$(clicked_button)
					.parents('.layout-builder')
					.fadeOut( 500,						
					function () {
						$(this).empty();
						$('body').removeClass('full-overlay-active');
					});	
				}
			},

			drag : { 

				_start_dragging_template : function (passed) { 

					var klass, moving_template, position_of_other_templates, other_templates,
						initial_position = new Object, initial_template_styling = new Object;

						klass 			 				 = this;
						moving_template  				 = $(passed.move);	
						other_templates 				 = moving_template.parent().children().not("#"+ moving_template.attr('id') +", .drop_spot");
						
						initial_position.mouse_left      = passed.down_event.pageX;
						initial_position.mouse_top   	 = passed.down_event.pageY;
						initial_position.template_offset = moving_template.offset();					
						
						initial_template_styling.width   = moving_template.css('width');
						initial_template_styling.height  = moving_template.css('height');
						
						position_of_other_templates		 = klass._get_positions_of_all_other_templates_apart_from_draged_one(other_templates);

					$('<div class="drop_spot"></div>')
					.css({
						width     : initial_template_styling.width,
						height    : initial_template_styling.height
					})
					.insertAfter(moving_template);

					moving_template
					.css({ 
						position : 'absolute',
						width    : initial_template_styling.width
					});
					
					passed.iframe
					.on('mousemove',
					function (move_event) { 
						
						var move_left_by  = ( move_event.pageX + initial_position.template_offset.left) - initial_position.mouse_left,
							move_top_by   = ( move_event.pageY + initial_position.template_offset.top ) - initial_position.mouse_top;

						klass
						._create_drop_field_next_to_hovered_template({
							position_of_other_templates : position_of_other_templates,
							moving_template 			: moving_template,
							move_event 					: move_event,
							iframe 	   					: this,
							initial_template_style 		: initial_template_styling
						});				

						moving_template
						.css({
							top     : move_top_by,
							left    : move_left_by,
							zIndex  : 10
						});
					})
					.on('mouseup',
					function (up_event) { 
						
						klass
						._drop_the_draged_template_into_position_and_clean_up({
							moving_template : moving_template,
							iframe 			: $(this)
						});
					});
				},

				_create_drop_field_next_to_hovered_template : function (passed) { 


					var	moving_template_parent = passed.moving_template.parent(),
						hovered_template = 
						passed.position_of_other_templates
						.filter( 
							function (template) { 					

							return ( passed.move_event.pageX >= template.left && 
								     passed.move_event.pageY >= template.top  && 
								     passed.move_event.pageY < ( template.top + 40 ) );
							}),
						is_dragged_template_at_the_top = function () {
								
								var parent_offset = moving_template_parent.offset();

								return ( passed.move_event.pageY <= parent_offset.top ? true : false );								
						};

					if ( hovered_template.length !== 0 ) { 

						var mouse_overed_template, does_template_have_drop_spot_after;

							mouse_overed_template 		 = $(passed.iframe).find('#'+ hovered_template[0].id );
							does_template_have_drop_spot = mouse_overed_template.next().hasClass('drop_spot');

						if (!does_template_have_drop_spot) {
							
							mouse_overed_template
							.parent()
							.children('.drop_spot')
							.remove();

							$('<div class="drop_spot"></div>')
							.css({
							 	width  : passed.initial_template_style.width, 
							 	height : passed.initial_template_style.height
							})
							.insertAfter( mouse_overed_template );
													
						}
					}
					else if ( is_dragged_template_at_the_top() && moving_template_parent.children('.drop_spot').length > 0  ) { 
												
							moving_template_parent
							.children('.drop_spot')
							.remove();

							$('<div class="drop_spot"></div>')
							.css({
							 	width  : passed.initial_template_style.width, 
							 	height : passed.initial_template_style.height
							})
							.prependTo( moving_template_parent );
					}					
				},

				_get_positions_of_all_other_templates_apart_from_draged_one : function (other_templates) { 

					var template_positions = new Array;

					other_templates
					.each( 
						function () { 
						var offset 		= $(this).offset(),
							template_id = $(this).attr('id');
						
						template_positions.push({ 
							left : offset.left,
							top  : offset.top, 
							id   : template_id 
						});
					});

					return template_positions;
				},

				_drop_the_draged_template_into_position_and_clean_up : function (passed) { 
					
					passed.moving_template
					.removeAttr('style');				
											
					passed.iframe
					.off('mouseup')
					.off('mousemove')
					.find('.drop_spot')
					.before(passed.moving_template)
					.remove();

					console.log("cleaned up");
				}
			},
			
			option_box : { 
								
				_bind_editing_for_inserted_templates : function (passed) {
					
					var template = $(passed.button).parents('.layoutbuilder-option-wrap'),
						data     = {
							"name" 				   : template.data("template-name"), 
							"element_to_append_to" : "#"+ template.attr('id'),  
							"replace_old_template" : true 									
						};
					
					layout_builder.ajax_get_template_and_manifest({
						template_paramaters  : { template_data : data },
						ajax_url             : passed.ajax_url,
						element_to_append_to : '.layout_builder_body',
						is_using_iframe 	 : false
					});	
				},

				// passed.bind_event_to
				// passed.element_to_append_to
				// passed.template_id
				// passed.ajax_path
				// passed.template_name
				// open_options_box_for_an_inserted_template : function (passed) { 
					
				// 	var button, element_to_append_to, iframe;
					
				// 		iframe = iframe_writer.get_iframe('layout-builder-drop-in');
				// 		button = iframe.find(passed.bind_event_to);
						
				// 		console.log("bind open inserted template");
				// 	button.on(
				// 		'click',
				// 	function () {
				// 		layout_builder.ajax_get_template_and_manifest({
				// 				template_paramaters  : { 
				// 					template_data : { 
				// 						"name" 				   : passed.template_name, 
				// 						"element_to_append_to" : passed.template_id,  
				// 						"replace_old_template" : true 
				// 					} },
				// 				ajax_url             : passed.ajax_path,
				// 				element_to_append_to : passed.element_to_append_to,
				// 				is_using_iframe 	 : false
				// 			});	
				// 	});
				// },
				
				take_options_box_values_and_manifest_a_template : function (passed) { 
					
					var parent_class, template_paramaters, tree_class;
											
						parent_class  = this;
						tree_class 	  = layout_builder;
						
						$( passed.insert_button_id ).on('click', 
							function () {

								template_paramaters = parent_class.create_a_json_array_to_be_passed_for_template_generation({
									template_name         : passed.template_name,        
									paramaters_name       : passed.paramaters_name,      
									name_prefix_to_remove : passed.name_prefix_to_remove
								});							
								
								if ( passed.replace_old_template ) {
								
									parent_class.replace_old_template({
										template_paramaters  : { template_data : template_paramaters },
										ajax_url             : passed.ajax_path,
										element_to_append_to : passed.element_to_append_to,
										iframe_id 			 : passed.iframe_id,
									});
								} 
								else {
									tree_class.ajax_get_template_and_manifest({
										template_paramaters  : { template_data : template_paramaters },
									    ajax_url             : passed.ajax_path,
									    element_to_append_to : passed.element_to_append_to,
									    iframe_id 			 : passed.iframe_id,
									    is_using_iframe		 : passed.is_using_iframe
									});
								}

								$(this).parent().fadeOut(100, function () { $(this).empty().remove(); });
							});

						$( passed.cancel_button_id ).on('click', 
							function () {
								$(this).parent().fadeOut(100, function () { $(this).empty().remove(); });
							});
				},

				replace_old_template : function (passed) { 

					$.ajax({
						data     : passed.template_paramaters,
						url      : passed.ajax_url,
						dataType : "html",
						success  : function ( response ) {
							
							iframe       = iframe_writer.get_iframe(passed.iframe_id);
							old_template = iframe.find(passed.element_to_append_to);							

							old_template
								.fadeOut(200)
								.after(response)
								.empty()
								.remove();
						}
					});
				},

				create_a_json_array_to_be_passed_for_template_generation : function (opt) { 
							
					var paramaters_array, whole_array;

						paramaters_array = this.take_values_from_inputs_and_create_an_array({
							paramaters_name       : opt.paramaters_name,
							name_prefix_to_remove : opt.name_prefix_to_remove
						});
						
						whole_array = '{"name":"'+ opt.template_name +'",'+ paramaters_array +'}';
						whole_array = JSON.parse(whole_array);

						return whole_array;
				},

				take_values_from_inputs_and_create_an_array : function (opt) { 

					var generated_array = '"'+ opt.paramaters_name +'":{';

						$('.layout-builder-options-box select, .layout-builder-options-box input').each(	
							function () {
								
								var dhis, selected_value, selected_name;

									dhis 		     = $(this);
									selected_name    = dhis.attr('name').replace(/[\[\]']+/g,'').replace(opt.name_prefix_to_remove, '');
									selected_value   = dhis.attr('value');
									generated_array += '"'+ selected_name +'":"'+ selected_value +'",';
								});

								generated_array = generated_array.slice( 0, -1 );

								return generated_array += '}';
				},
			}
		},

		portal : function (passed) { 

			var create_layout_button, layout_window, template_to_load, template_paramaters;

				create_layout_button    = $('#' + passed.id + '-button');
				layout_window 			= $('#' + passed.id + '-layout');

				create_layout_button.on('click',
					function () { 

						layout_window.fadeIn(200, 
							function () { 
								$('#' + passed.id + '-layout-close').fadeIn(200);
								$('body').addClass('full-overlay-active');
							});

						layout_builder.ajax_get_template_and_manifest({
							template_paramaters  : { template_data : passed.template_name },
							ajax_url             : passed.ajax_path,
							element_to_append_to : '#' + passed.id + '-layout',
							is_using_iframe 	 : false 
						});	
					});
		},
		
		get_template_name_and_generate : function (passed) { 

			var clicked, template_name, ajax_path, element_to_append_to, is_using_iframe, has_options_box, iframe_id;

			$('#' + passed.bind_event_to ).on('click', 
				
				function (click_event) { 
										
					clicked = $(click_event.target);

					if ( clicked.is(passed.element_to_respond_to_when_clicked) ) {

						passed.iframe_id     = passed.iframe_id || null;
						has_options_box		 = clicked.attr('class') == 'has_options';
						ajax_path            = ( has_options_box ? passed.options_ajax_path : passed.template_ajax_path );
						element_to_append_to = ( has_options_box ? '.layout_builder_body' : passed.element_to_append_to );
						iframe_id 			 = passed.iframe_id;
						is_using_iframe      = ( has_options_box ? false : true );
						template_name        = clicked.attr('id');

						//
						//	Make Aajx Request
						layout_builder.ajax_get_template_and_manifest({
							template_paramaters  : { template_data : { "name" : template_name, "element_to_append_to" : passed.element_to_append_to, "replace_old_template" : false } },
							ajax_url             : ajax_path,
							element_to_append_to : element_to_append_to,
							is_using_iframe 	 : is_using_iframe
						});						   
					}					
				});
		},

		ajax_get_template_and_manifest : function (passed) { 

			$.ajax({
				data     : passed.template_paramaters,
				url      : passed.ajax_url,
				dataType : "html",
				success  : function ( response ) {					
					
					if ( passed.is_using_iframe ) {
						
						iframe_writer.open_iframe_and_append_string({
							iframe_id            : passed.iframe_id,
							element_to_append_to : passed.element_to_append_to,
							element_to_append    : response
						});
					}
					else {	

						$(passed.element_to_append_to).append( response );					
					}
				}
			});
		}

	};

	iframe_writer = {

		open_iframe_and_append_string : function (passed) { 
			
			var iframe = this.get_iframe(passed.iframe_id);
				
				iframe.find(passed.element_to_append_to).append(passed.element_to_append);			
		}, 

		get_iframe : function (iframe_id) {

			var	iframe = document.getElementById(iframe_id);
				iframe = $(iframe.contentWindow.document);

			return iframe;
		}
	}

}(jQuery);