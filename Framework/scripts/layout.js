!function ($) { 

	layout_builder = {

		klass : this,

		controls : { 

			empty_and_remove_parent_and_self : function (passed) { 

				var button = $(passed.id);
				button.on('click',
					function () { 
						button.parent().empty().remove();
					});
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
		},

		produce : { 

			move : { 

				create : function (passed) { 

						this.prototype 		 = layout_builder.branch_move_around;
					
					var _klass    		 	 = this.prototype,
						_get_iframe   		 = iframe_writer.get_iframe(passed.iframe),
						_bind_to 	  		 = _get_iframe.find(passed.bind_to),
						_get_template 		 = $(_bind_to).parents(passed.class_for_templates),
						_change_move_buttons = _klass._hide_show_move_buttons;

					_bind_to
					.toggle(
						function () {										

							_change_move_buttons.set_up({
								iframe       : passed.iframe,
								move_buttons : '.layoutbuilder-move-button',
								bind_to 	 : passed.bind_to
							});
							
							_change_move_buttons.manifest('none', 'Dont Move');						

							_klass
							._iterate_over_templates_and_add_a_visible_field({
								class_for_templates : passed.class_for_templates,
								template_to_exclude : _get_template,
								iframe 				: _get_iframe
							});
						},
						function () {
							
							_change_move_buttons.manifest('block', 'Move');					
							_klass._remove_visible_drop_fields(_get_template);					
						});
					}
				},
		},

		branch_move_around : { 

			_hide_show_move_buttons : {

			 	set_up : function (passed) { 

			 		var _get_iframe           = iframe_writer.get_iframe(passed.iframe);
					 	this._buttons_to_hide = 
						 		_get_iframe
								.find(passed.move_buttons)
								.parent()
								.not(passed.bind_to);
						this._clicked_button  = _get_iframe.find(passed.bind_to).children();
			 	},

			 	manifest : function (display_state, text_to_display) { 
			 		this._buttons_to_hide.css('display', display_state);
			 		this._clicked_button.text(text_to_display);
			 	}
			},

			_iterate_over_templates_and_add_a_visible_field : function (passed) {

				var _the_class = this;

				passed.iframe
				.find(passed.class_for_templates)
				.not(passed.template_to_exclude)
				.each( 
					function () {
						_the_class._add_a_visible_drop_field({
							element : this, 
							iframe 	: passed.iframe,
							template_to_move : passed.template_to_exclude
						});						
				});
			},

			_add_a_visible_drop_field : function (passed) { 

					$('<div class="layoutbuilder-empty-field"><span>Move template here</span></div>')
					.css({'opacity' : '0'})
					.insertAfter(passed.element);

				var insert_fields = passed.iframe.find('.layoutbuilder-empty-field');
					
					insert_fields.animate({'opacity' : '1'}, 400);

					this._move_template_to_clicked_area({
						template_to_move : passed.template_to_move,
						insert_fields    : insert_fields,
						iframe 			 : passed.iframe
					});
			},

			_remove_visible_drop_fields : function (element) { 

				$(element)
				.parent()
				.find('.layoutbuilder-empty-field')
				.animate(
					{'opacity' : '0'}, 
					400,
					function () {
						$(this).remove();
					});			
			},

			_move_template_to_clicked_area : function (passed) { 

				var klass = this;

				$(passed.insert_fields)
				.on('click',
					function () {

						var clone = passed.template_to_move.clone(true);

							$(passed.template_to_move).empty().remove();

						    clone.insertBefore(this);	

						    klass._remove_visible_drop_fields(this);
					});
			}
		},

		branch_option_box : { 

			/**
			 * Opens a options box for an already inserted template, if inserted it then wipes the inserted tempalte, which 
			 * is within a wrapper and then inserts the new modified version
			 * @param  {array}  passed 							An array of all the otions
			 * @param  {string} passed.bind_event_to  			The button id or class to which the event is bound 
			 * @param  {string} passed.ajax_path 				The path to the ajax file which will generate the options box
			 * @param  {string} passed.template_name 			The name of the template for which to generate options for
			 * @param  {string} passed.element_to_append_to		What element to append the options box to
			 * @param  {string} passed.template_id				The id of the currently inserted template wrapper, this is used 
			 *                                        			so that the options box knows what currently inserted tempalte 
			 *                                        			to replace
			 * @return {ajax request}
			 */
			open_options_box_for_an_inserted_template : function (passed) { 
				
				var button, element_to_append_to, iframe;
				
					iframe = iframe_writer.get_iframe('layout-builder-drop-in');
					button = iframe.find(passed.bind_event_to);
					
					console.log("bind open inserted template");
				button.on('click',
					function () {
						layout_builder.ajax_get_template_and_manifest({
								template_paramaters  : { template_data : { "name" : passed.template_name, "element_to_append_to" : passed.template_id,  "replace_old_template" : true } },
								ajax_url             : passed.ajax_path,
								element_to_append_to : passed.element_to_append_to,
								is_using_iframe 	 : false
							});	
					});
			},
			
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

		},


		close_layout_builder_window : function (opt) { 
				
			$( opt.id ).on('click',				
				function () { 									
						 				
					$( opt.box_to_close ).fadeOut(500,						
						function () {
						$(this).empty();
						$('body').removeClass('full-overlay-active');
					});							
				});
		},

		close_options_sidebar : function (passed) { 

			var canvas_to_expand, button, button_arrow;

				canvas_to_expand = $(passed.canvas_to_expand);
				button  		 = $(passed.id);
				button_arrow     = button.children();

			button.toggle(
				function () { 		
					canvas_to_expand.animate({'margin-left' : '0'}, 200);
					button_arrow.css({'background-position' : '0 -108px'});
				},
				function () {
					canvas_to_expand.animate({'margin-left' : '20%'}, 200);
					button_arrow.css({'background-position' : '0 -72px'});
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