!function ($) { 

	layout_builder = {

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

			$('#' + passed.bind_event_to ).on('click', 
				function (click_event) { 
					
					var clicked = $(click_event.target);

					if ( clicked.is(passed.element_to_respond_to_when_clicked) ) {

						var template_name, ajax_path, element_to_append_to, is_using_iframe, has_options_box;

							has_options_box		 = clicked.attr('class') == 'has_options';
						 	ajax_path            = ( has_options_box ? passed.options_ajax_path : passed.template_ajax_path );
						 	element_to_append_to = ( has_options_box ? '.layout_builder_body' : passed.element_to_append_to );
						 	is_using_iframe      = ( has_options_box ? false : true );
						 	template_name        = clicked.attr('id');

						 	//
						 	//	Make Aajx Request
						    layout_builder.ajax_get_template_and_manifest({
						    	template_paramaters  : { template_data : { "name" : template_name } },
						    	ajax_url             : ajax_path,
						    	element_to_append_to : element_to_append_to,
						    	is_using_iframe 	 : is_using_iframe
						    });						   
						}					
					});
		},

		ajax_get_template_and_manifest : function (passed) { 
			// console.log("inside ajax_get_template_and_manifest : the vlaue is :" +passed.element_to_append_to );
			$.ajax({
				data     : passed.template_paramaters,
				url      : passed.ajax_url,
				dataType : "html",
				success  : function ( response ) {
					
					if ( passed.is_using_iframe ) {
						
						iframe_writer.open_iframe_and_append_string({
							iframe_id         : passed.element_to_append_to,
							element_to_append : response
						});
					}
					else {	

						$(passed.element_to_append_to).append( response );					
					}
				}
			});
		},

		take_options_box_values_and_manifest_a_template : function (passed) { 
			var insert_button, the_class, cancel_button;

				insert_button = $('#'+ passed.insert_button_id );
				cancel_button = $('#'+ passed.cancel_button_id );
				the_class     = this;
				
				insert_button.on('click', 
					function () {

						template_paramaters = the_class.create_a_json_array_to_be_passed_for_template_generation({
							template_name         : passed.template_name,        
							paramaters_name       : passed.paramaters_name,      
							name_prefix_to_remove : passed.name_prefix_to_remove
						});

						template_paramaters = JSON.parse(template_paramaters);
						
						the_class.ajax_get_template_and_manifest({
							template_paramaters  : { template_data : template_paramaters },
						    ajax_url             : passed.ajax_path,
						    element_to_append_to : passed.element_to_append_to,
						    is_using_iframe		 : passed.is_using_iframe
							});

						$(this).parent().fadeOut(100, function () { $(this).empty().remove(); });
					});

				cancel_button.on('click', 
					function () {
						$(this).parent().fadeOut(100, function () { $(this).empty().remove(); });
					});
		},

		create_a_json_array_to_be_passed_for_template_generation : function (opt) { 
					
			var paramaters_array, whole_array;

				paramaters_array = this.take_values_from_inputs_and_create_an_array({
					paramaters_name       : opt.paramaters_name,
					name_prefix_to_remove : opt.name_prefix_to_remove
				});
				
				whole_array = '{"name":"'+ opt.template_name +'",'+ paramaters_array +'}';

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
			
			var iframe = document.getElementById(passed.iframe_id);
				iframe = $(iframe.contentWindow.document);
				
				iframe.find('.liquidflux-wrap-everything').append(passed.element_to_append);			
		}
	}
}(jQuery);