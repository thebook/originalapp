var alpha = (function ( alpha, $ ) {

	alpha.edit_user = function (current_click) { 



		var parent = current_click.element.closest('.profile_display_user'),
			change_field = parent.find('.personal_field');

			this.prototype.change_text_into_input(change_field, '.personal_field_name', '.personal_field_text');

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

	return alpha;

})(alpha || {}, jQuery );