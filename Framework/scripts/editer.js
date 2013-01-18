var alpha = (function ( alpha, $ ) {

	alpha.edit_user = function (current_click) { 

		var parent = current_click.element.closest('.profile_display_user'),
			change_field = parent.find('.personal_field'),
			myself = this.prototype;

		if ( current_click.element.hasClass('in_edit') ) { 

			current_click.element.removeClass('in_edit').text('Edit');
			parent.find('.personal_field_editor').remove();
			parent.find('.small_user_save').fadeOut(400, function () { $(this).remove(); });
			parent.find('.personal_field_text').css({ display : "inline-block" });
		}
		else { 

			$('<span class="small_user_save">Save</span>').bind('click', 
			function () { 	
				myself.change_user_field(change_field, $(this), current_click.element, current_click.instructions.user_id );
			})
			.insertAfter(current_click.element);

			current_click.element.addClass('in_edit').text('Cancel')
			myself.change_text_into_input(change_field, '.personal_field_name', '.personal_field_text');
		}
	};

	alpha.edit_user.prototype.change_user_field = function (change_field, save_button, edit_button, user_data_id) { 

		var updated_user_information         = this.change_input_values_into_json(change_field, '.personal_field_editor');
			updated_user_information.user_id = user_data_id;

			save_button.text('Saving...');
			
			alpha.ajax_save(
				{ action : 'save_user_field', update_information : updated_user_information },
				function () { 
					save_button.fadeOut(400, function () { $(this).remove(); });
				}
			);

			this.change_input_into_text(change_field, '.personal_field_text', '.personal_field_editor');
			edit_button.removeClass('in_edit').text('Edit');
	};

	alpha.edit_user.prototype.change_text_into_input = function (change_fields, name_text, text_text) { 

		change_fields.each(
		function () {
			var field_name  = $.trim($(this).find(name_text).text().trim().replace(':', '')).replace(' ', '_').toLowerCase(),
				value_text  = $(this).find(text_text);
				field_value = value_text.text();

				value_text.css({ display : "none" }).after('<input class="personal_field_editor" type="text" value="'+ field_value +'" name="'+ field_name +'">');
		});
	};

	alpha.edit_user.prototype.change_input_into_text = function (change_inputs, text_to_show, input_to_remove) { 

		change_inputs.each(
		function () { 

			var edit_input = $(this).find(input_to_remove),
				input_value = edit_input.val();
			
			$(this).find(text_to_show).css({ display : "inline-block" }).text(input_value);
			edit_input.remove();
			
		});
	};

	alpha.edit_user.prototype.change_input_values_into_json = function (value_inputs, input_field) { 

		var return_object = new Object;

		value_inputs.each(
		function () { 
			var field = $(this).find(input_field);

				return_object[field.attr('name')] = field.val();
		});

		return return_object;
	};

	return alpha;

})(alpha || {}, jQuery );