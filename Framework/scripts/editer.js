var alpha = (function ( alpha, $ ) {

	alpha.edit_user = function (current_click) { 

		var parent = current_click.element.closest('.profile_display_user'),
			change_field = parent.find('.personal_field');
		
		if ( current_click.element.hasClass('in_edit') ) { 

			current_click.element.removeClass('in_edit').text('Edit');
			
			this.prototype.change_input_into_text(change_field, '.personal_field_text', '.personal_field_editor');

			parent.find('.small_user_save').remove();
		}
		else { 

			current_click.element.addClass('in_edit').text('Cancel').after('<span class="small_user_save">Save</span>');
			
			this.prototype.change_text_into_input(change_field, '.personal_field_name', '.personal_field_text');
		}

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

	return alpha;

})(alpha || {}, jQuery );